<ul class="menu_profile">
    <?php foreach($items as $item): ?>
        <li><?php echo image_tag('arr22.gif') ?> &nbsp; <?php echo link_to($item->getTitle(), $item->getRoute()); ?></li>
    <?php endforeach; ?>
</ul>