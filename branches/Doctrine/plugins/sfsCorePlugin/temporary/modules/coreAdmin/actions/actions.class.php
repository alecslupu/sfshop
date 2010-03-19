<?php

/**
 * admin actions.
 *
 * @package    sfShop
 * @subpackage admin
 * @author     Your name here
 * @version    SVN: $Id$
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
        return sfView::SUCCESS;
    }
}
