var sfsAjax = {
};

sfsAjax.Request = Class.create({
    initialize: function(url, options)
    { 
        this.response = {status: 0};
        
        this.options = {
            method: 'post',
            parameters: {},
            asynchronous:  false,
            onSuccess: function(transport)
            {
                if (transport.responseText.isJSON())
                {
                    this.response = transport.responseText.evalJSON();
                    if (this.response.status == status.SUCCESS)
                    {
                        if (!Object.isUndefined(this.response.data.redirect_to))
                        {
                            window.location = this.response.data.redirect_to;
                        }
                    }
                }
                else
                {
                    this.response = transport.responseText;
                }
            }.bind(this),
            onFailure: function(){
                var error = new Error('HTTP ERROR: ' + status);
                
                if (!error.message)
                {
                    error.message = error;
                }
                
                throw error;
            },
            onComplete: function()
            {
                $('container_loading').hide();
            }
        };
        
        Object.extend(this.options, options || {});
        
        $('container_loading').show();
        
        new Ajax.Request(
            url,
            this.options
        );

    },
    getResponse: function()
    {
        return this.response;
    }
});
