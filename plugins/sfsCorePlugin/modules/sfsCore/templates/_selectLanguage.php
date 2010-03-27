<?php if ($languages !== null && count($languages) > 1): ?>
<div class="language-switcher">
    <?php echo __('Language', array(), 'sfsCorePlugin') ?>:
    <?php foreach ($languages as $language): ?>
        <?php echo link_to(
            image_tag(
                $language->getIconUrl(),
                array(
                    'title' => $language->getTitle(),
                    'alt'   => $language->getTitle(),
                    'align' => 'absmiddle'
                )
            ), 
            '@core_changeLanguage?culture=' . $language->getCulture()
        , array('class' => $sf_user->getCulture() == $language->getCulture() ? 'current' : '')) ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>