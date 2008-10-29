var sfsAddressBookSelectManage = Class.create(sfsManage, {
    updateInfo:function(data)
    {
        var element = this.containers.info.down("select")
        element.innerHTML = "";
        
        $H(data.addresses).each(
            function(v) {
                var option = new Element("option", {"value": v.key}).update(v.value);
                element.insert(option);
            }
        );
        
        element.value = data.default_address_id;
        $(this.options.formId).reset();
        /*
        $(this.options.formId).getElements().each(
            function(element) {
                if (element.name != "data[first_name]" && element.name != "data[last_name]" && element.type != "submit" && element.type != "button") {
                    element.value = "";
                }
            }
        );
        */
    },
    onShowForm: function()
    {
        $("button_checkout").hide();
    },
    onHideForm: function()
    {
        $("button_checkout").show();
    }
});