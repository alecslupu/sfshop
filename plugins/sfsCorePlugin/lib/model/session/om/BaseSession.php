<?php


abstract class BaseSession extends BaseObject  implements Persistent {


	
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

	
	public function getSesTime($format = 'Y-m-d H:i:s')
	{

		if ($this->ses_time === null || $this->ses_time === '') {
			return null;
		} elseif (!is_int($this->ses_time)) {
						$ts = strtotime($this->ses_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [ses_time] as date/time value: " . var_export($this->ses_time, true));
			}
		} else {
			$ts = $this->ses_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setCid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cid !== $v) {
			$this->cid = $v;
			$this->modifiedColumns[] = SessionPeer::CID;
		}

	} 
	
	public function setSesData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ses_data !== $v) {
			$this->ses_data = $v;
			$this->modifiedColumns[] = SessionPeer::SES_DATA;
		}

	} 
	
	public function setSesTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [ses_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ses_time !== $ts) {
			$this->ses_time = $ts;
			$this->modifiedColumns[] = SessionPeer::SES_TIME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->cid = $rs->getString($startcol + 0);

			$this->ses_data = $rs->getString($startcol + 1);

			$this->ses_time = $rs->getTimestamp($startcol + 2, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Session object", $e);
		}
	}

	
	public function delete($con = null)
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
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SessionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSession:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
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
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSession:save:post') as $callable)
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
		return $this->getByPosition($pos);
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

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
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

		$copyObj->setSesData($this->ses_data);

		$copyObj->setSesTime($this->ses_time);


		$copyObj->setNew(true);

		$copyObj->setCid(NULL); 
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