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
 * Subclass for performing query and update operations on the 'admin' table.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */ 
class AdminPeer extends BaseAdminPeer
{
   /**
    * Gets object by \$id.
    * 
    * @param  int \$id
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public static function retrieveById($id, $criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::ID,(int) $id);
        
        if ($withI18n) {
            $criteria->setLimit(1);
            list($object) = self::doSelectWithI18n($criteria);
            return $object;
        }
        else {
            return self::doSelectOne($criteria);
        }
    }
 
   /**
    * Get admin object by email
    *
    * @param  string $email
    * @return mixed if admin exist returns object, otherwise null
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @access public
    */
    public static function retrieveByEmail($email)
    {
        $criteria = new Criteria();
        $criteria->add(self::EMAIL, $email, Criteria::EQUAL);
        return self::doSelectOne($criteria);
    }
}
