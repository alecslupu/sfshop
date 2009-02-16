<?php include_partial('core/box_header', array('caption' => __('Currency'))) ?>
    <div class="currency_form">
        <form action="<?php echo url_for('@currency_setSelected'); ?>" method="post" name="form_currency" class="form form_currency">
            <ul class="main">
                <?php echo $form ?>
            </ul>
        </form>
    </div>
<?php include_partial('core/box_footer') ?>