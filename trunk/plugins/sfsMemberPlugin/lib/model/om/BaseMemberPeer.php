<?php


abstract class BaseMemberPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'member';

	
	const CLASS_DEFAULT = 'plugins.sfsMemberPlugin.lib.model.Member';

	
	const NUM_COLUMNS = 20;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'member.ID';

	
	const CREDENTIAL = 'member.CREDENTIAL';

	
	const GENDER = 'member.GENDER';

	
	const FIRST_NAME = 'member.FIRST_NAME';

	
	const LAST_NAME = 'member.LAST_NAME';

	
	const EMAIL = 'member.EMAIL';

	
	const DEFAULT_ADDRESS_ID = 'member.DEFAULT_ADDRESS_ID';

	
	const SECRET_QUESTION = 'member.SECRET_QUESTION';

	
	const SECRET_ANSWER = 'member.SECRET_ANSWER';

	
	const PHONE = 'member.PHONE';

	
	const MOBILE = 'member.MOBILE';

	
	const PASSWORD = 'member.PASSWORD';

	
	const CONFIRM_CODE = 'member.CONFIRM_CODE';

	
	const IS_CONFIRMED = 'member.IS_CONFIRMED';

	
	const IS_DELETED = 'member.IS_DELETED';

	
	const IS_ACTIVE = 'member.IS_ACTIVE';

	
	const ACCESS_NUM = 'member.ACCESS_NUM';

	
	const CREATED_AT = 'member.CREATED_AT';

	
	const UPDATED_AT = 'member.UPDATED_AT';

	
	const MODIFIED_AT = 'member.MODIFIED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Credential', 'Gender', 'FirstName', 'LastName', 'Email', 'DefaultAddressId', 'SecretQuestion', 'SecretAnswer', 'Phone', 'Mobile', 'Password', 'ConfirmCode', 'IsConfirmed', 'IsDeleted', 'IsActive', 'AccessNum', 'CreatedAt', 'UpdatedAt', 'ModifiedAt', ),
		BasePeer::TYPE_COLNAME => array (MemberPeer::ID, MemberPeer::CREDENTIAL, MemberPeer::GENDER, MemberPeer::FIRST_NAME, MemberPeer::LAST_NAME, MemberPeer::EMAIL, MemberPeer::DEFAULT_ADDRESS_ID, MemberPeer::SECRET_QUESTION, MemberPeer::SECRET_ANSWER, MemberPeer::PHONE, MemberPeer::MOBILE, MemberPeer::PASSWORD, MemberPeer::CONFIRM_CODE, MemberPeer::IS_CONFIRMED, MemberPeer::IS_DELETED, MemberPeer::IS_ACTIVE, MemberPeer::ACCESS_NUM, MemberPeer::CREATED_AT, MemberPeer::UPDATED_AT, MemberPeer::MODIFIED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'credential', 'gender', 'first_name', 'last_name', 'email', 'default_address_id', 'secret_question', 'secret_answer', 'phone', 'mobile', 'password', 'confirm_code', 'is_confirmed', 'is_deleted', 'is_active', 'access_num', 'created_at', 'updated_at', 'modified_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Credential' => 1, 'Gender' => 2, 'FirstName' => 3, 'LastName' => 4, 'Email' => 5, 'DefaultAddressId' => 6, 'SecretQuestion' => 7, 'SecretAnswer' => 8, 'Phone' => 9, 'Mobile' => 10, 'Password' => 11, 'ConfirmCode' => 12, 'IsConfirmed' => 13, 'IsDeleted' => 14, 'IsActive' => 15, 'AccessNum' => 16, 'CreatedAt' => 17, 'UpdatedAt' => 18, 'ModifiedAt' => 19, ),
		BasePeer::TYPE_COLNAME => array (MemberPeer::ID => 0, MemberPeer::CREDENTIAL => 1, MemberPeer::GENDER => 2, MemberPeer::FIRST_NAME => 3, MemberPeer::LAST_NAME => 4, MemberPeer::EMAIL => 5, MemberPeer::DEFAULT_ADDRESS_ID => 6, MemberPeer::SECRET_QUESTION => 7, MemberPeer::SECRET_ANSWER => 8, MemberPeer::PHONE => 9, MemberPeer::MOBILE => 10, MemberPeer::PASSWORD => 11, MemberPeer::CONFIRM_CODE => 12, MemberPeer::IS_CONFIRMED => 13, MemberPeer::IS_DELETED => 14, MemberPeer::IS_ACTIVE => 15, MemberPeer::ACCESS_NUM => 16, MemberPeer::CREATED_AT => 17, MemberPeer::UPDATED_AT => 18, MemberPeer::MODIFIED_AT => 19, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'credential' => 1, 'gender' => 2, 'first_name' => 3, 'last_name' => 4, 'email' => 5, 'default_address_id' => 6, 'secret_question' => 7, 'secret_answer' => 8, 'phone' => 9, 'mobile' => 10, 'password' => 11, 'confirm_code' => 12, 'is_confirmed' => 13, 'is_deleted' => 14, 'is_active' => 15, 'access_num' => 16, 'created_at' => 17, 'updated_at' => 18, 'modified_at' => 19, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsMemberPlugin.lib.model.map.MemberMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = MemberPeer::getTableMap();
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
		return str_replace(MemberPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(MemberPeer::ID);

		$criteria->addSelectColumn(MemberPeer::CREDENTIAL);

		$criteria->addSelectColumn(MemberPeer::GENDER);

		$criteria->addSelectColumn(MemberPeer::FIRST_NAME);

		$criteria->addSelectColumn(MemberPeer::LAST_NAME);

		$criteria->addSelectColumn(MemberPeer::EMAIL);

		$criteria->addSelectColumn(MemberPeer::DEFAULT_ADDRESS_ID);

		$criteria->addSelectColumn(MemberPeer::SECRET_QUESTION);

		$criteria->addSelectColumn(MemberPeer::SECRET_ANSWER);

		$criteria->addSelectColumn(MemberPeer::PHONE);

		$criteria->addSelectColumn(MemberPeer::MOBILE);

		$criteria->addSelectColumn(MemberPeer::PASSWORD);

		$criteria->addSelectColumn(MemberPeer::CONFIRM_CODE);

		$criteria->addSelectColumn(MemberPeer::IS_CONFIRMED);

		$criteria->addSelectColumn(MemberPeer::IS_DELETED);

		$criteria->addSelectColumn(MemberPeer::IS_ACTIVE);

		$criteria->addSelectColumn(MemberPeer::ACCESS_NUM);

		$criteria->addSelectColumn(MemberPeer::CREATED_AT);

		$criteria->addSelectColumn(MemberPeer::UPDATED_AT);

		$criteria->addSelectColumn(MemberPeer::MODIFIED_AT);

	}

	const COUNT = 'COUNT(member.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT member.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MemberPeer::doSelectRS($criteria, $con);
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
		$objects = MemberPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return MemberPeer::populateObjects(MemberPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseMemberPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MemberPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = MemberPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinAddressBook(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MemberPeer::DEFAULT_ADDRESS_ID, AddressBookPeer::ID);

		$rs = MemberPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAddressBook(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseMemberPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MemberPeer::addSelectColumns($c);
		$startcol = (MemberPeer::NUM_COLUMNS - MemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AddressBookPeer::addSelectColumns($c);

		$c->addJoin(MemberPeer::DEFAULT_ADDRESS_ID, AddressBookPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MemberPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AddressBookPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAddressBook(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMember($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMembers();
				$obj2->addMember($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MemberPeer::DEFAULT_ADDRESS_ID, AddressBookPeer::ID);

		$rs = MemberPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseMemberPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MemberPeer::addSelectColumns($c);
		$startcol2 = (MemberPeer::NUM_COLUMNS - MemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AddressBookPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AddressBookPeer::NUM_COLUMNS;

		$c->addJoin(MemberPeer::DEFAULT_ADDRESS_ID, AddressBookPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MemberPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = AddressBookPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAddressBook(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMember($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initMembers();
				$obj2->addMember($obj1);
			}

			$results[] = $obj1;
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
		return MemberPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMemberPeer', $values, $con);
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

		$criteria->remove(MemberPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseMemberPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseMemberPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMemberPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMemberPeer', $values, $con);
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
			$comparison = $criteria->getComparison(MemberPeer::ID);
			$selectCriteria->add(MemberPeer::ID, $criteria->remove(MemberPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseMemberPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseMemberPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(MemberPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(MemberPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Member) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MemberPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Member $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MemberPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MemberPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(MemberPeer::DATABASE_NAME, MemberPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MemberPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(MemberPeer::DATABASE_NAME);

		$criteria->add(MemberPeer::ID, $pk);


		$v = MemberPeer::doSelect($criteria, $con);

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
			$criteria->add(MemberPeer::ID, $pks, Criteria::IN);
			$objs = MemberPeer::doSelect($criteria, $con);
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
    
    
} 
if (Propel::isInit()) {
			try {
		BaseMemberPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsMemberPlugin.lib.model.map.MemberMapBuilder');
}
