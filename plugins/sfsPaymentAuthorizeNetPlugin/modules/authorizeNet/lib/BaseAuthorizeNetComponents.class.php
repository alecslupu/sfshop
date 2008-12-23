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
 * Base authorizeNet components.
 *
 * @package    plugins.sfsPaymentAuthorizeNetPlugin
 * @subpackage modules.authorizeNet
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseAuthorizeNetComponents extends sfComponents
{
   /**
    * Form for set credit card info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeCardForm()
    {
        $response = $this->getResponse();
        $response->addJavaScript('/js/sfsForm.js');
        $this->form = new sfsAuthorizeNetChargeForm();
        
        $cardData = $this->getUser()->getAttribute('card_data', null, 'order/payment/authorizenet');
        
        if ($cardData != null) {
            $this->form->setDefaults($cardData);
        }
    }
}
