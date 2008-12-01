<h2><?php echo __('Database configuration') ?></h2>
<br/>
<?php if (isset($errors) && count($sf_data->getRaw('errors')) > 0): ?>
    <div class="error">
        <table cellspacing="0" cellpadding="0">
            <?php foreach ($errors as $e): ?>
                <tr><td>
                    <?php echo image_tag('cross.png', array('width' => 16, 'height' => 16, 'align' => 'absmiddle')) ?>
                    <?php echo $e->getMessage() ?>
                </td></tr>
            <?php endforeach; ?>
        </table>
    </div>
    <br/>
<?php endif; ?>

<div class="border">
    <p>
      To set up your database, enter the following information.
    </p>
    
    <form action="<?php echo url_for('@installer_configure') ?>" name="form_database" method="post">
        <table cellspacing="0" cellpadding="0">
            <?php echo $form ?>
        </table>
    </form>
</div>
<br/>
<table cellspacing="0" cellpadding="0" align="right">
    <tr><td><input type="submit" value="<?php echo __('Check and continue') ?>" onclick="form_database.submit()"/></td></tr>
</table>
<br/>