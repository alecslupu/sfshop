<?php

/**
 * admin actions.
 *
 * @package    sfShop
 * @subpackage admin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class coreAdminActions extends sfActions
{ 
   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex($request)
    {
        return sfView::SUCCESS;
    }
    
    public function executeLogin($request)
    {
        sfLoader::loadHelpers(array('I18N'));
        
        $this->form = new sfsAdminLoginForm();
        
        if ($this->getUser()->isAuthenticated()) {
            $this->redirect('@coreAdmin_index');
        }
        else {
            if ($this->getRequest()->isMethod('post')) {
                
                $data = $request->getParameter('data');
                
                $this->form->bind($data);
                
                if ($this->form->isValid()) {
                    
                    $admin = AdminPeer::retrieveByEmail($data['email']);
                    
                    if ($admin !== null && $admin->checkPassword($data['password'])) {
                        if ($admin->getIsActive()) {
                            $this->getUser()->login($admin);
                            $this->redirect('@coreAdmin_index');
                        }
                        else {
                            $this->form->defineError('email', __('You account is inactive, please contact to administrator for getting more information'));
                        }
                    }
                    else {
                        $this->form->defineError('email', __('Email or password is wrong'));
                    }
                }
            }
        }
        
        return sfView::SUCCESS;
    }
    
    public function executeLogout()
    {
        $this->getUser()->logout();
        $this->redirect('@coreAdmin_login');
    }
}
