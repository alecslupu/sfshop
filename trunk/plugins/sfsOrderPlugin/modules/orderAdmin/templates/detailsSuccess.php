<?php use_helper('sfsAddressBook') ?>
<div id="sf_admin_container">
<h3>Order details</h3>
<table cellspacing="0" cellpadding="0" width="100%" class="sf_admin_list">
    <tr>
      <td width="50%" valign="top" style="padding-right: 5px">
            <table cellspacing="0" cellpadding="0"  class="sf_admin_list">
                <tr><th colspan="4">Delivery address</th></tr>
                <tr>
                    <td>
                      <?php
                          echo format_address($address)
                      ?>
                  </td>
              </tr>
           </table>
      </td>
      <td width="50%" valign="top">
            <table cellspacing="0" cellpadding="0" width="100%" class="sf_admin_list">
                <tr><th colspan="4">Products</th></tr>
            <?php $i = 1; foreach ($order->getOrderProductsJoinProduct() as $orderProduct): ?>
                <tr>
                    <td valign="top"><b><?php echo $i; ?>.</b>&nbsp;</td>
                    <td>
                        <b><?php echo $orderProduct->getProduct()->getTitle() ?></b>
                        <?php include_component('orderAdmin', 'productOptionsList', array('orderProduct' => $orderProduct)) ?>
                    </td>
                    <td valign="top">
                        <?php echo format_currency($orderProduct->getPrice()) ?> x <?php echo $orderProduct->getQuantity() ?>
                    </td>
                    <td valign="top" align="right"><?php echo format_currency($orderProduct->getTotalPrice()) ?></td>
                </tr>
            <?php $i++; endforeach; ?>
                <tr><td colspan="4" align="right"><b>Total:</b> <?php echo format_currency($order->getTotalPrice()) ?></td></tr>
            </table>
        </td>
    </tr>
    
    <tr>
        <td colspan="2">
            <?php include_component('paymentAdmin', 'orderPaymentInfo', array()) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?php include_component('deliveryAdmin', 'orderDeliveryInfo', array()) ?>
        </td>
    </tr>

    <tr>
        <td><?php include_component('orderAdmin', 'orderStatusSelect', array('order' => $order)) ?></td>
        <td></td>
    </tr>
</table>
<ul class="sf_admin_actions">
    <li><?php echo button_to('list', 'orderAdmin/list', array ('class' => 'sf_admin_action_list')) ?></li>
</ul>
</div>
