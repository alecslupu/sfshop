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
    public function executeChangeMyPassword($request)
    {
        if ($request->getMethod() === sfRequest::POST) {
            $currentPassword = $request->getParameter('admin[current_password]');
            
            $admin = $this->getUser()->getUser();
            
            if ($admin->checkPassword($currentPassword)) {
                $admin->setPassword($request->getParameter('admin[password]'));
                $admin->save();
                $this->getUser()->setFlash('notice', 'Your new password has been saved');
                return $this->redirect('administratorAdmin/list');
            }
            else {
                $this->getRequest()->setError('admin{current_password}', 'Current password is wrong');
            }
        }
    }
    
    public function handleErrorChangeMyPassword()
    {
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
