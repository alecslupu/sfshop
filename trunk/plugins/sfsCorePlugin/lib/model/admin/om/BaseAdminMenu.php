<?php


abstract class BaseAdminMenu extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $parent_id;


	
	protected $credential = 'admin';


	
	protected $title;


	
	protected $route;


	
	protected $pos = 0;


	
	protected $is_active = true;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aAdminMenuRelatedByParentId;

	
	protected $collAdminMenusRelatedByParentId;

	
	protected $lastAdminMenuRelatedByParentIdCriteria = null;

	
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

	
	public function getCredential()
	{

		return $this->credential;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getRoute()
	{

		return $this->route;
	}

	
	public function getPos()
	{

		return $this->pos;
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
			$this->modifiedColumns[] = AdminMenuPeer::ID;
		}

	} 
	
	public function setParentId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = AdminMenuPeer::PARENT_ID;
		}

		if ($this->aAdminMenuRelatedByParentId !== null && $this->aAdminMenuRelatedByParentId->getId() !== $v) {
			$this->aAdminMenuRelatedByParentId = null;
		}

	} 
	
	public function setCredential($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credential !== $v || $v === 'admin') {
			$this->credential = $v;
			$this->modifiedColumns[] = AdminMenuPeer::CREDENTIAL;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = AdminMenuPeer::TITLE;
		}

	} 
	
	public function setRoute($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->route !== $v) {
			$this->route = $v;
			$this->modifiedColumns[] = AdminMenuPeer::ROUTE;
		}

	} 
	
	public function setPos($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pos !== $v || $v === 0) {
			$this->pos = $v;
			$this->modifiedColumns[] = AdminMenuPeer::POS;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = AdminMenuPeer::IS_ACTIVE;
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
			$this->modifiedColumns[] = AdminMenuPeer::CREATED_AT;
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
			$this->modifiedColumns[] = AdminMenuPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->parent_id = $rs->getInt($startcol + 1);

			$this->credential = $rs->getString($startcol + 2);

			$this->title = $rs->getString($startcol + 3);

			$this->route = $rs->getString($startcol + 4);

			$this->pos = $rs->getInt($startcol + 5);

			$this->is_active = $rs->getBoolean($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AdminMenu object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminMenu:delete:pre') as $callable)
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
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AdminMenuPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAdminMenu:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminMenu:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(AdminMenuPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(AdminMenuPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAdminMenu:save:post') as $callable)
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


												
			if ($this->aAdminMenuRelatedByParentId !== null) {
				if ($this->aAdminMenuRelatedByParentId->isModified()) {
					$affectedRows += $this->aAdminMenuRelatedByParentId->save($con);
				}
				$this->setAdminMenuRelatedByParentId($this->aAdminMenuRelatedByParentId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AdminMenuPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AdminMenuPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collAdminMenusRelatedByParentId !== null) {
				foreach($this->collAdminMenusRelatedByParentId as $referrerFK) {
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


												
			if ($this->aAdminMenuRelatedByParentId !== null) {
				if (!$this->aAdminMenuRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAdminMenuRelatedByParentId->getValidationFailures());
				}
			}


			if (($retval = AdminMenuPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AdminMenuPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCredential();
				break;
			case 3:
				return $this->getTitle();
				break;
			case 4:
				return $this->getRoute();
				break;
			case 5:
				return $this->getPos();
				break;
			case 6:
				return $this->getIsActive();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AdminMenuPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getParentId(),
			$keys[2] => $this->getCredential(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getRoute(),
			$keys[5] => $this->getPos(),
			$keys[6] => $this->getIsActive(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AdminMenuPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCredential($value);
				break;
			case 3:
				$this->setTitle($value);
				break;
			case 4:
				$this->setRoute($value);
				break;
			case 5:
				$this->setPos($value);
				break;
			case 6:
				$this->setIsActive($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AdminMenuPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCredential($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRoute($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPos($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsActive($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AdminMenuPeer::DATABASE_NAME);

		if ($this->isColumnModified(AdminMenuPeer::ID)) $criteria->add(AdminMenuPeer::ID, $this->id);
		if ($this->isColumnModified(AdminMenuPeer::PARENT_ID)) $criteria->add(AdminMenuPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(AdminMenuPeer::CREDENTIAL)) $criteria->add(AdminMenuPeer::CREDENTIAL, $this->credential);
		if ($this->isColumnModified(AdminMenuPeer::TITLE)) $criteria->add(AdminMenuPeer::TITLE, $this->title);
		if ($this->isColumnModified(AdminMenuPeer::ROUTE)) $criteria->add(AdminMenuPeer::ROUTE, $this->route);
		if ($this->isColumnModified(AdminMenuPeer::POS)) $criteria->add(AdminMenuPeer::POS, $this->pos);
		if ($this->isColumnModified(AdminMenuPeer::IS_ACTIVE)) $criteria->add(AdminMenuPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(AdminMenuPeer::CREATED_AT)) $criteria->add(AdminMenuPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AdminMenuPeer::UPDATED_AT)) $criteria->add(AdminMenuPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AdminMenuPeer::DATABASE_NAME);

		$criteria->add(AdminMenuPeer::ID, $this->id);

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

		$copyObj->setCredential($this->credential);

		$copyObj->setTitle($this->title);

		$copyObj->setRoute($this->route);

		$copyObj->setPos($this->pos);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getAdminMenusRelatedByParentId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addAdminMenuRelatedByParentId($relObj->copy($deepCopy));
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
			self::$peer = new AdminMenuPeer();
		}
		return self::$peer;
	}

	
	public function setAdminMenuRelatedByParentId($v)
	{


		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}


		$this->aAdminMenuRelatedByParentId = $v;
	}


	
	public function getAdminMenuRelatedByParentId($con = null)
	{
		if ($this->aAdminMenuRelatedByParentId === null && ($this->parent_id !== null)) {
						$this->aAdminMenuRelatedByParentId = AdminMenuPeer::retrieveByPK($this->parent_id, $con);

			
		}
		return $this->aAdminMenuRelatedByParentId;
	}

	
	public function initAdminMenusRelatedByParentId()
	{
		if ($this->collAdminMenusRelatedByParentId === null) {
			$this->collAdminMenusRelatedByParentId = array();
		}
	}

	
	public function getAdminMenusRelatedByParentId($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAdminMenusRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collAdminMenusRelatedByParentId = array();
			} else {

				$criteria->add(AdminMenuPeer::PARENT_ID, $this->getId());

				AdminMenuPeer::addSelectColumns($criteria);
				$this->collAdminMenusRelatedByParentId = AdminMenuPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AdminMenuPeer::PARENT_ID, $this->getId());

				AdminMenuPeer::addSelectColumns($criteria);
				if (!isset($this->lastAdminMenuRelatedByParentIdCriteria) || !$this->lastAdminMenuRelatedByParentIdCriteria->equals($criteria)) {
					$this->collAdminMenusRelatedByParentId = AdminMenuPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAdminMenuRelatedByParentIdCriteria = $criteria;
		return $this->collAdminMenusRelatedByParentId;
	}

	
	public function countAdminMenusRelatedByParentId($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AdminMenuPeer::PARENT_ID, $this->getId());

		return AdminMenuPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAdminMenuRelatedByParentId(AdminMenu $l)
	{
		$this->collAdminMenusRelatedByParentId[] = $l;
		$l->setAdminMenuRelatedByParentId($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAdminMenu:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAdminMenu::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 