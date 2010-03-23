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
 * Base sfGuardAuth components.
 *
 * @package    plugins.sfsCorePlugin
 * @subpackage modules.sfGuardAuth
 * @author     Marius Rugan <mariusrugan@gmail.com>
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BasesfGuardAuthComponents extends sfComponents 
{
    public function executeSignin()
    {
        //$this->getContext()->getConfiguration()->loadHelpers('sfsCategory');
        
        $request = $this->getRequest();
        
        $controller = $this->getController();
        $actionInstance = $controller->getActionStack()->getLastEntry()->getActionInstance();
        //$actionInstance->forward404Unless($currentCategory);
            
        $response = $this->getResponse();
        //$response->addMeta('keywords', $currentCategory->getMetaKeywords(), true);
        //$response->addMeta('description', $currentCategory->getMetaDescription(), true);
    }
}
