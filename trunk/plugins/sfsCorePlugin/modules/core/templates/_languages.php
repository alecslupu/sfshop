<?php if ($languages !== null): ?>
    <?php echo __('Language') ?>:
    <?php foreach ($languages as $language): ?>
        <?php echo link_to(image_tag($language->getNameOwn()), '@core_changeLanguage?culture=' . $language->getCulture()) ?>
    <?php endforeach; ?>
<?php endif; ?>