<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed.');
}

/*My SMTP provider (Exchange system) doesn't accept SSL connections and requires the use of SMTP over TLS instead (STARTTLS, RFC 3207). Here is a small patch to the Email class which adds support for it. It is written against 1.7.2. If this is useful to others, you're most welcome to incorporate it in a future release.
Usage:
Specify server settings as a regular SMTP server (tcp://servername, typically port 25 or 587).
Enable new setting in config ($config['starttls'] = TRUEWink
Depends on TLS being available (i.e., listed in the 'Registered Stream Socket Transports' section of phpinfo()).
Patch
Code:
--- a/system/libraries/Email.php
+++ b/system/libraries/Email.php
@@ -51,6 +51,7 @@ class CI_Email {
var $send_multipart    = TRUE;        // TRUE/FALSE - Yahoo does not like multipart alternative, so this is an override.  Set to FALSE for Yahoo.
var    $bcc_batch_mode    = FALSE;    // TRUE/FALSE  Turns on/off Bcc batch feature
var    $bcc_batch_size    = 200;      // If bcc_batch_mode = TRUE, sets max number of Bccs in each batch
+    var    $starttls          = FALSE;    // Issue STARTTLS after connection to switch to Secure SMTP over TLS (RFC 3207)
var $_safe_mode        = FALSE;
var    $_subject        = "";
var    $_body            = "";
@@ -1581,7 +1582,20 @@ class CI_Email {
return FALSE;
}
-        $this->_smtp_connect();
+        if (!$this->_smtp_connect()) {
+            return FALSE;
+        }
+
+        if ($this->starttls) {
+            if (! $this->_send_command('starttls')) {
+                $this->_set_error_message('email_starttls_failed');
+                return FALSE;
+            }
+            stream_socket_enable_crypto($this->_smtp_connect, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
+            // Re-issue hello to get updated service list (RFC 3207 section 4.2)
+            $this->_send_command('hello');
+        }
+
$this->_smtp_authenticate();
$this->_send_command('from', $this->clean_email($this->_headers['From']));
@@ -1708,6 +1722,12 @@ class CI_Email {
$resp = 221;
break;
+            case 'starttls'    :
+
+                        $this->_send_data('STARTTLS');
+
+                        $resp = 220;
+            break;
}
$reply = $this->_get_smtp_data();
Example:
Code:
&lt;?php
function send_email($addr, $subject, $data) {
$this->load->library('email');
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'tcp://servername'; # Not tls://
$config['smtp_port'] = 25;
$config['starttls'] = TRUE;
$config['smtp_user'] = <username>;
$config['smtp_pass'] = <password>;
$config['smtp_timeout'] = 5;
$config['newline'] = "\r\n";
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$this->email->initialize($config);
$this->email->from('<email addr>', 'User name');
$this->email->to($addr);
$this->email->subject($subject);
$this->email->message($data);
$rc = $this->email->send();
echo $this->email->print_debugger();
}
?&gt;*/class MY_Email extends CI_Email
{
    public $starttls = false; // Issue STARTTLS after connection to switch to Secure SMTP over TLS (RFC 3207)

    public function MY_Email()
    {
        parent::CI_Email();

    }
    public function _send_with_smtp()
    {
        if ($this->smtp_host == '') {
            $this->_set_error_message('email_no_hostname');
            return false;
        }
        if (!$this->_smtp_connect()) {
            return false;
        }
        if ($this->starttls) {
            if (!$this->_send_command('starttls')) {
                $this->_set_error_message('email_starttls_failed');
                return false;
            }
            stream_socket_enable_crypto($this->_smtp_connect, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            // Re-issue hello to get updated service list (RFC 3207 section 4.2)
            $this->_send_command('hello');
        }
        $this->_smtp_authenticate();
        $this->_send_command('from', $this->clean_email($this->_headers['From']));
        foreach ($this->_recipients as $val) {
            $this->_send_command('to', $val);
        }
        if (count($this->_cc_array) > 0) {
            foreach ($this->_cc_array as $val) {
                if ($val != "") {
                    $this->_send_command('to', $val);
                }
            }
        }
        if (count($this->_bcc_array) > 0) {
            foreach ($this->_bcc_array as $val) {
                if ($val != "") {
                    $this->_send_command('to', $val);
                }
            }
        }
        $this->_send_command('data');
        // perform dot transformation on any lines that begin with a dot
        $this->_send_data($this->_header_str . preg_replace('/^\./m', '..$1', $this->_finalbody));
        $this->_send_data('.');
        $reply = $this->_get_smtp_data();
        $this->_set_error_message($reply);
        if (strncmp($reply, '250', 3) != 0) {
            $this->_set_error_message('email_smtp_error', $reply);
            return false;
        }
        $this->_send_command('quit');
        return true;
    }

    public function _send_command($cmd, $data = '')
    {
        switch ($cmd) {
            case 'hello':
                if ($this->_smtp_auth or $this->_get_encoding() == '8bit') {
                    $this->_send_data('EHLO ' . $this->_get_hostname());
                } else {
                    $this->_send_data('HELO ' . $this->_get_hostname());
                }

                $resp = 250;
                break;
            case 'from':
                $this->_send_data('MAIL FROM:<' . $data . '>');
                $resp = 250;
                break;
            case 'to':
                $this->_send_data('RCPT TO:<' . $data . '>');
                $resp = 250;
                break;
            case 'data':
                $this->_send_data('DATA');
                $resp = 354;
                break;
            case 'quit':
                $this->_send_data('QUIT');
                $resp = 221;
                break;
            case 'starttls':
                $this->_send_data('STARTTLS');
                $resp = 220;
                break;
        }
        $reply = $this->_get_smtp_data();
        $this->_debug_msg[] = "<pre>" . $cmd . ": " . $reply . "</pre>";
        if (substr($reply, 0, 3) != $resp) {
            $this->_set_error_message('email_smtp_error', $reply);
            return false;
        }
        if ($cmd == 'quit') {
            fclose($this->_smtp_connect);
        }
        return true;
    }

}
