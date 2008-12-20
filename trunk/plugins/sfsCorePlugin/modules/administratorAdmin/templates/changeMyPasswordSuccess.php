<?php use_helper('I18N', 'Date', 'Form') ?>
<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<?php include_partial('administratorAdmin/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Change my pasaword') ?></h1>

  <?php include_partial('administratorAdmin/flashes') ?>

  <div id="sf_admin_content">
    <div class="sf_admin_form">
      <?php echo form_tag('@administratorAdmin_changeMyPassword') ?>
        <?php echo $form->renderHiddenFields() ?>
    
        <?php if ($form->hasGlobalErrors()): ?>
          <?php echo $form->renderGlobalErrors() ?>
        <?php endif; ?>
        
        <fieldset id="sf_fieldset">
            <?php foreach (array('current_password', 'password', 'confirm_password') as $name): ?>
              <div class="sf_admin_form_row sf_admin_text sf_admin_form_field <?php $form[$name]->hasError() and print ' errors' ?>">
                <?php echo $form[$name]->renderError() ?>
                <div>
                  <?php echo $form[$name]->renderLabel() ?>
                  <?php echo $form[$name]->render() ?>
                </div>
              </div>
            <?php endforeach; ?>
        </fieldset>
        
        <ul class="sf_admin_actions">
            <li class="sf_admin_action_save"><input type="submit" value="<?php echo __('Save') ?>" /></li>
        </ul>
      </form>
    </div>
  </div>
</div>