<?php


abstract class BaseEmailTemplateI18nPeer {

	
	const IS_I18N = false;

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'email_template_i18n';

	
	const OM_CLASS = 'EmailTemplateI18n';

	
	const CLASS_DEFAULT = 'plugins.sfsCorePlugin.lib.model.common.EmailTemplateI18n';

	
	const TM_CLASS = 'EmailTemplateI18nTableMap';
	
	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'email_template_i18n.ID';

	
	const CULTURE = 'email_template_i18n.CULTURE';

	
	const SUBJECT = 'email_template_i18n.SUBJECT';

	
	const BODY = 'email_template_i18n.BODY';

	
	public static $instances = array();


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Culture', 'Subject', 'Body', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'culture', 'subject', 'body', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::CULTURE, self::SUBJECT, self::BODY, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'culture', 'subject', 'body', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Culture' => 1, 'Subject' => 2, 'Body' => 3, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'culture' => 1, 'subject' => 2, 'body' => 3, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::CULTURE => 1, self::SUBJECT => 2, self::BODY => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'culture' => 1, 'subject' => 2, 'body' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
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
		return str_replace(EmailTemplateI18nPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(EmailTemplateI18nPeer::ID);
		$criteria->addSelectColumn(EmailTemplateI18nPeer::CULTURE);
		$criteria->addSelectColumn(EmailTemplateI18nPeer::SUBJECT);
		$criteria->addSelectColumn(EmailTemplateI18nPeer::BODY);
	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EmailTemplateI18nPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EmailTemplateI18nPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseEmailTemplateI18nPeer', $criteria, $con);
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
		$objects = EmailTemplateI18nPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return EmailTemplateI18nPeer::populateObjects(EmailTemplateI18nPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseEmailTemplateI18nPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			EmailTemplateI18nPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(EmailTemplateI18n $obj, $key = null)
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
			if (is_object($value) && $value instanceof EmailTemplateI18n) {
				$key = serialize(array((string) $value->getId(), (string) $value->getCulture()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or EmailTemplateI18n object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = EmailTemplateI18nPeer::getOMClass(false);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = EmailTemplateI18nPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = EmailTemplateI18nPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				EmailTemplateI18nPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinEmailTemplate(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EmailTemplateI18nPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EmailTemplateI18nPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(EmailTemplateI18nPeer::ID,), array(EmailTemplatePeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseEmailTemplateI18nPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinEmailTemplate(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseEmailTemplateI18nPeer', $criteria, $con);
    }


		$criteria = clone $criteria;

				if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		EmailTemplateI18nPeer::addSelectColumns($criteria);
		$startcol = (EmailTemplateI18nPeer::NUM_COLUMNS - EmailTemplateI18nPeer::NUM_LAZY_LOAD_COLUMNS);
		EmailTemplatePeer::addSelectColumns($criteria);

		$criteria->addJoin(EmailTemplateI18nPeer::ID, EmailTemplatePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EmailTemplateI18nPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EmailTemplateI18nPeer::getInstanceFromPool($key1))) {
															} else {

				$cls = EmailTemplateI18nPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				EmailTemplateI18nPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = EmailTemplatePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = EmailTemplatePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = EmailTemplatePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					EmailTemplatePeer::addInstanceToPool($obj2, $key2);
				} 				
								$obj2->addEmailTemplateI18n($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EmailTemplateI18nPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EmailTemplateI18nPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(EmailTemplateI18nPeer::ID,), array(EmailTemplatePeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseEmailTemplateI18nPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseEmailTemplateI18nPeer', $criteria, $con);
    }


		$criteria = clone $criteria;

				if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		EmailTemplateI18nPeer::addSelectColumns($criteria);
		$startcol2 = (EmailTemplateI18nPeer::NUM_COLUMNS - EmailTemplateI18nPeer::NUM_LAZY_LOAD_COLUMNS);

		EmailTemplatePeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (EmailTemplatePeer::NUM_COLUMNS - EmailTemplatePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(EmailTemplateI18nPeer::ID, EmailTemplatePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EmailTemplateI18nPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EmailTemplateI18nPeer::getInstanceFromPool($key1))) {
															} else {
				$cls = EmailTemplateI18nPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				EmailTemplateI18nPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = EmailTemplatePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = EmailTemplatePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = EmailTemplatePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					EmailTemplatePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addEmailTemplateI18n($obj1);
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
	  $dbMap = Propel::getDatabaseMap(BaseEmailTemplateI18nPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseEmailTemplateI18nPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new EmailTemplateI18nTableMap());
	  }
	}

	
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? EmailTemplateI18nPeer::CLASS_DEFAULT : EmailTemplateI18nPeer::OM_CLASS;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseEmailTemplateI18nPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseEmailTemplateI18nPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseEmailTemplateI18nPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(EmailTemplateI18nPeer::ID);
			$selectCriteria->add(EmailTemplateI18nPeer::ID, $criteria->remove(EmailTemplateI18nPeer::ID), $comparison);

			$comparison = $criteria->getComparison(EmailTemplateI18nPeer::CULTURE);
			$selectCriteria->add(EmailTemplateI18nPeer::CULTURE, $criteria->remove(EmailTemplateI18nPeer::CULTURE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseEmailTemplateI18nPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseEmailTemplateI18nPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(EmailTemplateI18nPeer::TABLE_NAME, $con);
												EmailTemplateI18nPeer::clearInstancePool();
			EmailTemplateI18nPeer::clearRelatedInstancePool();
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
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												EmailTemplateI18nPeer::clearInstancePool();
						$criteria = clone $values;
		} elseif ($values instanceof EmailTemplateI18n) { 						EmailTemplateI18nPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else { 			$criteria = new Criteria(self::DATABASE_NAME);
									if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}
			foreach ($values as $value) {
				$criterion = $criteria->getNewCriterion(EmailTemplateI18nPeer::ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(EmailTemplateI18nPeer::CULTURE, $value[1]));
				$criteria->addOr($criterion);
								EmailTemplateI18nPeer::removeInstanceFromPool($value);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			EmailTemplateI18nPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(EmailTemplateI18n $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EmailTemplateI18nPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EmailTemplateI18nPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EmailTemplateI18nPeer::DATABASE_NAME, EmailTemplateI18nPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        foreach ($res as $failed) {
            $col = EmailTemplateI18nPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($id, $culture, PropelPDO $con = null) {
		$key = serialize(array((string) $id, (string) $culture));
 		if (null !== ($obj = EmailTemplateI18nPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailTemplateI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(EmailTemplateI18nPeer::DATABASE_NAME);
		$criteria->add(EmailTemplateI18nPeer::ID, $id);
		$criteria->add(EmailTemplateI18nPeer::CULTURE, $culture);
		$v = EmailTemplateI18nPeer::doSelect($criteria, $con);

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
BaseEmailTemplateI18nPeer::buildTableMap();

