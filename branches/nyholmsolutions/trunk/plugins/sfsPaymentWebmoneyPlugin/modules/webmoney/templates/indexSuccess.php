<form action="https://merchant.webmoney.ru/lmi/payment.asp" method="post" id="form_webmoney" name="form_webmoney" class="form">
    <?php echo $form ?>
</form>
<?php echo javascript_tag('
    $("form_webmoney").submit();
') ?>