<?php


abstract class BaseCountry extends BaseObject  implements Persistent {


  const PEER = 'CountryPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $iso;

	
	protected $iso_a3;

	
	protected $iso_n;

	
	protected $title_english;

	
	protected $is_active;

	
	protected $collAddressBooks;

	
	private $lastAddressBookCriteria = null;

	
	protected $collLocation2TaxGroups;

	
	private $lastLocation2TaxGroupCriteria = null;

	
	protected $collCountryI18ns;

	
	private $lastCountryI18nCriteria = null;

	
	protected $collStates;

	
	private $lastStateCriteria = null;

	
	protected $collOrderItemsRelatedByBillingCountryId;

	
	private $lastOrderItemRelatedByBillingCountryIdCriteria = null;

	
	protected $collOrderItemsRelatedByDeliveryCountryId;

	
	private $lastOrderItemRelatedByDeliveryCountryIdCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function applyDefaultValues()
	{
		$this->is_active = false;
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

	
	public function getIso()
	{
		return $this->iso;
	}

	
	public function getIsoA3()
	{
		return $this->iso_a3;
	}

	
	public function getIsoN()
	{
		return $this->iso_n;
	}

	
	public function getTitleEnglish()
	{
		return $this->title_english;
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
			$this->modifiedColumns[] = CountryPeer::ID;
		}

		return $this;
	} 
	
