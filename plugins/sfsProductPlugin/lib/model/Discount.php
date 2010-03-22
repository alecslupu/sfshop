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
 * Discount class
 *
 * @package    sfShopPlugin
 * @subpackage sfsProductPlugin
 * @author     Andreas Nyholm <andreas.nyholm@nyholmsolutions.fi>
 * @license    http://www.opensource.org/licenses/mit-license.php
 */ 
class Discount extends BaseDiscount
{
  public function __toString()
  {
    return $this->getTitle();  
  }
  
  public function getGrossPrice($price, $taxTypeId)
  {
    switch($this->getType()) {
      case DiscountPeer::TYPE_PERCENTUAL:
        return TaxRatePeer::calculateGrossPrice($price,$taxTypeId) * ((100-$this->getAmount())/100);
        break;
      case DiscountPeer::TYPE_NEW_PRICE_NET:
        return TaxRatePeer::calculateGrossPrice($this->getAmount(),$taxTypeId);
        break;
      case DiscountPeer::TYPE_NEW_PRICE_GROSS:
        return $this->getAmount();
        break;
      case DiscountPeer::TYPE_DISCOUNT_NET:
        return TaxRatePeer::calculateGrossPrice($price-$this->getAmount(),$taxTypeId);
        break;
      case DiscountPeer::TYPE_DISCOUNT_GROSS:
        return TaxRatePeer::calculateGrossPrice($price,$taxTypeId)-$this->getAmount();
        break;
      default:
        throw new Exception('Invalid discount type');        
    }
  }

  public function getNetPrice($price, $taxTypeId)
  {
    switch($this->getType()) {
      case DiscountPeer::TYPE_PERCENTUAL:
        return $price * ((100-$this->getAmount())/100);
        break;
      case DiscountPeer::TYPE_NEW_PRICE_NET:
        return $this->getAmount();
        break;
      case DiscountPeer::TYPE_NEW_PRICE_GROSS:
        //Note: gross price will be handled as net if no taxes available
        $coefficient = TaxRatePeer::calculateGrossPrice(1,$taxTypeId);
        return $this->getAmount() / $coefficient;
        break;
      case DiscountPeer::TYPE_DISCOUNT_NET:
        return $price-$this->getAmount();
        break;
      case DiscountPeer::TYPE_DISCOUNT_GROSS:
        //Note: gross price will be handled as net if no taxes available
        $coefficient = TaxRatePeer::calculateGrossPrice(1,$taxTypeId);
        return $price -($this->getAmount() / $coefficient);
        break;
      default:
        throw new Exception('Invalid discount type');        
    }
  }
  
}
