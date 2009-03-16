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
 * Tax components.
 *
 * @package    pugins.sfsTaxPlugin
 * @subpackage modules.tax
 * @author     Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseTaxComponents extends sfComponents
{
   /**
    * Tax  info.
    *
    * @param  void
    * @return void
    * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
    * @access public
    */
    public function executeOrderTaxInfo()
    {
        $sfUser = $this->getUser();
        if(!$this->deliveryService) {
            $this->deliveryService = array(
                'price'         => $sfUser->getAttribute('price', null, 'order/delivery'),
                'tax'           => $sfUser->getAttribute('tax', null, 'order/delivery'),
                'tax_type_id'   => $sfUser->getAttribute('tax_type_id', null, 'order/delivery'),
            );
            if($this->deliveryService['tax_type_id'])
                $this->deliveryService['tax_title'] = TaxTypePeer::retriveById($this->deliveryService['tax_type_id'])->getTitle();
        }
        if(!$this->paymentService) {
            $this->paymentService = array(
                'price'         => $sfUser->getAttribute('price', null, 'order/paymeny'),
                'tax'           => $sfUser->getAttribute('tax', null, 'order/payment'),
                'tax_type_id'   => $sfUser->getAttribute('tax_type_id', null, 'order/payment'),
            );
            if($this->paymentService['tax_type_id'])
                $this->paymentService['tax_title'] = TaxTypePeer::retriveById($this->paymentService['tax_type_id'])->getTitle();
        }
        $price = array();
        $price[0] = array(
                            'tax_title'     => __('Tax free'),
                            'net_price'     => 0,
                            'gross_price'   => 0,
                            'tax'           => 0,
                        );
        foreach($this->itemProducts as $itemProduct) {
            $taxTypeId = (int) $itemProduct->getTaxTypeId();
            if(array_key_exists($taxTypeId,$price)) {
                $price[$taxTypeId]['net_price']     += $itemProduct->getTotalNetPrice();
                $price[$taxTypeId]['gross_price']   += $itemProduct->getTotalGrossPrice();
                $price[$taxTypeId]['tax']           += ($itemProduct->getTotalGrossPrice() - $itemProduct->getTotalNetPrice());
            }
            else {
                $price[$taxTypeId] = array(
                                'tax_title'     => $itemProduct->getTaxTitle(),
                                'net_price'     => $itemProduct->getTotalNetPrice(),
                                'gross_price'   => $itemProduct->getTotalGrossPrice(),
                                'tax'           => $itemProduct->getTotalGrossPrice() - $itemProduct->getTotalNetPrice(),
                            );
            }
        }
        $taxTypeId = (int) $this->deliveryService['tax_type_id'];
        if(array_key_exists($taxTypeId,$price)) {
            $price[$taxTypeId]['net_price']     += $this->deliveryService['price'];
            $price[$taxTypeId]['gross_price']   += ($this->deliveryService['price'] + $this->deliveryService['tax']);
            $price[$taxTypeId]['tax']           += $this->deliveryService['tax'];
        }
        else {
            $price[$taxTypeId] = array(
                            'tax_title'     => $this->deliveryService['tax_title'],
                            'net_price'     => $this->deliveryService['price'],
                            'gross_price'   => ($this->deliveryService['price'] + $this->deliveryService['tax']),
                            'tax'           => $this->deliveryService['tax'],
                        );
        }

        $taxTypeId = (int) $this->paymentService['tax_type_id'];
        if(array_key_exists($taxTypeId,$price)) {
            $price[$taxTypeId]['net_price']     += $this->paymentService['price'];
            $price[$taxTypeId]['gross_price']   += ($this->paymentService['price'] + $this->paymentService['tax']);
            $price[$taxTypeId]['tax']           += $this->paymentService['tax'];
        }
        else {
            $price[$taxTypeId] = array(
                            'tax_title'     => $this->paymentService['tax_title'],
                            'net_price'     => $this->paymentService['price'],
                            'gross_price'   => ($this->paymentService['price'] + $this->paymentService['tax']),
                            'tax'           => $this->paymentService['tax'],
                        );
        }
        $this->totalNet = 0;
        $this->totalGross = 0;
        $this->totalTax = 0;
        
        foreach($price as $item) {
            $this->totalNet += $item['net_price']; 
            $this->totalGross += $item['gross_price']; 
            $this->totalTax += $item['tax']; 
        }
        $this->price = $price;
    }
    
}
