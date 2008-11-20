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
    
    public function handleErrorEdit()
    {
        $request = $this->getRequest();
        
        if ($request->isXmlHttpRequest()) {
            
            $errors = array();
            
            foreach ($request->getErrors() as $key => $error) {
                
                $matches = '';
                preg_match('/option_value\{(.*?)\}/', $key, $matches);
                
                $errors[$matches[1]] = $error;
            }
            
            return $this->renderText(sfsJSONPeer::createResponseError($errors));
        }
        else {
            return parent::handleErrorEdit();
        }
    }
    
    public function handlePost($type)
    {
        $request = $this->getRequest();
        
        if ($request->isXmlHttpRequest()) {
            $this->updateOptionValueFromRequest();
            
            $this->saveOptionValue($this->option_value);
            
            $response = array(
                'id'    => $this->option_value->getId(),
                'title' => $this->option_value->getTitle()
            );
            
            return $this->renderText(sfsJSONPeer::createResponseSuccess($response));
        }
        else {
            parent::handlePost($type);
        }
    }
}
