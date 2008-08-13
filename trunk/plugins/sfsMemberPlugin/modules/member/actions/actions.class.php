<?php

/**
 * Member actions.
 *
 * @package    plugins.sfsMemberPlugin.modules
 * @subpackage member
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class memberActions extends sfActions
{
   /**
    * Checks entered data and if data is correct sets member authenticated.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeLogin()
    {   
        $this->form = new sfsLoginForm();
        
        if ($this->getUser()->isAuthenticated()) {
            $this->redirect('@homepage');
        }
        else {
            if ($this->getRequest()->isMethod('post')) {
                
                $this->form->bind(
                    array(
                        'email'    => $this->getRequestParameter('email'),
                        'password' => $this->getRequestParameter('password')
                    )
                );
                
                if ($this->form->isValid()) {
                    
                    $member = MemberPeer::retrieveByEmail($this->getRequestParameter('email'));
                    
                    if ($member !== null && $member->checkPassword($this->getRequestParameter('password'))) {
                        
                        if ($member->getIsConfirmed() == MemberPeer::CONFIRMED) {
                            $this->getUser()->login($member);
                            
                            if ($this->getRequest()->getReferer() != $this->getRequest()->getUri()) {
                                $redirect_to = $this->getRequest()->getReferer();
                            }
                            else {
                                $redirect_to = $this->getRequest()->getUriPrefix() 
                                    . sfContext::getInstance()->getController()->genUrl('@member_myProfile');
                            }
                        }
                        else {
                             $redirect_to = $this->getRequest()->getUriPrefix() 
                                 . sfContext::getInstance()->getController()->genUrl('@member_confirmRegistration');
                        }
                        
                        if ($this->getRequest()->isXmlHttpRequest()) {
                            $response = json_encode(array('redirect_to' => $redirect_to));
                            $this->renderText($response);
                            return sfView::NONE; 
                        }
                        else {
                            $this->redirect($redirect_to);
                        }
                    }
                    else {
                        $this->form->defineError('email', 'You have wrong email or password');
                    }
                }
            }
        }
    }
    
   /**
    * Sets member is not authenticated.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeLogout()
    {
        $this->getUser()->logout();
        $this->redirect('@homepage');
    }
    
   /**
    * Checks entered data and if data is correct add new member to database.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeRegistration($request)
    {
        sfLoader::loadHelpers('I18N');
        
        if ($this->getUser()->isAuthenticated() && !$this->getUser()->hasFlash('registered')) {
            $this->redirect('@homepage');
        }
        else {
            $this->form = new sfsRegistrationForm();
            
            $captchaForm = new reCaptchaForm();
            $captchaForm->getWidgetSchema()->addFormFormatter('sfs_hidden_list', new sfsWidgetFormSchemaFormatterHiddenList($captchaForm->getWidgetSchema()));
            $captchaForm->getWidgetSchema()->setFormFormatterName('sfs_hidden_list');
            $this->form->embedForm('captcha', $captchaForm);
            
            if ($request->isMethod('post')) {
                $holder = $request->getParameterHolder();
                //$holder->set('details[captcha][recaptcha_challenge_field]', $request->getParameter('recaptcha_challenge_field'));
                $details = $request->getParameter('details');
                $details['captcha'] = array(
                        'response'  => $request->getParameter('recaptcha_response_field'),
                        'challenge' => $request->getParameter('recaptcha_challenge_field')
                );
                
                $holder->add(array('details' => $details));
                
                
                $this->form->bind($request->getParameter('details'));
                
                if ($this->form->isValid()) {
                    
                    $member = $this->form->updateObject();
                    $member->setConfirmCode(MemberPeer::generateConfirmCode());
                    $member->save();
                    
                    $controler = sfContext::getInstance()->getController();
                    $confirmCode = $member->getConfirmCode();
                    $urlToConfirm = $controler->genUrl('@member_confirmRegistration?confirm_code=' . $confirmCode);
                    
                    $template = EmailTemplatePeer::retrieveByName(EmailTemplatePeer::REGISTRATION);
                    
                    $mail = new sfsMail();
                    $mail->addAddress($member->getEmail());
                    $mail->setTemplate($template);
                    $mail->setBodyParams(
                        array(
                            'email'                => $member->getEmail(),
                            'password'             => $request->getParameter('details[password]'),
                            'link_to_confirm_page' => $this->getRequest()->getUriPrefix() . $urlToConfirm,
                            'confirm_code'         => $confirmCode
                        )
                    );
                    $mail->send();
                    
                    $this->getUser()->setFlash('message', 'You are registered now. Thanks!');
                    $this->getUser()->setFlash('registered', true);
                    $this->redirect('@member_registration');
                }
            }
        }
    }
    
   /**
    * Checks entered confirm code, if code is correct set member as confirmed.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeConfirmEmail()
    {
        if ($this->getUser()->isAuthenticated() && !$this->getUser()->hasFlash('confirmed')) {
            $this->redirect('@homepage');
        }
        else {
            $this->form = new sfsConfirmEmailForm();
            $this->form->setDefaults(array('confirm_code' => $this->getRequestParameter('confirm_code')));
            
            if ($this->getRequest()->isMethod('post')) {
                $this->form->bind(array('confirm_code' => $this->getRequestParameter('confirm_code')));
                
                if ($this->form->isValid()) {
                    $member = MemberPeer::retrieveByConfirmCode($this->getRequestParameter('confirm_code'));
                    
                    if ($member !== null) {
                        
                        $member->setIsConfirmed(MemberPeer::CONFIRMED);
                        $member->save();
                        
                        $this->getUser()->login($member);
                        
                        $this->getUser()->setFlash('message', 'You are confirmed your email. Thanks!');
                        $this->getUser()->setFlash('confirmed', true);
                        $this->redirect('@member_confirmRegistration');
                    }
                    else {
                        $this->form->defineError('confirm_code', 'The confirm code is wrong');
                    }
                }
            }
        }
    }
    
   /**
    * Checks exist account by entered email. Gest secret qustion for restoring password.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeForgotPasswordStepOne()
    {
        $this->form = new sfsForgotPasswordStepOneForm();
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind(array('email' => $this->getRequestParameter('email')));
            
            if ($this->form->isValid()) {
                $this->getUser()->setAttribute('email', $this->getRequestParameter('email'), 'member/forgot_password');
                $this->getUser()->setAttribute('account_exist', true, 'member/forgot_password');
                $this->redirect('@member_forgotPasswordStepTwo');
            }
        }
    }
    
   /**
    * Checks entered secret answer, if data is correct send new password to member's email.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeForgotPasswordStepTwo()
    {
        $email = $this->getUser()->getAttribute('email', null, 'member/forgot_password');
        
        if ($email !== null) {
            
            $member = MemberPeer::retrieveByEmail($email);
            
            if ($member == null) {
                $this->redirect('@member_forgotPasswordStepOne');
            }
            
            $this->secretQuestion = $member->getSecretQuestion();
            
            $this->form = new sfsForgotPasswordStepTwoForm();
            $this->form->setDefaults(array('email' => $email));
            
            if ($this->getRequest()->isMethod('post')) {
                $this->form->bind(
                    array(
                        'secret_answer' => $this->getRequestParameter('secret_answer'),
                        'email'         => $this->getRequestParameter('email')
                    )
                );
                
                if ($this->form->isValid()) {
                    
                    if ($member->getSecretAnswer() == $this->getRequestParameter('secret_answer')) {
                        
                        $template = EmailTemplatePeer::retrieveByName(EmailTemplatePeer::FORGOT_PASSWORD, $this->getUser()->getCulture());
                        $password = MemberPeer::generatePassword();
                        
                        $member->setPassword($password);
                        $member->save();
                        
                        $mail = new sfsMail();
                        $mail->addAddress($member->getEmail());
                        $mail->setTemplate($template);
                        $mail->setBodyParams(
                            array(
                                'email'    => $member->getEmail(),
                                'password' => $password
                            )
                        );
                        $mail->send();
                        
                        $this->getUser()->setFlash('message', 'Your login and password have been sent to you email.');
                        $this->getUser()->getAttributeHolder()->removeNamespace('member/forgot_password');
                        $this->redirect('@member_forgotPasswordStepTwo');
                    }
                    else {
                        $this->form->defineError('email', 'The answer is wrong');
                    }
                }
            }
        }
        elseif(!$this->getUser()->hasFlash('message')) {
            $this->redirect('@member_forgotPasswordStepOne');
        }
    }
    
   /**
    * My profile action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeMyProfile()
    {
        return sfView::SUCCESS;
    }
    
   /**
    * Edits profile information provided in the registration.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeEditProfile()
    {
        $this->form = new sfsEditProfileForm($this->getUser()->getUser());
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($this->getRequestParameter('details'));
            
            if ($this->form->isValid()) {
                $member = $this->form->getObject();
                $email = $this->getRequestParameter('details[email]');
                
                if ($member->getEmail() != $email) {
                    
                    $member->setConfirmCode(MemberPeer::generateConfirmCode());
                    $member->setEmail($email);
                    $member->setIsConfirmed(MemberPeer::RECONFIRM);
                    $member->save();
                    
                    $template = EmailTemplatePeer::getTemplate(EmailTemplatePeer::RECONFIRM_EMAIL, $this->getUser()->getCulture());
                    $urlToConfirm = $controler->genUrl('@member_confirmNewEmail?confirm_code=' . $confirmCode);
                    
                    $mail = new sfsMail();
                    $mail->addAddress($member->getEmail());
                    $mail->setTemplate($template);
                    $mail->setBodyParams(
                        array(
                            'email'                => $member->getEmail(),
                            'password'             => $this->getRequestParameter('details[password]'),
                            'link_to_confirm_page' => $this->getRequest()->getUriPrefix() . $urlToConfirm,
                            'confirm_code'         => $confirmCode
                        )
                    );
                    $mail->send();
                    $this->getUser()->setFlash('message', 'You have changed email address. Please confirm new mail. ');
                }
                
                $member = $this->form->updateObject();
                $member->save();
                
                $this->getUser()->setFlash('message', $this->getUser()->getFlash('message') . 'Your personal information have been saved.');
                
                $this->redirect('@member_myProfile');
            }
        }
    }
    
   /**
    * Changes password for logged member.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeChangePassword()
    {
        $this->form = new sfsChangePasswordForm($this->getUser()->getUser());
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($this->getRequestParameter('change_password'));
            
            if ($this->form->isValid()) {
                $member = $this->form->updateObject();
                $member->save();
                
                $this->getUser()->setFlash('message', $this->getUser()->getFlash('message') . 'Your password was changed.');
                $this->redirect('@member_myProfile');
            }
        }
    }
}
