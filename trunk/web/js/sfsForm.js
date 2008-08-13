var sfsForm = Class.create({
    options: {
        postExecute: function(response) {},
        errorClassName: 'error',
        nameFormat: null,
        isValid: true
    },
    initialize: function(form, options)
    {
        this.form = $(form);
        Object.extend(this.options, options || {});
        Object.extend(this, options || {});
        
        this.form.observe('submit', this.onSubmit.bindAsEventListener(this));
        this.elements = Array();
        var elements = this.form.getElements();
        
        if (Object.isArray(elements))
        {
            elements.each(
                function(element)
                {
                    if (element.type.toLowerCase() == 'checkbox')
                    {
                        element.observe('click', this.onChecked.bindAsEventListener(this,element));
                    }
                    this.elements[element.name] = element;
                },
                this
            );
        }
    },
    postExecute: function()
    {
    },
    onChecked: function(event, element)
    {
        element.value = element.checked ? 1: 0;
    },
    onSubmit: function()
    {
        this.clearErrors();
        var elements = this.form.getElements();
        var ajaxRequest = new sfsAjax.Request(this.form.action,{parameters: this.form.serialize()});
        var response = ajaxRequest.getResponse();
        this.options.isValid = false;
        
        if (response.status == status.ERROR)
        {
            this.options.isValid = false;
            this.setErrors(response);
        }
        else if (response.status == status.SUCCESS) {
            this.options.isValid = true;
        }
        else {
            alert('Unknown response');
        }
        
        this.postExecute(response);
    },
    clearErrors: function()
    {
        var errorElements = this.form.select('.' + this.options.errorClassName);
        
        errorElements.each(
            function(element)
            {
                element.remove();
            }
        );
    },
    clear: function()
    {
        var elements = this.form.getElements();
        elements.each(
            function (element)
            {
                element.reset();
            }
        );
    },
    isValid: function()
    {
        return this.options.isValid;
    },
    setErrors: function(response)
    {
        var errors = response.errors;
        $H(errors).each(
            function(error)
            {
                this.showError(error)
            },
            this
        );
    },
    showError: function(error)
    {
        if (this.options.nameFormat == null) {
            var fieldName = error.key;
        }
        else {
            var fieldName = this.options.nameFormat.replace('%s', error.key);
        }
        var error = error.value;
        var element = this.elements[fieldName];
        
        if (Object.isElement(element))
        {
            var advice = '<ul class="' + this.options.errorClassName + '"><li>' + error + '</li></ul>'
            switch (element.type.toLowerCase())
            {
                //case 'checkbox':
                case 'radio':
                    var parent = element.parentNode;
                    if (parent)
                    {
                        new Insertion.Bottom(parent, advice);
                    }
                    else
                    {
                        new Insertion.Before(element, advice);
                    }
                break;
                default:
                    new Insertion.Before(element, advice);
            }
        }
    }
});