var sfsAddressManage = Class.create(sfsManage, {
    initializeForm: function()
    {
        var addressManage = this;
        var parentObject = this.parentObject;
        var addressForm = new sfsForm(
            this.options.formId,
            {
                nameFormat: "address",
                postExecute: function(response)
                {
                    if (this.isValid()) {
                        addressManage.updateInfo(response.data);
                        
                        if (parentObject != null) {
                            parentObject.onUpdateInfo();
                        }
                        
                        if (addressManage.isActive) {
                            addressManage.hideForm();
                        }
                   }
                }
       });
    }
});