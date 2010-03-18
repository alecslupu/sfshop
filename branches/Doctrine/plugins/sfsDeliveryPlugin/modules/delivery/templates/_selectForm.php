<form action="<?php echo url_for('@delivery_checkout'); ?>" method="post" id="form_delivery" class="form form_services" onsubmit="return false">
    <ul class="services_list">
        <?php $radios = $form['method_id']->render(); $i = 0; ?>
        <li class="row"><?php echo $form['method_id']->renderError() ?></li>
        <?php foreach ($sections as $section): ?>
            <li class="row">
                <?php echo $section['object']->getTitle() ?>
                <?php if ($section['object']->getIcon()): ?>
                    <?php echo image_tag(sfConfig::get('app_delivery_icons_dir') . '/' . $section['object']->getIcon(), array('align' => 'absmiddle')); ?>
                <?php endif; ?>
            </li>
            <li>
            <?php foreach ($section['methods'] as $method): ?>
                <ul class="methods_list">
                    <li class="label"><?php echo $radios[$i]['label'] ?></li>
                    <li class="price"><?php echo format_currency($method['price']+$method['tax']) ?></li>
                    <li><?php echo $radios[$i]['input'] ?>
                </ul>
            <?php $i++; endforeach; ?>
            </li>
        <?php endforeach; ?>
        <li class="actions">
            <input type="submit" value="<?php echo __('Submit') ?>" class="button">
             &nbsp; <input type="button" value="<?php echo __('Cancel') ?>" class="button cancel">
        </li>
    </ul>
</form>