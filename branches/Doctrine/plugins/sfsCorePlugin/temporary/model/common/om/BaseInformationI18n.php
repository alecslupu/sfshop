<?php


abstract class BaseInformationI18n extends BaseObject  implements Persistent {


  const PEER = 'InformationI18nPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $culture;

	
	protected $title;

	
	protected $description;

	
	protected $meta_keywords;

	
	protected $meta_description;

	
	protected $aInformation;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getCulture()
	{
		return $this->culture;
	}

	
	public function getTitle()
	{
		return $this->title;
	}

	
	public function getDescription()
	{
		return $this->description;
	}

	
	public function getMetaKeywords()
	{
		return $this->meta_keywords;
	}

	
	public function getMetaDescription()
	{
		return $this->meta_description;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = InformationI18nPeer::ID;
		}

		if ($this->aInformation !== null && $this->aInformation->getId() !== $v) {
			$this->aInformation = null;
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
			$this->modifiedColumns[] = InformationI18nPeer::CULTURE;
		}

		return $this;
	} 
	
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = InformationI18nPeer::TITLE;
		}

		return $this;
	} 
	
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = InformationI18nPeer::DESCRIPTION;
		}

		return $this;
	} 
	
	public function setMetaKeywords($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->meta_keywords !== $v) {
			$this->meta_keywords = $v;
			$this->modifiedColumns[] = InformationI18nPeer::META_KEYWORDS;
		}

		return $this;
	} 
	
	public function setMetaDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->meta_description !== $v) {
			$this->meta_description = $v;
			$this->modifiedColumns[] = InformationI18nPeer::META_DESCRIPTION;
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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->culture = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->title = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->description = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->meta_keywords = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->meta_description = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InformationI18n object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aInformation !== null && $this->id !== $this->aInformation->getId()) {
			$this->aInformation = null;
		}
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
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InformationI18nPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aInformation = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationI18n:delete:pre') as $callable)
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
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				InformationI18nPeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseInformationI18n:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationI18n:save:pre') as $callable)
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
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				InformationI18nPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseInformationI18n:save:post') as $callable)
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

												
			if ($this->aInformation !== null) {
				if ($this->aInformation->isModified() || ($this->aInformation->getCulture() && $this->aInformation->getCurrentInformationI18n()->isModified()) || $this->aInformation->isNew()) {
					$affectedRows += $this->aInformation->save($con);
				}
				$this->setInformation($this->aInformation);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InformationI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InformationI18nPeer::doUpdate($this, $con);
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


												
			if ($this->aInformation !== null) {
				if (!$this->aInformation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInformation->getValidationFailures());
				}
			}


			if (($retval = InformationI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InformationI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTitle();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getMetaKeywords();
				break;
			case 5:
				return $this->getMetaDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InformationI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCulture(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getMetaKeywords(),
			$keys[5] => $this->getMetaDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InformationI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTitle($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setMetaKeywords($value);
				break;
			case 5:
				$this->setMetaDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InformationI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCulture($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMetaKeywords($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMetaDescription($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InformationI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(InformationI18nPeer::ID)) $criteria->add(InformationI18nPeer::ID, $this->id);
		if ($this->isColumnModified(InformationI18nPeer::CULTURE)) $criteria->add(InformationI18nPeer::CULTURE, $this->culture);
		if ($this->isColumnModified(InformationI18nPeer::TITLE)) $criteria->add(InformationI18nPeer::TITLE, $this->title);
		if ($this->isColumnModified(InformationI18nPeer::DESCRIPTION)) $criteria->add(InformationI18nPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(InformationI18nPeer::META_KEYWORDS)) $criteria->add(InformationI18nPeer::META_KEYWORDS, $this->meta_keywords);
		if ($this->isColumnModified(InformationI18nPeer::META_DESCRIPTION)) $criteria->add(InformationI18nPeer::META_DESCRIPTION, $this->meta_description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InformationI18nPeer::DATABASE_NAME);

		$criteria->add(InformationI18nPeer::ID, $this->id);
		$criteria->add(InformationI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setCulture($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setId($this->id);

		$copyObj->setCulture($this->culture);

		$copyObj->setTitle($this->title);

		$copyObj->setDescription($this->description);

		$copyObj->setMetaKeywords($this->meta_keywords);

		$copyObj->setMetaDescription($this->meta_description);


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
			self::$peer = new InformationI18nPeer();
		}
		return self::$peer;
	}

	
	public function setInformation(Information $v = null)
	{
		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}

		$this->aInformation = $v;

						if ($v !== null) {
			$v->addInformationI18n($this);
		}

		return $this;
	}


	
	public function getInformation(PropelPDO $con = null)
	{
		if ($this->aInformation === null && ($this->id !== null)) {
			$this->aInformation = InformationPeer::retrieveByPk($this->id);
			
		}
		return $this->aInformation;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aInformation = null;
	}

  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInformationI18n:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInformationI18n::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }

} 