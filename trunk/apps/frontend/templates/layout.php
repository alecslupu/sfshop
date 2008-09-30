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

<div class="body">
    <div>
          <div class="top_static_menu">
              <?php include_component('menu', 'top'); ?>
          </div>
          <div class="login_menu">
              <?php  if (!$sf_user->isAuthenticated()): ?>
                      <?php echo link_to(__('Sign in'),'@member_login') ?>
                      |
                      <?php echo link_to(__('Forgot password'),'@member_forgotPasswordStepOne') ?> | <?php echo link_to(__('Registration'),'@member_registration') ?>
                  
              <?php else: ?>
                  
                      <?php echo __('Hello'); ?>, &nbsp;
                      <?php echo link_to($sf_user->getUserName(), '@member_myProfile'); ?>!
                      |
                      <?php echo link_to(__('Logout'),'@member_logout'); ?> &nbsp; &nbsp;
                  
              <?php endif; ?>
          </div>
    </div>
      <div class="head_container">
        <div class="logo_container">
            <div class="logo">
                <?php echo link_to(image_tag('logo.gif', array('width' => 90, 'height' => 53, 'align' => 'absmiddle')), '@homepage') ?>
                <?php echo link_to(__('DVD shop'),'@homepage') ?>
            </div>
        </div>
        <div class="login_container">
            <div class="login_form">
            </div>
            <div class="search_form">
                <table cellspacing="0" cellpadding="0">
                 <tr>
                  <td width="4" height="37" background="/images/m3.gif"></td>
                  <td width="248" height="37" background="/images/m4.gif" CLASS="ML4-W" style="padding-top: 3px; ">
                  <span  style="padding-RIGHT: 15px; padding-left:5px ">SEARCH</SPAN><input class=se2 type=text value="Search">&nbsp;<a style="padding-left: 11px" href=#><img src=/images/home4_25.gif width=24 height=19 border=0 align=absmiddle></a>
                  </td>
                </tr>
              </table>
            </div>
            
        </div>
    </div>
    <div class="toolbar_main">
        <div class="corner_left">
            <div class="corner_right">
                <div class="content">
                    <div class="menu_main"><?php include_component('menu', 'main'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column_left">
            <?php include_component_slot('sidebar', array('item_routing' => '@product_list')) ?>
            <div class="box_separator"></div>
            <?php include_component('currency', 'selectCurrencyForm'); ?>
        </div>
        <div class="column_center">
            <?php echo $sf_data->getRaw('sf_content') ?>
        </div>
    </div>
    <div class="menu_bottom">
        <div class="corner_left">
            <div class="corner_right">
                <div class="content"><?php include_component('menu', 'bottom'); ?></div>
            </div>
        </div>
    </div>
    <div class="copyright"><?php echo __('Copyright 2008 &copy; %link%', array('%link%' => link_to('sfShop', 'http://www.sfshop.org'))) ?></div>
</div>
</body>
</html>