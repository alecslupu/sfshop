<?php


abstract class BaseState extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $country_id;


	
	protected $iso;


	
	protected $title_english;


	
	protected $is_active = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aCountry;

	
	protected $collStateI18ns;

	
	protected $lastStateI18nCriteria = null;

	
	protected $collOrderItemsRelatedByMemberStateId;

	
	protected $lastOrderItemRelatedByMemberStateIdCriteria = null;

	
	protected $collOrderItemsRelatedByBillingStateId;

	
	protected $lastOrderItemRelatedByBillingStateIdCriteria = null;

	
	protected $collOrderItemsRelatedByDeliveryStateId;

	
	protected $lastOrderItemRelatedByDeliveryStateIdCriteria = null;

	
	protected $collAddressBooks;

	
	protected $lastAddressBookCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCountryId()
	{

		return $this->country_id;
	}

	
	public function getIso()
	{

		return $this->iso;
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
			$this->modifiedColumns[] = StatePeer::ID;
		}

	} 
	
	public function setCountryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->country_id !== $v) {
			$this->country_id = $v;
			$this->modifiedColumns[] = StatePeer::COUNTRY_ID;
		}

		if ($this->aCountry !== null && $this->aCountry->getId() !== $v) {
			$this->aCountry = null;
		}

	} 
	
	public function setIso($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->iso !== $v) {
			$this->iso = $v;
			$this->modifiedColumns[] = StatePeer::ISO;
		}

	} 
	
	public function setTitleEnglish($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title_english !== $v) {
			$this->title_english = $v;
			$this->modifiedColumns[] = StatePeer::TITLE_ENGLISH;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = StatePeer::IS_ACTIVE;
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
			$this->modifiedColumns[] = StatePeer::CREATED_AT;
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
			$this->modifiedColumns[] = StatePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->country_id = $rs->getInt($startcol + 1);

			$this->iso = $rs->getString($startcol + 2);

			$this->title_english = $rs->getString($startcol + 3);

			$this->is_active = $rs->getBoolean($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating State object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseState:delete:pre') as $callable)
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
			$con = Propel::getConnection(StatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			StatePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseState:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseState:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(StatePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(StatePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(StatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseState:save:post') as $callable)
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


												
			if ($this->aCountry !== null) {
				if ($this->aCountry->isModified() || ($this->aCountry->getCulture() && $this->aCountry->getCurrentCountryI18n()->isModified())) {
					$affectedRows += $this->aCountry->save($con);
				}
				$this->setCountry($this->aCountry);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = StatePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += StatePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collStateI18ns !== null) {
				foreach($this->collStateI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByMemberStateId !== null) {
				foreach($this->collOrderItemsRelatedByMemberStateId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByBillingStateId !== null) {
				foreach($this->collOrderItemsRelatedByBillingStateId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByDeliveryStateId !== null) {
				foreach($this->collOrderItemsRelatedByDeliveryStateId as $referrerFK) {
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


												
			if ($this->aCountry !== null) {
				if (!$this->aCountry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCountry->getValidationFailures());
				}
			}


			if (($retval = StatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collStateI18ns !== null) {
					foreach($this->collStateI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByMemberStateId !== null) {
					foreach($this->collOrderItemsRelatedByMemberStateId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByBillingStateId !== null) {
					foreach($this->collOrderItemsRelatedByBillingStateId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByDeliveryStateId !== null) {
					foreach($this->collOrderItemsRelatedByDeliveryStateId as $referrerFK) {
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
		$pos = StatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCountryId();
				break;
			case 2:
				return $this->getIso();
				break;
			case 3:
				return $this->getTitleEnglish();
				break;
			case 4:
				return $this->getIsActive();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = StatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCountryId(),
			$keys[2] => $this->getIso(),
			$keys[3] => $this->getTitleEnglish(),
			$keys[4] => $this->getIsActive(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = StatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCountryId($value);
				break;
			case 2:
				$this->setIso($value);
				break;
			case 3:
				$this->setTitleEnglish($value);
				break;
			case 4:
				$this->setIsActive($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = StatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCountryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIso($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitleEnglish($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsActive($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(StatePeer::DATABASE_NAME);

		if ($this->isColumnModified(StatePeer::ID)) $criteria->add(StatePeer::ID, $this->id);
		if ($this->isColumnModified(StatePeer::COUNTRY_ID)) $criteria->add(StatePeer::COUNTRY_ID, $this->country_id);
		if ($this->isColumnModified(StatePeer::ISO)) $criteria->add(StatePeer::ISO, $this->iso);
		if ($this->isColumnModified(StatePeer::TITLE_ENGLISH)) $criteria->add(StatePeer::TITLE_ENGLISH, $this->title_english);
		if ($this->isColumnModified(StatePeer::IS_ACTIVE)) $criteria->add(StatePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(StatePeer::CREATED_AT)) $criteria->add(StatePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(StatePeer::UPDATED_AT)) $criteria->add(StatePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(StatePeer::DATABASE_NAME);

		$criteria->add(StatePeer::ID, $this->id);

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

		$copyObj->setCountryId($this->country_id);

		$copyObj->setIso($this->iso);

		$copyObj->setTitleEnglish($this->title_english);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getStateI18ns() as $relObj) {
				$copyObj->addStateI18n($relObj->copy($deepCopy));
			}

			foreach($this->getOrderItemsRelatedByMemberStateId() as $relObj) {
				$copyObj->addOrderItemRelatedByMemberStateId($relObj->copy($deepCopy));
			}

			foreach($this->getOrderItemsRelatedByBillingStateId() as $relObj) {
				$copyObj->addOrderItemRelatedByBillingStateId($relObj->copy($deepCopy));
			}

			foreach($this->getOrderItemsRelatedByDeliveryStateId() as $relObj) {
				$copyObj->addOrderItemRelatedByDeliveryStateId($relObj->copy($deepCopy));
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
			self::$peer = new StatePeer();
		}
		return self::$peer;
	}

	
	public function setCountry($v)
	{


		if ($v === null) {
			$this->setCountryId(NULL);
		} else {
			$this->setCountryId($v->getId());
		}


		$this->aCountry = $v;
	}


	
	public function getCountry($con = null)
	{
		if ($this->aCountry === null && ($this->country_id !== null)) {
						$this->aCountry = CountryPeer::retrieveByPK($this->country_id, $con);

			
		}
		return $this->aCountry;
	}

	
	public function initStateI18ns()
	{
		if ($this->collStateI18ns === null) {
			$this->collStateI18ns = array();
		}
	}

	
	public function getStateI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStateI18ns === null) {
			if ($this->isNew()) {
			   $this->collStateI18ns = array();
			} else {

				$criteria->add(StateI18nPeer::ID, $this->getId());

				StateI18nPeer::addSelectColumns($criteria);
				$this->collStateI18ns = StateI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(StateI18nPeer::ID, $this->getId());

				StateI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastStateI18nCriteria) || !$this->lastStateI18nCriteria->equals($criteria)) {
					$this->collStateI18ns = StateI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStateI18nCriteria = $criteria;
		return $this->collStateI18ns;
	}

	
	public function countStateI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(StateI18nPeer::ID, $this->getId());

		return StateI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addStateI18n(StateI18n $l)
	{
		$this->collStateI18ns[] = $l;
		$l->setState($this);
	}

	
	public function initOrderItemsRelatedByMemberStateId()
	{
		if ($this->collOrderItemsRelatedByMemberStateId === null) {
			$this->collOrderItemsRelatedByMemberStateId = array();
		}
	}

	
	public function getOrderItemsRelatedByMemberStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberStateId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByMemberStateId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByMemberStateIdCriteria) || !$this->lastOrderItemRelatedByMemberStateIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByMemberStateIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByMemberStateId;
	}

	
	public function countOrderItemsRelatedByMemberStateId($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

		return OrderItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderItemRelatedByMemberStateId(OrderItem $l)
	{
		$this->collOrderItemsRelatedByMemberStateId[] = $l;
		$l->setStateRelatedByMemberStateId($this);
	}


	
	public function getOrderItemsRelatedByMemberStateIdJoinDelivery($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberStateId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberStateIdCriteria) || !$this->lastOrderItemRelatedByMemberStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberStateId;
	}


	
	public function getOrderItemsRelatedByMemberStateIdJoinMember($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberStateId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberStateIdCriteria) || !$this->lastOrderItemRelatedByMemberStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberStateId;
	}


	
	public function getOrderItemsRelatedByMemberStateIdJoinCountryRelatedByMemberCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberStateId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberStateIdCriteria) || !$this->lastOrderItemRelatedByMemberStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberStateId;
	}


	
	public function getOrderItemsRelatedByMemberStateIdJoinCountryRelatedByBillingCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberStateId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberStateIdCriteria) || !$this->lastOrderItemRelatedByMemberStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberStateId;
	}


	
	public function getOrderItemsRelatedByMemberStateIdJoinCountryRelatedByDeliveryCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberStateId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberStateIdCriteria) || !$this->lastOrderItemRelatedByMemberStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberStateId;
	}


	
	public function getOrderItemsRelatedByMemberStateIdJoinOrderStatus($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByMemberStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByMemberStateId = array();
			} else {

				$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByMemberStateIdCriteria) || !$this->lastOrderItemRelatedByMemberStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByMemberStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByMemberStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByMemberStateId;
	}

	
	public function initOrderItemsRelatedByBillingStateId()
	{
		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			$this->collOrderItemsRelatedByBillingStateId = array();
		}
	}

	
	public function getOrderItemsRelatedByBillingStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByBillingStateId;
	}

	
	public function countOrderItemsRelatedByBillingStateId($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

		return OrderItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderItemRelatedByBillingStateId(OrderItem $l)
	{
		$this->collOrderItemsRelatedByBillingStateId[] = $l;
		$l->setStateRelatedByBillingStateId($this);
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinDelivery($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinMember($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinCountryRelatedByMemberCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinCountryRelatedByBillingCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinCountryRelatedByDeliveryCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinOrderStatus($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}

	
	public function initOrderItemsRelatedByDeliveryStateId()
	{
		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			$this->collOrderItemsRelatedByDeliveryStateId = array();
		}
	}

	
	public function getOrderItemsRelatedByDeliveryStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByDeliveryStateId;
	}

	
	public function countOrderItemsRelatedByDeliveryStateId($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

		return OrderItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderItemRelatedByDeliveryStateId(OrderItem $l)
	{
		$this->collOrderItemsRelatedByDeliveryStateId[] = $l;
		$l->setStateRelatedByDeliveryStateId($this);
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinDelivery($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinMember($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinCountryRelatedByMemberCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinCountryRelatedByBillingCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinCountryRelatedByDeliveryCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinOrderStatus($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->getId());

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
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

				$criteria->add(AddressBookPeer::STATE_ID, $this->getId());

				AddressBookPeer::addSelectColumns($criteria);
				$this->collAddressBooks = AddressBookPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AddressBookPeer::STATE_ID, $this->getId());

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

		$criteria->add(AddressBookPeer::STATE_ID, $this->getId());

		return AddressBookPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAddressBook(AddressBook $l)
	{
		$this->collAddressBooks[] = $l;
		$l->setState($this);
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

				$criteria->add(AddressBookPeer::STATE_ID, $this->getId());

				$this->collAddressBooks = AddressBookPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(AddressBookPeer::STATE_ID, $this->getId());

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastAddressBookCriteria = $criteria;

		return $this->collAddressBooks;
	}


	
	public function getAddressBooksJoinCountry($criteria = null, $con = null)
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

				$criteria->add(AddressBookPeer::STATE_ID, $this->getId());

				$this->collAddressBooks = AddressBookPeer::doSelectJoinCountry($criteria, $con);
			}
		} else {
									
			$criteria->add(AddressBookPeer::STATE_ID, $this->getId());

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinCountry($criteria, $con);
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
    return $this->getCurrentStateI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentStateI18n($culture)->setTitle($value);
  }

  protected $current_i18n = array();

  public function getCurrentStateI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = StateI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setStateI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setStateI18nForCulture(new StateI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setStateI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addStateI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseState:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseState::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 