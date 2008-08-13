<?php


abstract class BaseAddressFormatPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'address_format';

	
	const CLASS_DEFAULT = 'plugins.sfsAddressBookPlugin.lib.model.AddressFormat';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'address_format.ID';

	
	const LOCATION = 'address_format.LOCATION';

	
	const FORMAT = 'address_format.FORMAT';

	
	const IS_DEFAULT = 'address_format.IS_DEFAULT';

	
	const CREATED_AT = 'address_format.CREATED_AT';

	
	const UPDATED_AT = 'address_format.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Location', 'Format', 'IsDefault', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (AddressFormatPeer::ID, AddressFormatPeer::LOCATION, AddressFormatPeer::FORMAT, AddressFormatPeer::IS_DEFAULT, AddressFormatPeer::CREATED_AT, AddressFormatPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'location', 'format', 'is_default', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Location' => 1, 'Format' => 2, 'IsDefault' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (AddressFormatPeer::ID => 0, AddressFormatPeer::LOCATION => 1, AddressFormatPeer::FORMAT => 2, AddressFormatPeer::IS_DEFAULT => 3, AddressFormatPeer::CREATED_AT => 4, AddressFormatPeer::UPDATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'location' => 1, 'format' => 2, 'is_default' => 3, 'created_at' => 4, 'updated_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsAddressBookPlugin.lib.model.map.AddressFormatMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AddressFormatPeer::getTableMap();
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
		return str_replace(AddressFormatPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AddressFormatPeer::ID);

		$criteria->addSelectColumn(AddressFormatPeer::LOCATION);

		$criteria->addSelectColumn(AddressFormatPeer::FORMAT);

		$criteria->addSelectColumn(AddressFormatPeer::IS_DEFAULT);

		$criteria->addSelectColumn(AddressFormatPeer::CREATED_AT);

		$criteria->addSelectColumn(AddressFormatPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(address_format.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT address_format.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AddressFormatPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AddressFormatPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AddressFormatPeer::doSelectRS($criteria, $con);
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
		$objects = AddressFormatPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AddressFormatPeer::populateObjects(AddressFormatPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressFormatPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseAddressFormatPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AddressFormatPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AddressFormatPeer::getOMClass();
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
		return AddressFormatPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressFormatPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAddressFormatPeer', $values, $con);
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

		$criteria->remove(AddressFormatPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseAddressFormatPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAddressFormatPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressFormatPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAddressFormatPeer', $values, $con);
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
			$comparison = $criteria->getComparison(AddressFormatPeer::ID);
			$selectCriteria->add(AddressFormatPeer::ID, $criteria->remove(AddressFormatPeer::ID), $comparison);

			$comparison = $criteria->getComparison(AddressFormatPeer::LOCATION);
			$selectCriteria->add(AddressFormatPeer::LOCATION, $criteria->remove(AddressFormatPeer::LOCATION), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAddressFormatPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAddressFormatPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(AddressFormatPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AddressFormatPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof AddressFormat) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(AddressFormatPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(AddressFormatPeer::LOCATION, $vals[1], Criteria::IN);
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

	
	public static function doValidate(AddressFormat $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AddressFormatPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AddressFormatPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AddressFormatPeer::DATABASE_NAME, AddressFormatPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AddressFormatPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $location, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(AddressFormatPeer::ID, $id);
		$criteria->add(AddressFormatPeer::LOCATION, $location);
		$v = AddressFormatPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseAddressFormatPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsAddressBookPlugin.lib.model.map.AddressFormatMapBuilder');
}
