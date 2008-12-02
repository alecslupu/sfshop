<?php


abstract class BaseOptionType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $pos = 1;


	
	protected $is_active = true;


	
	protected $is_deleted = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collOptionTypeI18ns;

	
	protected $lastOptionTypeI18nCriteria = null;

	
	protected $collOptionValues;

	
	protected $lastOptionValueCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getPos()
	{

		return $this->pos;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getIsDeleted()
	{

		return $this->is_deleted;
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
			$this->modifiedColumns[] = OptionTypePeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = OptionTypePeer::NAME;
		}

	} 
	
	public function setPos($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pos !== $v || $v === 1) {
			$this->pos = $v;
			$this->modifiedColumns[] = OptionTypePeer::POS;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = OptionTypePeer::IS_ACTIVE;
		}

	} 
	
	public function setIsDeleted($v)
	{

		if ($this->is_deleted !== $v || $v === false) {
			$this->is_deleted = $v;
			$this->modifiedColumns[] = OptionTypePeer::IS_DELETED;
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
			$this->modifiedColumns[] = OptionTypePeer::CREATED_AT;
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
			$this->modifiedColumns[] = OptionTypePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->pos = $rs->getInt($startcol + 2);

			$this->is_active = $rs->getBoolean($startcol + 3);

			$this->is_deleted = $rs->getBoolean($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OptionType object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionType:delete:pre') as $callable)
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
			$con = Propel::getConnection(OptionTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OptionTypePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseOptionType:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionType:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(OptionTypePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OptionTypePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OptionTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseOptionType:save:post') as $callable)
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
					$pk = OptionTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OptionTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOptionTypeI18ns !== null) {
				foreach($this->collOptionTypeI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOptionValues !== null) {
				foreach($this->collOptionValues as $referrerFK) {
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


			if (($retval = OptionTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOptionTypeI18ns !== null) {
					foreach($this->collOptionTypeI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOptionValues !== null) {
					foreach($this->collOptionValues as $referrerFK) {
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
		$pos = OptionTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getPos();
				break;
			case 3:
				return $this->getIsActive();
				break;
			case 4:
				return $this->getIsDeleted();
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
		$keys = OptionTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getPos(),
			$keys[3] => $this->getIsActive(),
			$keys[4] => $this->getIsDeleted(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OptionTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setPos($value);
				break;
			case 3:
				$this->setIsActive($value);
				break;
			case 4:
				$this->setIsDeleted($value);
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
		$keys = OptionTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPos($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsActive($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsDeleted($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OptionTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(OptionTypePeer::ID)) $criteria->add(OptionTypePeer::ID, $this->id);
		if ($this->isColumnModified(OptionTypePeer::NAME)) $criteria->add(OptionTypePeer::NAME, $this->name);
		if ($this->isColumnModified(OptionTypePeer::POS)) $criteria->add(OptionTypePeer::POS, $this->pos);
		if ($this->isColumnModified(OptionTypePeer::IS_ACTIVE)) $criteria->add(OptionTypePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(OptionTypePeer::IS_DELETED)) $criteria->add(OptionTypePeer::IS_DELETED, $this->is_deleted);
		if ($this->isColumnModified(OptionTypePeer::CREATED_AT)) $criteria->add(OptionTypePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OptionTypePeer::UPDATED_AT)) $criteria->add(OptionTypePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OptionTypePeer::DATABASE_NAME);

		$criteria->add(OptionTypePeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setPos($this->pos);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsDeleted($this->is_deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOptionTypeI18ns() as $relObj) {
				$copyObj->addOptionTypeI18n($relObj->copy($deepCopy));
			}

			foreach($this->getOptionValues() as $relObj) {
				$copyObj->addOptionValue($relObj->copy($deepCopy));
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
			self::$peer = new OptionTypePeer();
		}
		return self::$peer;
	}

	
	public function initOptionTypeI18ns()
	{
		if ($this->collOptionTypeI18ns === null) {
			$this->collOptionTypeI18ns = array();
		}
	}

	
	public function getOptionTypeI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOptionTypeI18ns === null) {
			if ($this->isNew()) {
			   $this->collOptionTypeI18ns = array();
			} else {

				$criteria->add(OptionTypeI18nPeer::ID, $this->getId());

				OptionTypeI18nPeer::addSelectColumns($criteria);
				$this->collOptionTypeI18ns = OptionTypeI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OptionTypeI18nPeer::ID, $this->getId());

				OptionTypeI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastOptionTypeI18nCriteria) || !$this->lastOptionTypeI18nCriteria->equals($criteria)) {
					$this->collOptionTypeI18ns = OptionTypeI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOptionTypeI18nCriteria = $criteria;
		return $this->collOptionTypeI18ns;
	}

	
	public function countOptionTypeI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OptionTypeI18nPeer::ID, $this->getId());

		return OptionTypeI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOptionTypeI18n(OptionTypeI18n $l)
	{
		$this->collOptionTypeI18ns[] = $l;
		$l->setOptionType($this);
	}

	
	public function initOptionValues()
	{
		if ($this->collOptionValues === null) {
			$this->collOptionValues = array();
		}
	}

	
	public function getOptionValues($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOptionValues === null) {
			if ($this->isNew()) {
			   $this->collOptionValues = array();
			} else {

				$criteria->add(OptionValuePeer::TYPE_ID, $this->getId());

				OptionValuePeer::addSelectColumns($criteria);
				$this->collOptionValues = OptionValuePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OptionValuePeer::TYPE_ID, $this->getId());

				OptionValuePeer::addSelectColumns($criteria);
				if (!isset($this->lastOptionValueCriteria) || !$this->lastOptionValueCriteria->equals($criteria)) {
					$this->collOptionValues = OptionValuePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOptionValueCriteria = $criteria;
		return $this->collOptionValues;
	}

	
	public function countOptionValues($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OptionValuePeer::TYPE_ID, $this->getId());

		return OptionValuePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOptionValue(OptionValue $l)
	{
		$this->collOptionValues[] = $l;
		$l->setOptionType($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getTitle($culture = null)
  {
    return $this->getCurrentOptionTypeI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentOptionTypeI18n($culture)->setTitle($value);
  }

  public function getDescription($culture = null)
  {
    return $this->getCurrentOptionTypeI18n($culture)->getDescription();
  }

  public function setDescription($value, $culture = null)
  {
    $this->getCurrentOptionTypeI18n($culture)->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentOptionTypeI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = OptionTypeI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setOptionTypeI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setOptionTypeI18nForCulture(new OptionTypeI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setOptionTypeI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addOptionTypeI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseOptionType:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseOptionType::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 