var sfsMemberContactManage = Class.create(sfsManage, {
    updateInfo: function(data)
    {
        $("primary_phone").update(data.primary_phone);
        
        if (data.secondary_phone != "") {
            $("secondary_phone").update(data.secondary_phone);
            $("content_secondary_phone").show();
        }
        else {
            $("content_secondary_phone").hide();
        }
    }
});