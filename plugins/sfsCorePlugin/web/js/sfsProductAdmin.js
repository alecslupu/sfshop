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
                this.options.root.select(this.options.bodySelector).each(Element.hide);
                
                new Effect.toggle(element.next(this.options.bodySelector), 'blind', { duration: .2 });
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

