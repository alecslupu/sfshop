<?php


abstract class BaseThumbnailType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $is_active = false;

	
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

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ThumbnailTypePeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ThumbnailTypePeer::NAME;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === false) {
			$this->is_active = $v;
			$this->modifiedColumns[] = ThumbnailTypePeer::IS_ACTIVE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->is_active = $rs->getBoolean($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ThumbnailType object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailType:delete:pre') as $callable)
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
			$con = Propel::getConnection(ThumbnailTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ThumbnailTypePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseThumbnailType:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailType:save:pre') as $callable)
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
			$con = Propel::getConnection(ThumbnailTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseThumbnailType:save:post') as $callable)
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
					$pk = ThumbnailTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ThumbnailTypePeer::doUpdate($this, $con);
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


			if (($retval = ThumbnailTypePeer::doValidate($this, $columns)) !== true) {
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
		$pos = ThumbnailTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIsActive();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThumbnailTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getIsActive(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ThumbnailTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIsActive($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThumbnailTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsActive($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ThumbnailTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(ThumbnailTypePeer::ID)) $criteria->add(ThumbnailTypePeer::ID, $this->id);
		if ($this->isColumnModified(ThumbnailTypePeer::NAME)) $criteria->add(ThumbnailTypePeer::NAME, $this->name);
		if ($this->isColumnModified(ThumbnailTypePeer::IS_ACTIVE)) $criteria->add(ThumbnailTypePeer::IS_ACTIVE, $this->is_active);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ThumbnailTypePeer::DATABASE_NAME);

		$criteria->add(ThumbnailTypePeer::ID, $this->id);

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

		$copyObj->setIsActive($this->is_active);


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
			self::$peer = new ThumbnailTypePeer();
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

				$criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, $this->getId());

				ThumbnailTypeAssetTypePeer::addSelectColumns($criteria);
				$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, $this->getId());

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

		$criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, $this->getId());

		return ThumbnailTypeAssetTypePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addThumbnailTypeAssetType(ThumbnailTypeAssetType $l)
	{
		$this->collThumbnailTypeAssetTypes[] = $l;
		$l->setThumbnailType($this);
	}


	
	public function getThumbnailTypeAssetTypesJoinAssetType($criteria = null, $con = null)
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

				$criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, $this->getId());

				$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelectJoinAssetType($criteria, $con);
			}
		} else {
									
			$criteria->add(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, $this->getId());

			if (!isset($this->lastThumbnailTypeAssetTypeCriteria) || !$this->lastThumbnailTypeAssetTypeCriteria->equals($criteria)) {
				$this->collThumbnailTypeAssetTypes = ThumbnailTypeAssetTypePeer::doSelectJoinAssetType($criteria, $con);
			}
		}
		$this->lastThumbnailTypeAssetTypeCriteria = $criteria;

		return $this->collThumbnailTypeAssetTypes;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseThumbnailType:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseThumbnailType::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 