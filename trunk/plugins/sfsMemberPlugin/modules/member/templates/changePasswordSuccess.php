<?php include_partial('core/container_header', array('caption' => __('Edit profile'))) ?>
    <form action="<?php echo url_for('@member_changePassword'); ?>" method="post" class="form" id="form_change_password">
      <ul class="main">
          <?php echo $form ?>
          <li class="actions">
              <input type="submit" value="<?php echo __('Save') ?>" class="button"/>&nbsp;<input type="button" value="<?php echo __('Cancel') ?>" class="button" onclick="window.location='<?php echo url_for('@member_myProfile') ?>'"/>
          </li>
      </ul>
    </form>
<?php include_partial('core/container_footer') ?>
<?php echo javascript_tag('
    highlightFieldsWithError("form_change_password");
') ?>
