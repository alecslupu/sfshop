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
 * sfsBasicRouting.
 *
 *
 * @package    sfShopPlugin
 * @subpackage sfsCorePlugin
 * @author     Alexandru Emil Lupu <gang.alecs@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.php
 */

class sfsBasicRouting
{

  /**
   * Attaches the routes to the current routing.load_configuration event
   *
   * @see sfsPluginConfiguration
   * @param sfEvent $event
   * @param string $file
   * @return null
   */
  static public function registerRoutes(sfEvent $event, $file )
  {
    if (false == file_exists($file))
    {
      return null;
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