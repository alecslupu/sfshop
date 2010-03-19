<?php


abstract class BaseSession extends BaseObject  implements Persistent {


  const PEER = 'SessionPeer';

	
	protected static $peer;

	
	protected $cid;

	
	protected $ses_data;

	
	protected $ses_time;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCid()
	{
		return $this->cid;
	}

	
	public function getSesData()
	{
		return $this->ses_data;
	}

	
	public function getSesTime()
	{
		return $this->ses_time;
	}

	
	public function setCid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->cid !== $v) {
			$this->cid = $v;
			$this->modifiedColumns[] = SessionPeer::CID;
		}

		return $this;
	} 
	
	public function setSesData($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ses_data !== $v) {
			$this->ses_data = $v;
			$this->modifiedColumns[] = SessionPeer::SES_DATA;
		}

		return $this;
	} 
	
	public function setSesTime($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ses_time !== $v) {
			$this->ses_time = $v;
			$this->modifiedColumns[] = SessionPeer::SES_TIME;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->cid = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ses_data = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ses_time = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Session object", $e);
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
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SessionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseSession:delete:pre') as $callable)
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
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SessionPeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseSession:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSession:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SessionPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseSession:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SessionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SessionPeer::doUpdate($this, $con);
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


			if (($retval = SessionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCid();
				break;
			case 1:
				return $this->getSesData();
				break;
			case 2:
				return $this->getSesTime();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SessionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCid(),
			$keys[1] => $this->getSesData(),
			$keys[2] => $this->getSesTime(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCid($value);
				break;
			case 1:
				$this->setSesData($value);
				break;
			case 2:
				$this->setSesTime($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SessionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSesData($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSesTime($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SessionPeer::DATABASE_NAME);

		if ($this->isColumnModified(SessionPeer::CID)) $criteria->add(SessionPeer::CID, $this->cid);
		if ($this->isColumnModified(SessionPeer::SES_DATA)) $criteria->add(SessionPeer::SES_DATA, $this->ses_data);
		if ($this->isColumnModified(SessionPeer::SES_TIME)) $criteria->add(SessionPeer::SES_TIME, $this->ses_time);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SessionPeer::DATABASE_NAME);

		$criteria->add(SessionPeer::CID, $this->cid);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCid();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCid($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCid($this->cid);

		$copyObj->setSesData($this->ses_data);

		$copyObj->setSesTime($this->ses_time);


		$copyObj->setNew(true);

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
			self::$peer = new SessionPeer();
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
    if (!$callable = sfMixer::getCallable('BaseSession:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSession::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }

} 