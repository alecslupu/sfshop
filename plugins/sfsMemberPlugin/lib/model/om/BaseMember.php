<?php


abstract class BaseMember extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $credential = 'member';


	
	protected $first_name;


	
	protected $last_name;


	
	protected $email;


	
	protected $default_address_id;


	
	protected $secret_question;


	
	protected $secret_answer;


	
	protected $primary_phone;


	
	protected $secondary_phone;


	
	protected $password = '';


	
	protected $confirm_code;


	
	protected $is_confirmed = false;


	
	protected $is_deleted = false;


	
	protected $is_active = false;


	
	protected $access_num = 1;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $modified_at;

	
	protected $aAddressBook;

	
	protected $collBaskets;

	
	protected $lastBasketCriteria = null;

	
	protected $collOrderItems;

	
	protected $lastOrderItemCriteria = null;

	
	protected $collAddressBooks;

	
	protected $lastAddressBookCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCredential()
	{

		return $this->credential;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getDefaultAddressId()
	{

		return $this->default_address_id;
	}

	
	public function getSecretQuestion()
	{

		return $this->secret_question;
	}

	
	public function getSecretAnswer()
	{

		return $this->secret_answer;
	}

	
	public function getPrimaryPhone()
	{

		return $this->primary_phone;
	}

	
	public function getSecondaryPhone()
	{

		return $this->secondary_phone;
	}

	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function getConfirmCode()
	{

		return $this->confirm_code;
	}

	
	public function getIsConfirmed()
	{

		return $this->is_confirmed;
	}

	
	public function getIsDeleted()
	{

		return $this->is_deleted;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
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

	
	public function getModifiedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->modified_at === null || $this->modified_at === '') {
			return null;
		} elseif (!is_int($this->modified_at)) {
						$ts = strtotime($this->modified_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [modified_at] as date/time value: " . var_export($this->modified_at, true));
			}
		} else {
			$ts = $this->modified_at;
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
			$this->modifiedColumns[] = MemberPeer::ID;
		}

	} 
	
	public function setCredential($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credential !== $v || $v === 'member') {
			$this->credential = $v;
			$this->modifiedColumns[] = MemberPeer::CREDENTIAL;
		}

	} 
	
	public function setFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = MemberPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = MemberPeer::LAST_NAME;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = MemberPeer::EMAIL;
		}

	} 
	
	public function setDefaultAddressId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->default_address_id !== $v) {
			$this->default_address_id = $v;
			$this->modifiedColumns[] = MemberPeer::DEFAULT_ADDRESS_ID;
		}

		if ($this->aAddressBook !== null && $this->aAddressBook->getId() !== $v) {
			$this->aAddressBook = null;
		}

	} 
	
	public function setSecretQuestion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secret_question !== $v) {
			$this->secret_question = $v;
			$this->modifiedColumns[] = MemberPeer::SECRET_QUESTION;
		}

	} 
	
	public function setSecretAnswer($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secret_answer !== $v) {
			$this->secret_answer = $v;
			$this->modifiedColumns[] = MemberPeer::SECRET_ANSWER;
		}

	} 
	
	public function setPrimaryPhone($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->primary_phone !== $v) {
			$this->primary_phone = $v;
			$this->modifiedColumns[] = MemberPeer::PRIMARY_PHONE;
		}

	} 
	
	public function setSecondaryPhone($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secondary_phone !== $v) {
			$this->secondary_phone = $v;
			$this->modifiedColumns[] = MemberPeer::SECONDARY_PHONE;
		}

	} 
	
	public function setPassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v || $v === '') {
			$this->password = $v;
			$this->modifiedColumns[] = MemberPeer::PASSWORD;
		}

	} 
	
	public function setConfirmCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->confirm_code !== $v) {
			$this->confirm_code = $v;
			$this->modifiedColumns[] = MemberPeer::CONFIRM_CODE;
		}

	} 
	
	public function setIsConfirmed($v)
	{

		if ($this->is_confirmed !== $v || $v === false) {
			$this->is_confirmed = $v;
			$this->modifiedColumns[] = MemberPeer::IS_CONFIRMED;
		}

	} 
	
	public function setIsDeleted($v)
	{

		if ($this->is_deleted !== $v || $v === false) {
			$this->is_deleted = $v;
			$this->modifiedColumns[] = MemberPeer::IS_DELETED;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = MemberPeer::IS_ACTIVE;
		}

	} 
	
	public function setAccessNum($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->access_num !== $v || $v === 1) {
			$this->access_num = $v;
			$this->modifiedColumns[] = MemberPeer::ACCESS_NUM;
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
			$this->modifiedColumns[] = MemberPeer::CREATED_AT;
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
			$this->modifiedColumns[] = MemberPeer::UPDATED_AT;
		}

	} 
	
	public function setModifiedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [modified_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->modified_at !== $ts) {
			$this->modified_at = $ts;
			$this->modifiedColumns[] = MemberPeer::MODIFIED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->credential = $rs->getString($startcol + 1);

			$this->first_name = $rs->getString($startcol + 2);

			$this->last_name = $rs->getString($startcol + 3);

			$this->email = $rs->getString($startcol + 4);

			$this->default_address_id = $rs->getInt($startcol + 5);

			$this->secret_question = $rs->getString($startcol + 6);

			$this->secret_answer = $rs->getString($startcol + 7);

			$this->primary_phone = $rs->getString($startcol + 8);

			$this->secondary_phone = $rs->getString($startcol + 9);

			$this->password = $rs->getString($startcol + 10);

			$this->confirm_code = $rs->getString($startcol + 11);

			$this->is_confirmed = $rs->getBoolean($startcol + 12);

			$this->is_deleted = $rs->getBoolean($startcol + 13);

			$this->is_active = $rs->getBoolean($startcol + 14);

			$this->access_num = $rs->getInt($startcol + 15);

			$this->created_at = $rs->getTimestamp($startcol + 16, null);

			$this->updated_at = $rs->getTimestamp($startcol + 17, null);

			$this->modified_at = $rs->getTimestamp($startcol + 18, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Member object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseMember:delete:pre') as $callable)
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
			$con = Propel::getConnection(MemberPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MemberPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMember:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseMember:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(MemberPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(MemberPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MemberPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMember:save:post') as $callable)
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


												
			if ($this->aAddressBook !== null) {
				if ($this->aAddressBook->isModified()) {
					$affectedRows += $this->aAddressBook->save($con);
				}
				$this->setAddressBook($this->aAddressBook);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MemberPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MemberPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collBaskets !== null) {
				foreach($this->collBaskets as $referrerFK) {
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


												
			if ($this->aAddressBook !== null) {
				if (!$this->aAddressBook->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAddressBook->getValidationFailures());
				}
			}


			if (($retval = MemberPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBaskets !== null) {
					foreach($this->collBaskets as $referrerFK) {
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
		$pos = MemberPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCredential();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getLastName();
				break;
			case 4:
				return $this->getEmail();
				break;
			case 5:
				return $this->getDefaultAddressId();
				break;
			case 6:
				return $this->getSecretQuestion();
				break;
			case 7:
				return $this->getSecretAnswer();
				break;
			case 8:
				return $this->getPrimaryPhone();
				break;
			case 9:
				return $this->getSecondaryPhone();
				break;
			case 10:
				return $this->getPassword();
				break;
			case 11:
				return $this->getConfirmCode();
				break;
			case 12:
				return $this->getIsConfirmed();
				break;
			case 13:
				return $this->getIsDeleted();
				break;
			case 14:
				return $this->getIsActive();
				break;
			case 15:
				return $this->getAccessNum();
				break;
			case 16:
				return $this->getCreatedAt();
				break;
			case 17:
				return $this->getUpdatedAt();
				break;
			case 18:
				return $this->getModifiedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MemberPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCredential(),
			$keys[2] => $this->getFirstName(),
			$keys[3] => $this->getLastName(),
			$keys[4] => $this->getEmail(),
			$keys[5] => $this->getDefaultAddressId(),
			$keys[6] => $this->getSecretQuestion(),
			$keys[7] => $this->getSecretAnswer(),
			$keys[8] => $this->getPrimaryPhone(),
			$keys[9] => $this->getSecondaryPhone(),
			$keys[10] => $this->getPassword(),
			$keys[11] => $this->getConfirmCode(),
			$keys[12] => $this->getIsConfirmed(),
			$keys[13] => $this->getIsDeleted(),
			$keys[14] => $this->getIsActive(),
			$keys[15] => $this->getAccessNum(),
			$keys[16] => $this->getCreatedAt(),
			$keys[17] => $this->getUpdatedAt(),
			$keys[18] => $this->getModifiedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MemberPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCredential($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setLastName($value);
				break;
			case 4:
				$this->setEmail($value);
				break;
			case 5:
				$this->setDefaultAddressId($value);
				break;
			case 6:
				$this->setSecretQuestion($value);
				break;
			case 7:
				$this->setSecretAnswer($value);
				break;
			case 8:
				$this->setPrimaryPhone($value);
				break;
			case 9:
				$this->setSecondaryPhone($value);
				break;
			case 10:
				$this->setPassword($value);
				break;
			case 11:
				$this->setConfirmCode($value);
				break;
			case 12:
				$this->setIsConfirmed($value);
				break;
			case 13:
				$this->setIsDeleted($value);
				break;
			case 14:
				$this->setIsActive($value);
				break;
			case 15:
				$this->setAccessNum($value);
				break;
			case 16:
				$this->setCreatedAt($value);
				break;
			case 17:
				$this->setUpdatedAt($value);
				break;
			case 18:
				$this->setModifiedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MemberPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCredential($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDefaultAddressId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSecretQuestion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSecretAnswer($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPrimaryPhone($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSecondaryPhone($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setPassword($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setConfirmCode($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsConfirmed($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsDeleted($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setIsActive($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setAccessNum($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCreatedAt($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setUpdatedAt($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setModifiedAt($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MemberPeer::DATABASE_NAME);

		if ($this->isColumnModified(MemberPeer::ID)) $criteria->add(MemberPeer::ID, $this->id);
		if ($this->isColumnModified(MemberPeer::CREDENTIAL)) $criteria->add(MemberPeer::CREDENTIAL, $this->credential);
		if ($this->isColumnModified(MemberPeer::FIRST_NAME)) $criteria->add(MemberPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(MemberPeer::LAST_NAME)) $criteria->add(MemberPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(MemberPeer::EMAIL)) $criteria->add(MemberPeer::EMAIL, $this->email);
		if ($this->isColumnModified(MemberPeer::DEFAULT_ADDRESS_ID)) $criteria->add(MemberPeer::DEFAULT_ADDRESS_ID, $this->default_address_id);
		if ($this->isColumnModified(MemberPeer::SECRET_QUESTION)) $criteria->add(MemberPeer::SECRET_QUESTION, $this->secret_question);
		if ($this->isColumnModified(MemberPeer::SECRET_ANSWER)) $criteria->add(MemberPeer::SECRET_ANSWER, $this->secret_answer);
		if ($this->isColumnModified(MemberPeer::PRIMARY_PHONE)) $criteria->add(MemberPeer::PRIMARY_PHONE, $this->primary_phone);
		if ($this->isColumnModified(MemberPeer::SECONDARY_PHONE)) $criteria->add(MemberPeer::SECONDARY_PHONE, $this->secondary_phone);
		if ($this->isColumnModified(MemberPeer::PASSWORD)) $criteria->add(MemberPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(MemberPeer::CONFIRM_CODE)) $criteria->add(MemberPeer::CONFIRM_CODE, $this->confirm_code);
		if ($this->isColumnModified(MemberPeer::IS_CONFIRMED)) $criteria->add(MemberPeer::IS_CONFIRMED, $this->is_confirmed);
		if ($this->isColumnModified(MemberPeer::IS_DELETED)) $criteria->add(MemberPeer::IS_DELETED, $this->is_deleted);
		if ($this->isColumnModified(MemberPeer::IS_ACTIVE)) $criteria->add(MemberPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(MemberPeer::ACCESS_NUM)) $criteria->add(MemberPeer::ACCESS_NUM, $this->access_num);
		if ($this->isColumnModified(MemberPeer::CREATED_AT)) $criteria->add(MemberPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(MemberPeer::UPDATED_AT)) $criteria->add(MemberPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(MemberPeer::MODIFIED_AT)) $criteria->add(MemberPeer::MODIFIED_AT, $this->modified_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MemberPeer::DATABASE_NAME);

		$criteria->add(MemberPeer::ID, $this->id);

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

		$copyObj->setCredential($this->credential);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setEmail($this->email);

		$copyObj->setDefaultAddressId($this->default_address_id);

		$copyObj->setSecretQuestion($this->secret_question);

		$copyObj->setSecretAnswer($this->secret_answer);

		$copyObj->setPrimaryPhone($this->primary_phone);

		$copyObj->setSecondaryPhone($this->secondary_phone);

		$copyObj->setPassword($this->password);

		$copyObj->setConfirmCode($this->confirm_code);

		$copyObj->setIsConfirmed($this->is_confirmed);

		$copyObj->setIsDeleted($this->is_deleted);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setAccessNum($this->access_num);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setModifiedAt($this->modified_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getBaskets() as $relObj) {
				$copyObj->addBasket($relObj->copy($deepCopy));
			}

			foreach($this->getOrderItems() as $relObj) {
				$copyObj->addOrderItem($relObj->copy($deepCopy));
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
			self::$peer = new MemberPeer();
		}
		return self::$peer;
	}

	
	public function setAddressBook($v)
	{


		if ($v === null) {
			$this->setDefaultAddressId(NULL);
		} else {
			$this->setDefaultAddressId($v->getId());
		}


		$this->aAddressBook = $v;
	}


	
	public function getAddressBook($con = null)
	{
		if ($this->aAddressBook === null && ($this->default_address_id !== null)) {
						$this->aAddressBook = AddressBookPeer::retrieveByPK($this->default_address_id, $con);

			
		}
		return $this->aAddressBook;
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

				$criteria->add(BasketPeer::MEMBER_ID, $this->getId());

				BasketPeer::addSelectColumns($criteria);
				$this->collBaskets = BasketPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BasketPeer::MEMBER_ID, $this->getId());

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

		$criteria->add(BasketPeer::MEMBER_ID, $this->getId());

		return BasketPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBasket(Basket $l)
	{
		$this->collBaskets[] = $l;
		$l->setMember($this);
	}


	
	public function getBasketsJoinCurrency($criteria = null, $con = null)
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

				$criteria->add(BasketPeer::MEMBER_ID, $this->getId());

				$this->collBaskets = BasketPeer::doSelectJoinCurrency($criteria, $con);
			}
		} else {
									
			$criteria->add(BasketPeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastBasketCriteria) || !$this->lastBasketCriteria->equals($criteria)) {
				$this->collBaskets = BasketPeer::doSelectJoinCurrency($criteria, $con);
			}
		}
		$this->lastBasketCriteria = $criteria;

		return $this->collBaskets;
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

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItems = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

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

		$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

		return OrderItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderItem(OrderItem $l)
	{
		$this->collOrderItems[] = $l;
		$l->setMember($this);
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

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinDelivery($criteria, $con);
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

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByMemberCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByMemberStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

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

				$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

				$this->collOrderItems = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderItemPeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastOrderItemCriteria) || !$this->lastOrderItemCriteria->equals($criteria)) {
				$this->collOrderItems = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con);
			}
		}
		$this->lastOrderItemCriteria = $criteria;

		return $this->collOrderItems;
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

				$criteria->add(AddressBookPeer::MEMBER_ID, $this->getId());

				AddressBookPeer::addSelectColumns($criteria);
				$this->collAddressBooks = AddressBookPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AddressBookPeer::MEMBER_ID, $this->getId());

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

		$criteria->add(AddressBookPeer::MEMBER_ID, $this->getId());

		return AddressBookPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAddressBook(AddressBook $l)
	{
		$this->collAddressBooks[] = $l;
		$l->setMember($this);
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

				$criteria->add(AddressBookPeer::MEMBER_ID, $this->getId());

				$this->collAddressBooks = AddressBookPeer::doSelectJoinCountry($criteria, $con);
			}
		} else {
									
			$criteria->add(AddressBookPeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinCountry($criteria, $con);
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

				$criteria->add(AddressBookPeer::MEMBER_ID, $this->getId());

				$this->collAddressBooks = AddressBookPeer::doSelectJoinState($criteria, $con);
			}
		} else {
									
			$criteria->add(AddressBookPeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinState($criteria, $con);
			}
		}
		$this->lastAddressBookCriteria = $criteria;

		return $this->collAddressBooks;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMember:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMember::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 