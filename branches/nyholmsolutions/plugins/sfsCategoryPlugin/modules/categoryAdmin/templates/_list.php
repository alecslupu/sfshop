<?php use_helper('sfsCategory') ?>

<?php if (isset($parentCategory) && $parentCategory !== null): ?>
    <tr>
        <td colspan="6">
            <?php echo link_to(image_tag(sfConfig::get('app_sfshop_admin_images_dir').'go-up.png') . __('Up on one level'), 'catalogAdmin/list?path=' .generate_category_path_for_url($parentCategory->getPath())) ?>
        </td>
    </tr>
<?php endif; ?>

<?php if (count($categories) > 0): ?>
    <?php foreach ($categories as $category): ?>
        <tr>
            <?php include_partial('categoryAdmin/list_td_tabular', array('category' => $category)) ?>
            <?php include_partial('categoryAdmin/list_td_actions', array('category' => $category)) ?>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>