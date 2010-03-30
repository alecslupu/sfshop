var sfs = sfs || {};
Object.extend( sfs || {}, {
    
    Accordion: Class.create(
    {
        initialized: false
        ,options: {}
        ,listeners: {}
        ,cookie: {}
            
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
            
            this.cookies = new sfs.Cookies();
            
            this.options.root = $(this.options.root);
            if(this.options.root) {
                this.initListeners();
                this.initEvents();
                this.initialized = true;
            }
            this.toggleLastSelected();
        }
        ,destroy: function() {
            Event.stopObserving(this.options.root, 'click', this.listeners.toggle);
            Event.stopObserving(this.options.root, 'accordion:toggle', this.listeners.toggle);
        }
        ,initListeners: function() {
            this.listeners = {
                toggle: this.toggle.bindAsEventListener(this)
            };
        }
        ,initEvents: function() {
            this.options.root.observe('click', this.listeners.toggle);
            this.options.root.observe('accordion:toggle', this.listeners.toggle);
        }
        ,toggle: function(event) {
            var element = event.findElement(this.options.togglerSelector);
            if(element)
            {
                this.options.root.select(this.options.bodySelector).each(Element.hide);
                this.setLastToggled(element.up(this.options.elementSelector));
                
                new Effect.toggle(element.next(this.options.bodySelector), 'blind', { duration: .2 });
            }
        }
        ,toggleLastSelected: function() {
            $(this.getLastToggled()).down(this.options.togglerSelector).fire('accordion:toggle');
        }
        ,setLastToggled: function(element) {
            this.cookies.set('last-toggled', element.id);
        }
        ,getLastToggled: function() {
            return this.cookies.get('last-toggled');
        }
    })
});