<div id="add_option_value" style="display: none"><br/>
    <b><?php echo __('Add new option value') ?></b><br/>
    <?php echo form_tag('optionValueAdmin/create', array(
        'id'        => 'add_option_value_form',
        'name'      => 'add_option_value_form',
        'multipart' => true,
        'method'    => 'post',
        'onSubmit'  => 'return false'
    )); ?>
        <?php echo input_hidden_tag('option_value[type_id]') ?>
        <?php echo input_hidden_tag('option_value[is_active]', 1) ?>
        
        <?php foreach ($languages as $language): ?>
            <li></li>
            <li>
            <?php echo label_for('option_value[title_i18n_' . $language->getCulture() . ']', __('Title')) ?>
            <?php echo image_tag(
                'http://' . $sf_request->getHost()
                . '/images/' . sfConfig::get('languages_images_dir', 'languages')
                . '/'
                . strtolower($language->getTitleEnglish()) 
                . '/'
                . 'icon.png',
                array(
                    'title' => $language->getTitleOwn(),
                    'alt'   => $language->getTitleOwn(),
                    'align' => 'top'
                )
            ); ?>
            
            <?php echo input_tag('option_value[title_i18n_' . $language->getCulture() . ']', ''); ?><br/>
            </li>
        <?php endforeach; ?>
       </ul>
    </form>
</div>
    
<?php echo javascript_tag('
    
    function addNewOptionValue(optionTypeId, container)
    {
        $("add_option_value").down("form").id = "add_option_value_form" + optionTypeId;
        $("option_value_type_id").value = optionTypeId;
        
        var html = $("add_option_value").innerHTML;
        
        $("add_option_value").down("form").id = "add_option_value_form"
        
        Dialog.confirm(
            html,
            {
                 className: "' . sfConfig::get('app_prototype_window_theme', 'bluelighting') . '",
                 width: 400,
                 height: 155,
                 okLabel: "Add",
                 cancelLabel: "cancel",
                 onOk: function(win) {
                    
                     var optionValueForm = new sfsForm(
                         "add_option_value_form" + optionTypeId,
                         {
                             nameFormat: "option_value[%s]",
                             postExecute: function(response)
                             {
                                 if (this.isValid()) {
                                     var con = container.up("tr").previous("tr");
                                     new Insertion.Before(container.up("tr"), con.innerHTML);
                                     con = container.up("tr").previous("tr");
                                     
                                     con.down("td", 0).down("input").name = "product[options][" + response.data.id + "][is_used]";
                                     con.down("td", 0).down("input").checked = false;
                                     con.down("td", 1).update(response.data.title);
                                     con.down("td", 2).down("input").name = "product[options][" + response.data.id + "][price]";
                                     con.down("td", 2).down("input").value = "";
                                     con.down("td", 3).down("select").name = "product[options][" + response.data.id + "][prefix]";
                                     return true;
                                 }
                            }
                     });
                     
                     return optionValueForm.onSubmit();
                 }
        });
    }
') ?>
