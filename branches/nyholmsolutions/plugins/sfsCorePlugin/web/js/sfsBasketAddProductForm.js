var sfsBasketAddProductForm = Class.create(sfsForm, {
    postExecute: function(response)
    {
        if (response.status == status.SUCCESS) {
            var quantity = response.data.quantity;
            var container = this.form.previous('div.added_quantity');
            container.down('span').update(quantity);
            new Effect.Appear(container,{duration:3, from:0, to:1.0});
            new Effect.Highlight(container);
            new Effect.Fade(container,{duration:2, from:1.0, to:0});
        }
    }
});