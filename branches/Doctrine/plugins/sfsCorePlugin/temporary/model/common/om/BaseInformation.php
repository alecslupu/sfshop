<?php


abstract class BaseInformation extends BaseObject  implements Persistent {


  const PEER = 'InformationPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $is_active;

	
	protected $created_at;

	
	protected $updated_at;

	
	protected $collInformationI18ns;

	
	private $lastInformationI18nCriteria = null;

	
	protected $collCategorys;

	
	private $lastCategoryCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function applyDefaultValues()
	{
		$this->is_active = true;
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

	
	public function getIsActive()
	{
		return $this->is_active;
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

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = InformationPeer::ID;
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
			$this->modifiedColumns[] = InformationPeer::IS_ACTIVE;
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
				$this->modifiedColumns[] = InformationPeer::CREATED_AT;
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
				$this->modifiedColumns[] = InformationPeer::UPDATED_AT;
			}
		} 
		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
			if ($this->is_active !== true) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->is_active = ($row[$startcol + 1] !== null) ? (boolean) $row[$startcol + 1] : null;
			$this->created_at = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->updated_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Information object", $e);
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
			$con = Propel::getConnection(InformationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InformationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collInformationI18ns = null;
			$this->lastInformationI18nCriteria = null;

			$this->collCategorys = null;
			$this->lastCategoryCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformation:delete:pre') as $callable)
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
			$con = Propel::getConnection(InformationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				InformationPeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseInformation:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformation:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(InformationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(InformationPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InformationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				InformationPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseInformation:save:post') as $callable)
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
				$this->modifiedColumns[] = InformationPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InformationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += InformationPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collInformationI18ns !== null) {
				foreach ($this->collInformationI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCategorys !== null) {
				foreach ($this->collCategorys as $referrerFK) {
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


			if (($retval = InformationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInformationI18ns !== null) {
					foreach ($this->collInformationI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCategorys !== null) {
					foreach ($this->collCategorys as $referrerFK) {
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
		$pos = InformationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIsActive();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InformationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIsActive(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InformationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIsActive($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InformationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIsActive($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InformationPeer::DATABASE_NAME);

		if ($this->isColumnModified(InformationPeer::ID)) $criteria->add(InformationPeer::ID, $this->id);
		if ($this->isColumnModified(InformationPeer::IS_ACTIVE)) $criteria->add(InformationPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(InformationPeer::CREATED_AT)) $criteria->add(InformationPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(InformationPeer::UPDATED_AT)) $criteria->add(InformationPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InformationPeer::DATABASE_NAME);

		$criteria->add(InformationPeer::ID, $this->id);

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

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getInformationI18ns() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInformationI18n($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCategorys() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCategory($relObj->copy($deepCopy));
				}
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
			self::$peer = new InformationPeer();
		}
		return self::$peer;
	}

	
	public function clearInformationI18ns()
	{
		$this->collInformationI18ns = null; 	}

	
	public function initInformationI18ns()
	{
		$this->collInformationI18ns = array();
	}

	
	public function getInformationI18ns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InformationPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationI18ns === null) {
			if ($this->isNew()) {
			   $this->collInformationI18ns = array();
			} else {

				$criteria->add(InformationI18nPeer::ID, $this->id);

				InformationI18nPeer::addSelectColumns($criteria);
				$this->collInformationI18ns = InformationI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationI18nPeer::ID, $this->id);

				InformationI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformationI18nCriteria) || !$this->lastInformationI18nCriteria->equals($criteria)) {
					$this->collInformationI18ns = InformationI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformationI18nCriteria = $criteria;
		return $this->collInformationI18ns;
	}

	
	public function countInformationI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InformationPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInformationI18ns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InformationI18nPeer::ID, $this->id);

				$count = InformationI18nPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationI18nPeer::ID, $this->id);

				if (!isset($this->lastInformationI18nCriteria) || !$this->lastInformationI18nCriteria->equals($criteria)) {
					$count = InformationI18nPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collInformationI18ns);
				}
			} else {
				$count = count($this->collInformationI18ns);
			}
		}
		return $count;
	}

	
	public function addInformationI18n(InformationI18n $l)
	{
		if ($this->collInformationI18ns === null) {
			$this->initInformationI18ns();
		}
		if (!in_array($l, $this->collInformationI18ns, true)) { 			array_push($this->collInformationI18ns, $l);
			$l->setInformation($this);
		}
	}

	
	public function clearCategorys()
	{
		$this->collCategorys = null; 	}

	
	public function initCategorys()
	{
		$this->collCategorys = array();
	}

	
	public function getCategorys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InformationPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategorys === null) {
			if ($this->isNew()) {
			   $this->collCategorys = array();
			} else {

				$criteria->add(CategoryPeer::INFORMATION_ID, $this->id);

				CategoryPeer::addSelectColumns($criteria);
				$this->collCategorys = CategoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CategoryPeer::INFORMATION_ID, $this->id);

				CategoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastCategoryCriteria) || !$this->lastCategoryCriteria->equals($criteria)) {
					$this->collCategorys = CategoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCategoryCriteria = $criteria;
		return $this->collCategorys;
	}

	
	public function countCategorys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InformationPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCategorys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CategoryPeer::INFORMATION_ID, $this->id);

				$count = CategoryPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CategoryPeer::INFORMATION_ID, $this->id);

				if (!isset($this->lastCategoryCriteria) || !$this->lastCategoryCriteria->equals($criteria)) {
					$count = CategoryPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collCategorys);
				}
			} else {
				$count = count($this->collCategorys);
			}
		}
		return $count;
	}

	
	public function addCategory(Category $l)
	{
		if ($this->collCategorys === null) {
			$this->initCategorys();
		}
		if (!in_array($l, $this->collCategorys, true)) { 			array_push($this->collCategorys, $l);
			$l->setInformation($this);
		}
	}


	
	public function getCategorysJoinCategoryRelatedByParentId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InformationPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategorys === null) {
			if ($this->isNew()) {
				$this->collCategorys = array();
			} else {

				$criteria->add(CategoryPeer::INFORMATION_ID, $this->id);

				$this->collCategorys = CategoryPeer::doSelectJoinCategoryRelatedByParentId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CategoryPeer::INFORMATION_ID, $this->id);

			if (!isset($this->lastCategoryCriteria) || !$this->lastCategoryCriteria->equals($criteria)) {
				$this->collCategorys = CategoryPeer::doSelectJoinCategoryRelatedByParentId($criteria, $con, $join_behavior);
			}
		}
		$this->lastCategoryCriteria = $criteria;

		return $this->collCategorys;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collInformationI18ns) {
				foreach ((array) $this->collInformationI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCategorys) {
				foreach ((array) $this->collCategorys as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collInformationI18ns = null;
		$this->collCategorys = null;
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
    return $this->getCurrentInformationI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentInformationI18n($culture)->setTitle($value);
  }

  public function getDescription($culture = null)
  {
    return $this->getCurrentInformationI18n($culture)->getDescription();
  }

  public function setDescription($value, $culture = null)
  {
    $this->getCurrentInformationI18n($culture)->setDescription($value);
  }

  public function getMetaKeywords($culture = null)
  {
    return $this->getCurrentInformationI18n($culture)->getMetaKeywords();
  }

  public function setMetaKeywords($value, $culture = null)
  {
    $this->getCurrentInformationI18n($culture)->setMetaKeywords($value);
  }

  public function getMetaDescription($culture = null)
  {
    return $this->getCurrentInformationI18n($culture)->getMetaDescription();
  }

  public function setMetaDescription($value, $culture = null)
  {
    $this->getCurrentInformationI18n($culture)->setMetaDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentInformationI18n($culture = null)
  {
    if (null === $culture)
    {
      $culture = null === $this->culture ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = $this->isNew() ? null : InformationI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setInformationI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setInformationI18nForCulture(new InformationI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setInformationI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addInformationI18n($object);
  }

  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInformation:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInformation::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }

} 