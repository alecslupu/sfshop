<?php use_helper('Form'); ?>
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
                            <th><?php echo __('Price') ?> (<?php echo __('Net') ?>)</th>
                            <?php if(sfConfig::get('app_tax_is_enabled',false)): ?>
                              <th><?php echo __('Price') ?> (<?php echo __('Gross') ?>)</th>
                            <?php endif; ?>
                            <th><?php echo __('Prefix') ?></th>
                            <th><?php echo __('Quantity') ?></th>
                        </tr>
                    </thead>
                    <?php foreach ($optionValues[$optionType->getId()] as $optionValue): ?>
                        <?php 
                            $price_net = 0;
                            $price_gross = 0;
                            $checked = false;
                            $checkedValue = 0;
                            $prefix = '';
                            $quantity = null;
                        ?>
                        
                        <?php foreach ($productOptions as $productOption): ?>
                            <?php if ($optionValue->getId() == $productOption->getOptionValueId()): ?>
                                <?php $price_net = $productOption->getNetPrice();
                                      $price_gross = $productOption->getGrossPrice();
                                    $checked = true;
                                    $checkedValue = 1;
                                    $quantity = $productOption->getQuantity();
                                ?>
                                
                                <?php if ($price_net >= 0): ?>
                                    <?php $prefix = 'plus' ?>
                                <?php else: ?>
                                    <?php $prefix = 'minus';
                                    $price_net = $price_gross * (-1);
                                    $price_gross = $price_gross * (-1);
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
                            <?php echo input_tag('product[options][' . $optionValue->getId() . '][price]', $price_net, array('size' => 7,'class' => 'product_price','onkeyup' => 'updateGrossPrice(\'product_options_'.$optionValue->getId().'_price\')')) ?>
                        </td>
                        <?php if(sfConfig::get('app_tax_is_enabled',false)): ?>
                        <td>
                            <?php echo input_tag('product[options][' . $optionValue->getId() . '][price_gross]', $price_gross, array('size' => 7,'onkeyup' => 'updateNetPrice(\'product_options_'.$optionValue->getId().'_price\')')) ?>
                        </td>
                        <?php endif; ?>
                        <td>
                            <?php echo select_tag(
                                'product[options][' . $optionValue->getId() . '][prefix]', 
                                options_for_select(array('plus' => '+', 'minus' => '-'), $prefix),
                                array('style' => 'width: 35px')
                            ) ?>
                        </td>
                        <td>
                            <?php echo input_tag('product[options][' . $optionValue->getId() . '][quantity]',$quantity , array('size' => 7)) ?>
                        </td>
                     </tr>
                     <?php endforeach; ?>
<!--                      <tr>
                         <td colspan="5">
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
                      -->
                 </table>
            </td>
        </tr>
<?php endforeach; ?>
</table>