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
 * Gets available method for shipping and shipping cost.
 *
 * @package    plugins.sfDeliveryFlatPlugin
 * @subpackage lib
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfAction.class.php 9477 2008-06-09 09:41:14Z fabien $
 */
class sfsFlatService extends sfsBaseDeliveryService
{
    
    public function getQuote()
    {
        $this->quotes = array(array(
            'id'    => 1,
            'title' => $this->params['title'],
            'price' => $this->params['price']
        ));
        return $this->quotes;
    }
}
