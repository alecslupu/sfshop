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
 * Base actions for the sfsCorePlugin sfsCore module.
 *
 * @package     sfsCorePlugin
 * @subpackage  sfsCore
 * @author      Alexandru Emil Lupu <gang.alecs@gmail.com>
 * @author      Dmitry Nesteruk <nesterukd@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BasesfsCoreActions extends sfActions
{
  /**
   * Change language action.
   *
   * @param  void
   * @return void
   * @author Dmitry Nesteruk
   * @access public
   */
  public function executeChangeLanguage(sfWebRequest $request)
  {
    $language = Doctrine_Core::getTable('sfsLanguage')->fetchPublicLanguageByCulture(
        $request->getParameter('culture')
    );

    $url = $this->getCurrentUrl($request);

    if ($language !== null)
    {
      $this->getUser()->setCulture($request->getParameter('culture'));
    }
    $this->redirect($url);
  }

  /**
   * Return referer if exists in backend app
   * or the localized_homepage if frontend or no referer
   *
   * @param sfWebRequest $request
   * @return string the url
   */
  protected function getCurrentUrl(sfWebRequest $request)
  {
    if($request->getReferer() and sfConfig::get('sf_app') != 'frontend')
    {
      if($request->getReferer() != $this->generateUrl('localized_homepage', array(), true))
      {

        return $request->getReferer();
      }
    }

    return 'localized_homepage';
  }

  /**
   * Form for send letter from site to administrator (Contact us).
   *
   * @param  void
   * @return void
   * @author Dmitry Nesteruk
   * @author      Alexandru Emil Lupu <gang.alecs@gmail.com>
   * @access public
   */
  public function executeContactUs(sfWebRequest $request)
  {
    $this->form = new sfsContactUsForm();

    if ($request->isMethod('post'))
    {
      $data = $request->getParameter('sf_core_contact_form');

      if (true == sfConfig::get('app_recaptcha_is_enabled', true))
      {
        $captcha = array(
            'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
            'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
        );
        $data = array_merge($data, array('captcha' => $captcha));
      }

      $this->form->bind($data);

      if ($this->form->isValid())
      {
        $values = $this->form->getValues();

        $this->getMailer()->send(
            new sfsContactUsMessage($values)
        );

        $this->getUser()->setFlash('message', 'Your letter has been sent. Thanks!');
      }
    }
  }
  
  /**
   * Action for 404 error (Page not found).
   *
   * @param  void
   * @return void
   * @author Dmitry Nesteruk
   * @access public
   */
  public function executeError404()
  {
    return sfView::SUCCESS;
  }

  /**
   * Action for 500 error (Server inernal error).
   *
   * @param  void
   * @return void
   * @author Dmitry Nesteruk
   * @access public
   */
  public function executeError500()
  {
    return sfView::SUCCESS;
  }
}
