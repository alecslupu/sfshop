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
 * sfsCorePluginConfiguration configuration.
 *
 * @package    sfShopPlugin
 * @subpackage sfsCorePlugin
 * @author     Alexandru Emil Lupu <gang.alecs@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.php
 */
class sfsCorePluginConfiguration extends sfsPluginConfiguration
{
  /**
   * Plugin global modules that needs to be loaded
   *
   * @var Array
   */
  private $global_modules = array(
      'sfsCore'
  );

  /**
   * Plugin frontend modules that needs to be loaded
   *
   * @var Array
   */
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
   * @see sfsPluginConfiguration
   */
  public function initialize()
  {
    parent::initialize();
  }
}
