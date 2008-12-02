<?php


abstract class BaseBasket extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $member_id;


	
	protected $currency_id;


	
	protected $access_num = 1;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aMember;

	
	protected $aCurrency;

	
	protected $collBasketProducts;

	
	protected $lastBasketProductCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getMemberId()
	{

		return $this->member_id;
	}

	
	public function getCurrencyId()
	{

		return $this->currency_id;
	}

	
	public function getAccessNum()
	{

		return $this->access_num;
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

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
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
			$this->modifiedColumns[] = BasketPeer::ID;
		}

	} 
	
	public function setMemberId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->member_id !== $v) {
			$this->member_id = $v;
			$this->modifiedColumns[] = BasketPeer::MEMBER_ID;
		}

		if ($this->aMember !== null && $this->aMember->getId() !== $v) {
			$this->aMember = null;
		}

	} 
	
	public function setCurrencyId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->currency_id !== $v) {
			$this->currency_id = $v;
			$this->modifiedColumns[] = BasketPeer::CURRENCY_ID;
		}

		if ($this->aCurrency !== null && $this->aCurrency->getId() !== $v) {
			$this->aCurrency = null;
		}

	} 
	
	public function setAccessNum($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->access_num !== $v || $v === 1) {
			$this->access_num = $v;
			$this->modifiedColumns[] = BasketPeer::ACCESS_NUM;
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
			$this->modifiedColumns[] = BasketPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = BasketPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->member_id = $rs->getInt($startcol + 1);

			$this->currency_id = $rs->getInt($startcol + 2);

			$this->access_num = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Basket object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseBasket:delete:pre') as $callable)
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
			$con = Propel::getConnection(BasketPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BasketPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseBasket:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseBasket:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(BasketPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(BasketPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BasketPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseBasket:save:post') as $callable)
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


												
			if ($this->aMember !== null) {
				if ($this->aMember->isModified()) {
					$affectedRows += $this->aMember->save($con);
				}
				$this->setMember($this->aMember);
			}

			if ($this->aCurrency !== null) {
				if ($this->aCurrency->isModified() || ($this->aCurrency->getCulture() && $this->aCurrency->getCurrentCurrencyI18n()->isModified())) {
					$affectedRows += $this->aCurrency->save($con);
				}
				$this->setCurrency($this->aCurrency);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BasketPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BasketPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collBasketProducts !== null) {
				foreach($this->collBasketProducts as $referrerFK) {
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


												
			if ($this->aMember !== null) {
				if (!$this->aMember->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMember->getValidationFailures());
				}
			}

			if ($this->aCurrency !== null) {
				if (!$this->aCurrency->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCurrency->getValidationFailures());
				}
			}


			if (($retval = BasketPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBasketProducts !== null) {
					foreach($this->collBasketProducts as $referrerFK) {
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
		$pos = BasketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getMemberId();
				break;
			case 2:
				return $this->getCurrencyId();
				break;
			case 3:
				return $this->getAccessNum();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BasketPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMemberId(),
			$keys[2] => $this->getCurrencyId(),
			$keys[3] => $this->getAccessNum(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BasketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setMemberId($value);
				break;
			case 2:
				$this->setCurrencyId($value);
				break;
			case 3:
				$this->setAccessNum($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BasketPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMemberId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCurrencyId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAccessNum($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BasketPeer::DATABASE_NAME);

		if ($this->isColumnModified(BasketPeer::ID)) $criteria->add(BasketPeer::ID, $this->id);
		if ($this->isColumnModified(BasketPeer::MEMBER_ID)) $criteria->add(BasketPeer::MEMBER_ID, $this->member_id);
		if ($this->isColumnModified(BasketPeer::CURRENCY_ID)) $criteria->add(BasketPeer::CURRENCY_ID, $this->currency_id);
		if ($this->isColumnModified(BasketPeer::ACCESS_NUM)) $criteria->add(BasketPeer::ACCESS_NUM, $this->access_num);
		if ($this->isColumnModified(BasketPeer::CREATED_AT)) $criteria->add(BasketPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(BasketPeer::UPDATED_AT)) $criteria->add(BasketPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BasketPeer::DATABASE_NAME);

		$criteria->add(BasketPeer::ID, $this->id);

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

		$copyObj->setMemberId($this->member_id);

		$copyObj->setCurrencyId($this->currency_id);

		$copyObj->setAccessNum($this->access_num);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getBasketProducts() as $relObj) {
				$copyObj->addBasketProduct($relObj->copy($deepCopy));
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
			self::$peer = new BasketPeer();
		}
		return self::$peer;
	}

	
	public function setMember($v)
	{


		if ($v === null) {
			$this->setMemberId(NULL);
		} else {
			$this->setMemberId($v->getId());
		}


		$this->aMember = $v;
	}


	
	public function getMember($con = null)
	{
		if ($this->aMember === null && ($this->member_id !== null)) {
						$this->aMember = MemberPeer::retrieveByPK($this->member_id, $con);

			
		}
		return $this->aMember;
	}

	
	public function setCurrency($v)
	{


		if ($v === null) {
			$this->setCurrencyId(NULL);
		} else {
			$this->setCurrencyId($v->getId());
		}


		$this->aCurrency = $v;
	}


	
	public function getCurrency($con = null)
	{
		if ($this->aCurrency === null && ($this->currency_id !== null)) {
						$this->aCurrency = CurrencyPeer::retrieveByPK($this->currency_id, $con);

			
		}
		return $this->aCurrency;
	}

	
	public function initBasketProducts()
	{
		if ($this->collBasketProducts === null) {
			$this->collBasketProducts = array();
		}
	}

	
	public function getBasketProducts($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBasketProducts === null) {
			if ($this->isNew()) {
			   $this->collBasketProducts = array();
			} else {

				$criteria->add(BasketProductPeer::BASKET_ID, $this->getId());

				BasketProductPeer::addSelectColumns($criteria);
				$this->collBasketProducts = BasketProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BasketProductPeer::BASKET_ID, $this->getId());

				BasketProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastBasketProductCriteria) || !$this->lastBasketProductCriteria->equals($criteria)) {
					$this->collBasketProducts = BasketProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBasketProductCriteria = $criteria;
		return $this->collBasketProducts;
	}

	
	public function countBasketProducts($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BasketProductPeer::BASKET_ID, $this->getId());

		return BasketProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBasketProduct(BasketProduct $l)
	{
		$this->collBasketProducts[] = $l;
		$l->setBasket($this);
	}


	
	public function getBasketProductsJoinProduct($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBasketProducts === null) {
			if ($this->isNew()) {
				$this->collBasketProducts = array();
			} else {

				$criteria->add(BasketProductPeer::BASKET_ID, $this->getId());

				$this->collBasketProducts = BasketProductPeer::doSelectJoinProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(BasketProductPeer::BASKET_ID, $this->getId());

			if (!isset($this->lastBasketProductCriteria) || !$this->lastBasketProductCriteria->equals($criteria)) {
				$this->collBasketProducts = BasketProductPeer::doSelectJoinProduct($criteria, $con);
			}
		}
		$this->lastBasketProductCriteria = $criteria;

		return $this->collBasketProducts;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseBasket:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseBasket::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 