var sfsMemberContactManage = Class.create(sfsManage, {
    initializeForm: function()
    {
        var manage = this;
        var parentObject = this.parentObject;
        var addressForm = new sfsForm(
            this.options.formId,
            {
                nameFormat: "data",
                postExecute: function(response)
                {
                    if (this.isValid()) {
                        var info = response.data;
                        $("primary_phone").update(info.primary_phone);
                        
                        if (info.secondary_phone != "") {
                            $("secondary_phone").update(info.secondary_phone);
                            $("content_secondary_phone").show();
                        }
                        else {
                            $("content_secondary_phone").hide();
                        }
                        manage.hideForm();
                   }
                }
       });
    }
});