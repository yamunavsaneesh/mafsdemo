<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>MAFS</title>
</head> 
<body>
    <table width="650" border="0" cellspacing="1" cellpadding="6" bgcolor="#CCCCCC"
        style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr>
            <td colspan="2" align="center" bgcolor="#231F20" style="padding-bottom:10px; padding-top:10px;"><a
                    style="color:white"
                    href="<?php echo site_url('/')?>"><?php echo $this->alphasettings['SITE_NAME']; ?></a></td>
        </tr>
        <tr>
            <td colspan="2" bgcolor="#FFFFFF"><strong>A new enquiry has been submitted from
                    <?php echo $this->alphasettings['SITE_NAME']; ?> website:</strong></td>
        </tr>
        <tr>
            <td width="96" bgcolor="#E6E6E6"><strong>Full Name</strong></td>
            <td width="527" bgcolor="#FFFFFF"><?php echo $enq_name; ?></td>
        </tr>
        <tr>
            <td bgcolor="#E6E6E6"><strong>Email</strong></td>
            <td bgcolor="#FFFFFF"><?php echo $enq_email; ?></td>
        </tr>
        <tr>
            <td bgcolor="#E6E6E6"><strong>Phone</strong></td>
            <td bgcolor="#FFFFFF"><?php echo $enq_phone; ?></td>
        </tr>
        <tr>
            <td width="96" bgcolor="#E6E6E6"><strong>FMessage</strong></td>
            <td width="527" bgcolor="#FFFFFF"><?php echo $enq_message; ?></td>
        </tr>
        <tr>
            <td valign="top" bgcolor="#E6E6E6"><strong>IP</strong></td>
            <td bgcolor="#FFFFFF"><a
                    href="http://www.ip-tracker.org/locator/ip-lookup.php?ip=<?php echo $this->input->ip_address(); ?>"
                    target="_new"><?php echo $this->input->ip_address(); ?></a></td>
        </tr>
        <tr>
            <td colspan="2" align="center" bgcolor="#666666" style="color:#fff;"><strong>&copy;
                    <?php echo convert_lang($this->config->item('copy_right'),$this->alphalocalization); ?></strong>
            </td>
        </tr>
    </table>
</body> 
</html>