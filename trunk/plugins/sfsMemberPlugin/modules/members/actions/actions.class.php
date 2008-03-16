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
}
