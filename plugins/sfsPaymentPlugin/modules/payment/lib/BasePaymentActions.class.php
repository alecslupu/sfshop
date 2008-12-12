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
 * Base payment actions.
 *
 * @package    plugins.sfsPaymentPlugin
 * @subpackage modules.payment
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BasePaymentActions extends sfActions
{
   /**
    * Show all available payment methods with form for choose some.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeCheckout($request)
    {
        sfLoader::loadHelpers(array('Asset', 'Tag', 'I18N'));
        
        $sfUser = $this->getUser();
        
        $deliveryMethodId = $sfUser->getAttribute('method_id', null, 'order/delivery');
        
        if ($deliveryMethodId !== null) {
            $sfUser = $this->getUser();
            
            $defaultMethodId = $sfUser->getAttribute('method_id', null, 'order/payment');
            $this->form = new sfsPaymentSelectForm();
            $this->form->setDefault('method_id', $defaultMethodId);
            
            $this->paymentServices = $this->form->getPaymentServices();
            
            if ($request->isMethod('post')) {
                $data = $request->getParameter('data');
                $this->form->bind($data);
                
                if ($this->form->isValid()) {
                    $sfUser->setAttribute('method_id', $data['method_id'], 'order/payment');
                    
                    if ($request->isXmlHttpRequest()) {
                        
                        foreach ($this->paymentServices as $paymentService) {
                            if ($paymentService->getId() == $data['method_id']) {
                                $service = $paymentService;
                            }
                        }
                        
                        if ($service->getIcon()) {
                            $serviceIconSrc = '/images/' . sfConfig::get('app_icons_delivery_web_dir') . '/' . $service->getIcon();
                        }
                        else {
                            $serviceIconSrc = '';
                        }
                        
                        $data = array(
                            'service_title'     => $service->getTitle(),
                            'service_icon_src'  => $serviceIconSrc
                        );
                        
                        return $this->renderText(sfsJSONPeer::createResponseSuccess($data));
                    }
                    else {
                        $this->redirect('@order_checkoutConfirmation');
                    }
                }
            }
        }
        else {
            $this->redirect('@delivery_checkout');
        }
    }
    
   /**
    * If some charge is fail, the member will be returned on this page.
    * 
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeChargeFailed($request)
    {
        return sfView::SUCCESS;
    }
}
