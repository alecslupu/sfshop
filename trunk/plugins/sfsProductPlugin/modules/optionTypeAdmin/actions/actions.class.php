<?php

/**
 * optionTypeAdmin actions.
 *
 * @package    sfShop
 * @subpackage optionTypeAdmin
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class optionTypeAdminActions extends autooptionTypeAdminActions
{
    public function executeDelete()
    {
        if ($this->hasRequestParameter('id')) {
            $option = OptionTypePeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($option);
            
            $option->setIsDeleted(1);
            $option->save();
            
            $this->redirect('optionTypeAdmin/list');
        }
    }
    
    public function executeValuesList()
    {
        sfLoader::loadHelpers('Url');
        $this->redirect(url_for('optionValueAdmin/list', true) . '?filters[type_id]=' . $this->getRequestParameter('id') . '&filter=filter');
    }
    
    protected function addFiltersCriteria($c)
    {
        parent::addFiltersCriteria($c);
    }
}
