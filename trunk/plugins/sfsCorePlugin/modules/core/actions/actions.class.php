<?php

/**
 * core actions.
 *
 * @package    sfShop
 * @subpackage core
 * @author     Your name here
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
        $language = sfsLanguagePeer::retrieveByPK($this->getRequestParameter('culture'));
        
        if ($language->isActive()) {
            $this->getUser()->setCulture($this->getRequestParameter('culture'));
        }
        
        $this->redirect($this->getRequest()->getReferer());
    }
}
