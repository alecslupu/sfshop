<?php


abstract class BaseMenu extends BaseObject  implements Persistent {


  const PEER = 'MenuPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $type;

	
	protected $route;

	
	protected $pos;

	
	protected $collMenuI18ns;

	
	private $lastMenuI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function applyDefaultValues()
	{
		$this->pos = 0;
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

	
	public function getType()
	{
		return $this->type;
	}

	
	public function getRoute()
	{
		return $this->route;
	}

	
	public function getPos()
	{
		return $this->pos;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = MenuPeer::ID;
		}

		return $this;
	} 
	
	public function setType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = MenuPeer::TYPE;
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
			$this->modifiedColumns[] = MenuPeer::ROUTE;
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
			$this->modifiedColumns[] = MenuPeer::POS;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
			if ($this->pos !== 0) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->type = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->route = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->pos = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Menu object", $e);
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
			$con = Propel::getConnection(MenuPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = MenuPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collMenuI18ns = null;
			$this->lastMenuI18nCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseMenu:delete:pre') as $callable)
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
			$con = Propel::getConnection(MenuPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				MenuPeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseMenu:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseMenu:save:pre') as $callable)
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
			$con = Propel::getConnection(MenuPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				MenuPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseMenu:save:post') as $callable)
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
				$this->modifiedColumns[] = MenuPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MenuPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MenuPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collMenuI18ns !== null) {
				foreach ($this->collMenuI18ns as $referrerFK) {
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


			if (($retval = MenuPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMenuI18ns !== null) {
					foreach ($this->collMenuI18ns as $referrerFK) {
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
		$pos = MenuPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getType();
				break;
			case 2:
				return $this->getRoute();
				break;
			case 3:
				return $this->getPos();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = MenuPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getType(),
			$keys[2] => $this->getRoute(),
			$keys[3] => $this->getPos(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MenuPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setType($value);
				break;
			case 2:
				$this->setRoute($value);
				break;
			case 3:
				$this->setPos($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MenuPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRoute($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPos($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MenuPeer::DATABASE_NAME);

		if ($this->isColumnModified(MenuPeer::ID)) $criteria->add(MenuPeer::ID, $this->id);
		if ($this->isColumnModified(MenuPeer::TYPE)) $criteria->add(MenuPeer::TYPE, $this->type);
		if ($this->isColumnModified(MenuPeer::ROUTE)) $criteria->add(MenuPeer::ROUTE, $this->route);
		if ($this->isColumnModified(MenuPeer::POS)) $criteria->add(MenuPeer::POS, $this->pos);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MenuPeer::DATABASE_NAME);

		$criteria->add(MenuPeer::ID, $this->id);

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

		$copyObj->setType($this->type);

		$copyObj->setRoute($this->route);

		$copyObj->setPos($this->pos);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getMenuI18ns() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addMenuI18n($relObj->copy($deepCopy));
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
			self::$peer = new MenuPeer();
		}
		return self::$peer;
	}

	
	public function clearMenuI18ns()
	{
		$this->collMenuI18ns = null; 	}

	
	public function initMenuI18ns()
	{
		$this->collMenuI18ns = array();
	}

	
	public function getMenuI18ns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(MenuPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMenuI18ns === null) {
			if ($this->isNew()) {
			   $this->collMenuI18ns = array();
			} else {

				$criteria->add(MenuI18nPeer::ID, $this->id);

				MenuI18nPeer::addSelectColumns($criteria);
				$this->collMenuI18ns = MenuI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MenuI18nPeer::ID, $this->id);

				MenuI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastMenuI18nCriteria) || !$this->lastMenuI18nCriteria->equals($criteria)) {
					$this->collMenuI18ns = MenuI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMenuI18nCriteria = $criteria;
		return $this->collMenuI18ns;
	}

	
	public function countMenuI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(MenuPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collMenuI18ns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(MenuI18nPeer::ID, $this->id);

				$count = MenuI18nPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MenuI18nPeer::ID, $this->id);

				if (!isset($this->lastMenuI18nCriteria) || !$this->lastMenuI18nCriteria->equals($criteria)) {
					$count = MenuI18nPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collMenuI18ns);
				}
			} else {
				$count = count($this->collMenuI18ns);
			}
		}
		return $count;
	}

	
	public function addMenuI18n(MenuI18n $l)
	{
		if ($this->collMenuI18ns === null) {
			$this->initMenuI18ns();
		}
		if (!in_array($l, $this->collMenuI18ns, true)) { 			array_push($this->collMenuI18ns, $l);
			$l->setMenu($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collMenuI18ns) {
				foreach ((array) $this->collMenuI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collMenuI18ns = null;
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
    return $this->getCurrentMenuI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentMenuI18n($culture)->setTitle($value);
  }

  public function getMetaKeywords($culture = null)
  {
    return $this->getCurrentMenuI18n($culture)->getMetaKeywords();
  }

  public function setMetaKeywords($value, $culture = null)
  {
    $this->getCurrentMenuI18n($culture)->setMetaKeywords($value);
  }

  public function getMetaDescription($culture = null)
  {
    return $this->getCurrentMenuI18n($culture)->getMetaDescription();
  }

  public function setMetaDescription($value, $culture = null)
  {
    $this->getCurrentMenuI18n($culture)->setMetaDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentMenuI18n($culture = null)
  {
    if (null === $culture)
    {
      $culture = null === $this->culture ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = $this->isNew() ? null : MenuI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setMenuI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setMenuI18nForCulture(new MenuI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setMenuI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addMenuI18n($object);
  }

  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMenu:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMenu::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }

} 