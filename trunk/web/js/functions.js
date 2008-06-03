
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
