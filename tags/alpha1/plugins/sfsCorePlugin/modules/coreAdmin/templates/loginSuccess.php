<div id="sf_admin_container">
    <h1><?php echo __('Sign in') ?></h1>
    
    <form action="<?php echo url_for('@coreAdmin_login'); ?>" method="post" class="form">
        <?php echo $form ?>
        <ul class="sf_admin_actions" style="width: 300px">
            <li><input type="submit" value="Login" class="button"/></li>
        </ul>
    </form>
</div>