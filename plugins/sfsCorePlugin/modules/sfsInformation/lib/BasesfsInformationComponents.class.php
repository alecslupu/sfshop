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
 * Base sfsInformation components.
 *
 * @package    sfsCorePlugin
 * @subpackage sfsInformation
 * @author     Alexandru Emil Lupu <gang.alecs@gmail.com>
 * @author     Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class BasesfsInformationComponents extends sfComponents
{
  public function executeDetails()
  {
    $this->information = Doctrine_Core::getTable('sfsInformation')
        ->fetchInfoById($this->id);
    
    if(!$this->information)
    {
      
      return sfView::NONE;
    }
  }
}
