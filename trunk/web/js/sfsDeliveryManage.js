var sfsDeliveryManage = Class.create(sfsManage, {
    initializeForm: function()
    {
        var manage = this;
        var form = new sfsForm(
            this.options.formId,
            {
                nameFormat: "delivery",
                postExecute: function(response)
                {
                    if (this.isValid()) {
                        manage.hideForm();
                        manage.updateInfo(response.data);
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
    }
});