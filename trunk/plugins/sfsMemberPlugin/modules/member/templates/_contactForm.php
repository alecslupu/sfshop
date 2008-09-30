<h3><?php echo __('Edit contact info') ?></h3>
<form action="<?php echo url_for('@member_editContactInfo') ?>" method="post" class="form" id="form_contact_info" onsubmit="return false">
    <?php if ($error != ''): ?>
        <ul class="error">
            <li><?php echo $error ?></li>
        </ul>
    <?php endif; ?>
    <ul class="main">
        <?php echo $form ?>
        <li><input type="submit" value="<?php echo __('Submit') ?>" class="button"> &nbsp; <input type="button" value="<?php echo __('Cancel') ?>" class="button" onClick="hideEditForm()"></li>
    </ul>
</form>

<?php  echo javascript_tag('
    var contactForm = new sfsForm(
        "form_contact_info", 
        {
            nameFormat: "' . $form->getWidgetSchema()->getNameFormat() . '",
            postExecute: function(response)
            {
                if (this.isValid()) {
                    var info = response.data;
                    $("primary_phone").update(info.primary_phone);
                    
                    if (info.secondary_phone != "") {
                        $("secondary_phone").update(info.secondary_phone);
                        $("content_secondary_phone").show();
                    }
                    else {
                        $("content_secondary_phone").hide();
                    }
                    
                    hideEditForm();
                }
            }
        });
') ?>
