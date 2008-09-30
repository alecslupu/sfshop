<ul class="menu_profile">
    <?php foreach($items as $item): ?>
        <li><?php echo link_to($item->getTitle(), $item->getRoute()); ?></li>
    <?php endforeach; ?>
</ul>