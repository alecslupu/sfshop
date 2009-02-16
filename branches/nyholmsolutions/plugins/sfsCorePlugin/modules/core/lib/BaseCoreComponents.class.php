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
 * Base core components.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.core
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 */
class BaseCoreComponents extends sfComponents
{

    public function executeSelectLanguage()
    {
        $criteria = new Criteria();
        LanguagePeer::addPublicCriteria($criteria);
        $this->languages = LanguagePeer::getAll($criteria);
    }
}
