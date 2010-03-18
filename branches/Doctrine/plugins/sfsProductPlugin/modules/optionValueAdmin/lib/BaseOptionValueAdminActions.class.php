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
 * @version    SVN: $Id$
 */
class BaseOptionValueAdminActions extends autooptionValueAdminActions
{
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();
        
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        
        $this->getRoute()->getObject()->setIsDeleted(true);
        $this->getRoute()->getObject()->save();
        
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@optionValueAdmin');
    }
    
    protected function executeBatchDelete(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        
        $criteria = new Criteria();
        $criteria->add(OptionValuePeer::ID, $ids, Criteria::IN);
        
        $optionValues = OptionValuePeer::getAll($criteria);
        
        foreach ($optionValues as $optionValue) {
            $optionValue->setIsDeleted(true);
            $optionValue->save();
        }
        
        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        $this->redirect('@optionValueAdmin');
    }
    
    public function executeNew(sfWebRequest $request)
    {
        $this->form = $this->configuration->getForm();
        
        $filters = $this->getFilters();
        
        if (isset($filters['type_id']) && $filters['type_id'] != '') {
            $this->form->setDefault('type_id', $filters['type_id']);
        }
        
        $this->option_value = $this->form->getObject();
    }
/*
    
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
    */
}
