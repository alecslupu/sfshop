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
 * Subclass for performing query and update operations on the 'option_value' table.
 * 
 * @package    plugin.sfsProductPlugin
 * @subpackage lib.model.common
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */ 
class OptionValuePeer extends BaseOptionValuePeer
{
    public static function addPublicCriteria(Criteria $criteria)
    {
        self::addAdminCriteria($criteria);
        $criteria->addAnd(self::IS_ACTIVE, 1);
    }

    public static function addAdminCriteria(Criteria $criteria)
    {
        $criteria->addAnd(self::IS_DELETED, 0);
    }


    /**
     * Get option values by $optionTypeId.
     * 
     * @param  int $typeId
     * @return array
     * @author Dmitry Nesteruk <nesterukd@gmail.com>
     * @access public
     */
    public static function getByTypeId($typeId, $criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }

        $criteria->add(self::TYPE_ID, $typeId);
        $criteria->addAscendingOrderByColumn(self::POS);
        return self::doSelect($criteria);
    }

    /**
     * Sets all option values as deleted by typeId.
     * 
     * @param  int $typeId
     * @return void
     * @author Dmitry Nesteruk <nesterukd@gmail.com>
     * @access public
     */
    public static function deleteByTypeId($typeId)
    {
        $criteriaWhere = new Criteria();
        $criteriaWhere->add(self::TYPE_ID, $typeId);

        $criteriaSet = new Criteria();
        $criteriaSet->add(self::IS_DELETED, 1);

        BasePeer::doUpdate($criteriaWhere, $criteriaSet, Propel::getConnection(self::DATABASE_NAME));
    }
}
