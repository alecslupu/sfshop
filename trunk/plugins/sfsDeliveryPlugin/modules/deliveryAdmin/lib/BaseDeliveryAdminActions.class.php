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
 * deliveryAdmin actions.
 *
 * @package    plugin.sfsDeliveryPlugin
 * @subpackage modules.deliveryAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseDeliveryAdminActions extends autodeliveryAdminActions
{
    public function executeEdit(sfWebRequest $request)
    {
        $criteria = new Criteria();
        DeliveryPeer::addAdminCriteria($criteria);
        $this->delivery = DeliveryPeer::retrieveById($request->getParameter('id'), $criteria);
        $this->forward404Unless($this->delivery);
        
        $this->form = new DeliveryForm($this->delivery);
        
        $params = sfsJSONPeer::decode($this->delivery->getParams());
        
        $className = $this->delivery->getNameClassFormParams();
        $formParams = new $className();
        
        $this->form->setDefault('id', $request->getParameter('id'));
        
        foreach ($params as $key => $value) {
            $formParams->setDefault($key, $value);
        }
        
        $this->labels = $formParams->getWidgetSchema()->getLabels();
        $this->form->embedForm('params', $formParams);
        
        if ($request->isMethod('post')) {
            
            $data = $request->getParameter('delivery');
            $this->form->bind($data);
            
            if ($this->form->isValid()) {
                
                foreach ($params as $key => $value) {
                    if (!isset($data['params'][$key]) && !is_bool($value)) {
                        $data['params'][$key] = $value;
                    }
                    else {
                        if (isset($data['params'][$key]) && $data['params'][$key] == 'on' && is_bool($value)) {
                            $data['params'][$key] = true;
                        }
                        else if(!isset($data['params'][$key]) && is_bool($value)) {
                            $data['params'][$key] = false;
                        }
                    }
                }
                
                $params = sfsJSONPeer::encode($data['params']);
                
                $this->delivery->setTitle($data['title']);
                $this->delivery->setDescription($data['description']);
                
                if (isset($data['is_active'])) {
                    $this->delivery->setIsActive(true);
                }
                else {
                    $this->delivery->setIsActive(false);
                }
                
                $acceptCurrenciesCodes = $this->delivery->getAcceptCurrenciesCodes();
                $criteria = new Criteria();
                CurrencyPeer::addPublicCriteria($criteria);
                $isExist = CurrencyPeer::checkExistenceByCodes(explode(',', $acceptCurrenciesCodes), $criteria);
                
                if (!$isExist) {
                    $this->getUser()->setFlash('notice', 'Your modifications have been saved, 
                        but this service is inactive, because your store does not use currencies which accept this service.
                        This service is accept following currencies: ' . str_replace(',', ', ', $acceptCurrenciesCodes));
                    $this->delivery->setIsActive(false);
                }
                else {
                    $this->getUser()->setFlash('notice', 'The item was updated successfully.');
                }
                
                $this->delivery->setParams($params);
                $this->delivery->save();
            }
        }
    }
    
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();
        
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        
        $this->getRoute()->getObject()->setIsDeleted(true);
        $this->getRoute()->getObject()->save();
        
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@deliveryAdmin');
    }
    
    protected function executeBatchDelete(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        
        $criteria = new Criteria();
        $criteria->add(DeliveryPeer::ID, $ids, Criteria::IN);
        
        $deliveries = DeliveryPeer::getAll($criteria);
        
        foreach ($deliveries as $delivery) {
            $delivery->setIsDeleted(true);
            $delivery->save();
        }
        
        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        
        $this->redirect('@deliveryAdmin');
    }
}
