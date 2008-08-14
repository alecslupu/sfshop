<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/admin.ico" />

</head>
<body>

    <!-- HEADER -->
    <?php include_partial('coreAdmin/header'); ?>
    <!-- /HEADER -->

<?php echo $sf_content ?>

    <!-- FOOTER -->
    <?php include_partial('coreAdmin/footer'); ?>
    <!-- /FOOTER -->

</body>
</html>
