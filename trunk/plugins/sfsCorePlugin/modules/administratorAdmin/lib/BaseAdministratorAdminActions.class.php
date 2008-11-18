<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Base administratorAdmin actions.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.administratorAdmin
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class BaseAdministratorAdminActions extends autoadministratorAdminActions
{
    public function executeChangePassword($request)
    {
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
    
    protected function saveAdmin($admin)
    {
        if ($admin->isNew()) {
            sfLoader::loadHelpers(array('Url'));
            
            $password = substr(md5(time() . rand(1, 10000)), 0, 8);
            
            $admin->setPassword($password);
            
            $urlToAdminPanel = url_for('@coreAdmin_login', true);
            
            $template = EmailTemplatePeer::retrieveByName(EmailTemplatePeer::NEW_ADMIN_ADDED);
            
            $mail = new sfsMail();
            $mail->addAddress($admin->getEmail());
            $mail->setTemplate($template);
            $mail->setBodyParams(
                array(
                    'email'                => $admin->getEmail(),
                    'password'             => $password,
                    'link_to_admin_panel'  => $urlToAdminPanel
                )
            );
            $mail->send();
        }
        
        $admin->save();
    }
}
