<?php
class sfsCoreRouting extends sfsBasicRouting
{

  static public function listenToCoreRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $file = dirname(__FILE__).'/../../modules/core/config/routing.yml';

    self::registerRoutes($event, $file);
  }

  static public function listenToInformationRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $file = dirname(__FILE__).'/../../modules/information/config/routing.yml';

    self::registerRoutes($event, $file);
  }

  static public function listenToMenuRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $file = dirname(__FILE__).'/../../modules/menu/config/routing.yml';

    self::registerRoutes($event, $file);
  }
}