var sfsAddressManage = Class.create(sfsManage, {
    initializeForm: function()
    {
        var addressManage = this;
        var addressForm = new sfsForm(
            this.options.formId,
            {
                nameFormat: "address",
                postExecute: function(response)
                {
                    if (this.isValid()) {
                        addressManage.hideForm();
                        addressManage.updateInfo(response.data);
                    }
                }
       });
    }
});