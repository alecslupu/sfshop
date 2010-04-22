<!-- Aside (Left Column) -->
<div id="aside" class="box">

  <div class="padding box">

    <!-- Logo (Max. width = 200px) -->
    <p id="logo">
      <a href="http://www.sfshop.net/" target="blank" title="<?php echo __('sfShop website', array(), 'sfsCoreAdminPlugin');?>">
        <img src="/sfsCoreAdminPlugin/images/logo.gif"  alt="<?php echo __('sfShop', array(), 'sfsCoreAdminPlugin');?>" title="<?php echo __('Visit Site', array(), 'sfsCoreAdminPlugin')?>"/>
      </a>
    </p>

    <?php include_component("sfsCoreAdminLayout","search"); ?>

    <!-- Create a new project -->
    <p id="btn-create" class="box"><a href="#"><span>Create a new project</span></a></p>

  </div> <!-- /padding -->

  <ul class="box">
    <li><a href="#">Lorem ipsum</a></li>
    <li><a href="#">Lorem ipsum</a></li>
    <li><a href="#">Lorem ipsum</a></li>
    <li id="submenu-active"><a href="#">Active Page</a> <!-- Active -->

      <ul>
        <li><a href="#">Lorem ipsum</a></li>
        <li><a href="#">Lorem ipsum</a></li>
        <li><a href="#">Lorem ipsum</a></li>
        <li><a href="#">Lorem ipsum</a></li>
        <li><a href="#">Lorem ipsum</a></li>

      </ul>
    </li>
    <li><a href="#">Lorem ipsum</a></li>
    <li><a href="#">Lorem ipsum</a>
      <ul>
        <li><a href="#">Lorem ipsum</a></li>
        <li><a href="#">Lorem ipsum</a></li>

        <li><a href="#">Lorem ipsum</a></li>
      </ul>
    </li>
    <li><a href="#">Lorem ipsum</a></li>
  </ul>

</div> <!-- /aside -->