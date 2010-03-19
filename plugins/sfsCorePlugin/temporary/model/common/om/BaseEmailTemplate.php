<?php


abstract class BaseEmailTemplate extends BaseObject  implements Persistent {


  const PEER = 'EmailTemplatePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $collEmailTemplateI18ns;

	
	private $lastEmailTemplateI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getName()
	{
		return $this->name;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = EmailTemplatePeer::ID;
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
			$this->modifiedColumns[] = EmailTemplatePeer::NAME;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EmailTemplate object", $e);
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
			$con = Propel::getConnection(EmailTemplatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = EmailTemplatePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collEmailTemplateI18ns = null;
			$this->lastEmailTemplateI18nCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailTemplate:delete:pre') as $callable)
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
			$con = Propel::getConnection(EmailTemplatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				EmailTemplatePeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseEmailTemplate:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailTemplate:save:pre') as $callable)
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
			$con = Propel::getConnection(EmailTemplatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				EmailTemplatePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseEmailTemplate:save:post') as $callable)
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
				$this->modifiedColumns[] = EmailTemplatePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailTemplatePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EmailTemplatePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collEmailTemplateI18ns !== null) {
				foreach ($this->collEmailTemplateI18ns as $referrerFK) {
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


			if (($retval = EmailTemplatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEmailTemplateI18ns !== null) {
					foreach ($this->collEmailTemplateI18ns as $referrerFK) {
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
		$pos = EmailTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = EmailTemplatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailTemplatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailTemplatePeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailTemplatePeer::ID)) $criteria->add(EmailTemplatePeer::ID, $this->id);
		if ($this->isColumnModified(EmailTemplatePeer::NAME)) $criteria->add(EmailTemplatePeer::NAME, $this->name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailTemplatePeer::DATABASE_NAME);

		$criteria->add(EmailTemplatePeer::ID, $this->id);

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


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getEmailTemplateI18ns() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addEmailTemplateI18n($relObj->copy($deepCopy));
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
			self::$peer = new EmailTemplatePeer();
		}
		return self::$peer;
	}

	
	public function clearEmailTemplateI18ns()
	{
		$this->collEmailTemplateI18ns = null; 	}

	
	public function initEmailTemplateI18ns()
	{
		$this->collEmailTemplateI18ns = array();
	}

	
	public function getEmailTemplateI18ns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailTemplatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailTemplateI18ns === null) {
			if ($this->isNew()) {
			   $this->collEmailTemplateI18ns = array();
			} else {

				$criteria->add(EmailTemplateI18nPeer::ID, $this->id);

				EmailTemplateI18nPeer::addSelectColumns($criteria);
				$this->collEmailTemplateI18ns = EmailTemplateI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailTemplateI18nPeer::ID, $this->id);

				EmailTemplateI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailTemplateI18nCriteria) || !$this->lastEmailTemplateI18nCriteria->equals($criteria)) {
					$this->collEmailTemplateI18ns = EmailTemplateI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailTemplateI18nCriteria = $criteria;
		return $this->collEmailTemplateI18ns;
	}

	
	public function countEmailTemplateI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailTemplatePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collEmailTemplateI18ns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(EmailTemplateI18nPeer::ID, $this->id);

				$count = EmailTemplateI18nPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EmailTemplateI18nPeer::ID, $this->id);

				if (!isset($this->lastEmailTemplateI18nCriteria) || !$this->lastEmailTemplateI18nCriteria->equals($criteria)) {
					$count = EmailTemplateI18nPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collEmailTemplateI18ns);
				}
			} else {
				$count = count($this->collEmailTemplateI18ns);
			}
		}
		return $count;
	}

	
	public function addEmailTemplateI18n(EmailTemplateI18n $l)
	{
		if ($this->collEmailTemplateI18ns === null) {
			$this->initEmailTemplateI18ns();
		}
		if (!in_array($l, $this->collEmailTemplateI18ns, true)) { 			array_push($this->collEmailTemplateI18ns, $l);
			$l->setEmailTemplate($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collEmailTemplateI18ns) {
				foreach ((array) $this->collEmailTemplateI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collEmailTemplateI18ns = null;
	}


  
  public function getCulture()
  {
    return $this->culture;
  }

  
  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getSubject($culture = null)
  {
    return $this->getCurrentEmailTemplateI18n($culture)->getSubject();
  }

  public function setSubject($value, $culture = null)
  {
    $this->getCurrentEmailTemplateI18n($culture)->setSubject($value);
  }

  public function getBody($culture = null)
  {
    return $this->getCurrentEmailTemplateI18n($culture)->getBody();
  }

  public function setBody($value, $culture = null)
  {
    $this->getCurrentEmailTemplateI18n($culture)->setBody($value);
  }

  protected $current_i18n = array();

  public function getCurrentEmailTemplateI18n($culture = null)
  {
    if (null === $culture)
    {
      $culture = null === $this->culture ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = $this->isNew() ? null : EmailTemplateI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setEmailTemplateI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setEmailTemplateI18nForCulture(new EmailTemplateI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setEmailTemplateI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addEmailTemplateI18n($object);
  }

  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseEmailTemplate:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseEmailTemplate::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }

} 