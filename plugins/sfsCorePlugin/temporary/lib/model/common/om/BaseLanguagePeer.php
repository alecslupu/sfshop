<?php


abstract class BaseLanguagePeer {

	
	const IS_I18N = false;

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'language';

	
	const OM_CLASS = 'Language';

	
	const CLASS_DEFAULT = 'plugins.sfsCorePlugin.lib.model.common.Language';

	
	const TM_CLASS = 'LanguageTableMap';
	
	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'language.ID';

	
	const CULTURE = 'language.CULTURE';

	
	const TITLE_ENGLISH = 'language.TITLE_ENGLISH';

	
	const TITLE_OWN = 'language.TITLE_OWN';

	
	const IS_DEFAULT = 'language.IS_DEFAULT';

	
	const IS_ACTIVE = 'language.IS_ACTIVE';

	
	public static $instances = array();


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Culture', 'TitleEnglish', 'TitleOwn', 'IsDefault', 'IsActive', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'culture', 'titleEnglish', 'titleOwn', 'isDefault', 'isActive', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::CULTURE, self::TITLE_ENGLISH, self::TITLE_OWN, self::IS_DEFAULT, self::IS_ACTIVE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'culture', 'title_english', 'title_own', 'is_default', 'is_active', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Culture' => 1, 'TitleEnglish' => 2, 'TitleOwn' => 3, 'IsDefault' => 4, 'IsActive' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'culture' => 1, 'titleEnglish' => 2, 'titleOwn' => 3, 'isDefault' => 4, 'isActive' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::CULTURE => 1, self::TITLE_ENGLISH => 2, self::TITLE_OWN => 3, self::IS_DEFAULT => 4, self::IS_ACTIVE => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'culture' => 1, 'title_english' => 2, 'title_own' => 3, 'is_default' => 4, 'is_active' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(LanguagePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(LanguagePeer::ID);
		$criteria->addSelectColumn(LanguagePeer::CULTURE);
		$criteria->addSelectColumn(LanguagePeer::TITLE_ENGLISH);
		$criteria->addSelectColumn(LanguagePeer::TITLE_OWN);
		$criteria->addSelectColumn(LanguagePeer::IS_DEFAULT);
		$criteria->addSelectColumn(LanguagePeer::IS_ACTIVE);
	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(LanguagePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			LanguagePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseLanguagePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseLanguagePeer', $criteria, $con);
    }


				$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}
	
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = LanguagePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return LanguagePeer::populateObjects(LanguagePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseLanguagePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseLanguagePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			LanguagePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Language $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Language) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Language object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} 
	
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; 	}
	
	
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	
	public static function clearRelatedInstancePool()
	{
	}

	
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
				if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = LanguagePeer::getOMClass(false);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = LanguagePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = LanguagePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				LanguagePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseLanguagePeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseLanguagePeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new LanguageTableMap());
	  }
	}

	
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? LanguagePeer::CLASS_DEFAULT : LanguagePeer::OM_CLASS;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseLanguagePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseLanguagePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(LanguagePeer::ID) && $criteria->keyContainsValue(LanguagePeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.LanguagePeer::ID.')');
		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseLanguagePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseLanguagePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseLanguagePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseLanguagePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(LanguagePeer::ID);
			$selectCriteria->add(LanguagePeer::ID, $criteria->remove(LanguagePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseLanguagePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseLanguagePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(LanguagePeer::TABLE_NAME, $con);
												LanguagePeer::clearInstancePool();
			LanguagePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												LanguagePeer::clearInstancePool();
						$criteria = clone $values;
		} elseif ($values instanceof Language) { 						LanguagePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else { 			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(LanguagePeer::ID, (array) $values, Criteria::IN);
						foreach ((array) $values as $singleval) {
				LanguagePeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			LanguagePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(Language $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(LanguagePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(LanguagePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(LanguagePeer::DATABASE_NAME, LanguagePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        foreach ($res as $failed) {
            $col = LanguagePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = LanguagePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(LanguagePeer::DATABASE_NAME);
		$criteria->add(LanguagePeer::ID, $pk);

		$v = LanguagePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(LanguagePeer::DATABASE_NAME);
			$criteria->add(LanguagePeer::ID, $pks, Criteria::IN);
			$objs = LanguagePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

   
    
    public static function addAdminCriteria(Criteria $criteria)
    {
    }
    
    
   
    
    public static function addPublicCriteria(Criteria $criteria)
    {
        self::addAdminCriteria($criteria);
        
        $criteria->addAnd(self::IS_ACTIVE, 1);
    
    }
    
    
   
    public static function retrieveById($id, $criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::ID,(int) $id);
        
        if ($withI18n) {
            $criteria->setLimit(1);
            list($object) = self::doSelectWithI18n($criteria);
            return $object;
        }
        else {
            return self::doSelectOne($criteria);
        }
    }
    
   
    public static function getAll($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        return self::doSelect($criteria);
    }
    
   
    public static function getCountAll($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        return self::doCount($criteria);
    }
    
   
    public static function getAllPublic($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
            
            self::addPublicCriteria($criteria);
            
            
        return self::doSelect($criteria);
    }
    
} 
BaseLanguagePeer::buildTableMap();

