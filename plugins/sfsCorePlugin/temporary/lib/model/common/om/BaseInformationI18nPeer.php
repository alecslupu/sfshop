<?php


abstract class BaseInformationI18nPeer {

	
	const IS_I18N = false;

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'information_i18n';

	
	const OM_CLASS = 'InformationI18n';

	
	const CLASS_DEFAULT = 'plugins.sfsCorePlugin.lib.model.common.InformationI18n';

	
	const TM_CLASS = 'InformationI18nTableMap';
	
	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'information_i18n.ID';

	
	const CULTURE = 'information_i18n.CULTURE';

	
	const TITLE = 'information_i18n.TITLE';

	
	const DESCRIPTION = 'information_i18n.DESCRIPTION';

	
	const META_KEYWORDS = 'information_i18n.META_KEYWORDS';

	
	const META_DESCRIPTION = 'information_i18n.META_DESCRIPTION';

	
	public static $instances = array();


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Culture', 'Title', 'Description', 'MetaKeywords', 'MetaDescription', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'culture', 'title', 'description', 'metaKeywords', 'metaDescription', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::CULTURE, self::TITLE, self::DESCRIPTION, self::META_KEYWORDS, self::META_DESCRIPTION, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'culture', 'title', 'description', 'meta_keywords', 'meta_description', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Culture' => 1, 'Title' => 2, 'Description' => 3, 'MetaKeywords' => 4, 'MetaDescription' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'culture' => 1, 'title' => 2, 'description' => 3, 'metaKeywords' => 4, 'metaDescription' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::CULTURE => 1, self::TITLE => 2, self::DESCRIPTION => 3, self::META_KEYWORDS => 4, self::META_DESCRIPTION => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'culture' => 1, 'title' => 2, 'description' => 3, 'meta_keywords' => 4, 'meta_description' => 5, ),
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
		return str_replace(InformationI18nPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(InformationI18nPeer::ID);
		$criteria->addSelectColumn(InformationI18nPeer::CULTURE);
		$criteria->addSelectColumn(InformationI18nPeer::TITLE);
		$criteria->addSelectColumn(InformationI18nPeer::DESCRIPTION);
		$criteria->addSelectColumn(InformationI18nPeer::META_KEYWORDS);
		$criteria->addSelectColumn(InformationI18nPeer::META_DESCRIPTION);
	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InformationI18nPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InformationI18nPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInformationI18nPeer', $criteria, $con);
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
		$objects = InformationI18nPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return InformationI18nPeer::populateObjects(InformationI18nPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseInformationI18nPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InformationI18nPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(InformationI18n $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getId(), (string) $obj->getCulture()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InformationI18n) {
				$key = serialize(array((string) $value->getId(), (string) $value->getCulture()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InformationI18n object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol] === null && $row[$startcol + 1] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol], (string) $row[$startcol + 1]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = InformationI18nPeer::getOMClass(false);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InformationI18nPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InformationI18nPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InformationI18nPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinInformation(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InformationI18nPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InformationI18nPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InformationI18nPeer::ID,), array(InformationPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInformationI18nPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinInformation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInformationI18nPeer', $criteria, $con);
    }


		$criteria = clone $criteria;

				if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		InformationI18nPeer::addSelectColumns($criteria);
		$startcol = (InformationI18nPeer::NUM_COLUMNS - InformationI18nPeer::NUM_LAZY_LOAD_COLUMNS);
		InformationPeer::addSelectColumns($criteria);

		$criteria->addJoin(InformationI18nPeer::ID, InformationPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InformationI18nPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InformationI18nPeer::getInstanceFromPool($key1))) {
															} else {

				$cls = InformationI18nPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				InformationI18nPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = InformationPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = InformationPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = InformationPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					InformationPeer::addInstanceToPool($obj2, $key2);
				} 				
								$obj2->addInformationI18n($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InformationI18nPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InformationI18nPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InformationI18nPeer::ID,), array(InformationPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInformationI18nPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}

	
	public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInformationI18nPeer', $criteria, $con);
    }


		$criteria = clone $criteria;

				if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		InformationI18nPeer::addSelectColumns($criteria);
		$startcol2 = (InformationI18nPeer::NUM_COLUMNS - InformationI18nPeer::NUM_LAZY_LOAD_COLUMNS);

		InformationPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (InformationPeer::NUM_COLUMNS - InformationPeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(InformationI18nPeer::ID, InformationPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InformationI18nPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InformationI18nPeer::getInstanceFromPool($key1))) {
															} else {
				$cls = InformationI18nPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				InformationI18nPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = InformationPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = InformationPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = InformationPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InformationPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInformationI18n($obj1);
			} 
			$results[] = $obj1;
		}
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
	  $dbMap = Propel::getDatabaseMap(BaseInformationI18nPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseInformationI18nPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new InformationI18nTableMap());
	  }
	}

	
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? InformationI18nPeer::CLASS_DEFAULT : InformationI18nPeer::OM_CLASS;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInformationI18nPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInformationI18nPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInformationI18nPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InformationI18nPeer::ID);
			$selectCriteria->add(InformationI18nPeer::ID, $criteria->remove(InformationI18nPeer::ID), $comparison);

			$comparison = $criteria->getComparison(InformationI18nPeer::CULTURE);
			$selectCriteria->add(InformationI18nPeer::CULTURE, $criteria->remove(InformationI18nPeer::CULTURE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInformationI18nPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInformationI18nPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InformationI18nPeer::TABLE_NAME, $con);
												InformationI18nPeer::clearInstancePool();
			InformationI18nPeer::clearRelatedInstancePool();
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
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												InformationI18nPeer::clearInstancePool();
						$criteria = clone $values;
		} elseif ($values instanceof InformationI18n) { 						InformationI18nPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else { 			$criteria = new Criteria(self::DATABASE_NAME);
									if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}
			foreach ($values as $value) {
				$criterion = $criteria->getNewCriterion(InformationI18nPeer::ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(InformationI18nPeer::CULTURE, $value[1]));
				$criteria->addOr($criterion);
								InformationI18nPeer::removeInstanceFromPool($value);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			InformationI18nPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(InformationI18n $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InformationI18nPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InformationI18nPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InformationI18nPeer::DATABASE_NAME, InformationI18nPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        foreach ($res as $failed) {
            $col = InformationI18nPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($id, $culture, PropelPDO $con = null) {
		$key = serialize(array((string) $id, (string) $culture));
 		if (null !== ($obj = InformationI18nPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InformationI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InformationI18nPeer::DATABASE_NAME);
		$criteria->add(InformationI18nPeer::ID, $id);
		$criteria->add(InformationI18nPeer::CULTURE, $culture);
		$v = InformationI18nPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
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
        return self::doSelect($criteria);
    }
    
} 
BaseInformationI18nPeer::buildTableMap();

