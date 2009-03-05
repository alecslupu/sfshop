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
 * Base information components.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.information
 * @author     Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BaseInformationComponents extends sfComponents
{
    public function executeDetails()
    {
        $criteria = new Criteria();
        InformationPeer::addPublicCriteria($criteria);
        $this->information = InformationPeer::retrieveById($this->id, $criteria);
        if($this->information)
            $this->description = $this->information->getDescription();
        else
            return sfView::NONE;
    }
}
