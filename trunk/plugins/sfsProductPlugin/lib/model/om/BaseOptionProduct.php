<?php


abstract class BaseOptionProduct extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $option_value_id;


	
	protected $product_id;


	
	protected $price_type = 0;


	
	protected $price;


	
	protected $quantity = 0;


	
	protected $created_at;

	
	protected $aOptionValue;

	
	protected $aProduct;

	
	protected $collBasketProduct2OptionProducts;

	
	protected $lastBasketProduct2OptionProductCriteria = null;

	
	protected $collOrderProduct2OptionProducts;

	
	protected $lastOrderProduct2OptionProductCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getOptionValueId()
	{

		return $this->option_value_id;
	}

	
	public function getProductId()
	{

		return $this->product_id;
	}

	
	public function getPriceType()
	{

		return $this->price_type;
	}

	
	public function getPrice()
	{

		return $this->price;
	}

	
	public function getQuantity()
	{

		return $this->quantity;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OptionProductPeer::ID;
		}

	} 
	
	public function setOptionValueId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->option_value_id !== $v) {
			$this->option_value_id = $v;
			$this->modifiedColumns[] = OptionProductPeer::OPTION_VALUE_ID;
		}

		if ($this->aOptionValue !== null && $this->aOptionValue->getId() !== $v) {
			$this->aOptionValue = null;
		}

	} 
	
	public function setProductId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_id !== $v) {
			$this->product_id = $v;
			$this->modifiedColumns[] = OptionProductPeer::PRODUCT_ID;
		}

		if ($this->aProduct !== null && $this->aProduct->getId() !== $v) {
			$this->aProduct = null;
		}

	} 
	
	public function setPriceType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->price_type !== $v || $v === 0) {
			$this->price_type = $v;
			$this->modifiedColumns[] = OptionProductPeer::PRICE_TYPE;
		}

	} 
	
	public function setPrice($v)
	{

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = OptionProductPeer::PRICE;
		}

	} 
	
	public function setQuantity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v || $v === 0) {
			$this->quantity = $v;
			$this->modifiedColumns[] = OptionProductPeer::QUANTITY;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = OptionProductPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->option_value_id = $rs->getInt($startcol + 1);

			$this->product_id = $rs->getInt($startcol + 2);

			$this->price_type = $rs->getInt($startcol + 3);

			$this->price = $rs->getFloat($startcol + 4);

			$this->quantity = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OptionProduct object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProduct:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OptionProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OptionProductPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseOptionProduct:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProduct:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(OptionProductPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OptionProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseOptionProduct:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aOptionValue !== null) {
				if ($this->aOptionValue->isModified() || ($this->aOptionValue->getCulture() && $this->aOptionValue->getCurrentOptionValueI18n()->isModified())) {
					$affectedRows += $this->aOptionValue->save($con);
				}
				$this->setOptionValue($this->aOptionValue);
			}

			if ($this->aProduct !== null) {
				if ($this->aProduct->isModified() || ($this->aProduct->getCulture() && $this->aProduct->getCurrentProductI18n()->isModified())) {
					$affectedRows += $this->aProduct->save($con);
				}
				$this->setProduct($this->aProduct);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OptionProductPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OptionProductPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collBasketProduct2OptionProducts !== null) {
				foreach($this->collBasketProduct2OptionProducts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderProduct2OptionProducts !== null) {
				foreach($this->collOrderProduct2OptionProducts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aOptionValue !== null) {
				if (!$this->aOptionValue->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOptionValue->getValidationFailures());
				}
			}

			if ($this->aProduct !== null) {
				if (!$this->aProduct->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProduct->getValidationFailures());
				}
			}


			if (($retval = OptionProductPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBasketProduct2OptionProducts !== null) {
					foreach($this->collBasketProduct2OptionProducts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderProduct2OptionProducts !== null) {
					foreach($this->collOrderProduct2OptionProducts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OptionProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getOptionValueId();
				break;
			case 2:
				return $this->getProductId();
				break;
			case 3:
				return $this->getPriceType();
				break;
			case 4:
				return $this->getPrice();
				break;
			case 5:
				return $this->getQuantity();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OptionProductPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getOptionValueId(),
			$keys[2] => $this->getProductId(),
			$keys[3] => $this->getPriceType(),
			$keys[4] => $this->getPrice(),
			$keys[5] => $this->getQuantity(),
			$keys[6] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OptionProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setOptionValueId($value);
				break;
			case 2:
				$this->setProductId($value);
				break;
			case 3:
				$this->setPriceType($value);
				break;
			case 4:
				$this->setPrice($value);
				break;
			case 5:
				$this->setQuantity($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OptionProductPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOptionValueId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProductId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPriceType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPrice($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setQuantity($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OptionProductPeer::DATABASE_NAME);

		if ($this->isColumnModified(OptionProductPeer::ID)) $criteria->add(OptionProductPeer::ID, $this->id);
		if ($this->isColumnModified(OptionProductPeer::OPTION_VALUE_ID)) $criteria->add(OptionProductPeer::OPTION_VALUE_ID, $this->option_value_id);
		if ($this->isColumnModified(OptionProductPeer::PRODUCT_ID)) $criteria->add(OptionProductPeer::PRODUCT_ID, $this->product_id);
		if ($this->isColumnModified(OptionProductPeer::PRICE_TYPE)) $criteria->add(OptionProductPeer::PRICE_TYPE, $this->price_type);
		if ($this->isColumnModified(OptionProductPeer::PRICE)) $criteria->add(OptionProductPeer::PRICE, $this->price);
		if ($this->isColumnModified(OptionProductPeer::QUANTITY)) $criteria->add(OptionProductPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(OptionProductPeer::CREATED_AT)) $criteria->add(OptionProductPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OptionProductPeer::DATABASE_NAME);

		$criteria->add(OptionProductPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOptionValueId($this->option_value_id);

		$copyObj->setProductId($this->product_id);

		$copyObj->setPriceType($this->price_type);

		$copyObj->setPrice($this->price);

		$copyObj->setQuantity($this->quantity);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getBasketProduct2OptionProducts() as $relObj) {
				$copyObj->addBasketProduct2OptionProduct($relObj->copy($deepCopy));
			}

			foreach($this->getOrderProduct2OptionProducts() as $relObj) {
				$copyObj->addOrderProduct2OptionProduct($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new OptionProductPeer();
		}
		return self::$peer;
	}

	
	public function setOptionValue($v)
	{


		if ($v === null) {
			$this->setOptionValueId(NULL);
		} else {
			$this->setOptionValueId($v->getId());
		}


		$this->aOptionValue = $v;
	}


	
	public function getOptionValue($con = null)
	{
		if ($this->aOptionValue === null && ($this->option_value_id !== null)) {
						$this->aOptionValue = OptionValuePeer::retrieveByPK($this->option_value_id, $con);

			
		}
		return $this->aOptionValue;
	}

	
	public function setProduct($v)
	{


		if ($v === null) {
			$this->setProductId(NULL);
		} else {
			$this->setProductId($v->getId());
		}


		$this->aProduct = $v;
	}


	
	public function getProduct($con = null)
	{
		if ($this->aProduct === null && ($this->product_id !== null)) {
						$this->aProduct = ProductPeer::retrieveByPK($this->product_id, $con);

			
		}
		return $this->aProduct;
	}

	
	public function initBasketProduct2OptionProducts()
	{
		if ($this->collBasketProduct2OptionProducts === null) {
			$this->collBasketProduct2OptionProducts = array();
		}
	}

	
	public function getBasketProduct2OptionProducts($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBasketProduct2OptionProducts === null) {
			if ($this->isNew()) {
			   $this->collBasketProduct2OptionProducts = array();
			} else {

				$criteria->add(BasketProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

				BasketProduct2OptionProductPeer::addSelectColumns($criteria);
				$this->collBasketProduct2OptionProducts = BasketProduct2OptionProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BasketProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

				BasketProduct2OptionProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastBasketProduct2OptionProductCriteria) || !$this->lastBasketProduct2OptionProductCriteria->equals($criteria)) {
					$this->collBasketProduct2OptionProducts = BasketProduct2OptionProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBasketProduct2OptionProductCriteria = $criteria;
		return $this->collBasketProduct2OptionProducts;
	}

	
	public function countBasketProduct2OptionProducts($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BasketProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

		return BasketProduct2OptionProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBasketProduct2OptionProduct(BasketProduct2OptionProduct $l)
	{
		$this->collBasketProduct2OptionProducts[] = $l;
		$l->setOptionProduct($this);
	}


	
	public function getBasketProduct2OptionProductsJoinBasketProduct($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBasketProduct2OptionProducts === null) {
			if ($this->isNew()) {
				$this->collBasketProduct2OptionProducts = array();
			} else {

				$criteria->add(BasketProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

				$this->collBasketProduct2OptionProducts = BasketProduct2OptionProductPeer::doSelectJoinBasketProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(BasketProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

			if (!isset($this->lastBasketProduct2OptionProductCriteria) || !$this->lastBasketProduct2OptionProductCriteria->equals($criteria)) {
				$this->collBasketProduct2OptionProducts = BasketProduct2OptionProductPeer::doSelectJoinBasketProduct($criteria, $con);
			}
		}
		$this->lastBasketProduct2OptionProductCriteria = $criteria;

		return $this->collBasketProduct2OptionProducts;
	}

	
	public function initOrderProduct2OptionProducts()
	{
		if ($this->collOrderProduct2OptionProducts === null) {
			$this->collOrderProduct2OptionProducts = array();
		}
	}

	
	public function getOrderProduct2OptionProducts($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderProduct2OptionProducts === null) {
			if ($this->isNew()) {
			   $this->collOrderProduct2OptionProducts = array();
			} else {

				$criteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

				OrderProduct2OptionProductPeer::addSelectColumns($criteria);
				$this->collOrderProduct2OptionProducts = OrderProduct2OptionProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

				OrderProduct2OptionProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderProduct2OptionProductCriteria) || !$this->lastOrderProduct2OptionProductCriteria->equals($criteria)) {
					$this->collOrderProduct2OptionProducts = OrderProduct2OptionProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderProduct2OptionProductCriteria = $criteria;
		return $this->collOrderProduct2OptionProducts;
	}

	
	public function countOrderProduct2OptionProducts($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

		return OrderProduct2OptionProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderProduct2OptionProduct(OrderProduct2OptionProduct $l)
	{
		$this->collOrderProduct2OptionProducts[] = $l;
		$l->setOptionProduct($this);
	}


	
	public function getOrderProduct2OptionProductsJoinOrderProduct($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderProduct2OptionProducts === null) {
			if ($this->isNew()) {
				$this->collOrderProduct2OptionProducts = array();
			} else {

				$criteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

				$this->collOrderProduct2OptionProducts = OrderProduct2OptionProductPeer::doSelectJoinOrderProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->getId());

			if (!isset($this->lastOrderProduct2OptionProductCriteria) || !$this->lastOrderProduct2OptionProductCriteria->equals($criteria)) {
				$this->collOrderProduct2OptionProducts = OrderProduct2OptionProductPeer::doSelectJoinOrderProduct($criteria, $con);
			}
		}
		$this->lastOrderProduct2OptionProductCriteria = $criteria;

		return $this->collOrderProduct2OptionProducts;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseOptionProduct:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseOptionProduct::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 