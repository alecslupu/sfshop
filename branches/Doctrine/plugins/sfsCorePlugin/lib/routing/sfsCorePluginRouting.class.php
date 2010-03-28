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
 * sfsCoreRouting.
 *
 *
 * @package    sfShopPlugin
 * @subpackage sfsCorePlugin
 * @author     Alexandru Emil Lupu <gang.alecs@gmail.com>
 * @author     Marius Rugan <mariusrugan@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.php
 */

class sfsCorePluginRouting extends sfsBasicRouting
{

  /**
   * Loading dynamic routes for core module
   *
   * @see sfsPluginConfiguration
   * @uses sfsBasicRouting
   * @param sfEvent $event
   */
  static public function listenToSfsCoreRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $file = dirname(__FILE__).'/../../modules/sfsCore/config/routing.yml';

    self::registerRoutes($event, $file);
  }

  /**
   * Loading dynamic routes for information module
   *
   * @see sfsPluginConfiguration
   * @uses sfsBasicRouting
   * @param sfEvent $event
   */
  static public function listenToSfsInformationRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $file = dirname(__FILE__).'/../../modules/sfsInformation/config/routing.yml';

    self::registerRoutes($event, $file);
  }

  /**
   * Loading dynamic routes for menu module
   *
   * @see sfsPluginConfiguration
   * @uses sfsBasicRouting
   * @param sfEvent $event
   */
  static public function listenToSfsMenuRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $file = dirname(__FILE__).'/../../modules/sfsMenu/config/routing.yml';

    self::registerRoutes($event, $file);
  }
  
  /**
   * Loading dynamic routes for sfGuardAuth module
   *
   * @see sfsPluginConfiguration
   * @uses sfsBasicRouting
   * @param sfEvent $event
   */
  static public function listenToSfGuardAuthRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $file = dirname(__FILE__).'/../../modules/sfGuardAuth/config/routing.yml';

    self::registerRoutes($event, $file);
  }
}