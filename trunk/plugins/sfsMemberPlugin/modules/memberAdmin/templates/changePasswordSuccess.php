<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1>Change password for member &ldquo;<?php echo $member->getFullName(); ?>&rdquo;</h1>

<div id="sf_admin_header">
<?php include_partial('memberAdmin/edit_header', array('member' => $member->getId())) ?>
</div>

<div id="sf_admin_content">


<?php echo form_tag('memberAdmin/changePassword', array(
    'id'        => 'sf_admin_change_password_form',
    'name'      => 'sf_admin_change_password_form',
    'multipart' => true,
    'method'    => 'post'
)); ?>

<?php echo input_hidden_tag('id', $member->getId()); ?>
<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('member[password]', __('Password: '), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('member{password}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('member{password}')): ?>
    <?php echo form_error('member{password}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php echo input_tag('member[password]', '', array ('size' => 80,)); ?>
  
  <div class="sf_admin_edit_help"><?php echo __('New password for member') ?></div>  </div>
</div>


</fieldset>




<ul class="sf_admin_actions">
    <li><?php echo button_to(__('list'), 'memberAdmin/list?id='.$member->getId(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
    <li><?php echo submit_tag(__('save'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
</ul>










</form>





</div>

<div id="sf_admin_footer">
<?php include_partial('memberAdmin/edit_footer', array('member' => $member)) ?>
</div>

</div>
