<?php


abstract class BaseAdmin extends BaseObject  implements Persistent {


  const PEER = 'AdminPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $credential;

	
	protected $email;

	
	protected $algorithm;

	
	protected $salt;

	
	protected $password;

	
	protected $first_name;

	
	protected $last_name;

	
	protected $is_active;

	
	protected $access_num;

	
	protected $created_at;

	
	protected $updated_at;

	
	protected $modified_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function applyDefaultValues()
	{
		$this->credential = 'admin';
		$this->algorithm = 'md5';
		$this->salt = '';
		$this->password = '';
		$this->is_active = false;
		$this->access_num = 1;
	}

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
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

	
	public function getAlgorithm()
	{
		return $this->algorithm;
	}

	
	public function getSalt()
	{
		return $this->salt;
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
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getModifiedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->modified_at === null) {
			return null;
		}


		if ($this->modified_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->modified_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->modified_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AdminPeer::ID;
		}

		return $this;
	} 
	
	public function setCredential($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->credential !== $v || $this->isNew()) {
			$this->credential = $v;
			$this->modifiedColumns[] = AdminPeer::CREDENTIAL;
		}

		return $this;
	} 
	
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = AdminPeer::EMAIL;
		}

		return $this;
	} 
	
	public function setAlgorithm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->algorithm !== $v || $this->isNew()) {
			$this->algorithm = $v;
			$this->modifiedColumns[] = AdminPeer::ALGORITHM;
		}

		return $this;
	} 
	
	public function setSalt($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->salt !== $v || $this->isNew()) {
			$this->salt = $v;
			$this->modifiedColumns[] = AdminPeer::SALT;
		}

		return $this;
	} 
	
	public function setPassword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->password !== $v || $this->isNew()) {
			$this->password = $v;
			$this->modifiedColumns[] = AdminPeer::PASSWORD;
		}

		return $this;
	} 
	
	public function setFirstName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = AdminPeer::FIRST_NAME;
		}

		return $this;
	} 
	
	public function setLastName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = AdminPeer::LAST_NAME;
		}

		return $this;
	} 
	
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $this->isNew()) {
			$this->is_active = $v;
			$this->modifiedColumns[] = AdminPeer::IS_ACTIVE;
		}

		return $this;
	} 
	
	public function setAccessNum($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->access_num !== $v || $this->isNew()) {
			$this->access_num = $v;
			$this->modifiedColumns[] = AdminPeer::ACCESS_NUM;
		}

		return $this;
	} 
	
	public function setCreatedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			
			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AdminPeer::CREATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setUpdatedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			
			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AdminPeer::UPDATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setModifiedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->modified_at !== null || $dt !== null ) {
			
			$currNorm = ($this->modified_at !== null && $tmpDt = new DateTime($this->modified_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->modified_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AdminPeer::MODIFIED_AT;
			}
		} 
		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
			if ($this->credential !== 'admin') {
				return false;
			}

			if ($this->algorithm !== 'md5') {
				return false;
			}

			if ($this->salt !== '') {
				return false;
			}

			if ($this->password !== '') {
				return false;
			}

			if ($this->is_active !== false) {
				return false;
			}

			if ($this->access_num !== 1) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->credential = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->email = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->algorithm = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->salt = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->password = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->first_name = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->last_name = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->is_active = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
			$this->access_num = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->created_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->updated_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->modified_at = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Admin object", $e);
		}
	}

	
	public function ensureConsistency()
	{

	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AdminPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
		} 	}

	
	public function delete(PropelPDO $con = null)
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
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				AdminPeer::doDelete($this, $con);
				$this->postDelete($con);
				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAdmin:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
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
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				AdminPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseAdmin:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AdminPeer::ID;
			}

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
		$field = $this->getByPosition($pos);
		return $field;
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
				return $this->getAlgorithm();
				break;
			case 4:
				return $this->getSalt();
				break;
			case 5:
				return $this->getPassword();
				break;
			case 6:
				return $this->getFirstName();
				break;
			case 7:
				return $this->getLastName();
				break;
			case 8:
				return $this->getIsActive();
				break;
			case 9:
				return $this->getAccessNum();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			case 12:
				return $this->getModifiedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AdminPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCredential(),
			$keys[2] => $this->getEmail(),
			$keys[3] => $this->getAlgorithm(),
			$keys[4] => $this->getSalt(),
			$keys[5] => $this->getPassword(),
			$keys[6] => $this->getFirstName(),
			$keys[7] => $this->getLastName(),
			$keys[8] => $this->getIsActive(),
			$keys[9] => $this->getAccessNum(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
			$keys[12] => $this->getModifiedAt(),
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
				$this->setAlgorithm($value);
				break;
			case 4:
				$this->setSalt($value);
				break;
			case 5:
				$this->setPassword($value);
				break;
			case 6:
				$this->setFirstName($value);
				break;
			case 7:
				$this->setLastName($value);
				break;
			case 8:
				$this->setIsActive($value);
				break;
			case 9:
				$this->setAccessNum($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
			case 12:
				$this->setModifiedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AdminPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCredential($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEmail($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAlgorithm($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSalt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPassword($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFirstName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLastName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsActive($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAccessNum($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setModifiedAt($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AdminPeer::DATABASE_NAME);

		if ($this->isColumnModified(AdminPeer::ID)) $criteria->add(AdminPeer::ID, $this->id);
		if ($this->isColumnModified(AdminPeer::CREDENTIAL)) $criteria->add(AdminPeer::CREDENTIAL, $this->credential);
		if ($this->isColumnModified(AdminPeer::EMAIL)) $criteria->add(AdminPeer::EMAIL, $this->email);
		if ($this->isColumnModified(AdminPeer::ALGORITHM)) $criteria->add(AdminPeer::ALGORITHM, $this->algorithm);
		if ($this->isColumnModified(AdminPeer::SALT)) $criteria->add(AdminPeer::SALT, $this->salt);
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

		$copyObj->setAlgorithm($this->algorithm);

		$copyObj->setSalt($this->salt);

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

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
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