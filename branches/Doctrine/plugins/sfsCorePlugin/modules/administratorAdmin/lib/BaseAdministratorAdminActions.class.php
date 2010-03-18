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
 * Base administratorAdmin actions.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.administratorAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseAdministratorAdminActions extends autoadministratorAdminActions
{
   /**
    * Changes password for logged member.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeChangeMyPassword($request)
    {
        $this->getContext()->getInstance()->getConfiguration()->loadHelpers('I18N');
        
        $this->form = new sfsAdminChangePasswordForm($this->getUser()->getUser());
        
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('admin'));
            
            if ($this->form->isValid()) {
                $member = $this->form->updateObject();
                $member->save();
                
                $this->getUser()->setFlash('notice', __('Your password was changed'));
                $this->redirect('@administratorAdmin_changeMyPassword');
            }
            else {
                $this->getUser()->setFlash('error', __('The item has not been saved due to some errors.'));
            }
        }
    }
    
    public function executeResetPassword($request)
    {
        $id = $request->getParameter('id');
        
        $admin = AdminPeer::retrieveById($id, new Criteria());
        
        if ($admin != null) {
            $this->getContext()->getInstance()->getConfiguration()->loadHelpers('Url');
            
            $password = substr(md5(time() . rand(1, 10000)), 0, 8);
            
            $admin->setPassword($password);
            $admin->save();
            
            $urlToAdminPanel = url_for('@coreAdmin_login', true);
            
            $template = EmailTemplatePeer::retrieveByName(EmailTemplatePeer::RESET_PASSWORD);
            
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
            $this->getUser()->setFlash('notice', 'Password has been reset for administrator ' . $admin->getFullName());
        }
        
        $this->redirect('@administratorAdmin');
    }
    
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        
        if ($form->isValid()) {
            $this->getUser()->setFlash('notice', $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.');
            
            $admin = $form->updateObject();
            
            if ($admin->isNew()) {
                $password = substr(md5(time() . rand(1, 10000)), 0, 8);
                
                $admin->setPassword($password);
                
                $this->getContext()->getInstance()->getConfiguration()->loadHelpers('Url');
                $urlToAdminPanel = url_for('@administratorAdmin_login', true);
                
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
            
            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $admin)));
            
            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $this->getUser()->getFlash('notice').' You can add another one below.');
                
                $this->redirect('@administratorAdmin_new');
            }
            else {
                $this->redirect('@administratorAdmin_edit?id='.$admin->getId());
            }
        }
        else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.');
        }
    }
    
    public function executeLogin(sfWebRequest $request)
    {
        $this->getContext()->getInstance()->getConfiguration()->loadHelpers('I18N');
        
        $this->form = new sfsAdminLoginForm();
        
        if ($this->getUser()->isAuthenticated()) {
            $this->redirect('@administratorAdmin_login');
        }
        else {
            if ($request->isMethod('post')) {
                
                $data = $request->getParameter('admin');
                
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
        if($request->isXmlHttpRequest())
        {
            $this->getResponse()->setStatusCode(401);
        }
        
        return sfView::SUCCESS;
    }
    
    public function executeLogout()
    {
        $this->getUser()->logout();
        $this->redirect('@administratorAdmin_login');
    }
}
