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
 * Subclass for performing query and update operations on the 'languages' table.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.model.common
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class LanguagePeer extends BaseLanguagePeer
{
   /**
    * Gets default language
    *
    * @param  void
    * @return object
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function getDefault()
    {
        $criteria = new Criteria();
        $criteria->add(self::IS_DEFAULT, 1);
        return self::doSelectOne($criteria);
    }
    
   /**
    * Get language object by culture.
    *
    * @param  string $culture
    * @param  object $criteria
    * @return mixed if language exist returns object, otherwise null.
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public static function retrieveByCulture($culture, $criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::CULTURE, $culture, Criteria::EQUAL);
        return self::doSelectOne($criteria);
    }
}
