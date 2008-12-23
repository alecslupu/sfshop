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
 * Gets available method for shipping and shipping cost.
 *
 * @package    plugins.sfDeliveryFlatPlugin
 * @subpackage lib
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
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
