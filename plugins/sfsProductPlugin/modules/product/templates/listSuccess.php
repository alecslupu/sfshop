<?php if (isset($isSearch)): ?>
    <?php include_partial('core/container_header', array('caption' => __('Results by search "%query%"', array('%query%' => $queryString)))) ?>
<?php else: ?>
    <?php include_component('category', 'headerProductList'); ?>
<?php endif; ?>

    <div>
        <?php include_component('brand', 'filterList', array('filter' => $filter)) ?><br/><br/>
    </div>

    <?php if (isset($isSearch)): ?>
        <form action="<?php echo url_for('@product_search'); ?>" method="post" class="form">
            <div>
                <?php echo $formSearch['query']->renderLabel() ?><?php echo $formSearch['query']->render() ?>
                <input type="submit" value="<?php echo __('Search') ?>" class="button"/>
                <?php echo link_to(__('Return to list'), '@product_index') ?>
            </div>
        </form><br/>
        <?php $action = '@product_search' ?>
    <?php else: ?>
        <?php $action = '@product_list' ?>
    <?php endif; ?>
    
    <?php include_partial(
        'list', 
        array(
            'action'    => $action,
            'pager'     => $pager, 
            'is_search' => isset($isSearch) ? true : false
        )
    ) ?>
<?php include_partial('core/container_footer') ?>