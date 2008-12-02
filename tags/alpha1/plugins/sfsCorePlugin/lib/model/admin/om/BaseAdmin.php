<?php


abstract class BaseAdmin extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $credential = 'admin';


	
	protected $email;


	
	protected $password;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $is_active = false;


	
	protected $access_num = 1;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $modified_at;

	
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

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
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
			$this->modifiedColumns[] = AdminPeer::ID;
		}

	} 
	
	public function setCredential($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credential !== $v || $v === 'admin') {
			$this->credential = $v;
			$this->modifiedColumns[] = AdminPeer::CREDENTIAL;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = AdminPeer::EMAIL;
		}

	} 
	
	public function setPassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = AdminPeer::PASSWORD;
		}

	} 
	
	public function setFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = AdminPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = AdminPeer::LAST_NAME;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = AdminPeer::IS_ACTIVE;
		}

	} 
	
	public function setAccessNum($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->access_num !== $v || $v === 1) {
			$this->access_num = $v;
			$this->modifiedColumns[] = AdminPeer::ACCESS_NUM;
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
			$this->modifiedColumns[] = AdminPeer::CREATED_AT;
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
			$this->modifiedColumns[] = AdminPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = AdminPeer::MODIFIED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->credential = $rs->getString($startcol + 1);

			$this->email = $rs->getString($startcol + 2);

			$this->password = $rs->getString($startcol + 3);

			$this->first_name = $rs->getString($startcol + 4);

			$this->last_name = $rs->getString($startcol + 5);

			$this->is_active = $rs->getBoolean($startcol + 6);

			$this->access_num = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->modified_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Admin object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAdmin:delete:pre') as $callable)
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
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AdminPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAdmin:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAdmin:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(AdminPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(AdminPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAdmin:save:post') as $callable)
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
					$pk = AdminPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AdminPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


			if (($retval = AdminPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AdminPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getEmail();
				break;
			case 3:
				return $this->getPassword();
				break;
			case 4:
				return $this->getFirstName();
				break;
			case 5:
				return $this->getLastName();
				break;
			case 6:
				return $this->getIsActive();
				break;
			case 7:
				return $this->getAccessNum();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			case 10:
				return $this->getModifiedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AdminPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCredential(),
			$keys[2] => $this->getEmail(),
			$keys[3] => $this->getPassword(),
			$keys[4] => $this->getFirstName(),
			$keys[5] => $this->getLastName(),
			$keys[6] => $this->getIsActive(),
			$keys[7] => $this->getAccessNum(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
			$keys[10] => $this->getModifiedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AdminPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setEmail($value);
				break;
			case 3:
				$this->setPassword($value);
				break;
			case 4:
				$this->setFirstName($value);
				break;
			case 5:
				$this->setLastName($value);
				break;
			case 6:
				$this->setIsActive($value);
				break;
			case 7:
				$this->setAccessNum($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
			case 10:
				$this->setModifiedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AdminPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCredential($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEmail($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPassword($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFirstName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLastName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsActive($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAccessNum($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setModifiedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AdminPeer::DATABASE_NAME);

		if ($this->isColumnModified(AdminPeer::ID)) $criteria->add(AdminPeer::ID, $this->id);
		if ($this->isColumnModified(AdminPeer::CREDENTIAL)) $criteria->add(AdminPeer::CREDENTIAL, $this->credential);
		if ($this->isColumnModified(AdminPeer::EMAIL)) $criteria->add(AdminPeer::EMAIL, $this->email);
		if ($this->isColumnModified(AdminPeer::PASSWORD)) $criteria->add(AdminPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(AdminPeer::FIRST_NAME)) $criteria->add(AdminPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(AdminPeer::LAST_NAME)) $criteria->add(AdminPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(AdminPeer::IS_ACTIVE)) $criteria->add(AdminPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(AdminPeer::ACCESS_NUM)) $criteria->add(AdminPeer::ACCESS_NUM, $this->access_num);
		if ($this->isColumnModified(AdminPeer::CREATED_AT)) $criteria->add(AdminPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AdminPeer::UPDATED_AT)) $criteria->add(AdminPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(AdminPeer::MODIFIED_AT)) $criteria->add(AdminPeer::MODIFIED_AT, $this->modified_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AdminPeer::DATABASE_NAME);

		$criteria->add(AdminPeer::ID, $this->id);

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

		$copyObj->setEmail($this->email);

		$copyObj->setPassword($this->password);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setAccessNum($this->access_num);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setModifiedAt($this->modified_at);


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
			self::$peer = new AdminPeer();
		}
		return self::$peer;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAdmin:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAdmin::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 