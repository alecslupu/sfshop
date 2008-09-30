<h3><?php echo __('Edit card info') ?></h3>
<form action="<?php echo url_for('@payment_authorizeNet?order_item_id=' . $sf_request->getParameter('order_item_id')) ?>" method="post" class="form" id="form_card_info" onsubmit="return false">
    <?php if (count($errors) > 0): ?>
        <ul class="error_list">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <ul class="main">
        <?php echo $form ?>
        <li><input type="submit" value="<?php echo __('Submit') ?>" class="button"> &nbsp; <input type="button" value="<?php echo __('Cancel') ?>" class="button" onClick="hideEditForm()"></li>
    </ul>
</form>

<?php  echo javascript_tag('
    var addressForm = new sfsForm(
        "form_card_info", 
        {
            nameFormat: "' . $form->getWidgetSchema()->getNameFormat() . '",
            errorClassName: "error_list",
            postExecute: function(response)
            {
                if (this.isValid()) {
                    var cardData = response.data;
                    $("card_number").update(cardData.card_number);
                    $("card_code").update(cardData.card_code);
                    $("card_expire").update(cardData.card_expire.month + "/" + cardData.card_expire.year);
                    hideEditForm();
                }
            }
        });
') ?>
