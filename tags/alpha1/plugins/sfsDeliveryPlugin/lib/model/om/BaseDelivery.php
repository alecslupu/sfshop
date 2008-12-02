<?php


abstract class BaseDelivery extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $accept_currencies_codes;


	
	protected $name_class_service;


	
	protected $name_class_form_params;


	
	protected $icon;


	
	protected $params;


	
	protected $is_active = false;


	
	protected $is_deleted = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collDeliveryI18ns;

	
	protected $lastDeliveryI18nCriteria = null;

	
	protected $collOrderItems;

	
	protected $lastOrderItemCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getAcceptCurrenciesCodes()
	{

		return $this->accept_currencies_codes;
	}

	
	public function getNameClassService()
	{

		return $this->name_class_service;
	}

	
	public function getNameClassFormParams()
	{

		return $this->name_class_form_params;
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
			$this->modifiedColumns[] = DeliveryPeer::ID;
		}

	} 
	
	public function setAcceptCurrenciesCodes($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->accept_currencies_codes !== $v) {
			$this->accept_currencies_codes = $v;
			$this->modifiedColumns[] = DeliveryPeer::ACCEPT_CURRENCIES_CODES;
		}

	} 
	
	public function setNameClassService($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name_class_service !== $v) {
			$this->name_class_service = $v;
			$this->modifiedColumns[] = DeliveryPeer::NAME_CLASS_SERVICE;
		}

	} 
	
	public function setNameClassFormParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name_class_form_params !== $v) {
			$this->name_class_form_params = $v;
			$this->modifiedColumns[] = DeliveryPeer::NAME_CLASS_FORM_PARAMS;
		}

	} 
	
	public function setIcon($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->icon !== $v) {
			$this->icon = $v;
			$this->modifiedColumns[] = DeliveryPeer::ICON;
		}

	} 
	
	public function setParams($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->params !== $v) {
			$this->params = $v;
			$this->modifiedColumns[] = DeliveryPeer::PARAMS;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = DeliveryPeer::IS_ACTIVE;
		}

	} 
	
	public function setIsDeleted($v)
	{

		if ($this->is_deleted !== $v || $v === false) {
			$this->is_deleted = $v;
			$this->modifiedColumns[] = DeliveryPeer::IS_DELETED;
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
			$this->modifiedColumns[] = DeliveryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DeliveryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->accept_currencies_codes = $rs->getString($startcol + 1);

			$this->name_class_service = $rs->getString($startcol + 2);

			$this->name_class_form_params = $rs->getString($startcol + 3);

			$this->icon = $rs->getString($startcol + 4);

			$this->params = $rs->getString($startcol + 5);

			$this->is_active = $rs->getBoolean($startcol + 6);

			$this->is_deleted = $rs->getBoolean($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Delivery object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseDelivery:delete:pre') as $callable)
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
			$con = Propel::getConnection(DeliveryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DeliveryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDelivery:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseDelivery:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DeliveryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DeliveryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DeliveryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDelivery:save:post') as $callable)
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
					$pk = DeliveryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DeliveryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDeliveryI18ns !== null) {
				foreach($this->collDeliveryI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItems !== null) {
				foreach($this->collOrderItems as $referrerFK) {
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


			if (($retval = DeliveryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDeliveryI18ns !== null) {
					foreach($this->collDeliveryI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItems !== null) {
					foreach($this->collOrderItems as $referrerFK) {
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
		$pos = DeliveryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAcceptCurrenciesCodes();
				break;
			case 2:
				return $this->getNameClassService();
				break;
			case 3:
				return $this->getNameClassFormParams();
				break;
			case 4:
				return $this->getIcon();
				break;
			case 5:
				return $this->getParams();
				break;
			case 6:
				return $this->getIsActive();
				break;
			case 7:
				return $this->getIsDeleted();
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
		$keys = DeliveryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAcceptCurrenciesCodes(),
			$keys[2] => $this->getNameClassService(),
			$keys[3] => $this->getNameClassFormParams(),
			$keys[4] => $this->getIcon(),
			$keys[5] => $this->getParams(),
			$keys[6] => $this->getIsActive(),
			$keys[7] => $this->getIsDeleted(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DeliveryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAcceptCurrenciesCodes($value);
				break;
			case 2:
				$this->setNameClassService($value);
				break;
			case 3:
				$this->setNameClassFormParams($value);
				break;
			case 4:
				$this->setIcon($value);
				break;
			case 5:
				$this->setParams($value);
				break;
			case 6:
				$this->setIsActive($value);
				break;
			case 7:
				$this->setIsDeleted($value);
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
		$keys = DeliveryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAcceptCurrenciesCodes($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNameClassService($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNameClassFormParams($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIcon($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setParams($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsActive($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsDeleted($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DeliveryPeer::DATABASE_NAME);

		if ($this->isColumnModified(DeliveryPeer::ID)) $criteria->add(DeliveryPeer::ID, $this->id);
		if ($this->isColumnModified(DeliveryPeer::ACCEPT_CURRENCIES_CODES)) $criteria->add(DeliveryPeer::ACCEPT_CURRENCIES_CODES, $this->accept_currencies_codes);
		if ($this->isColumnModified(DeliveryPeer::NAME_CLASS_SERVICE)) $criteria->add(DeliveryPeer::NAME_CLASS_SERVICE, $this->name_class_service);
		if ($this->isColumnModified(DeliveryPeer::NAME_CLASS_FORM_PARAMS)) $criteria->add(DeliveryPeer::NAME_CLASS_FORM_PARAMS, $this->name_class_form_params);
		if ($this->isColumnModified(DeliveryPeer::ICON)) $criteria->add(DeliveryPeer::ICON, $this->icon);
		if ($this->isColumnModified(DeliveryPeer::PARAMS)) $criteria->add(DeliveryPeer::PARAMS, $this->params);
		if ($this->isColumnModified(DeliveryPeer::IS_ACTIVE)) $criteria->add(DeliveryPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(DeliveryPeer::IS_DELETED)) $criteria->add(DeliveryPeer::IS_DELETED, $this->is_deleted);
		if ($this->isColumnModified(DeliveryPeer::CREATED_AT)) $criteria->add(DeliveryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DeliveryPeer::UPDATED_AT)) $criteria->add(DeliveryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DeliveryPeer::DATABASE_NAME);

		$criteria->add(DeliveryPeer::ID, $this->id);

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

		$copyObj->setAcceptCurrenciesCodes($this->accept_currencies_codes);

		$copyObj->setNameClassService($this->name_class_service);

		$copyObj->setNameClassFormParams($this->name_class_form_params);

		$copyObj->setIcon($this->icon);

		$copyObj->setParams($this->params);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsDeleted($this->is_deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDeliveryI18ns() as $relObj) {
				$copyObj->addDeliveryI18n($relObj->copy($deepCopy));
			}

			foreach($this->getOrderItems() as $relObj) {
				$copyObj->addOrderItem($relObj->copy($deepCopy));
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
			self::$peer = new DeliveryPeer();
		}
		return self::$peer;
	}

	
	public function initDeliveryI18ns()
	{
		if ($this->collDeliveryI18ns === null) {
			$this->collDeliveryI18ns = array();
		}
	}

	
	public function getDeliveryI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDeliveryI18ns === null) {
			if ($this->isNew()) {
			   $this->collDeliveryI18ns = array();
			} else {

				$criteria->add(DeliveryI18nPeer::ID, $this->getId());

				DeliveryI18nPeer::addSelectColumns($criteria);
				$this->collDeliveryI18ns = DeliveryI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DeliveryI18nPeer::ID, $this->getId());

				DeliveryI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastDeliveryI18nCriteria) || !$this->lastDeliveryI18nCriteria->equals($criteria)) {
					$this->collDeliveryI18ns = DeliveryI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDeliveryI18nCriteria = $criteria;
		return $this->collDeliveryI18ns;
	}

	
	public function countDeliveryI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DeliveryI18nPeer::ID, $this->getId());

		return DeliveryI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDeliveryI18n(DeliveryI18n $l)
	{
		$this->collDeliveryI18ns[] = $l;
		$l->setDelivery($this);
	}

	
	public function initOrderItems()
	{
		if ($this->collOrderItems === null) {
			$this->collOrderItems = array();
		}
	}

	
	public function getOrderItems($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItems === null) {
			if ($this->isNew()) {
			   $this->collOrderItems = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItems = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
					$this->collOrderItems = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemCriteria = $criteria;
		return $this->collOrderItems;
	}

	
	public function countOrderItems($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

		return OrderItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderItem(OrderItem $l)
	{
		$this->collOrderItems[] = $l;
		$l->setDelivery($this);
	}


	
	public function getOrderItemsJoinMember($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItems === null) {
			if ($this->isNew()) {
				$this->collOrderItems = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
	}


	
	public function getOrderItemsJoinCountryRelatedByMemberCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItems === null) {
			if ($this->isNew()) {
				$this->collOrderItems = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
	}


	
	public function getOrderItemsJoinStateRelatedByMemberStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItems === null) {
			if ($this->isNew()) {
				$this->collOrderItems = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
	}


	
	public function getOrderItemsJoinCountryRelatedByBillingCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItems === null) {
			if ($this->isNew()) {
				$this->collOrderItems = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
	}


	
	public function getOrderItemsJoinStateRelatedByBillingStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItems === null) {
			if ($this->isNew()) {
				$this->collOrderItems = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
	}


	
	public function getOrderItemsJoinCountryRelatedByDeliveryCountryId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItems === null) {
			if ($this->isNew()) {
				$this->collOrderItems = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
	}


	
	public function getOrderItemsJoinStateRelatedByDeliveryStateId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItems === null) {
			if ($this->isNew()) {
				$this->collOrderItems = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
	}


	
	public function getOrderItemsJoinOrderStatus($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItems === null) {
			if ($this->isNew()) {
				$this->collOrderItems = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
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
    return $this->getCurrentDeliveryI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentDeliveryI18n($culture)->setTitle($value);
  }

  public function getDescription($culture = null)
  {
    return $this->getCurrentDeliveryI18n($culture)->getDescription();
  }

  public function setDescription($value, $culture = null)
  {
    $this->getCurrentDeliveryI18n($culture)->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentDeliveryI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = DeliveryI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setDeliveryI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setDeliveryI18nForCulture(new DeliveryI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setDeliveryI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addDeliveryI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDelivery:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDelivery::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 