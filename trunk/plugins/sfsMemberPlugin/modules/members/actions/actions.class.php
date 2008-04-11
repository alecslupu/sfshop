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
    * Checks entered data and if data is correct adds new member to database.
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

            $this->form->bind(array('registration'  => $this->getRequestParameter('registration')));

            if ($this->form->isValid()) {
                $member = $this->form->updateObject();
                $member->setConfirmCode(sfsMemberPeer::generateConfirmCode());
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
                        'password'             => $this->getRequestParameter('registration[password]'),
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
}
