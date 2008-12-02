<?php


abstract class BaseThumbnailMime extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $mime;


	
	protected $extension;


	
	protected $extensions;

	
	protected $collThumbnails;

	
	protected $lastThumbnailCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getMime()
	{

		return $this->mime;
	}

	
	public function getExtension()
	{

		return $this->extension;
	}

	
	public function getExtensions()
	{

		return $this->extensions;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ThumbnailMimePeer::ID;
		}

	} 
	
	public function setMime($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mime !== $v) {
			$this->mime = $v;
			$this->modifiedColumns[] = ThumbnailMimePeer::MIME;
		}

	} 
	
	public function setExtension($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->extension !== $v) {
			$this->extension = $v;
			$this->modifiedColumns[] = ThumbnailMimePeer::EXTENSION;
		}

	} 
	
	public function setExtensions($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->extensions !== $v) {
			$this->extensions = $v;
			$this->modifiedColumns[] = ThumbnailMimePeer::EXTENSIONS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->mime = $rs->getString($startcol + 1);

			$this->extension = $rs->getString($startcol + 2);

			$this->extensions = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ThumbnailMime object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailMime:delete:pre') as $callable)
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
			$con = Propel::getConnection(ThumbnailMimePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ThumbnailMimePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseThumbnailMime:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailMime:save:pre') as $callable)
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
			$con = Propel::getConnection(ThumbnailMimePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseThumbnailMime:save:post') as $callable)
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
					$pk = ThumbnailMimePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ThumbnailMimePeer::doUpdate($this, $con);
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


			if (($retval = ThumbnailMimePeer::doValidate($this, $columns)) !== true) {
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
		$pos = ThumbnailMimePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getMime();
				break;
			case 2:
				return $this->getExtension();
				break;
			case 3:
				return $this->getExtensions();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThumbnailMimePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMime(),
			$keys[2] => $this->getExtension(),
			$keys[3] => $this->getExtensions(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ThumbnailMimePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setMime($value);
				break;
			case 2:
				$this->setExtension($value);
				break;
			case 3:
				$this->setExtensions($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ThumbnailMimePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMime($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setExtension($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setExtensions($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ThumbnailMimePeer::DATABASE_NAME);

		if ($this->isColumnModified(ThumbnailMimePeer::ID)) $criteria->add(ThumbnailMimePeer::ID, $this->id);
		if ($this->isColumnModified(ThumbnailMimePeer::MIME)) $criteria->add(ThumbnailMimePeer::MIME, $this->mime);
		if ($this->isColumnModified(ThumbnailMimePeer::EXTENSION)) $criteria->add(ThumbnailMimePeer::EXTENSION, $this->extension);
		if ($this->isColumnModified(ThumbnailMimePeer::EXTENSIONS)) $criteria->add(ThumbnailMimePeer::EXTENSIONS, $this->extensions);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ThumbnailMimePeer::DATABASE_NAME);

		$criteria->add(ThumbnailMimePeer::ID, $this->id);

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

		$copyObj->setMime($this->mime);

		$copyObj->setExtension($this->extension);

		$copyObj->setExtensions($this->extensions);


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
			self::$peer = new ThumbnailMimePeer();
		}
		return self::$peer;
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

				$criteria->add(ThumbnailPeer::MIME_ID, $this->getId());

				ThumbnailPeer::addSelectColumns($criteria);
				$this->collThumbnails = ThumbnailPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ThumbnailPeer::MIME_ID, $this->getId());

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

		$criteria->add(ThumbnailPeer::MIME_ID, $this->getId());

		return ThumbnailPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addThumbnail(Thumbnail $l)
	{
		$this->collThumbnails[] = $l;
		$l->setThumbnailMime($this);
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

				$criteria->add(ThumbnailPeer::MIME_ID, $this->getId());

				$this->collThumbnails = ThumbnailPeer::doSelectJoinThumbnailRelatedByParentId($criteria, $con);
			}
		} else {
									
			$criteria->add(ThumbnailPeer::MIME_ID, $this->getId());

			if (!isset($this->lastThumbnailCriteria) || !$this->lastThumbnailCriteria->equals($criteria)) {
				$this->collThumbnails = ThumbnailPeer::doSelectJoinThumbnailRelatedByParentId($criteria, $con);
			}
		}
		$this->lastThumbnailCriteria = $criteria;

		return $this->collThumbnails;
	}


	
	public function getThumbnailsJoinThumbnailTypeAssetType($criteria = null, $con = null)
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

				$criteria->add(ThumbnailPeer::MIME_ID, $this->getId());

				$this->collThumbnails = ThumbnailPeer::doSelectJoinThumbnailTypeAssetType($criteria, $con);
			}
		} else {
									
			$criteria->add(ThumbnailPeer::MIME_ID, $this->getId());

			if (!isset($this->lastThumbnailCriteria) || !$this->lastThumbnailCriteria->equals($criteria)) {
				$this->collThumbnails = ThumbnailPeer::doSelectJoinThumbnailTypeAssetType($criteria, $con);
			}
		}
		$this->lastThumbnailCriteria = $criteria;

		return $this->collThumbnails;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseThumbnailMime:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseThumbnailMime::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 