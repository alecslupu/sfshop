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
 * Base optionValue admin actions.
 *
 * @package    plugins.sfsProductPlugin
 * @subpackage modules.optionValueAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class BaseOptionValueAdminActions extends autooptionValueAdminActions
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
