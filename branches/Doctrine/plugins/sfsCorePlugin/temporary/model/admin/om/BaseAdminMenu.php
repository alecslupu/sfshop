<?php


abstract class BaseAdminMenu extends BaseObject  implements Persistent {


  const PEER = 'AdminMenuPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $parent_id;

	
	protected $credential;

	
	protected $module;

	
	protected $action;

	
	protected $route;

	
	protected $pos;

	
	protected $is_active;

	
	protected $aAdminMenuRelatedByParentId;

	
	protected $collAdminMenusRelatedByParentId;

	
	private $lastAdminMenuRelatedByParentIdCriteria = null;

	
	protected $collAdminMenuI18ns;

	
	private $lastAdminMenuI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function applyDefaultValues()
	{
		$this->credential = 'admin';
		$this->pos = 0;
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

	
	public function getParentId()
	{
		return $this->parent_id;
	}

	
	public function getCredential()
	{
		return $this->credential;
	}

	
	public function getModule()
	{
		return $this->module;
	}

	
	public function getAction()
	{
		return $this->action;
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

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AdminMenuPeer::ID;
		}

		return $this;
	} 
	
	public function setParentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = AdminMenuPeer::PARENT_ID;
		}

		if ($this->aAdminMenuRelatedByParentId !== null && $this->aAdminMenuRelatedByParentId->getId() !== $v) {
			$this->aAdminMenuRelatedByParentId = null;
		}

		return $this;
	} 
	
	public function setCredential($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->credential !== $v || $this->isNew()) {
			$this->credential = $v;
			$this->modifiedColumns[] = AdminMenuPeer::CREDENTIAL;
		}

		return $this;
	} 
	
	public function setModule($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->module !== $v) {
			$this->module = $v;
			$this->modifiedColumns[] = AdminMenuPeer::MODULE;
		}

		return $this;
	} 
	
	public function setAction($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->action !== $v) {
			$this->action = $v;
			$this->modifiedColumns[] = AdminMenuPeer::ACTION;
		}

		return $this;
	} 
	
	public function setRoute($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->route !== $v) {
			$this->route = $v;
			$this->modifiedColumns[] = AdminMenuPeer::ROUTE;
		}

		return $this;
	} 
	
	public function setPos($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pos !== $v || $this->isNew()) {
			$this->pos = $v;
			$this->modifiedColumns[] = AdminMenuPeer::POS;
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
			$this->modifiedColumns[] = AdminMenuPeer::IS_ACTIVE;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
			if ($this->credential !== 'admin') {
				return false;
			}

			if ($this->pos !== 0) {
				return false;
			}

			if ($this->is_active !== true) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->parent_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->credential = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->module = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->action = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->route = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->pos = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->is_active = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AdminMenu object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aAdminMenuRelatedByParentId !== null && $this->parent_id !== $this->aAdminMenuRelatedByParentId->getId()) {
			$this->aAdminMenuRelatedByParentId = null;
		}
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
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AdminMenuPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aAdminMenuRelatedByParentId = null;
			$this->collAdminMenusRelatedByParentId = null;
			$this->lastAdminMenuRelatedByParentIdCriteria = null;

			$this->collAdminMenuI18ns = null;
			$this->lastAdminMenuI18nCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
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
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				AdminMenuPeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseAdminMenu:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminMenu:save:pre') as $callable)
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
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				AdminMenuPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseAdminMenu:save:post') as $callable)
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

												
			if ($this->aAdminMenuRelatedByParentId !== null) {
				if ($this->aAdminMenuRelatedByParentId->isModified() || ($this->aAdminMenuRelatedByParentId->getCulture() && $this->aAdminMenuRelatedByParentId->getCurrentAdminMenuI18n()->isModified()) || $this->aAdminMenuRelatedByParentId->isNew()) {
					$affectedRows += $this->aAdminMenuRelatedByParentId->save($con);
				}
				$this->setAdminMenuRelatedByParentId($this->aAdminMenuRelatedByParentId);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AdminMenuPeer::ID;
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
				foreach ($this->collAdminMenusRelatedByParentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAdminMenuI18ns !== null) {
				foreach ($this->collAdminMenuI18ns as $referrerFK) {
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


				if ($this->collAdminMenusRelatedByParentId !== null) {
					foreach ($this->collAdminMenusRelatedByParentId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAdminMenuI18ns !== null) {
					foreach ($this->collAdminMenuI18ns as $referrerFK) {
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
		$pos = AdminMenuPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getParentId();
				break;
			case 2:
				return $this->getCredential();
				break;
			case 3:
				return $this->getModule();
				break;
			case 4:
				return $this->getAction();
				break;
			case 5:
				return $this->getRoute();
				break;
			case 6:
				return $this->getPos();
				break;
			case 7:
				return $this->getIsActive();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AdminMenuPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getParentId(),
			$keys[2] => $this->getCredential(),
			$keys[3] => $this->getModule(),
			$keys[4] => $this->getAction(),
			$keys[5] => $this->getRoute(),
			$keys[6] => $this->getPos(),
			$keys[7] => $this->getIsActive(),
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
				$this->setModule($value);
				break;
			case 4:
				$this->setAction($value);
				break;
			case 5:
				$this->setRoute($value);
				break;
			case 6:
				$this->setPos($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AdminMenuPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCredential($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setModule($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAction($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRoute($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPos($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AdminMenuPeer::DATABASE_NAME);

		if ($this->isColumnModified(AdminMenuPeer::ID)) $criteria->add(AdminMenuPeer::ID, $this->id);
		if ($this->isColumnModified(AdminMenuPeer::PARENT_ID)) $criteria->add(AdminMenuPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(AdminMenuPeer::CREDENTIAL)) $criteria->add(AdminMenuPeer::CREDENTIAL, $this->credential);
		if ($this->isColumnModified(AdminMenuPeer::MODULE)) $criteria->add(AdminMenuPeer::MODULE, $this->module);
		if ($this->isColumnModified(AdminMenuPeer::ACTION)) $criteria->add(AdminMenuPeer::ACTION, $this->action);
		if ($this->isColumnModified(AdminMenuPeer::ROUTE)) $criteria->add(AdminMenuPeer::ROUTE, $this->route);
		if ($this->isColumnModified(AdminMenuPeer::POS)) $criteria->add(AdminMenuPeer::POS, $this->pos);
		if ($this->isColumnModified(AdminMenuPeer::IS_ACTIVE)) $criteria->add(AdminMenuPeer::IS_ACTIVE, $this->is_active);

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

		$copyObj->setModule($this->module);

		$copyObj->setAction($this->action);

		$copyObj->setRoute($this->route);

		$copyObj->setPos($this->pos);

		$copyObj->setIsActive($this->is_active);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getAdminMenusRelatedByParentId() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAdminMenuRelatedByParentId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAdminMenuI18ns() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAdminMenuI18n($relObj->copy($deepCopy));
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
			self::$peer = new AdminMenuPeer();
		}
		return self::$peer;
	}

	
	public function setAdminMenuRelatedByParentId(AdminMenu $v = null)
	{
		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}

		$this->aAdminMenuRelatedByParentId = $v;

						if ($v !== null) {
			$v->addAdminMenuRelatedByParentId($this);
		}

		return $this;
	}


	
	public function getAdminMenuRelatedByParentId(PropelPDO $con = null)
	{
		if ($this->aAdminMenuRelatedByParentId === null && ($this->parent_id !== null)) {
			$this->aAdminMenuRelatedByParentId = AdminMenuPeer::retrieveByPk($this->parent_id);
			
		}
		return $this->aAdminMenuRelatedByParentId;
	}

	
	public function clearAdminMenusRelatedByParentId()
	{
		$this->collAdminMenusRelatedByParentId = null; 	}

	
	public function initAdminMenusRelatedByParentId()
	{
		$this->collAdminMenusRelatedByParentId = array();
	}

	
	public function getAdminMenusRelatedByParentId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AdminMenuPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAdminMenusRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collAdminMenusRelatedByParentId = array();
			} else {

				$criteria->add(AdminMenuPeer::PARENT_ID, $this->id);

				AdminMenuPeer::addSelectColumns($criteria);
				$this->collAdminMenusRelatedByParentId = AdminMenuPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AdminMenuPeer::PARENT_ID, $this->id);

				AdminMenuPeer::addSelectColumns($criteria);
				if (!isset($this->lastAdminMenuRelatedByParentIdCriteria) || !$this->lastAdminMenuRelatedByParentIdCriteria->equals($criteria)) {
					$this->collAdminMenusRelatedByParentId = AdminMenuPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAdminMenuRelatedByParentIdCriteria = $criteria;
		return $this->collAdminMenusRelatedByParentId;
	}

	
	public function countAdminMenusRelatedByParentId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AdminMenuPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAdminMenusRelatedByParentId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AdminMenuPeer::PARENT_ID, $this->id);

				$count = AdminMenuPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AdminMenuPeer::PARENT_ID, $this->id);

				if (!isset($this->lastAdminMenuRelatedByParentIdCriteria) || !$this->lastAdminMenuRelatedByParentIdCriteria->equals($criteria)) {
					$count = AdminMenuPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collAdminMenusRelatedByParentId);
				}
			} else {
				$count = count($this->collAdminMenusRelatedByParentId);
			}
		}
		return $count;
	}

	
	public function addAdminMenuRelatedByParentId(AdminMenu $l)
	{
		if ($this->collAdminMenusRelatedByParentId === null) {
			$this->initAdminMenusRelatedByParentId();
		}
		if (!in_array($l, $this->collAdminMenusRelatedByParentId, true)) { 			array_push($this->collAdminMenusRelatedByParentId, $l);
			$l->setAdminMenuRelatedByParentId($this);
		}
	}

	
	public function clearAdminMenuI18ns()
	{
		$this->collAdminMenuI18ns = null; 	}

	
	public function initAdminMenuI18ns()
	{
		$this->collAdminMenuI18ns = array();
	}

	
	public function getAdminMenuI18ns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AdminMenuPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAdminMenuI18ns === null) {
			if ($this->isNew()) {
			   $this->collAdminMenuI18ns = array();
			} else {

				$criteria->add(AdminMenuI18nPeer::ID, $this->id);

				AdminMenuI18nPeer::addSelectColumns($criteria);
				$this->collAdminMenuI18ns = AdminMenuI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AdminMenuI18nPeer::ID, $this->id);

				AdminMenuI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastAdminMenuI18nCriteria) || !$this->lastAdminMenuI18nCriteria->equals($criteria)) {
					$this->collAdminMenuI18ns = AdminMenuI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAdminMenuI18nCriteria = $criteria;
		return $this->collAdminMenuI18ns;
	}

	
	public function countAdminMenuI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AdminMenuPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAdminMenuI18ns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AdminMenuI18nPeer::ID, $this->id);

				$count = AdminMenuI18nPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AdminMenuI18nPeer::ID, $this->id);

				if (!isset($this->lastAdminMenuI18nCriteria) || !$this->lastAdminMenuI18nCriteria->equals($criteria)) {
					$count = AdminMenuI18nPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collAdminMenuI18ns);
				}
			} else {
				$count = count($this->collAdminMenuI18ns);
			}
		}
		return $count;
	}

	
	public function addAdminMenuI18n(AdminMenuI18n $l)
	{
		if ($this->collAdminMenuI18ns === null) {
			$this->initAdminMenuI18ns();
		}
		if (!in_array($l, $this->collAdminMenuI18ns, true)) { 			array_push($this->collAdminMenuI18ns, $l);
			$l->setAdminMenu($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collAdminMenusRelatedByParentId) {
				foreach ((array) $this->collAdminMenusRelatedByParentId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAdminMenuI18ns) {
				foreach ((array) $this->collAdminMenuI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collAdminMenusRelatedByParentId = null;
		$this->collAdminMenuI18ns = null;
			$this->aAdminMenuRelatedByParentId = null;
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
    return $this->getCurrentAdminMenuI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentAdminMenuI18n($culture)->setTitle($value);
  }

  protected $current_i18n = array();

  public function getCurrentAdminMenuI18n($culture = null)
  {
    if (null === $culture)
    {
      $culture = null === $this->culture ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = $this->isNew() ? null : AdminMenuI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setAdminMenuI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setAdminMenuI18nForCulture(new AdminMenuI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setAdminMenuI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addAdminMenuI18n($object);
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