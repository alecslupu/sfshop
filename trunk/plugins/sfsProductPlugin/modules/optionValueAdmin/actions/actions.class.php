<?php

/**
 * optionValueAdmin actions.
 *
 * @package    sfShop
 * @subpackage optionValueAdmin
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class optionValueAdminActions extends autooptionValueAdminActions
{
    public function executeDelete()
    {
        if ($this->hasRequestParameter('id')) {
            $option = OptionValuePeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($option);
            
            $option->setIsDeleted(1);
            $option->save();
            
            $this->redirect('optionValueAdmin/list');
        }
    }
}
