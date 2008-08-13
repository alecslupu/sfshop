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
        //$this->forward('default', 'module');
        
        return sfView::SUCCESS;
    }
    
    
    
    public function executeLogin($request)
    {
        $this->form = new sfsAdminLoginForm();
        
        if ($this->getUser()->isAuthenticated()) {
            $this->redirect('@coreAdmin_index');
        } else {
            if ($this->getRequest()->isMethod('post')) {
                $this->form->bind(
                    array(
                        'username' => $this->getRequestParameter('username'),
                        'password' => $this->getRequestParameter('password')
                    )
                );
                
                if ($this->form->isValid()) {
                    
                    $admin = AdminPeer::retrieveByUsername($this->getRequestParameter('username'));
                    if ($admin !== null && $admin->checkPassword($this->getRequestParameter('password'))) {
                        $this->getUser()->login($admin);
                        $this->redirect('@coreAdmin_index');
                    } else {
                        $this->form->defineError('username', 'Username or password is wrong');
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
    
    
    
    //TODO create action for edit admin profile
    public function executeProfile()
    {
        return sfView::SUCCESS;
    }
    
    //TODO create action for change admin password
    public function executePassword()
    {
        return sfView::SUCCESS;
    }
    
}
