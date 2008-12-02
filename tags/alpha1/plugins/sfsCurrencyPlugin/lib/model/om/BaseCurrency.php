<?php


abstract class BaseCurrency extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $code;


	
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

	
	protected $collCurrencyI18ns;

	
	protected $lastCurrencyI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCode()
	{

		return $this->code;
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

			$this->code = $rs->getString($startcol + 1);

			$this->decimal_point = $rs->getString($startcol + 2);

			$this->thousands_point = $rs->getString($startcol + 3);

			$this->decimal_places = $rs->getString($startcol + 4);

			$this->value = $rs->getFloat($startcol + 5);

			$this->is_default = $rs->getBoolean($startcol + 6);

			$this->is_active = $rs->getBoolean($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
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

			if ($this->collCurrencyI18ns !== null) {
				foreach($this->collCurrencyI18ns as $referrerFK) {
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

				if ($this->collCurrencyI18ns !== null) {
					foreach($this->collCurrencyI18ns as $referrerFK) {
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
				return $this->getCode();
				break;
			case 2:
				return $this->getDecimalPoint();
				break;
			case 3:
				return $this->getThousandsPoint();
				break;
			case 4:
				return $this->getDecimalPlaces();
				break;
			case 5:
				return $this->getValue();
				break;
			case 6:
				return $this->getIsDefault();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
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
			$keys[1] => $this->getCode(),
			$keys[2] => $this->getDecimalPoint(),
			$keys[3] => $this->getThousandsPoint(),
			$keys[4] => $this->getDecimalPlaces(),
			$keys[5] => $this->getValue(),
			$keys[6] => $this->getIsDefault(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
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
				$this->setCode($value);
				break;
			case 2:
				$this->setDecimalPoint($value);
				break;
			case 3:
				$this->setThousandsPoint($value);
				break;
			case 4:
				$this->setDecimalPlaces($value);
				break;
			case 5:
				$this->setValue($value);
				break;
			case 6:
				$this->setIsDefault($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CurrencyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCode($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDecimalPoint($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setThousandsPoint($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDecimalPlaces($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setValue($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsDefault($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CurrencyPeer::DATABASE_NAME);

		if ($this->isColumnModified(CurrencyPeer::ID)) $criteria->add(CurrencyPeer::ID, $this->id);
		if ($this->isColumnModified(CurrencyPeer::CODE)) $criteria->add(CurrencyPeer::CODE, $this->code);
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

		$copyObj->setCode($this->code);

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

			foreach($this->getCurrencyI18ns() as $relObj) {
				$copyObj->addCurrencyI18n($relObj->copy($deepCopy));
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

	
	public function initCurrencyI18ns()
	{
		if ($this->collCurrencyI18ns === null) {
			$this->collCurrencyI18ns = array();
		}
	}

	
	public function getCurrencyI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCurrencyI18ns === null) {
			if ($this->isNew()) {
			   $this->collCurrencyI18ns = array();
			} else {

				$criteria->add(CurrencyI18nPeer::ID, $this->getId());

				CurrencyI18nPeer::addSelectColumns($criteria);
				$this->collCurrencyI18ns = CurrencyI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CurrencyI18nPeer::ID, $this->getId());

				CurrencyI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastCurrencyI18nCriteria) || !$this->lastCurrencyI18nCriteria->equals($criteria)) {
					$this->collCurrencyI18ns = CurrencyI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCurrencyI18nCriteria = $criteria;
		return $this->collCurrencyI18ns;
	}

	
	public function countCurrencyI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CurrencyI18nPeer::ID, $this->getId());

		return CurrencyI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCurrencyI18n(CurrencyI18n $l)
	{
		$this->collCurrencyI18ns[] = $l;
		$l->setCurrency($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getTitle($culture = null)
  {
    return $this->getCurrentCurrencyI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentCurrencyI18n($culture)->setTitle($value);
  }

  public function getSymbolLeft($culture = null)
  {
    return $this->getCurrentCurrencyI18n($culture)->getSymbolLeft();
  }

  public function setSymbolLeft($value, $culture = null)
  {
    $this->getCurrentCurrencyI18n($culture)->setSymbolLeft($value);
  }

  public function getSymbolRight($culture = null)
  {
    return $this->getCurrentCurrencyI18n($culture)->getSymbolRight();
  }

  public function setSymbolRight($value, $culture = null)
  {
    $this->getCurrentCurrencyI18n($culture)->setSymbolRight($value);
  }

  protected $current_i18n = array();

  public function getCurrentCurrencyI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = CurrencyI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setCurrencyI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setCurrencyI18nForCulture(new CurrencyI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setCurrencyI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addCurrencyI18n($object);
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