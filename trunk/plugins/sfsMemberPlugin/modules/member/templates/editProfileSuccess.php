<?php include_partial('core/container_header', array('caption' => __('Edit profile'))) ?>
    <form action="<?php echo url_for('@member_editProfile'); ?>" method="post" class="form">
      <ul class="main">
          <?php echo $form ?>
          <li class="button">
              <input type="submit" value="<?php echo __('Save') ?>" class="button"/>&nbsp;<input type="button" value="<?php echo __('Cancel') ?>" class="button" onclick="window.location='<?php echo $sf_request->getReferer() ?>'"/>
          </li>
      </ul>
    </form>
<?php include_partial('core/container_footer') ?>
