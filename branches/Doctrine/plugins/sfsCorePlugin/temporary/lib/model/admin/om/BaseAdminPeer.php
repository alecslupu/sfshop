<?php


abstract class BaseAdminPeer {

	
	const IS_I18N = false;

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'admin';

	
	const OM_CLASS = 'Admin';

	
	const CLASS_DEFAULT = 'plugins.sfsCorePlugin.lib.model.admin.Admin';

	
	const TM_CLASS = 'AdminTableMap';
	
	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'admin.ID';

	
	const CREDENTIAL = 'admin.CREDENTIAL';

	
	const EMAIL = 'admin.EMAIL';

	
	const ALGORITHM = 'admin.ALGORITHM';

	
	const SALT = 'admin.SALT';

	
	const PASSWORD = 'admin.PASSWORD';

	
	const FIRST_NAME = 'admin.FIRST_NAME';

	
	const LAST_NAME = 'admin.LAST_NAME';

	
	const IS_ACTIVE = 'admin.IS_ACTIVE';

	
	const ACCESS_NUM = 'admin.ACCESS_NUM';

	
	const CREATED_AT = 'admin.CREATED_AT';

	
	const UPDATED_AT = 'admin.UPDATED_AT';

	
	const MODIFIED_AT = 'admin.MODIFIED_AT';

	
	public static $instances = array();


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Credential', 'Email', 'Algorithm', 'Salt', 'Password', 'FirstName', 'LastName', 'IsActive', 'AccessNum', 'CreatedAt', 'UpdatedAt', 'ModifiedAt', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'credential', 'email', 'algorithm', 'salt', 'password', 'firstName', 'lastName', 'isActive', 'accessNum', 'createdAt', 'updatedAt', 'modifiedAt', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::CREDENTIAL, self::EMAIL, self::ALGORITHM, self::SALT, self::PASSWORD, self::FIRST_NAME, self::LAST_NAME, self::IS_ACTIVE, self::ACCESS_NUM, self::CREATED_AT, self::UPDATED_AT, self::MODIFIED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'credential', 'email', 'algorithm', 'salt', 'password', 'first_name', 'last_name', 'is_active', 'access_num', 'created_at', 'updated_at', 'modified_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Credential' => 1, 'Email' => 2, 'Algorithm' => 3, 'Salt' => 4, 'Password' => 5, 'FirstName' => 6, 'LastName' => 7, 'IsActive' => 8, 'AccessNum' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'ModifiedAt' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'credential' => 1, 'email' => 2, 'algorithm' => 3, 'salt' => 4, 'password' => 5, 'firstName' => 6, 'lastName' => 7, 'isActive' => 8, 'accessNum' => 9, 'createdAt' => 10, 'updatedAt' => 11, 'modifiedAt' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::CREDENTIAL => 1, self::EMAIL => 2, self::ALGORITHM => 3, self::SALT => 4, self::PASSWORD => 5, self::FIRST_NAME => 6, self::LAST_NAME => 7, self::IS_ACTIVE => 8, self::ACCESS_NUM => 9, self::CREATED_AT => 10, self::UPDATED_AT => 11, self::MODIFIED_AT => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'credential' => 1, 'email' => 2, 'algorithm' => 3, 'salt' => 4, 'password' => 5, 'first_name' => 6, 'last_name' => 7, 'is_active' => 8, 'access_num' => 9, 'created_at' => 10, 'updated_at' => 11, 'modified_at' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
		return str_replace(AdminPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(AdminPeer::ID);
		$criteria->addSelectColumn(AdminPeer::CREDENTIAL);
		$criteria->addSelectColumn(AdminPeer::EMAIL);
		$criteria->addSelectColumn(AdminPeer::ALGORITHM);
		$criteria->addSelectColumn(AdminPeer::SALT);
		$criteria->addSelectColumn(AdminPeer::PASSWORD);
		$criteria->addSelectColumn(AdminPeer::FIRST_NAME);
		$criteria->addSelectColumn(AdminPeer::LAST_NAME);
		$criteria->addSelectColumn(AdminPeer::IS_ACTIVE);
		$criteria->addSelectColumn(AdminPeer::ACCESS_NUM);
		$criteria->addSelectColumn(AdminPeer::CREATED_AT);
		$criteria->addSelectColumn(AdminPeer::UPDATED_AT);
		$criteria->addSelectColumn(AdminPeer::MODIFIED_AT);
	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AdminPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AdminPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseAdminPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAdminPeer', $criteria, $con);
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
		$objects = AdminPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return AdminPeer::populateObjects(AdminPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAdminPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseAdminPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AdminPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Admin $obj, $key = null)
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
			if (is_object($value) && $value instanceof Admin) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Admin object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = AdminPeer::getOMClass(false);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AdminPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AdminPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AdminPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
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

	
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseAdminPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseAdminPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new AdminTableMap());
	  }
	}

	
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? AdminPeer::CLASS_DEFAULT : AdminPeer::OM_CLASS;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
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
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(AdminPeer::ID) && $criteria->keyContainsValue(AdminPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.AdminPeer::ID.')');
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

		
    foreach (sfMixer::getCallables('BaseAdminPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAdminPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
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
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AdminPeer::TABLE_NAME, $con);
												AdminPeer::clearInstancePool();
			AdminPeer::clearRelatedInstancePool();
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
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												AdminPeer::clearInstancePool();
						$criteria = clone $values;
		} elseif ($values instanceof Admin) { 						AdminPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else { 			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AdminPeer::ID, (array) $values, Criteria::IN);
						foreach ((array) $values as $singleval) {
				AdminPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			AdminPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
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

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(AdminPeer::DATABASE_NAME, AdminPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        foreach ($res as $failed) {
            $col = AdminPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = AdminPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(AdminPeer::DATABASE_NAME);
		$criteria->add(AdminPeer::ID, $pk);

		$v = AdminPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AdminPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(AdminPeer::DATABASE_NAME);
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
BaseAdminPeer::buildTableMap();

