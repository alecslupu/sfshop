<?php


abstract class BaseMemberSecretQuestionI18n extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $culture;


	
	protected $question;

	
	protected $aMemberSecretQuestion;

	
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

	
	public function getQuestion()
	{

		return $this->question;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = MemberSecretQuestionI18nPeer::ID;
		}

		if ($this->aMemberSecretQuestion !== null && $this->aMemberSecretQuestion->getId() !== $v) {
			$this->aMemberSecretQuestion = null;
		}

	} 
	
	public function setCulture($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->culture !== $v) {
			$this->culture = $v;
			$this->modifiedColumns[] = MemberSecretQuestionI18nPeer::CULTURE;
		}

	} 
	
	public function setQuestion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->question !== $v) {
			$this->question = $v;
			$this->modifiedColumns[] = MemberSecretQuestionI18nPeer::QUESTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->culture = $rs->getString($startcol + 1);

			$this->question = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating MemberSecretQuestionI18n object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18n:delete:pre') as $callable)
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
			$con = Propel::getConnection(MemberSecretQuestionI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MemberSecretQuestionI18nPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18n:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18n:save:pre') as $callable)
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
			$con = Propel::getConnection(MemberSecretQuestionI18nPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18n:save:post') as $callable)
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


												
			if ($this->aMemberSecretQuestion !== null) {
				if ($this->aMemberSecretQuestion->isModified() || ($this->aMemberSecretQuestion->getCulture() && $this->aMemberSecretQuestion->getCurrentMemberSecretQuestionI18n()->isModified())) {
					$affectedRows += $this->aMemberSecretQuestion->save($con);
				}
				$this->setMemberSecretQuestion($this->aMemberSecretQuestion);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MemberSecretQuestionI18nPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += MemberSecretQuestionI18nPeer::doUpdate($this, $con);
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


												
			if ($this->aMemberSecretQuestion !== null) {
				if (!$this->aMemberSecretQuestion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMemberSecretQuestion->getValidationFailures());
				}
			}


			if (($retval = MemberSecretQuestionI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MemberSecretQuestionI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getQuestion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MemberSecretQuestionI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCulture(),
			$keys[2] => $this->getQuestion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MemberSecretQuestionI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setQuestion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MemberSecretQuestionI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCulture($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setQuestion($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MemberSecretQuestionI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(MemberSecretQuestionI18nPeer::ID)) $criteria->add(MemberSecretQuestionI18nPeer::ID, $this->id);
		if ($this->isColumnModified(MemberSecretQuestionI18nPeer::CULTURE)) $criteria->add(MemberSecretQuestionI18nPeer::CULTURE, $this->culture);
		if ($this->isColumnModified(MemberSecretQuestionI18nPeer::QUESTION)) $criteria->add(MemberSecretQuestionI18nPeer::QUESTION, $this->question);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MemberSecretQuestionI18nPeer::DATABASE_NAME);

		$criteria->add(MemberSecretQuestionI18nPeer::ID, $this->id);
		$criteria->add(MemberSecretQuestionI18nPeer::CULTURE, $this->culture);

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

		$copyObj->setQuestion($this->question);


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
			self::$peer = new MemberSecretQuestionI18nPeer();
		}
		return self::$peer;
	}

	
	public function setMemberSecretQuestion($v)
	{


		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}


		$this->aMemberSecretQuestion = $v;
	}


	
	public function getMemberSecretQuestion($con = null)
	{
		if ($this->aMemberSecretQuestion === null && ($this->id !== null)) {
						$this->aMemberSecretQuestion = MemberSecretQuestionPeer::retrieveByPK($this->id, $con);

			
		}
		return $this->aMemberSecretQuestion;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMemberSecretQuestionI18n:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMemberSecretQuestionI18n::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 