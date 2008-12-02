<?php


abstract class BaseOrderProduct extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $order_item_id;


	
	protected $product_id;


	
	protected $price;


	
	protected $quantity = 1;


	
	protected $created_at;

	
	protected $aOrderItem;

	
	protected $aProduct;

	
	protected $collOrderProduct2OptionProducts;

	
	protected $lastOrderProduct2OptionProductCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getOrderItemId()
	{

		return $this->order_item_id;
	}

	
	public function getProductId()
	{

		return $this->product_id;
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
			$this->modifiedColumns[] = OrderProductPeer::ID;
		}

	} 
	
	public function setOrderItemId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->order_item_id !== $v) {
			$this->order_item_id = $v;
			$this->modifiedColumns[] = OrderProductPeer::ORDER_ITEM_ID;
		}

		if ($this->aOrderItem !== null && $this->aOrderItem->getId() !== $v) {
			$this->aOrderItem = null;
		}

	} 
	
	public function setProductId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_id !== $v) {
			$this->product_id = $v;
			$this->modifiedColumns[] = OrderProductPeer::PRODUCT_ID;
		}

		if ($this->aProduct !== null && $this->aProduct->getId() !== $v) {
			$this->aProduct = null;
		}

	} 
	
	public function setPrice($v)
	{

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = OrderProductPeer::PRICE;
		}

	} 
	
	public function setQuantity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v || $v === 1) {
			$this->quantity = $v;
			$this->modifiedColumns[] = OrderProductPeer::QUANTITY;
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
			$this->modifiedColumns[] = OrderProductPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->order_item_id = $rs->getInt($startcol + 1);

			$this->product_id = $rs->getInt($startcol + 2);

			$this->price = $rs->getFloat($startcol + 3);

			$this->quantity = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OrderProduct object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct:delete:pre') as $callable)
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
			$con = Propel::getConnection(OrderProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OrderProductPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseOrderProduct:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(OrderProductPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrderProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseOrderProduct:save:post') as $callable)
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


												
			if ($this->aOrderItem !== null) {
				if ($this->aOrderItem->isModified()) {
					$affectedRows += $this->aOrderItem->save($con);
				}
				$this->setOrderItem($this->aOrderItem);
			}

			if ($this->aProduct !== null) {
				if ($this->aProduct->isModified() || ($this->aProduct->getCulture() && $this->aProduct->getCurrentProductI18n()->isModified())) {
					$affectedRows += $this->aProduct->save($con);
				}
				$this->setProduct($this->aProduct);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OrderProductPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OrderProductPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aOrderItem !== null) {
				if (!$this->aOrderItem->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOrderItem->getValidationFailures());
				}
			}

			if ($this->aProduct !== null) {
				if (!$this->aProduct->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProduct->getValidationFailures());
				}
			}


			if (($retval = OrderProductPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = OrderProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getOrderItemId();
				break;
			case 2:
				return $this->getProductId();
				break;
			case 3:
				return $this->getPrice();
				break;
			case 4:
				return $this->getQuantity();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrderProductPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getOrderItemId(),
			$keys[2] => $this->getProductId(),
			$keys[3] => $this->getPrice(),
			$keys[4] => $this->getQuantity(),
			$keys[5] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrderProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setOrderItemId($value);
				break;
			case 2:
				$this->setProductId($value);
				break;
			case 3:
				$this->setPrice($value);
				break;
			case 4:
				$this->setQuantity($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrderProductPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOrderItemId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProductId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPrice($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setQuantity($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OrderProductPeer::DATABASE_NAME);

		if ($this->isColumnModified(OrderProductPeer::ID)) $criteria->add(OrderProductPeer::ID, $this->id);
		if ($this->isColumnModified(OrderProductPeer::ORDER_ITEM_ID)) $criteria->add(OrderProductPeer::ORDER_ITEM_ID, $this->order_item_id);
		if ($this->isColumnModified(OrderProductPeer::PRODUCT_ID)) $criteria->add(OrderProductPeer::PRODUCT_ID, $this->product_id);
		if ($this->isColumnModified(OrderProductPeer::PRICE)) $criteria->add(OrderProductPeer::PRICE, $this->price);
		if ($this->isColumnModified(OrderProductPeer::QUANTITY)) $criteria->add(OrderProductPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(OrderProductPeer::CREATED_AT)) $criteria->add(OrderProductPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OrderProductPeer::DATABASE_NAME);

		$criteria->add(OrderProductPeer::ID, $this->id);

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

		$copyObj->setOrderItemId($this->order_item_id);

		$copyObj->setProductId($this->product_id);

		$copyObj->setPrice($this->price);

		$copyObj->setQuantity($this->quantity);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

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
			self::$peer = new OrderProductPeer();
		}
		return self::$peer;
	}

	
	public function setOrderItem($v)
	{


		if ($v === null) {
			$this->setOrderItemId(NULL);
		} else {
			$this->setOrderItemId($v->getId());
		}


		$this->aOrderItem = $v;
	}


	
	public function getOrderItem($con = null)
	{
		if ($this->aOrderItem === null && ($this->order_item_id !== null)) {
						$this->aOrderItem = OrderItemPeer::retrieveByPK($this->order_item_id, $con);

			
		}
		return $this->aOrderItem;
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

				$criteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $this->getId());

				OrderProduct2OptionProductPeer::addSelectColumns($criteria);
				$this->collOrderProduct2OptionProducts = OrderProduct2OptionProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $this->getId());

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

		$criteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $this->getId());

		return OrderProduct2OptionProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderProduct2OptionProduct(OrderProduct2OptionProduct $l)
	{
		$this->collOrderProduct2OptionProducts[] = $l;
		$l->setOrderProduct($this);
	}


	
	public function getOrderProduct2OptionProductsJoinOptionProduct($criteria = null, $con = null)
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

				$criteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $this->getId());

				$this->collOrderProduct2OptionProducts = OrderProduct2OptionProductPeer::doSelectJoinOptionProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $this->getId());

			if (!isset($this->lastOrderProduct2OptionProductCriteria) || !$this->lastOrderProduct2OptionProductCriteria->equals($criteria)) {
				$this->collOrderProduct2OptionProducts = OrderProduct2OptionProductPeer::doSelectJoinOptionProduct($criteria, $con);
			}
		}
		$this->lastOrderProduct2OptionProductCriteria = $criteria;

		return $this->collOrderProduct2OptionProducts;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseOrderProduct:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseOrderProduct::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 