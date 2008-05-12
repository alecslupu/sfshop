<?php foreach($items as $item): ?>
    <div><?php echo link_to($item->getTitle(), $item->getRoute()); ?></div>
<?php endforeach; ?>