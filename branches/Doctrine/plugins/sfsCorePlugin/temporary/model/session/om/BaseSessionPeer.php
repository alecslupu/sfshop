<?php


abstract class BaseSessionPeer {

	
	const IS_I18N = false;

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'session';

	
	const OM_CLASS = 'Session';

	
	const CLASS_DEFAULT = 'plugins.sfsCorePlugin.lib.model.session.Session';

	
	const TM_CLASS = 'SessionTableMap';
	
	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CID = 'session.CID';

	
	const SES_DATA = 'session.SES_DATA';

	
	const SES_TIME = 'session.SES_TIME';

	
	public static $instances = array();


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Cid', 'SesData', 'SesTime', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('cid', 'sesData', 'sesTime', ),
		BasePeer::TYPE_COLNAME => array (self::CID, self::SES_DATA, self::SES_TIME, ),
		BasePeer::TYPE_FIELDNAME => array ('cid', 'ses_data', 'ses_time', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Cid' => 0, 'SesData' => 1, 'SesTime' => 2, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('cid' => 0, 'sesData' => 1, 'sesTime' => 2, ),
		BasePeer::TYPE_COLNAME => array (self::CID => 0, self::SES_DATA => 1, self::SES_TIME => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('cid' => 0, 'ses_data' => 1, 'ses_time' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
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
		return str_replace(SessionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(SessionPeer::CID);
		$criteria->addSelectColumn(SessionPeer::SES_DATA);
		$criteria->addSelectColumn(SessionPeer::SES_TIME);
	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SessionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SessionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseSessionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseSessionPeer', $criteria, $con);
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
		$objects = SessionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return SessionPeer::populateObjects(SessionPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSessionPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseSessionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			SessionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Session $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCid();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Session) {
				$key = (string) $value->getCid();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Session object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = SessionPeer::getOMClass(false);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = SessionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = SessionPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				SessionPeer::addInstanceToPool($obj, $key);
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
	  $dbMap = Propel::getDatabaseMap(BaseSessionPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseSessionPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new SessionTableMap());
	  }
	}

	
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? SessionPeer::CLASS_DEFAULT : SessionPeer::OM_CLASS;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSessionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSessionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseSessionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSessionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSessionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSessionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(SessionPeer::CID);
			$selectCriteria->add(SessionPeer::CID, $criteria->remove(SessionPeer::CID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSessionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSessionPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(SessionPeer::TABLE_NAME, $con);
												SessionPeer::clearInstancePool();
			SessionPeer::clearRelatedInstancePool();
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
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												SessionPeer::clearInstancePool();
						$criteria = clone $values;
		} elseif ($values instanceof Session) { 						SessionPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else { 			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SessionPeer::CID, (array) $values, Criteria::IN);
						foreach ((array) $values as $singleval) {
				SessionPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			SessionPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(Session $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SessionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SessionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SessionPeer::DATABASE_NAME, SessionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        foreach ($res as $failed) {
            $col = SessionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = SessionPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(SessionPeer::DATABASE_NAME);
		$criteria->add(SessionPeer::CID, $pk);

		$v = SessionPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SessionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(SessionPeer::DATABASE_NAME);
			$criteria->add(SessionPeer::CID, $pks, Criteria::IN);
			$objs = SessionPeer::doSelect($criteria, $con);
		}
		return $objs;
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
BaseSessionPeer::buildTableMap();

