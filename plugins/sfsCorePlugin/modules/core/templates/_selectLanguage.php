<?php if ($languages !== null && count($languages) > 1): ?>
    <?php echo __('Language') ?>:
    <?php foreach ($languages as $language): ?>
        <?php echo link_to(language_icon($language), '@core_changeLanguage?culture=' . $language->getCulture()) ?>
    <?php endforeach; ?>
<?php endif; ?>