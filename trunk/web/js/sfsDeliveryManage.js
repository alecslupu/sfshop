var sfsDeliveryManage = Class.create(sfsManage, {
    initializeForm: function()
    {
        var manage = this;
        this.form = new sfsForm(
            this.options.formId,
            {
                nameFormat: "delivery",
                postExecute: function(response)
                {
                    if (this.isValid()) {
                        manage.hideForm();
                        manage.updateInfo(response.data);
                    }
                    else {
                        manage.showForm();
                    }
                }
       });
    },
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