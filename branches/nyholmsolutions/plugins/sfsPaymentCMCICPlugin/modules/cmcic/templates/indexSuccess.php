<form action="<?php echo sfConfig::get('app_cic_payment_request_url')?>" method="post" id="form_cmcic" name="form_cmcic" class="form">
    <?php echo $form ?>
</form>
<?php echo javascript_tag('
    $("form_cmcic").submit();
') ?>