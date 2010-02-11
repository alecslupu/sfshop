<h2><?php echo __('Successfully installed (step 3 of 3)') ?></h2><br/>
<div class="border">
    <?php echo __('The installation and configuration was successful!') ?><br/>
    <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'exclamation.png', array('width' => 16, 'height' => 16, 'align' => 'absmiddle')) ?>
    <span class="notify"><?php echo __('Installation directory exists at: <b>%path%</b>. Please remove this directory for security reasons.', 
        array('%path%' => sfConfig::get('sf_web_dir') . '/install')
    ) ?></span><br/>
    <?php echo image_tag(sfConfig::get('app_sfshop_install_images_dir').'exclamation.png', array('width' => 16, 'height' => 16, 'align' => 'absmiddle')) ?>
    <span class="notify"><?php echo __('Please set the right user permissions on following files <b>%files%</b>', 
        array('%files%' => sfConfig::get('sf_config_dir') . '/databases.yml, ' . sfConfig::get('sf_config_dir') . '/propel.ini')
    ) ?></span>
    <br/><br/>
    <h3><?php echo __('Data for login in the Admin panel') ?></h3>
    <b><?php echo __('Login') ?>:</b> admin@localhost<br/>
    <b><?php echo __('Password') ?>:</b> superadmin<br/><br/>
    <div align="center">
        <?php echo link_to('Catalog', str_replace('/install/', '', url_for('@homepage', true)), array('target' => '_blank')) ?> &nbsp; &nbsp; &nbsp;
        <?php echo link_to('Admin panel', str_replace('/install/', '/admin/', url_for('@coreAdmin_index', true)), array('target' => '_blank')) ?>
    </div>
</div>
