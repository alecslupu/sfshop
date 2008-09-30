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
        
        if (!Object.isUndefined(this.form)) {
            this.form.observe('submit', this.onSubmit.bindAsEventListener(this));
            this.determineFormElements();
        }
    },
    determineFormElements: function()
    {
        this.elements = Array();
        var elements = this.form.getElements();
        
        if (Object.isArray(elements)) {
            elements.each(
                function(element) {
                    if (element.type.toLowerCase() == 'checkbox') {
                        element.observe('click', this.onChecked.bindAsEventListener(this,element));
                    }
                    this.elements[this.elements.length] = element;
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
            function(element) {
                element.remove();
            }
        );
    },
    clear: function()
    {
        var elements = this.form.getElements();
        elements.each(
            function (element) {
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
            function(error) {
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
            var fieldName = error.key;
            var error = error.value;
            
            if (!Object.isString(error)) {;
                var fieldValueHash = $H(error);
                var subFieldName = '';

                fieldValueHash.each(
                    function(e) {
                        subFieldName = e.key;
                        error = e.value;
                    }
                );
            }

            if (!Object.isUndefined(subFieldName) && subFieldName != '') {
                fieldName = this.options.nameFormat.replace('%s', fieldName);
                fieldName = fieldName + '[' + subFieldName + ']';
            }
            else {
                fieldName = this.options.nameFormat.replace('%s', fieldName);
            }
        }

        if (Object.isUndefined(error)) {
            var error = error.value;
        }

        var element = this.getFieldByName(fieldName);
        
        if (Object.isElement(element)) {
            var advice = '<li><ul class="' + this.options.errorClassName + '"><li>' + error + '</li></ul></li>';
            var parent = element.up('li');
            new Insertion.Before(parent, advice);
        }
    },
    getFieldByName: function(fieldName)
    {
        var field = '';
        this.elements.each(
            function(element) {
                if (element.name == fieldName) {
                    field = element;
                }
            }
        );
        return field;
    }
});