<?php include_partial('core/container_header', array('caption' => __('My orders'))) ?>
    <div class="content_block">
        <?php if ($pager->getNbResults()): ?>
            <div>
                <?php include_partial('my_list', array('pager' => $pager)) ?>
            </div>
        <?php else: ?>
            <div style="width: 100%; text-align: center">
                <?php echo __('no results') ?>
                <br/>
            </div>
        <?php endif; ?><br/>
    </div>
<?php include_partial('core/container_footer') ?>