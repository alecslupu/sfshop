<?php


abstract class BaseLanguage extends BaseObject  implements Persistent {


  const PEER = 'LanguagePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $culture;

	
	protected $title_english;

	
	protected $title_own;

	
	protected $is_default;

	
	protected $is_active;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function applyDefaultValues()
	{
		$this->is_default = false;
		$this->is_active = false;
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

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = LanguagePeer::ID;
		}

		return $this;
	} 
	
	public function setCulture($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = LanguagePeer::CULTURE;
		}

		return $this;
	} 
	
	public function setTitleEnglish($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title_english !== $v) {
			$this->title_english = $v;
			$this->modifiedColumns[] = LanguagePeer::TITLE_ENGLISH;
		}

		return $this;
	} 
	
	public function setTitleOwn($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title_own !== $v) {
			$this->title_own = $v;
			$this->modifiedColumns[] = LanguagePeer::TITLE_OWN;
		}

		return $this;
	} 
	
	public function setIsDefault($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_default !== $v || $this->isNew()) {
			$this->is_default = $v;
			$this->modifiedColumns[] = LanguagePeer::IS_DEFAULT;
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
			$this->modifiedColumns[] = LanguagePeer::IS_ACTIVE;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
			if ($this->is_default !== false) {
				return false;
			}

			if ($this->is_active !== false) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->culture = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->title_english = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->title_own = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->is_default = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->is_active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Language object", $e);
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
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = LanguagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				LanguagePeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseLanguage:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseLanguage:save:pre') as $callable)
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
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				LanguagePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseLanguage:save:post') as $callable)
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
				$this->modifiedColumns[] = LanguagePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LanguagePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
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
				return $this->getCulture();
				break;
			case 2:
				return $this->getTitleEnglish();
				break;
			case 3:
				return $this->getTitleOwn();
				break;
			case 4:
				return $this->getIsDefault();
				break;
			case 5:
				return $this->getIsActive();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = LanguagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCulture(),
			$keys[2] => $this->getTitleEnglish(),
			$keys[3] => $this->getTitleOwn(),
			$keys[4] => $this->getIsDefault(),
			$keys[5] => $this->getIsActive(),
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
				$this->setId($value);
				break;
			case 1:
				$this->setCulture($value);
				break;
			case 2:
				$this->setTitleEnglish($value);
				break;
			case 3:
				$this->setTitleOwn($value);
				break;
			case 4:
				$this->setIsDefault($value);
				break;
			case 5:
				$this->setIsActive($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LanguagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCulture($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitleEnglish($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitleOwn($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsDefault($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsActive($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LanguagePeer::DATABASE_NAME);

		if ($this->isColumnModified(LanguagePeer::ID)) $criteria->add(LanguagePeer::ID, $this->id);
		if ($this->isColumnModified(LanguagePeer::CULTURE)) $criteria->add(LanguagePeer::CULTURE, $this->culture);
		if ($this->isColumnModified(LanguagePeer::TITLE_ENGLISH)) $criteria->add(LanguagePeer::TITLE_ENGLISH, $this->title_english);
		if ($this->isColumnModified(LanguagePeer::TITLE_OWN)) $criteria->add(LanguagePeer::TITLE_OWN, $this->title_own);
		if ($this->isColumnModified(LanguagePeer::IS_DEFAULT)) $criteria->add(LanguagePeer::IS_DEFAULT, $this->is_default);
		if ($this->isColumnModified(LanguagePeer::IS_ACTIVE)) $criteria->add(LanguagePeer::IS_ACTIVE, $this->is_active);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LanguagePeer::DATABASE_NAME);

		$criteria->add(LanguagePeer::ID, $this->id);

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

		$copyObj->setCulture($this->culture);

		$copyObj->setTitleEnglish($this->title_english);

		$copyObj->setTitleOwn($this->title_own);

		$copyObj->setIsDefault($this->is_default);

		$copyObj->setIsActive($this->is_active);


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
			self::$peer = new LanguagePeer();
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
    if (!$callable = sfMixer::getCallable('BaseLanguage:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseLanguage::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }

} 