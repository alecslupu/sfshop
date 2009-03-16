var sfsBillingManage = Class.create(sfsManage, {
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
        
        var parameters = 'data[address_id]=' + data.id;
        
        var ajaxRequest = new sfsAjax.Request(this.options.selectBillingAddressAction, {parameters:  parameters});
        var response = ajaxRequest.getResponse();
    }
});