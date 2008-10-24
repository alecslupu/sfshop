var sfsOrderConfirmManage = Class.create({
    initialize: function(params)
    {
        this.activeObject = null;
        this.deliveryAddressManage = new sfsAddressManage(
            params.deliveryAddress.containers, 
            params.deliveryAddress.options, this
        );
        this.deliveryManage = new sfsDeliveryManage(
            params.delivery.containers, 
            params.delivery.options, this
        );
        this.contactManage = new sfsManage(
            params.contact.containers, 
            params.deliveryAddress.options, 
            this
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
        if (this.deliveryAddressManage.isActive == true) {
            this.deliveryManage.updateForm();
        }
    },
    setActiveObject: function(object)
    {
       if (this.activeObject != null && object != null) {
           this.activeObject.hideForm();
       }
       this.activeObject = object;
    }
});