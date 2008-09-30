<form action="<?php echo url_for('deliveryAdmin/edit?id=' . $sf_request->getParameter('id')); ?>" method="post" class="form">
    <fieldset>
        <?php echo $form ?>
    </fieldset>
    <ul class="sf_admin_actions">
        <li><?php echo button_to(__('list'), 'deliveryAdmin/list?id=' . $delivery->getId(), array (
      'class' => 'sf_admin_action_list',
    )) ?></li>
        <li><?php echo submit_tag(__('save'), array (
      'name' => 'save',
      'class' => 'sf_admin_action_save',
    )) ?></li>
    </ul>
</form>
<ul class="sf_admin_actions">
      <li class="float-left">
      <?php if ($delivery->getId()): ?>
        <?php echo button_to(__('delete'), 'deliveryAdmin/delete?id=' . $delivery->getId(), array (
          'post' => true,
          'confirm' => __('Are you sure?'),
          'class' => 'sf_admin_action_delete',
        )) ?>
    <?php endif; ?>
    </li>
</ul>
<?php echo javascript_tag('
    highlightFieldsWithError();
') ?>
