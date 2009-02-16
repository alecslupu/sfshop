<?php include_partial('core/container_header', array('caption' => __('Pay through AuthorizeNet'))) ?>
    <table cellspacing="1" cellpadding="0" width="100%" class="list">
        <tr>
            <td valign="top">
                <?php include_component('addressBook', 'billingAddress', array('address' => $sf_data->getRaw('billingAddress'))) ?>
            </td>
        </tr>
        <tr>
            <td>
                <div id="container_form_card"  class="container_info" style="display: none">
                    <h3><?php echo __('Edit card info') ?></h3>
                    <div class="container_form">
                        <?php include_component('authorizeNet', 'cardForm', array('errors' => $errors)) ?>
                    </div>
                </div>
                <div id="container_info_card" class="container_info">
                    <span class="caption"><?php echo __('Credit card info') ?></span>
                    <span class="action">
                        [ <?php echo link_to(__('Edit'), '#') ?> ]
                    </span><br/><br/>
                    <b><?php echo __('Credit card number') ?></b>: <span class="card_number"><?php echo $cardData['card_number'] ?></span><br/>
                    <b><?php echo __('CCV2') ?></b>: <span class="card_code"><?php echo $cardData['card_code'] ?></span><br/>
                    <b><?php echo __('Expiration Date') ?></b>: <span class="card_expire"><?php echo $cardData['card_expire']['month'] . '/' . $cardData['card_expire']['year'] ?></span><br/>
                </div>
            </td>
        <tr>
            <td colspan="2">
                <div align="right">
                    <span class="total_price"><?php echo __('Total') ?>: <?php echo format_currency($order->getTotalPrice()) ?></span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <form action="<?php echo url_for('@payment_authorizeNetCharge?order_item_id=' . $sf_request->getParameter('order_item_id')); ?>" method="post" id="form_confirm" class="form">
                    <ul style="width: 100px">
                        <li><input type="submit" value="<?php echo __('Confirm') ?>" class="button"/></li>
                    </ul>
                </form>
            </td>
        </tr>
    </table>
<?php include_partial('core/container_footer') ?>

<?php echo javascript_tag('
    var manage = new sfsPaymentAuthorizeNetConfirmManage(
        {
            billingAddress: {
                containers: {info: "container_info_billing_address", form: "container_form_billing_address"},
                options: {formId: "form_edit_billing_address", selectBillingAddressAction: "' . url_for('@addressBook_select') . '"}
            },
            card: {
                containers: {info: "container_info_card", form: "container_form_card"},
                options: {formId: "form_edit_card_info"}
            }
        }
    );
') ?>

<?php if (isset($errorType) && $errorType == sfAuthorizeNet::ERROR_TYPE_INVALID_CARD): ?>
    <?php echo javascript_tag('showEditForm("container_edit_card", "container_card_info")') ?>
<?php endif; ?>