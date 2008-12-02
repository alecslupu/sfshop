<?php


abstract class BaseOptionTypePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'option_type';

	
	const CLASS_DEFAULT = 'plugins.sfsProductPlugin.lib.model.OptionType';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'option_type.ID';

	
	const NAME = 'option_type.NAME';

	
	const POS = 'option_type.POS';

	
	const IS_ACTIVE = 'option_type.IS_ACTIVE';

	
	const IS_DELETED = 'option_type.IS_DELETED';

	
	const CREATED_AT = 'option_type.CREATED_AT';

	
	const UPDATED_AT = 'option_type.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Pos', 'IsActive', 'IsDeleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (OptionTypePeer::ID, OptionTypePeer::NAME, OptionTypePeer::POS, OptionTypePeer::IS_ACTIVE, OptionTypePeer::IS_DELETED, OptionTypePeer::CREATED_AT, OptionTypePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'pos', 'is_active', 'is_deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Pos' => 2, 'IsActive' => 3, 'IsDeleted' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (OptionTypePeer::ID => 0, OptionTypePeer::NAME => 1, OptionTypePeer::POS => 2, OptionTypePeer::IS_ACTIVE => 3, OptionTypePeer::IS_DELETED => 4, OptionTypePeer::CREATED_AT => 5, OptionTypePeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'pos' => 2, 'is_active' => 3, 'is_deleted' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsProductPlugin.lib.model.map.OptionTypeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OptionTypePeer::getTableMap();
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
		return str_replace(OptionTypePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OptionTypePeer::ID);

		$criteria->addSelectColumn(OptionTypePeer::NAME);

		$criteria->addSelectColumn(OptionTypePeer::POS);

		$criteria->addSelectColumn(OptionTypePeer::IS_ACTIVE);

		$criteria->addSelectColumn(OptionTypePeer::IS_DELETED);

		$criteria->addSelectColumn(OptionTypePeer::CREATED_AT);

		$criteria->addSelectColumn(OptionTypePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(option_type.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT option_type.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OptionTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OptionTypePeer::doSelectRS($criteria, $con);
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
		$objects = OptionTypePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OptionTypePeer::populateObjects(OptionTypePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionTypePeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseOptionTypePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OptionTypePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OptionTypePeer::getOMClass();
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


    foreach (sfMixer::getCallables('BaseOptionTypePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOptionTypePeer', $c, $con);
    }


        if ($c->getDbName() == Propel::getDefaultDB())
    {
      $c->setDbName(self::DATABASE_NAME);
    }

    OptionTypePeer::addSelectColumns($c);
    $startcol = (OptionTypePeer::NUM_COLUMNS - OptionTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    OptionTypeI18nPeer::addSelectColumns($c);

    $c->addJoin(OptionTypePeer::ID, OptionTypeI18nPeer::ID);
    $c->add(OptionTypeI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = OptionTypePeer::getOMClass();

      $cls = sfPropel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = OptionTypeI18nPeer::getOMClass($rs, $startcol);

      $cls = sfPropel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setOptionTypeI18nForCulture($obj2, $culture);
      $obj2->setOptionType($obj1);

      $results[] = $obj1;
    }
    return $results;
  }


  
  public static function getI18nModel()
  {
    return 'OptionTypeI18n';
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
		return OptionTypePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionTypePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOptionTypePeer', $values, $con);
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

		$criteria->remove(OptionTypePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseOptionTypePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseOptionTypePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionTypePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOptionTypePeer', $values, $con);
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
			$comparison = $criteria->getComparison(OptionTypePeer::ID);
			$selectCriteria->add(OptionTypePeer::ID, $criteria->remove(OptionTypePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseOptionTypePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseOptionTypePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(OptionTypePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OptionTypePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OptionType) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OptionTypePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OptionType $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OptionTypePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OptionTypePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OptionTypePeer::DATABASE_NAME, OptionTypePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OptionTypePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OptionTypePeer::DATABASE_NAME);

		$criteria->add(OptionTypePeer::ID, $pk);


		$v = OptionTypePeer::doSelect($criteria, $con);

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
			$criteria->add(OptionTypePeer::ID, $pks, Criteria::IN);
			$objs = OptionTypePeer::doSelect($criteria, $con);
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
		BaseOptionTypePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsProductPlugin.lib.model.map.OptionTypeMapBuilder');
}
