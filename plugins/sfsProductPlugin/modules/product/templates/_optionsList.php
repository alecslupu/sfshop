<?php if (isset($optionsValues)): ?><br/>
    <?php foreach ($optionsValues as $value): ?>
        <?php echo $value->getOptionType()->getTitle() ?>: <?php echo $value->getTitle() ?><br/>
    <?php endforeach; ?>
<?php endif; ?>