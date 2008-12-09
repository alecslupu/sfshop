<?php if (!$language->isNew() && file_exists($language->getIconPath())): ?>
    <?php echo image_tag('http://' . sfContext::getInstance()->getRequest()->getHost() . $language->getIconUrl()) ?><br/>
<?php endif; ?>

<?php echo input_file_tag('language[icon]'); ?>
