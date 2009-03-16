<?php

/**
 * Subclass for representing a row from the 'members' table.
 *
 * @package plugins.sfsMemberPlugin.lib.model
 */ 
class Member extends BaseMember
{ 
   /**
    * Checks password entered and password of current member.
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
        $algorithm = sfConfig::get('app_member_algorithm_callable', 'sha1');
        $algorithmAsStr = is_array($algorithm) ? $algorithm[0].'::'.$algorithm[1] : $algorithm;
        if (!is_callable($algorithm))
        {
          throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithmAsStr));
        }
        $this->setAlgorithm($algorithmAsStr);
    
        parent::setPassword(call_user_func_array($algorithm, array($salt.$password)));
        
    }
    
   /**
    * Get full member name
    *
    * @param  void
    * @return string $value
    * @author Andrey Kotlyarov
    * @access public
    */
    public function getFullName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }
}
