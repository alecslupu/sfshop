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
                            . sfContext::getInstance()->getController()->genUrl('@myProfile');
                    }
                }
                else {
                     $redirect_to = $this->getRequest()->getUriPrefix() 
                         . sfContext::getInstance()->getController()->genUrl('@confirmRegistration');
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
        
        $this->form = new sfsRegistrationForm();
        $this->form->embedForm('address', new sfsAddressForm());
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind($this->getRequestParameter('registration'));
            
            if ($this->form->isValid()) {
                
                $member = $this->form->updateObject();
                $member->setConfirmCode(sfsMemberPeer::generateConfirmCode());
                $member->save();
                
                $address = $this->getRequestParameter('registration[address]');
                
                $address = array_merge($address, array('member_id' => $member->getId()));
                
                //saving member address
                $addressBook = sfsAddressBookPeer::saveAddressBook($address);
                
                $member->setDefaultAddressId($addressBook->getId());
                $member->save();
                
                $controler = sfContext::getInstance()->getController();
                $confirmCode = $member->getConfirmCode();
                $urlToConfirm = $controler->genUrl('@confirmRegistration?confirm_code=' . $confirmCode);
                $template = sfsEmailTemplatePeer::getTemplate(sfsEmailTemplatePeer::REGISTRATION, $this->getUser()->getCulture());
                
                $mail = new sfsMail();
                $mail->addAddress($member->getEmail());
                $mail->setTemplate($template);
                $mail->setBodyParams(
                    array(
                        'email'                => $member->getEmail(),
                        'password'             => $this->getRequestParameter('password'),
                        'link_to_confirm_page' => $this->getRequest()->getUriPrefix() . $urlToConfirm,
                        'confirm_code'         => $confirmCode
                    )
                );
                $mail->send();
                
                $this->getUser()->setFlash('registered', true);
                $this->redirect('@registration');
            }
        }
    }
    
    /**
    * Checks entered confirm code, if code is correct set member is confirmed.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeConfirmRegistration()
    {
        $this->form = new sfsConfirmRegistrationForm();
        $this->form->setDefaults(array('confirm_code' => $this->getRequestParameter('confirm_code')));
        
        if ($this->getRequest()->isMethod('post')) {
            $this->form->bind(array('confirm_code' => $this->getRequestParameter('confirm_code')));
            
            if ($this->form->isValid()) {
                $member = sfsMemberPeer::retrieveByConfirmCode($this->getRequestParameter('confirm_code'));
                $member->setIsConfirmed(sfsMemberPeer::CONFIRMED);
                $member->save();
                $this->getUser()->login($member);
                
                $this->getUser()->setFlash('confirmed', true);
                $this->redirect('@confirmRegistration');
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
                $this->redirect('@forgotPasswordStepTwo');
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
                    
                    $this->getUser()->setFlash('password_sent', true);
                    $this->getUser()->getAttributeHolder()->removeNamespace('member/forgot_password');
                    $this->redirect('@forgotPasswordStepTwo');
                }
            }
        }
        elseif(!$this->getUser()->hasFlash('password_sent')) {
            $this->redirect('@forgotPasswordStepOne');
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
        
    }
    
    /**
    * My addresses list action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeMyAddressesList()
    {
        $this->pager = new sfPropelPager('sfsAddressBook', 10);
        $criteria = new Criteria();
        $criteria->add(sfsAddressBookPeer::MEMBER_ID, $this->getUser()->getMemberId());
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($this->getRequestParameter('page', 1));
        $this->pager->init();
    }
    
    /**
    * Edit address action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeEditAddress()
    {
        
    }
    
    /**
    * Delete address action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeDeleteAddress()
    {
        
    }
    
}
