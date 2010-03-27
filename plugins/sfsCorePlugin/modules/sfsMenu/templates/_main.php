<?php foreach($items as $key => $item): ?>
    <?php echo link_to($item->getTitle(), $item->getRoute()); ?>
    <?php if ($key < count($items)-1): ?>
         &nbsp;|&nbsp;
    <?php endif; ?>
<?php endforeach; ?>