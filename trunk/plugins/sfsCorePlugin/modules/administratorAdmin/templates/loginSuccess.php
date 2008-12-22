<?php use_helper('Form') ?>

<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<?php include_partial('administratorAdmin/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Sign in') ?></h1>
    
    <?php include_partial('administratorAdmin/flashes') ?>
    
    <div id="sf_admin_content">
        <div class="sf_admin_form">
            <?php echo form_tag('@administratorAdmin_login'); ?>
                <fieldset id="sf_fieldset">
                    <?php echo $form ?>
                </fieldset>
                <ul class="sf_admin_actions">
                    <li class="sf_admin_action_save"><input type="submit" value="<?php echo __('Login') ?>" /></li>
                </ul>
            </form>
        </div>
    </div>
</div>