
<?php use_stylesheet('/sfPropelPlugin/css/global.css', 'first') ?> 
<?php use_stylesheet('/sfPropelPlugin/css/default.css', 'first') ?> 

<?php use_helper('I18N', 'Date') ?>
<div id="sf_admin_container">
    
    <h1><?php echo __('Categories/Products') ?></h1>
    
    <?php if ($sf_user->hasFlash('notice')): ?>
        <div class="save-ok">
            <h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
        </div>
    <?php endif; ?>
    
    <table cellspacing="0" class="sf_admin_list">
        <thead>
            <tr>
                <?php include_partial('categoryAdmin/list_th_tabular', array('sort' => $sort)) ?>
                <th id="sf_admin_list_th_sf_actions"><?php echo __('Actions') ?></th>
            </tr>
        </thead>
        <?php include_component('categoryAdmin', 'list', array('item_routing' => 'catalogAdmin/list')); ?>
        <?php include_component('productAdmin', 'list', array('item_routing' => 'catalogAdmin/list')); ?>
    </table>
    
    <ul class="sf_admin_actions">
        <li><?php echo button_to(__('Create product'), 'productAdmin/new' . $path, array('class' => 'sf_admin_action_create')) ?></li>
        <li>&nbsp;<?php echo button_to(__('Create category'), 'categoryAdmin/new' . $path, array('class' => 'sf_admin_action_create')) ?></li>
    </ul>
</div>
