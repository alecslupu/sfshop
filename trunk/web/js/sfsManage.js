var sfsManage = Class.create({
    options: {
    },
    initialize: function(containers, options, parentObject)
    {
        this.containers = {info: $(containers.info), form: $(containers.form)};
        Object.extend(this.options, options || {});
        this.isActive = false;
        this.parentObject = parentObject;
        this.containers.info.down('.action').observe('click', this.showForm.bindAsEventListener(this, this.containers));
        this.observeFormActions();
    },
    observeFormActions: function()
    {
        var cancelButton = this.containers.form.down('li.actions').down('.cancel');
        cancelButton.observe('click', this.onCancel.bindAsEventListener(this));
        this.initializeForm();
    },
    onCancel: function()
    {
        this.hideForm();
        $(this.options.formId).reset();
        this.form.clearErrors();
    },
    hideForm: function()
    {
        if (this.parentObject != null) {
            this.parentObject.setActiveObject(null);
        }
        
        Effect.BlindUp(this.containers.form);
        Effect.BlindDown(this.containers.info);
        
        if (this.parentObject != null) {
            this.parentObject.onHideForm();
        }
        else {
            this.onHideForm();
        }
        
        this.isActive = false;
    },
    showForm: function(e, containers)
    {
        
        if (this.parentObject != null) {
            this.parentObject.setActiveObject(this);
        }
        
        Effect.BlindUp(containers.info);
        containers.form.show();
        new Effect.ScrollTo(containers.form.down('.actions'), {duration:1.0});
        
        if (this.parentObject != null) {
            this.parentObject.onShowForm();
        }
        else {
            this.onShowForm();
        }
        
        this.isActive = true;
    },
    initializeForm: function()
    {
        var manage = this;
        this.form = new sfsForm(
            this.options.formId,
            {
                nameFormat: "data[%s]",
                postExecute: function(response)
                {
                    if (this.isValid()) {
                        
                        manage.updateInfo(response.data);
                        
                        if (manage.parentObject != null && manage.isActive) {
                            manage.parentObject.onUpdateInfo();
                        }
                        
                        if (manage.isActive) {
                            manage.hideForm();
                        }
                    }
                    else {
                        if (manage.parentObject != null &&!Object.isUndefined(manage.parentObject.activeObject) && !manage.isActive) {
                            manage.parentObject.activeObject.hideForm();
                        }
                        
                        manage.showForm(null, manage.containers);
                    }
                }
           }
       );
    },
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
    },
    onShowForm: function()
    {
    },
    onHideForm: function()
    {
    }
});