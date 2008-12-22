<?php use_helper('sfsAddressBook', 'Form') ?>
<div id="sf_admin_container">
<h1><?php echo __('Order details') ?></h1>
<?php include_partial('orderAdmin/flashes') ?>
<div class="sf_admin_list">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="50%" valign="top" style="padding-right: 5px">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <tr><th colspan="4"><?php echo __('Delivery address') ?></th></tr>
                    <tr>
                        <td>
                          <?php echo format_address($address) ?>
                      </td>
                  </tr>
               </table>
          </td>
          <td width="50%" valign="top">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <tr><th colspan="4"><?php echo __('Products') ?></th></tr>
                <?php $i = 1; foreach ($order->getOrderProductsJoinProduct() as $orderProduct): ?>
                    <tr>
                        <td valign="top"><b><?php echo $i; ?>.</b>&nbsp;</td>
                        <td>
                            <?php echo $orderProduct->getProduct()->getTitle() ?>
                            <?php include_component('orderAdmin', 'productOptionsList', array('orderProduct' => $orderProduct)) ?>
                        </td>
                        <td valign="top">
                            <?php echo format_currency($orderProduct->getPrice()) ?> x <?php echo $orderProduct->getQuantity() ?>
                        </td>
                        <td valign="top" align="right"><?php echo format_currency($orderProduct->getTotalPrice()) ?></td>
                    </tr>
                <?php $i++; endforeach; ?>
                    <tr><td colspan="4" align="right"><b><?php echo __('Subtotal') ?>:</b> <?php echo format_currency($order->getTotalPrice()) ?></td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php include_component('paymentAdmin', 'paymentInfo', array('id' => $order->getPaymentId())) ?>
            </td>
        </tr>
        <tr >
            <td colspan="2">
                <?php include_component(
                    'deliveryAdmin', 
                    'deliveryInfo', 
                    array(
                        'id'           => $order->getDeliveryId(), 
                        'method_title' => $order->getDeliveryMethodTitle(),
                        'method_price' => $order->getDeliveryPrice()
                    )
                ) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <tr><th><?php echo __('Member`s comment for order') ?></th></tr>
                    <tr><td><?php echo $order->getComment() ?></td></tr>
                </table>
            </td>
        </tr>
        <tr>
          <td colspan="2" align="right"><h3><?php echo __('Total') ?>: <?php echo format_currency($order->getTotalPriceWithDeliveryPrice()) ?></h3></td>
        </tr>
        <tr>
            <td>
                <?php echo form_tag('@orderAdmin_details?id=' . $order->getId()) ?>
                    <?php echo $form ?>
                    <?php echo submit_tag('Set status') ?>
                </form>
            </td>
            <td></td>
        </tr>
    </table>
</div>

<ul class="sf_admin_actions">
    <li class="sf_admin_action_list">
        <?php echo link_to(__('List'), '@orderAdmin') ?>
    </li>
</ul>
</div>
