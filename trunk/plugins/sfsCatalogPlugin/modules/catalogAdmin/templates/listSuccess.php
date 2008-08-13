<?php use_helper('I18N', 'Date') ?>
<div id="sf_admin_container">

<h1><?php echo __('Categories/Products') ?></h1>

    <table cellspacing="0" class="sf_admin_list">
        <thead>
            <tr>
                <?php include_partial('productAdmin/list_th_tabular') ?>
               <th id="sf_admin_list_th_sf_actions"><?php echo __('Actions') ?></th>
            </tr>
        </thead>
        <?php include_component('categoryAdmin', 'list', array('item_routing' => 'catalogAdmin/list')); ?>
        <?php include_component('productAdmin', 'list', array('item_routing' => 'catalogAdmin/list')); ?>
    </table>
    <?php include_partial('categoryAdmin/list_actions') ?>
    <?php include_partial('productAdmin/list_actions') ?>
</div>
