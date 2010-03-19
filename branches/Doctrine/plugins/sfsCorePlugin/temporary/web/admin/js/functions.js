function highlightFieldsWithError()
{
    var elements = $('sf_admin_content').select('div.form-error');
    elements.each(function(element) {
        element.up('div.content').addClassName('form-error');
    });
}