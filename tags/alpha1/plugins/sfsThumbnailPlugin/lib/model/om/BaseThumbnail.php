<?php


abstract class BaseThumbnail extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $parent_id;


	
	protected $ttat_id;


	
	protected $mime_id;


	
	protected $asset_id;


	
	protected $uuid;


	
	protected $asset_type_model;


	
	protected $mime_extension;


	
	protected $path;


	
	protected $is_blank = false;


	
	protected $is_converted = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aThumbnailRelatedByParentId;

	
	protected $aThumbnailTypeAssetType;

	
	protected $aThumbnailMime;

	
	protected $collThumbnailsRelatedByParentId;

	
	protected $lastThumbnailRelatedByParentIdCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getParentId()
	{

		return $this->parent_id;
	}

	
	public function getTtatId()
	{

		return $this->ttat_id;
	}

	
	public function getMimeId()
	{

		return $this->mime_id;
	}

	
	public function getAssetId()
	{

		return $this->asset_id;
	}

	
	public function getUuid()
	{

		return $this->uuid;
	}

	
	public function getAssetTypeModel()
	{

		return $this->asset_type_model;
	}

	
	public function getMimeExtension()
	{

		return $this->mime_extension;
	}

	
	public function getPath()
	{

		return $this->path;
	}

	
	public function getIsBlank()
	{

		return $this->is_blank;
	}

	
	public function getIsConverted()
	{

		return $this->is_converted;
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
			$this->modifiedColumns[] = ThumbnailPeer::ID;
		}

	} 
	
	public function setParentId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = ThumbnailPeer::PARENT_ID;
		}

		if ($this->aThumbnailRelatedByParentId !== null && $this->aThumbnailRelatedByParentId->getId() !== $v) {
			$this->aThumbnailRelatedByParentId = null;
		}

	} 
	
	public function setTtatId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ttat_id !== $v) {
			$this->ttat_id = $v;
			$this->modifiedColumns[] = ThumbnailPeer::TTAT_ID;
		}

		if ($this->aThumbnailTypeAssetType !== null && $this->aThumbnailTypeAssetType->getId() !== $v) {
			$this->aThumbnailTypeAssetType = null;
		}

	} 
	
	public function setMimeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mime_id !== $v) {
			$this->mime_id = $v;
			$this->modifiedColumns[] = ThumbnailPeer::MIME_ID;
		}

		if ($this->aThumbnailMime !== null && $this->aThumbnailMime->getId() !== $v) {
			$this->aThumbnailMime = null;
		}

	} 
	
	public function setAssetId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->asset_id !== $v) {
			$this->asset_id = $v;
			$this->modifiedColumns[] = ThumbnailPeer::ASSET_ID;
		}

	} 
	
	public function setUuid($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uuid !== $v) {
			$this->uuid = $v;
			$this->modifiedColumns[] = ThumbnailPeer::UUID;
		}

	} 
	
	public function setAssetTypeModel($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->asset_type_model !== $v) {
			$this->asset_type_model = $v;
			$this->modifiedColumns[] = ThumbnailPeer::ASSET_TYPE_MODEL;
		}

	} 
	
	public function setMimeExtension($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mime_extension !== $v) {
			$this->mime_extension = $v;
			$this->modifiedColumns[] = ThumbnailPeer::MIME_EXTENSION;
		}

	} 
	
	public function setPath($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->path !== $v) {
			$this->path = $v;
			$this->modifiedColumns[] = ThumbnailPeer::PATH;
		}

	} 
	
	public function setIsBlank($v)
	{

		if ($this->is_blank !== $v || $v === false) {
			$this->is_blank = $v;
			$this->modifiedColumns[] = ThumbnailPeer::IS_BLANK;
		}

	} 
	
	public function setIsConverted($v)
	{

		if ($this->is_converted !== $v || $v === false) {
			$this->is_converted = $v;
			$this->modifiedColumns[] = ThumbnailPeer::IS_CONVERTED;
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
			$this->modifiedColumns[] = ThumbnailPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ThumbnailPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->parent_id = $rs->getInt($startcol + 1);

			$this->ttat_id = $rs->getInt($startcol + 2);

			$this->mime_id = $rs->getInt($startcol + 3);

			$this->asset_id = $rs->getInt($startcol + 4);

			$this->uuid = $rs->getString($startcol + 5);

			$this->asset_type_model = $rs->getString($startcol + 6);

			$this->mime_extension = $rs->getString($startcol + 7);

			$this->path = $rs->getString($startcol + 8);

			$this->is_blank = $rs->getBoolean($startcol + 9);

			$this->is_converted = $rs->getBoolean($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Thumbnail object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnail:delete:pre') as $callable)
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
			$con = Propel::getConnection(ThumbnailPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ThumbnailPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseThumbnail:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnail:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ThumbnailPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ThumbnailPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ThumbnailPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseThumbnail:save:post') as $callable)
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


												
			if ($this->aThumbnailRelatedByParentId !== null) {
				if ($this->aThumbnailRelatedByParentId->isModified()) {
					$affectedRows += $this->aThumbnailRelatedByParentId->save($con);
				}
				$this->setThumbnailRelatedByParentId($this->aThumbnailRelatedByParentId);
			}

			if ($this->aThumbnailTypeAssetType !== null) {
				if ($this->aThumbnailTypeAssetType->isModified()) {
					$affectedRows += $this->aThumbnailTypeAssetType->save($con);
				}
				$this->setThumbnailTypeAssetType($this->aThumbnailTypeAssetType);
			}

			if ($this->aThumbnailMime !== null) {
				if ($this->aThumbnailMime->isModified()) {
					$affectedRows += $this->aThumbnailMime->save($con);
				}
				$this->setThumbnailMime($this->aThumbnailMime);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ThumbnailPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ThumbnailPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collThumbnailsRelatedByParentId !== null) {
				foreach($this->collThumbnailsRelatedByParentId as $referrerFK) {
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


												
			if ($this->aThumbnailRelatedByParentId !== null) {
				if (!$this->aThumbnailRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aThumbnailRelatedByParentId->getValidationFailures());
				}
			}

			if ($this->aThumbnailTypeAssetType !== null) {
				if (!$this->aThumbnailTypeAssetType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aThumbnailTypeAssetType->getValidationFailures());
				}
			}

			if ($this->aThumbnailMime !== null) {
				if (!$this->aThumbnailMime->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aThumbnailMime->getValidationFailures());
				}
			}


			if (($retval = ThumbnailPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ThumbnailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTtatId();
				break;
			case 3:
				return $this->getMimeId();
				break;
			case 4:
				return $this->getAssetId();
				break;
			case 5:
				return $this->getUuid();
				break;
			case 6:
				return $this->getAssetTypeModel();
				break;
			case 7:
				return $this->getMimeExtension();
				break;
			case 8:
				return $this->getPath();
				break;
			case 9:
				return $this->getIsBlank();
				break;
			case 10:
				return $this->getIsConverted();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThumbnailPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getParentId(),
			$keys[2] => $this->getTtatId(),
			$keys[3] => $this->getMimeId(),
			$keys[4] => $this->getAssetId(),
			$keys[5] => $this->getUuid(),
			$keys[6] => $this->getAssetTypeModel(),
			$keys[7] => $this->getMimeExtension(),
			$keys[8] => $this->getPath(),
			$keys[9] => $this->getIsBlank(),
			$keys[10] => $this->getIsConverted(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ThumbnailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTtatId($value);
				break;
			case 3:
				$this->setMimeId($value);
				break;
			case 4:
				$this->setAssetId($value);
				break;
			case 5:
				$this->setUuid($value);
				break;
			case 6:
				$this->setAssetTypeModel($value);
				break;
			case 7:
				$this->setMimeExtension($value);
				break;
			case 8:
				$this->setPath($value);
				break;
			case 9:
				$this->setIsBlank($value);
				break;
			case 10:
				$this->setIsConverted($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThumbnailPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTtatId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMimeId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAssetId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUuid($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAssetTypeModel($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMimeExtension($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPath($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIsBlank($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIsConverted($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ThumbnailPeer::DATABASE_NAME);

		if ($this->isColumnModified(ThumbnailPeer::ID)) $criteria->add(ThumbnailPeer::ID, $this->id);
		if ($this->isColumnModified(ThumbnailPeer::PARENT_ID)) $criteria->add(ThumbnailPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(ThumbnailPeer::TTAT_ID)) $criteria->add(ThumbnailPeer::TTAT_ID, $this->ttat_id);
		if ($this->isColumnModified(ThumbnailPeer::MIME_ID)) $criteria->add(ThumbnailPeer::MIME_ID, $this->mime_id);
		if ($this->isColumnModified(ThumbnailPeer::ASSET_ID)) $criteria->add(ThumbnailPeer::ASSET_ID, $this->asset_id);
		if ($this->isColumnModified(ThumbnailPeer::UUID)) $criteria->add(ThumbnailPeer::UUID, $this->uuid);
		if ($this->isColumnModified(ThumbnailPeer::ASSET_TYPE_MODEL)) $criteria->add(ThumbnailPeer::ASSET_TYPE_MODEL, $this->asset_type_model);
		if ($this->isColumnModified(ThumbnailPeer::MIME_EXTENSION)) $criteria->add(ThumbnailPeer::MIME_EXTENSION, $this->mime_extension);
		if ($this->isColumnModified(ThumbnailPeer::PATH)) $criteria->add(ThumbnailPeer::PATH, $this->path);
		if ($this->isColumnModified(ThumbnailPeer::IS_BLANK)) $criteria->add(ThumbnailPeer::IS_BLANK, $this->is_blank);
		if ($this->isColumnModified(ThumbnailPeer::IS_CONVERTED)) $criteria->add(ThumbnailPeer::IS_CONVERTED, $this->is_converted);
		if ($this->isColumnModified(ThumbnailPeer::CREATED_AT)) $criteria->add(ThumbnailPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ThumbnailPeer::UPDATED_AT)) $criteria->add(ThumbnailPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ThumbnailPeer::DATABASE_NAME);

		$criteria->add(ThumbnailPeer::ID, $this->id);

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

		$copyObj->setTtatId($this->ttat_id);

		$copyObj->setMimeId($this->mime_id);

		$copyObj->setAssetId($this->asset_id);

		$copyObj->setUuid($this->uuid);

		$copyObj->setAssetTypeModel($this->asset_type_model);

		$copyObj->setMimeExtension($this->mime_extension);

		$copyObj->setPath($this->path);

		$copyObj->setIsBlank($this->is_blank);

		$copyObj->setIsConverted($this->is_converted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getThumbnailsRelatedByParentId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addThumbnailRelatedByParentId($relObj->copy($deepCopy));
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
			self::$peer = new ThumbnailPeer();
		}
		return self::$peer;
	}

	
	public function setThumbnailRelatedByParentId($v)
	{


		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}


		$this->aThumbnailRelatedByParentId = $v;
	}


	
	public function getThumbnailRelatedByParentId($con = null)
	{
		if ($this->aThumbnailRelatedByParentId === null && ($this->parent_id !== null)) {
						$this->aThumbnailRelatedByParentId = ThumbnailPeer::retrieveByPK($this->parent_id, $con);

			
		}
		return $this->aThumbnailRelatedByParentId;
	}

	
	public function setThumbnailTypeAssetType($v)
	{


		if ($v === null) {
			$this->setTtatId(NULL);
		} else {
			$this->setTtatId($v->getId());
		}


		$this->aThumbnailTypeAssetType = $v;
	}


	
	public function getThumbnailTypeAssetType($con = null)
	{
		if ($this->aThumbnailTypeAssetType === null && ($this->ttat_id !== null)) {
						$this->aThumbnailTypeAssetType = ThumbnailTypeAssetTypePeer::retrieveByPK($this->ttat_id, $con);

			
		}
		return $this->aThumbnailTypeAssetType;
	}

	
	public function setThumbnailMime($v)
	{


		if ($v === null) {
			$this->setMimeId(NULL);
		} else {
			$this->setMimeId($v->getId());
		}


		$this->aThumbnailMime = $v;
	}


	
	public function getThumbnailMime($con = null)
	{
		if ($this->aThumbnailMime === null && ($this->mime_id !== null)) {
						$this->aThumbnailMime = ThumbnailMimePeer::retrieveByPK($this->mime_id, $con);

			
		}
		return $this->aThumbnailMime;
	}

	
	public function initThumbnailsRelatedByParentId()
	{
		if ($this->collThumbnailsRelatedByParentId === null) {
			$this->collThumbnailsRelatedByParentId = array();
		}
	}

	
	public function getThumbnailsRelatedByParentId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnailsRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collThumbnailsRelatedByParentId = array();
			} else {

				$criteria->add(ThumbnailPeer::PARENT_ID, $this->getId());

				ThumbnailPeer::addSelectColumns($criteria);
				$this->collThumbnailsRelatedByParentId = ThumbnailPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ThumbnailPeer::PARENT_ID, $this->getId());

				ThumbnailPeer::addSelectColumns($criteria);
				if (!isset($this->lastThumbnailRelatedByParentIdCriteria) || !$this->lastThumbnailRelatedByParentIdCriteria->equals($criteria)) {
					$this->collThumbnailsRelatedByParentId = ThumbnailPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastThumbnailRelatedByParentIdCriteria = $criteria;
		return $this->collThumbnailsRelatedByParentId;
	}

	
	public function countThumbnailsRelatedByParentId($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ThumbnailPeer::PARENT_ID, $this->getId());

		return ThumbnailPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addThumbnailRelatedByParentId(Thumbnail $l)
	{
		$this->collThumbnailsRelatedByParentId[] = $l;
		$l->setThumbnailRelatedByParentId($this);
	}


	
	public function getThumbnailsRelatedByParentIdJoinThumbnailTypeAssetType($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnailsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collThumbnailsRelatedByParentId = array();
			} else {

				$criteria->add(ThumbnailPeer::PARENT_ID, $this->getId());

				$this->collThumbnailsRelatedByParentId = ThumbnailPeer::doSelectJoinThumbnailTypeAssetType($criteria, $con);
			}
		} else {
									
			$criteria->add(ThumbnailPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastThumbnailRelatedByParentIdCriteria) || !$this->lastThumbnailRelatedByParentIdCriteria->equals($criteria)) {
				$this->collThumbnailsRelatedByParentId = ThumbnailPeer::doSelectJoinThumbnailTypeAssetType($criteria, $con);
			}
		}
		$this->lastThumbnailRelatedByParentIdCriteria = $criteria;

		return $this->collThumbnailsRelatedByParentId;
	}


	
	public function getThumbnailsRelatedByParentIdJoinThumbnailMime($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collThumbnailsRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collThumbnailsRelatedByParentId = array();
			} else {

				$criteria->add(ThumbnailPeer::PARENT_ID, $this->getId());

				$this->collThumbnailsRelatedByParentId = ThumbnailPeer::doSelectJoinThumbnailMime($criteria, $con);
			}
		} else {
									
			$criteria->add(ThumbnailPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastThumbnailRelatedByParentIdCriteria) || !$this->lastThumbnailRelatedByParentIdCriteria->equals($criteria)) {
				$this->collThumbnailsRelatedByParentId = ThumbnailPeer::doSelectJoinThumbnailMime($criteria, $con);
			}
		}
		$this->lastThumbnailRelatedByParentIdCriteria = $criteria;

		return $this->collThumbnailsRelatedByParentId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseThumbnail:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseThumbnail::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 