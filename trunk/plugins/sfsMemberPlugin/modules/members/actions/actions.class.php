<?php

/**
 * Members actions.
 *
 * @package    plugins.sfsMemberPlugin.modules
 * @subpackage members
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class membersActions extends sfActions
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
                    
                    $member = sfsMemberPeer::retrieveByEmail($this->getRequestParameter('email'));
                    
                    if ($member->getIsConfirmed() == sfsMemberPeer::CONFIRMED) {
                        $this->getUser()->login($member);
                        
                        if ($this->getRequest()->getReferer() != $this->getRequest()->getUri()) {
                            $redirect_to = $this->getRequest()->getReferer();
                        }
                        else {
                            $redirect_to = $this->getRequest()->getUriPrefix() 
                                . sfContext::getInstance()->getController()->genUrl('@members_myProfile');
                        }
                    }
                    else {
                         $redirect_to = $this->getRequest()->getUriPrefix() 
                             . sfContext::getInstance()->getController()->genUrl('@members_confirmRegistration');
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
    public function executeRegistration()
    {
        sfLoader::loadHelpers('I18N');
        
        if ($this->getUser()->isAuthenticated() && !$this->hasFlash('registered')) {
            $this->redirect('@homepage');
        }
        else {
            $this->form = new sfsRegistrationForm();
            $this->form->embedForm('address', new sfsAddressBookFormShort());
            
            if ($this->getRequest()->isMethod('post')) {
                $this->form->bind($this->getRequestParameter('details'));
                
                if ($this->form->isValid()) {
                    
                    $member = $this->form->updateObject();
                    $member->setConfirmCode(sfsMemberPeer::generateConfirmCode());
                    $member->save();
                    
                    $address = $this->getRequestParameter('details[address]');
                    
                    $address = array_merge(
                        $address, 
                        array(
                            'gender'     => $member->getGender(),
                            'member_id'  => $member->getId(),
                            'first_name' => $member->getFirstName(),
                            'last_name'  => $member->getLastName()
                        )
                     );
                    
                    //saving member address
                    $addressBook = sfsAddressBookPeer::saveAddressBook($address);
                    
                    $member->setDefaultAddressId($addressBook->getId());
                    $member->save();
                    
                    $controler = sfContext::getInstance()->getController();
                    $confirmCode = $member->getConfirmCode();
                    $urlToConfirm = $controler->genUrl('@members_confirmRegistration?confirm_code=' . $confirmCode);
                    $template = sfsEmailTemplatePeer::getTemplate(sfsEmailTemplatePeer::REGISTRATION, $this->getUser()->getCulture());
                    
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
                    
                    $this->getUser()->setFlash('message', 'You are registered now. Thanks!');
                    $this->getUser()->setFlash('registered', true);
                    $this->redirect('@members_registration');
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
        $this->form = new sfsConfirmEmailForm();
        $this->form->setDefaults(array('confirm_code' => $this->getRequestParameter('confirm_code')));
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind(array('confirm_code' => $this->getRequestParameter('confirm_code')));
            
            if ($this->form->isValid()) {
                $member = sfsMemberPeer::retrieveByConfirmCode($this->getRequestParameter('confirm_code'));
                $member->setIsConfirmed(sfsMemberPeer::CONFIRMED);
                $member->save();
                
                $this->getUser()->login($member);
                
                $this->getUser()->setFlash('message', 'You are confirmed your email. Thanks!');
                $this->redirect('@members_confirmRegistration');
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
                $this->redirect('@members_forgotPasswordStepTwo');
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
        
        if ($email != null) {
            
            $member = sfsMemberPeer::retrieveByEmail($email);
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
                    $template = sfsEmailTemplatePeer::getTemplate(sfsEmailTemplatePeer::FORGOT_PASSWORD, $this->getUser()->getCulture());
                    $password = sfsMemberPeer::generatePassword();
                    
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
                    $this->redirect('@members_forgotPasswordStepTwo');
                }
            }
        }
        elseif(!$this->getUser()->hasFlash('password_sent')) {
            $this->redirect('@members_forgotPasswordStepOne');
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
        $this->form = new sfsEditProfileForm($this->getUser()->getMember());
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($this->getRequestParameter('details'));
            
            if ($this->form->isValid()) {
                $member = $this->form->getObject();
                $email = $this->getRequestParameter('details[email]');
                
                if ($member->getEmail() != $email) {
                    
                    $member->setConfirmCode(sfsMemberPeer::generateConfirmCode());
                    $member->setEmail($email);
                    $member->setIsConfirmed(MemberPeer::RECONFIRM);
                    $member->save();
                    
                    $template = sfsEmailTemplatePeer::getTemplate(sfsEmailTemplatePeer::RECONFIRM_EMAIL, $this->getUser()->getCulture());
                    $urlToConfirm = $controler->genUrl('@members_confirmNewEmail?confirm_code=' . $confirmCode);
                    
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
                
                $this->redirect('@members_myProfile');
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
        $this->form = new sfsChangePasswordForm($this->getUser()->getMember());
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($this->getRequestParameter('change_password'));
            
            if ($this->form->isValid()) {
                $member = $this->form->updateObject();
                $member->save();
                
                $this->getUser()->setFlash('message', $this->getUser()->getFlash('message') . 'Your password was changed.');
                
                $this->redirect('@members_myProfile');
            }
        }
    }
}
