<?php


abstract class BaseAssetType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $model;


	
	protected $has_thumbnail = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collThumbnailTypeAssetTypes;

	
	protected $lastThumbnailTypeAssetTypeCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
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
			$this->modifiedColumns[] = AssetTypePeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = AssetTypePeer::NAME;
		}

	} 
	
	public function setModel($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->model !== $v) {
			$this->model = $v;
			$this->modifiedColumns[] = AssetTypePeer::MODEL;
		}

	} 
	
	public function setHasThumbnail($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->has_thumbnail !== $v || $v === 0) {
			$this->has_thumbnail = $v;
			$this->modifiedColumns[] = AssetTypePeer::HAS_THUMBNAIL;
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
			$this->modifiedColumns[] = AssetTypePeer::CREATED_AT;
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
			$this->modifiedColumns[] = AssetTypePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->model = $rs->getString($startcol + 2);

			$this->has_thumbnail = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AssetType object", $e);
		}
	}

	
	public function delete($con = null)
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
			$con = Propel::getConnection(AssetTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AssetTypePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAssetType:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAssetType:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(AssetTypePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(AssetTypePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AssetTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAssetType:save:post') as $callable)
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
					$pk = AssetTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AssetTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collThumbnailTypeAssetTypes !== null) {
				foreach($this->collThumbnailTypeAssetTypes as $referrerFK) {
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
					foreach($this->collThumbnailTypeAssetTypes as $referrerFK) {
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
				return $this->getModel();
				break;
			case 3:
				return $this->getHasThumbnail();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AssetTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getModel(),
			$keys[3] => $this->getHasThumbnail(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
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
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AssetTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setModel($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHasThumbnail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AssetTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(AssetTypePeer::ID)) $criteria->add(AssetTypePeer::ID, $this->id);
		if ($this->isColumnModified(AssetTypePeer::NAME)) $criteria->add(AssetTypePeer::NAME, $this->name);
		if ($this->isColumnModified(AssetTypePeer::MODEL)) $criteria->add(AssetTypePeer::MODEL, $this->model);
		if ($this->isColumnModified(AssetTypePeer::HAS_THUMBNAIL)) $criteria->add(AssetTypePeer::HAS_THUMBNAIL, $this->has_thumbnail);
		if ($this->isColumnModified(AssetTypePeer::CREATED_AT)) $criteria->add(AssetTypePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AssetTypePeer::UPDATED_AT)) $criteria->add(AssetTypePeer::UPDATED_AT, $this->updated_at);

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

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getThumbnailTypeAssetTypes() as $relObj) {
				$copyObj->addThumbnailTypeAssetType($relObj->copy($deepCopy));
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

	
	public function initThumbnailTypeAssetTypes()
	{
		if ($this->collThumbnailTypeAssetTypes === null) {
			$this->collThumbnailTypeAssetTypes = array();
		}
	}

	
	public function getThumbnailTypeAssetTypes($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnailTypeAssetTypes === null) {
			if ($this->isNew()) {
			   $this->collThumbnailTypeAssetTypes = array();
			} else {

				$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->getId());

				ThumbnailTypeAssetTypePeer::addSelectColumns($criteria);
				$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->getId());

				ThumbnailTypeAssetTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastThumbnailTypeAssetTypeCriteria) || !$this->lastThumbnailTypeAssetTypeCriteria->equals($criteria)) {
					$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastThumbnailTypeAssetTypeCriteria = $criteria;
		return $this->collThumbnailTypeAssetTypes;
	}

	
	public function countThumbnailTypeAssetTypes($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->getId());

		return ThumbnailTypeAssetTypePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addThumbnailTypeAssetType(ThumbnailTypeAssetType $l)
	{
		$this->collThumbnailTypeAssetTypes[] = $l;
		$l->setAssetType($this);
	}


	
	public function getThumbnailTypeAssetTypesJoinThumbnailType($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnailTypeAssetTypes === null) {
			if ($this->isNew()) {
				$this->collThumbnailTypeAssetTypes = array();
			} else {

				$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->getId());

				$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelectJoinThumbnailType($criteria, $con);
			}
		} else {
									
			$criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->getId());

			if (!isset($this->lastThumbnailTypeAssetTypeCriteria) || !$this->lastThumbnailTypeAssetTypeCriteria->equals($criteria)) {
				$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelectJoinThumbnailType($criteria, $con);
			}
		}
		$this->lastThumbnailTypeAssetTypeCriteria = $criteria;

		return $this->collThumbnailTypeAssetTypes;
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