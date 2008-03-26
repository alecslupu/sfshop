<?php //use_helper('Cryptographp'); ?>
<h3><?php echo __('Registration') ?></h3>
<form action="<?php echo url_for('@registration'); ?>" method="post">

  <?php /*echo __('User name') ?>: <span class="mandatory">*</span><br/>
  <?php if ($sf_request->hasError('username')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('username') ?></span> <br />
  <?php endif; ?>
  <?php echo input_tag('username',$sf_params->get('username'),array('class'=> $sf_request->hasError('username') ? 'error' : '' )) ?><br/>

  <?php echo __('Email') ?>: <span class="mandatory">*</span><br/>
  <?php if ($sf_request->hasError('mail')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('mail') ?></span> <br />
  <?php endif; ?>
  <?php echo input_tag('mail',$sf_params->get('mail'),array('class'=> $sf_request->hasError('mail') ? 'error' : '' )) ?><br/>

  <?php echo __('Gender') ?>: <span class="mandatory">*</span><br/>
  <?php if ($sf_request->hasError('gender')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('gender') ?></span> <br />
  <?php endif; ?>

  <?php echo select_tag('gender', options_for_select(array(
                                           ''  => '',
                                           '1' => __('Male'),
                                           '2' => __('Female'),
                                             ), $sf_params->get('gender')),
                                array('class'=> $sf_request->hasError('gender') ? 'error' : '' )) ?><br/>

  <?php echo __('First name') ?>:<br/>
  <?php echo input_tag('first_name',$sf_params->get('first_name')) ?><br/>
  <?php echo __('Last name') ?>:<br/>
  <?php echo input_tag('last_name',$sf_params->get('last_name')) ?><br/>

  <?php echo __('Password') ?>: <span class="mandatory">*</span><br/>
  <?php if ($sf_request->hasError('password')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('password') ?></span> <br />
  <?php endif; ?>
  <?php echo input_tag('password','', array('type' => 'password', 
                                            'class' => $sf_request->hasError('password') ? 'error' : '' )) ?><br/>

  <?php echo __('Confirm password') ?>: <span class="mandatory">*</span><br/>
  <?php if ($sf_request->hasError('confirm_password')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('confirm_password') ?></span> <br />
  <?php endif; ?>
  <?php echo input_tag('confirm_password','', array('type'  => 'password', 
                                                    'class' => $sf_request->hasError('confirm_password') ? 'error' : '' )) ?><br/>

  <?php echo __('Secret answer') ?>: <span class="mandatory">*</span><br/>
  <?php echo __('Secret question'); ?><br/>
  <?php if ($sf_request->hasError('secret_answer')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('secret_answer') ?></span> <br />
  <?php endif; ?>
  <?php echo input_tag('secret_answer', $sf_params->get('secret_answer'), array('class' => $sf_request->hasError('secret_answer') ? 'error' : '' )) ?><br/>

  <?php echo __('Date of birthday') ?>: <span class="mandatory">*</span><br/>
  <?php if ($sf_request->hasError('birth[day]')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('birth[day]') ?></span> <br />
  <?php endif; ?>
  <?php if ($sf_request->hasError('birth[month]')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('birth[month]') ?></span> <br />
  <?php endif; ?>
  <?php if ($sf_request->hasError('birth[year]')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('birth[year]') ?></span> <br />
  <?php endif; ?>
  <?php echo select_date_tag('birth', $sf_params->get('birth'), array('include_blank' => true,
                                               'year_start' => date('Y',strtotime('-70 years')),
                                               'year_end'   => date('Y',strtotime('-18 years')),
                             'class' => $sf_request->hasError('birth[day]') || 
                                      $sf_request->hasError('birth[month]') || 
                              $sf_request->hasError('birth[year]') ? 'error' : ''
                             )); ?><br/>

  <?php if ($sf_request->hasError('captcha')): ?>
    <span class="error_msg"><?php echo $sf_request->getError('captcha') ?></span>
  <?php endif; ?>

  <div class="captcha_pic">
    <?php echo cryptographp_picture(); ?>
    <?php echo cryptographp_reload(); ?>
  </div>
  <div class="captcha">
      <?php echo input_tag('captcha','',array('class' => 'captcha')); */?>

  <table cellspacing="0" cellpadding="3">
    <?php echo $form ?>
    <tr><td colspan="2"><input type="submit" value="<?php echo __('Register') ?>"/></td></tr>
  </table>
</form>
