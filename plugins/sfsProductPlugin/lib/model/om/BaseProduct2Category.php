<?php


abstract class BaseProduct2Category extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $product_id;


	
	protected $category_id;


	
	protected $pos = 0;


	
	protected $created_at;

	
	protected $aProduct;

	
	protected $aCategory;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getProductId()
	{

		return $this->product_id;
	}

	
	public function getCategoryId()
	{

		return $this->category_id;
	}

	
	public function getPos()
	{

		return $this->pos;
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

	
	public function setProductId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_id !== $v) {
			$this->product_id = $v;
			$this->modifiedColumns[] = Product2CategoryPeer::PRODUCT_ID;
		}

		if ($this->aProduct !== null && $this->aProduct->getId() !== $v) {
			$this->aProduct = null;
		}

	} 
	
	public function setCategoryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = Product2CategoryPeer::CATEGORY_ID;
		}

		if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
			$this->aCategory = null;
		}

	} 
	
	public function setPos($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pos !== $v || $v === 0) {
			$this->pos = $v;
			$this->modifiedColumns[] = Product2CategoryPeer::POS;
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
			$this->modifiedColumns[] = Product2CategoryPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->product_id = $rs->getInt($startcol + 0);

			$this->category_id = $rs->getInt($startcol + 1);

			$this->pos = $rs->getInt($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Product2Category object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2Category:delete:pre') as $callable)
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
			$con = Propel::getConnection(Product2CategoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Product2CategoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseProduct2Category:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2Category:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(Product2CategoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(Product2CategoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseProduct2Category:save:post') as $callable)
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


												
			if ($this->aProduct !== null) {
				if ($this->aProduct->isModified() || ($this->aProduct->getCulture() && $this->aProduct->getCurrentProductI18n()->isModified())) {
					$affectedRows += $this->aProduct->save($con);
				}
				$this->setProduct($this->aProduct);
			}

			if ($this->aCategory !== null) {
				if ($this->aCategory->isModified() || ($this->aCategory->getCulture() && $this->aCategory->getCurrentCategoryI18n()->isModified())) {
					$affectedRows += $this->aCategory->save($con);
				}
				$this->setCategory($this->aCategory);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Product2CategoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += Product2CategoryPeer::doUpdate($this, $con);
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


												
			if ($this->aProduct !== null) {
				if (!$this->aProduct->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProduct->getValidationFailures());
				}
			}

			if ($this->aCategory !== null) {
				if (!$this->aCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCategory->getValidationFailures());
				}
			}


			if (($retval = Product2CategoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Product2CategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getProductId();
				break;
			case 1:
				return $this->getCategoryId();
				break;
			case 2:
				return $this->getPos();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Product2CategoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getProductId(),
			$keys[1] => $this->getCategoryId(),
			$keys[2] => $this->getPos(),
			$keys[3] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Product2CategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setProductId($value);
				break;
			case 1:
				$this->setCategoryId($value);
				break;
			case 2:
				$this->setPos($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Product2CategoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setProductId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCategoryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPos($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Product2CategoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(Product2CategoryPeer::PRODUCT_ID)) $criteria->add(Product2CategoryPeer::PRODUCT_ID, $this->product_id);
		if ($this->isColumnModified(Product2CategoryPeer::CATEGORY_ID)) $criteria->add(Product2CategoryPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(Product2CategoryPeer::POS)) $criteria->add(Product2CategoryPeer::POS, $this->pos);
		if ($this->isColumnModified(Product2CategoryPeer::CREATED_AT)) $criteria->add(Product2CategoryPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Product2CategoryPeer::DATABASE_NAME);

		$criteria->add(Product2CategoryPeer::PRODUCT_ID, $this->product_id);
		$criteria->add(Product2CategoryPeer::CATEGORY_ID, $this->category_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getProductId();

		$pks[1] = $this->getCategoryId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setProductId($keys[0]);

		$this->setCategoryId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPos($this->pos);

		$copyObj->setCreatedAt($this->created_at);


		$copyObj->setNew(true);

		$copyObj->setProductId(NULL); 
		$copyObj->setCategoryId(NULL); 
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
			self::$peer = new Product2CategoryPeer();
		}
		return self::$peer;
	}

	
	public function setProduct($v)
	{


		if ($v === null) {
			$this->setProductId(NULL);
		} else {
			$this->setProductId($v->getId());
		}


		$this->aProduct = $v;
	}


	
	public function getProduct($con = null)
	{
		if ($this->aProduct === null && ($this->product_id !== null)) {
						$this->aProduct = ProductPeer::retrieveByPK($this->product_id, $con);

			
		}
		return $this->aProduct;
	}

	
	public function setCategory($v)
	{


		if ($v === null) {
			$this->setCategoryId(NULL);
		} else {
			$this->setCategoryId($v->getId());
		}


		$this->aCategory = $v;
	}


	
	public function getCategory($con = null)
	{
		if ($this->aCategory === null && ($this->category_id !== null)) {
						$this->aCategory = CategoryPeer::retrieveByPK($this->category_id, $con);

			
		}
		return $this->aCategory;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseProduct2Category:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseProduct2Category::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 