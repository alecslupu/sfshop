<?php use_helper('Validation', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

    <h1>Change my password</h1>
    
    <?php if ($sf_user->hasFlash('notice')): ?>
        <div class="save-ok">
           <h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
        </div>
    <?php endif; ?>
    
    <div id="sf_admin_content">
        
        <?php echo form_tag('administratorAdmin/changeMyPassword', array(
            'id'        => 'sf_admin_change_password_form',
            'name'      => 'sf_admin_change_password_form',
            'multipart' => true,
            'method'    => 'post'
        )); ?>
        
            <fieldset id="sf_fieldset_none" class="">
            
            <div class="form-row">
              <?php echo label_for('admin[current_password]', __('Current password') . ':') ?>
              <div class="content<?php if ($sf_request->hasError('admin{current_password}')): ?> form-error<?php endif; ?>">
                  <?php if ($sf_request->hasError('admin{current_password}')): ?>
                      <?php echo form_error('admin{current_password}', array('class' => 'form-error-msg')) ?>
                  <?php endif; ?>
                
                  <?php echo input_password_tag('admin[current_password]', '', array ('size' => 30)); ?>
              </div>
            </div>
            
            <div class="form-row">
              <?php echo label_for('admin[password]', __('New password') . ':') ?>
              <div class="content<?php if ($sf_request->hasError('admin{password}')): ?> form-error<?php endif; ?>">
                <?php if ($sf_request->hasError('admin{password}')): ?>
                    <?php echo form_error('admin{password}', array('class' => 'form-error-msg')) ?>
                <?php endif; ?>
                
                <?php echo input_password_tag('admin[password]', '', array ('size' => 30)); ?>
              </div>
            </div>
            
            <div class="form-row">
              <?php echo label_for('admin[confirm_password]', __('Confirm password') . ':') ?>
              <div class="content<?php if ($sf_request->hasError('admin{confirm_password}')): ?> form-error<?php endif; ?>">
                <?php if ($sf_request->hasError('admin{confirm_password}')): ?>
                    <?php echo form_error('admin{confirm_password}', array('class' => 'form-error-msg')) ?>
                <?php endif; ?>
                
                <?php echo input_password_tag('admin[confirm_password]', '', array ('size' => 30)); ?>
              </div>
            </div>
            
            </fieldset>
            
            <ul class="sf_admin_actions">
                <li><?php echo submit_tag(__('change'), array (
              'name' => 'save',
              'class' => 'sf_admin_action_save',
            )) ?></li>
            </ul>
        
        </form>
    
    </div>

</div>
