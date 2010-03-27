<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>

    <?php include_javascripts()?>
    <?php include_stylesheets()?>
    <link rel="shortcut icon" href="/favicon.ico" />

  </head>
  <body>
    <?php
    //echo javascript_tag('
    //    var status = {
    //        ERROR: ' . sfsJSONPeer::STATUS_ERROR . ',
    //        SUCCESS: ' . sfsJSONPeer::STATUS_SUCCESS . '
    //    };
    //');
    ?>
    <div id="container_loading" style="display: none"><?php echo __('Loading') ?></div>
    <div class="body">
      <div>
        <div class="top_static_menu">
          <?php include_component_slot('header');?>
          <?php include_component('sfsCore', 'selectLanguage'); ?>
          <?php include_component('sfsMenu', 'top'); ?>
        </div>
        <div class="login_menu">
          <?php  if (!$sf_user->isAuthenticated()): ?>
            <?php echo link_to(__('Sign in'),'@sf_guard_signin') ?>
          |
            <?php echo link_to(__('Forgot password?'),'@sf_guard_password') ?> | <?php echo link_to(__('Sign up'),'@sf_guard_signin') ?>
          <?php else: ?>
            <?php echo __('Hello'); ?>, &nbsp;
            <?php echo link_to($sf_user->getUserName(), '@sf_guard_signin'); ?>!
          |
            <?php echo link_to(__('Logout'),'@sf_guard_signout'); ?> &nbsp; &nbsp;
          <?php endif; ?>
        </div>
      </div>
      <div class="head_container">
        <div class="logo_container">
          <div class="logo">
            <?php //echo link_to(image_tag(sfConfig::get('app_sfshop_core_images_dir').'logo.gif', array('width' => 90, 'height' => 53, 'align' => 'absmiddle')), '@homepage') ?>
            <?php //echo link_to('DVD shop','@homepage') ?>
          </div>
        </div>
        <div class="login_container">
          <div class="login_form">
            <?php //include_component('basket', 'basketInfo')?>
          </div>
          <div class="search_form">
            <?php //include_component('product', 'searchShortForm') ?>
          </div>

        </div>
      </div>
      <div class="toolbar_main">
        <div class="corner_left">
          <div class="corner_right">
            <div class="content">
              <div class="menu_main"><?php include_component('sfsMenu', 'main'); ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="column_left">
          <?php //include_component_slot('sidebar') ?>
          <div class="box_separator"></div>
          <?php //include_component('currency', 'selectCurrencyForm'); ?>
        </div>
        <div class="column_center">
          <?php //echo $sf_data->getRaw('sf_content') ?>
        </div>
      </div>
      <div class="menu_bottom">
        <div class="corner_left">
          <div class="corner_right">
            <div class="content"><?php include_component('sfsMenu', 'bottom'); ?></div>
          </div>
        </div>
      </div>
      <div class="copyright">Copyright 2010 &copy; <?php echo link_to('sfShop', 'http://code.google.com/p/sfshop/') ?></div>

      <?php echo $sf_data->getRaw('sf_content') ?>

    </div>
  </body>
</html>