<?php


abstract class BaseMemberSecretQuestionI18nPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'member_secret_question_i18n';

	
	const CLASS_DEFAULT = 'plugins.sfsMemberPlugin.lib.model.MemberSecretQuestionI18n';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'member_secret_question_i18n.ID';

	
	const CULTURE = 'member_secret_question_i18n.CULTURE';

	
	const QUESTION = 'member_secret_question_i18n.QUESTION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Culture', 'Question', ),
		BasePeer::TYPE_COLNAME => array (MemberSecretQuestionI18nPeer::ID, MemberSecretQuestionI18nPeer::CULTURE, MemberSecretQuestionI18nPeer::QUESTION, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'culture', 'question', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Culture' => 1, 'Question' => 2, ),
		BasePeer::TYPE_COLNAME => array (MemberSecretQuestionI18nPeer::ID => 0, MemberSecretQuestionI18nPeer::CULTURE => 1, MemberSecretQuestionI18nPeer::QUESTION => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'culture' => 1, 'question' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsMemberPlugin.lib.model.map.MemberSecretQuestionI18nMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = MemberSecretQuestionI18nPeer::getTableMap();
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
		return str_replace(MemberSecretQuestionI18nPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(MemberSecretQuestionI18nPeer::ID);

		$criteria->addSelectColumn(MemberSecretQuestionI18nPeer::CULTURE);

		$criteria->addSelectColumn(MemberSecretQuestionI18nPeer::QUESTION);

	}

	const COUNT = 'COUNT(member_secret_question_i18n.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT member_secret_question_i18n.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MemberSecretQuestionI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MemberSecretQuestionI18nPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MemberSecretQuestionI18nPeer::doSelectRS($criteria, $con);
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
		$objects = MemberSecretQuestionI18nPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return MemberSecretQuestionI18nPeer::populateObjects(MemberSecretQuestionI18nPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18nPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseMemberSecretQuestionI18nPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MemberSecretQuestionI18nPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = MemberSecretQuestionI18nPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinMemberSecretQuestion(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MemberSecretQuestionI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MemberSecretQuestionI18nPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MemberSecretQuestionI18nPeer::ID, MemberSecretQuestionPeer::ID);

		$rs = MemberSecretQuestionI18nPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinMemberSecretQuestion(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18nPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseMemberSecretQuestionI18nPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MemberSecretQuestionI18nPeer::addSelectColumns($c);
		$startcol = (MemberSecretQuestionI18nPeer::NUM_COLUMNS - MemberSecretQuestionI18nPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MemberSecretQuestionPeer::addSelectColumns($c);

		$c->addJoin(MemberSecretQuestionI18nPeer::ID, MemberSecretQuestionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MemberSecretQuestionI18nPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MemberSecretQuestionPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getMemberSecretQuestion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMemberSecretQuestionI18n($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMemberSecretQuestionI18ns();
				$obj2->addMemberSecretQuestionI18n($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MemberSecretQuestionI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MemberSecretQuestionI18nPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MemberSecretQuestionI18nPeer::ID, MemberSecretQuestionPeer::ID);

		$rs = MemberSecretQuestionI18nPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18nPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseMemberSecretQuestionI18nPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MemberSecretQuestionI18nPeer::addSelectColumns($c);
		$startcol2 = (MemberSecretQuestionI18nPeer::NUM_COLUMNS - MemberSecretQuestionI18nPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberSecretQuestionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberSecretQuestionPeer::NUM_COLUMNS;

		$c->addJoin(MemberSecretQuestionI18nPeer::ID, MemberSecretQuestionPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MemberSecretQuestionI18nPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = MemberSecretQuestionPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMemberSecretQuestion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMemberSecretQuestionI18n($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initMemberSecretQuestionI18ns();
				$obj2->addMemberSecretQuestionI18n($obj1);
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
		return MemberSecretQuestionI18nPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18nPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMemberSecretQuestionI18nPeer', $values, $con);
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


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18nPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseMemberSecretQuestionI18nPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18nPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMemberSecretQuestionI18nPeer', $values, $con);
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
			$comparison = $criteria->getComparison(MemberSecretQuestionI18nPeer::ID);
			$selectCriteria->add(MemberSecretQuestionI18nPeer::ID, $criteria->remove(MemberSecretQuestionI18nPeer::ID), $comparison);

			$comparison = $criteria->getComparison(MemberSecretQuestionI18nPeer::CULTURE);
			$selectCriteria->add(MemberSecretQuestionI18nPeer::CULTURE, $criteria->remove(MemberSecretQuestionI18nPeer::CULTURE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseMemberSecretQuestionI18nPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseMemberSecretQuestionI18nPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(MemberSecretQuestionI18nPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(MemberSecretQuestionI18nPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof MemberSecretQuestionI18n) {

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

			$criteria->add(MemberSecretQuestionI18nPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(MemberSecretQuestionI18nPeer::CULTURE, $vals[1], Criteria::IN);
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

	
	public static function doValidate(MemberSecretQuestionI18n $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MemberSecretQuestionI18nPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MemberSecretQuestionI18nPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(MemberSecretQuestionI18nPeer::DATABASE_NAME, MemberSecretQuestionI18nPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MemberSecretQuestionI18nPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id, $culture, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(MemberSecretQuestionI18nPeer::ID, $id);
		$criteria->add(MemberSecretQuestionI18nPeer::CULTURE, $culture);
		$v = MemberSecretQuestionI18nPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseMemberSecretQuestionI18nPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsMemberPlugin.lib.model.map.MemberSecretQuestionI18nMapBuilder');
}
