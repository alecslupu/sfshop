<?php


abstract class BaseOrderProduct2OptionProduct extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $order_product_id;


	
	protected $option_product_id;


	
	protected $created_at;

	
	protected $aOrderProduct;

	
	protected $aOptionProduct;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getOrderProductId()
	{

		return $this->order_product_id;
	}

	
	public function getOptionProductId()
	{

		return $this->option_product_id;
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

	
	public function setOrderProductId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->order_product_id !== $v) {
			$this->order_product_id = $v;
			$this->modifiedColumns[] = OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID;
		}

		if ($this->aOrderProduct !== null && $this->aOrderProduct->getId() !== $v) {
			$this->aOrderProduct = null;
		}

	} 
	
	public function setOptionProductId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->option_product_id !== $v) {
			$this->option_product_id = $v;
			$this->modifiedColumns[] = OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID;
		}

		if ($this->aOptionProduct !== null && $this->aOptionProduct->getId() !== $v) {
			$this->aOptionProduct = null;
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
			$this->modifiedColumns[] = OrderProduct2OptionProductPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->order_product_id = $rs->getInt($startcol + 0);

			$this->option_product_id = $rs->getInt($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OrderProduct2OptionProduct object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProduct:delete:pre') as $callable)
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
			$con = Propel::getConnection(OrderProduct2OptionProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OrderProduct2OptionProductPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProduct:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProduct:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(OrderProduct2OptionProductPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OrderProduct2OptionProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProduct:save:post') as $callable)
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


												
			if ($this->aOrderProduct !== null) {
				if ($this->aOrderProduct->isModified()) {
					$affectedRows += $this->aOrderProduct->save($con);
				}
				$this->setOrderProduct($this->aOrderProduct);
			}

			if ($this->aOptionProduct !== null) {
				if ($this->aOptionProduct->isModified()) {
					$affectedRows += $this->aOptionProduct->save($con);
				}
				$this->setOptionProduct($this->aOptionProduct);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OrderProduct2OptionProductPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OrderProduct2OptionProductPeer::doUpdate($this, $con);
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


												
			if ($this->aOrderProduct !== null) {
				if (!$this->aOrderProduct->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOrderProduct->getValidationFailures());
				}
			}

			if ($this->aOptionProduct !== null) {
				if (!$this->aOptionProduct->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOptionProduct->getValidationFailures());
				}
			}


			if (($retval = OrderProduct2OptionProductPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrderProduct2OptionProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getOrderProductId();
				break;
			case 1:
				return $this->getOptionProductId();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrderProduct2OptionProductPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOrderProductId(),
			$keys[1] => $this->getOptionProductId(),
			$keys[2] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OrderProduct2OptionProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setOrderProductId($value);
				break;
			case 1:
				$this->setOptionProductId($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OrderProduct2OptionProductPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOrderProductId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOptionProductId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OrderProduct2OptionProductPeer::DATABASE_NAME);

		if ($this->isColumnModified(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID)) $criteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $this->order_product_id);
		if ($this->isColumnModified(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID)) $criteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->option_product_id);
		if ($this->isColumnModified(OrderProduct2OptionProductPeer::CREATED_AT)) $criteria->add(OrderProduct2OptionProductPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OrderProduct2OptionProductPeer::DATABASE_NAME);

		$criteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $this->order_product_id);
		$criteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $this->option_product_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getOrderProductId();

		$pks[1] = $this->getOptionProductId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setOrderProductId($keys[0]);

		$this->setOptionProductId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);


		$copyObj->setNew(true);

		$copyObj->setOrderProductId(NULL); 
		$copyObj->setOptionProductId(NULL); 
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
			self::$peer = new OrderProduct2OptionProductPeer();
		}
		return self::$peer;
	}

	
	public function setOrderProduct($v)
	{


		if ($v === null) {
			$this->setOrderProductId(NULL);
		} else {
			$this->setOrderProductId($v->getId());
		}


		$this->aOrderProduct = $v;
	}


	
	public function getOrderProduct($con = null)
	{
		if ($this->aOrderProduct === null && ($this->order_product_id !== null)) {
						$this->aOrderProduct = OrderProductPeer::retrieveByPK($this->order_product_id, $con);

			
		}
		return $this->aOrderProduct;
	}

	
	public function setOptionProduct($v)
	{


		if ($v === null) {
			$this->setOptionProductId(NULL);
		} else {
			$this->setOptionProductId($v->getId());
		}


		$this->aOptionProduct = $v;
	}


	
	public function getOptionProduct($con = null)
	{
		if ($this->aOptionProduct === null && ($this->option_product_id !== null)) {
						$this->aOptionProduct = OptionProductPeer::retrieveByPK($this->option_product_id, $con);

			
		}
		return $this->aOptionProduct;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseOrderProduct2OptionProduct:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseOrderProduct2OptionProduct::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 