<?php


abstract class BaseCountry extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $iso;


	
	protected $iso_a3;


	
	protected $iso_n;


	
	protected $title_english;


	
	protected $is_active = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collCountryI18ns;

	
	protected $lastCountryI18nCriteria = null;

	
	protected $collStates;

	
	protected $lastStateCriteria = null;

	
	protected $collOrderItemsRelatedByMemberCountryId;

	
	protected $lastOrderItemRelatedByMemberCountryIdCriteria = null;

	
	protected $collOrderItemsRelatedByBillingCountryId;

	
	protected $lastOrderItemRelatedByBillingCountryIdCriteria = null;

	
	protected $collOrderItemsRelatedByDeliveryCountryId;

	
	protected $lastOrderItemRelatedByDeliveryCountryIdCriteria = null;

	
	protected $collAddressBooks;

	
	protected $lastAddressBookCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIso()
	{

		return $this->iso;
	}

	
	public function getIsoA3()
	{

		return $this->iso_a3;
	}

	
	public function getIsoN()
	{

		return $this->iso_n;
	}

	
	public function getTitleEnglish()
	{

		return $this->title_english;
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
			$this->modifiedColumns[] = CountryPeer::ID;
		}

	} 
	
	public function setIso($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->iso !== $v) {
			$this->iso = $v;
			$this->modifiedColumns[] = CountryPeer::ISO;
		}

	} 
	
	public function setIsoA3($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->iso_a3 !== $v) {
			$this->iso_a3 = $v;
			$this->modifiedColumns[] = CountryPeer::ISO_A3;
		}

	} 
	
	public function setIsoN($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->iso_n !== $v) {
			$this->iso_n = $v;
			$this->modifiedColumns[] = CountryPeer::ISO_N;
		}

	} 
	
	public function setTitleEnglish($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title_english !== $v) {
			$this->title_english = $v;
			$this->modifiedColumns[] = CountryPeer::TITLE_ENGLISH;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = CountryPeer::IS_ACTIVE;
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
			$this->modifiedColumns[] = CountryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = CountryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->iso = $rs->getString($startcol + 1);

			$this->iso_a3 = $rs->getString($startcol + 2);

			$this->iso_n = $rs->getString($startcol + 3);

			$this->title_english = $rs->getString($startcol + 4);

			$this->is_active = $rs->getBoolean($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Country object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseCountry:delete:pre') as $callable)
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
			$con = Propel::getConnection(CountryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CountryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCountry:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseCountry:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(CountryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(CountryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CountryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCountry:save:post') as $callable)
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
					$pk = CountryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CountryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCountryI18ns !== null) {
				foreach($this->collCountryI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collStates !== null) {
				foreach($this->collStates as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByMemberCountryId !== null) {
				foreach($this->collOrderItemsRelatedByMemberCountryId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByBillingCountryId !== null) {
				foreach($this->collOrderItemsRelatedByBillingCountryId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByDeliveryCountryId !== null) {
				foreach($this->collOrderItemsRelatedByDeliveryCountryId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAddressBooks !== null) {
				foreach($this->collAddressBooks as $referrerFK) {
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


			if (($retval = CountryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCountryI18ns !== null) {
					foreach($this->collCountryI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collStates !== null) {
					foreach($this->collStates as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByMemberCountryId !== null) {
					foreach($this->collOrderItemsRelatedByMemberCountryId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByBillingCountryId !== null) {
					foreach($this->collOrderItemsRelatedByBillingCountryId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByDeliveryCountryId !== null) {
					foreach($this->collOrderItemsRelatedByDeliveryCountryId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAddressBooks !== null) {
					foreach($this->collAddressBooks as $referrerFK) {
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
		$pos = CountryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIso();
				break;
			case 2:
				return $this->getIsoA3();
				break;
			case 3:
				return $this->getIsoN();
				break;
			case 4:
				return $this->getTitleEnglish();
				break;
			case 5:
				return $this->getIsActive();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CountryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIso(),
			$keys[2] => $this->getIsoA3(),
			$keys[3] => $this->getIsoN(),
			$keys[4] => $this->getTitleEnglish(),
			$keys[5] => $this->getIsActive(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CountryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIso($value);
				break;
			case 2:
				$this->setIsoA3($value);
				break;
			case 3:
				$this->setIsoN($value);
				break;
			case 4:
				$this->setTitleEnglish($value);
				break;
			case 5:
				$this->setIsActive($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CountryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsoA3($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsoN($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTitleEnglish($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsActive($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CountryPeer::DATABASE_NAME);

		if ($this->isColumnModified(CountryPeer::ID)) $criteria->add(CountryPeer::ID, $this->id);
		if ($this->isColumnModified(CountryPeer::ISO)) $criteria->add(CountryPeer::ISO, $this->iso);
		if ($this->isColumnModified(CountryPeer::ISO_A3)) $criteria->add(CountryPeer::ISO_A3, $this->iso_a3);
		if ($this->isColumnModified(CountryPeer::ISO_N)) $criteria->add(CountryPeer::ISO_N, $this->iso_n);
		if ($this->isColumnModified(CountryPeer::TITLE_ENGLISH)) $criteria->add(CountryPeer::TITLE_ENGLISH, $this->title_english);
		if ($this->isColumnModified(CountryPeer::IS_ACTIVE)) $criteria->add(CountryPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(CountryPeer::CREATED_AT)) $criteria->add(CountryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CountryPeer::UPDATED_AT)) $criteria->add(CountryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CountryPeer::DATABASE_NAME);

		$criteria->add(CountryPeer::ID, $this->id);

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

		$copyObj->setIso($this->iso);

		$copyObj->setIsoA3($this->iso_a3);

		$copyObj->setIsoN($this->iso_n);

		$copyObj->setTitleEnglish($this->title_english);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCountryI18ns() as $relObj) {
				$copyObj->addCountryI18n($relObj->copy($deepCopy));
			}

			foreach($this->getStates() as $relObj) {
				$copyObj->addState($relObj->copy($deepCopy));
			}

			foreach($this->getOrderItemsRelatedByMemberCountryId() as $relObj) {
				$copyObj->addOrderItemRelatedByMemberCountryId($relObj->copy($deepCopy));
			}

			foreach($this->getOrderItemsRelatedByBillingCountryId() as $relObj) {
				$copyObj->addOrderItemRelatedByBillingCountryId($relObj->copy($deepCopy));
			}

			foreach($this->getOrderItemsRelatedByDeliveryCountryId() as $relObj) {
				$copyObj->addOrderItemRelatedByDeliveryCountryId($relObj->copy($deepCopy));
			}

			foreach($this->getAddressBooks() as $relObj) {
				$copyObj->addAddressBook($relObj->copy($deepCopy));
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
			self::$peer = new CountryPeer();
		}
		return self::$peer;
	}

	
	public function initCountryI18ns()
	{
		if ($this->collCountryI18ns === null) {
			$this->collCountryI18ns = array();
		}
	}

	
	public function getCountryI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCountryI18ns === null) {
			if ($this->isNew()) {
			   $this->collCountryI18ns = array();
			} else {

				$criteria->add(CountryI18nPeer::ID, $this->getId());

				CountryI18nPeer::addSelectColumns($criteria);
				$this->collCountryI18ns = CountryI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CountryI18nPeer::ID, $this->getId());

				CountryI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastCountryI18nCriteria) || !$this->lastCountryI18nCriteria->equals($criteria)) {
					$this->collCountryI18ns = CountryI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCountryI18nCriteria = $criteria;
		return $this->collCountryI18ns;
	}

	
	public function countCountryI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CountryI18nPeer::ID, $this->getId());

		return CountryI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCountryI18n(CountryI18n $l)
	{
		$this->collCountryI18ns[] = $l;
		$l->setCountry($this);
	}

	
	public function initStates()
	{
		if ($this->collStates === null) {
			$this->collStates = array();
		}
	}

	
	public function getStates($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStates === null) {
			if ($this->isNew()) {
			   $this->collStates = array();
			} else {

				$criteria->add(StatePeer::COUNTRY_ID, $this->getId());

				StatePeer::addSelectColumns($criteria);
				$this->collStates = StatePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(StatePeer::COUNTRY_ID, $this->getId());

				StatePeer::addSelectColumns($criteria);
				if (!isset($this->lastStateCriteria) || !$this->lastStateCriteria->equals($criteria)) {
					$this->collStates = StatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStateCriteria = $criteria;
		return $this->collStates;
	}

	
	public function countStates($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(StatePeer::COUNTRY_ID, $this->getId());

		return StatePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addState(State $l)
	{
		$this->collStates[] = $l;
		$l->setCountry($this);
	}

	
	public function initOrderItemsRelatedByMemberCountryId()
	{
		if ($this->collOrderItemsRelatedByMemberCountryId === null) {
			$this->collOrderItemsRelatedByMemberCountryId = array();
		}
	}

	
	public function getOrderItemsRelatedByMemberCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberCountryId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByMemberCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByMemberCountryIdCriteria) || !$this->lastOrderItemRelatedByMemberCountryIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByMemberCountryIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByMemberCountryId;
	}

	
	public function countOrderItemsRelatedByMemberCountryId($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

		return OrderItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderItemRelatedByMemberCountryId(OrderItem $l)
	{
		$this->collOrderItemsRelatedByMemberCountryId[] = $l;
		$l->setCountryRelatedByMemberCountryId($this);
	}


	
	public function getOrderItemsRelatedByMemberCountryIdJoinDelivery($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberCountryIdCriteria) || !$this->lastOrderItemRelatedByMemberCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberCountryId;
	}


	
	public function getOrderItemsRelatedByMemberCountryIdJoinMember($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberCountryIdCriteria) || !$this->lastOrderItemRelatedByMemberCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberCountryId;
	}


	
	public function getOrderItemsRelatedByMemberCountryIdJoinStateRelatedByMemberStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberCountryIdCriteria) || !$this->lastOrderItemRelatedByMemberCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberCountryId;
	}


	
	public function getOrderItemsRelatedByMemberCountryIdJoinStateRelatedByBillingStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberCountryIdCriteria) || !$this->lastOrderItemRelatedByMemberCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberCountryId;
	}


	
	public function getOrderItemsRelatedByMemberCountryIdJoinStateRelatedByDeliveryStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberCountryIdCriteria) || !$this->lastOrderItemRelatedByMemberCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberCountryId;
	}


	
	public function getOrderItemsRelatedByMemberCountryIdJoinOrderStatus($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberCountryIdCriteria) || !$this->lastOrderItemRelatedByMemberCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberCountryId;
	}

	
	public function initOrderItemsRelatedByBillingCountryId()
	{
		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			$this->collOrderItemsRelatedByBillingCountryId = array();
		}
	}

	
	public function getOrderItemsRelatedByBillingCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByBillingCountryId;
	}

	
	public function countOrderItemsRelatedByBillingCountryId($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

		return OrderItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderItemRelatedByBillingCountryId(OrderItem $l)
	{
		$this->collOrderItemsRelatedByBillingCountryId[] = $l;
		$l->setCountryRelatedByBillingCountryId($this);
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinDelivery($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinMember($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinStateRelatedByMemberStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinStateRelatedByBillingStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinStateRelatedByDeliveryStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinOrderStatus($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}

	
	public function initOrderItemsRelatedByDeliveryCountryId()
	{
		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			$this->collOrderItemsRelatedByDeliveryCountryId = array();
		}
	}

	
	public function getOrderItemsRelatedByDeliveryCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}

	
	public function countOrderItemsRelatedByDeliveryCountryId($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

		return OrderItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderItemRelatedByDeliveryCountryId(OrderItem $l)
	{
		$this->collOrderItemsRelatedByDeliveryCountryId[] = $l;
		$l->setCountryRelatedByDeliveryCountryId($this);
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinDelivery($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinMember($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinStateRelatedByMemberStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinStateRelatedByBillingStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinStateRelatedByDeliveryStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinOrderStatus($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}

	
	public function initAddressBooks()
	{
		if ($this->collAddressBooks === null) {
			$this->collAddressBooks = array();
		}
	}

	
	public function getAddressBooks($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
			   $this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->getId());

				AddressBookPeer::addSelectColumns($criteria);
				$this->collAddressBooks = AddressBookPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->getId());

				AddressBookPeer::addSelectColumns($criteria);
				if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
					$this->collAddressBooks = AddressBookPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAddressBookCriteria = $criteria;
		return $this->collAddressBooks;
	}

	
	public function countAddressBooks($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AddressBookPeer::COUNTRY_ID, $this->getId());

		return AddressBookPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAddressBook(AddressBook $l)
	{
		$this->collAddressBooks[] = $l;
		$l->setCountry($this);
	}


	
	public function getAddressBooksJoinMember($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
				$this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->getId());

				$this->collAddressBooks = AddressBookPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(AddressBookPeer::COUNTRY_ID, $this->getId());

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastAddressBookCriteria = $criteria;

		return $this->collAddressBooks;
	}


	
	public function getAddressBooksJoinState($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
				$this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->getId());

				$this->collAddressBooks = AddressBookPeer::doSelectJoinState($criteria, $con);
			}
		} else {
									
			$criteria->add(AddressBookPeer::COUNTRY_ID, $this->getId());

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinState($criteria, $con);
			}
		}
		$this->lastAddressBookCriteria = $criteria;

		return $this->collAddressBooks;
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
    return $this->getCurrentCountryI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentCountryI18n($culture)->setTitle($value);
  }

  protected $current_i18n = array();

  public function getCurrentCountryI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = CountryI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setCountryI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setCountryI18nForCulture(new CountryI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setCountryI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addCountryI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCountry:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCountry::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 