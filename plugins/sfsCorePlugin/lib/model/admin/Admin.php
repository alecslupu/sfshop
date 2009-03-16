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
 * Subclass for representing a row from the 'admin' table.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.model
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */ 
class Admin extends BaseAdmin
{
   /**
    * Sets credintial.
    * Converts credintial from array to string.
    * 
    * @param  mixed $value
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function setCredential($value)
    {
        if (is_array($value)) {
            $value = implode(',', $value);
        }
        
        parent::setCredential($value);
    }

   /**
    * Checks password entered and password of current admin.
    * Code from sfGuardUserPlugin
    *
    * @param  string $password
    * @return bool true if password is match, otherwise false
    * @author Andreas Nyholm
    * @access public
    */
    public function checkPassword($password)
    {
        $algorithm = $this->getAlgorithm();
        if (false !== $pos = strpos($algorithm, '::'))
        {
          $algorithm = array(substr($algorithm, 0, $pos), substr($algorithm, $pos + 2));
        }
        if (!is_callable($algorithm))
        {
          throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithm));
        }
    
        return $this->getPassword() == call_user_func_array($algorithm, array($this->getSalt().$password));
        
    }
    
   /**
    * Crypts password with salt and selected algorithm.
    * Code from sfGuardUserPlugin
    *
    * @param  string $password
    * @return void
    * @author Andreas Nyholm
    * @access public
    */
    public function setPassword($password)
    {
        if (!$password && 0 == strlen($password))
        {
          return;
        }
    
        if (!$salt = $this->getSalt())
        {
          $salt = md5(rand(100000, 999999).$this->getEmail());
          $this->setSalt($salt);
        }
        $algorithm = sfConfig::get('app_admin_algorithm_callable', 'sha1');
        $algorithmAsStr = is_array($algorithm) ? $algorithm[0].'::'.$algorithm[1] : $algorithm;
        if (!is_callable($algorithm))
        {
          throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithmAsStr));
        }
        $this->setAlgorithm($algorithmAsStr);
    
        parent::setPassword(call_user_func_array($algorithm, array($salt.$password)));
        
    }
    
   /**
    * Get full admin name
    *
    * @param  void
    * @return string $value
    * @author Andrey Kotlyarov
    * @access public
    */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }
    
}
