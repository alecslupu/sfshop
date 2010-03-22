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
 * Discount form.
 *
 * @package    sfShopPlugin
 * @subpackage sfsProductPlugin
 * @subpackage form
 * @author     Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */ 
class DiscountForm extends BaseDiscountForm
{
  public function configure()
  {
    parent::configure();
    
    $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
      'choices' => DiscountPeer::getTypeChoices()
    ));
    $this->validatorSchema['type'] = new sfValidatorChoice(array(
      'choices' => array_keys(DiscountPeer::getTypeChoices())
    ));
    
    $this->embedI18nForAllCultures();
  }
}
