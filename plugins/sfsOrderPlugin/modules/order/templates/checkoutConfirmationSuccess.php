<?php include_partial('core/container_header', array('caption' => __('Order confirmation'))) ?>
    <table cellspacing="1" cellpadding="0" width="100%" class="list">
        <tr>
          <td width="50%" valign="top">
              <?php include_component('addressBook', 'deliveryAddress') ?>
          </td>
          <td width="50%" valign="top">
              <?php include_partial('list_products_details', 
                  array(
                      'itemProducts'           => $basket->getBasketProductsJoinProduct(), 
                      'item'                   => $basket,
                      'method_for_get_options' => 'getBasketProduct2OptionProducts'
                  )) ?>
          </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php include_component('payment', 'orderPaymentInfo', array()) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php include_component('delivery', 'orderDeliveryInfo', array()) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php include_component('member', 'contactInfo', array('error' => isset($errorContact) ? $errorContact : '')) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <form action="<?php echo url_for('@order_checkoutConfirmation'); ?>" method="post" id="form_confirm" class="form">
                    <h3><?php echo __('Comment to your order') ?></h3>
                    <ul class="main">
                        <li><?php echo $form['comment']->renderError() ?></li>
                        <li><?php echo $form['comment']->renderLabel() ?><?php echo $form['comment']->render(array('cols' => 50)) ?></li>
                    </ul>
                    <table cellpadding="0" width="100%">
                        <tr>
                            <td colspan="2">
                                <div align="right">
                                    <span class="total_price"><?php echo __('Total') ?>: <span id="total_price"><?php echo format_currency(
                                        $basket->getTotalPrice() + $sf_user->getAttribute('price', null, 'order/delivery')
                                    ) ?></span></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                        <td><?php echo button_to(__('Back'), '@payment_checkout', array('class' => 'button')) ?></td>
                        <td align="right"><br/>
                            <input type="submit" value="<?php echo __('Confirm order') ?>" class="button"/>
                        </td></tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
<?php include_partial('core/container_footer') ?>
<?php echo javascript_tag('
    var orderManage = new sfsOrderConfirmManage(
        {
            deliveryAddress: {
                containers: {info: "container_info_delivery_address", form: "container_form_delivery_address"},
                options: {formId: "form_edit_delivery_address"}
            },
            delivery: {
                containers: {info: "container_info_delivery", form: "container_form_delivery"},
                options: {formId: "form_delivery", updateFormAction: "' . url_for('@delivery_updateSelectForm') . '"}
            },
            memberContact: {
                containers: {info: "container_info_member_contact", form: "container_form_member_contact"},
                options: {formId: "form_member_contact"}
            },
            payment: {
                containers: {info: "container_info_payment", form: "container_form_payment"},
                options: {formId: "form_payment"}
            }
        }
    );
') ?>