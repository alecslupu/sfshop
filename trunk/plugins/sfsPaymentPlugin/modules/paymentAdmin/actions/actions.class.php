<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * paymentAdmin actions.
 *
 * @package    plugin.sfsPaymentPlugin
 * @subpackage modules.paymentAdmin
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class paymentAdminActions extends autopaymentAdminActions
{
    public function executeEdit()
    {
        $request = $this->getRequest();
        
        $criteria = new Criteria();
        PaymentPeer::addAdminCriteria($criteria);
        $this->payment = PaymentPeer::retrieveById($request->getParameter('id'), $criteria);
        $this->forward404Unless($this->payment);
        
        $this->form = new PaymentForm();
        $this->form->setDefault('title', $this->payment->getTitle());
        $this->form->setDefault('description', $this->payment->getDescription());
        $this->form->setDefault('is_active', $this->payment->getIsActive());
        
        $params = sfsJSONPeer::decode($this->payment->getParams());
        $className = $this->payment->getNameClassFormParams();
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
                
                $this->payment->setTitle($data['title']);
                $this->payment->setDescription($data['description']);
                
                if (isset($data['is_active'])) {
                    $this->payment->setIsActive(true);
                }
                else {
                    $this->payment->setIsActive(false);
                }
                
                $acceptCurrenciesCodes = $this->payment->getAcceptCurrenciesCodes();
                $criteria = new Criteria();
                CurrencyPeer::addPublicCriteria($criteria);
                $isExist = CurrencyPeer::checkExistenceByCodes(explode(',', $acceptCurrenciesCodes), $criteria);
                
                if (!$isExist) {
                    $this->getUser()->setFlash('notice', 'Your modifications have been saved, 
                        but this service is inactive, because your store does not use currencies which accept this service.
                        This service is accept following currencies: ' . str_replace(',', ', ', $acceptCurrenciesCodes));
                    $this->payment->setIsActive(false);
                }
                else {
                    $this->getUser()->setFlash('notice', 'Your modifications have been saved');
                }
                
                $this->payment->setParams($params);
                $this->payment->save();
                
                $this->redirect('paymentAdmin/list');
            }
        }
    }
}
