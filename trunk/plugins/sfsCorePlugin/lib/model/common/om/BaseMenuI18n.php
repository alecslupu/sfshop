<?php


abstract class BaseMenuI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $culture;


	
	protected $title;


	
	protected $meta_keywords;


	
	protected $meta_description;

	
	protected $aMenu;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCulture()
	{

		return $this->culture;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getMetaKeywords()
	{

		return $this->meta_keywords;
	}

	
	public function getMetaDescription()
	{

		return $this->meta_description;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = MenuI18nPeer::ID;
		}

		if ($this->aMenu !== null && $this->aMenu->getId() !== $v) {
			$this->aMenu = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = MenuI18nPeer::CULTURE;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = MenuI18nPeer::TITLE;
		}

	} 
	
	public function setMetaKeywords($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->meta_keywords !== $v) {
			$this->meta_keywords = $v;
			$this->modifiedColumns[] = MenuI18nPeer::META_KEYWORDS;
		}

	} 
	
	public function setMetaDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->meta_description !== $v) {
			$this->meta_description = $v;
			$this->modifiedColumns[] = MenuI18nPeer::META_DESCRIPTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->culture = $rs->getString($startcol + 1);

			$this->title = $rs->getString($startcol + 2);

			$this->meta_keywords = $rs->getString($startcol + 3);

			$this->meta_description = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating MenuI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseMenuI18n:delete:pre') as $callable)
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
			$con = Propel::getConnection(MenuI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MenuI18nPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMenuI18n:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseMenuI18n:save:pre') as $callable)
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
			$con = Propel::getConnection(MenuI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMenuI18n:save:post') as $callable)
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


												
			if ($this->aMenu !== null) {
				if ($this->aMenu->isModified() || ($this->aMenu->getCulture() && $this->aMenu->getCurrentMenuI18n()->isModified())) {
					$affectedRows += $this->aMenu->save($con);
				}
				$this->setMenu($this->aMenu);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MenuI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += MenuI18nPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aMenu !== null) {
				if (!$this->aMenu->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMenu->getValidationFailures());
				}
			}


			if (($retval = MenuI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MenuI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCulture();
				break;
			case 2:
				return $this->getTitle();
				break;
			case 3:
				return $this->getMetaKeywords();
				break;
			case 4:
				return $this->getMetaDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MenuI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCulture(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getMetaKeywords(),
			$keys[4] => $this->getMetaDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MenuI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCulture($value);
				break;
			case 2:
				$this->setTitle($value);
				break;
			case 3:
				$this->setMetaKeywords($value);
				break;
			case 4:
				$this->setMetaDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MenuI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCulture($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMetaKeywords($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMetaDescription($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MenuI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(MenuI18nPeer::ID)) $criteria->add(MenuI18nPeer::ID, $this->id);
		if ($this->isColumnModified(MenuI18nPeer::CULTURE)) $criteria->add(MenuI18nPeer::CULTURE, $this->culture);
		if ($this->isColumnModified(MenuI18nPeer::TITLE)) $criteria->add(MenuI18nPeer::TITLE, $this->title);
		if ($this->isColumnModified(MenuI18nPeer::META_KEYWORDS)) $criteria->add(MenuI18nPeer::META_KEYWORDS, $this->meta_keywords);
		if ($this->isColumnModified(MenuI18nPeer::META_DESCRIPTION)) $criteria->add(MenuI18nPeer::META_DESCRIPTION, $this->meta_description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MenuI18nPeer::DATABASE_NAME);

		$criteria->add(MenuI18nPeer::ID, $this->id);
		$criteria->add(MenuI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setCulture($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTitle($this->title);

		$copyObj->setMetaKeywords($this->meta_keywords);

		$copyObj->setMetaDescription($this->meta_description);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
		$copyObj->setCulture(NULL); 
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
			self::$peer = new MenuI18nPeer();
		}
		return self::$peer;
	}

	
	public function setMenu($v)
	{


		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}


		$this->aMenu = $v;
	}


	
	public function getMenu($con = null)
	{
		if ($this->aMenu === null && ($this->id !== null)) {
						$this->aMenu = MenuPeer::retrieveByPK($this->id, $con);

			
		}
		return $this->aMenu;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMenuI18n:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMenuI18n::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 