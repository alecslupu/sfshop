<h2><?php echo __('Database configuration (step 2 of 3)') ?></h2>
<br/>
<?php if (isset($errors) && count($sf_data->getRaw('errors')) > 0): ?>
    <div class="error">
        <table cellspacing="0" cellpadding="0">
            <?php foreach ($errors as $e): ?>
                <tr><td>
                    <?php echo image_tag('cross.png', array('width' => 16, 'height' => 16, 'align' => 'absmiddle')) ?>
                    <?php echo is_a($e, 'Exception') ? $e->getMessage() : $e ?>
                </td></tr>
            <?php endforeach; ?>
        </table>
    </div>
    <br/>
<?php endif; ?>

<div class="border">
    <p>
      To set up your database, enter the following information.
    </p>
    
    <form action="<?php echo url_for('@installer_configure') ?>" name="form_database" id="form_database" method="post">
        <table cellspacing="0" cellpadding="0">
            <?php echo $form ?>
        </table>
    </form>
</div>
<br/>
<div id="loader" style="display: none">
    <?php echo image_tag('loader.gif', array('width' => 16, 'height' => 16, 'align' => 'absmiddle')) ?>
    <span id="loading_sql"><?php echo __('loading sql') ?>...</span>
    <span id="loading_data" style="display: none"><?php echo __('loading data') ?>...</span>
</div>
<table cellspacing="0" cellpadding="0" align="right">
    <tr><td><input type="submit" value="<?php echo __('Check and continue') ?>" id="submit" onclick="form_database.submit()"/></td></tr>
</table>
<br/><br/>

<?php echo javascript_tag('
    
    function loadSqlAndData()
    {
        var elements = $("form_database").getInputs();
        
        elements.each(function(element) {
            element.disable();
        });
        
        $("submit").disable();
        
        $("loader").show();
        
        new Ajax.Request("' . url_for('@installer_loadSql') . '", {
            method: "get",
            onSuccess: function(transport) {
                var response = transport.responseText.evalJSON();
                if (response.status == status.SUCCESS) {
                    $("loading_sql").hide();
                    $("loading_data").show();
                    
                    new Ajax.Request("' . url_for('@installer_loadData') . '", {
                        method: "get",
                        onSuccess: function(transport) {
                            var response = transport.responseText.evalJSON();
                            if (response.status == status.SUCCESS) {
                                window.location = "' . url_for('@installer_finished') . '";
                            }
                        }
                    });
                }
            }
        });
    }
    
') ?>
    
<?php if ($isConfigured): ?>
    <?php echo javascript_tag('loadSqlAndData()'); ?>
<?php endif; ?>