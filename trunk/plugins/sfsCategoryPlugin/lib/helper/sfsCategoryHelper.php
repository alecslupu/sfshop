<?php
/*
function getCategoriesSelectOptions($categories, $selectedCategoryId = 0)
{
    if (!empty($categories)) {
        $options = '';

        foreach ($categories as $category) {

            if ($category->getId() == $selectedCategoryId) {
                $selected = '\'selected\'=\'selected\'';
            }
            else {
                $selected = '';
            }
            
            $options.= '<option value=\''.$category->getId().'\' '.$selected.'>'.$category->getTitle().'</option>';
        }
        return $options;
    
    }
}

function getCategoriesTreeForAsset($categories)
{
    if (!empty($categories)) {
        $categoriesTree = array();

        $list = '';
        $level = count($categories);
        $z = $level;

        foreach ($categories as $category) {

            $i = $z;
            $title = '';

            while ($level - $i > 0) {
                $title.= sfConfig::get('app_category_separator', '&nbsp;&nbsp;');
                $i++;
            }

            $z--;
            
            $title.= $category->getTitle();
            $list.= $title.'<br />';
        }

        return $list;
    }
}
*/
function drawCategoriesMenuTree($categories, $parentTree, $currentCategoryId = 0, $cPath, $routing)
{
    if ($categories !== null) {
        
        $categoriesTree = array();
        getCategoriesTree($categories, $categoriesTree, $currentCategoryId, 0, '', $parentTree);
        
        $list = '';
        
        foreach ($categoriesTree as $category) {
            
            $seperator = '';
            $i = $category['level'];
            
            while ($i > 1) {
                $seperator.= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $i--;
            }
            
            if ($currentCategoryId == $category['id']) {
                $title = '<b>' . $category['title'] . '</b>';
            }
            else {
                $title = $category['title'];
            }
            
            $list.= $seperator . image_tag('m11.gif'). '&nbsp;' . link_to($title, $routing . '?cPath='.$category['cPath']).'<br />';
        }
        
        return $list;
    }
}

function getCategoriesTree($categories, &$array, $currentCategoryId = 0, $parentId = 0, $cPath = '', $parentTree = array())
{
    if ($parentId != 0) {
        $cPath.= $parentId . sfConfig::get('app_categories_url_separator','_'); 
    }
    
    if ($categories !== null) {
        foreach ($categories as $category) {
            
            $newcPath = $cPath . $category->getId();
            
            if ($category->getId() == $currentCategoryId) {
                $selected = true;
            }
            else {
                $selected = false;
            }
            
            $level = getLevelCatalog($cPath);
            
            $array[]=array(
                'title'    => $category->getTitle(),
                'id'       => $category->getId(),
                'selected' => $selected,
                'level'    => $level,
                'cPath'    => $newcPath);
            
            if ($parentTree !== null) {
                foreach ($parentTree as $parentCategory) {
                    if ($parentCategory->getId() == $category->getId()) {
                        getCategoriesTree($category->getChild(), $array, $currentCategoryId, $category->getId(), $cPath, $parentTree);
                    }
                }
            }
        }
    }
}

function getLevelCatalog($cPath)
{
    $ids   = explode(sfConfig::get('app_category_url_separator','_'), $cPath);
    
    if (is_array($ids)) {
        $level = count($ids);
    }
    else {
        $level = 1;
    }
    
    return $level;
}

function getCurrentCategoryId()
{
    $request = sfContext::getInstance()->getRequest();
    
    if ($request->hasParameter('cPath')) {
        $c = explode(sfConfig::get('app_category_url_separator', '_'), $request->getParameter('cPath'));
        return $c[count($c)-1];
    }
    else {
        return false;
    }
}
/*
function getChildSelectCategories($category)
{
    if (is_object($category)) {
        $parentTree = $category->getParentTree();
        $i = 1;
        foreach ($parentTree as $childCategory) { 
            if (count($parentTree) > $i) {
                echo select_tag('child_categories_' . $i, 
                                getCategoriesSelectOptions($childCategory->getChildCategories(), $parentTree[$i]->getId()), 
                                array('id' => 'child_categories_' . $i,
                                      'onchange' => 'getSelectChildCategories(\'child_categories_'. $i.'\',\''.url_for('@getChildCategories').'\')', 
                                      'size' => 10));
            }

            $i++;
        }

        $childCategories = $category->getChildCategories();

        if (count($childCategories) > 0) {
                        echo select_tag('child_categories_' . $i, 
                                getCategoriesSelectOptions($childCategories), 
                                array('id' => 'child_categories_' . $i,
                                      'onchange' => 'getSelectChildCategories(\'child_categories_'. $i.'\',\''.url_for('@getChildCategories').'\')',
                                      'style' => 'padding-left: 2px', 
                                      'size' => 10));
        }
    }
}
*/
?>