	public function setIso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->iso !== $v) {
			$this->iso = $v;
			$this->modifiedColumns[] = CountryPeer::ISO;
		}

		return $this;
	} 
	
	public function setIsoA3($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->iso_a3 !== $v) {
			$this->iso_a3 = $v;
			$this->modifiedColumns[] = CountryPeer::ISO_A3;
		}

		return $this;
	} 
	
	public function setIsoN($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->iso_n !== $v) {
			$this->iso_n = $v;
			$this->modifiedColumns[] = CountryPeer::ISO_N;
		}

		return $this;
	} 
	
	public function setTitleEnglish($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title_english !== $v) {
			$this->title_english = $v;
			$this->modifiedColumns[] = CountryPeer::TITLE_ENGLISH;
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
			$this->modifiedColumns[] = CountryPeer::IS_ACTIVE;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
			if ($this->is_active !== false) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->iso = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->iso_a3 = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->iso_n = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->title_english = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->is_active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Country object", $e);
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
			$con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CountryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collAddressBooks = null;
			$this->lastAddressBookCriteria = null;

			$this->collLocation2TaxGroups = null;
			$this->lastLocation2TaxGroupCriteria = null;

			$this->collCountryI18ns = null;
			$this->lastCountryI18nCriteria = null;

			$this->collStates = null;
			$this->lastStateCriteria = null;

			$this->collOrderItemsRelatedByBillingCountryId = null;
			$this->lastOrderItemRelatedByBillingCountryIdCriteria = null;

			$this->collOrderItemsRelatedByDeliveryCountryId = null;
			$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCountry:delete:pre') as $callable)
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
			$con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				CountryPeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseCountry:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCountry:save:pre') as $callable)
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
			$con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				CountryPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseCountry:save:post') as $callable)
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
				$this->modifiedColumns[] = CountryPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CountryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CountryPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collAddressBooks !== null) {
				foreach ($this->collAddressBooks as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLocation2TaxGroups !== null) {
				foreach ($this->collLocation2TaxGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCountryI18ns !== null) {
				foreach ($this->collCountryI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collStates !== null) {
				foreach ($this->collStates as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByBillingCountryId !== null) {
				foreach ($this->collOrderItemsRelatedByBillingCountryId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByDeliveryCountryId !== null) {
				foreach ($this->collOrderItemsRelatedByDeliveryCountryId as $referrerFK) {
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


			if (($retval = CountryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAddressBooks !== null) {
					foreach ($this->collAddressBooks as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLocation2TaxGroups !== null) {
					foreach ($this->collLocation2TaxGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCountryI18ns !== null) {
					foreach ($this->collCountryI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collStates !== null) {
					foreach ($this->collStates as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByBillingCountryId !== null) {
					foreach ($this->collOrderItemsRelatedByBillingCountryId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByDeliveryCountryId !== null) {
					foreach ($this->collOrderItemsRelatedByDeliveryCountryId as $referrerFK) {
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
		$pos = CountryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIso();
				break;
			case 2:
				return $this->getIsoA3();
				break;
			case 3:
				return $this->getIsoN();
				break;
			case 4:
				return $this->getTitleEnglish();
				break;
			case 5:
				return $this->getIsActive();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CountryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIso(),
			$keys[2] => $this->getIsoA3(),
			$keys[3] => $this->getIsoN(),
			$keys[4] => $this->getTitleEnglish(),
			$keys[5] => $this->getIsActive(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CountryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIso($value);
				break;
			case 2:
				$this->setIsoA3($value);
				break;
			case 3:
				$this->setIsoN($value);
				break;
			case 4:
				$this->setTitleEnglish($value);
				break;
			case 5:
				$this->setIsActive($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CountryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsoA3($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsoN($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTitleEnglish($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsActive($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CountryPeer::DATABASE_NAME);

		if ($this->isColumnModified(CountryPeer::ID)) $criteria->add(CountryPeer::ID, $this->id);
		if ($this->isColumnModified(CountryPeer::ISO)) $criteria->add(CountryPeer::ISO, $this->iso);
		if ($this->isColumnModified(CountryPeer::ISO_A3)) $criteria->add(CountryPeer::ISO_A3, $this->iso_a3);
		if ($this->isColumnModified(CountryPeer::ISO_N)) $criteria->add(CountryPeer::ISO_N, $this->iso_n);
		if ($this->isColumnModified(CountryPeer::TITLE_ENGLISH)) $criteria->add(CountryPeer::TITLE_ENGLISH, $this->title_english);
		if ($this->isColumnModified(CountryPeer::IS_ACTIVE)) $criteria->add(CountryPeer::IS_ACTIVE, $this->is_active);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CountryPeer::DATABASE_NAME);

		$criteria->add(CountryPeer::ID, $this->id);

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

		$copyObj->setIso($this->iso);

		$copyObj->setIsoA3($this->iso_a3);

		$copyObj->setIsoN($this->iso_n);

		$copyObj->setTitleEnglish($this->title_english);

		$copyObj->setIsActive($this->is_active);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getAddressBooks() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAddressBook($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getLocation2TaxGroups() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addLocation2TaxGroup($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCountryI18ns() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCountryI18n($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getStates() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addState($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getOrderItemsRelatedByBillingCountryId() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addOrderItemRelatedByBillingCountryId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getOrderItemsRelatedByDeliveryCountryId() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addOrderItemRelatedByDeliveryCountryId($relObj->copy($deepCopy));
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
			self::$peer = new CountryPeer();
		}
		return self::$peer;
	}

	
	public function clearAddressBooks()
	{
		$this->collAddressBooks = null; 	}

	
	public function initAddressBooks()
	{
		$this->collAddressBooks = array();
	}

	
	public function getAddressBooks($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
			   $this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

				AddressBookPeer::addSelectColumns($criteria);
				$this->collAddressBooks = AddressBookPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

				AddressBookPeer::addSelectColumns($criteria);
				if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
					$this->collAddressBooks = AddressBookPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAddressBookCriteria = $criteria;
		return $this->collAddressBooks;
	}

	
	public function countAddressBooks(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

				$count = AddressBookPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

				if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
					$count = AddressBookPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collAddressBooks);
				}
			} else {
				$count = count($this->collAddressBooks);
			}
		}
		return $count;
	}

	
	public function addAddressBook(AddressBook $l)
	{
		if ($this->collAddressBooks === null) {
			$this->initAddressBooks();
		}
		if (!in_array($l, $this->collAddressBooks, true)) { 			array_push($this->collAddressBooks, $l);
			$l->setCountry($this);
		}
	}


	
	public function getAddressBooksJoinMember($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
				$this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

				$this->collAddressBooks = AddressBookPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		}
		$this->lastAddressBookCriteria = $criteria;

		return $this->collAddressBooks;
	}


	
	public function getAddressBooksJoinState($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
				$this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

				$this->collAddressBooks = AddressBookPeer::doSelectJoinState($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinState($criteria, $con, $join_behavior);
			}
		}
		$this->lastAddressBookCriteria = $criteria;

		return $this->collAddressBooks;
	}


	
	public function getAddressBooksJoinTaxGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
				$this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

				$this->collAddressBooks = AddressBookPeer::doSelectJoinTaxGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AddressBookPeer::COUNTRY_ID, $this->id);

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinTaxGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastAddressBookCriteria = $criteria;

		return $this->collAddressBooks;
	}

	
	public function clearLocation2TaxGroups()
	{
		$this->collLocation2TaxGroups = null; 	}

	
	public function initLocation2TaxGroups()
	{
		$this->collLocation2TaxGroups = array();
	}

	
	public function getLocation2TaxGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLocation2TaxGroups === null) {
			if ($this->isNew()) {
			   $this->collLocation2TaxGroups = array();
			} else {

				$criteria->add(Location2TaxGroupPeer::COUNTRY_ID, $this->id);

				Location2TaxGroupPeer::addSelectColumns($criteria);
				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Location2TaxGroupPeer::COUNTRY_ID, $this->id);

				Location2TaxGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastLocation2TaxGroupCriteria) || !$this->lastLocation2TaxGroupCriteria->equals($criteria)) {
					$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLocation2TaxGroupCriteria = $criteria;
		return $this->collLocation2TaxGroups;
	}

	
	public function countLocation2TaxGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collLocation2TaxGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(Location2TaxGroupPeer::COUNTRY_ID, $this->id);

				$count = Location2TaxGroupPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Location2TaxGroupPeer::COUNTRY_ID, $this->id);

				if (!isset($this->lastLocation2TaxGroupCriteria) || !$this->lastLocation2TaxGroupCriteria->equals($criteria)) {
					$count = Location2TaxGroupPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collLocation2TaxGroups);
				}
			} else {
				$count = count($this->collLocation2TaxGroups);
			}
		}
		return $count;
	}

	
	public function addLocation2TaxGroup(Location2TaxGroup $l)
	{
		if ($this->collLocation2TaxGroups === null) {
			$this->initLocation2TaxGroups();
		}
		if (!in_array($l, $this->collLocation2TaxGroups, true)) { 			array_push($this->collLocation2TaxGroups, $l);
			$l->setCountry($this);
		}
	}


	
	public function getLocation2TaxGroupsJoinState($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLocation2TaxGroups === null) {
			if ($this->isNew()) {
				$this->collLocation2TaxGroups = array();
			} else {

				$criteria->add(Location2TaxGroupPeer::COUNTRY_ID, $this->id);

				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelectJoinState($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(Location2TaxGroupPeer::COUNTRY_ID, $this->id);

			if (!isset($this->lastLocation2TaxGroupCriteria) || !$this->lastLocation2TaxGroupCriteria->equals($criteria)) {
				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelectJoinState($criteria, $con, $join_behavior);
			}
		}
		$this->lastLocation2TaxGroupCriteria = $criteria;

		return $this->collLocation2TaxGroups;
	}


	
	public function getLocation2TaxGroupsJoinTaxGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLocation2TaxGroups === null) {
			if ($this->isNew()) {
				$this->collLocation2TaxGroups = array();
			} else {

				$criteria->add(Location2TaxGroupPeer::COUNTRY_ID, $this->id);

				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelectJoinTaxGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(Location2TaxGroupPeer::COUNTRY_ID, $this->id);

			if (!isset($this->lastLocation2TaxGroupCriteria) || !$this->lastLocation2TaxGroupCriteria->equals($criteria)) {
				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelectJoinTaxGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastLocation2TaxGroupCriteria = $criteria;

		return $this->collLocation2TaxGroups;
	}

	
	public function clearCountryI18ns()
	{
		$this->collCountryI18ns = null; 	}

	
	public function initCountryI18ns()
	{
		$this->collCountryI18ns = array();
	}

	
	public function getCountryI18ns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCountryI18ns === null) {
			if ($this->isNew()) {
			   $this->collCountryI18ns = array();
			} else {

				$criteria->add(CountryI18nPeer::ID, $this->id);

				CountryI18nPeer::addSelectColumns($criteria);
				$this->collCountryI18ns = CountryI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CountryI18nPeer::ID, $this->id);

				CountryI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastCountryI18nCriteria) || !$this->lastCountryI18nCriteria->equals($criteria)) {
					$this->collCountryI18ns = CountryI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCountryI18nCriteria = $criteria;
		return $this->collCountryI18ns;
	}

	
	public function countCountryI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCountryI18ns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CountryI18nPeer::ID, $this->id);

				$count = CountryI18nPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CountryI18nPeer::ID, $this->id);

				if (!isset($this->lastCountryI18nCriteria) || !$this->lastCountryI18nCriteria->equals($criteria)) {
					$count = CountryI18nPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collCountryI18ns);
				}
			} else {
				$count = count($this->collCountryI18ns);
			}
		}
		return $count;
	}

	
	public function addCountryI18n(CountryI18n $l)
	{
		if ($this->collCountryI18ns === null) {
			$this->initCountryI18ns();
		}
		if (!in_array($l, $this->collCountryI18ns, true)) { 			array_push($this->collCountryI18ns, $l);
			$l->setCountry($this);
		}
	}

	
	public function clearStates()
	{
		$this->collStates = null; 	}

	
	public function initStates()
	{
		$this->collStates = array();
	}

	
	public function getStates($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStates === null) {
			if ($this->isNew()) {
			   $this->collStates = array();
			} else {

				$criteria->add(StatePeer::COUNTRY_ID, $this->id);

				StatePeer::addSelectColumns($criteria);
				$this->collStates = StatePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(StatePeer::COUNTRY_ID, $this->id);

				StatePeer::addSelectColumns($criteria);
				if (!isset($this->lastStateCriteria) || !$this->lastStateCriteria->equals($criteria)) {
					$this->collStates = StatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStateCriteria = $criteria;
		return $this->collStates;
	}

	
	public function countStates(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collStates === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(StatePeer::COUNTRY_ID, $this->id);

				$count = StatePeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(StatePeer::COUNTRY_ID, $this->id);

				if (!isset($this->lastStateCriteria) || !$this->lastStateCriteria->equals($criteria)) {
					$count = StatePeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collStates);
				}
			} else {
				$count = count($this->collStates);
			}
		}
		return $count;
	}

	
	public function addState(State $l)
	{
		if ($this->collStates === null) {
			$this->initStates();
		}
		if (!in_array($l, $this->collStates, true)) { 			array_push($this->collStates, $l);
			$l->setCountry($this);
		}
	}

	
	public function clearOrderItemsRelatedByBillingCountryId()
	{
		$this->collOrderItemsRelatedByBillingCountryId = null; 	}

	
	public function initOrderItemsRelatedByBillingCountryId()
	{
		$this->collOrderItemsRelatedByBillingCountryId = array();
	}

	
	public function getOrderItemsRelatedByBillingCountryId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByBillingCountryId;
	}

	
	public function countOrderItemsRelatedByBillingCountryId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$count = OrderItemPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
					$count = OrderItemPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collOrderItemsRelatedByBillingCountryId);
				}
			} else {
				$count = count($this->collOrderItemsRelatedByBillingCountryId);
			}
		}
		return $count;
	}

	
	public function addOrderItemRelatedByBillingCountryId(OrderItem $l)
	{
		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			$this->initOrderItemsRelatedByBillingCountryId();
		}
		if (!in_array($l, $this->collOrderItemsRelatedByBillingCountryId, true)) { 			array_push($this->collOrderItemsRelatedByBillingCountryId, $l);
			$l->setCountryRelatedByBillingCountryId($this);
		}
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinMember($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinStateRelatedByBillingStateId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinPayment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinPayment($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinPayment($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinTaxTypeRelatedByPaymentTaxTypeId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinTaxTypeRelatedByPaymentTaxTypeId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinTaxTypeRelatedByPaymentTaxTypeId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinStateRelatedByDeliveryStateId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinDelivery($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinCurrency($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinCurrency($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}


	
	public function getOrderItemsRelatedByBillingCountryIdJoinOrderStatus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingCountryIdCriteria) || !$this->lastOrderItemRelatedByBillingCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingCountryId;
	}

	
	public function clearOrderItemsRelatedByDeliveryCountryId()
	{
		$this->collOrderItemsRelatedByDeliveryCountryId = null; 	}

	
	public function initOrderItemsRelatedByDeliveryCountryId()
	{
		$this->collOrderItemsRelatedByDeliveryCountryId = array();
	}

	
	public function getOrderItemsRelatedByDeliveryCountryId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}

	
	public function countOrderItemsRelatedByDeliveryCountryId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$count = OrderItemPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
					$count = OrderItemPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collOrderItemsRelatedByDeliveryCountryId);
				}
			} else {
				$count = count($this->collOrderItemsRelatedByDeliveryCountryId);
			}
		}
		return $count;
	}

	
	public function addOrderItemRelatedByDeliveryCountryId(OrderItem $l)
	{
		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			$this->initOrderItemsRelatedByDeliveryCountryId();
		}
		if (!in_array($l, $this->collOrderItemsRelatedByDeliveryCountryId, true)) { 			array_push($this->collOrderItemsRelatedByDeliveryCountryId, $l);
			$l->setCountryRelatedByDeliveryCountryId($this);
		}
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinMember($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinStateRelatedByBillingStateId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByBillingStateId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinPayment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinPayment($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinPayment($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinTaxTypeRelatedByPaymentTaxTypeId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinTaxTypeRelatedByPaymentTaxTypeId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinTaxTypeRelatedByPaymentTaxTypeId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinStateRelatedByDeliveryStateId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinStateRelatedByDeliveryStateId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinDelivery($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinDelivery($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinCurrency($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinCurrency($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}


	
	public function getOrderItemsRelatedByDeliveryCountryIdJoinOrderStatus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CountryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryCountryId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryCountryId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_COUNTRY_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryCountryIdCriteria) || !$this->lastOrderItemRelatedByDeliveryCountryIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryCountryId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryCountryIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryCountryId;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collAddressBooks) {
				foreach ((array) $this->collAddressBooks as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLocation2TaxGroups) {
				foreach ((array) $this->collLocation2TaxGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCountryI18ns) {
				foreach ((array) $this->collCountryI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collStates) {
				foreach ((array) $this->collStates as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collOrderItemsRelatedByBillingCountryId) {
				foreach ((array) $this->collOrderItemsRelatedByBillingCountryId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collOrderItemsRelatedByDeliveryCountryId) {
				foreach ((array) $this->collOrderItemsRelatedByDeliveryCountryId as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collAddressBooks = null;
		$this->collLocation2TaxGroups = null;
		$this->collCountryI18ns = null;
		$this->collStates = null;
		$this->collOrderItemsRelatedByBillingCountryId = null;
		$this->collOrderItemsRelatedByDeliveryCountryId = null;
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
    return $this->getCurrentCountryI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentCountryI18n($culture)->setTitle($value);
  }

  protected $current_i18n = array();

  public function getCurrentCountryI18n($culture = null)
  {
    if (null === $culture)
    {
      $culture = null === $this->culture ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = $this->isNew() ? null : CountryI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setCountryI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setCountryI18nForCulture(new CountryI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setCountryI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addCountryI18n($object);
  }

  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCountry:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCountry::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }

} 