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
        
        if ($this->getRequest()->isMethod('post')) {

            $this->form->bind(
                array(
                    'email'            => $this->getRequestParameter('email'),
                    'first_name'       => $this->getRequestParameter('first_name'),
                    'last_name'        => $this->getRequestParameter('last_name'),
                    'password'         => $this->getRequestParameter('password'),
                    'confirm_password' => $this->getRequestParameter('confirm_password'),
                    'secret_question'  => $this->getRequestParameter('secret_question'),
                    'secret_answer'    => $this->getRequestParameter('secret_answer')
                )
            );

            if ($this->form->isValid()) {
                
            }
        }
    }
}
