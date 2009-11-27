<h2><?php echo __('Checking server capabilities (step 1 of 3)') ?></h2>
<br/>

<?php if (!$isValidPhpVersion || count($unexistsPhpExtensions) > 0 || count($unwritablePaths) > 0): ?>
    <div class="error">
        <?php if (!$isValidPhpVersion): ?>
            <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'cross.png', array('width' => 16, 'height' => 16, 'align' => 'absmiddle')) ?>
            <?php echo __('The platform is require 5.1 version of PHP or ealier. %version% is installed on this server now.', array('%version%' => phpversion())) ?>
            <br/>
        <?php endif; ?>
        
        <?php if (count($unexistsPhpExtensions) > 0): ?>
            <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'cross.png', array('width' => 16, 'height' => 16, 'align' => 'absmiddle')) ?>
            <?php echo __('Some PHP extensions are not loaded.') ?><br/>
        <?php endif; ?>
        
        <?php if (count($unwritablePaths) > 0): ?>
            <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'cross.png', array('width' => 16, 'height' => 16, 'align' => 'absmiddle')) ?>
            <?php echo __('Please, check and correct permissions for files/directories.') ?>
        <?php endif; ?>
    </div>
    <br/>
<?php else: ?>
    <?php echo __('The webserver environment has been verified to proceed with a successful installation. Please continue to start the installation procedure.') ?><br/>
<?php endif; ?>

<h3><?php echo __('Server capabilities') ?></h3>
<div class="border">
    <table cellspacing="0" cellpadding="0" width="100%">
    <tr><td width="95%"><b><?php echo __('PHP version') ?></b>: <?php echo phpversion() ?></td>
    <td width="5%">
        <?php if ($isValidPhpVersion): ?>
            <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'ok.png', array('width' => 16, 'height' => 16)) ?>
        <?php else: ?>
            <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'bad.png', array('width' => 16, 'height' => 16)) ?>
        <?php endif; ?>
    </td></tr>
    <tr><td colspan="2"><b><?php echo __('Extension') ?>:</b></td></tr>
    
    <?php foreach ($phpExtensions as $extension): ?>
        <tr class="<?php echo in_array($extension, $sf_data->getRaw('unexistsPhpExtensions')) ? 'error' : '' ?>">
            <td width="95%">
                &nbsp; &nbsp; <?php echo $extension ?>
            </td>
            <td width="5%">
                <?php if (in_array($extension, $sf_data->getRaw('unexistsPhpExtensions'))): ?>
                    <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'bad.png', array('width' => 16, 'height' => 16)) ?>
                <?php else: ?>
                    <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'ok.png', array('width' => 16, 'height' => 16)) ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
<br/>
<h3><?php echo __('Writeable directories') ?></h3>
<div class="border">
    <b><?php echo __('The following files/directories need to have their permissions set to world-writeable (chmod 777)') ?>:</b><br/>
    <table cellspacing="0" cellpadding="0" width="100%">
        <?php foreach ($paths as $path): ?>
            <tr class="<?php echo in_array($path, $sf_data->getRaw('unwritablePaths')) ? 'error' : '' ?>"><td width="95%">
                &nbsp; &nbsp; <?php echo $path ?>
            </td>
            <td width="5%">
                <?php if (in_array($path, $sf_data->getRaw('unwritablePaths'))): ?>
                    <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'bad.png', array('width' => 16, 'height' => 16)) ?>
                <?php else: ?>
                    <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'ok.png', array('width' => 16, 'height' => 16)) ?>
                <?php endif; ?>
            </td></tr>
        <?php endforeach; ?>
    </table>
</div>
<br/>
<form action="<?php echo url_for('@installer_index'); ?>" method="post">
    <table cellspacing="0" cellpadding="0" align="right">
        <tr><td><input type="submit" value="<?php echo __('Check and continue') ?>"/></td></tr>
    </table>
</form>
<br/><br/>
