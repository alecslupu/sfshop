<?php


abstract class BaseOrderStatus extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $is_active = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collOrderItems;

	
	protected $lastOrderItemCriteria = null;

	
	protected $collOrderStatusI18ns;

	
	protected $lastOrderStatusI18nCriteria = null;

	
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
			$this->modifiedColumns[] = OrderStatusPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = OrderStatusPeer::NAME;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = OrderStatusPeer::IS_ACTIVE;
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
			$this->modifiedColumns[] = OrderStatusPeer::CREATED_AT;
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
			$this->modifiedColumns[] = OrderStatusPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->is_active = $rs->getBoolean($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OrderStatus object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderStatus:delete:pre') as $callable)
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
			$con = Propel::getConnection(OrderStatusPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OrderStatusPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseOrderStatus:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderStatus:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(OrderStatusPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OrderStatusPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrderStatusPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseOrderStatus:save:post') as $callable)
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
					$pk = OrderStatusPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OrderStatusPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOrderItems !== null) {
				foreach($this->collOrderItems as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderStatusI18ns !== null) {
				foreach($this->collOrderStatusI18ns as $referrerFK) {
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


			if (($retval = OrderStatusPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOrderItems !== null) {
					foreach($this->collOrderItems as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderStatusI18ns !== null) {
					foreach($this->collOrderStatusI18ns as $referrerFK) {
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
		$pos = OrderStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIsActive();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrderStatusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getIsActive(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrderStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIsActive($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrderStatusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsActive($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OrderStatusPeer::DATABASE_NAME);

		if ($this->isColumnModified(OrderStatusPeer::ID)) $criteria->add(OrderStatusPeer::ID, $this->id);
		if ($this->isColumnModified(OrderStatusPeer::NAME)) $criteria->add(OrderStatusPeer::NAME, $this->name);
		if ($this->isColumnModified(OrderStatusPeer::IS_ACTIVE)) $criteria->add(OrderStatusPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(OrderStatusPeer::CREATED_AT)) $criteria->add(OrderStatusPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OrderStatusPeer::UPDATED_AT)) $criteria->add(OrderStatusPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OrderStatusPeer::DATABASE_NAME);

		$criteria->add(OrderStatusPeer::ID, $this->id);

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

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOrderItems() as $relObj) {
				$copyObj->addOrderItem($relObj->copy($deepCopy));
			}

			foreach($this->getOrderStatusI18ns() as $relObj) {
				$copyObj->addOrderStatusI18n($relObj->copy($deepCopy));
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
			self::$peer = new OrderStatusPeer();
		}
		return self::$peer;
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

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItems = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

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

		$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

		return OrderItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderItem(OrderItem $l)
	{
		$this->collOrderItems[] = $l;
		$l->setOrderStatus($this);
	}


	
	public function getOrderItemsJoinDelivery($criteria = null, $con = null)
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

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
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

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinMember($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
	}

	
	public function initOrderStatusI18ns()
	{
		if ($this->collOrderStatusI18ns === null) {
			$this->collOrderStatusI18ns = array();
		}
	}

	
	public function getOrderStatusI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderStatusI18ns === null) {
			if ($this->isNew()) {
			   $this->collOrderStatusI18ns = array();
			} else {

				$criteria->add(OrderStatusI18nPeer::ID, $this->getId());

				OrderStatusI18nPeer::addSelectColumns($criteria);
				$this->collOrderStatusI18ns = OrderStatusI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderStatusI18nPeer::ID, $this->getId());

				OrderStatusI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderStatusI18nCriteria) || !$this->lastOrderStatusI18nCriteria->equals($criteria)) {
					$this->collOrderStatusI18ns = OrderStatusI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderStatusI18nCriteria = $criteria;
		return $this->collOrderStatusI18ns;
	}

	
	public function countOrderStatusI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderStatusI18nPeer::ID, $this->getId());

		return OrderStatusI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderStatusI18n(OrderStatusI18n $l)
	{
		$this->collOrderStatusI18ns[] = $l;
		$l->setOrderStatus($this);
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
    return $this->getCurrentOrderStatusI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentOrderStatusI18n($culture)->setTitle($value);
  }

  protected $current_i18n = array();

  public function getCurrentOrderStatusI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = OrderStatusI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setOrderStatusI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setOrderStatusI18nForCulture(new OrderStatusI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setOrderStatusI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addOrderStatusI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseOrderStatus:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseOrderStatus::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 