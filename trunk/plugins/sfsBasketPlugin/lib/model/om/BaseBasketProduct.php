<?php


abstract class BaseBasketProduct extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $basket_id;


	
	protected $product_id;


	
	protected $options_list;


	
	protected $quantity = 0;


	
	protected $created_at;

	
	protected $aBasket;

	
	protected $aProduct;

	
	protected $collBasketProduct2OptionProducts;

	
	protected $lastBasketProduct2OptionProductCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getBasketId()
	{

		return $this->basket_id;
	}

	
	public function getProductId()
	{

		return $this->product_id;
	}

	
	public function getOptionsList()
	{

		return $this->options_list;
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
			$this->modifiedColumns[] = BasketProductPeer::ID;
		}

	} 
	
	public function setBasketId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->basket_id !== $v) {
			$this->basket_id = $v;
			$this->modifiedColumns[] = BasketProductPeer::BASKET_ID;
		}

		if ($this->aBasket !== null && $this->aBasket->getId() !== $v) {
			$this->aBasket = null;
		}

	} 
	
	public function setProductId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_id !== $v) {
			$this->product_id = $v;
			$this->modifiedColumns[] = BasketProductPeer::PRODUCT_ID;
		}

		if ($this->aProduct !== null && $this->aProduct->getId() !== $v) {
			$this->aProduct = null;
		}

	} 
	
	public function setOptionsList($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->options_list !== $v) {
			$this->options_list = $v;
			$this->modifiedColumns[] = BasketProductPeer::OPTIONS_LIST;
		}

	} 
	
	public function setQuantity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v || $v === 0) {
			$this->quantity = $v;
			$this->modifiedColumns[] = BasketProductPeer::QUANTITY;
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
			$this->modifiedColumns[] = BasketProductPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->basket_id = $rs->getInt($startcol + 1);

			$this->product_id = $rs->getInt($startcol + 2);

			$this->options_list = $rs->getString($startcol + 3);

			$this->quantity = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating BasketProduct object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseBasketProduct:delete:pre') as $callable)
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
			$con = Propel::getConnection(BasketProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BasketProductPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseBasketProduct:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseBasketProduct:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(BasketProductPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BasketProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseBasketProduct:save:post') as $callable)
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


												
			if ($this->aBasket !== null) {
				if ($this->aBasket->isModified()) {
					$affectedRows += $this->aBasket->save($con);
				}
				$this->setBasket($this->aBasket);
			}

			if ($this->aProduct !== null) {
				if ($this->aProduct->isModified() || ($this->aProduct->getCulture() && $this->aProduct->getCurrentProductI18n()->isModified())) {
					$affectedRows += $this->aProduct->save($con);
				}
				$this->setProduct($this->aProduct);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BasketProductPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BasketProductPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collBasketProduct2OptionProducts !== null) {
				foreach($this->collBasketProduct2OptionProducts as $referrerFK) {
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


												
			if ($this->aBasket !== null) {
				if (!$this->aBasket->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBasket->getValidationFailures());
				}
			}

			if ($this->aProduct !== null) {
				if (!$this->aProduct->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProduct->getValidationFailures());
				}
			}


			if (($retval = BasketProductPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBasketProduct2OptionProducts !== null) {
					foreach($this->collBasketProduct2OptionProducts as $referrerFK) {
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
		$pos = BasketProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getBasketId();
				break;
			case 2:
				return $this->getProductId();
				break;
			case 3:
				return $this->getOptionsList();
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
		$keys = BasketProductPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getBasketId(),
			$keys[2] => $this->getProductId(),
			$keys[3] => $this->getOptionsList(),
			$keys[4] => $this->getQuantity(),
			$keys[5] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BasketProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setBasketId($value);
				break;
			case 2:
				$this->setProductId($value);
				break;
			case 3:
				$this->setOptionsList($value);
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
		$keys = BasketProductPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setBasketId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProductId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setOptionsList($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setQuantity($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BasketProductPeer::DATABASE_NAME);

		if ($this->isColumnModified(BasketProductPeer::ID)) $criteria->add(BasketProductPeer::ID, $this->id);
		if ($this->isColumnModified(BasketProductPeer::BASKET_ID)) $criteria->add(BasketProductPeer::BASKET_ID, $this->basket_id);
		if ($this->isColumnModified(BasketProductPeer::PRODUCT_ID)) $criteria->add(BasketProductPeer::PRODUCT_ID, $this->product_id);
		if ($this->isColumnModified(BasketProductPeer::OPTIONS_LIST)) $criteria->add(BasketProductPeer::OPTIONS_LIST, $this->options_list);
		if ($this->isColumnModified(BasketProductPeer::QUANTITY)) $criteria->add(BasketProductPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(BasketProductPeer::CREATED_AT)) $criteria->add(BasketProductPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BasketProductPeer::DATABASE_NAME);

		$criteria->add(BasketProductPeer::ID, $this->id);

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

		$copyObj->setBasketId($this->basket_id);

		$copyObj->setProductId($this->product_id);

		$copyObj->setOptionsList($this->options_list);

		$copyObj->setQuantity($this->quantity);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getBasketProduct2OptionProducts() as $relObj) {
				$copyObj->addBasketProduct2OptionProduct($relObj->copy($deepCopy));
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
			self::$peer = new BasketProductPeer();
		}
		return self::$peer;
	}

	
	public function setBasket($v)
	{


		if ($v === null) {
			$this->setBasketId(NULL);
		} else {
			$this->setBasketId($v->getId());
		}


		$this->aBasket = $v;
	}


	
	public function getBasket($con = null)
	{
		if ($this->aBasket === null && ($this->basket_id !== null)) {
						$this->aBasket = BasketPeer::retrieveByPK($this->basket_id, $con);

			
		}
		return $this->aBasket;
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

				$criteria->add(BasketProduct2OptionProductPeer::BASKET_PRODUCT_ID, $this->getId());

				BasketProduct2OptionProductPeer::addSelectColumns($criteria);
				$this->collBasketProduct2OptionProducts = BasketProduct2OptionProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BasketProduct2OptionProductPeer::BASKET_PRODUCT_ID, $this->getId());

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

		$criteria->add(BasketProduct2OptionProductPeer::BASKET_PRODUCT_ID, $this->getId());

		return BasketProduct2OptionProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBasketProduct2OptionProduct(BasketProduct2OptionProduct $l)
	{
		$this->collBasketProduct2OptionProducts[] = $l;
		$l->setBasketProduct($this);
	}


	
	public function getBasketProduct2OptionProductsJoinOptionProduct($criteria = null, $con = null)
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

				$criteria->add(BasketProduct2OptionProductPeer::BASKET_PRODUCT_ID, $this->getId());

				$this->collBasketProduct2OptionProducts = BasketProduct2OptionProductPeer::doSelectJoinOptionProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(BasketProduct2OptionProductPeer::BASKET_PRODUCT_ID, $this->getId());

			if (!isset($this->lastBasketProduct2OptionProductCriteria) || !$this->lastBasketProduct2OptionProductCriteria->equals($criteria)) {
				$this->collBasketProduct2OptionProducts = BasketProduct2OptionProductPeer::doSelectJoinOptionProduct($criteria, $con);
			}
		}
		$this->lastBasketProduct2OptionProductCriteria = $criteria;

		return $this->collBasketProduct2OptionProducts;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseBasketProduct:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseBasketProduct::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 