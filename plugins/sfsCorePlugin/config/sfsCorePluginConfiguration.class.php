<?php

/**
 * sfDoctrineGuardPlugin configuration.
 *
 * @package    sfsCorePlugin
 * @subpackage config
 * @author     Alexandru Emil Lupu <gang.alecs@gmail.com>
 */
class sfsCorePluginConfiguration extends sfPluginConfiguration
{
  /**
   * Plugin global modules that needs to be loaded
   *
   * @var Array
   */
  private $global_modules = array(
      'core'
  );

  private $frontend_modules = array(
        'information',
        'menu'
  );

  /**
   * Plugin backend modules that needs to be loaded
   *
   * @var Array
   */
  private $backend_modules = array(
      'administrationAdmin',
      'countryAdmin',
      'emailTemplateAdmin',
      'coreAdmin',
      'stateAdmin',
      'languageAdmin',
      'informationAdmin'
  );

  /**
   * Constructor.
   *
   * @param sfProjectConfiguration $configuration The project configuration
   * @param string                 $rootDir       The plugin root directory
   * @param string                 $name          The plugin name
   */
  public function __construct(sfProjectConfiguration $configuration, $rootDir = null, $name = null)
  {
    parent::__construct($configuration, $rootDir, $name);

    if ($this->configuration instanceof sfApplicationConfiguration)
    {
      $this->registerRoutes();
    }
  }

  private function registerRoutes()
  {
    $this->registerRoutesForModules($this->global_modules);
    if (sfConfig::get('sf_app') == 'frontend')
    {
      $this->registerRoutesForModules($this->frontend_modules);
    }
    if (sfConfig::get('sf_app') == 'backend')
    {
      $this->registerRoutesForModules($this->backend_modules);
    }
  }

  private function registerRoutesForModules($modules = array())
  {
    foreach ($modules as $module)
    {
      $this->dispatcher->connect('routing.load_configuration', array(
        'sfsCoreRouting',
        sprintf('listenTo%sRoutingLoadConfigurationEvent', 
            sfInflector::camelize($module))
      ));
    }
  }

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->handleEnable($this->global_modules);

    if (sfConfig::get('sf_app') == 'frontend')
    {
      $this->handleEnable($this->frontend_modules);
    }
    if (sfConfig::get('sf_app') == 'backend')
    {
      $this->handleEnable($this->backend_modules);
    }

  }

  /**
   * Force the load of the modules in the applications's enabled array
   * 
   * @param Array $modules
   * @author Alexandru Emil Lupu <gang.alecs@gmail.com>
   */
  private function handleEnable($modules = array())
  {
    sfConfig::set('sf_enabled_modules',
        array_merge(
        sfConfig::get('sf_enabled_modules'),
        $modules
    ));
  }
}
