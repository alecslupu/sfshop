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
 * Subclass for performing query and update operations on the 'admin' table.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: AdminPeer.php 6174 2007-11-27 06:22:40Z fabien $
 */ 
class AdminPeer extends BaseAdminPeer
{
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