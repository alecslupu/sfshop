<?php


abstract class BaseAssetType extends BaseObject  implements Persistent {


  const PEER = 'AssetTypePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $model;

	
	protected $has_thumbnail;

	
	protected $has_i18n;

	
	protected $collThumbnailTypeAssetTypes;

	
	private $lastThumbnailTypeAssetTypeCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function applyDefaultValues()
	{
		$this->has_thumbnail = 0;
		$this->has_i18n = 0;
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

	
	public function getName()
	{
		return $this->name;
	}

	
	public function getModel()
	{
		return $this->model;
	}

	
	public function getHasThumbnail()
	{
		return $this->has_thumbnail;
	}

	
	public function getHasI18n()
	{
		return $this->has_i18n;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AssetTypePeer::ID;
		}

		return $this;
	} 
	
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = AssetTypePeer::NAME;
		}

		return $this;
	} 
	
	public function setModel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->model !== $v) {
			$this->model = $v;
			$this->modifiedColumns[] = AssetTypePeer::MODEL;
		}

		return $this;
	} 
	
	public function setHasThumbnail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->has_thumbnail !== $v || $this->isNew()) {
			$this->has_thumbnail = $v;
			$this->modifiedColumns[] = AssetTypePeer::HAS_THUMBNAIL;
		}

		return $this;
	} 
	
	public function setHasI18n($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->has_i18n !== $v || $this->isNew()) {
			$this->has_i18n = $v;
			$this->modifiedColumns[] = AssetTypePeer::HAS_I18N;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
			if ($this->has_thumbnail !== 0) {
				return false;
			}

			if ($this->has_i18n !== 0) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->model = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->has_thumbnail = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->has_i18n = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AssetType object", $e);
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
			$con = Propel::getConnection(AssetTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AssetTypePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collThumbnailTypeAssetTypes = null;
			$this->lastThumbnailTypeAssetTypeCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAssetType:delete:pre') as $callable)
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
			$con = Propel::getConnection(AssetTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				AssetTypePeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseAssetType:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAssetType:save:pre') as $callable)
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
			$con = Propel::getConnection(AssetTypePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				AssetTypePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseAssetType:save:post') as $callable)
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
				$this->modifiedColumns[] = AssetTypePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AssetTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AssetTypePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collThumbnailTypeAssetTypes !== null) {
				foreach ($this->collThumbnailTypeAssetTypes as $referrerFK) {
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


			if (($retval = AssetTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collThumbnailTypeAssetTypes !== null) {
					foreach ($this->collThumbnailTypeAssetTypes as $referrerFK) {
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
		$pos = AssetTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getModel();
				break;
			case 3:
				return $this->getHasThumbnail();
				break;
			case 4:
				return $this->getHasI18n();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AssetTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getModel(),
			$keys[3] => $this->getHasThumbnail(),
			$keys[4] => $this->getHasI18n(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AssetTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setModel($value);
				break;
			case 3:
				$this->setHasThumbnail($value);
				break;
			case 4:
				$this->setHasI18n($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AssetTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setModel($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHasThumbnail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHasI18n($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AssetTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(AssetTypePeer::ID)) $criteria->add(AssetTypePeer::ID, $this->id);
		if ($this->isColumnModified(AssetTypePeer::NAME)) $criteria->add(AssetTypePeer::NAME, $this->name);
		if ($this->isColumnModified(AssetTypePeer::MODEL)) $criteria->add(AssetTypePeer::MODEL, $this->model);
		if ($this->isColumnModified(AssetTypePeer::HAS_THUMBNAIL)) $criteria->add(AssetTypePeer::HAS_THUMBNAIL, $this->has_thumbnail);
		if ($this->isColumnModified(AssetTypePeer::HAS_I18N)) $criteria->add(AssetTypePeer::HAS_I18N, $this->has_i18n);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AssetTypePeer::DATABASE_NAME);

		$criteria->add(AssetTypePeer::ID, $this->id);

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

		$copyObj->setModel($this->model);

		$copyObj->setHasThumbnail($this->has_thumbnail);

		$copyObj->setHasI18n($this->has_i18n);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getThumbnailTypeAssetTypes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addThumbnailTypeAssetType($relObj->copy($deepCopy));
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
			self::$peer = new AssetTypePeer();
		}
		return self::$peer;
	}

	
	public function clearThumbnailTypeAssetTypes()
	{
		$this->collThumbnailTypeAssetTypes = null; 	}

	
	public function initThumbnailTypeAssetTypes()
	{
		$this->collThumbnailTypeAssetTypes = array();
	}

	
	public function getThumbnailTypeAssetTypes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AssetTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnailTypeAssetTypes === null) {
			if ($this->isNew()) {
			   $this->collThumbnailTypeAssetTypes = array();
			} else {

				$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->id);

				ThumbnailTypeAssetTypePeer::addSelectColumns($criteria);
				$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->id);

				ThumbnailTypeAssetTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastThumbnailTypeAssetTypeCriteria) || !$this->lastThumbnailTypeAssetTypeCriteria->equals($criteria)) {
					$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastThumbnailTypeAssetTypeCriteria = $criteria;
		return $this->collThumbnailTypeAssetTypes;
	}

	
	public function countThumbnailTypeAssetTypes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AssetTypePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collThumbnailTypeAssetTypes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->id);

				$count = ThumbnailTypeAssetTypePeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->id);

				if (!isset($this->lastThumbnailTypeAssetTypeCriteria) || !$this->lastThumbnailTypeAssetTypeCriteria->equals($criteria)) {
					$count = ThumbnailTypeAssetTypePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collThumbnailTypeAssetTypes);
				}
			} else {
				$count = count($this->collThumbnailTypeAssetTypes);
			}
		}
		return $count;
	}

	
	public function addThumbnailTypeAssetType(ThumbnailTypeAssetType $l)
	{
		if ($this->collThumbnailTypeAssetTypes === null) {
			$this->initThumbnailTypeAssetTypes();
		}
		if (!in_array($l, $this->collThumbnailTypeAssetTypes, true)) { 			array_push($this->collThumbnailTypeAssetTypes, $l);
			$l->setAssetType($this);
		}
	}


	
	public function getThumbnailTypeAssetTypesJoinThumbnailType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AssetTypePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnailTypeAssetTypes === null) {
			if ($this->isNew()) {
				$this->collThumbnailTypeAssetTypes = array();
			} else {

				$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->id);

				$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelectJoinThumbnailType($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->id);

			if (!isset($this->lastThumbnailTypeAssetTypeCriteria) || !$this->lastThumbnailTypeAssetTypeCriteria->equals($criteria)) {
				$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelectJoinThumbnailType($criteria, $con, $join_behavior);
			}
		}
		$this->lastThumbnailTypeAssetTypeCriteria = $criteria;

		return $this->collThumbnailTypeAssetTypes;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collThumbnailTypeAssetTypes) {
				foreach ((array) $this->collThumbnailTypeAssetTypes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collThumbnailTypeAssetTypes = null;
	}

  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAssetType:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAssetType::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }

} 