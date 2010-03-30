<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

function draw_categories_tree($parentTree = array(), $routing, $arrow = '')
{
    $criteria = new Criteria();
    CategoryPeer::addPublicCriteria($criteria);
    $categories = CategoryPeer::getFirstLevel($criteria);
    $currentCategoryId = get_current_category_id();
    
    if ($categories !== null) {
        
        $categoriesTree = array();
        get_categories_tree($categories, $categoriesTree, $parentTree, $criteria, false);
        
        $list = '<ul class="categories_tree">';
        
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
            
            $list.= '<li>' . $seperator . $arrow . '&nbsp;' . link_to($title, $routing . '?path='.$category['path']) . '</li>';
        }
        
        $list.='</ul>';
        
        return $list;
    }
}

function admin_draw_categories_tree($parentTree = array(), $routing)
{
    $criteria = new Criteria();
    CategoryPeer::addAdminCriteria($criteria);
    $categories = CategoryPeer::getFirstLevel(clone $criteria);
    
    if ($categories !== null) {
        
        $currentCategoryId = get_current_category_id();
        $categoriesTree = array();
        get_categories_tree($categories, $categoriesTree, $parentTree, $criteria, true);
        
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
            
            $list.= $seperator . '&nbsp;' . link_to($title, $routing . '?path='.$category['path']).'<br />';
        }
        
        return $list;
    }
}

function get_categories_tree_for_select($rmBranchOfCurrentCategory = true, $emptyCategory = false)
{
    $criteria = new Criteria();
    CategoryPeer::addAdminCriteria($criteria);
    $categories = CategoryPeer::getFirstLevel(clone $criteria);
    
    if ($categories !== null) {
        
        $categoriesTree = array();
        get_categories_tree($categories, $categoriesTree, array(), $criteria, true, $rmBranchOfCurrentCategory);
        
        $list = array();
        
        if($emptyCategory) {
            $list[0] = '';
        }
        
        foreach ($categoriesTree as $category) {
            
            $seperator = '';
            $i = $category['level'];
            
            while ($i > 1) {
                $seperator.= '---';
                $i--;
            }
            
            $list[$category['id']] = $seperator . $category['title'];
        }
        
        return $list;
    }
}

function get_categories_tree($categories, &$array, $parentTree = array(), $criteria = null, $openedTree = false, $rmBranchOfCurrentCategory = false)
{
    if ($categories !== null) {
        foreach ($categories as $category) {
            
            $path = generate_category_path_for_url($category->getPath());
            $level = get_level_category($path);
            
            $array[] = array(
                'title' => sfsStringPeer::special($category->getTitle()),
                'id'    => $category->getId(),
                'level' => $level,
                'path'  => $path
            );
            
            if ($openedTree) {
                $request = sfContext::getInstance()->getRequest();
                
                if ($category->getId() == $request->getParameter('id') && $rmBranchOfCurrentCategory == true) {
                    unset($array[count($array)-1]);
                }
                else {
                    get_categories_tree($category->getChild($criteria, true), $array, $parentTree, $criteria, $openedTree, $rmBranchOfCurrentCategory);
                }
            }
            else {
                if (count($parentTree) > 0) {
                    foreach ($parentTree as $parentCategory) {
                        if ($parentCategory->getId() == $category->getId()) {
                            get_categories_tree($category->getChild($criteria, true), $array, $parentTree, $criteria, $openedTree, $rmBranchOfCurrentCategory);
                        }
                    }
                }
            }
        }
    }
}

function get_level_category($path)
{
    $ids = explode(sfConfig::get('app_category_url_separator', '_'), $path);
    
    if (is_array($ids)) {
        $level = count($ids);
    }
    else {
        $level = 1;
    }
    
    return $level;
}

function get_current_category_id()
{
    $request = sfContext::getInstance()->getRequest();
    
    if ($request->hasParameter('path')) {
        $c = explode(sfConfig::get('app_category_url_separator', '_'), $request->getParameter('path'));
        return $c[count($c)-1];
    }
    else {
        return false;
    }
}

function generate_category_path_for_url($path)
{
    return str_replace(',', sfConfig::get('app_category_url_separator', '_'), $path);
}

?>