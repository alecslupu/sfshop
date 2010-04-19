<!-- Tray -->
<div id="tray" class="box">

  <p class="f-left box">

    <!-- Switcher -->
    <span class="f-left" id="switcher">
      <a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="design/switcher-1col.gif" alt="1 Column" /></a>

      <a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="design/switcher-2col.gif" alt="2 Columns" /></a>
    </span>

    Project: <strong>Your Project</strong>

  </p>

  <p class="f-right"><?php echo __('User', array(), 'sfsCoreAdminPlugin')?>:
    <strong><a href="#"><?php echo $sf_user->getUserName() ?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <strong><?php echo link_to(__('Log out', array(), 'sfsCoreAdminPlugin'), '@sf_guard_signout', array("id"=>"logout"))?></strong>
  </p>

</div> <!--  /tray -->
