<?php


abstract class BaseTransUnitPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'trans_unit';

	
	const CLASS_DEFAULT = 'plugins.sfsCorePlugin.lib.model.translation.TransUnit';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'trans_unit.ID';

	
	const CAT_ID = 'trans_unit.CAT_ID';

	
	const SOURCE = 'trans_unit.SOURCE';

	
	const TARGET = 'trans_unit.TARGET';

	
	const COMMENTS = 'trans_unit.COMMENTS';

	
	const DATE_ADDED = 'trans_unit.DATE_ADDED';

	
	const DATE_MODIFIED = 'trans_unit.DATE_MODIFIED';

	
	const AUTHOR = 'trans_unit.AUTHOR';

	
	const TRANSLATED = 'trans_unit.TRANSLATED';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CatId', 'Source', 'Target', 'Comments', 'DateAdded', 'DateModified', 'Author', 'Translated', ),
		BasePeer::TYPE_COLNAME => array (TransUnitPeer::ID, TransUnitPeer::CAT_ID, TransUnitPeer::SOURCE, TransUnitPeer::TARGET, TransUnitPeer::COMMENTS, TransUnitPeer::DATE_ADDED, TransUnitPeer::DATE_MODIFIED, TransUnitPeer::AUTHOR, TransUnitPeer::TRANSLATED, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'cat_id', 'source', 'target', 'comments', 'date_added', 'date_modified', 'author', 'translated', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CatId' => 1, 'Source' => 2, 'Target' => 3, 'Comments' => 4, 'DateAdded' => 5, 'DateModified' => 6, 'Author' => 7, 'Translated' => 8, ),
		BasePeer::TYPE_COLNAME => array (TransUnitPeer::ID => 0, TransUnitPeer::CAT_ID => 1, TransUnitPeer::SOURCE => 2, TransUnitPeer::TARGET => 3, TransUnitPeer::COMMENTS => 4, TransUnitPeer::DATE_ADDED => 5, TransUnitPeer::DATE_MODIFIED => 6, TransUnitPeer::AUTHOR => 7, TransUnitPeer::TRANSLATED => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'cat_id' => 1, 'source' => 2, 'target' => 3, 'comments' => 4, 'date_added' => 5, 'date_modified' => 6, 'author' => 7, 'translated' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsCorePlugin.lib.model.translation.map.TransUnitMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = TransUnitPeer::getTableMap();
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
		return str_replace(TransUnitPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TransUnitPeer::ID);

		$criteria->addSelectColumn(TransUnitPeer::CAT_ID);

		$criteria->addSelectColumn(TransUnitPeer::SOURCE);

		$criteria->addSelectColumn(TransUnitPeer::TARGET);

		$criteria->addSelectColumn(TransUnitPeer::COMMENTS);

		$criteria->addSelectColumn(TransUnitPeer::DATE_ADDED);

		$criteria->addSelectColumn(TransUnitPeer::DATE_MODIFIED);

		$criteria->addSelectColumn(TransUnitPeer::AUTHOR);

		$criteria->addSelectColumn(TransUnitPeer::TRANSLATED);

	}

	const COUNT = 'COUNT(trans_unit.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT trans_unit.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TransUnitPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TransUnitPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = TransUnitPeer::doSelectRS($criteria, $con);
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
		$objects = TransUnitPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return TransUnitPeer::populateObjects(TransUnitPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransUnitPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseTransUnitPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			TransUnitPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = TransUnitPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinCatalogue(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TransUnitPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TransUnitPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TransUnitPeer::CAT_ID, CataloguePeer::CAT_ID);

		$rs = TransUnitPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinCatalogue(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransUnitPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseTransUnitPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TransUnitPeer::addSelectColumns($c);
		$startcol = (TransUnitPeer::NUM_COLUMNS - TransUnitPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CataloguePeer::addSelectColumns($c);

		$c->addJoin(TransUnitPeer::CAT_ID, CataloguePeer::CAT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TransUnitPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CataloguePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCatalogue(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addTransUnit($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initTransUnits();
				$obj2->addTransUnit($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TransUnitPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TransUnitPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TransUnitPeer::CAT_ID, CataloguePeer::CAT_ID);

		$rs = TransUnitPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransUnitPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseTransUnitPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TransUnitPeer::addSelectColumns($c);
		$startcol2 = (TransUnitPeer::NUM_COLUMNS - TransUnitPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CataloguePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CataloguePeer::NUM_COLUMNS;

		$c->addJoin(TransUnitPeer::CAT_ID, CataloguePeer::CAT_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TransUnitPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = CataloguePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCatalogue(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addTransUnit($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initTransUnits();
				$obj2->addTransUnit($obj1);
			}

			$results[] = $obj1;
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
		return TransUnitPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransUnitPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTransUnitPeer', $values, $con);
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

		$criteria->remove(TransUnitPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseTransUnitPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTransUnitPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransUnitPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTransUnitPeer', $values, $con);
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
			$comparison = $criteria->getComparison(TransUnitPeer::ID);
			$selectCriteria->add(TransUnitPeer::ID, $criteria->remove(TransUnitPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTransUnitPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTransUnitPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(TransUnitPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TransUnitPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof TransUnit) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TransUnitPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(TransUnit $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TransUnitPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TransUnitPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TransUnitPeer::DATABASE_NAME, TransUnitPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TransUnitPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(TransUnitPeer::DATABASE_NAME);

		$criteria->add(TransUnitPeer::ID, $pk);


		$v = TransUnitPeer::doSelect($criteria, $con);

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
			$criteria->add(TransUnitPeer::ID, $pks, Criteria::IN);
			$objs = TransUnitPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseTransUnitPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsCorePlugin.lib.model.translation.map.TransUnitMapBuilder');
}
