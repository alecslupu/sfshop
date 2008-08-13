<?php

/**
 * coreAdminAdmin actions.
 *
 * @package    sfShop
 * @subpackage coreAdminAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class coreAdminAdminActions extends autocoreAdminAdminActions
{
    

    public function executeChangePassword($request) {
        
        $this->admin = $this->getAdminOrCreate();
        
        if ($request->getMethod() === sfRequest::POST) {
            $newPassword = $request->getParameter('admin[password]', null);
            
            if ($newPassword === null) {
                $this->getRequest()->setError('admin{password}', 'Password not found');
            } else {
                $this->admin->setPassword($newPassword);
                $this->admin->save();
                $this->getUser()->setFlash('notice', 'Your modifications have been saved');
                return $this->redirect('coreAdminAdmin/list?id=' . $this->admin->getId());
            }
        }
        
        return sfView::SUCCESS;
    }
    
    
    
    public function handleErrorChangePassword()
    {
        $this->preExecute();
        $this->admin = $this->getAdminOrCreate();
        
        return sfView::SUCCESS;
    }
}
