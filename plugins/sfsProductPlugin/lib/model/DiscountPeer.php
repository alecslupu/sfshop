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
 * Discount peer class
 *
 * @package    sfShopPlugin
 * @subpackage sfsProductPlugin
 * @author     Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
 * @license    http://www.opensource.org/licenses/mit-license.php
 */ 
class DiscountPeer extends BaseDiscountPeer
{
 /**
  * amount is percentual discount of product price
  */ 
  const TYPE_PERCENTUAL = 1;

 /**
  * amount is new net price
  */ 
  const TYPE_NEW_PRICE_NET = 2;
 
 /**
  * amount is new gross price
  */ 
  const TYPE_NEW_PRICE_GROSS = 3;
  
 /**
  * amount is subtracted from product net price
  */ 
  const TYPE_DISCOUNT_NET = 4;

 /**
  * amount is subtracted from product gross price
  */ 
  const TYPE_DISCOUNT_GROSS = 5;

  /**
   * Get array for choice
   * 
   * @param  void
   * @return array
   * @author Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
   * @access public
   */
  static public function getTypeChoices()
  {
    return array(self::TYPE_PERCENTUAL => 'Percentual', self::TYPE_NEW_PRICE_NET => 'New net price', self::TYPE_NEW_PRICE_GROSS => 'New gross price', self::TYPE_DISCOUNT_NET => 'Discount net', self::TYPE_DISCOUNT_GROSS => 'Discount gross');
  }
  
}
