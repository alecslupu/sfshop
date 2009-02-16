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
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();
        
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        
        if ($this->getRoute()->getObject()->getIsDefault()) {
            $this->getUser()->setFlash('error', 'You can not delete currency "' . $this->getRoute()->getObject()->getTitle() . '", bacause it is a default currency, you can rename it only.');
        }
        else {
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
            $this->getRoute()->getObject()->delete();
        }
        
        $this->redirect('@currencyAdmin');
    }
    
    protected function executeBatchDelete(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        
        $criteria = new Criteria();
        $criteria->add(CurrencyPeer::ID, $ids, Criteria::IN);
        $currencies = CurrencyPeer::getAll($criteria);
        
        foreach ($currencies as $currency) {
            if ($currency->getIsDefault()) {
                $this->getUser()->setFlash('error', 'You can not delete currency "' . $currency->getTitle() . '", bacause it is a default currency, you can rename it only.');
            }
            else {
                $currency->delete();
                $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
            }
        }
        $this->redirect('@currencyAdmin');
    }
}
