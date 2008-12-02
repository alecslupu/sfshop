<?php


abstract class BaseCategory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $parent_id;


	
	protected $name;


	
	protected $path;


	
	protected $pos = 0;


	
	protected $has_child = 0;


	
	protected $is_active = false;


	
	protected $is_deleted = false;


	
	protected $is_locked = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aCategoryRelatedByParentId;

	
	protected $collProduct2Categorys;

	
	protected $lastProduct2CategoryCriteria = null;

	
	protected $collCategorysRelatedByParentId;

	
	protected $lastCategoryRelatedByParentIdCriteria = null;

	
	protected $collCategoryI18ns;

	
	protected $lastCategoryI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getParentId()
	{

		return $this->parent_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getPath()
	{

		return $this->path;
	}

	
	public function getPos()
	{

		return $this->pos;
	}

	
	public function getHasChild()
	{

		return $this->has_child;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getIsDeleted()
	{

		return $this->is_deleted;
	}

	
	public function getIsLocked()
	{

		return $this->is_locked;
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
			$this->modifiedColumns[] = CategoryPeer::ID;
		}

	} 
	
	public function setParentId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = CategoryPeer::PARENT_ID;
		}

		if ($this->aCategoryRelatedByParentId !== null && $this->aCategoryRelatedByParentId->getId() !== $v) {
			$this->aCategoryRelatedByParentId = null;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = CategoryPeer::NAME;
		}

	} 
	
	public function setPath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->path !== $v) {
			$this->path = $v;
			$this->modifiedColumns[] = CategoryPeer::PATH;
		}

	} 
	
	public function setPos($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pos !== $v || $v === 0) {
			$this->pos = $v;
			$this->modifiedColumns[] = CategoryPeer::POS;
		}

	} 
	
	public function setHasChild($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->has_child !== $v || $v === 0) {
			$this->has_child = $v;
			$this->modifiedColumns[] = CategoryPeer::HAS_CHILD;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = CategoryPeer::IS_ACTIVE;
		}

	} 
	
	public function setIsDeleted($v)
	{

		if ($this->is_deleted !== $v || $v === false) {
			$this->is_deleted = $v;
			$this->modifiedColumns[] = CategoryPeer::IS_DELETED;
		}

	} 
	
	public function setIsLocked($v)
	{

		if ($this->is_locked !== $v || $v === false) {
			$this->is_locked = $v;
			$this->modifiedColumns[] = CategoryPeer::IS_LOCKED;
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
			$this->modifiedColumns[] = CategoryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = CategoryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->parent_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->path = $rs->getString($startcol + 3);

			$this->pos = $rs->getInt($startcol + 4);

			$this->has_child = $rs->getInt($startcol + 5);

			$this->is_active = $rs->getBoolean($startcol + 6);

			$this->is_deleted = $rs->getBoolean($startcol + 7);

			$this->is_locked = $rs->getBoolean($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Category object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseCategory:delete:pre') as $callable)
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
			$con = Propel::getConnection(CategoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CategoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCategory:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseCategory:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(CategoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(CategoryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CategoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCategory:save:post') as $callable)
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


												
			if ($this->aCategoryRelatedByParentId !== null) {
				if ($this->aCategoryRelatedByParentId->isModified() || ($this->aCategoryRelatedByParentId->getCulture() && $this->aCategoryRelatedByParentId->getCurrentCategoryI18n()->isModified())) {
					$affectedRows += $this->aCategoryRelatedByParentId->save($con);
				}
				$this->setCategoryRelatedByParentId($this->aCategoryRelatedByParentId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CategoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CategoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collProduct2Categorys !== null) {
				foreach($this->collProduct2Categorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCategorysRelatedByParentId !== null) {
				foreach($this->collCategorysRelatedByParentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCategoryI18ns !== null) {
				foreach($this->collCategoryI18ns as $referrerFK) {
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


												
			if ($this->aCategoryRelatedByParentId !== null) {
				if (!$this->aCategoryRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCategoryRelatedByParentId->getValidationFailures());
				}
			}


			if (($retval = CategoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProduct2Categorys !== null) {
					foreach($this->collProduct2Categorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCategoryI18ns !== null) {
					foreach($this->collCategoryI18ns as $referrerFK) {
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
		$pos = CategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getParentId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getPath();
				break;
			case 4:
				return $this->getPos();
				break;
			case 5:
				return $this->getHasChild();
				break;
			case 6:
				return $this->getIsActive();
				break;
			case 7:
				return $this->getIsDeleted();
				break;
			case 8:
				return $this->getIsLocked();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			case 10:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CategoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getParentId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getPath(),
			$keys[4] => $this->getPos(),
			$keys[5] => $this->getHasChild(),
			$keys[6] => $this->getIsActive(),
			$keys[7] => $this->getIsDeleted(),
			$keys[8] => $this->getIsLocked(),
			$keys[9] => $this->getCreatedAt(),
			$keys[10] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setParentId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setPath($value);
				break;
			case 4:
				$this->setPos($value);
				break;
			case 5:
				$this->setHasChild($value);
				break;
			case 6:
				$this->setIsActive($value);
				break;
			case 7:
				$this->setIsDeleted($value);
				break;
			case 8:
				$this->setIsLocked($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
			case 10:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CategoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPath($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPos($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHasChild($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsActive($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsDeleted($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsLocked($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CategoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(CategoryPeer::ID)) $criteria->add(CategoryPeer::ID, $this->id);
		if ($this->isColumnModified(CategoryPeer::PARENT_ID)) $criteria->add(CategoryPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(CategoryPeer::NAME)) $criteria->add(CategoryPeer::NAME, $this->name);
		if ($this->isColumnModified(CategoryPeer::PATH)) $criteria->add(CategoryPeer::PATH, $this->path);
		if ($this->isColumnModified(CategoryPeer::POS)) $criteria->add(CategoryPeer::POS, $this->pos);
		if ($this->isColumnModified(CategoryPeer::HAS_CHILD)) $criteria->add(CategoryPeer::HAS_CHILD, $this->has_child);
		if ($this->isColumnModified(CategoryPeer::IS_ACTIVE)) $criteria->add(CategoryPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(CategoryPeer::IS_DELETED)) $criteria->add(CategoryPeer::IS_DELETED, $this->is_deleted);
		if ($this->isColumnModified(CategoryPeer::IS_LOCKED)) $criteria->add(CategoryPeer::IS_LOCKED, $this->is_locked);
		if ($this->isColumnModified(CategoryPeer::CREATED_AT)) $criteria->add(CategoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CategoryPeer::UPDATED_AT)) $criteria->add(CategoryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CategoryPeer::DATABASE_NAME);

		$criteria->add(CategoryPeer::ID, $this->id);

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

		$copyObj->setParentId($this->parent_id);

		$copyObj->setName($this->name);

		$copyObj->setPath($this->path);

		$copyObj->setPos($this->pos);

		$copyObj->setHasChild($this->has_child);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsDeleted($this->is_deleted);

		$copyObj->setIsLocked($this->is_locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getProduct2Categorys() as $relObj) {
				$copyObj->addProduct2Category($relObj->copy($deepCopy));
			}

			foreach($this->getCategorysRelatedByParentId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addCategoryRelatedByParentId($relObj->copy($deepCopy));
			}

			foreach($this->getCategoryI18ns() as $relObj) {
				$copyObj->addCategoryI18n($relObj->copy($deepCopy));
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
			self::$peer = new CategoryPeer();
		}
		return self::$peer;
	}

	
	public function setCategoryRelatedByParentId($v)
	{


		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}


		$this->aCategoryRelatedByParentId = $v;
	}


	
	public function getCategoryRelatedByParentId($con = null)
	{
		if ($this->aCategoryRelatedByParentId === null && ($this->parent_id !== null)) {
						$this->aCategoryRelatedByParentId = CategoryPeer::retrieveByPK($this->parent_id, $con);

			
		}
		return $this->aCategoryRelatedByParentId;
	}

	
	public function initProduct2Categorys()
	{
		if ($this->collProduct2Categorys === null) {
			$this->collProduct2Categorys = array();
		}
	}

	
	public function getProduct2Categorys($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProduct2Categorys === null) {
			if ($this->isNew()) {
			   $this->collProduct2Categorys = array();
			} else {

				$criteria->add(Product2CategoryPeer::CATEGORY_ID, $this->getId());

				Product2CategoryPeer::addSelectColumns($criteria);
				$this->collProduct2Categorys = Product2CategoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Product2CategoryPeer::CATEGORY_ID, $this->getId());

				Product2CategoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastProduct2CategoryCriteria) || !$this->lastProduct2CategoryCriteria->equals($criteria)) {
					$this->collProduct2Categorys = Product2CategoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProduct2CategoryCriteria = $criteria;
		return $this->collProduct2Categorys;
	}

	
	public function countProduct2Categorys($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Product2CategoryPeer::CATEGORY_ID, $this->getId());

		return Product2CategoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProduct2Category(Product2Category $l)
	{
		$this->collProduct2Categorys[] = $l;
		$l->setCategory($this);
	}


	
	public function getProduct2CategorysJoinProduct($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProduct2Categorys === null) {
			if ($this->isNew()) {
				$this->collProduct2Categorys = array();
			} else {

				$criteria->add(Product2CategoryPeer::CATEGORY_ID, $this->getId());

				$this->collProduct2Categorys = Product2CategoryPeer::doSelectJoinProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(Product2CategoryPeer::CATEGORY_ID, $this->getId());

			if (!isset($this->lastProduct2CategoryCriteria) || !$this->lastProduct2CategoryCriteria->equals($criteria)) {
				$this->collProduct2Categorys = Product2CategoryPeer::doSelectJoinProduct($criteria, $con);
			}
		}
		$this->lastProduct2CategoryCriteria = $criteria;

		return $this->collProduct2Categorys;
	}

	
	public function initCategorysRelatedByParentId()
	{
		if ($this->collCategorysRelatedByParentId === null) {
			$this->collCategorysRelatedByParentId = array();
		}
	}

	
	public function getCategorysRelatedByParentId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategorysRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collCategorysRelatedByParentId = array();
			} else {

				$criteria->add(CategoryPeer::PARENT_ID, $this->getId());

				CategoryPeer::addSelectColumns($criteria);
				$this->collCategorysRelatedByParentId = CategoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CategoryPeer::PARENT_ID, $this->getId());

				CategoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastCategoryRelatedByParentIdCriteria) || !$this->lastCategoryRelatedByParentIdCriteria->equals($criteria)) {
					$this->collCategorysRelatedByParentId = CategoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCategoryRelatedByParentIdCriteria = $criteria;
		return $this->collCategorysRelatedByParentId;
	}

	
	public function countCategorysRelatedByParentId($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CategoryPeer::PARENT_ID, $this->getId());

		return CategoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCategoryRelatedByParentId(Category $l)
	{
		$this->collCategorysRelatedByParentId[] = $l;
		$l->setCategoryRelatedByParentId($this);
	}

	
	public function initCategoryI18ns()
	{
		if ($this->collCategoryI18ns === null) {
			$this->collCategoryI18ns = array();
		}
	}

	
	public function getCategoryI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryI18ns === null) {
			if ($this->isNew()) {
			   $this->collCategoryI18ns = array();
			} else {

				$criteria->add(CategoryI18nPeer::ID, $this->getId());

				CategoryI18nPeer::addSelectColumns($criteria);
				$this->collCategoryI18ns = CategoryI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CategoryI18nPeer::ID, $this->getId());

				CategoryI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastCategoryI18nCriteria) || !$this->lastCategoryI18nCriteria->equals($criteria)) {
					$this->collCategoryI18ns = CategoryI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCategoryI18nCriteria = $criteria;
		return $this->collCategoryI18ns;
	}

	
	public function countCategoryI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CategoryI18nPeer::ID, $this->getId());

		return CategoryI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCategoryI18n(CategoryI18n $l)
	{
		$this->collCategoryI18ns[] = $l;
		$l->setCategory($this);
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
    return $this->getCurrentCategoryI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentCategoryI18n($culture)->setTitle($value);
  }

  public function getDescription($culture = null)
  {
    return $this->getCurrentCategoryI18n($culture)->getDescription();
  }

  public function setDescription($value, $culture = null)
  {
    $this->getCurrentCategoryI18n($culture)->setDescription($value);
  }

  public function getMetaKeywords($culture = null)
  {
    return $this->getCurrentCategoryI18n($culture)->getMetaKeywords();
  }

  public function setMetaKeywords($value, $culture = null)
  {
    $this->getCurrentCategoryI18n($culture)->setMetaKeywords($value);
  }

  public function getMetaDescription($culture = null)
  {
    return $this->getCurrentCategoryI18n($culture)->getMetaDescription();
  }

  public function setMetaDescription($value, $culture = null)
  {
    $this->getCurrentCategoryI18n($culture)->setMetaDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentCategoryI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = CategoryI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setCategoryI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setCategoryI18nForCulture(new CategoryI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setCategoryI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addCategoryI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCategory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCategory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 