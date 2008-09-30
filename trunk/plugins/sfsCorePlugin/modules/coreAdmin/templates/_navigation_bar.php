<?php $menu = $sf_user->getMenu(); ?>
<?php $submenu = array(); ?>


<?php if (count($menu) > 0): ?>
    <div class="menu">
        <ul>
            <?php foreach ($menu as $menuItem): ?>
                <?php if ($menuItem['is_current']): ?>
                    <?php $submenu = $menuItem['subitems']; ?>
                <?php endif; ?>
                <li><?php echo link_to(
                    $menuItem['title'],
                    $menuItem['route'],
                    ($menuItem['is_current'] ? array('style' => 'color: #bababa;') : array())
                ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div style="clear: both">
            <?php if (count($submenu) > 0): ?>
            <ul class="submenu">
                <?php foreach ($submenu as $submenuItem): ?>
                    <li><?php echo link_to(
                        $submenuItem['title'],
                        $submenuItem['route'],
                        ($submenuItem['is_current'] ? array('style' => 'color: #bababa;') : array())
                    ); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<div style="clear: both"></div>
