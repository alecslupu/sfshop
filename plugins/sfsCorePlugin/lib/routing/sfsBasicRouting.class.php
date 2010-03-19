<?php

class sfsBasicRouting
{

  static public function registerRoutes(sfEvent $event, $file )
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
}