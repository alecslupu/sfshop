<table cellspacing="0" cellpadding="0" class="sf_admin_list" width="100%">
    <thead>
        <tr>
            <th><?php echo __('Types') ?></th>
            <th><?php echo __('Values') ?></th>
        </tr>
    </thead>
<?php foreach ($optionTypes as $optionType): ?>
        <tr>
            <td>
                <b><?php echo $optionType->getTitle() ?></b>
            </td>
            <td>
                <table cellspacing="0" cellpadding="0" class="sf_admin_list" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo __('Is used') ?>?</th>
                            <th><?php echo __('Title') ?></th>
                            <th><?php echo __('Price') ?></th>
                            <th><?php echo __('Prefix') ?></th>
                        </tr>
                    </thead>
                    <?php foreach ($optionValues[$optionType->getId()] as $optionValue): ?>
                        <?php $price = '';
                            $checked = false;
                            $checkedValue = 0;
                            $prefix = '';
                        ?>
                        
                        <?php foreach ($productOptions as $productOption): ?>
                            <?php if ($optionValue->getId() == $productOption->getOptionValueId()): ?>
                                <?php $price = $productOption->getPrice();
                                    $checked = true;
                                    $checkedValue = 1;
                                ?>
                                
                                <?php if ($price > 0): ?>
                                    <?php $prefix = 'plus' ?>
                                <?php else: ?>
                                    <?php $prefix = 'minus';
                                    $price = $price * (-1);
                                     ?>
                                <?php endif; ?>
                                
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <tr>
                        <td><?php echo checkbox_tag('product[options][' . $optionValue->getId() . '][is_used]', $checkedValue, $checked) ?></td>
                        <td width="50%">
                            <?php echo $optionValue->getTitle() ?>
                        </td>
                        <td>
                            <?php echo input_tag('product[options][' . $optionValue->getId() . '][price]', $price, array('size' => 7)) ?>
                        </td>
                        <td>
                            <?php echo select_tag(
                                'product[options][' . $optionValue->getId() . '][prefix]', 
                                options_for_select(array('plus' => '+', 'minus' => '-'), $prefix),
                                array('style' => 'width: 35px')
                            ) ?>
                        </td>
                     </tr>
                     <?php endforeach; ?>
                     <tr>
                         <td colspan="4">
                             <ul class="sf_admin_actions">
                                 <li>
                                    <?php echo button_to_function(
                                        __('Add new value'), 
                                       'addNewOptionValue(' . $optionType->getId() . ', this)', 
                                        array('class' => 'sf_admin_action_create'
                                     )) ?>
                                 </li>
                             </ul>
                         </td>
                     </tr>
                 </table>
            </td>
        </tr>
<?php endforeach; ?>
</table>