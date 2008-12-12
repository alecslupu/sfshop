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
 * Base currencyAdmin actions.
 *
 * @package    pugins.sfsCurrencyPlugin
 * @subpackage modules.currencyAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class BaseCurrencyAdminActions extends autocurrencyAdminActions
{
    protected function deleteCurrency($currency)
    {
        if ($currency->getIsDefault()) {
            $this->getRequest()->setError('delete', 'You can not delete this currency, bacause it is a default currency, you can rename it only.');
            return $this->forward('currencyAdmin', 'list');
        }
        else {
            parent::deleteCurrency($currency);
        }
    }
}
