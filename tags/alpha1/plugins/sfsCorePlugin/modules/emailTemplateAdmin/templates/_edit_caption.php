<?php if ($email_template->isNew()): ?>
    Add new email template
<?php else: ?>
    Edit email template &ldquo; <?php echo $email_template->getSubject() ?> &rdquo;";
<?php endif; ?>