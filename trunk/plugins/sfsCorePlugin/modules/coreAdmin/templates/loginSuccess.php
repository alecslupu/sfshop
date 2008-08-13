<h1>Sign in</h1>

<form action="<?php echo url_for('@coreAdmin_login'); ?>" method="post" class="form">
    <ul class="main">
        <?php echo $form ?>
        <li class="button"><input type="submit" value="Login" class="button"/></li>
    </ul>
</form>