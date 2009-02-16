<?php use_helper('sfsCategory') ?>
<h3><?php echo __('Categories') ?></h3>
<div style="padding-right: 10px; width: 230px">
    <?php echo admin_draw_categories_tree($parentTree, $item_routing) ?>
</div>
<div>
    <ul class="sf_admin_actions">
      <li><?php echo button_to(__('create'), 'categoryAdmin/create', array (
      'class' => 'sf_admin_action_create',
    )) ?></li>
      <?php if (isset($currentCategoryId)): ?>
          <li><?php echo button_to(__('edit'), 'categoryAdmin/edit?id=' . $currentCategoryId, array (
          'class' => 'sf_admin_action_save',
        )) ?></li>
          <li><?php echo button_to(__('delete'), 'categoryAdmin/delete?id=' . $currentCategoryId, array (
          'class' => 'sf_admin_action_delete',
        )) ?></li>
    <?php endif; ?>
    </ul>
</div>