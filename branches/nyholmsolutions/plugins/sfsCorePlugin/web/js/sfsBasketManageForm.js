var sfsBasketManageForm = Class.create(sfsForm, {
    initialize: function(form, options)
    {
        this.form = $(form);
        Object.extend(this.options, options || {});
        Object.extend(this, options || {});
        this.form.observe('submit', this.onSubmit.bindAsEventListener(this));

        if (!Object.isUndefined(this.form)) {
            var actionElements = this.form.select('a.delete');
    
            actionElements.each(
                function(element) {
                    element.observe('click', this.onDelete.bindAsEventListener(this, element, false));
                }, 
                this
            );

            var quantityFields = this.form.select('input.quantity');
    
            quantityFields.each(
                function(element) {
                    element.observe('change', this.onChangeQuantity.bindAsEventListener(this, element));
                }, 
                this
            );

            this.determineFormElements();
        }
    },
    onDelete: function(event, element, isConfirmed) {
	    if (!isConfirmed) {
            confirmDeleteProduct(element);
        }
        else {
		    var ajaxRequest = new sfsAjax.Request(element.href);
		    var response = ajaxRequest.getResponse();
	    
		    if (response.status == status.ERROR) {
		        this.options.isValid = false;
		        this.setErrors(response);
		    }
		    else {
		        if (response.data.has_products) {
                    Effect.Fade(element.up('tr'));

                    var ajaxRequest = new sfsAjax.Request(this.form.action, {parameters: this.form.serialize()});
                    var response = ajaxRequest.getResponse();
                    if (response.data.products.length > 0) {
                        response.data.products.each(
                            function(product) {
                                var tr = $('basket_product_' + product.id);
                                tr.down('.product_total_price').update(product.total_price);
                            }
                        );
                        $('basket_total_price').update(response.data.total_price);
                    }

		        }
		        else {
			        this.form.up('div').hide();
			        $('basket_empty').show();
		        }
		    }
	    }
    },
    onChangeQuantity: function(event, element) {
        var ajaxRequest = new sfsAjax.Request(this.form.action, {parameters: this.form.serialize()});
        var response = ajaxRequest.getResponse();
        this.clearErrors();

        if (response.status == status.ERROR) {
            this.options.isValid = false;
            this.setErrors(response);
        }
        else if (response.status == status.SUCCESS) {
            this.options.isValid = true;

            new Effect.Highlight(element.up('tr'));

            if (response.data.products.length > 0) {
                response.data.products.each(
                    function(product) {
                        var tr = $('basket_product_' + product.id);
                        tr.down('.product_total_price').update(product.total_price);
                    }
                );
                $('basket_total_price').update(response.data.total_price);
            }
            else {
                this.form.up('div').hide();
                $('basket_empty').show();
            }
        }
        else {
            alert('Unknown response');
        }
    },
    postExecute: function(response) {
        if (response.status == status.SUCCESS) {
            var deletedProducts = response.data.deleted_products;
            deletedProducts.each(
                function(id) {
                    var tr = $('basket_product_' + id);
                    new Effect.Fade(tr);
                }
            );

            if (response.data.products.length == 0) {
                this.form.up('div').hide();
                $('basket_empty').show();
            }
        }
    }
});