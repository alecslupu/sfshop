var sfsPaymentManage = Class.create(sfsManage, {
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