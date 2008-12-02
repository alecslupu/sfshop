<?php

/**
 * Class extends basic user class
 *
 * @package    sfsCorePlugin
 * @author     Dmitry Nesteruk, Andrey Kotlyarov
 */
class sfsSecurityUser extends sfBasicSecurityUser {
    
    protected $isInit = false;
    protected $user   = null;
    protected $model  = '';
    
    
    
    public function __construct($dispatcher, $storage, $options)
    {
        //sfsDebug::writeMessage('_construct');
        parent::__construct($dispatcher, $storage, $options);
        $this->init();
    }
    
    
    
    public function init($isForced = false)
    {
        //sfsDebug::writeMessage('init start ' . ($isForced ? 'TRUE' : 'FALSE') . ' uri' . $_SERVER['REQUEST_URI']);
        if ($isForced || !$this->isInit) {
            $this->user = null;
            $user_id = $this->getAttribute('id', null, $this->model);
            
            $this->user = call_user_func(
                array(
                    ucfirst($this->model) . 'Peer',
                    'retrieveById'
                ),
                $user_id
            );
            
            if ($user_id !== null && $this->user === null) {
                $this->logout();
                return ;
            }
            
            if ($user_id !== null) {
                $possibleCredentials = sfConfig::get('app_credentials_' . $this->model);
                $isNeedLogout = true;
                
                foreach ($possibleCredentials as $credential) {
                    if ($this->hasCredential($credential)) {
                        $isNeedLogout = false;
                        break;
                    }
                }
                
                if ($isNeedLogout) {
                    $this->logout();
                    return ;
                }
            }
            
            if ($this->user !== null) {
                $this->user->setAccessNum($this->user->getAccessNum() + 1);
                $this->user->save();
            }
            
            $this->isInit = true;
        }
        return ;
    }
    
    
    
    public function isAuthenticated()
    {
        return ($this->user !== null);
    }
    
    
    
   /**
    * Sets user authenticated
    * 
    * Adds attributes for authenticated member, sets credential
    *
    * @param  object $user
    * @return void
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @access public
    */
    public function login($user)
    {
        $this->setAttribute('id', $user->getId(), $this->model);
        $this->setAuthenticated(true);
        foreach (explode(',', $user->getCredential()) as $credential) {
            $credential = preg_replace("/(\s+$|^\s+)/", '', $credential);
            
            if ($credential != '') {
                $this->addCredential($credential);
            }
        }
        
        sleep(1);
        $this->init(true);
        
        return ;
    }
    
    
    
   /**
    * Sets user unauthenticated
    * 
    * Removes all user's attributes from sessions, clears credential
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @access public
    */
    public function logout()
    {
        $this->getAttributeHolder()->removeNamespace($this->model);
        
        if ($this->user !== null) {
            foreach (explode(',', $this->user->getCredential()) as $credential) {
                $credential = preg_replace("/(\s+$|^\s+)/", '', $credential);
                
                if ($credential != '') {
                    $this->removeCredential($credential);
                }
            }
        }
        
        sleep(1);
        $this->init(true);
        
        return ;
    }
    
    
    
   /**
    * Gets user object from session
    * 
    * @param void
    * @return object
    * @author Andrey Kotlyarov
    * @access public
    */
    public function getUser()
    {
        return $this->user;
    }
    
    
    
   /**
    * Gets user's id from session
    *
    * @param  void
    * @return int if user is authenticated, otherwise null
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @access public
    */
    public function getUserId()
    {
        if ($this->isAuthenticated()) {
            return $this->user->getId();
        } else {
            return null;
        }
    }
    
    
    
   /**
    * Gets user's full name from session
    *
    * @param  void
    * @return string
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @access public
    */
    public function getUserName()
    {
        $userName = 'Guest';
        if ($this->isAuthenticated()) {
            $userName = $this->user->getFullName();
        }
        return $userName;
    }
   
}