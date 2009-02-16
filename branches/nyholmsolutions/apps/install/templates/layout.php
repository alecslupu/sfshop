<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

<?php
    echo javascript_tag('
        var status = {
            ERROR: ' . sfsJSONPeer::STATUS_ERROR . ',
            SUCCESS: ' . sfsJSONPeer::STATUS_SUCCESS . '
        };
    ');
?>

    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
        <tr><td style="background: url(/install/images/m13.gif) repeat-x" height="106"></td></tr>
        <tr><td height="100%" valign="top" align="center">
            <table cellspacing="0" cellpadding="0" align="center" width="700">
                <tr><td>
                    <?php echo $sf_content ?>
                </td></tr>
            </table>
        </td></tr>
        <tr><td style="background: url(/install/images/m14.gif)" height="41"></td></tr>
    </table>
</body>
</html>
