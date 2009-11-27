<div class="<?php echo $class ?>">
    <div style="padding-left: 120px; padding-top: 5px">
        <?php if (!$form->getObject()->isNew() && file_exists($form->getObject()->getIconPath())): ?>
            <?php echo image_tag('http://' . sfContext::getInstance()->getRequest()->getHost() . $form->getObject()->getIconUrl()) ?><br/>
        <?php endif; ?>
    </div>
</div>
