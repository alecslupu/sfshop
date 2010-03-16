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
 * Base core actions.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.core
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BaseCoreActions extends sfActions
{
   /**
    * Change language action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeChangeLanguage($request)
    {
        $criteria = new Criteria();
        LanguagePeer::addPublicCriteria($criteria);
        $language = LanguagePeer::retrieveByCulture($request->getParameter('culture'), $criteria);
        
        if ($language !== null) {
            $this->getUser()->setCulture($request->getParameter('culture'));
        }
        $this->redirect($request->getReferer() ? $request->getReferer() : '@localized_homepage');
    }
    
   /**
    * Action for 404 error (Page not found).
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeError404()
    {
        return sfView::SUCCESS;
    }
    
   /**
    * Action for 500 error (Server inernal error).
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeError500()
    {
        return sfView::SUCCESS;
    }
    
   /**
    * Form for send letter from site to administrator (Contact us).
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeContactUs($request)
    {
        $this->form = new sfsContactUsForm();
        
        if ($this->getRequest()->isMethod('post')) {
            $data = $request->getParameter('data');
            $this->form->bind($data);
            
            if ($this->form->isValid()) {
                $mail = new sfsMail();
                $mail->addAddress(sfConfig::get('app_mail_address_feedback'));
                $mail->setFrom($data['first_name'] . ' ' . $data['last_name'] . '<' . $data['email'] . '>');
                $mail->setSubject($data['subject']);
                $mail->setBody($data['body']);
                $mail->send();
                $this->getUser()->setFlash('message', 'Your letter sent. Thanks!');
            }
        }
    }
}
