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
require_once sfConfig::get('sf_plugins_dir') . '/sfsCorePlugin/lib/config/sfsPluginConfiguration.class.php';

/**
 * sfsCoreAdminPlugin configuration.
 * 
 * @package    sfShopPlugin
 * @subpackage sfsCoreAdminPlugin
 * @author     Alexandru Emil Lupu <gang.alecs@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.php
 */
class sfsCoreAdminPluginConfiguration extends sfsPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  // to be moved as $backend_modules
  protected $global_modules = array(
      'sfsCoreAdminLayout'
  );
  
  public function __construct(sfProjectConfiguration $configuration, $rootDir = null, $name = null)
  {
    parent::__construct($configuration, $rootDir, $name);
    if ($this->configuration instanceof sfApplicationConfiguration)
    {
      sfConfig::set('sf_app_template_dir', $this->getDecoratorPath());
      $this->setAssets();
    }
  }
  protected function setAssets()
  {
    $this->dispatcher->connect('context.load_factories', array('sfsCoreAdminPluginConfig', 'listenToContextLoadFactoriesEvent'));
  }

  protected function getDecoratorPath()
  {
    return sprintf("%s/data/template/",
        $this->getRootDir());
  }
}
