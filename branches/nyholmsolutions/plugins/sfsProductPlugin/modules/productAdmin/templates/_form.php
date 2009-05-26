<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<?php if(sfConfig::get('app_tax_is_enabled',false)): ?>
<script language="javascript"><!--
<?php $tax_rates = TaxTypePeer::getTaxRatesArray(); ?>
var tax_rates = new Array();
<?php for($i=0; $i< count($tax_rates); $i++): ?>
tax_rates["<?php echo $i ?>"] = "<?php echo $tax_rates[$i] ?>";
<?php endfor; ?>

function doRound(x, places) {
  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
}

function getTaxRate() {
  var selected = document.getElementById('product_tax_type_id').selectedIndex;
  if(selected >= 0)
      return tax_rates[selected];
  return 0;
}

function updateNetPrice() 
{
    var taxRate = getTaxRate();
    var amount = document.getElementById('product_price_gross').value;
    amount = amount.replace(',','.');
    if (taxRate > 0) {
        amount = amount / ((taxRate/100)+1);
    }
    document.getElementById('product_price').value = doRound(amount, 5);
}

function updateGrossPrice() 
{
    var taxRate = getTaxRate();
    var amount = document.getElementById('product_price').value;
    amount = amount.replace(',','.');
    if (taxRate > 0) {
        amount = amount * ((taxRate/100)+1);
    }
    document.getElementById('product_price_gross').value = doRound(amount, 5);
}
//--></script>
<?php endif;?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@productAdmin') ?>
    <?php echo $form->renderHiddenFields() ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('productAdmin/form_fieldset', array('product' => $product, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>
    <?php include_component('productAdmin', 'editOptionsListForm', array('product' => $product)) ?>
    <?php include_component('productAdmin', 'addOptionValueForm') ?>
    <?php include_partial('productAdmin/form_actions', array('product' => $product, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
