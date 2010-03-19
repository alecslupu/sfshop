<?php


abstract class BaseState extends BaseObject  implements Persistent {


  const PEER = 'StatePeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $country_id;

	
	protected $iso;

	
	protected $title_english;

	
	protected $is_active;

	
	protected $aCountry;

	
	protected $collAddressBooks;

	
	private $lastAddressBookCriteria = null;

	
	protected $collLocation2TaxGroups;

	
	private $lastLocation2TaxGroupCriteria = null;

	
	protected $collStateI18ns;

	
	private $lastStateI18nCriteria = null;

	
	protected $collOrderItemsRelatedByBillingStateId;

	
	private $lastOrderItemRelatedByBillingStateIdCriteria = null;

	
	protected $collOrderItemsRelatedByDeliveryStateId;

	
	private $lastOrderItemRelatedByDeliveryStateIdCriteria = null;

	
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

	
	public function getCountryId()
	{
		return $this->country_id;
	}

	
	public function getIso()
	{
		return $this->iso;
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
			$this->modifiedColumns[] = StatePeer::ID;
		}

		return $this;
	} 
	
	public function setCountryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->country_id !== $v) {
			$this->country_id = $v;
			$this->modifiedColumns[] = StatePeer::COUNTRY_ID;
		}

		if ($this->aCountry !== null && $this->aCountry->getId() !== $v) {
			$this->aCountry = null;
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
			$this->modifiedColumns[] = StatePeer::ISO;
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
			$this->modifiedColumns[] = StatePeer::TITLE_ENGLISH;
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
			$this->modifiedColumns[] = StatePeer::IS_ACTIVE;
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
			$this->country_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->iso = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->title_english = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->is_active = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating State object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCountry !== null && $this->country_id !== $this->aCountry->getId()) {
			$this->aCountry = null;
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
			$con = Propel::getConnection(StatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = StatePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCountry = null;
			$this->collAddressBooks = null;
			$this->lastAddressBookCriteria = null;

			$this->collLocation2TaxGroups = null;
			$this->lastLocation2TaxGroupCriteria = null;

			$this->collStateI18ns = null;
			$this->lastStateI18nCriteria = null;

			$this->collOrderItemsRelatedByBillingStateId = null;
			$this->lastOrderItemRelatedByBillingStateIdCriteria = null;

			$this->collOrderItemsRelatedByDeliveryStateId = null;
			$this->lastOrderItemRelatedByDeliveryStateIdCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseState:delete:pre') as $callable)
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
			$con = Propel::getConnection(StatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				StatePeer::doDelete($this, $con);
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
	

    foreach (sfMixer::getCallables('BaseState:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseState:save:pre') as $callable)
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
			$con = Propel::getConnection(StatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				StatePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
    foreach (sfMixer::getCallables('BaseState:save:post') as $callable)
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

												
			if ($this->aCountry !== null) {
				if ($this->aCountry->isModified() || ($this->aCountry->getCulture() && $this->aCountry->getCurrentCountryI18n()->isModified()) || $this->aCountry->isNew()) {
					$affectedRows += $this->aCountry->save($con);
				}
				$this->setCountry($this->aCountry);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = StatePeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = StatePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += StatePeer::doUpdate($this, $con);
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

			if ($this->collStateI18ns !== null) {
				foreach ($this->collStateI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByBillingStateId !== null) {
				foreach ($this->collOrderItemsRelatedByBillingStateId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOrderItemsRelatedByDeliveryStateId !== null) {
				foreach ($this->collOrderItemsRelatedByDeliveryStateId as $referrerFK) {
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


												
			if ($this->aCountry !== null) {
				if (!$this->aCountry->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCountry->getValidationFailures());
				}
			}


			if (($retval = StatePeer::doValidate($this, $columns)) !== true) {
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

				if ($this->collStateI18ns !== null) {
					foreach ($this->collStateI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByBillingStateId !== null) {
					foreach ($this->collOrderItemsRelatedByBillingStateId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOrderItemsRelatedByDeliveryStateId !== null) {
					foreach ($this->collOrderItemsRelatedByDeliveryStateId as $referrerFK) {
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
		$pos = StatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCountryId();
				break;
			case 2:
				return $this->getIso();
				break;
			case 3:
				return $this->getTitleEnglish();
				break;
			case 4:
				return $this->getIsActive();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = StatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCountryId(),
			$keys[2] => $this->getIso(),
			$keys[3] => $this->getTitleEnglish(),
			$keys[4] => $this->getIsActive(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = StatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCountryId($value);
				break;
			case 2:
				$this->setIso($value);
				break;
			case 3:
				$this->setTitleEnglish($value);
				break;
			case 4:
				$this->setIsActive($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = StatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCountryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIso($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitleEnglish($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsActive($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(StatePeer::DATABASE_NAME);

		if ($this->isColumnModified(StatePeer::ID)) $criteria->add(StatePeer::ID, $this->id);
		if ($this->isColumnModified(StatePeer::COUNTRY_ID)) $criteria->add(StatePeer::COUNTRY_ID, $this->country_id);
		if ($this->isColumnModified(StatePeer::ISO)) $criteria->add(StatePeer::ISO, $this->iso);
		if ($this->isColumnModified(StatePeer::TITLE_ENGLISH)) $criteria->add(StatePeer::TITLE_ENGLISH, $this->title_english);
		if ($this->isColumnModified(StatePeer::IS_ACTIVE)) $criteria->add(StatePeer::IS_ACTIVE, $this->is_active);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(StatePeer::DATABASE_NAME);

		$criteria->add(StatePeer::ID, $this->id);

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

		$copyObj->setCountryId($this->country_id);

		$copyObj->setIso($this->iso);

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

			foreach ($this->getStateI18ns() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addStateI18n($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getOrderItemsRelatedByBillingStateId() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addOrderItemRelatedByBillingStateId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getOrderItemsRelatedByDeliveryStateId() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addOrderItemRelatedByDeliveryStateId($relObj->copy($deepCopy));
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
			self::$peer = new StatePeer();
		}
		return self::$peer;
	}

	
	public function setCountry(Country $v = null)
	{
		if ($v === null) {
			$this->setCountryId(NULL);
		} else {
			$this->setCountryId($v->getId());
		}

		$this->aCountry = $v;

						if ($v !== null) {
			$v->addState($this);
		}

		return $this;
	}


	
	public function getCountry(PropelPDO $con = null)
	{
		if ($this->aCountry === null && ($this->country_id !== null)) {
			$this->aCountry = CountryPeer::retrieveByPk($this->country_id);
			
		}
		return $this->aCountry;
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
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
			   $this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::STATE_ID, $this->id);

				AddressBookPeer::addSelectColumns($criteria);
				$this->collAddressBooks = AddressBookPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AddressBookPeer::STATE_ID, $this->id);

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
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
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

				$criteria->add(AddressBookPeer::STATE_ID, $this->id);

				$count = AddressBookPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AddressBookPeer::STATE_ID, $this->id);

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
			$l->setState($this);
		}
	}


	
	public function getAddressBooksJoinMember($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
				$this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::STATE_ID, $this->id);

				$this->collAddressBooks = AddressBookPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AddressBookPeer::STATE_ID, $this->id);

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		}
		$this->lastAddressBookCriteria = $criteria;

		return $this->collAddressBooks;
	}


	
	public function getAddressBooksJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
				$this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::STATE_ID, $this->id);

				$this->collAddressBooks = AddressBookPeer::doSelectJoinCountry($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AddressBookPeer::STATE_ID, $this->id);

			if (!isset($this->lastAddressBookCriteria) || !$this->lastAddressBookCriteria->equals($criteria)) {
				$this->collAddressBooks = AddressBookPeer::doSelectJoinCountry($criteria, $con, $join_behavior);
			}
		}
		$this->lastAddressBookCriteria = $criteria;

		return $this->collAddressBooks;
	}


	
	public function getAddressBooksJoinTaxGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAddressBooks === null) {
			if ($this->isNew()) {
				$this->collAddressBooks = array();
			} else {

				$criteria->add(AddressBookPeer::STATE_ID, $this->id);

				$this->collAddressBooks = AddressBookPeer::doSelectJoinTaxGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(AddressBookPeer::STATE_ID, $this->id);

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
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLocation2TaxGroups === null) {
			if ($this->isNew()) {
			   $this->collLocation2TaxGroups = array();
			} else {

				$criteria->add(Location2TaxGroupPeer::STATE_ID, $this->id);

				Location2TaxGroupPeer::addSelectColumns($criteria);
				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Location2TaxGroupPeer::STATE_ID, $this->id);

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
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
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

				$criteria->add(Location2TaxGroupPeer::STATE_ID, $this->id);

				$count = Location2TaxGroupPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Location2TaxGroupPeer::STATE_ID, $this->id);

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
			$l->setState($this);
		}
	}


	
	public function getLocation2TaxGroupsJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLocation2TaxGroups === null) {
			if ($this->isNew()) {
				$this->collLocation2TaxGroups = array();
			} else {

				$criteria->add(Location2TaxGroupPeer::STATE_ID, $this->id);

				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelectJoinCountry($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(Location2TaxGroupPeer::STATE_ID, $this->id);

			if (!isset($this->lastLocation2TaxGroupCriteria) || !$this->lastLocation2TaxGroupCriteria->equals($criteria)) {
				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelectJoinCountry($criteria, $con, $join_behavior);
			}
		}
		$this->lastLocation2TaxGroupCriteria = $criteria;

		return $this->collLocation2TaxGroups;
	}


	
	public function getLocation2TaxGroupsJoinTaxGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLocation2TaxGroups === null) {
			if ($this->isNew()) {
				$this->collLocation2TaxGroups = array();
			} else {

				$criteria->add(Location2TaxGroupPeer::STATE_ID, $this->id);

				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelectJoinTaxGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(Location2TaxGroupPeer::STATE_ID, $this->id);

			if (!isset($this->lastLocation2TaxGroupCriteria) || !$this->lastLocation2TaxGroupCriteria->equals($criteria)) {
				$this->collLocation2TaxGroups = Location2TaxGroupPeer::doSelectJoinTaxGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastLocation2TaxGroupCriteria = $criteria;

		return $this->collLocation2TaxGroups;
	}

	
	public function clearStateI18ns()
	{
		$this->collStateI18ns = null; 	}

	
	public function initStateI18ns()
	{
		$this->collStateI18ns = array();
	}

	
	public function getStateI18ns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collStateI18ns === null) {
			if ($this->isNew()) {
			   $this->collStateI18ns = array();
			} else {

				$criteria->add(StateI18nPeer::ID, $this->id);

				StateI18nPeer::addSelectColumns($criteria);
				$this->collStateI18ns = StateI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(StateI18nPeer::ID, $this->id);

				StateI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastStateI18nCriteria) || !$this->lastStateI18nCriteria->equals($criteria)) {
					$this->collStateI18ns = StateI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastStateI18nCriteria = $criteria;
		return $this->collStateI18ns;
	}

	
	public function countStateI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collStateI18ns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(StateI18nPeer::ID, $this->id);

				$count = StateI18nPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(StateI18nPeer::ID, $this->id);

				if (!isset($this->lastStateI18nCriteria) || !$this->lastStateI18nCriteria->equals($criteria)) {
					$count = StateI18nPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collStateI18ns);
				}
			} else {
				$count = count($this->collStateI18ns);
			}
		}
		return $count;
	}

	
	public function addStateI18n(StateI18n $l)
	{
		if ($this->collStateI18ns === null) {
			$this->initStateI18ns();
		}
		if (!in_array($l, $this->collStateI18ns, true)) { 			array_push($this->collStateI18ns, $l);
			$l->setState($this);
		}
	}

	
	public function clearOrderItemsRelatedByBillingStateId()
	{
		$this->collOrderItemsRelatedByBillingStateId = null; 	}

	
	public function initOrderItemsRelatedByBillingStateId()
	{
		$this->collOrderItemsRelatedByBillingStateId = array();
	}

	
	public function getOrderItemsRelatedByBillingStateId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByBillingStateId;
	}

	
	public function countOrderItemsRelatedByBillingStateId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$count = OrderItemPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
					$count = OrderItemPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collOrderItemsRelatedByBillingStateId);
				}
			} else {
				$count = count($this->collOrderItemsRelatedByBillingStateId);
			}
		}
		return $count;
	}

	
	public function addOrderItemRelatedByBillingStateId(OrderItem $l)
	{
		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			$this->initOrderItemsRelatedByBillingStateId();
		}
		if (!in_array($l, $this->collOrderItemsRelatedByBillingStateId, true)) { 			array_push($this->collOrderItemsRelatedByBillingStateId, $l);
			$l->setStateRelatedByBillingStateId($this);
		}
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinMember($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinCountryRelatedByBillingCountryId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinPayment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinPayment($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinPayment($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinTaxTypeRelatedByPaymentTaxTypeId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinTaxTypeRelatedByPaymentTaxTypeId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinTaxTypeRelatedByPaymentTaxTypeId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinCountryRelatedByDeliveryCountryId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinDelivery($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCurrency($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinCurrency($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}


	
	public function getOrderItemsRelatedByBillingStateIdJoinOrderStatus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByBillingStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByBillingStateId = array();
			} else {

				$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::BILLING_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByBillingStateIdCriteria) || !$this->lastOrderItemRelatedByBillingStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByBillingStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByBillingStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByBillingStateId;
	}

	
	public function clearOrderItemsRelatedByDeliveryStateId()
	{
		$this->collOrderItemsRelatedByDeliveryStateId = null; 	}

	
	public function initOrderItemsRelatedByDeliveryStateId()
	{
		$this->collOrderItemsRelatedByDeliveryStateId = array();
	}

	
	public function getOrderItemsRelatedByDeliveryStateId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
			   $this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				OrderItemPeer::addSelectColumns($criteria);
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				OrderItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
					$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;
		return $this->collOrderItemsRelatedByDeliveryStateId;
	}

	
	public function countOrderItemsRelatedByDeliveryStateId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$count = OrderItemPeer::doCount($criteria, false, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
					$count = OrderItemPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collOrderItemsRelatedByDeliveryStateId);
				}
			} else {
				$count = count($this->collOrderItemsRelatedByDeliveryStateId);
			}
		}
		return $count;
	}

	
	public function addOrderItemRelatedByDeliveryStateId(OrderItem $l)
	{
		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			$this->initOrderItemsRelatedByDeliveryStateId();
		}
		if (!in_array($l, $this->collOrderItemsRelatedByDeliveryStateId, true)) { 			array_push($this->collOrderItemsRelatedByDeliveryStateId, $l);
			$l->setStateRelatedByDeliveryStateId($this);
		}
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinMember($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinMember($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinCountryRelatedByBillingCountryId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByBillingCountryId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinPayment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinPayment($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinPayment($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinTaxTypeRelatedByPaymentTaxTypeId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinTaxTypeRelatedByPaymentTaxTypeId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinTaxTypeRelatedByPaymentTaxTypeId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinCountryRelatedByDeliveryCountryId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCountryRelatedByDeliveryCountryId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinDelivery($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinDelivery($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinTaxTypeRelatedByDeliveryTaxTypeId($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCurrency($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinCurrency($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
	}


	
	public function getOrderItemsRelatedByDeliveryStateIdJoinOrderStatus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(StatePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOrderItemsRelatedByDeliveryStateId === null) {
			if ($this->isNew()) {
				$this->collOrderItemsRelatedByDeliveryStateId = array();
			} else {

				$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(OrderItemPeer::DELIVERY_STATE_ID, $this->id);

			if (!isset($this->lastOrderItemRelatedByDeliveryStateIdCriteria) || !$this->lastOrderItemRelatedByDeliveryStateIdCriteria->equals($criteria)) {
				$this->collOrderItemsRelatedByDeliveryStateId = OrderItemPeer::doSelectJoinOrderStatus($criteria, $con, $join_behavior);
			}
		}
		$this->lastOrderItemRelatedByDeliveryStateIdCriteria = $criteria;

		return $this->collOrderItemsRelatedByDeliveryStateId;
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
			if ($this->collStateI18ns) {
				foreach ((array) $this->collStateI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collOrderItemsRelatedByBillingStateId) {
				foreach ((array) $this->collOrderItemsRelatedByBillingStateId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collOrderItemsRelatedByDeliveryStateId) {
				foreach ((array) $this->collOrderItemsRelatedByDeliveryStateId as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collAddressBooks = null;
		$this->collLocation2TaxGroups = null;
		$this->collStateI18ns = null;
		$this->collOrderItemsRelatedByBillingStateId = null;
		$this->collOrderItemsRelatedByDeliveryStateId = null;
			$this->aCountry = null;
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
    return $this->getCurrentStateI18n($culture)->getTitle();
  }

  public function setTitle($value, $culture = null)
  {
    $this->getCurrentStateI18n($culture)->setTitle($value);
  }

  protected $current_i18n = array();

  public function getCurrentStateI18n($culture = null)
  {
    if (null === $culture)
    {
      $culture = null === $this->culture ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = $this->isNew() ? null : StateI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setStateI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setStateI18nForCulture(new StateI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setStateI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addStateI18n($object);
  }

  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseState:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseState::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }

} 