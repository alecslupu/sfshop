var sfs = sfs || {};
Object.extend( sfs || {}, {
    
    Accordion: Class.create({
    
        initialized: false
        ,options: {}
        ,listeners: {}
            
        ,initialize: function(options) {
            if(this.initialized) {
                this.destroy();
            }
            this.options = Object.extend({
                    root: $(document.body)
                    ,bodySelector: '.accordion-body'
                    ,elementSelector: '.accordion-element'
                    ,togglerSelector: 'img.toggler'
                },
                options || {}
            );
            this.options.root = $(this.options.root);
            if(this.options.root) {
                this.initListeners();
                this.initEvents();
                this.initialized = true;
            }
        }
        ,destroy: function() {
            Event.stopObserving(this.options.root, 'click', this.listeners.toggle);
        }
        ,initListeners: function() {
            this.listeners = {
                toggle: this.toggle.bindAsEventListener(this)
            };
        }
        ,initEvents: function() {
            this.options.root.observe('click', this.listeners.toggle);
        }
        ,toggle: function(event) {
            var element = event.findElement(this.options.togglerSelector);
            if(element)
            {
                /*new Effect.toggle(event.findElement(this.options.bodySelector), 'blind', {
                    duration: .2,
                    afterFinish: function(effect) {
                        var toggler = effect.element.up().down('img.toggler');
                        toggler.toggleClassName('closed');
                        //toggler.src = toggler.hasClassName('closed') ? '<?php echo image_path('toggler-bottom') ?>' : '<?php echo image_path('toggler') ?>';
                    }
                });*/
                element.next(this.options.bodySelector).toggle();
            }
        }
    })
});

document.observe('dom:loaded', function() {
    sfsPA = new sfs.Accordion({
        bodySelector: 'div.sf_fieldset_content'
        ,elementSelector: '.sf_admin_form fieldset'
        ,togglerSelector: 'h2'
    });
});

