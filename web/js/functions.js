
function setCheckboxValue()
{
    var elements = document.body.getElementsBySelector('[type="checkbox"]');
    elements.each(function(e){
        
        e.observe('click', function(event){
            var element = event.findElement('input');
            
            if (element.checked) {
                element.value = 1;
            }
            else {
                element.value = 0;
            }
        });
    }, this);
}

function selCountry_onChange(country_id) {
    var
        option        = null,
        states_id     = new Array(),
        states_title  = new Array(),
        i             = 0;
    
    for (i = 0; i < countries_id.length; i++) {
        if (countries_id[i] == country_id) {
            
            states_id    = countries_states_id[i];
            states_title = countries_states_title[i];
            break;
        }
    }
    
    $('address_state_id').innerHTML = '';
    option = new Element('option', { 'value': ''}).update('[select state]');
    $('address_state_id').insert(option);
    
    if (states_id.length > 0) {
        
        for (i = 0; i < states_id.length; i++) {
            option = new Element('option', { 'value': states_id[i]}).update(states_title[i]);
            $('address_state_id').insert(option);
        }
        
        $('address_state_id').up('li').show();
        $('address_state_title').up('li').hide();
        $('address_country_has_states').value = 1;
    }
    else {
        $('address_state_id').up('li').hide();
        $('address_state_title').up('li').show();
        $('address_country_has_states').value = 0;
    }
}

var activeContainerFormId = null;
var activeContainerInfoId = null;

function showEditForm(containerFormId, containerInfoId)
{
    activeContainerFormId = containerFormId;
    activeContainerInfoId = containerInfoId;

    Effect.BlindDown(containerFormId);
    Effect.BlindUp(containerInfoId);

    if (Object.isElement($('form_confirm'))) {
        $('form_confirm').hide();
    }
}

function hideEditForm()
{
    var errors = $(activeContainerFormId).select('ul.error');
    
    if (errors.length == 0) {
        Effect.BlindDown(activeContainerInfoId);
        Effect.BlindUp(activeContainerFormId);
    
        if (Object.isElement($('form_confirm'))) {
            $('form_confirm').show();
        }
    }
}

function observeFormFields(formId)
{
    var elements = $(formId).getInputs();

    elements.each(
        function(element) {
            $(element).observe('focus', function(event) {
                showFieldHelp(Event.element(event));
            });
            
            $(element).observe('blur', function(event) {
                hideFieldHelp(Event.element(event));
            });
        }
    );
}

function showFieldHelp(element)
{
    var content = element.next('span.help');

    if (Object.isElement(content)) {
        content.show();
    }
}

function hideFieldHelp(element)
{
    var content = element.next('span.help');

    if (Object.isElement(content)) {
        content.hide();
    }
}

function highlightFieldsWithError(formId)
{
    var elements = $(formId).select('ul.error');
    elements.each(function(element) {

        var field = element.up('li').next('li').down('input');

        if (!Object.isElement(field)) {
            var field = element.up('li').next('li').down('select');
        }

        if (Object.isElement(field)) {
            field.addClassName('error');
        }
    });
}