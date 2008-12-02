<?php


abstract class BaseOptionValue extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $type_id;


	
	protected $name;


	
	protected $pos = 1;


	
	protected $is_active = true;


	
	protected $is_deleted = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aOptionType;

	
	protected $collOptionValueI18ns;

	
	protected $lastOptionValueI18nCriteria = null;

	
	protected $collOptionProducts;

	
	protected $lastOptionProductCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTypeId()
	{

		return $this->type_id;
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
			$this->modifiedColumns[] = OptionValuePeer::ID;
		}

	} 
	
	public function setTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type_id !== $v) {
			$this->type_id = $v;
			$this->modifiedColumns[] = OptionValuePeer::TYPE_ID;
		}

		if ($this->aOptionType !== null && $this->aOptionType->getId() !== $v) {
			$this->aOptionType = null;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = OptionValuePeer::NAME;
		}

	} 
	
	public function setPos($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pos !== $v || $v === 1) {
			$this->pos = $v;
			$this->modifiedColumns[] = OptionValuePeer::POS;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = OptionValuePeer::IS_ACTIVE;
		}

	} 
	
	public function setIsDeleted($v)
	{

		if ($this->is_deleted !== $v || $v === false) {
			$this->is_deleted = $v;
			$this->modifiedColumns[] = OptionValuePeer::IS_DELETED;
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
			$this->modifiedColumns[] = OptionValuePeer::CREATED_AT;
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
			$this->modifiedColumns[] = OptionValuePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->type_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->pos = $rs->getInt($startcol + 3);

			$this->is_active = $rs->getBoolean($startcol + 4);

			$this->is_deleted = $rs->getBoolean($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OptionValue object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionValue:delete:pre') as $callable)
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
			$con = Propel::getConnection(OptionValuePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OptionValuePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseOptionValue:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionValue:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(OptionValuePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OptionValuePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OptionValuePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseOptionValue:save:post') as $callable)
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


												
			if ($this->aOptionType !== null) {
				if ($this->aOptionType->isModified() || ($this->aOptionType->getCulture() && $this->aOptionType->getCurrentOptionTypeI18n()->isModified())) {
					$affectedRows += $this->aOptionType->save($con);
				}
				$this->setOptionType($this->aOptionType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OptionValuePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OptionValuePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOptionValueI18ns !== null) {
				foreach($this->collOptionValueI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOptionProducts !== null) {
				foreach($this->collOptionProducts as $referrerFK) {
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


												
			if ($this->aOptionType !== null) {
				if (!$this->aOptionType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOptionType->getValidationFailures());
				}
			}


			if (($retval = OptionValuePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOptionValueI18ns !== null) {
					foreach($this->collOptionValueI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOptionProducts !== null) {
					foreach($this->collOptionProducts as $referrerFK) {
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
		$pos = OptionValuePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTypeId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getPos();
				break;
			case 4:
				return $this->getIsActive();
				break;
			case 5:
				return $this->getIsDeleted();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OptionValuePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTypeId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getPos(),
			$keys[4] => $this->getIsActive(),
			$keys[5] => $this->getIsDeleted(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OptionValuePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTypeId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setPos($value);
				break;
			case 4:
				$this->setIsActive($value);
				break;
			case 5:
				$this->setIsDeleted($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OptionValuePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPos($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsActive($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsDeleted($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OptionValuePeer::DATABASE_NAME);

		if ($this->isColumnModified(OptionValuePeer::ID)) $criteria->add(OptionValuePeer::ID, $this->id);
		if ($this->isColumnModified(OptionValuePeer::TYPE_ID)) $criteria->add(OptionValuePeer::TYPE_ID, $this->type_id);
		if ($this->isColumnModified(OptionValuePeer::NAME)) $criteria->add(OptionValuePeer::NAME, $this->name);
		if ($this->isColumnModified(OptionValuePeer::POS)) $criteria->add(OptionValuePeer::POS, $this->pos);
		if ($this->isColumnModified(OptionValuePeer::IS_ACTIVE)) $criteria->add(OptionValuePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(OptionValuePeer::IS_DELETED)) $criteria->add(OptionValuePeer::IS_DELETED, $this->is_deleted);
		if ($this->isColumnModified(OptionValuePeer::CREATED_AT)) $criteria->add(OptionValuePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OptionValuePeer::UPDATED_AT)) $criteria->add(OptionValuePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OptionValuePeer::DATABASE_NAME);

		$criteria->add(OptionValuePeer::ID, $this->id);

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

		$copyObj->setTypeId($this->type_id);

		$copyObj->setName($this->name);

		$copyObj->setPos($this->pos);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsDeleted($this->is_deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOptionValueI18ns() as $relObj) {
				$copyObj->addOptionValueI18n($relObj->copy($deepCopy));
			}

			foreach($this->getOptionProducts() as $relObj) {
				$copyObj->addOptionProduct($relObj->copy($deepCopy));
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
			self::$peer = new OptionValuePeer();
		}
		return self::$peer;
	}

	
	public function setOptionType($v)
	{


		if ($v === null) {
			$this->setTypeId(NULL);
		} else {
			$this->setTypeId($v->getId());
		}


		$this->aOptionType = $v;
	}


	
	public function getOptionType($con = null)
	{
		if ($this->aOptionType === null && ($this->type_id !== null)) {
						$this->aOptionType = OptionTypePeer::retrieveByPK($this->type_id, $con);

			
		}
		return $this->aOptionType;
	}

	
	public function initOptionValueI18ns()
	{
		if ($this->collOptionValueI18ns === null) {
			$this->collOptionValueI18ns = array();
		}
	}

	
	public function getOptionValueI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOptionValueI18ns === null) {
			if ($this->isNew()) {
			   $this->collOptionValueI18ns = array();
			} else {

				$criteria->add(OptionValueI18nPeer::ID, $this->getId());

				OptionValueI18nPeer::addSelectColumns($criteria);
				$this->collOptionValueI18ns = OptionValueI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OptionValueI18nPeer::ID, $this->getId());

				OptionValueI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastOptionValueI18nCriteria) || !$this->lastOptionValueI18nCriteria->equals($criteria)) {
					$this->collOptionValueI18ns = OptionValueI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOptionValueI18nCriteria = $criteria;
		return $this->collOptionValueI18ns;
	}

	
	public function countOptionValueI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OptionValueI18nPeer::ID, $this->getId());

		return OptionValueI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOptionValueI18n(OptionValueI18n $l)
	{
		$this->collOptionValueI18ns[] = $l;
		$l->setOptionValue($this);
	}

	
	public function initOptionProducts()
	{
		if ($this->collOptionProducts === null) {
			$this->collOptionProducts = array();
		}
	}

	
	public function getOptionProducts($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOptionProducts === null) {
			if ($this->isNew()) {
			   $this->collOptionProducts = array();
			} else {

				$criteria->add(OptionProductPeer::OPTION_VALUE_ID, $this->getId());

				OptionProductPeer::addSelectColumns($criteria);
				$this->collOptionProducts = OptionProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OptionProductPeer::OPTION_VALUE_ID, $this->getId());

				OptionProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastOptionProductCriteria) || !$this->lastOptionProductCriteria->equals($criteria)) {
					$this->collOptionProducts = OptionProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOptionProductCriteria = $criteria;
		return $this->collOptionProducts;
	}

	
	public function countOptionProducts($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OptionProductPeer::OPTION_VALUE_ID, $this->getId());

		return OptionProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOptionProduct(OptionProduct $l)
	{
		$this->collOptionProducts[] = $l;
		$l->setOptionValue($this);
	}


	
	public function getOptionProductsJoinProduct($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOptionProducts === null) {
			if ($this->isNew()) {
				$this->collOptionProducts = array();
			} else {

				$criteria->add(OptionProductPeer::OPTION_VALUE_ID, $this->getId());

				$this->collOptionProducts = OptionProductPeer::doSelectJoinProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(OptionProductPeer::OPTION_VALUE_ID, $this->getId());

			if (!isset($this->lastOptionProductCriteria) || !$this->lastOptionProductCriteria->equals($criteria)) {
				$this->collOptionProducts = OptionProductPeer::doSelectJoinProduct($criteria, $con);
			}
		}
		$this->lastOptionProductCriteria = $criteria;

		return $this->collOptionProducts;
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
    return $this->getCurrentOptionValueI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentOptionValueI18n($culture)->setTitle($value);
  }

  public function getDescription($culture = null)
  {
    return $this->getCurrentOptionValueI18n($culture)->getDescription();
  }

  public function setDescription($value, $culture = null)
  {
    $this->getCurrentOptionValueI18n($culture)->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentOptionValueI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = OptionValueI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setOptionValueI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setOptionValueI18nForCulture(new OptionValueI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setOptionValueI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addOptionValueI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseOptionValue:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseOptionValue::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 