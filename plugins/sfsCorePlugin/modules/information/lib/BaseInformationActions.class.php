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
 * Base information actions.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.information
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseInformationActions extends sfActions
{
    public function executeDetails()
    {
        $criteria = new Criteria();
        InformationPeer::addPublicCriteria($criteria);
        $this->information = InformationPeer::retrieveById($this->getRequestParameter('id'), $criteria);
        $this->forward404Unless($this->information);
        
        $response = $this->getResponse();
        $response->addMeta('keywords', $this->information->getMetaKeywords(), true);
        $response->addMeta('description', $this->information->getMetaDescription(), true);
    }
}
