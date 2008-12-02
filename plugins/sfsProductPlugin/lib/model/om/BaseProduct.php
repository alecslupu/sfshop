<?php


abstract class BaseProduct extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $brand_id;


	
	protected $price;


	
	protected $quantity = 0;


	
	protected $weight;


	
	protected $cube;


	
	protected $has_options = 0;


	
	protected $is_active = true;


	
	protected $is_deleted = false;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aBrand;

	
	protected $collBasketProducts;

	
	protected $lastBasketProductCriteria = null;

	
	protected $collProductI18ns;

	
	protected $lastProductI18nCriteria = null;

	
	protected $collOptionProducts;

	
	protected $lastOptionProductCriteria = null;

	
	protected $collProduct2Categorys;

	
	protected $lastProduct2CategoryCriteria = null;

	
	protected $collOrderProducts;

	
	protected $lastOrderProductCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getBrandId()
	{

		return $this->brand_id;
	}

	
	public function getPrice()
	{

		return $this->price;
	}

	
	public function getQuantity()
	{

		return $this->quantity;
	}

	
	public function getWeight()
	{

		return $this->weight;
	}

	
	public function getCube()
	{

		return $this->cube;
	}

	
	public function getHasOptions()
	{

		return $this->has_options;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getIsDeleted()
	{

		return $this->is_deleted;
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
			$this->modifiedColumns[] = ProductPeer::ID;
		}

	} 
	
	public function setBrandId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->brand_id !== $v) {
			$this->brand_id = $v;
			$this->modifiedColumns[] = ProductPeer::BRAND_ID;
		}

		if ($this->aBrand !== null && $this->aBrand->getId() !== $v) {
			$this->aBrand = null;
		}

	} 
	
	public function setPrice($v)
	{

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = ProductPeer::PRICE;
		}

	} 
	
	public function setQuantity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v || $v === 0) {
			$this->quantity = $v;
			$this->modifiedColumns[] = ProductPeer::QUANTITY;
		}

	} 
	
	public function setWeight($v)
	{

		if ($this->weight !== $v) {
			$this->weight = $v;
			$this->modifiedColumns[] = ProductPeer::WEIGHT;
		}

	} 
	
	public function setCube($v)
	{

		if ($this->cube !== $v) {
			$this->cube = $v;
			$this->modifiedColumns[] = ProductPeer::CUBE;
		}

	} 
	
	public function setHasOptions($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->has_options !== $v || $v === 0) {
			$this->has_options = $v;
			$this->modifiedColumns[] = ProductPeer::HAS_OPTIONS;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = ProductPeer::IS_ACTIVE;
		}

	} 
	
	public function setIsDeleted($v)
	{

		if ($this->is_deleted !== $v || $v === false) {
			$this->is_deleted = $v;
			$this->modifiedColumns[] = ProductPeer::IS_DELETED;
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
			$this->modifiedColumns[] = ProductPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProductPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->brand_id = $rs->getInt($startcol + 1);

			$this->price = $rs->getFloat($startcol + 2);

			$this->quantity = $rs->getInt($startcol + 3);

			$this->weight = $rs->getFloat($startcol + 4);

			$this->cube = $rs->getFloat($startcol + 5);

			$this->has_options = $rs->getInt($startcol + 6);

			$this->is_active = $rs->getBoolean($startcol + 7);

			$this->is_deleted = $rs->getBoolean($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Product object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct:delete:pre') as $callable)
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
			$con = Propel::getConnection(ProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProductPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseProduct:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ProductPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProductPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseProduct:save:post') as $callable)
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


												
			if ($this->aBrand !== null) {
				if ($this->aBrand->isModified() || ($this->aBrand->getCulture() && $this->aBrand->getCurrentBrandI18n()->isModified())) {
					$affectedRows += $this->aBrand->save($con);
				}
				$this->setBrand($this->aBrand);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProductPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProductPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collBasketProducts !== null) {
				foreach($this->collBasketProducts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProductI18ns !== null) {
				foreach($this->collProductI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOptionProducts !== null) {
				foreach($this->collOptionProducts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProduct2Categorys !== null) {
				foreach($this->collProduct2Categorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderProducts !== null) {
				foreach($this->collOrderProducts as $referrerFK) {
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


												
			if ($this->aBrand !== null) {
				if (!$this->aBrand->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBrand->getValidationFailures());
				}
			}


			if (($retval = ProductPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBasketProducts !== null) {
					foreach($this->collBasketProducts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProductI18ns !== null) {
					foreach($this->collProductI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOptionProducts !== null) {
					foreach($this->collOptionProducts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProduct2Categorys !== null) {
					foreach($this->collProduct2Categorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderProducts !== null) {
					foreach($this->collOrderProducts as $referrerFK) {
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
		$pos = ProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getBrandId();
				break;
			case 2:
				return $this->getPrice();
				break;
			case 3:
				return $this->getQuantity();
				break;
			case 4:
				return $this->getWeight();
				break;
			case 5:
				return $this->getCube();
				break;
			case 6:
				return $this->getHasOptions();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getIsDeleted();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			case 10:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProductPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getBrandId(),
			$keys[2] => $this->getPrice(),
			$keys[3] => $this->getQuantity(),
			$keys[4] => $this->getWeight(),
			$keys[5] => $this->getCube(),
			$keys[6] => $this->getHasOptions(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getIsDeleted(),
			$keys[9] => $this->getCreatedAt(),
			$keys[10] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setBrandId($value);
				break;
			case 2:
				$this->setPrice($value);
				break;
			case 3:
				$this->setQuantity($value);
				break;
			case 4:
				$this->setWeight($value);
				break;
			case 5:
				$this->setCube($value);
				break;
			case 6:
				$this->setHasOptions($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setIsDeleted($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
			case 10:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProductPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setBrandId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPrice($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setQuantity($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setWeight($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCube($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHasOptions($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsDeleted($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProductPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProductPeer::ID)) $criteria->add(ProductPeer::ID, $this->id);
		if ($this->isColumnModified(ProductPeer::BRAND_ID)) $criteria->add(ProductPeer::BRAND_ID, $this->brand_id);
		if ($this->isColumnModified(ProductPeer::PRICE)) $criteria->add(ProductPeer::PRICE, $this->price);
		if ($this->isColumnModified(ProductPeer::QUANTITY)) $criteria->add(ProductPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(ProductPeer::WEIGHT)) $criteria->add(ProductPeer::WEIGHT, $this->weight);
		if ($this->isColumnModified(ProductPeer::CUBE)) $criteria->add(ProductPeer::CUBE, $this->cube);
		if ($this->isColumnModified(ProductPeer::HAS_OPTIONS)) $criteria->add(ProductPeer::HAS_OPTIONS, $this->has_options);
		if ($this->isColumnModified(ProductPeer::IS_ACTIVE)) $criteria->add(ProductPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(ProductPeer::IS_DELETED)) $criteria->add(ProductPeer::IS_DELETED, $this->is_deleted);
		if ($this->isColumnModified(ProductPeer::CREATED_AT)) $criteria->add(ProductPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProductPeer::UPDATED_AT)) $criteria->add(ProductPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProductPeer::DATABASE_NAME);

		$criteria->add(ProductPeer::ID, $this->id);

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

		$copyObj->setBrandId($this->brand_id);

		$copyObj->setPrice($this->price);

		$copyObj->setQuantity($this->quantity);

		$copyObj->setWeight($this->weight);

		$copyObj->setCube($this->cube);

		$copyObj->setHasOptions($this->has_options);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsDeleted($this->is_deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getBasketProducts() as $relObj) {
				$copyObj->addBasketProduct($relObj->copy($deepCopy));
			}

			foreach($this->getProductI18ns() as $relObj) {
				$copyObj->addProductI18n($relObj->copy($deepCopy));
			}

			foreach($this->getOptionProducts() as $relObj) {
				$copyObj->addOptionProduct($relObj->copy($deepCopy));
			}

			foreach($this->getProduct2Categorys() as $relObj) {
				$copyObj->addProduct2Category($relObj->copy($deepCopy));
			}

			foreach($this->getOrderProducts() as $relObj) {
				$copyObj->addOrderProduct($relObj->copy($deepCopy));
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
			self::$peer = new ProductPeer();
		}
		return self::$peer;
	}

	
	public function setBrand($v)
	{


		if ($v === null) {
			$this->setBrandId(NULL);
		} else {
			$this->setBrandId($v->getId());
		}


		$this->aBrand = $v;
	}


	
	public function getBrand($con = null)
	{
		if ($this->aBrand === null && ($this->brand_id !== null)) {
						$this->aBrand = BrandPeer::retrieveByPK($this->brand_id, $con);

			
		}
		return $this->aBrand;
	}

	
	public function initBasketProducts()
	{
		if ($this->collBasketProducts === null) {
			$this->collBasketProducts = array();
		}
	}

	
	public function getBasketProducts($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBasketProducts === null) {
			if ($this->isNew()) {
			   $this->collBasketProducts = array();
			} else {

				$criteria->add(BasketProductPeer::PRODUCT_ID, $this->getId());

				BasketProductPeer::addSelectColumns($criteria);
				$this->collBasketProducts = BasketProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BasketProductPeer::PRODUCT_ID, $this->getId());

				BasketProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastBasketProductCriteria) || !$this->lastBasketProductCriteria->equals($criteria)) {
					$this->collBasketProducts = BasketProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBasketProductCriteria = $criteria;
		return $this->collBasketProducts;
	}

	
	public function countBasketProducts($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BasketProductPeer::PRODUCT_ID, $this->getId());

		return BasketProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBasketProduct(BasketProduct $l)
	{
		$this->collBasketProducts[] = $l;
		$l->setProduct($this);
	}


	
	public function getBasketProductsJoinBasket($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBasketProducts === null) {
			if ($this->isNew()) {
				$this->collBasketProducts = array();
			} else {

				$criteria->add(BasketProductPeer::PRODUCT_ID, $this->getId());

				$this->collBasketProducts = BasketProductPeer::doSelectJoinBasket($criteria, $con);
			}
		} else {
									
			$criteria->add(BasketProductPeer::PRODUCT_ID, $this->getId());

			if (!isset($this->lastBasketProductCriteria) || !$this->lastBasketProductCriteria->equals($criteria)) {
				$this->collBasketProducts = BasketProductPeer::doSelectJoinBasket($criteria, $con);
			}
		}
		$this->lastBasketProductCriteria = $criteria;

		return $this->collBasketProducts;
	}

	
	public function initProductI18ns()
	{
		if ($this->collProductI18ns === null) {
			$this->collProductI18ns = array();
		}
	}

	
	public function getProductI18ns($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductI18ns === null) {
			if ($this->isNew()) {
			   $this->collProductI18ns = array();
			} else {

				$criteria->add(ProductI18nPeer::ID, $this->getId());

				ProductI18nPeer::addSelectColumns($criteria);
				$this->collProductI18ns = ProductI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProductI18nPeer::ID, $this->getId());

				ProductI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastProductI18nCriteria) || !$this->lastProductI18nCriteria->equals($criteria)) {
					$this->collProductI18ns = ProductI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProductI18nCriteria = $criteria;
		return $this->collProductI18ns;
	}

	
	public function countProductI18ns($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProductI18nPeer::ID, $this->getId());

		return ProductI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProductI18n(ProductI18n $l)
	{
		$this->collProductI18ns[] = $l;
		$l->setProduct($this);
	}

	
	public function initOptionProducts()
	{
		if ($this->collOptionProducts === null) {
			$this->collOptionProducts = array();
		}
	}

	
	public function getOptionProducts($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOptionProducts === null) {
			if ($this->isNew()) {
			   $this->collOptionProducts = array();
			} else {

				$criteria->add(OptionProductPeer::PRODUCT_ID, $this->getId());

				OptionProductPeer::addSelectColumns($criteria);
				$this->collOptionProducts = OptionProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OptionProductPeer::PRODUCT_ID, $this->getId());

				OptionProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastOptionProductCriteria) || !$this->lastOptionProductCriteria->equals($criteria)) {
					$this->collOptionProducts = OptionProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOptionProductCriteria = $criteria;
		return $this->collOptionProducts;
	}

	
	public function countOptionProducts($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OptionProductPeer::PRODUCT_ID, $this->getId());

		return OptionProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOptionProduct(OptionProduct $l)
	{
		$this->collOptionProducts[] = $l;
		$l->setProduct($this);
	}


	
	public function getOptionProductsJoinOptionValue($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOptionProducts === null) {
			if ($this->isNew()) {
				$this->collOptionProducts = array();
			} else {

				$criteria->add(OptionProductPeer::PRODUCT_ID, $this->getId());

				$this->collOptionProducts = OptionProductPeer::doSelectJoinOptionValue($criteria, $con);
			}
		} else {
									
			$criteria->add(OptionProductPeer::PRODUCT_ID, $this->getId());

			if (!isset($this->lastOptionProductCriteria) || !$this->lastOptionProductCriteria->equals($criteria)) {
				$this->collOptionProducts = OptionProductPeer::doSelectJoinOptionValue($criteria, $con);
			}
		}
		$this->lastOptionProductCriteria = $criteria;

		return $this->collOptionProducts;
	}

	
	public function initProduct2Categorys()
	{
		if ($this->collProduct2Categorys === null) {
			$this->collProduct2Categorys = array();
		}
	}

	
	public function getProduct2Categorys($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProduct2Categorys === null) {
			if ($this->isNew()) {
			   $this->collProduct2Categorys = array();
			} else {

				$criteria->add(Product2CategoryPeer::PRODUCT_ID, $this->getId());

				Product2CategoryPeer::addSelectColumns($criteria);
				$this->collProduct2Categorys = Product2CategoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Product2CategoryPeer::PRODUCT_ID, $this->getId());

				Product2CategoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastProduct2CategoryCriteria) || !$this->lastProduct2CategoryCriteria->equals($criteria)) {
					$this->collProduct2Categorys = Product2CategoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProduct2CategoryCriteria = $criteria;
		return $this->collProduct2Categorys;
	}

	
	public function countProduct2Categorys($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Product2CategoryPeer::PRODUCT_ID, $this->getId());

		return Product2CategoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProduct2Category(Product2Category $l)
	{
		$this->collProduct2Categorys[] = $l;
		$l->setProduct($this);
	}


	
	public function getProduct2CategorysJoinCategory($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProduct2Categorys === null) {
			if ($this->isNew()) {
				$this->collProduct2Categorys = array();
			} else {

				$criteria->add(Product2CategoryPeer::PRODUCT_ID, $this->getId());

				$this->collProduct2Categorys = Product2CategoryPeer::doSelectJoinCategory($criteria, $con);
			}
		} else {
									
			$criteria->add(Product2CategoryPeer::PRODUCT_ID, $this->getId());

			if (!isset($this->lastProduct2CategoryCriteria) || !$this->lastProduct2CategoryCriteria->equals($criteria)) {
				$this->collProduct2Categorys = Product2CategoryPeer::doSelectJoinCategory($criteria, $con);
			}
		}
		$this->lastProduct2CategoryCriteria = $criteria;

		return $this->collProduct2Categorys;
	}

	
	public function initOrderProducts()
	{
		if ($this->collOrderProducts === null) {
			$this->collOrderProducts = array();
		}
	}

	
	public function getOrderProducts($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderProducts === null) {
			if ($this->isNew()) {
			   $this->collOrderProducts = array();
			} else {

				$criteria->add(OrderProductPeer::PRODUCT_ID, $this->getId());

				OrderProductPeer::addSelectColumns($criteria);
				$this->collOrderProducts = OrderProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderProductPeer::PRODUCT_ID, $this->getId());

				OrderProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderProductCriteria) || !$this->lastOrderProductCriteria->equals($criteria)) {
					$this->collOrderProducts = OrderProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderProductCriteria = $criteria;
		return $this->collOrderProducts;
	}

	
	public function countOrderProducts($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OrderProductPeer::PRODUCT_ID, $this->getId());

		return OrderProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOrderProduct(OrderProduct $l)
	{
		$this->collOrderProducts[] = $l;
		$l->setProduct($this);
	}


	
	public function getOrderProductsJoinOrderItem($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderProducts === null) {
			if ($this->isNew()) {
				$this->collOrderProducts = array();
			} else {

				$criteria->add(OrderProductPeer::PRODUCT_ID, $this->getId());

				$this->collOrderProducts = OrderProductPeer::doSelectJoinOrderItem($criteria, $con);
			}
		} else {
									
			$criteria->add(OrderProductPeer::PRODUCT_ID, $this->getId());

			if (!isset($this->lastOrderProductCriteria) || !$this->lastOrderProductCriteria->equals($criteria)) {
				$this->collOrderProducts = OrderProductPeer::doSelectJoinOrderItem($criteria, $con);
			}
		}
		$this->lastOrderProductCriteria = $criteria;

		return $this->collOrderProducts;
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
    return $this->getCurrentProductI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentProductI18n($culture)->setTitle($value);
  }

  public function getDescriptionShort($culture = null)
  {
    return $this->getCurrentProductI18n($culture)->getDescriptionShort();
  }

  public function setDescriptionShort($value, $culture = null)
  {
    $this->getCurrentProductI18n($culture)->setDescriptionShort($value);
  }

  public function getDescription($culture = null)
  {
    return $this->getCurrentProductI18n($culture)->getDescription();
  }

  public function setDescription($value, $culture = null)
  {
    $this->getCurrentProductI18n($culture)->setDescription($value);
  }

  public function getMetaKeywords($culture = null)
  {
    return $this->getCurrentProductI18n($culture)->getMetaKeywords();
  }

  public function setMetaKeywords($value, $culture = null)
  {
    $this->getCurrentProductI18n($culture)->setMetaKeywords($value);
  }

  public function getMetaDescription($culture = null)
  {
    return $this->getCurrentProductI18n($culture)->getMetaDescription();
  }

  public function setMetaDescription($value, $culture = null)
  {
    $this->getCurrentProductI18n($culture)->setMetaDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentProductI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = ProductI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setProductI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setProductI18nForCulture(new ProductI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setProductI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addProductI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseProduct:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseProduct::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 