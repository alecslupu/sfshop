<?php


abstract class BaseInformationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'information';

	
	const CLASS_DEFAULT = 'plugins.sfsCorePlugin.lib.model.common.Information';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'information.ID';

	
	const IS_ACTIVE = 'information.IS_ACTIVE';

	
	const IS_DELETED = 'information.IS_DELETED';

	
	const CREATED_AT = 'information.CREATED_AT';

	
	const UPDATED_AT = 'information.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IsActive', 'IsDeleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (InformationPeer::ID, InformationPeer::IS_ACTIVE, InformationPeer::IS_DELETED, InformationPeer::CREATED_AT, InformationPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'is_active', 'is_deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IsActive' => 1, 'IsDeleted' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ),
		BasePeer::TYPE_COLNAME => array (InformationPeer::ID => 0, InformationPeer::IS_ACTIVE => 1, InformationPeer::IS_DELETED => 2, InformationPeer::CREATED_AT => 3, InformationPeer::UPDATED_AT => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'is_active' => 1, 'is_deleted' => 2, 'created_at' => 3, 'updated_at' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsCorePlugin.lib.model.common.map.InformationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = InformationPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
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
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(InformationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InformationPeer::ID);

		$criteria->addSelectColumn(InformationPeer::IS_ACTIVE);

		$criteria->addSelectColumn(InformationPeer::IS_DELETED);

		$criteria->addSelectColumn(InformationPeer::CREATED_AT);

		$criteria->addSelectColumn(InformationPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(information.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT information.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InformationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InformationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InformationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InformationPeer::populateObjects(InformationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseInformationPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			InformationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = InformationPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

  
  public static function doSelectWithI18n(Criteria $c, $culture = null, $con = null)
  {
    if ($culture === null)
    {
      $culture = sfPropel::getDefaultCulture();
    }


    foreach (sfMixer::getCallables('BaseInformationPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInformationPeer', $c, $con);
    }


        if ($c->getDbName() == Propel::getDefaultDB())
    {
      $c->setDbName(self::DATABASE_NAME);
    }

    InformationPeer::addSelectColumns($c);
    $startcol = (InformationPeer::NUM_COLUMNS - InformationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    InformationI18nPeer::addSelectColumns($c);

    $c->addJoin(InformationPeer::ID, InformationI18nPeer::ID);
    $c->add(InformationI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = InformationPeer::getOMClass();

      $cls = sfPropel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = InformationI18nPeer::getOMClass($rs, $startcol);

      $cls = sfPropel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setInformationI18nForCulture($obj2, $culture);
      $obj2->setInformation($obj1);

      $results[] = $obj1;
    }
    return $results;
  }


  
  public static function getI18nModel()
  {
    return 'InformationI18n';
  }


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return InformationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInformationPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(InformationPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseInformationPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInformationPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInformationPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InformationPeer::ID);
			$selectCriteria->add(InformationPeer::ID, $criteria->remove(InformationPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInformationPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInformationPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(InformationPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(InformationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Information) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InformationPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Information $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InformationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InformationPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(InformationPeer::DATABASE_NAME, InformationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InformationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(InformationPeer::DATABASE_NAME);

		$criteria->add(InformationPeer::ID, $pk);


		$v = InformationPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(InformationPeer::ID, $pks, Criteria::IN);
			$objs = InformationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

   
    
    public static function addAdminCriteria(Criteria $criteria)
    {
        $criteria->addAnd(self::IS_DELETED, 0);
    
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
        
        $criteria->add(self::ID, $id);
        
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
    
   
    public static function doSelectWithTranslation(Criteria $c, $culture = null, $con = null)
    {
        $results = self::doSelectWithI18n($c, $culture, $con);
        
        if ($results == null) {
            $defaultCulture = LanguagePeer::getDefault();
            $results = self::doSelectWithI18n($c, $defaultCulture->getCulture());
        }
        
        return $results;
    }

} 
if (Propel::isInit()) {
			try {
		BaseInformationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsCorePlugin.lib.model.common.map.InformationMapBuilder');
}
