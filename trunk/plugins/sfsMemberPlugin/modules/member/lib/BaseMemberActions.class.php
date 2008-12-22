<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Member actions.
 *
 * @package    plugins.sfsMemberPlugin
 * @subpackage modules.member
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseMemberActions extends sfActions
{
   /**
    * Checks entered data and if data is correct sets member authenticated.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeLogin($request)
    {
        sfLoader::loadHelpers(array('Url', 'I18N'));
        
        $this->form = new sfsMemberLoginForm();
        
        if ($this->getUser()->isAuthenticated()) {
            $this->redirect('@homepage');
        }
        else {
            if ($request->isMethod('post')) {
                $data = $request->getParameter('data');
                $this->form->bind($data);
                
                if ($this->form->isValid()) {
                    
                    $criteria = new Criteria();
                    $criteria->add(MemberPeer::IS_DELETED, false);
                    $member = MemberPeer::retrieveByEmail($data['email'], $criteria);
                    
                    if ($member !== null && $member->checkPassword($data['password'])) {
                        
                        if ($member->getIsActive()) {
                            if ($member->getIsConfirmed() == MemberPeer::CONFIRMED) {
                                $this->getUser()->login($member);
                                
                                if ($request->getReferer() != $request->getUri()) {
                                    $redirectTo = $request->getReferer();
                                }
                                else {
                                    $redirectTo = url_for('@member_myProfile', true);
                                }
                            }
                            else {
                                 $redirectTo = url_for('@member_confirmRegistration', true);
                            }
                            
                            if ($request->isXmlHttpRequest()) {
                                $response = array('redirect_to' => $redirectTo);
                                return $this->renderText(sfsJSONPeer::createResponseSuccess($response));
                            }
                            else {
                                $this->redirect($redirectTo);
                            }
                        }
                        else {
                            $this->form->defineError('email', __('You account is inactive, please contact to administrator for getting more information'));
                        }
                    }
                    else {
                        $this->form->defineError('email', __('You have wrong email or password'));
                    }
                }
            }
        }
    }
    
   /**
    * Sets member unauthenticated.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeRegistration($request)
    {
        sfLoader::loadHelpers(array('I18N', 'Url'));
        
        if ($this->getUser()->isAuthenticated() && !$this->getUser()->hasFlash('registered')) {
            $this->redirect('@homepage');
        }
        else {
            $this->form = new sfsMemberRegistrationForm();
            
            if (sfConfig::get('app_recaptcha_is_enabled', true)) {
                $captchaForm = new reCaptchaForm();
                $captchaForm->getWidgetSchema()->addFormFormatter(
                    'sfs_hidden_list', 
                    new sfsWidgetFormSchemaFormatterHiddenList($captchaForm->getWidgetSchema())
                );
                $captchaForm->getWidgetSchema()->setFormFormatterName('sfs_hidden_list');
                $this->form->embedForm('captcha', $captchaForm);
                $this->form->getWidgetSchema()->setLabel('captcha', '');
            }
            
            if ($request->isMethod('post')) {
                $holder = $request->getParameterHolder();
                $data = $request->getParameter('data');
                
                if (sfConfig::get('app_recaptcha_is_enabled', true)) {
                    $data['captcha'] = array(
                        'response'  => $request->getParameter('recaptcha_response_field'),
                        'challenge' => $request->getParameter('recaptcha_challenge_field')
                    );
                    
                    $holder->add(array('data' => $data));
                }
                
                $this->form->bind($request->getParameter('data'));
                
                if ($this->form->isValid()) {
                    
                    $member = $this->form->updateObject();
                    $member->setConfirmCode(MemberPeer::generateConfirmCode());
                    $member->save();
                    
                    $confirmCode = $member->getConfirmCode();
                    $urlToConfirm = url_for('@member_confirmRegistration?confirm_code=' . $confirmCode, true);
                    
                    $template = EmailTemplatePeer::retrieveByName(EmailTemplatePeer::REGISTRATION);
                    
                    $mail = new sfsMail();
                    $mail->addAddress($member->getEmail());
                    $mail->setTemplate($template);
                    $mail->setBodyParams(
                        array(
                            'email'                => $member->getEmail(),
                            'password'             => $data['password'],
                            'link_to_confirm_page' => $urlToConfirm,
                            'confirm_code'         => $confirmCode
                        )
                    );
                    $mail->send();
                    
                    $this->getUser()->setFlash('registered', true);
                    $this->redirect('@member_registration');
                }
            }
        }
    }
    
   /**
    * Checks entered confirm code, if code is correct, sets member as confirmed.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeConfirmEmail($request)
    {
        sfLoader::loadHelpers(array('I18N'));
        
        if ($this->getUser()->isAuthenticated() && !$this->getUser()->hasFlash('confirmed')) {
            $this->redirect('@homepage');
        }
        else {
            $this->form = new sfsMemberConfirmEmailForm();
            $this->form->setDefaults(array('confirm_code' => $request->getParameter('confirm_code')));
            
            if ($request->isMethod('post') || $request->isMethod('get')) {
                $this->form->bind(array('confirm_code' => $request->getParameter('confirm_code')));
                
                if ($this->form->isValid()) {
                    $member = MemberPeer::retrieveByConfirmCode($request->getParameter('confirm_code'));
                    
                    if ($member !== null) {
                        
                        $member->setIsConfirmed(MemberPeer::CONFIRMED);
                        $member->save();
                        
                        $this->getUser()->login($member);
                        
                        $this->getUser()->setFlash('confirmed', true);
                        $this->redirect('@member_confirmRegistration');
                    }
                    else {
                        $this->form->defineError('confirm_code', __('The confirm code is wrong'));
                    }
                }
            }
        }
    }
    
   /**
    * Checks exist account by entered email. Gets secret qustion for restoring password.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeForgotPasswordStepOne($request)
    {
        $this->form = new sfsMemberForgotPasswordStepOneForm();
        
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('data'));
            
            if ($this->form->isValid()) {
                $this->getUser()->setAttribute('email', $request->getParameter('data[email]'), 'member/forgot_password');
                $this->getUser()->setAttribute('account_exist', true, 'member/forgot_password');
                $this->redirect('@member_forgotPasswordStepTwo');
            }
        }
    }
    
   /**
    * Checks entered secret answer, if data is correct, sends new password to member's email.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeForgotPasswordStepTwo($request)
    {
        sfLoader::loadHelpers(array('I18N'));
        
        $email = $this->getUser()->getAttribute('email', null, 'member/forgot_password');
        
        if ($email !== null) {
            
            $criteria = new Criteria();
            MemberPeer::addPublicCriteria($criteria);
            $member = MemberPeer::retrieveByEmail($email);
            
            if ($member == null) {
                $this->redirect('@member_forgotPasswordStepOne');
            }
            
            $this->secretQuestion = $member->getSecretQuestion();
            
            $this->form = new sfsMemberForgotPasswordStepTwoForm();
            $this->form->setDefaults(array('email' => $email));
            
            if ($request->isMethod('post')) {
                $this->form->bind($request->getParameter('data'));
                
                if ($this->form->isValid()) {
                    
                    if ($member->getSecretAnswer() == $request->getParameter('data[secret_answer]')) {
                        
                        $template = EmailTemplatePeer::retrieveByName(EmailTemplatePeer::FORGOT_PASSWORD);
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
                        
                        $this->getUser()->setFlash('restored', true);
                        $this->getUser()->getAttributeHolder()->removeNamespace('member/forgot_password');
                        $this->redirect('@member_forgotPasswordStepTwo');
                    }
                    else {
                        $this->form->defineError('email', __('Answer is wrong'));
                    }
                }
            }
        }
        elseif(!$this->getUser()->hasFlash('restored')) {
            $this->redirect('@member_forgotPasswordStepOne');
        }
    }
    
   /**
    * My profile action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
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
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeEditProfile($request)
    {
        sfLoader::loadHelpers(array('I18N', 'Url'));
        
        $this->form = new MemberForm($this->getUser()->getUser());
        
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('data'));
            
            if ($this->form->isValid()) {
                $member = $this->form->getObject();
                $email = $request->getParameter('data[email]');
                
                if ($member->getEmail() != $email) {
                    
                    $member->setConfirmCode(MemberPeer::generateConfirmCode());
                    $member->setEmail($email);
                    $member->setIsConfirmed(MemberPeer::RECONFIRM);
                    $member->save();
                    
                    $template = EmailTemplatePeer::retrieveByName(EmailTemplatePeer::RECONFIRM_EMAIL);
                    $urlToConfirm = url_for('@member_confirmNewEmail?confirm_code=' . $confirmCode, true);
                    
                    if ($template != null) {
                        $mail = new sfsMail();
                        $mail->addAddress($member->getEmail());
                        $mail->setTemplate($template);
                        $mail->setBodyParams(
                            array(
                                'email'                => $member->getEmail(),
                                'link_to_confirm_page' => $request->getUriPrefix() . $urlToConfirm,
                                'confirm_code'         => $confirmCode
                            )
                        );
                        $mail->send();
                    }
                    $this->getUser()->setFlash('message', __('You have changed the email address. You should confirm a new email. 
                    Please, check your email, the letter with instruction has been sent to you.'));
                }
                
                $member = $this->form->updateObject();
                $member->save();
                
                $this->getUser()->setFlash('message', $this->getUser()->getFlash('message') . ' ' . __('Your profile has been updated.'));
                
                $this->redirect('@member_myProfile');
            }
        }
    }
    
   /**
    * Changes password for logged member.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeChangePassword($request)
    {
        sfLoader::loadHelpers(array('I18N'));
        
        $this->form = new sfsMemberChangePasswordForm($this->getUser()->getUser());
        
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('data'));
            
            if ($this->form->isValid()) {
                $member = $this->form->updateObject();
                $member->save();
                
                $this->getUser()->setFlash('message', $this->getUser()->getFlash('message') . __('Your password was changed'));
                $this->redirect('@member_myProfile');
            }
        }
    }
    
   /**
    * Edit contact info (primary and secondary phone number).
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeEditContactInfo($request)
    {
        $this->member = $this->getUser()->getUser();
        $this->form = new sfsMemberContactForm($this->member);
        
        if ($request->isMethod('post')) {
            $data = $request->getParameter('data');
            $this->form->bind($data);
            
            if ($this->form->isValid()) {
                $this->member = $this->form->updateObject();
                $this->member->save();
                
                return $this->renderText(sfsJSONPeer::createResponseSuccess($data));
            }
            elseif ($request->isXmlHttpRequest()) {
                $errors = array();
                
                foreach ($this->form->getErrorSchema() as $field => $error) {
                    $errors[$field] = $error->getMessage();
                }
                
                return $this->renderText(sfsJSONPeer::createResponseError($errors));
            }
        }
        
        return sfView::NONE;
    }
}
