<?php
/*
 * This file is part of the sfShop package.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * sfsPluginConfiguration configuration.
 *
 *
 * @package    sfShopPlugin
 * @subpackage sfsCorePlugin
 * @author     Alexandru Emil Lupu <gang.alecs@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.php
 */
abstract class sfsPluginConfiguration extends sfPluginConfiguration
{

  /**
   * Plugin global modules that needs to be loaded
   *
   * @var Array
   */
  private $global_modules = array();

  /**
   * Plugin frontend modules that needs to be loaded
   *
   * @var Array
   */
  private $frontend_modules = array();

  /**
   * Plugin backend modules that needs to be loaded
   *
   * @var Array
   */
  private $backend_modules = array();

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

  /**
   * This method aims to register all the routes according to the application
   * where the user is
   *
   * @author Alexandru Emil Lupu <gang.alecs@gmail.com>
   */
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

  /**
   * This method is is called in order to dinamically register the routes
   *
   * @uses sfsBasicRouting
   * @param Array $modules
   */
  private function registerRoutesForModules($modules = array())
  {
    foreach ($modules as $module)
    {
      $this->dispatcher->connect('routing.load_configuration', array(
        sprintf('%sRouting', $this->getName()),
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