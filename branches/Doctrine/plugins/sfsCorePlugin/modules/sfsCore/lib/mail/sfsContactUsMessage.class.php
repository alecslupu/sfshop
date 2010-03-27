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
 * Contact us Mailer
 *
 * @package     sfsCorePlugin
 * @subpackage  sfsCore
 * @author      Alexandru Emil Lupu <gang.alecs@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php
 */

class sfsContactUsMessage extends Swift_Message
{
  public function  __construct($values)
  {
    parent::__construct();
    $this->setCharset(sfConfig::get('sf_charset', 'utf-8'));
    $this->setTo(sfConfig::get('app_mail_address_feedback'));

    $this->setSubject($values['subject']);
    $this->setBody($values['body']);

    $sender = array(
      $values['email'] => $values['first_name'] . ' ' . $values['last_name']
    );

    $this->setFrom($sender);
    $this->setReplyTo($sender);
  }
}
