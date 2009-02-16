var sfsBasketAddProductForm = Class.create(sfsForm, {
    postExecute: function(response)
    {
        if (response.status == status.SUCCESS) {
            var quantity = response.data.quantity;
            var container = this.form.previous('div.added_quantity');
            container.down('span').update(quantity);
            Effect.Appear(container);
            new Effect.Highlight(container);
        }
    }
});