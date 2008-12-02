<?php


abstract class BaseOrderItem extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $uuid;


	
	protected $delivery_id;


	
	protected $delivery_method_title;


	
	protected $delivery_description;


	
	protected $delivery_price = 0;


	
	protected $member_id;


	
	protected $member_first_name;


	
	protected $member_last_name;


	
	protected $member_country_id;


	
	protected $member_state_id;


	
	protected $member_state_title;


	
	protected $member_city;


	
	protected $member_street;


	
	protected $member_postcode;


	
	protected $billing_first_name;


	
	protected $billing_last_name;


	
	protected $billing_country_id;


	
	protected $billing_state_id;


	
	protected $billing_state_title;


	
	protected $billing_city;


	
	protected $billing_street;


	
	protected $billing_postcode;


	
	protected $delivery_first_name;


	
	protected $delivery_last_name;


	
	protected $delivery_country_id;


	
	protected $delivery_state_id;


	
	protected $delivery_state_title;


	
	protected $delivery_city;


	
	protected $delivery_street;


	
	protected $delivery_postcode;


	
	protected $comment;


	
	protected $status_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDelivery;

	
	protected $aMember;

	
	protected $aCountryRelatedByMemberCountryId;

	
	protected $aStateRelatedByMemberStateId;

	
	protected $aCountryRelatedByBillingCountryId;

	
	protected $aStateRelatedByBillingStateId;

	
	protected $aCountryRelatedByDeliveryCountryId;

	
	protected $aStateRelatedByDeliveryStateId;

	
	protected $aOrderStatus;

	
	protected $collOrderProducts;

	
	protected $lastOrderProductCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUuid()
	{

		return $this->uuid;
	}

	
	public function getDeliveryId()
	{

		return $this->delivery_id;
	}

	
	public function getDeliveryMethodTitle()
	{

		return $this->delivery_method_title;
	}

	
	public function getDeliveryDescription()
	{

		return $this->delivery_description;
	}

	
	public function getDeliveryPrice()
	{

		return $this->delivery_price;
	}

	
	public function getMemberId()
	{

		return $this->member_id;
	}

	
	public function getMemberFirstName()
	{

		return $this->member_first_name;
	}

	
	public function getMemberLastName()
	{

		return $this->member_last_name;
	}

	
	public function getMemberCountryId()
	{

		return $this->member_country_id;
	}

	
	public function getMemberStateId()
	{

		return $this->member_state_id;
	}

	
	public function getMemberStateTitle()
	{

		return $this->member_state_title;
	}

	
	public function getMemberCity()
	{

		return $this->member_city;
	}

	
	public function getMemberStreet()
	{

		return $this->member_street;
	}

	
	public function getMemberPostcode()
	{

		return $this->member_postcode;
	}

	
	public function getBillingFirstName()
	{

		return $this->billing_first_name;
	}

	
	public function getBillingLastName()
	{

		return $this->billing_last_name;
	}

	
	public function getBillingCountryId()
	{

		return $this->billing_country_id;
	}

	
	public function getBillingStateId()
	{

		return $this->billing_state_id;
	}

	
	public function getBillingStateTitle()
	{

		return $this->billing_state_title;
	}

	
	public function getBillingCity()
	{

		return $this->billing_city;
	}

	
	public function getBillingStreet()
	{

		return $this->billing_street;
	}

	
	public function getBillingPostcode()
	{

		return $this->billing_postcode;
	}

	
	public function getDeliveryFirstName()
	{

		return $this->delivery_first_name;
	}

	
	public function getDeliveryLastName()
	{

		return $this->delivery_last_name;
	}

	
	public function getDeliveryCountryId()
	{

		return $this->delivery_country_id;
	}

	
	public function getDeliveryStateId()
	{

		return $this->delivery_state_id;
	}

	
	public function getDeliveryStateTitle()
	{

		return $this->delivery_state_title;
	}

	
	public function getDeliveryCity()
	{

		return $this->delivery_city;
	}

	
	public function getDeliveryStreet()
	{

		return $this->delivery_street;
	}

	
	public function getDeliveryPostcode()
	{

		return $this->delivery_postcode;
	}

	
	public function getComment()
	{

		return $this->comment;
	}

	
	public function getStatusId()
	{

		return $this->status_id;
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
			$this->modifiedColumns[] = OrderItemPeer::ID;
		}

	} 
	
	public function setUuid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uuid !== $v) {
			$this->uuid = $v;
			$this->modifiedColumns[] = OrderItemPeer::UUID;
		}

	} 
	
	public function setDeliveryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->delivery_id !== $v) {
			$this->delivery_id = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_ID;
		}

		if ($this->aDelivery !== null && $this->aDelivery->getId() !== $v) {
			$this->aDelivery = null;
		}

	} 
	
	public function setDeliveryMethodTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_method_title !== $v) {
			$this->delivery_method_title = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_METHOD_TITLE;
		}

	} 
	
	public function setDeliveryDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_description !== $v) {
			$this->delivery_description = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_DESCRIPTION;
		}

	} 
	
	public function setDeliveryPrice($v)
	{

		if ($this->delivery_price !== $v || $v === 0) {
			$this->delivery_price = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_PRICE;
		}

	} 
	
	public function setMemberId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->member_id !== $v) {
			$this->member_id = $v;
			$this->modifiedColumns[] = OrderItemPeer::MEMBER_ID;
		}

		if ($this->aMember !== null && $this->aMember->getId() !== $v) {
			$this->aMember = null;
		}

	} 
	
	public function setMemberFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->member_first_name !== $v) {
			$this->member_first_name = $v;
			$this->modifiedColumns[] = OrderItemPeer::MEMBER_FIRST_NAME;
		}

	} 
	
	public function setMemberLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->member_last_name !== $v) {
			$this->member_last_name = $v;
			$this->modifiedColumns[] = OrderItemPeer::MEMBER_LAST_NAME;
		}

	} 
	
	public function setMemberCountryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->member_country_id !== $v) {
			$this->member_country_id = $v;
			$this->modifiedColumns[] = OrderItemPeer::MEMBER_COUNTRY_ID;
		}

		if ($this->aCountryRelatedByMemberCountryId !== null && $this->aCountryRelatedByMemberCountryId->getId() !== $v) {
			$this->aCountryRelatedByMemberCountryId = null;
		}

	} 
	
	public function setMemberStateId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->member_state_id !== $v) {
			$this->member_state_id = $v;
			$this->modifiedColumns[] = OrderItemPeer::MEMBER_STATE_ID;
		}

		if ($this->aStateRelatedByMemberStateId !== null && $this->aStateRelatedByMemberStateId->getId() !== $v) {
			$this->aStateRelatedByMemberStateId = null;
		}

	} 
	
	public function setMemberStateTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->member_state_title !== $v) {
			$this->member_state_title = $v;
			$this->modifiedColumns[] = OrderItemPeer::MEMBER_STATE_TITLE;
		}

	} 
	
	public function setMemberCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->member_city !== $v) {
			$this->member_city = $v;
			$this->modifiedColumns[] = OrderItemPeer::MEMBER_CITY;
		}

	} 
	
	public function setMemberStreet($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->member_street !== $v) {
			$this->member_street = $v;
			$this->modifiedColumns[] = OrderItemPeer::MEMBER_STREET;
		}

	} 
	
	public function setMemberPostcode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->member_postcode !== $v) {
			$this->member_postcode = $v;
			$this->modifiedColumns[] = OrderItemPeer::MEMBER_POSTCODE;
		}

	} 
	
	public function setBillingFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->billing_first_name !== $v) {
			$this->billing_first_name = $v;
			$this->modifiedColumns[] = OrderItemPeer::BILLING_FIRST_NAME;
		}

	} 
	
	public function setBillingLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->billing_last_name !== $v) {
			$this->billing_last_name = $v;
			$this->modifiedColumns[] = OrderItemPeer::BILLING_LAST_NAME;
		}

	} 
	
	public function setBillingCountryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->billing_country_id !== $v) {
			$this->billing_country_id = $v;
			$this->modifiedColumns[] = OrderItemPeer::BILLING_COUNTRY_ID;
		}

		if ($this->aCountryRelatedByBillingCountryId !== null && $this->aCountryRelatedByBillingCountryId->getId() !== $v) {
			$this->aCountryRelatedByBillingCountryId = null;
		}

	} 
	
	public function setBillingStateId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->billing_state_id !== $v) {
			$this->billing_state_id = $v;
			$this->modifiedColumns[] = OrderItemPeer::BILLING_STATE_ID;
		}

		if ($this->aStateRelatedByBillingStateId !== null && $this->aStateRelatedByBillingStateId->getId() !== $v) {
			$this->aStateRelatedByBillingStateId = null;
		}

	} 
	
	public function setBillingStateTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->billing_state_title !== $v) {
			$this->billing_state_title = $v;
			$this->modifiedColumns[] = OrderItemPeer::BILLING_STATE_TITLE;
		}

	} 
	
	public function setBillingCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->billing_city !== $v) {
			$this->billing_city = $v;
			$this->modifiedColumns[] = OrderItemPeer::BILLING_CITY;
		}

	} 
	
	public function setBillingStreet($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->billing_street !== $v) {
			$this->billing_street = $v;
			$this->modifiedColumns[] = OrderItemPeer::BILLING_STREET;
		}

	} 
	
	public function setBillingPostcode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->billing_postcode !== $v) {
			$this->billing_postcode = $v;
			$this->modifiedColumns[] = OrderItemPeer::BILLING_POSTCODE;
		}

	} 
	
	public function setDeliveryFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_first_name !== $v) {
			$this->delivery_first_name = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_FIRST_NAME;
		}

	} 
	
	public function setDeliveryLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_last_name !== $v) {
			$this->delivery_last_name = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_LAST_NAME;
		}

	} 
	
	public function setDeliveryCountryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->delivery_country_id !== $v) {
			$this->delivery_country_id = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_COUNTRY_ID;
		}

		if ($this->aCountryRelatedByDeliveryCountryId !== null && $this->aCountryRelatedByDeliveryCountryId->getId() !== $v) {
			$this->aCountryRelatedByDeliveryCountryId = null;
		}

	} 
	
	public function setDeliveryStateId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->delivery_state_id !== $v) {
			$this->delivery_state_id = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_STATE_ID;
		}

		if ($this->aStateRelatedByDeliveryStateId !== null && $this->aStateRelatedByDeliveryStateId->getId() !== $v) {
			$this->aStateRelatedByDeliveryStateId = null;
		}

	} 
	
	public function setDeliveryStateTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_state_title !== $v) {
			$this->delivery_state_title = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_STATE_TITLE;
		}

	} 
	
	public function setDeliveryCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_city !== $v) {
			$this->delivery_city = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_CITY;
		}

	} 
	
	public function setDeliveryStreet($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_street !== $v) {
			$this->delivery_street = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_STREET;
		}

	} 
	
	public function setDeliveryPostcode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->delivery_postcode !== $v) {
			$this->delivery_postcode = $v;
			$this->modifiedColumns[] = OrderItemPeer::DELIVERY_POSTCODE;
		}

	} 
	
	public function setComment($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = OrderItemPeer::COMMENT;
		}

	} 
	
	public function setStatusId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = OrderItemPeer::STATUS_ID;
		}

		if ($this->aOrderStatus !== null && $this->aOrderStatus->getId() !== $v) {
			$this->aOrderStatus = null;
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
			$this->modifiedColumns[] = OrderItemPeer::CREATED_AT;
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
			$this->modifiedColumns[] = OrderItemPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->uuid = $rs->getString($startcol + 1);

			$this->delivery_id = $rs->getInt($startcol + 2);

			$this->delivery_method_title = $rs->getString($startcol + 3);

			$this->delivery_description = $rs->getString($startcol + 4);

			$this->delivery_price = $rs->getFloat($startcol + 5);

			$this->member_id = $rs->getInt($startcol + 6);

			$this->member_first_name = $rs->getString($startcol + 7);

			$this->member_last_name = $rs->getString($startcol + 8);

			$this->member_country_id = $rs->getInt($startcol + 9);

			$this->member_state_id = $rs->getInt($startcol + 10);

			$this->member_state_title = $rs->getString($startcol + 11);

			$this->member_city = $rs->getString($startcol + 12);

			$this->member_street = $rs->getString($startcol + 13);

			$this->member_postcode = $rs->getString($startcol + 14);

			$this->billing_first_name = $rs->getString($startcol + 15);

			$this->billing_last_name = $rs->getString($startcol + 16);

			$this->billing_country_id = $rs->getInt($startcol + 17);

			$this->billing_state_id = $rs->getInt($startcol + 18);

			$this->billing_state_title = $rs->getString($startcol + 19);

			$this->billing_city = $rs->getString($startcol + 20);

			$this->billing_street = $rs->getString($startcol + 21);

			$this->billing_postcode = $rs->getString($startcol + 22);

			$this->delivery_first_name = $rs->getString($startcol + 23);

			$this->delivery_last_name = $rs->getString($startcol + 24);

			$this->delivery_country_id = $rs->getInt($startcol + 25);

			$this->delivery_state_id = $rs->getInt($startcol + 26);

			$this->delivery_state_title = $rs->getString($startcol + 27);

			$this->delivery_city = $rs->getString($startcol + 28);

			$this->delivery_street = $rs->getString($startcol + 29);

			$this->delivery_postcode = $rs->getString($startcol + 30);

			$this->comment = $rs->getString($startcol + 31);

			$this->status_id = $rs->getInt($startcol + 32);

			$this->created_at = $rs->getTimestamp($startcol + 33, null);

			$this->updated_at = $rs->getTimestamp($startcol + 34, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 35; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OrderItem object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItem:delete:pre') as $callable)
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
			$con = Propel::getConnection(OrderItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OrderItemPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseOrderItem:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItem:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(OrderItemPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OrderItemPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrderItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseOrderItem:save:post') as $callable)
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


												
			if ($this->aDelivery !== null) {
				if ($this->aDelivery->isModified() || ($this->aDelivery->getCulture() && $this->aDelivery->getCurrentDeliveryI18n()->isModified())) {
					$affectedRows += $this->aDelivery->save($con);
				}
				$this->setDelivery($this->aDelivery);
			}

			if ($this->aMember !== null) {
				if ($this->aMember->isModified()) {
					$affectedRows += $this->aMember->save($con);
				}
				$this->setMember($this->aMember);
			}

			if ($this->aCountryRelatedByMemberCountryId !== null) {
				if ($this->aCountryRelatedByMemberCountryId->isModified() || ($this->aCountryRelatedByMemberCountryId->getCulture() && $this->aCountryRelatedByMemberCountryId->getCurrentCountryI18n()->isModified())) {
					$affectedRows += $this->aCountryRelatedByMemberCountryId->save($con);
				}
				$this->setCountryRelatedByMemberCountryId($this->aCountryRelatedByMemberCountryId);
			}

			if ($this->aStateRelatedByMemberStateId !== null) {
				if ($this->aStateRelatedByMemberStateId->isModified() || ($this->aStateRelatedByMemberStateId->getCulture() && $this->aStateRelatedByMemberStateId->getCurrentStateI18n()->isModified())) {
					$affectedRows += $this->aStateRelatedByMemberStateId->save($con);
				}
				$this->setStateRelatedByMemberStateId($this->aStateRelatedByMemberStateId);
			}

			if ($this->aCountryRelatedByBillingCountryId !== null) {
				if ($this->aCountryRelatedByBillingCountryId->isModified() || ($this->aCountryRelatedByBillingCountryId->getCulture() && $this->aCountryRelatedByBillingCountryId->getCurrentCountryI18n()->isModified())) {
					$affectedRows += $this->aCountryRelatedByBillingCountryId->save($con);
				}
				$this->setCountryRelatedByBillingCountryId($this->aCountryRelatedByBillingCountryId);
			}

			if ($this->aStateRelatedByBillingStateId !== null) {
				if ($this->aStateRelatedByBillingStateId->isModified() || ($this->aStateRelatedByBillingStateId->getCulture() && $this->aStateRelatedByBillingStateId->getCurrentStateI18n()->isModified())) {
					$affectedRows += $this->aStateRelatedByBillingStateId->save($con);
				}
				$this->setStateRelatedByBillingStateId($this->aStateRelatedByBillingStateId);
			}

			if ($this->aCountryRelatedByDeliveryCountryId !== null) {
				if ($this->aCountryRelatedByDeliveryCountryId->isModified() || ($this->aCountryRelatedByDeliveryCountryId->getCulture() && $this->aCountryRelatedByDeliveryCountryId->getCurrentCountryI18n()->isModified())) {
					$affectedRows += $this->aCountryRelatedByDeliveryCountryId->save($con);
				}
				$this->setCountryRelatedByDeliveryCountryId($this->aCountryRelatedByDeliveryCountryId);
			}

			if ($this->aStateRelatedByDeliveryStateId !== null) {
				if ($this->aStateRelatedByDeliveryStateId->isModified() || ($this->aStateRelatedByDeliveryStateId->getCulture() && $this->aStateRelatedByDeliveryStateId->getCurrentStateI18n()->isModified())) {
					$affectedRows += $this->aStateRelatedByDeliveryStateId->save($con);
				}
				$this->setStateRelatedByDeliveryStateId($this->aStateRelatedByDeliveryStateId);
			}

			if ($this->aOrderStatus !== null) {
				if ($this->aOrderStatus->isModified() || ($this->aOrderStatus->getCulture() && $this->aOrderStatus->getCurrentOrderStatusI18n()->isModified())) {
					$affectedRows += $this->aOrderStatus->save($con);
				}
				$this->setOrderStatus($this->aOrderStatus);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OrderItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OrderItemPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOrderProducts !== null) {
				foreach($this->collOrderProducts as $referrerFK) {
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


												
			if ($this->aDelivery !== null) {
				if (!$this->aDelivery->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDelivery->getValidationFailures());
				}
			}

			if ($this->aMember !== null) {
				if (!$this->aMember->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMember->getValidationFailures());
				}
			}

			if ($this->aCountryRelatedByMemberCountryId !== null) {
				if (!$this->aCountryRelatedByMemberCountryId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCountryRelatedByMemberCountryId->getValidationFailures());
				}
			}

			if ($this->aStateRelatedByMemberStateId !== null) {
				if (!$this->aStateRelatedByMemberStateId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStateRelatedByMemberStateId->getValidationFailures());
				}
			}

			if ($this->aCountryRelatedByBillingCountryId !== null) {
				if (!$this->aCountryRelatedByBillingCountryId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCountryRelatedByBillingCountryId->getValidationFailures());
				}
			}

			if ($this->aStateRelatedByBillingStateId !== null) {
				if (!$this->aStateRelatedByBillingStateId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStateRelatedByBillingStateId->getValidationFailures());
				}
			}

			if ($this->aCountryRelatedByDeliveryCountryId !== null) {
				if (!$this->aCountryRelatedByDeliveryCountryId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCountryRelatedByDeliveryCountryId->getValidationFailures());
				}
			}

			if ($this->aStateRelatedByDeliveryStateId !== null) {
				if (!$this->aStateRelatedByDeliveryStateId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStateRelatedByDeliveryStateId->getValidationFailures());
				}
			}

			if ($this->aOrderStatus !== null) {
				if (!$this->aOrderStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOrderStatus->getValidationFailures());
				}
			}


			if (($retval = OrderItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOrderProducts !== null) {
					foreach($this->collOrderProducts as $referrerFK) {
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
		$pos = OrderItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUuid();
				break;
			case 2:
				return $this->getDeliveryId();
				break;
			case 3:
				return $this->getDeliveryMethodTitle();
				break;
			case 4:
				return $this->getDeliveryDescription();
				break;
			case 5:
				return $this->getDeliveryPrice();
				break;
			case 6:
				return $this->getMemberId();
				break;
			case 7:
				return $this->getMemberFirstName();
				break;
			case 8:
				return $this->getMemberLastName();
				break;
			case 9:
				return $this->getMemberCountryId();
				break;
			case 10:
				return $this->getMemberStateId();
				break;
			case 11:
				return $this->getMemberStateTitle();
				break;
			case 12:
				return $this->getMemberCity();
				break;
			case 13:
				return $this->getMemberStreet();
				break;
			case 14:
				return $this->getMemberPostcode();
				break;
			case 15:
				return $this->getBillingFirstName();
				break;
			case 16:
				return $this->getBillingLastName();
				break;
			case 17:
				return $this->getBillingCountryId();
				break;
			case 18:
				return $this->getBillingStateId();
				break;
			case 19:
				return $this->getBillingStateTitle();
				break;
			case 20:
				return $this->getBillingCity();
				break;
			case 21:
				return $this->getBillingStreet();
				break;
			case 22:
				return $this->getBillingPostcode();
				break;
			case 23:
				return $this->getDeliveryFirstName();
				break;
			case 24:
				return $this->getDeliveryLastName();
				break;
			case 25:
				return $this->getDeliveryCountryId();
				break;
			case 26:
				return $this->getDeliveryStateId();
				break;
			case 27:
				return $this->getDeliveryStateTitle();
				break;
			case 28:
				return $this->getDeliveryCity();
				break;
			case 29:
				return $this->getDeliveryStreet();
				break;
			case 30:
				return $this->getDeliveryPostcode();
				break;
			case 31:
				return $this->getComment();
				break;
			case 32:
				return $this->getStatusId();
				break;
			case 33:
				return $this->getCreatedAt();
				break;
			case 34:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrderItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUuid(),
			$keys[2] => $this->getDeliveryId(),
			$keys[3] => $this->getDeliveryMethodTitle(),
			$keys[4] => $this->getDeliveryDescription(),
			$keys[5] => $this->getDeliveryPrice(),
			$keys[6] => $this->getMemberId(),
			$keys[7] => $this->getMemberFirstName(),
			$keys[8] => $this->getMemberLastName(),
			$keys[9] => $this->getMemberCountryId(),
			$keys[10] => $this->getMemberStateId(),
			$keys[11] => $this->getMemberStateTitle(),
			$keys[12] => $this->getMemberCity(),
			$keys[13] => $this->getMemberStreet(),
			$keys[14] => $this->getMemberPostcode(),
			$keys[15] => $this->getBillingFirstName(),
			$keys[16] => $this->getBillingLastName(),
			$keys[17] => $this->getBillingCountryId(),
			$keys[18] => $this->getBillingStateId(),
			$keys[19] => $this->getBillingStateTitle(),
			$keys[20] => $this->getBillingCity(),
			$keys[21] => $this->getBillingStreet(),
			$keys[22] => $this->getBillingPostcode(),
			$keys[23] => $this->getDeliveryFirstName(),
			$keys[24] => $this->getDeliveryLastName(),
			$keys[25] => $this->getDeliveryCountryId(),
			$keys[26] => $this->getDeliveryStateId(),
			$keys[27] => $this->getDeliveryStateTitle(),
			$keys[28] => $this->getDeliveryCity(),
			$keys[29] => $this->getDeliveryStreet(),
			$keys[30] => $this->getDeliveryPostcode(),
			$keys[31] => $this->getComment(),
			$keys[32] => $this->getStatusId(),
			$keys[33] => $this->getCreatedAt(),
			$keys[34] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrderItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUuid($value);
				break;
			case 2:
				$this->setDeliveryId($value);
				break;
			case 3:
				$this->setDeliveryMethodTitle($value);
				break;
			case 4:
				$this->setDeliveryDescription($value);
				break;
			case 5:
				$this->setDeliveryPrice($value);
				break;
			case 6:
				$this->setMemberId($value);
				break;
			case 7:
				$this->setMemberFirstName($value);
				break;
			case 8:
				$this->setMemberLastName($value);
				break;
			case 9:
				$this->setMemberCountryId($value);
				break;
			case 10:
				$this->setMemberStateId($value);
				break;
			case 11:
				$this->setMemberStateTitle($value);
				break;
			case 12:
				$this->setMemberCity($value);
				break;
			case 13:
				$this->setMemberStreet($value);
				break;
			case 14:
				$this->setMemberPostcode($value);
				break;
			case 15:
				$this->setBillingFirstName($value);
				break;
			case 16:
				$this->setBillingLastName($value);
				break;
			case 17:
				$this->setBillingCountryId($value);
				break;
			case 18:
				$this->setBillingStateId($value);
				break;
			case 19:
				$this->setBillingStateTitle($value);
				break;
			case 20:
				$this->setBillingCity($value);
				break;
			case 21:
				$this->setBillingStreet($value);
				break;
			case 22:
				$this->setBillingPostcode($value);
				break;
			case 23:
				$this->setDeliveryFirstName($value);
				break;
			case 24:
				$this->setDeliveryLastName($value);
				break;
			case 25:
				$this->setDeliveryCountryId($value);
				break;
			case 26:
				$this->setDeliveryStateId($value);
				break;
			case 27:
				$this->setDeliveryStateTitle($value);
				break;
			case 28:
				$this->setDeliveryCity($value);
				break;
			case 29:
				$this->setDeliveryStreet($value);
				break;
			case 30:
				$this->setDeliveryPostcode($value);
				break;
			case 31:
				$this->setComment($value);
				break;
			case 32:
				$this->setStatusId($value);
				break;
			case 33:
				$this->setCreatedAt($value);
				break;
			case 34:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrderItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUuid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDeliveryId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeliveryMethodTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDeliveryDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeliveryPrice($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMemberId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMemberFirstName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMemberLastName($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setMemberCountryId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setMemberStateId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setMemberStateTitle($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setMemberCity($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setMemberStreet($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setMemberPostcode($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setBillingFirstName($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setBillingLastName($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setBillingCountryId($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setBillingStateId($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setBillingStateTitle($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setBillingCity($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setBillingStreet($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setBillingPostcode($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setDeliveryFirstName($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setDeliveryLastName($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setDeliveryCountryId($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setDeliveryStateId($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setDeliveryStateTitle($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setDeliveryCity($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setDeliveryStreet($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setDeliveryPostcode($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setComment($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setStatusId($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setCreatedAt($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setUpdatedAt($arr[$keys[34]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OrderItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(OrderItemPeer::ID)) $criteria->add(OrderItemPeer::ID, $this->id);
		if ($this->isColumnModified(OrderItemPeer::UUID)) $criteria->add(OrderItemPeer::UUID, $this->uuid);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_ID)) $criteria->add(OrderItemPeer::DELIVERY_ID, $this->delivery_id);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_METHOD_TITLE)) $criteria->add(OrderItemPeer::DELIVERY_METHOD_TITLE, $this->delivery_method_title);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_DESCRIPTION)) $criteria->add(OrderItemPeer::DELIVERY_DESCRIPTION, $this->delivery_description);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_PRICE)) $criteria->add(OrderItemPeer::DELIVERY_PRICE, $this->delivery_price);
		if ($this->isColumnModified(OrderItemPeer::MEMBER_ID)) $criteria->add(OrderItemPeer::MEMBER_ID, $this->member_id);
		if ($this->isColumnModified(OrderItemPeer::MEMBER_FIRST_NAME)) $criteria->add(OrderItemPeer::MEMBER_FIRST_NAME, $this->member_first_name);
		if ($this->isColumnModified(OrderItemPeer::MEMBER_LAST_NAME)) $criteria->add(OrderItemPeer::MEMBER_LAST_NAME, $this->member_last_name);
		if ($this->isColumnModified(OrderItemPeer::MEMBER_COUNTRY_ID)) $criteria->add(OrderItemPeer::MEMBER_COUNTRY_ID, $this->member_country_id);
		if ($this->isColumnModified(OrderItemPeer::MEMBER_STATE_ID)) $criteria->add(OrderItemPeer::MEMBER_STATE_ID, $this->member_state_id);
		if ($this->isColumnModified(OrderItemPeer::MEMBER_STATE_TITLE)) $criteria->add(OrderItemPeer::MEMBER_STATE_TITLE, $this->member_state_title);
		if ($this->isColumnModified(OrderItemPeer::MEMBER_CITY)) $criteria->add(OrderItemPeer::MEMBER_CITY, $this->member_city);
		if ($this->isColumnModified(OrderItemPeer::MEMBER_STREET)) $criteria->add(OrderItemPeer::MEMBER_STREET, $this->member_street);
		if ($this->isColumnModified(OrderItemPeer::MEMBER_POSTCODE)) $criteria->add(OrderItemPeer::MEMBER_POSTCODE, $this->member_postcode);
		if ($this->isColumnModified(OrderItemPeer::BILLING_FIRST_NAME)) $criteria->add(OrderItemPeer::BILLING_FIRST_NAME, $this->billing_first_name);
		if ($this->isColumnModified(OrderItemPeer::BILLING_LAST_NAME)) $criteria->add(OrderItemPeer::BILLING_LAST_NAME, $this->billing_last_name);
		if ($this->isColumnModified(OrderItemPeer::BILLING_COUNTRY_ID)) $criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->billing_country_id);
		if ($this->isColumnModified(OrderItemPeer::BILLING_STATE_ID)) $criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->billing_state_id);
		if ($this->isColumnModified(OrderItemPeer::BILLING_STATE_TITLE)) $criteria->add(OrderItemPeer::BILLING_STATE_TITLE, $this->billing_state_title);
		if ($this->isColumnModified(OrderItemPeer::BILLING_CITY)) $criteria->add(OrderItemPeer::BILLING_CITY, $this->billing_city);
		if ($this->isColumnModified(OrderItemPeer::BILLING_STREET)) $criteria->add(OrderItemPeer::BILLING_STREET, $this->billing_street);
		if ($this->isColumnModified(OrderItemPeer::BILLING_POSTCODE)) $criteria->add(OrderItemPeer::BILLING_POSTCODE, $this->billing_postcode);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_FIRST_NAME)) $criteria->add(OrderItemPeer::DELIVERY_FIRST_NAME, $this->delivery_first_name);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_LAST_NAME)) $criteria->add(OrderItemPeer::DELIVERY_LAST_NAME, $this->delivery_last_name);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_COUNTRY_ID)) $criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->delivery_country_id);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_STATE_ID)) $criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->delivery_state_id);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_STATE_TITLE)) $criteria->add(OrderItemPeer::DELIVERY_STATE_TITLE, $this->delivery_state_title);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_CITY)) $criteria->add(OrderItemPeer::DELIVERY_CITY, $this->delivery_city);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_STREET)) $criteria->add(OrderItemPeer::DELIVERY_STREET, $this->delivery_street);
		if ($this->isColumnModified(OrderItemPeer::DELIVERY_POSTCODE)) $criteria->add(OrderItemPeer::DELIVERY_POSTCODE, $this->delivery_postcode);
		if ($this->isColumnModified(OrderItemPeer::COMMENT)) $criteria->add(OrderItemPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(OrderItemPeer::STATUS_ID)) $criteria->add(OrderItemPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(OrderItemPeer::CREATED_AT)) $criteria->add(OrderItemPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OrderItemPeer::UPDATED_AT)) $criteria->add(OrderItemPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OrderItemPeer::DATABASE_NAME);

		$criteria->add(OrderItemPeer::ID, $this->id);

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

		$copyObj->setUuid($this->uuid);

		$copyObj->setDeliveryId($this->delivery_id);

		$copyObj->setDeliveryMethodTitle($this->delivery_method_title);

		$copyObj->setDeliveryDescription($this->delivery_description);

		$copyObj->setDeliveryPrice($this->delivery_price);

		$copyObj->setMemberId($this->member_id);

		$copyObj->setMemberFirstName($this->member_first_name);

		$copyObj->setMemberLastName($this->member_last_name);

		$copyObj->setMemberCountryId($this->member_country_id);

		$copyObj->setMemberStateId($this->member_state_id);

		$copyObj->setMemberStateTitle($this->member_state_title);

		$copyObj->setMemberCity($this->member_city);

		$copyObj->setMemberStreet($this->member_street);

		$copyObj->setMemberPostcode($this->member_postcode);

		$copyObj->setBillingFirstName($this->billing_first_name);

		$copyObj->setBillingLastName($this->billing_last_name);

		$copyObj->setBillingCountryId($this->billing_country_id);

		$copyObj->setBillingStateId($this->billing_state_id);

		$copyObj->setBillingStateTitle($this->billing_state_title);

		$copyObj->setBillingCity($this->billing_city);

		$copyObj->setBillingStreet($this->billing_street);

		$copyObj->setBillingPostcode($this->billing_postcode);

		$copyObj->setDeliveryFirstName($this->delivery_first_name);

		$copyObj->setDeliveryLastName($this->delivery_last_name);

		$copyObj->setDeliveryCountryId($this->delivery_country_id);

		$copyObj->setDeliveryStateId($this->delivery_state_id);

		$copyObj->setDeliveryStateTitle($this->delivery_state_title);

		$copyObj->setDeliveryCity($this->delivery_city);

		$copyObj->setDeliveryStreet($this->delivery_street);

		$copyObj->setDeliveryPostcode($this->delivery_postcode);

		$copyObj->setComment($this->comment);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOrderProducts() as $relObj) {
				$copyObj->addOrderProduct($relObj->copy($deepCopy));
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
			self::$peer = new OrderItemPeer();
		}
		return self::$peer;
	}

	
	public function setDelivery($v)
	{


		if ($v === null) {
			$this->setDeliveryId(NULL);
		} else {
			$this->setDeliveryId($v->getId());
		}


		$this->aDelivery = $v;
	}


	
	public function getDelivery($con = null)
	{
		if ($this->aDelivery === null && ($this->delivery_id !== null)) {
						$this->aDelivery = DeliveryPeer::retrieveByPK($this->delivery_id, $con);

			
		}
		return $this->aDelivery;
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

	
	public function setCountryRelatedByMemberCountryId($v)
	{


		if ($v === null) {
			$this->setMemberCountryId(NULL);
		} else {
			$this->setMemberCountryId($v->getId());
		}


		$this->aCountryRelatedByMemberCountryId = $v;
	}


	
	public function getCountryRelatedByMemberCountryId($con = null)
	{
		if ($this->aCountryRelatedByMemberCountryId === null && ($this->member_country_id !== null)) {
						$this->aCountryRelatedByMemberCountryId = CountryPeer::retrieveByPK($this->member_country_id, $con);

			
		}
		return $this->aCountryRelatedByMemberCountryId;
	}

	
	public function setStateRelatedByMemberStateId($v)
	{


		if ($v === null) {
			$this->setMemberStateId(NULL);
		} else {
			$this->setMemberStateId($v->getId());
		}


		$this->aStateRelatedByMemberStateId = $v;
	}


	
	public function getStateRelatedByMemberStateId($con = null)
	{
		if ($this->aStateRelatedByMemberStateId === null && ($this->member_state_id !== null)) {
						$this->aStateRelatedByMemberStateId = StatePeer::retrieveByPK($this->member_state_id, $con);

			
		}
		return $this->aStateRelatedByMemberStateId;
	}

	
	public function setCountryRelatedByBillingCountryId($v)
	{


		if ($v === null) {
			$this->setBillingCountryId(NULL);
		} else {
			$this->setBillingCountryId($v->getId());
		}


		$this->aCountryRelatedByBillingCountryId = $v;
	}


	
	public function getCountryRelatedByBillingCountryId($con = null)
	{
		if ($this->aCountryRelatedByBillingCountryId === null && ($this->billing_country_id !== null)) {
						$this->aCountryRelatedByBillingCountryId = CountryPeer::retrieveByPK($this->billing_country_id, $con);

			
		}
		return $this->aCountryRelatedByBillingCountryId;
	}

	
	public function setStateRelatedByBillingStateId($v)
	{


		if ($v === null) {
			$this->setBillingStateId(NULL);
		} else {
			$this->setBillingStateId($v->getId());
		}


		$this->aStateRelatedByBillingStateId = $v;
	}


	
	public function getStateRelatedByBillingStateId($con = null)
	{
		if ($this->aStateRelatedByBillingStateId === null && ($this->billing_state_id !== null)) {
						$this->aStateRelatedByBillingStateId = StatePeer::retrieveByPK($this->billing_state_id, $con);

			
		}
		return $this->aStateRelatedByBillingStateId;
	}

	
	public function setCountryRelatedByDeliveryCountryId($v)
	{


		if ($v === null) {
			$this->setDeliveryCountryId(NULL);
		} else {
			$this->setDeliveryCountryId($v->getId());
		}


		$this->aCountryRelatedByDeliveryCountryId = $v;
	}


	
	public function getCountryRelatedByDeliveryCountryId($con = null)
	{
		if ($this->aCountryRelatedByDeliveryCountryId === null && ($this->delivery_country_id !== null)) {
						$this->aCountryRelatedByDeliveryCountryId = CountryPeer::retrieveByPK($this->delivery_country_id, $con);

			
		}
		return $this->aCountryRelatedByDeliveryCountryId;
	}

	
	public function setStateRelatedByDeliveryStateId($v)
	{


		if ($v === null) {
			$this->setDeliveryStateId(NULL);
		} else {
			$this->setDeliveryStateId($v->getId());
		}


		$this->aStateRelatedByDeliveryStateId = $v;
	}


	
	public function getStateRelatedByDeliveryStateId($con = null)
	{
		if ($this->aStateRelatedByDeliveryStateId === null && ($this->delivery_state_id !== null)) {
						$this->aStateRelatedByDeliveryStateId = StatePeer::retrieveByPK($this->delivery_state_id, $con);

			
		}
		return $this->aStateRelatedByDeliveryStateId;
	}

	
	public function setOrderStatus($v)
	{


		if ($v === null) {
			$this->setStatusId(NULL);
		} else {
			$this->setStatusId($v->getId());
		}


		$this->aOrderStatus = $v;
	}


	
	public function getOrderStatus($con = null)
	{
		if ($this->aOrderStatus === null && ($this->status_id !== null)) {
						$this->aOrderStatus = OrderStatusPeer::retrieveByPK($this->status_id, $con);

			
		}
		return $this->aOrderStatus;
	}

	
	public function initOrderProducts()
	{
		if ($this->collOrderProducts === null) {
			$this->collOrderProducts = array();
		}
	}

	
	public function getOrderProducts($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderProducts === null) {
			if ($this->isNew()) {
			   $this->collOrderProducts = array();
			} else {

				$criteria->add(OrderProductPeer::ORDER_ITEM_ID, $this->getId());

				OrderProductPeer::addSelectColumns($criteria);
				$this->collOrderProducts = OrderProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderProductPeer::ORDER_ITEM_ID, $this->getId());

				OrderProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderProductCriteria) || !$this->lastOrderProductCriteria->equals($criteria)) {
					$this->collOrderProducts = OrderProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderProductCriteria = $criteria;
		return $this->collOrderProducts;
	}

	
	public function countOrderProducts($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderProductPeer::ORDER_ITEM_ID, $this->getId());

		return OrderProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderProduct(OrderProduct $l)
	{
		$this->collOrderProducts[] = $l;
		$l->setOrderItem($this);
	}


	
	public function getOrderProductsJoinProduct($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderProducts === null) {
			if ($this->isNew()) {
				$this->collOrderProducts = array();
			} else {

				$criteria->add(OrderProductPeer::ORDER_ITEM_ID, $this->getId());

				$this->collOrderProducts = OrderProductPeer::doSelectJoinProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderProductPeer::ORDER_ITEM_ID, $this->getId());

			if (!isset($this->lastOrderProductCriteria) || !$this->lastOrderProductCriteria->equals($criteria)) {
				$this->collOrderProducts = OrderProductPeer::doSelectJoinProduct($criteria, $con);
			}
		}
		$this->lastOrderProductCriteria = $criteria;

		return $this->collOrderProducts;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseOrderItem:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseOrderItem::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 