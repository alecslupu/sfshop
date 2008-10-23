var sfsManage = Class.create({
    initialize: function(containers, options, parentObject)
    {
        containers = {info: $(containers.info), form: $(containers.form)};
        this.containers = containers;
        this.options = options;
        this.parentObject = parentObject;
        this.containers.info.down('.action').observe('click', this.showForm.bindAsEventListener(this, containers));
        var cancelButton = this.containers.form.down('li.actions').down('.cancel');
        cancelButton.observe('click', this.hideForm.bindAsEventListener(this));
        this.initializeForm();
    },
    hideForm: function()
    {
        this.parentObject.setActiveObject(null);
        var errors = $(this.containers.form).select('ul.error');
        
        if (errors.length == 0) {
            Effect.BlindUp(this.containers.form);
            Effect.BlindDown(this.containers.info);
        }
        this.parentObject.onHideForm();
    },
    showForm: function(e, containers)
    {
        this.parentObject.setActiveObject(this);
        Effect.BlindUp(containers.info);
        containers.form.show();
        new Effect.ScrollTo(containers.form.down('.actions'), {duration:1.0});
        this.parentObject.onShowForm();
    },
    initializeForm: function()
    {
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
    }
});