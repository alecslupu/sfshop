<?php include_partial('core/container_header', array('caption' => __('Order delivery methods'))) ?>
    
    <?php if (isset($errors)): ?>
        <ul class="error" style="width: 100%">
            <?php foreach ($errors as $error): ?>
                 <li><?php echo $error ?><li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    
    <form action="<?php echo url_for('@delivery_checkout'); ?>" method="post" class="form form_services">
        <ul class="services_list">
            <?php $radios = $form['method_id']->render(); $i = 0; ?>
            <li class="row"><?php echo $form['method_id']->renderError() ?></li>
            <?php foreach ($sections as $section): ?>
                <li class="row">
                    <?php echo $section['object']->getTitle() ?>
                    <?php if ($section['object']->getIcon()): ?>
                        <?php echo image_tag(sfConfig::get('app_icons_delivery_web_dir') . '/' . $section['object']->getIcon(), array('align' => 'absmiddle')); ?>
                    <?php endif; ?>
                </li>
                <li>
                <?php foreach ($section['methods'] as $method): ?>
                    <ul class="methods_list">
                        <li class="label"><?php echo $radios[$i]['label'] ?></li>
                        <li class="price"><?php echo format_currency($method['price']) ?></li>
                        <li><?php echo $radios[$i]['input'] ?>
                    </ul>
                <?php $i++; endforeach; ?>
                </li>
            <?php endforeach; ?>
            
        </ul>
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td><?php echo button_to(__('Back'), '@basket_list', array('class' => 'button')) ?></td>
                <td align="right"><input type="submit" value="<?php echo __('Continue') ?>" class="button"></td>
            </tr>
        </table>
    </form>
<?php include_partial('core/container_footer') ?>