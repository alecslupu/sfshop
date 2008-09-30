<?php

/**
 * core actions.
 *
 * @package    sfShop
 * @subpackage core
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class coreActions extends sfActions
{
    /**
    * Change language action.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeChangeLanguage()
    {
        $language = LanguagePeer::retrieveByPK($this->getRequestParameter('culture'));
        
        if ($language !==null && $language->getIsActive()) {
            $this->getUser()->setCulture($this->getRequestParameter('culture'));
        }
        
        $this->redirect($this->getRequest()->getReferer());
    }
    
    public function executeError404()
    {
        exit;
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
