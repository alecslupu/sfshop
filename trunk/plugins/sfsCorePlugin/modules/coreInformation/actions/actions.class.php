<?php

/**
 * information actions.
 *
 * @package    sfShop
 * @subpackage information
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class coreInformationActions extends sfActions
{
   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeDetails()
    {
        $criteria = new Criteria();
        InformationPeer::addPublicCriteria($criteria);
        $this->information = InformationPeer::retrieveById($this->getRequestParameter('id'), $criteria);
        $this->forward404Unless($this->information);
        
        $response = $this->getResponse();
        $response->addMeta('keywords', $this->information->getMetaKeywords(), true);
        $response->addMeta('description', $this->information->getMetaDescription(), true);
    }
}
