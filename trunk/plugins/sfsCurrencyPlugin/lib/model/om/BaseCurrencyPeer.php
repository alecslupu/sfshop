<?php


abstract class BaseCurrencyPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'currency';

	
	const CLASS_DEFAULT = 'plugins.sfsCurrencyPlugin.lib.model.Currency';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'currency.ID';

	
	const TITLE = 'currency.TITLE';

	
	const CODE = 'currency.CODE';

	
	const SYMBOL_LEFT = 'currency.SYMBOL_LEFT';

	
	const SYMBOL_RIGHT = 'currency.SYMBOL_RIGHT';

	
	const DECIMAL_POINT = 'currency.DECIMAL_POINT';

	
	const THOUSANDS_POINT = 'currency.THOUSANDS_POINT';

	
	const DECIMAL_PLACES = 'currency.DECIMAL_PLACES';

	
	const VALUE = 'currency.VALUE';

	
	const IS_DEFAULT = 'currency.IS_DEFAULT';

	
	const IS_ACTIVE = 'currency.IS_ACTIVE';

	
	const CREATED_AT = 'currency.CREATED_AT';

	
	const UPDATED_AT = 'currency.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Code', 'SymbolLeft', 'SymbolRight', 'DecimalPoint', 'ThousandsPoint', 'DecimalPlaces', 'Value', 'IsDefault', 'IsActive', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (CurrencyPeer::ID, CurrencyPeer::TITLE, CurrencyPeer::CODE, CurrencyPeer::SYMBOL_LEFT, CurrencyPeer::SYMBOL_RIGHT, CurrencyPeer::DECIMAL_POINT, CurrencyPeer::THOUSANDS_POINT, CurrencyPeer::DECIMAL_PLACES, CurrencyPeer::VALUE, CurrencyPeer::IS_DEFAULT, CurrencyPeer::IS_ACTIVE, CurrencyPeer::CREATED_AT, CurrencyPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'code', 'symbol_left', 'symbol_right', 'decimal_point', 'thousands_point', 'decimal_places', 'value', 'is_default', 'is_active', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Code' => 2, 'SymbolLeft' => 3, 'SymbolRight' => 4, 'DecimalPoint' => 5, 'ThousandsPoint' => 6, 'DecimalPlaces' => 7, 'Value' => 8, 'IsDefault' => 9, 'IsActive' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ),
		BasePeer::TYPE_COLNAME => array (CurrencyPeer::ID => 0, CurrencyPeer::TITLE => 1, CurrencyPeer::CODE => 2, CurrencyPeer::SYMBOL_LEFT => 3, CurrencyPeer::SYMBOL_RIGHT => 4, CurrencyPeer::DECIMAL_POINT => 5, CurrencyPeer::THOUSANDS_POINT => 6, CurrencyPeer::DECIMAL_PLACES => 7, CurrencyPeer::VALUE => 8, CurrencyPeer::IS_DEFAULT => 9, CurrencyPeer::IS_ACTIVE => 10, CurrencyPeer::CREATED_AT => 11, CurrencyPeer::UPDATED_AT => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'code' => 2, 'symbol_left' => 3, 'symbol_right' => 4, 'decimal_point' => 5, 'thousands_point' => 6, 'decimal_places' => 7, 'value' => 8, 'is_default' => 9, 'is_active' => 10, 'created_at' => 11, 'updated_at' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsCurrencyPlugin.lib.model.map.CurrencyMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CurrencyPeer::getTableMap();
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
		return str_replace(CurrencyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CurrencyPeer::ID);

		$criteria->addSelectColumn(CurrencyPeer::TITLE);

		$criteria->addSelectColumn(CurrencyPeer::CODE);

		$criteria->addSelectColumn(CurrencyPeer::SYMBOL_LEFT);

		$criteria->addSelectColumn(CurrencyPeer::SYMBOL_RIGHT);

		$criteria->addSelectColumn(CurrencyPeer::DECIMAL_POINT);

		$criteria->addSelectColumn(CurrencyPeer::THOUSANDS_POINT);

		$criteria->addSelectColumn(CurrencyPeer::DECIMAL_PLACES);

		$criteria->addSelectColumn(CurrencyPeer::VALUE);

		$criteria->addSelectColumn(CurrencyPeer::IS_DEFAULT);

		$criteria->addSelectColumn(CurrencyPeer::IS_ACTIVE);

		$criteria->addSelectColumn(CurrencyPeer::CREATED_AT);

		$criteria->addSelectColumn(CurrencyPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(currency.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT currency.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CurrencyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CurrencyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CurrencyPeer::doSelectRS($criteria, $con);
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
		$objects = CurrencyPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CurrencyPeer::populateObjects(CurrencyPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseCurrencyPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseCurrencyPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CurrencyPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CurrencyPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
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

	
	public static function getOMClass()
	{
		return CurrencyPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseCurrencyPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCurrencyPeer', $values, $con);
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

		$criteria->remove(CurrencyPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseCurrencyPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCurrencyPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseCurrencyPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCurrencyPeer', $values, $con);
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
			$comparison = $criteria->getComparison(CurrencyPeer::ID);
			$selectCriteria->add(CurrencyPeer::ID, $criteria->remove(CurrencyPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCurrencyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCurrencyPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(CurrencyPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CurrencyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Currency) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CurrencyPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Currency $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CurrencyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CurrencyPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CurrencyPeer::DATABASE_NAME, CurrencyPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CurrencyPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(CurrencyPeer::DATABASE_NAME);

		$criteria->add(CurrencyPeer::ID, $pk);


		$v = CurrencyPeer::doSelect($criteria, $con);

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
			$criteria->add(CurrencyPeer::ID, $pks, Criteria::IN);
			$objs = CurrencyPeer::doSelect($criteria, $con);
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
    
    
} 
if (Propel::isInit()) {
			try {
		BaseCurrencyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsCurrencyPlugin.lib.model.map.CurrencyMapBuilder');
}
