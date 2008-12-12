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
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class BaseDeliveryAdminActions extends autodeliveryAdminActions
{
    public function executeEdit()
    {
        $request = $this->getRequest();
        
        $criteria = new Criteria();
        DeliveryPeer::addAdminCriteria($criteria);
        $this->delivery = DeliveryPeer::retrieveById($request->getParameter('id'), $criteria);
        $this->forward404Unless($this->delivery);
        
        $this->form = new DeliveryForm();
        $this->form->setDefault('title', $this->delivery->getTitle());
        $this->form->setDefault('description', $this->delivery->getDescription());
        $this->form->setDefault('is_active', $this->delivery->getIsActive());
        
        $params = sfsJSONPeer::decode($this->delivery->getParams());
        
        $className = $this->delivery->getNameClassFormParams();
        $formParams = new $className();
        
        $this->form->setDefault('id', $request->getParameter('id'));
        
        foreach ($params as $key => $value) {
            $formParams->setDefault($key, $value);
        }
        
        $this->labels = $formParams->getWidgetSchema()->getLabels();
        $this->form->embedForm('params', $formParams);
        
        if ($this->getRequest()->isMethod('post')) {
            
            $data = $request->getParameter('data');
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
                    $this->getUser()->setFlash('notice', 'Your modifications have been saved');
                }
                
                $this->delivery->setParams($params);
                $this->delivery->save();
                
                $this->redirect('deliveryAdmin/list');
            }
        }
    }
}
