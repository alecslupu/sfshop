<?php


abstract class BasePayment extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $accept_currencies_codes;


	
	protected $name_class_form_params;


	
	protected $charge_route;


	
	protected $icon;


	
	protected $params;


	
	protected $is_active = false;


	
	protected $is_deleted = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collPaymentI18ns;

	
	protected $lastPaymentI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getAcceptCurrenciesCodes()
	{

		return $this->accept_currencies_codes;
	}

	
	public function getNameClassFormParams()
	{

		return $this->name_class_form_params;
	}

	
	public function getChargeRoute()
	{

		return $this->charge_route;
	}

	
	public function getIcon()
	{

		return $this->icon;
	}

	
	public function getParams()
	{

		return $this->params;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getIsDeleted()
	{

		return $this->is_deleted;
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
			$this->modifiedColumns[] = PaymentPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = PaymentPeer::NAME;
		}

	} 
	
	public function setAcceptCurrenciesCodes($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->accept_currencies_codes !== $v) {
			$this->accept_currencies_codes = $v;
			$this->modifiedColumns[] = PaymentPeer::ACCEPT_CURRENCIES_CODES;
		}

	} 
	
	public function setNameClassFormParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name_class_form_params !== $v) {
			$this->name_class_form_params = $v;
			$this->modifiedColumns[] = PaymentPeer::NAME_CLASS_FORM_PARAMS;
		}

	} 
	
	public function setChargeRoute($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->charge_route !== $v) {
			$this->charge_route = $v;
			$this->modifiedColumns[] = PaymentPeer::CHARGE_ROUTE;
		}

	} 
	
	public function setIcon($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->icon !== $v) {
			$this->icon = $v;
			$this->modifiedColumns[] = PaymentPeer::ICON;
		}

	} 
	
	public function setParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->params !== $v) {
			$this->params = $v;
			$this->modifiedColumns[] = PaymentPeer::PARAMS;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = PaymentPeer::IS_ACTIVE;
		}

	} 
	
	public function setIsDeleted($v)
	{

		if ($this->is_deleted !== $v || $v === false) {
			$this->is_deleted = $v;
			$this->modifiedColumns[] = PaymentPeer::IS_DELETED;
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
			$this->modifiedColumns[] = PaymentPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PaymentPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->accept_currencies_codes = $rs->getString($startcol + 2);

			$this->name_class_form_params = $rs->getString($startcol + 3);

			$this->charge_route = $rs->getString($startcol + 4);

			$this->icon = $rs->getString($startcol + 5);

			$this->params = $rs->getString($startcol + 6);

			$this->is_active = $rs->getBoolean($startcol + 7);

			$this->is_deleted = $rs->getBoolean($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Payment object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasePayment:delete:pre') as $callable)
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
			$con = Propel::getConnection(PaymentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PaymentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePayment:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasePayment:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(PaymentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PaymentPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PaymentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePayment:save:post') as $callable)
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
					$pk = PaymentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PaymentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPaymentI18ns !== null) {
				foreach($this->collPaymentI18ns as $referrerFK) {
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


			if (($retval = PaymentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPaymentI18ns !== null) {
					foreach($this->collPaymentI18ns as $referrerFK) {
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
		$pos = PaymentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getAcceptCurrenciesCodes();
				break;
			case 3:
				return $this->getNameClassFormParams();
				break;
			case 4:
				return $this->getChargeRoute();
				break;
			case 5:
				return $this->getIcon();
				break;
			case 6:
				return $this->getParams();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getIsDeleted();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			case 10:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PaymentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getAcceptCurrenciesCodes(),
			$keys[3] => $this->getNameClassFormParams(),
			$keys[4] => $this->getChargeRoute(),
			$keys[5] => $this->getIcon(),
			$keys[6] => $this->getParams(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getIsDeleted(),
			$keys[9] => $this->getCreatedAt(),
			$keys[10] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PaymentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setAcceptCurrenciesCodes($value);
				break;
			case 3:
				$this->setNameClassFormParams($value);
				break;
			case 4:
				$this->setChargeRoute($value);
				break;
			case 5:
				$this->setIcon($value);
				break;
			case 6:
				$this->setParams($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setIsDeleted($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
			case 10:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PaymentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAcceptCurrenciesCodes($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNameClassFormParams($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setChargeRoute($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIcon($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setParams($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsDeleted($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PaymentPeer::DATABASE_NAME);

		if ($this->isColumnModified(PaymentPeer::ID)) $criteria->add(PaymentPeer::ID, $this->id);
		if ($this->isColumnModified(PaymentPeer::NAME)) $criteria->add(PaymentPeer::NAME, $this->name);
		if ($this->isColumnModified(PaymentPeer::ACCEPT_CURRENCIES_CODES)) $criteria->add(PaymentPeer::ACCEPT_CURRENCIES_CODES, $this->accept_currencies_codes);
		if ($this->isColumnModified(PaymentPeer::NAME_CLASS_FORM_PARAMS)) $criteria->add(PaymentPeer::NAME_CLASS_FORM_PARAMS, $this->name_class_form_params);
		if ($this->isColumnModified(PaymentPeer::CHARGE_ROUTE)) $criteria->add(PaymentPeer::CHARGE_ROUTE, $this->charge_route);
		if ($this->isColumnModified(PaymentPeer::ICON)) $criteria->add(PaymentPeer::ICON, $this->icon);
		if ($this->isColumnModified(PaymentPeer::PARAMS)) $criteria->add(PaymentPeer::PARAMS, $this->params);
		if ($this->isColumnModified(PaymentPeer::IS_ACTIVE)) $criteria->add(PaymentPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(PaymentPeer::IS_DELETED)) $criteria->add(PaymentPeer::IS_DELETED, $this->is_deleted);
		if ($this->isColumnModified(PaymentPeer::CREATED_AT)) $criteria->add(PaymentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PaymentPeer::UPDATED_AT)) $criteria->add(PaymentPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PaymentPeer::DATABASE_NAME);

		$criteria->add(PaymentPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setAcceptCurrenciesCodes($this->accept_currencies_codes);

		$copyObj->setNameClassFormParams($this->name_class_form_params);

		$copyObj->setChargeRoute($this->charge_route);

		$copyObj->setIcon($this->icon);

		$copyObj->setParams($this->params);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsDeleted($this->is_deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPaymentI18ns() as $relObj) {
				$copyObj->addPaymentI18n($relObj->copy($deepCopy));
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
			self::$peer = new PaymentPeer();
		}
		return self::$peer;
	}

	
	public function initPaymentI18ns()
	{
		if ($this->collPaymentI18ns === null) {
			$this->collPaymentI18ns = array();
		}
	}

	
	public function getPaymentI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPaymentI18ns === null) {
			if ($this->isNew()) {
			   $this->collPaymentI18ns = array();
			} else {

				$criteria->add(PaymentI18nPeer::ID, $this->getId());

				PaymentI18nPeer::addSelectColumns($criteria);
				$this->collPaymentI18ns = PaymentI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PaymentI18nPeer::ID, $this->getId());

				PaymentI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastPaymentI18nCriteria) || !$this->lastPaymentI18nCriteria->equals($criteria)) {
					$this->collPaymentI18ns = PaymentI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPaymentI18nCriteria = $criteria;
		return $this->collPaymentI18ns;
	}

	
	public function countPaymentI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PaymentI18nPeer::ID, $this->getId());

		return PaymentI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPaymentI18n(PaymentI18n $l)
	{
		$this->collPaymentI18ns[] = $l;
		$l->setPayment($this);
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
    return $this->getCurrentPaymentI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentPaymentI18n($culture)->setTitle($value);
  }

  public function getDescription($culture = null)
  {
    return $this->getCurrentPaymentI18n($culture)->getDescription();
  }

  public function setDescription($value, $culture = null)
  {
    $this->getCurrentPaymentI18n($culture)->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentPaymentI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = PaymentI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setPaymentI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setPaymentI18nForCulture(new PaymentI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setPaymentI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addPaymentI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePayment:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePayment::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 