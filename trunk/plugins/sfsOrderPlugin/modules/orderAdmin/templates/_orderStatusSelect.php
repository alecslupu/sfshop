<?php if (isset($options)): ?>
    <form action="<?php echo url_for('orderAdmin/changeStatus') ?>" method="post">
    <?php echo input_hidden_tag('id', $sf_request->getParameter('id')) ?>
    <b>Status:</b> <?php echo select_tag('status_id', options_for_select($options, $selected)) ?>
    <?php echo submit_tag('Set status') ?>
    </form>
<?php endif; ?>