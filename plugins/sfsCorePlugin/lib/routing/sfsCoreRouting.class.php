<?php
class sfsCoreRouting
{
  static private function registerRoutes(sfEvent $event, $file )
  {
    if (false == file_exists($file))
    {
      return ;
    }
    $r = $event->getSubject();

    $routes = new sfRoutingConfigHandler();
    $routes = $routes->evaluate(array($file));

    foreach ($routes as $key => $value)
    {
      $r->prependRoute($key, $value);
    }
    unset($routes);
    unset($r);
  }

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