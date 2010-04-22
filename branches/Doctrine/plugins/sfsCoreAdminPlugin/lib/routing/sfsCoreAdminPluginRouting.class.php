<?php

class sfsCoreAdminPluginRouting
{
  public static function listenToSfsCoreAdminLayoutRoutingLoadConfigurationEvent(sfEvent $event)
  {

  }
  public static function listenToSfsCoreAdminRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    // preprend our routes
    $r->prependRoute('homepage', new sfRoute('/', array('module' => 'sfsCoreAdmin', 'action' => 'index')));
    $r->prependRoute('sf_guard_signin', new sfRoute('/login', array('module' => 'sfsCoreAdmin', 'action' => 'signin')));
   	$r->prependRoute('sf_guard_signout', new sfRoute('/logout', array('module' => 'sfsCoreAdmin', 'action' => 'signout')));
   	$r->prependRoute('sf_guard_password', new sfRoute('/request_password', array('module' => 'sfsCoreAdmin', 'action' => 'password')));
  }
}