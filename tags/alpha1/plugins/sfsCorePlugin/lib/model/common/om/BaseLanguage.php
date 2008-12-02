<?php


abstract class BaseLanguage extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $culture;


	
	protected $title_english;


	
	protected $title_own;


	
	protected $is_default = false;


	
	protected $is_active = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function getTitleEnglish()
	{

		return $this->title_english;
	}

	
	public function getTitleOwn()
	{

		return $this->title_own;
	}

	
	public function getIsDefault()
	{

		return $this->is_default;
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

	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = LanguagePeer::CULTURE;
		}

	} 
	
	public function setTitleEnglish($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title_english !== $v) {
			$this->title_english = $v;
			$this->modifiedColumns[] = LanguagePeer::TITLE_ENGLISH;
		}

	} 
	
	public function setTitleOwn($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title_own !== $v) {
			$this->title_own = $v;
			$this->modifiedColumns[] = LanguagePeer::TITLE_OWN;
		}

	} 
	
	public function setIsDefault($v)
	{

		if ($this->is_default !== $v || $v === false) {
			$this->is_default = $v;
			$this->modifiedColumns[] = LanguagePeer::IS_DEFAULT;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = LanguagePeer::IS_ACTIVE;
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
			$this->modifiedColumns[] = LanguagePeer::CREATED_AT;
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
			$this->modifiedColumns[] = LanguagePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->culture = $rs->getString($startcol + 0);

			$this->title_english = $rs->getString($startcol + 1);

			$this->title_own = $rs->getString($startcol + 2);

			$this->is_default = $rs->getBoolean($startcol + 3);

			$this->is_active = $rs->getBoolean($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Language object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseLanguage:delete:pre') as $callable)
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
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LanguagePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseLanguage:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseLanguage:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(LanguagePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(LanguagePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseLanguage:save:post') as $callable)
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
					$pk = LanguagePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += LanguagePeer::doUpdate($this, $con);
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


			if (($retval = LanguagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCulture();
				break;
			case 1:
				return $this->getTitleEnglish();
				break;
			case 2:
				return $this->getTitleOwn();
				break;
			case 3:
				return $this->getIsDefault();
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
		$keys = LanguagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCulture(),
			$keys[1] => $this->getTitleEnglish(),
			$keys[2] => $this->getTitleOwn(),
			$keys[3] => $this->getIsDefault(),
			$keys[4] => $this->getIsActive(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCulture($value);
				break;
			case 1:
				$this->setTitleEnglish($value);
				break;
			case 2:
				$this->setTitleOwn($value);
				break;
			case 3:
				$this->setIsDefault($value);
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
		$keys = LanguagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCulture($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitleEnglish($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitleOwn($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsDefault($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsActive($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LanguagePeer::DATABASE_NAME);

		if ($this->isColumnModified(LanguagePeer::CULTURE)) $criteria->add(LanguagePeer::CULTURE, $this->culture);
		if ($this->isColumnModified(LanguagePeer::TITLE_ENGLISH)) $criteria->add(LanguagePeer::TITLE_ENGLISH, $this->title_english);
		if ($this->isColumnModified(LanguagePeer::TITLE_OWN)) $criteria->add(LanguagePeer::TITLE_OWN, $this->title_own);
		if ($this->isColumnModified(LanguagePeer::IS_DEFAULT)) $criteria->add(LanguagePeer::IS_DEFAULT, $this->is_default);
		if ($this->isColumnModified(LanguagePeer::IS_ACTIVE)) $criteria->add(LanguagePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(LanguagePeer::CREATED_AT)) $criteria->add(LanguagePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(LanguagePeer::UPDATED_AT)) $criteria->add(LanguagePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LanguagePeer::DATABASE_NAME);

		$criteria->add(LanguagePeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCulture();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCulture($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTitleEnglish($this->title_english);

		$copyObj->setTitleOwn($this->title_own);

		$copyObj->setIsDefault($this->is_default);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setCulture(NULL); 
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
			self::$peer = new LanguagePeer();
		}
		return self::$peer;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseLanguage:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseLanguage::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 