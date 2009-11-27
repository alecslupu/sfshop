<?php foreach($items as $index => $item): ?>
    <?php echo ($index == 0 ? '' : '  |  ') . link_to($item->getTitle(), $item->getRoute()); ?>
<?php endforeach; ?>