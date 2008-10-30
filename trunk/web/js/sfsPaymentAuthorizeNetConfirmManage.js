var sfsPaymentAuthorizeNetConfirmManage = Class.create({
    initialize: function(params)
    {
        this.activeObject = null;
        this.billingAddressManage = new sfsBillingManage(
            params.billingAddress.containers, 
            params.billingAddress.options, this
        );
        this.cardManage = new sfsManage(
            params.card.containers, 
            params.card.options, this
        );
    },
    onShowForm: function()
    {
        if (Object.isElement($('form_confirm'))) {
            $('form_confirm').hide();
        }
    },
    onHideForm: function()
    {
        if (Object.isElement($('form_confirm'))) {
            $('form_confirm').show();
        }
    },
    onUpdateInfo: function()
    {
    },
    setActiveObject: function(object)
    {
       if (this.activeObject != null && object != null) {
           this.activeObject.hideForm();
       }
       this.activeObject = object;
    }
});