<?php


abstract class BaseThumbnailTypeAssetType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $thumbnail_type_id;


	
	protected $asset_type_id;


	
	protected $thumbnail_type_name;


	
	protected $width = 0;


	
	protected $height = 0;


	
	protected $is_trim = false;


	
	protected $is_active = false;


	
	protected $created_at;

	
	protected $aThumbnailType;

	
	protected $aAssetType;

	
	protected $collThumbnails;

	
	protected $lastThumbnailCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getThumbnailTypeId()
	{

		return $this->thumbnail_type_id;
	}

	
	public function getAssetTypeId()
	{

		return $this->asset_type_id;
	}

	
	public function getThumbnailTypeName()
	{

		return $this->thumbnail_type_name;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getIsTrim()
	{

		return $this->is_trim;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ThumbnailTypeAssetTypePeer::ID;
		}

	} 
	
	public function setThumbnailTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->thumbnail_type_id !== $v) {
			$this->thumbnail_type_id = $v;
			$this->modifiedColumns[] = ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID;
		}

		if ($this->aThumbnailType !== null && $this->aThumbnailType->getId() !== $v) {
			$this->aThumbnailType = null;
		}

	} 
	
	public function setAssetTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->asset_type_id !== $v) {
			$this->asset_type_id = $v;
			$this->modifiedColumns[] = ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID;
		}

		if ($this->aAssetType !== null && $this->aAssetType->getId() !== $v) {
			$this->aAssetType = null;
		}

	} 
	
	public function setThumbnailTypeName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->thumbnail_type_name !== $v) {
			$this->thumbnail_type_name = $v;
			$this->modifiedColumns[] = ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v || $v === 0) {
			$this->width = $v;
			$this->modifiedColumns[] = ThumbnailTypeAssetTypePeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v || $v === 0) {
			$this->height = $v;
			$this->modifiedColumns[] = ThumbnailTypeAssetTypePeer::HEIGHT;
		}

	} 
	
	public function setIsTrim($v)
	{

		if ($this->is_trim !== $v || $v === false) {
			$this->is_trim = $v;
			$this->modifiedColumns[] = ThumbnailTypeAssetTypePeer::IS_TRIM;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = ThumbnailTypeAssetTypePeer::IS_ACTIVE;
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
			$this->modifiedColumns[] = ThumbnailTypeAssetTypePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->thumbnail_type_id = $rs->getInt($startcol + 1);

			$this->asset_type_id = $rs->getInt($startcol + 2);

			$this->thumbnail_type_name = $rs->getString($startcol + 3);

			$this->width = $rs->getInt($startcol + 4);

			$this->height = $rs->getInt($startcol + 5);

			$this->is_trim = $rs->getBoolean($startcol + 6);

			$this->is_active = $rs->getBoolean($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ThumbnailTypeAssetType object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetType:delete:pre') as $callable)
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
			$con = Propel::getConnection(ThumbnailTypeAssetTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ThumbnailTypeAssetTypePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetType:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetType:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ThumbnailTypeAssetTypePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ThumbnailTypeAssetTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetType:save:post') as $callable)
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


												
			if ($this->aThumbnailType !== null) {
				if ($this->aThumbnailType->isModified()) {
					$affectedRows += $this->aThumbnailType->save($con);
				}
				$this->setThumbnailType($this->aThumbnailType);
			}

			if ($this->aAssetType !== null) {
				if ($this->aAssetType->isModified()) {
					$affectedRows += $this->aAssetType->save($con);
				}
				$this->setAssetType($this->aAssetType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ThumbnailTypeAssetTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ThumbnailTypeAssetTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collThumbnails !== null) {
				foreach($this->collThumbnails as $referrerFK) {
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


												
			if ($this->aThumbnailType !== null) {
				if (!$this->aThumbnailType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aThumbnailType->getValidationFailures());
				}
			}

			if ($this->aAssetType !== null) {
				if (!$this->aAssetType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAssetType->getValidationFailures());
				}
			}


			if (($retval = ThumbnailTypeAssetTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collThumbnails !== null) {
					foreach($this->collThumbnails as $referrerFK) {
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
		$pos = ThumbnailTypeAssetTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getThumbnailTypeId();
				break;
			case 2:
				return $this->getAssetTypeId();
				break;
			case 3:
				return $this->getThumbnailTypeName();
				break;
			case 4:
				return $this->getWidth();
				break;
			case 5:
				return $this->getHeight();
				break;
			case 6:
				return $this->getIsTrim();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThumbnailTypeAssetTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getThumbnailTypeId(),
			$keys[2] => $this->getAssetTypeId(),
			$keys[3] => $this->getThumbnailTypeName(),
			$keys[4] => $this->getWidth(),
			$keys[5] => $this->getHeight(),
			$keys[6] => $this->getIsTrim(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ThumbnailTypeAssetTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setThumbnailTypeId($value);
				break;
			case 2:
				$this->setAssetTypeId($value);
				break;
			case 3:
				$this->setThumbnailTypeName($value);
				break;
			case 4:
				$this->setWidth($value);
				break;
			case 5:
				$this->setHeight($value);
				break;
			case 6:
				$this->setIsTrim($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThumbnailTypeAssetTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setThumbnailTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAssetTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setThumbnailTypeName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setWidth($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHeight($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsTrim($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ThumbnailTypeAssetTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(ThumbnailTypeAssetTypePeer::ID)) $criteria->add(ThumbnailTypeAssetTypePeer::ID, $this->id);
		if ($this->isColumnModified(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID)) $criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, $this->thumbnail_type_id);
		if ($this->isColumnModified(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID)) $criteria->add(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, $this->asset_type_id);
		if ($this->isColumnModified(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME)) $criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME, $this->thumbnail_type_name);
		if ($this->isColumnModified(ThumbnailTypeAssetTypePeer::WIDTH)) $criteria->add(ThumbnailTypeAssetTypePeer::WIDTH, $this->width);
		if ($this->isColumnModified(ThumbnailTypeAssetTypePeer::HEIGHT)) $criteria->add(ThumbnailTypeAssetTypePeer::HEIGHT, $this->height);
		if ($this->isColumnModified(ThumbnailTypeAssetTypePeer::IS_TRIM)) $criteria->add(ThumbnailTypeAssetTypePeer::IS_TRIM, $this->is_trim);
		if ($this->isColumnModified(ThumbnailTypeAssetTypePeer::IS_ACTIVE)) $criteria->add(ThumbnailTypeAssetTypePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(ThumbnailTypeAssetTypePeer::CREATED_AT)) $criteria->add(ThumbnailTypeAssetTypePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ThumbnailTypeAssetTypePeer::DATABASE_NAME);

		$criteria->add(ThumbnailTypeAssetTypePeer::ID, $this->id);

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

		$copyObj->setThumbnailTypeId($this->thumbnail_type_id);

		$copyObj->setAssetTypeId($this->asset_type_id);

		$copyObj->setThumbnailTypeName($this->thumbnail_type_name);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setIsTrim($this->is_trim);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getThumbnails() as $relObj) {
				$copyObj->addThumbnail($relObj->copy($deepCopy));
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
			self::$peer = new ThumbnailTypeAssetTypePeer();
		}
		return self::$peer;
	}

	
	public function setThumbnailType($v)
	{


		if ($v === null) {
			$this->setThumbnailTypeId(NULL);
		} else {
			$this->setThumbnailTypeId($v->getId());
		}


		$this->aThumbnailType = $v;
	}


	
	public function getThumbnailType($con = null)
	{
		if ($this->aThumbnailType === null && ($this->thumbnail_type_id !== null)) {
						$this->aThumbnailType = ThumbnailTypePeer::retrieveByPK($this->thumbnail_type_id, $con);

			
		}
		return $this->aThumbnailType;
	}

	
	public function setAssetType($v)
	{


		if ($v === null) {
			$this->setAssetTypeId(NULL);
		} else {
			$this->setAssetTypeId($v->getId());
		}


		$this->aAssetType = $v;
	}


	
	public function getAssetType($con = null)
	{
		if ($this->aAssetType === null && ($this->asset_type_id !== null)) {
						$this->aAssetType = AssetTypePeer::retrieveByPK($this->asset_type_id, $con);

			
		}
		return $this->aAssetType;
	}

	
	public function initThumbnails()
	{
		if ($this->collThumbnails === null) {
			$this->collThumbnails = array();
		}
	}

	
	public function getThumbnails($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnails === null) {
			if ($this->isNew()) {
			   $this->collThumbnails = array();
			} else {

				$criteria->add(ThumbnailPeer::TTAT_ID, $this->getId());

				ThumbnailPeer::addSelectColumns($criteria);
				$this->collThumbnails = ThumbnailPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ThumbnailPeer::TTAT_ID, $this->getId());

				ThumbnailPeer::addSelectColumns($criteria);
				if (!isset($this->lastThumbnailCriteria) || !$this->lastThumbnailCriteria->equals($criteria)) {
					$this->collThumbnails = ThumbnailPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastThumbnailCriteria = $criteria;
		return $this->collThumbnails;
	}

	
	public function countThumbnails($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ThumbnailPeer::TTAT_ID, $this->getId());

		return ThumbnailPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addThumbnail(Thumbnail $l)
	{
		$this->collThumbnails[] = $l;
		$l->setThumbnailTypeAssetType($this);
	}


	
	public function getThumbnailsJoinThumbnailRelatedByParentId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnails === null) {
			if ($this->isNew()) {
				$this->collThumbnails = array();
			} else {

				$criteria->add(ThumbnailPeer::TTAT_ID, $this->getId());

				$this->collThumbnails = ThumbnailPeer::doSelectJoinThumbnailRelatedByParentId($criteria, $con);
			}
		} else {
									
			$criteria->add(ThumbnailPeer::TTAT_ID, $this->getId());

			if (!isset($this->lastThumbnailCriteria) || !$this->lastThumbnailCriteria->equals($criteria)) {
				$this->collThumbnails = ThumbnailPeer::doSelectJoinThumbnailRelatedByParentId($criteria, $con);
			}
		}
		$this->lastThumbnailCriteria = $criteria;

		return $this->collThumbnails;
	}


	
	public function getThumbnailsJoinThumbnailMime($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnails === null) {
			if ($this->isNew()) {
				$this->collThumbnails = array();
			} else {

				$criteria->add(ThumbnailPeer::TTAT_ID, $this->getId());

				$this->collThumbnails = ThumbnailPeer::doSelectJoinThumbnailMime($criteria, $con);
			}
		} else {
									
			$criteria->add(ThumbnailPeer::TTAT_ID, $this->getId());

			if (!isset($this->lastThumbnailCriteria) || !$this->lastThumbnailCriteria->equals($criteria)) {
				$this->collThumbnails = ThumbnailPeer::doSelectJoinThumbnailMime($criteria, $con);
			}
		}
		$this->lastThumbnailCriteria = $criteria;

		return $this->collThumbnails;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseThumbnailTypeAssetType:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseThumbnailTypeAssetType::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 