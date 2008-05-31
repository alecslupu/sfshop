<ul class="menu_profile">
    <?php foreach($items as $item): ?>
        <li><?php echo image_tag('mark.gif', array('width' => 15, 'height' => 15, 'align' => 'absmiddle')) ?> <?php echo link_to($item->getTitle(), $item->getRoute()); ?></li>
    <?php endforeach; ?>
</ul>