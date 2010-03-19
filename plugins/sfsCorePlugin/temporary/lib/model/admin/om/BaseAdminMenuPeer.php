<?php


abstract class BaseAdminMenuPeer {

	
	const IS_I18N = true;

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'admin_menu';

	
	const OM_CLASS = 'AdminMenu';

	
	const CLASS_DEFAULT = 'plugins.sfsCorePlugin.lib.model.admin.AdminMenu';

	
	const TM_CLASS = 'AdminMenuTableMap';
	
	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'admin_menu.ID';

	
	const PARENT_ID = 'admin_menu.PARENT_ID';

	
	const CREDENTIAL = 'admin_menu.CREDENTIAL';

	
	const MODULE = 'admin_menu.MODULE';

	
	const ACTION = 'admin_menu.ACTION';

	
	const ROUTE = 'admin_menu.ROUTE';

	
	const POS = 'admin_menu.POS';

	
	const IS_ACTIVE = 'admin_menu.IS_ACTIVE';

	
	public static $instances = array();


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ParentId', 'Credential', 'Module', 'Action', 'Route', 'Pos', 'IsActive', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'parentId', 'credential', 'module', 'action', 'route', 'pos', 'isActive', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::PARENT_ID, self::CREDENTIAL, self::MODULE, self::ACTION, self::ROUTE, self::POS, self::IS_ACTIVE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'parent_id', 'credential', 'module', 'action', 'route', 'pos', 'is_active', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ParentId' => 1, 'Credential' => 2, 'Module' => 3, 'Action' => 4, 'Route' => 5, 'Pos' => 6, 'IsActive' => 7, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'parentId' => 1, 'credential' => 2, 'module' => 3, 'action' => 4, 'route' => 5, 'pos' => 6, 'isActive' => 7, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::PARENT_ID => 1, self::CREDENTIAL => 2, self::MODULE => 3, self::ACTION => 4, self::ROUTE => 5, self::POS => 6, self::IS_ACTIVE => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'parent_id' => 1, 'credential' => 2, 'module' => 3, 'action' => 4, 'route' => 5, 'pos' => 6, 'is_active' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
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
		return str_replace(AdminMenuPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(AdminMenuPeer::ID);
		$criteria->addSelectColumn(AdminMenuPeer::PARENT_ID);
		$criteria->addSelectColumn(AdminMenuPeer::CREDENTIAL);
		$criteria->addSelectColumn(AdminMenuPeer::MODULE);
		$criteria->addSelectColumn(AdminMenuPeer::ACTION);
		$criteria->addSelectColumn(AdminMenuPeer::ROUTE);
		$criteria->addSelectColumn(AdminMenuPeer::POS);
		$criteria->addSelectColumn(AdminMenuPeer::IS_ACTIVE);
	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AdminMenuPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AdminMenuPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseAdminMenuPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAdminMenuPeer', $criteria, $con);
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
		$objects = AdminMenuPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return AdminMenuPeer::populateObjects(AdminMenuPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminMenuPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseAdminMenuPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AdminMenuPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(AdminMenu $obj, $key = null)
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
			if (is_object($value) && $value instanceof AdminMenu) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or AdminMenu object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				AdminMenuI18nPeer::clearInstancePool();

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
	
				$cls = AdminMenuPeer::getOMClass(false);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AdminMenuPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AdminMenuPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AdminMenuPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AdminMenuPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AdminMenuPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseAdminMenuPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAdminMenuPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseAdminMenuPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseAdminMenuPeer', $criteria, $con);
    }


		$criteria = clone $criteria;

				if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		AdminMenuPeer::addSelectColumns($criteria);
		$startcol2 = (AdminMenuPeer::NUM_COLUMNS - AdminMenuPeer::NUM_LAZY_LOAD_COLUMNS);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AdminMenuPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AdminMenuPeer::getInstanceFromPool($key1))) {
															} else {
				$cls = AdminMenuPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				AdminMenuPeer::addInstanceToPool($obj1, $key1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  
  public static function doSelectWithI18n(Criteria $c, $culture = null, PropelPDO $con = null)
  {
        $c = clone $c;
    if ($culture === null)
    {
      $culture = sfPropel::getDefaultCulture();
    }


    foreach (sfMixer::getCallables('BaseAdminMenuPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAdminMenuPeer', $c, $con);
    }


        if ($c->getDbName() == Propel::getDefaultDB())
    {
      $c->setDbName(self::DATABASE_NAME);
    }

    AdminMenuPeer::addSelectColumns($c);
    $startcol = (AdminMenuPeer::NUM_COLUMNS - AdminMenuPeer::NUM_LAZY_LOAD_COLUMNS);

    AdminMenuI18nPeer::addSelectColumns($c);

    $c->addJoin(AdminMenuPeer::ID, AdminMenuI18nPeer::ID);
    $c->add(AdminMenuI18nPeer::CULTURE, $culture);

    $stmt = BasePeer::doSelect($c, $con);
    $results = array();

    while($row = $stmt->fetch(PDO::FETCH_NUM)) {

      $omClass = AdminMenuPeer::getOMClass();

      $cls = Propel::importClass($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($row);
      $obj1->setCulture($culture);

      $omClass = AdminMenuI18nPeer::getOMClass();

      $cls = Propel::importClass($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($row, $startcol);

      $obj1->setAdminMenuI18nForCulture($obj2, $culture);
      $obj2->setAdminMenu($obj1);

      $results[] = $obj1;
    }
    return $results;
  }


  
  public static function getI18nModel()
  {
    return 'AdminMenuI18n';
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
	  $dbMap = Propel::getDatabaseMap(BaseAdminMenuPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseAdminMenuPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new AdminMenuTableMap());
	  }
	}

	
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? AdminMenuPeer::CLASS_DEFAULT : AdminMenuPeer::OM_CLASS;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminMenuPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAdminMenuPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(AdminMenuPeer::ID) && $criteria->keyContainsValue(AdminMenuPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.AdminMenuPeer::ID.')');
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

		
    foreach (sfMixer::getCallables('BaseAdminMenuPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAdminMenuPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminMenuPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAdminMenuPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AdminMenuPeer::ID);
			$selectCriteria->add(AdminMenuPeer::ID, $criteria->remove(AdminMenuPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAdminMenuPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAdminMenuPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AdminMenuPeer::TABLE_NAME, $con);
												AdminMenuPeer::clearInstancePool();
			AdminMenuPeer::clearRelatedInstancePool();
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
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												AdminMenuPeer::clearInstancePool();
						$criteria = clone $values;
		} elseif ($values instanceof AdminMenu) { 						AdminMenuPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else { 			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AdminMenuPeer::ID, (array) $values, Criteria::IN);
						foreach ((array) $values as $singleval) {
				AdminMenuPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			AdminMenuPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(AdminMenu $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AdminMenuPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AdminMenuPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AdminMenuPeer::DATABASE_NAME, AdminMenuPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        foreach ($res as $failed) {
            $col = AdminMenuPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = AdminMenuPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(AdminMenuPeer::DATABASE_NAME);
		$criteria->add(AdminMenuPeer::ID, $pk);

		$v = AdminMenuPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AdminMenuPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(AdminMenuPeer::DATABASE_NAME);
			$criteria->add(AdminMenuPeer::ID, $pks, Criteria::IN);
			$objs = AdminMenuPeer::doSelect($criteria, $con);
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
    
   
    public static function getAll($criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        if ($withI18n) {
            return self::doSelectWithI18n($criteria);
        }
        else {
            return self::doSelect($criteria);
        }
    }
    
   
    public static function getAllPublic($criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        self::addPublicCriteria($criteria);
        
        if ($withI18n) {
            return self::doSelectWithI18n($criteria);
        }
        else {
            return self::doSelect($criteria);
        }
    }
    
   
    public static function getCountAll($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        return self::doCount($criteria);
    }
    
   
    public static function doSelectWithTranslation(Criteria $c, $culture = null, $con = null)
    {
        $results = self::doSelectWithI18n($c, $culture, $con);
        
        if ($results == null) {
            $defaultCulture = LanguagePeer::getDefault();
            $results = self::doSelectWithI18n($c, $defaultCulture->getCulture());
        }
        
        return $results;
    }

    public static function updateCulture($oldCulture, $newCulture)
    {
        $criteriaWhere = new Criteria();
        $criteriaSet = new Criteria();
        
        $criteriaWhere->add(AdminMenuI18nPeer::CULTURE, $oldCulture);
        $criteriaSet->add(AdminMenuI18nPeer::CULTURE, $newCulture);
        
        BasePeer::doUpdate($criteriaWhere, $criteriaSet, Propel::getConnection(self::DATABASE_NAME));
    }
    
} 
BaseAdminMenuPeer::buildTableMap();

