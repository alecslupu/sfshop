<?php if (count($brands) > 0): ?>
    
    <?php if ($sf_request->hasParameter('is_search')): ?>
        <?php $action = '@product_search' ?>
    <?php else: ?>
        <?php $action = '@product_list' ?>
    <?php endif; ?>
    
    <?php if ($sf_request->hasParameter('path')): ?>
        <?php $path = '?path=' . $sf_request->getParameter('path') ?>
    <?php else: ?>
       <?php $path = '' ?>
    <?php endif; ?>
    
    <b><?php echo __('Filter by brand') ?>:</b> 
    
    <?php $link = link_to(
        __('All'), 
        url_for($action . $path, true) . '?filters[brand_id]=all&filter=filter', 
        array('post' => true)
    ) ?>
    
    <?php if (!isset($filter['brand_id'])): ?>
        <b><?php echo $link ?></b>
    <?php else: ?>
        <?php echo $link ?>
    <?php endif; ?>
    
    <?php foreach ($brands as $brand): ?>
        
        <?php $link = link_to(
            $brand->getTitle(), 
            url_for($action . $path, true) . '?filters[brand_id]=' . $brand->getId() . '&filter=filter', 
            array('post' => true)
        ) ?>
        
        <?php if (isset($filter['brand_id']) && $brand->getId() == $filter['brand_id']): ?>
            <b><?php echo $link ?></b>
        <?php else: ?>
            <?php echo $link ?>
        <?php endif; ?>
    <?php endforeach; ?>

<?php endif; ?>
