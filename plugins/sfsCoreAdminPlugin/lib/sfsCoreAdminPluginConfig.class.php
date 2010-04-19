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
 *
 * @package    sfShopPlugin
 * @subpackage sfsCoreAdminPlugin
 * @author     Alexandru Emil Lupu <gang.alecs@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.php
 */
class sfsCoreAdminPluginConfig
{
  public static function listenToContextLoadFactoriesEvent(sfEvent $event)
  {
    $response = $event->getSubject()->getResponse();

    $response->addHttpMeta('content-type', 'text/html; charset=utf-8', true);
    $response->addHttpMeta('content-language', sfContext::getInstance()->getUser()->getCulture(), true);
    $response->addMeta('robots', 'noindex,nofollow', true);

//    foreach ($response->getStylesheets() as $file)
//    {
//      $response->removeStylesheet($file);
//    }

    foreach (self::getRegisteredStyleSheets() as $file=>$attributes)
    {
      $response->addStylesheet('/' . $file, 'first', $attributes);
    }

//    foreach ($response->getJavascripts() as $file)
//    {
//      $response->removeJavascript($file);
//    }

    foreach (self::getRegisteredJavascripts() as $file)
    {
      $response->addJavascript('/' . $file, 'first');
    }
  }

  public static function getRegisteredStyleSheets()
  {
    $css_files = array(
        'css/reset.css' => array(
            'rel' => 'stylesheet',
            'media' =>'screen,projection',
            'type'=>'text/css'
        ),
        'css/main.css' => array(
            'rel'=>'stylesheet',
            'media'=>'screen,projection',
            'type'=>'text/css'
        ),
        'css/2col.css' => array(
            'rel'=>'stylesheet',
            'media'=>'screen,projection',
            'type'=>'text/css',
            'title' => '2col'
        ),
        'css/1col.css' => array(
            'rel'=>'alternate stylesheet',
            'media'=>'screen,projection',
            'type'=>'text/css',
            'title' => '1col'
    ));
    
    $ua = $_SERVER['HTTP_USER_AGENT'];

    if (preg_match('/\bmsie 6/i', $ua) &&
        !preg_match('/\bopera/i', $ua))
    {
      $css_files['css/style.css'] = array(
            'rel'=>'stylesheet',
            'media'=>'screen,projection',
            'type'=>'text/css'
        );
    }

    $css_files = array_merge($css_files, array(
        'css/style.css' => array(
            'rel'=>'stylesheet',
            'media'=>'screen,projection',
            'type'=>'text/css'
        ),
        'css/mystyle.css' => array(
            'rel'=>'stylesheet',
            'media'=>'screen,projection',
            'type'=>'text/css'
        ),
    ));
    return $css_files;
  }

  public static function getRegisteredJavascripts()
  {
    $js_files = array(
      'js/jquery.js',
      'js/switcher.js',
      'js/toggle.js',
      'js/ui.core.js',
      'js/ui.tabs.js'
    );
    return $js_files;
  }
}