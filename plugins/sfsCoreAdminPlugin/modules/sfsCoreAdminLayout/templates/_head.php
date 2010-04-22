<!-- Tray -->
<div id="tray" class="box">
  <p class="f-left box">
    <!-- Switcher -->
    <span class="f-left" id="switcher">
      <a href="#" rel="1col" class="styleswitch ico-col1" title="<?php echo __('Display one column', array(), 'sfsCoreAdminPlugin')?>"><img src="/sfsCoreAdminPlugin/images/switcher-1col.gif" alt="<?php echo __('1 Column', array(), 'sfsCoreAdminPlugin')?>" /></a>
      <a href="#" rel="2col" class="styleswitch ico-col2" title="<?php echo __('Display two columns', array(), 'sfsCoreAdminPlugin')?>"><img src="/sfsCoreAdminPlugin/images/switcher-2col.gif" alt="<?php echo __('2 Columns', array(), 'sfsCoreAdminPlugin')?>" /></a>
    </span>

    <?php echo __('Project', array(), 'sfsCoreAdminPlugin');?>: <strong>Your Project</strong>

  </p>

  <p class="f-right"><?php echo __('User', array(), 'sfsCoreAdminPlugin')?>:
    <strong><a href="#"><?php echo $sf_user->getUserName() ?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <strong><?php echo link_to(__('Log out', array(), 'sfsCoreAdminPlugin'), '@sf_guard_signout', array("id"=>"logout"))?></strong>
  </p>

</div> <!--  /tray -->
