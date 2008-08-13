<?php


abstract class BaseCurrency extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $code;


	
	protected $symbol_left;


	
	protected $symbol_right;


	
	protected $decimal_point;


	
	protected $thousands_point;


	
	protected $decimal_places;


	
	protected $value;


	
	protected $is_default = false;


	
	protected $is_active = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collBaskets;

	
	protected $lastBasketCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getCode()
	{

		return $this->code;
	}

	
	public function getSymbolLeft()
	{

		return $this->symbol_left;
	}

	
	public function getSymbolRight()
	{

		return $this->symbol_right;
	}

	
	public function getDecimalPoint()
	{

		return $this->decimal_point;
	}

	
	public function getThousandsPoint()
	{

		return $this->thousands_point;
	}

	
	public function getDecimalPlaces()
	{

		return $this->decimal_places;
	}

	
	public function getValue()
	{

		return $this->value;
	}

	
	public function getIsDefault()
	{

		return $this->is_default;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
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
			$this->modifiedColumns[] = CurrencyPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = CurrencyPeer::TITLE;
		}

	} 
	
	public function setCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->code !== $v) {
			$this->code = $v;
			$this->modifiedColumns[] = CurrencyPeer::CODE;
		}

	} 
	
	public function setSymbolLeft($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->symbol_left !== $v) {
			$this->symbol_left = $v;
			$this->modifiedColumns[] = CurrencyPeer::SYMBOL_LEFT;
		}

	} 
	
	public function setSymbolRight($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->symbol_right !== $v) {
			$this->symbol_right = $v;
			$this->modifiedColumns[] = CurrencyPeer::SYMBOL_RIGHT;
		}

	} 
	
	public function setDecimalPoint($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->decimal_point !== $v) {
			$this->decimal_point = $v;
			$this->modifiedColumns[] = CurrencyPeer::DECIMAL_POINT;
		}

	} 
	
	public function setThousandsPoint($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->thousands_point !== $v) {
			$this->thousands_point = $v;
			$this->modifiedColumns[] = CurrencyPeer::THOUSANDS_POINT;
		}

	} 
	
	public function setDecimalPlaces($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->decimal_places !== $v) {
			$this->decimal_places = $v;
			$this->modifiedColumns[] = CurrencyPeer::DECIMAL_PLACES;
		}

	} 
	
	public function setValue($v)
	{

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = CurrencyPeer::VALUE;
		}

	} 
	
	public function setIsDefault($v)
	{

		if ($this->is_default !== $v || $v === false) {
			$this->is_default = $v;
			$this->modifiedColumns[] = CurrencyPeer::IS_DEFAULT;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = CurrencyPeer::IS_ACTIVE;
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
			$this->modifiedColumns[] = CurrencyPeer::CREATED_AT;
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
			$this->modifiedColumns[] = CurrencyPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->code = $rs->getString($startcol + 2);

			$this->symbol_left = $rs->getString($startcol + 3);

			$this->symbol_right = $rs->getString($startcol + 4);

			$this->decimal_point = $rs->getString($startcol + 5);

			$this->thousands_point = $rs->getString($startcol + 6);

			$this->decimal_places = $rs->getString($startcol + 7);

			$this->value = $rs->getFloat($startcol + 8);

			$this->is_default = $rs->getBoolean($startcol + 9);

			$this->is_active = $rs->getBoolean($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Currency object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseCurrency:delete:pre') as $callable)
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
			$con = Propel::getConnection(CurrencyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CurrencyPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCurrency:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseCurrency:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(CurrencyPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(CurrencyPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CurrencyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCurrency:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CurrencyPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CurrencyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collBaskets !== null) {
				foreach($this->collBaskets as $referrerFK) {
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


			if (($retval = CurrencyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBaskets !== null) {
					foreach($this->collBaskets as $referrerFK) {
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
		$pos = CurrencyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getCode();
				break;
			case 3:
				return $this->getSymbolLeft();
				break;
			case 4:
				return $this->getSymbolRight();
				break;
			case 5:
				return $this->getDecimalPoint();
				break;
			case 6:
				return $this->getThousandsPoint();
				break;
			case 7:
				return $this->getDecimalPlaces();
				break;
			case 8:
				return $this->getValue();
				break;
			case 9:
				return $this->getIsDefault();
				break;
			case 10:
				return $this->getIsActive();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CurrencyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getCode(),
			$keys[3] => $this->getSymbolLeft(),
			$keys[4] => $this->getSymbolRight(),
			$keys[5] => $this->getDecimalPoint(),
			$keys[6] => $this->getThousandsPoint(),
			$keys[7] => $this->getDecimalPlaces(),
			$keys[8] => $this->getValue(),
			$keys[9] => $this->getIsDefault(),
			$keys[10] => $this->getIsActive(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CurrencyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setCode($value);
				break;
			case 3:
				$this->setSymbolLeft($value);
				break;
			case 4:
				$this->setSymbolRight($value);
				break;
			case 5:
				$this->setDecimalPoint($value);
				break;
			case 6:
				$this->setThousandsPoint($value);
				break;
			case 7:
				$this->setDecimalPlaces($value);
				break;
			case 8:
				$this->setValue($value);
				break;
			case 9:
				$this->setIsDefault($value);
				break;
			case 10:
				$this->setIsActive($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CurrencyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSymbolLeft($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSymbolRight($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDecimalPoint($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setThousandsPoint($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDecimalPlaces($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setValue($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIsDefault($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIsActive($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CurrencyPeer::DATABASE_NAME);

		if ($this->isColumnModified(CurrencyPeer::ID)) $criteria->add(CurrencyPeer::ID, $this->id);
		if ($this->isColumnModified(CurrencyPeer::TITLE)) $criteria->add(CurrencyPeer::TITLE, $this->title);
		if ($this->isColumnModified(CurrencyPeer::CODE)) $criteria->add(CurrencyPeer::CODE, $this->code);
		if ($this->isColumnModified(CurrencyPeer::SYMBOL_LEFT)) $criteria->add(CurrencyPeer::SYMBOL_LEFT, $this->symbol_left);
		if ($this->isColumnModified(CurrencyPeer::SYMBOL_RIGHT)) $criteria->add(CurrencyPeer::SYMBOL_RIGHT, $this->symbol_right);
		if ($this->isColumnModified(CurrencyPeer::DECIMAL_POINT)) $criteria->add(CurrencyPeer::DECIMAL_POINT, $this->decimal_point);
		if ($this->isColumnModified(CurrencyPeer::THOUSANDS_POINT)) $criteria->add(CurrencyPeer::THOUSANDS_POINT, $this->thousands_point);
		if ($this->isColumnModified(CurrencyPeer::DECIMAL_PLACES)) $criteria->add(CurrencyPeer::DECIMAL_PLACES, $this->decimal_places);
		if ($this->isColumnModified(CurrencyPeer::VALUE)) $criteria->add(CurrencyPeer::VALUE, $this->value);
		if ($this->isColumnModified(CurrencyPeer::IS_DEFAULT)) $criteria->add(CurrencyPeer::IS_DEFAULT, $this->is_default);
		if ($this->isColumnModified(CurrencyPeer::IS_ACTIVE)) $criteria->add(CurrencyPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(CurrencyPeer::CREATED_AT)) $criteria->add(CurrencyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CurrencyPeer::UPDATED_AT)) $criteria->add(CurrencyPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CurrencyPeer::DATABASE_NAME);

		$criteria->add(CurrencyPeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setCode($this->code);

		$copyObj->setSymbolLeft($this->symbol_left);

		$copyObj->setSymbolRight($this->symbol_right);

		$copyObj->setDecimalPoint($this->decimal_point);

		$copyObj->setThousandsPoint($this->thousands_point);

		$copyObj->setDecimalPlaces($this->decimal_places);

		$copyObj->setValue($this->value);

		$copyObj->setIsDefault($this->is_default);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getBaskets() as $relObj) {
				$copyObj->addBasket($relObj->copy($deepCopy));
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
			self::$peer = new CurrencyPeer();
		}
		return self::$peer;
	}

	
	public function initBaskets()
	{
		if ($this->collBaskets === null) {
			$this->collBaskets = array();
		}
	}

	
	public function getBaskets($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBaskets === null) {
			if ($this->isNew()) {
			   $this->collBaskets = array();
			} else {

				$criteria->add(BasketPeer::CURRENCY_ID, $this->getId());

				BasketPeer::addSelectColumns($criteria);
				$this->collBaskets = BasketPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BasketPeer::CURRENCY_ID, $this->getId());

				BasketPeer::addSelectColumns($criteria);
				if (!isset($this->lastBasketCriteria) || !$this->lastBasketCriteria->equals($criteria)) {
					$this->collBaskets = BasketPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBasketCriteria = $criteria;
		return $this->collBaskets;
	}

	
	public function countBaskets($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BasketPeer::CURRENCY_ID, $this->getId());

		return BasketPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBasket(Basket $l)
	{
		$this->collBaskets[] = $l;
		$l->setCurrency($this);
	}


	
	public function getBasketsJoinMember($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBaskets === null) {
			if ($this->isNew()) {
				$this->collBaskets = array();
			} else {

				$criteria->add(BasketPeer::CURRENCY_ID, $this->getId());

				$this->collBaskets = BasketPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(BasketPeer::CURRENCY_ID, $this->getId());

			if (!isset($this->lastBasketCriteria) || !$this->lastBasketCriteria->equals($criteria)) {
				$this->collBaskets = BasketPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastBasketCriteria = $criteria;

		return $this->collBaskets;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCurrency:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCurrency::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 