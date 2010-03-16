<?php if ($languages !== null && count($languages) > 1): ?>
<div class="language-switcher">
    <?php echo __('Language') ?>:
    <?php foreach ($languages as $language): ?>
        <?php echo link_to(
            image_tag(
                $language->getIconUrl(),
                array(
                    'title' => $language->getTitleOwn(),
                    'alt'   => $language->getTitleOwn(),
                    'align' => 'absmiddle'
                )
            ), 
            '@core_changeLanguage?culture=' . $language->getCulture()
        , array('class' => $sf_user->getCulture() == $language->getCulture() ? 'current' : '')) ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>