<?php


abstract class BaseAddressBook extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $member_id;


	
	protected $gender;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $company;


	
	protected $country_id;


	
	protected $state_id;


	
	protected $state_title;


	
	protected $city;


	
	protected $street;


	
	protected $postcode;


	
	protected $is_default = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aMember;

	
	protected $aCountry;

	
	protected $aState;

	
	protected $collMembers;

	
	protected $lastMemberCriteria = null;

	
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

	
	public function getGender()
	{

		return $this->gender;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getCompany()
	{

		return $this->company;
	}

	
	public function getCountryId()
	{

		return $this->country_id;
	}

	
	public function getStateId()
	{

		return $this->state_id;
	}

	
	public function getStateTitle()
	{

		return $this->state_title;
	}

	
	public function getCity()
	{

		return $this->city;
	}

	
	public function getStreet()
	{

		return $this->street;
	}

	
	public function getPostcode()
	{

		return $this->postcode;
	}

	
	public function getIsDefault()
	{

		return $this->is_default;
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
			$this->modifiedColumns[] = AddressBookPeer::ID;
		}

	} 
	
	public function setMemberId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->member_id !== $v) {
			$this->member_id = $v;
			$this->modifiedColumns[] = AddressBookPeer::MEMBER_ID;
		}

		if ($this->aMember !== null && $this->aMember->getId() !== $v) {
			$this->aMember = null;
		}

	} 
	
	public function setGender($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = AddressBookPeer::GENDER;
		}

	} 
	
	public function setFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = AddressBookPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = AddressBookPeer::LAST_NAME;
		}

	} 
	
	public function setCompany($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->company !== $v) {
			$this->company = $v;
			$this->modifiedColumns[] = AddressBookPeer::COMPANY;
		}

	} 
	
	public function setCountryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->country_id !== $v) {
			$this->country_id = $v;
			$this->modifiedColumns[] = AddressBookPeer::COUNTRY_ID;
		}

		if ($this->aCountry !== null && $this->aCountry->getId() !== $v) {
			$this->aCountry = null;
		}

	} 
	
	public function setStateId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->state_id !== $v) {
			$this->state_id = $v;
			$this->modifiedColumns[] = AddressBookPeer::STATE_ID;
		}

		if ($this->aState !== null && $this->aState->getId() !== $v) {
			$this->aState = null;
		}

	} 
	
	public function setStateTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->state_title !== $v) {
			$this->state_title = $v;
			$this->modifiedColumns[] = AddressBookPeer::STATE_TITLE;
		}

	} 
	
	public function setCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = AddressBookPeer::CITY;
		}

	} 
	
	public function setStreet($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->street !== $v) {
			$this->street = $v;
			$this->modifiedColumns[] = AddressBookPeer::STREET;
		}

	} 
	
	public function setPostcode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->postcode !== $v) {
			$this->postcode = $v;
			$this->modifiedColumns[] = AddressBookPeer::POSTCODE;
		}

	} 
	
	public function setIsDefault($v)
	{

		if ($this->is_default !== $v || $v === false) {
			$this->is_default = $v;
			$this->modifiedColumns[] = AddressBookPeer::IS_DEFAULT;
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
			$this->modifiedColumns[] = AddressBookPeer::CREATED_AT;
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
			$this->modifiedColumns[] = AddressBookPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->member_id = $rs->getInt($startcol + 1);

			$this->gender = $rs->getInt($startcol + 2);

			$this->first_name = $rs->getString($startcol + 3);

			$this->last_name = $rs->getString($startcol + 4);

			$this->company = $rs->getString($startcol + 5);

			$this->country_id = $rs->getInt($startcol + 6);

			$this->state_id = $rs->getInt($startcol + 7);

			$this->state_title = $rs->getString($startcol + 8);

			$this->city = $rs->getString($startcol + 9);

			$this->street = $rs->getString($startcol + 10);

			$this->postcode = $rs->getString($startcol + 11);

			$this->is_default = $rs->getBoolean($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->updated_at = $rs->getTimestamp($startcol + 14, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AddressBook object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBook:delete:pre') as $callable)
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
			$con = Propel::getConnection(AddressBookPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AddressBookPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAddressBook:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBook:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(AddressBookPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(AddressBookPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AddressBookPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAddressBook:save:post') as $callable)
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

			if ($this->aCountry !== null) {
				if ($this->aCountry->isModified() || ($this->aCountry->getCulture() && $this->aCountry->getCurrentCountryI18n()->isModified())) {
					$affectedRows += $this->aCountry->save($con);
				}
				$this->setCountry($this->aCountry);
			}

			if ($this->aState !== null) {
				if ($this->aState->isModified() || ($this->aState->getCulture() && $this->aState->getCurrentStateI18n()->isModified())) {
					$affectedRows += $this->aState->save($con);
				}
				$this->setState($this->aState);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AddressBookPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AddressBookPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collMembers !== null) {
				foreach($this->collMembers as $referrerFK) {
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

			if ($this->aCountry !== null) {
				if (!$this->aCountry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCountry->getValidationFailures());
				}
			}

			if ($this->aState !== null) {
				if (!$this->aState->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aState->getValidationFailures());
				}
			}


			if (($retval = AddressBookPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMembers !== null) {
					foreach($this->collMembers as $referrerFK) {
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
		$pos = AddressBookPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getGender();
				break;
			case 3:
				return $this->getFirstName();
				break;
			case 4:
				return $this->getLastName();
				break;
			case 5:
				return $this->getCompany();
				break;
			case 6:
				return $this->getCountryId();
				break;
			case 7:
				return $this->getStateId();
				break;
			case 8:
				return $this->getStateTitle();
				break;
			case 9:
				return $this->getCity();
				break;
			case 10:
				return $this->getStreet();
				break;
			case 11:
				return $this->getPostcode();
				break;
			case 12:
				return $this->getIsDefault();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AddressBookPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMemberId(),
			$keys[2] => $this->getGender(),
			$keys[3] => $this->getFirstName(),
			$keys[4] => $this->getLastName(),
			$keys[5] => $this->getCompany(),
			$keys[6] => $this->getCountryId(),
			$keys[7] => $this->getStateId(),
			$keys[8] => $this->getStateTitle(),
			$keys[9] => $this->getCity(),
			$keys[10] => $this->getStreet(),
			$keys[11] => $this->getPostcode(),
			$keys[12] => $this->getIsDefault(),
			$keys[13] => $this->getCreatedAt(),
			$keys[14] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AddressBookPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setGender($value);
				break;
			case 3:
				$this->setFirstName($value);
				break;
			case 4:
				$this->setLastName($value);
				break;
			case 5:
				$this->setCompany($value);
				break;
			case 6:
				$this->setCountryId($value);
				break;
			case 7:
				$this->setStateId($value);
				break;
			case 8:
				$this->setStateTitle($value);
				break;
			case 9:
				$this->setCity($value);
				break;
			case 10:
				$this->setStreet($value);
				break;
			case 11:
				$this->setPostcode($value);
				break;
			case 12:
				$this->setIsDefault($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AddressBookPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMemberId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setGender($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFirstName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLastName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCompany($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCountryId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStateId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setStateTitle($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCity($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setStreet($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setPostcode($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsDefault($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AddressBookPeer::DATABASE_NAME);

		if ($this->isColumnModified(AddressBookPeer::ID)) $criteria->add(AddressBookPeer::ID, $this->id);
		if ($this->isColumnModified(AddressBookPeer::MEMBER_ID)) $criteria->add(AddressBookPeer::MEMBER_ID, $this->member_id);
		if ($this->isColumnModified(AddressBookPeer::GENDER)) $criteria->add(AddressBookPeer::GENDER, $this->gender);
		if ($this->isColumnModified(AddressBookPeer::FIRST_NAME)) $criteria->add(AddressBookPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(AddressBookPeer::LAST_NAME)) $criteria->add(AddressBookPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(AddressBookPeer::COMPANY)) $criteria->add(AddressBookPeer::COMPANY, $this->company);
		if ($this->isColumnModified(AddressBookPeer::COUNTRY_ID)) $criteria->add(AddressBookPeer::COUNTRY_ID, $this->country_id);
		if ($this->isColumnModified(AddressBookPeer::STATE_ID)) $criteria->add(AddressBookPeer::STATE_ID, $this->state_id);
		if ($this->isColumnModified(AddressBookPeer::STATE_TITLE)) $criteria->add(AddressBookPeer::STATE_TITLE, $this->state_title);
		if ($this->isColumnModified(AddressBookPeer::CITY)) $criteria->add(AddressBookPeer::CITY, $this->city);
		if ($this->isColumnModified(AddressBookPeer::STREET)) $criteria->add(AddressBookPeer::STREET, $this->street);
		if ($this->isColumnModified(AddressBookPeer::POSTCODE)) $criteria->add(AddressBookPeer::POSTCODE, $this->postcode);
		if ($this->isColumnModified(AddressBookPeer::IS_DEFAULT)) $criteria->add(AddressBookPeer::IS_DEFAULT, $this->is_default);
		if ($this->isColumnModified(AddressBookPeer::CREATED_AT)) $criteria->add(AddressBookPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AddressBookPeer::UPDATED_AT)) $criteria->add(AddressBookPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AddressBookPeer::DATABASE_NAME);

		$criteria->add(AddressBookPeer::ID, $this->id);

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

		$copyObj->setGender($this->gender);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setCompany($this->company);

		$copyObj->setCountryId($this->country_id);

		$copyObj->setStateId($this->state_id);

		$copyObj->setStateTitle($this->state_title);

		$copyObj->setCity($this->city);

		$copyObj->setStreet($this->street);

		$copyObj->setPostcode($this->postcode);

		$copyObj->setIsDefault($this->is_default);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getMembers() as $relObj) {
				$copyObj->addMember($relObj->copy($deepCopy));
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
			self::$peer = new AddressBookPeer();
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

	
	public function setState($v)
	{


		if ($v === null) {
			$this->setStateId(NULL);
		} else {
			$this->setStateId($v->getId());
		}


		$this->aState = $v;
	}


	
	public function getState($con = null)
	{
		if ($this->aState === null && ($this->state_id !== null)) {
						$this->aState = StatePeer::retrieveByPK($this->state_id, $con);

			
		}
		return $this->aState;
	}

	
	public function initMembers()
	{
		if ($this->collMembers === null) {
			$this->collMembers = array();
		}
	}

	
	public function getMembers($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMembers === null) {
			if ($this->isNew()) {
			   $this->collMembers = array();
			} else {

				$criteria->add(MemberPeer::DEFAULT_ADDRESS_ID, $this->getId());

				MemberPeer::addSelectColumns($criteria);
				$this->collMembers = MemberPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MemberPeer::DEFAULT_ADDRESS_ID, $this->getId());

				MemberPeer::addSelectColumns($criteria);
				if (!isset($this->lastMemberCriteria) || !$this->lastMemberCriteria->equals($criteria)) {
					$this->collMembers = MemberPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMemberCriteria = $criteria;
		return $this->collMembers;
	}

	
	public function countMembers($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MemberPeer::DEFAULT_ADDRESS_ID, $this->getId());

		return MemberPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMember(Member $l)
	{
		$this->collMembers[] = $l;
		$l->setAddressBook($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAddressBook:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAddressBook::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 