<?php echo link_to(
    image_tag(sfConfig::get('app_sfshop_admin_images_dir').'folder.png'), 
    'catalogAdmin/list?path=' . generate_category_path_for_url($category->getPath()),
    array('valign' => 'absmiddle')) ?>&nbsp;
<b><?php echo link_to($category->getTitle(), 'catalogAdmin/list?path=' . generate_category_path_for_url($category->getPath())) ?></b>