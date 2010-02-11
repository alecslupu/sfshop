<?php if ($category !== null): ?>
    <?php include_partial('core/container_header', array('caption' => $category->getTitle())) ?>
<?php else: ?>
    <?php include_partial('core/container_header', array('caption' => __('Products'))) ?>
<?php endif; ?>