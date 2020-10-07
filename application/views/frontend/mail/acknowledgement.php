<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Untitled Document</title>
</head> 
<body>
    <table width="700" border="0" cellspacing="1" cellpadding="6" bgcolor="#999999"
        style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr>
            <td colspan="2" align="center" bgcolor="#FFFFFF" style="padding-bottom:10px; padding-top:10px;"><a
                    href="<?php echo site_url('/')?>"><img
                        src="<?php echo base_url('public/frontend/images/logo.png')?>" alt=""></a></td>
        </tr>
        <tr>
            <td colspan="2" bgcolor="#FFFFFF"> Dear <?php echo $enq_name; ?>, <br />
                <br />
                Thank you for contacting us.<br />
                <br />
                One of our representative will be in touch with you soon. <br />
                <br />
                <br />
                Regards <br />
                <?php echo $this->alphasettings['SITE_NAME']; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" bgcolor="#666666" style="color:#fff;"><strong>&copy;
                    <?php echo convert_lang($this->config->item('copy_right'),$this->alphalocalization); ?></strong>
            </td>
        </tr>
    </table>
</body> 
</html>