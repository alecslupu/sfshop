<?php


abstract class BaseEmailTemplateI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $culture;


	
	protected $subject;


	
	protected $body;

	
	protected $aEmailTemplate;

	
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

	
	public function getSubject()
	{

		return $this->subject;
	}

	
	public function getBody()
	{

		return $this->body;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = EmailTemplateI18nPeer::ID;
		}

		if ($this->aEmailTemplate !== null && $this->aEmailTemplate->getId() !== $v) {
			$this->aEmailTemplate = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = EmailTemplateI18nPeer::CULTURE;
		}

	} 
	
	public function setSubject($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->subject !== $v) {
			$this->subject = $v;
			$this->modifiedColumns[] = EmailTemplateI18nPeer::SUBJECT;
		}

	} 
	
	public function setBody($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->body !== $v) {
			$this->body = $v;
			$this->modifiedColumns[] = EmailTemplateI18nPeer::BODY;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->culture = $rs->getString($startcol + 1);

			$this->subject = $rs->getString($startcol + 2);

			$this->body = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EmailTemplateI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailTemplateI18n:delete:pre') as $callable)
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
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EmailTemplateI18nPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseEmailTemplateI18n:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailTemplateI18n:save:pre') as $callable)
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
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseEmailTemplateI18n:save:post') as $callable)
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


												
			if ($this->aEmailTemplate !== null) {
				if ($this->aEmailTemplate->isModified() || ($this->aEmailTemplate->getCulture() && $this->aEmailTemplate->getCurrentEmailTemplateI18n()->isModified())) {
					$affectedRows += $this->aEmailTemplate->save($con);
				}
				$this->setEmailTemplate($this->aEmailTemplate);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailTemplateI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += EmailTemplateI18nPeer::doUpdate($this, $con);
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


												
			if ($this->aEmailTemplate !== null) {
				if (!$this->aEmailTemplate->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmailTemplate->getValidationFailures());
				}
			}


			if (($retval = EmailTemplateI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailTemplateI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSubject();
				break;
			case 3:
				return $this->getBody();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailTemplateI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCulture(),
			$keys[2] => $this->getSubject(),
			$keys[3] => $this->getBody(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailTemplateI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSubject($value);
				break;
			case 3:
				$this->setBody($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailTemplateI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCulture($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSubject($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBody($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailTemplateI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailTemplateI18nPeer::ID)) $criteria->add(EmailTemplateI18nPeer::ID, $this->id);
		if ($this->isColumnModified(EmailTemplateI18nPeer::CULTURE)) $criteria->add(EmailTemplateI18nPeer::CULTURE, $this->culture);
		if ($this->isColumnModified(EmailTemplateI18nPeer::SUBJECT)) $criteria->add(EmailTemplateI18nPeer::SUBJECT, $this->subject);
		if ($this->isColumnModified(EmailTemplateI18nPeer::BODY)) $criteria->add(EmailTemplateI18nPeer::BODY, $this->body);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailTemplateI18nPeer::DATABASE_NAME);

		$criteria->add(EmailTemplateI18nPeer::ID, $this->id);
		$criteria->add(EmailTemplateI18nPeer::CULTURE, $this->culture);

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

		$copyObj->setSubject($this->subject);

		$copyObj->setBody($this->body);


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
			self::$peer = new EmailTemplateI18nPeer();
		}
		return self::$peer;
	}

	
	public function setEmailTemplate($v)
	{


		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}


		$this->aEmailTemplate = $v;
	}


	
	public function getEmailTemplate($con = null)
	{
		if ($this->aEmailTemplate === null && ($this->id !== null)) {
						$this->aEmailTemplate = EmailTemplatePeer::retrieveByPK($this->id, $con);

			
		}
		return $this->aEmailTemplate;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseEmailTemplateI18n:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseEmailTemplateI18n::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 