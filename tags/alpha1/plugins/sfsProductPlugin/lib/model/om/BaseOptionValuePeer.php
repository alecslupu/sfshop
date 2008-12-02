<?php


abstract class BaseOptionValuePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'option_value';

	
	const CLASS_DEFAULT = 'plugins.sfsProductPlugin.lib.model.OptionValue';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'option_value.ID';

	
	const TYPE_ID = 'option_value.TYPE_ID';

	
	const NAME = 'option_value.NAME';

	
	const POS = 'option_value.POS';

	
	const IS_ACTIVE = 'option_value.IS_ACTIVE';

	
	const IS_DELETED = 'option_value.IS_DELETED';

	
	const CREATED_AT = 'option_value.CREATED_AT';

	
	const UPDATED_AT = 'option_value.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'TypeId', 'Name', 'Pos', 'IsActive', 'IsDeleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (OptionValuePeer::ID, OptionValuePeer::TYPE_ID, OptionValuePeer::NAME, OptionValuePeer::POS, OptionValuePeer::IS_ACTIVE, OptionValuePeer::IS_DELETED, OptionValuePeer::CREATED_AT, OptionValuePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'type_id', 'name', 'pos', 'is_active', 'is_deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TypeId' => 1, 'Name' => 2, 'Pos' => 3, 'IsActive' => 4, 'IsDeleted' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
		BasePeer::TYPE_COLNAME => array (OptionValuePeer::ID => 0, OptionValuePeer::TYPE_ID => 1, OptionValuePeer::NAME => 2, OptionValuePeer::POS => 3, OptionValuePeer::IS_ACTIVE => 4, OptionValuePeer::IS_DELETED => 5, OptionValuePeer::CREATED_AT => 6, OptionValuePeer::UPDATED_AT => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'type_id' => 1, 'name' => 2, 'pos' => 3, 'is_active' => 4, 'is_deleted' => 5, 'created_at' => 6, 'updated_at' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsProductPlugin.lib.model.map.OptionValueMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OptionValuePeer::getTableMap();
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
		return str_replace(OptionValuePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OptionValuePeer::ID);

		$criteria->addSelectColumn(OptionValuePeer::TYPE_ID);

		$criteria->addSelectColumn(OptionValuePeer::NAME);

		$criteria->addSelectColumn(OptionValuePeer::POS);

		$criteria->addSelectColumn(OptionValuePeer::IS_ACTIVE);

		$criteria->addSelectColumn(OptionValuePeer::IS_DELETED);

		$criteria->addSelectColumn(OptionValuePeer::CREATED_AT);

		$criteria->addSelectColumn(OptionValuePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(option_value.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT option_value.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OptionValuePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionValuePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OptionValuePeer::doSelectRS($criteria, $con);
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
		$objects = OptionValuePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OptionValuePeer::populateObjects(OptionValuePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionValuePeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseOptionValuePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OptionValuePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OptionValuePeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOptionType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OptionValuePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionValuePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OptionValuePeer::TYPE_ID, OptionTypePeer::ID);

		$rs = OptionValuePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOptionType(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionValuePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOptionValuePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OptionValuePeer::addSelectColumns($c);
		$startcol = (OptionValuePeer::NUM_COLUMNS - OptionValuePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OptionTypePeer::addSelectColumns($c);

		$c->addJoin(OptionValuePeer::TYPE_ID, OptionTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OptionValuePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OptionTypePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOptionType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOptionValue($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOptionValues();
				$obj2->addOptionValue($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OptionValuePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionValuePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OptionValuePeer::TYPE_ID, OptionTypePeer::ID);

		$rs = OptionValuePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionValuePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseOptionValuePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OptionValuePeer::addSelectColumns($c);
		$startcol2 = (OptionValuePeer::NUM_COLUMNS - OptionValuePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OptionTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OptionTypePeer::NUM_COLUMNS;

		$c->addJoin(OptionValuePeer::TYPE_ID, OptionTypePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OptionValuePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OptionTypePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOptionType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOptionValue($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOptionValues();
				$obj2->addOptionValue($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  
  public static function doSelectWithI18n(Criteria $c, $culture = null, $con = null)
  {
    if ($culture === null)
    {
      $culture = sfPropel::getDefaultCulture();
    }


    foreach (sfMixer::getCallables('BaseOptionValuePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOptionValuePeer', $c, $con);
    }


        if ($c->getDbName() == Propel::getDefaultDB())
    {
      $c->setDbName(self::DATABASE_NAME);
    }

    OptionValuePeer::addSelectColumns($c);
    $startcol = (OptionValuePeer::NUM_COLUMNS - OptionValuePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    OptionValueI18nPeer::addSelectColumns($c);

    $c->addJoin(OptionValuePeer::ID, OptionValueI18nPeer::ID);
    $c->add(OptionValueI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = OptionValuePeer::getOMClass();

      $cls = sfPropel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = OptionValueI18nPeer::getOMClass($rs, $startcol);

      $cls = sfPropel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setOptionValueI18nForCulture($obj2, $culture);
      $obj2->setOptionValue($obj1);

      $results[] = $obj1;
    }
    return $results;
  }


  
  public static function getI18nModel()
  {
    return 'OptionValueI18n';
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
		return OptionValuePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionValuePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOptionValuePeer', $values, $con);
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

		$criteria->remove(OptionValuePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseOptionValuePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseOptionValuePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionValuePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOptionValuePeer', $values, $con);
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
			$comparison = $criteria->getComparison(OptionValuePeer::ID);
			$selectCriteria->add(OptionValuePeer::ID, $criteria->remove(OptionValuePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseOptionValuePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseOptionValuePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(OptionValuePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OptionValuePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OptionValue) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OptionValuePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OptionValue $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OptionValuePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OptionValuePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OptionValuePeer::DATABASE_NAME, OptionValuePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OptionValuePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OptionValuePeer::DATABASE_NAME);

		$criteria->add(OptionValuePeer::ID, $pk);


		$v = OptionValuePeer::doSelect($criteria, $con);

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
			$criteria->add(OptionValuePeer::ID, $pks, Criteria::IN);
			$objs = OptionValuePeer::doSelect($criteria, $con);
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
		BaseOptionValuePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsProductPlugin.lib.model.map.OptionValueMapBuilder');
}
