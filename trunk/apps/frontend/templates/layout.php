<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>

<body>
<div class="main">
    <div class="main_center">
        <div class="header_top_line">
            <div class="members_links">
               <div class="languages">
                   <?php include_component('core', 'languages') ?>
               </div>
               <?php  if (!$sf_user->isAuthenticated()): ?>
                  <div class="login_link">
                    <?php echo link_to(__('Sign in'),'@members_login') ?>
                    | <?php echo link_to(__('Forgot password'),'@members_forgotPasswordStepOne') ?> | <?php echo link_to(__('Registration'),'@members_registration') ?>
                  </div>
              <?php else: ?>
                <div>
                  <?php echo __('Hello'); ?>, &nbsp;
                  <?php echo link_to($sf_user->getMemberName(),'@members_myProfile'); ?>! |
                  <?php echo link_to(__('Logout'),'@members_logout'); ?> &nbsp; &nbsp;
                </div>
              <?php endif; ?>
            </div>
            <div class="logo"><?php echo link_to('<img src="/images/logo.jpg" width="79" height="43" border="0"/>','@homepage') ?></div>
            <div class="search_form">
                <div class="search_input_text">
                    <input type="text" name="query"/>
                    
                </div>
                <div class="search_button"><input type="image" name="search" src="/images/search.jpg" class="btn_search"/>
                </div>
            </div>
        </div> 
        <div class="menu">
            <?php include_component('menu', 'main') ?>
        </div>
        <div class="line1"><?php //include_component_slot('sidebar') ?></div>
        <div class="line2">&nbsp;</div>
        <div style="padding: 1px 10px 10px 10px; background: #FFFFFF">
            <?php echo $sf_data->getRaw('sf_content') ?>
        </div>
         <div class="footer">
           <div class="footer_line"><img src="/images/big_line_1.gif" width="2" height="1"></div>
           <div class="footer_block1">
              <div class="footer_block2"><div class="footer_content"><a href="index.html">sfShop</a></div></div>
           </div>
           <div class="footer_line"><img src="/images/big_line_1.gif" width="2" height="1"></div>
         </div>
   </div>
</div>
</body>
</html>

