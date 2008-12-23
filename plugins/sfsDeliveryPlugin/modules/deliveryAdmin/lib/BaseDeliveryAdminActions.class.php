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
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        
        if ($form->isValid()) {
            
            $delivery = $form->updateObject();
            
            $params = sfsJSONPeer::decode($delivery->getParams());
            
            $data = $request->getParameter($form->getName());
            $newParams = $data['_params'];
            
            foreach ($params as $key => $value) {
                if (!isset($newParams[$key]) && !is_bool($value)) {
                    $newParams[$key] = $value;
                }
                else {
                    if (isset($newParams[$key]) && $newParams[$key] == 'on' && is_bool($value)) {
                        $newParams[$key] = true;
                    }
                    else if(!isset($newParams[$key]) && is_bool($value)) {
                        $newParams[$key] = false;
                    }
                }
            }
            
            $params = sfsJSONPeer::encode($newParams);
            $delivery->setParams($params);
            
            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $delivery)));
            
            $acceptCurrenciesCodes = $delivery->getAcceptCurrenciesCodes();
            
            if ($acceptCurrenciesCodes != '*') {
                $criteria = new Criteria();
                CurrencyPeer::addPublicCriteria($criteria);
                $isExist = CurrencyPeer::checkExistenceByCodes(explode(',', $acceptCurrenciesCodes), $criteria);
            }
            else {
                $isExist = true;
            }
            
            if (!$isExist) {
                $this->getUser()->setFlash('notice', 'Your modifications have been saved, 
                    but this service is inactive, because your store does not use currencies which accept this service.
                    This service is accept following currencies: ' . str_replace(',', ', ', $acceptCurrenciesCodes));
                $delivery->setIsActive(false);
            }
            else {
                $this->getUser()->setFlash('notice', 'The item was updated successfully.');
            }
            
            $delivery->save();
            
            $this->redirect('@deliveryAdmin_edit?id='.$delivery->getId());
        }
        else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.');
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
