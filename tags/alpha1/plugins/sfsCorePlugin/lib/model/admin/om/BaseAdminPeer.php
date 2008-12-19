<?php


abstract class BaseAdminPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'admin';

	
	const CLASS_DEFAULT = 'plugins.sfsCorePlugin.lib.model.admin.Admin';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'admin.ID';

	
	const CREDENTIAL = 'admin.CREDENTIAL';

	
	const EMAIL = 'admin.EMAIL';

	
	const PASSWORD = 'admin.PASSWORD';

	
	const FIRST_NAME = 'admin.FIRST_NAME';

	
	const LAST_NAME = 'admin.LAST_NAME';

	
	const IS_ACTIVE = 'admin.IS_ACTIVE';

	
	const ACCESS_NUM = 'admin.ACCESS_NUM';

	
	const CREATED_AT = 'admin.CREATED_AT';

	
	const UPDATED_AT = 'admin.UPDATED_AT';

	
	const MODIFIED_AT = 'admin.MODIFIED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Credential', 'Email', 'Password', 'FirstName', 'LastName', 'IsActive', 'AccessNum', 'CreatedAt', 'UpdatedAt', 'ModifiedAt', ),
		BasePeer::TYPE_COLNAME => array (AdminPeer::ID, AdminPeer::CREDENTIAL, AdminPeer::EMAIL, AdminPeer::PASSWORD, AdminPeer::FIRST_NAME, AdminPeer::LAST_NAME, AdminPeer::IS_ACTIVE, AdminPeer::ACCESS_NUM, AdminPeer::CREATED_AT, AdminPeer::UPDATED_AT, AdminPeer::MODIFIED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'credential', 'email', 'password', 'first_name', 'last_name', 'is_active', 'access_num', 'created_at', 'updated_at', 'modified_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Credential' => 1, 'Email' => 2, 'Password' => 3, 'FirstName' => 4, 'LastName' => 5, 'IsActive' => 6, 'AccessNum' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'ModifiedAt' => 10, ),
		BasePeer::TYPE_COLNAME => array (AdminPeer::ID => 0, AdminPeer::CREDENTIAL => 1, AdminPeer::EMAIL => 2, AdminPeer::PASSWORD => 3, AdminPeer::FIRST_NAME => 4, AdminPeer::LAST_NAME => 5, AdminPeer::IS_ACTIVE => 6, AdminPeer::ACCESS_NUM => 7, AdminPeer::CREATED_AT => 8, AdminPeer::UPDATED_AT => 9, AdminPeer::MODIFIED_AT => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'credential' => 1, 'email' => 2, 'password' => 3, 'first_name' => 4, 'last_name' => 5, 'is_active' => 6, 'access_num' => 7, 'created_at' => 8, 'updated_at' => 9, 'modified_at' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsCorePlugin.lib.model.admin.map.AdminMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AdminPeer::getTableMap();
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
		return str_replace(AdminPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AdminPeer::ID);

		$criteria->addSelectColumn(AdminPeer::CREDENTIAL);

		$criteria->addSelectColumn(AdminPeer::EMAIL);

		$criteria->addSelectColumn(AdminPeer::PASSWORD);

		$criteria->addSelectColumn(AdminPeer::FIRST_NAME);

		$criteria->addSelectColumn(AdminPeer::LAST_NAME);

		$criteria->addSelectColumn(AdminPeer::IS_ACTIVE);

		$criteria->addSelectColumn(AdminPeer::ACCESS_NUM);

		$criteria->addSelectColumn(AdminPeer::CREATED_AT);

		$criteria->addSelectColumn(AdminPeer::UPDATED_AT);

		$criteria->addSelectColumn(AdminPeer::MODIFIED_AT);

	}

	const COUNT = 'COUNT(admin.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT admin.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AdminPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AdminPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AdminPeer::doSelectRS($criteria, $con);
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
		$objects = AdminPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AdminPeer::populateObjects(AdminPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseAdminPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AdminPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AdminPeer::getOMClass();
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
    return array(array('email'));
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return AdminPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAdminPeer', $values, $con);
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

		$criteria->remove(AdminPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseAdminPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAdminPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAdminPeer', $values, $con);
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
			$comparison = $criteria->getComparison(AdminPeer::ID);
			$selectCriteria->add(AdminPeer::ID, $criteria->remove(AdminPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAdminPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAdminPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(AdminPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Admin) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AdminPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Admin $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AdminPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AdminPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AdminPeer::DATABASE_NAME, AdminPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AdminPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(AdminPeer::DATABASE_NAME);

		$criteria->add(AdminPeer::ID, $pk);


		$v = AdminPeer::doSelect($criteria, $con);

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
			$criteria->add(AdminPeer::ID, $pks, Criteria::IN);
			$objs = AdminPeer::doSelect($criteria, $con);
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
    
   
    public static function getAll($criteria = null)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        return self::doSelect($criteria);
    }
    
} 
if (Propel::isInit()) {
			try {
		BaseAdminPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsCorePlugin.lib.model.admin.map.AdminMapBuilder');
}