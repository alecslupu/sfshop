<?php

/**
 * memberAdmin actions.
 *
 * @package    sfShop
 * @subpackage memberAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class memberAdminActions extends automemberAdminActions
{
    
    
    
    public function executeChangePassword($request) {
        
        $this->member = $this->getMemberOrCreate();
        
        if ($request->getMethod() === sfRequest::POST) {
            $newPassword = $request->getParameter('member[password]', null);
            
            if ($newPassword === null) {
                $this->getRequest()->setError('member{password}', 'Password not found');
            } else {
                $this->member->setPassword($newPassword);
                $this->member->save();
                $this->getUser()->setFlash('notice', 'Your modifications have been saved');
                return $this->redirect('memberAdmin/list?id=' . $this->member->getId());
            }
        }
        
        return sfView::SUCCESS;
    }
    
    
    
    public function handleErrorChangePassword()
    {
        $this->preExecute();
        $this->member = $this->getMemberOrCreate();
        
        return sfView::SUCCESS;
    }
}
