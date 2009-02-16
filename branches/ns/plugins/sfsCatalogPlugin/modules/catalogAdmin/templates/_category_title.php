<?php echo link_to(
    image_tag('folder.png'), 
    'catalogAdmin/list?path=' . generate_category_path_for_url($category->getPath()),
    array('valign' => 'absmiddle')) ?>&nbsp;
<b><?php echo link_to($category->getTitle(), 'catalogAdmin/list?path=' . generate_category_path_for_url($category->getPath())) ?></b>