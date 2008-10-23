var sfsOrderConfirmManage = Class.create({
    initialize: function(params)
    {
        this.activeObject = null;
        var deliveryAddress = new sfsAddressManage(
            params.deliveryAddress.containers, 
            params.deliveryAddress.options, this
        );
        var delivery = new sfsDeliveryManage(
            params.delivery.containers, 
            params.delivery.options, this
        );
        var contact = new sfsManage(
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
    setActiveObject: function(object)
    {
       if (this.activeObject != null && object != null) {
           this.activeObject.hideForm();
       }
       this.activeObject = object;
    }
});