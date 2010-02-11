var sfsDeliveryManage = Class.create(sfsManage, {
    updateInfo: function(data)
    {
        $H(data).each(
            function(v)
            {
                if (Object.isElement(this.containers.info.down("." + v[0]))) {
                    this.containers.info.down("." + v[0]).update(v[1]);
                }
            },
            this
        );
        
        var image = this.containers.info.down('.service_icon');
        
        if (data.service_icon_src != '') {
            image.src = data.service_icon_src;
            image.show();
        }
        else {
            image.hide();
        }
        
        $('total_price').update(data.total_price);
    },
    updateForm: function()
    {
        var ajaxRequest = new sfsAjax.Request(this.options.updateFormAction, {});
        var response = ajaxRequest.getResponse();
        var form = this.containers.form.down('.container_form')
        form.update(response);
        this.observeFormActions();
        this.form.onSubmit();
    }
});