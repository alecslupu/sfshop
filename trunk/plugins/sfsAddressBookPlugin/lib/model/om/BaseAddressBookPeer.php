<?php


abstract class BaseAddressBookPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'address_book';

	
	const CLASS_DEFAULT = 'plugins.sfsAddressBookPlugin.lib.model.AddressBook';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'address_book.ID';

	
	const MEMBER_ID = 'address_book.MEMBER_ID';

	
	const GENDER = 'address_book.GENDER';

	
	const FIRST_NAME = 'address_book.FIRST_NAME';

	
	const LAST_NAME = 'address_book.LAST_NAME';

	
	const COMPANY = 'address_book.COMPANY';

	
	const COUNTRY_ID = 'address_book.COUNTRY_ID';

	
	const STATE_ID = 'address_book.STATE_ID';

	
	const STATE_TITLE = 'address_book.STATE_TITLE';

	
	const CITY = 'address_book.CITY';

	
	const STREET = 'address_book.STREET';

	
	const POSTCODE = 'address_book.POSTCODE';

	
	const IS_DEFAULT = 'address_book.IS_DEFAULT';

	
	const CREATED_AT = 'address_book.CREATED_AT';

	
	const UPDATED_AT = 'address_book.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'MemberId', 'Gender', 'FirstName', 'LastName', 'Company', 'CountryId', 'StateId', 'StateTitle', 'City', 'Street', 'Postcode', 'IsDefault', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (AddressBookPeer::ID, AddressBookPeer::MEMBER_ID, AddressBookPeer::GENDER, AddressBookPeer::FIRST_NAME, AddressBookPeer::LAST_NAME, AddressBookPeer::COMPANY, AddressBookPeer::COUNTRY_ID, AddressBookPeer::STATE_ID, AddressBookPeer::STATE_TITLE, AddressBookPeer::CITY, AddressBookPeer::STREET, AddressBookPeer::POSTCODE, AddressBookPeer::IS_DEFAULT, AddressBookPeer::CREATED_AT, AddressBookPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'member_id', 'gender', 'first_name', 'last_name', 'company', 'country_id', 'state_id', 'state_title', 'city', 'street', 'postcode', 'is_default', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'MemberId' => 1, 'Gender' => 2, 'FirstName' => 3, 'LastName' => 4, 'Company' => 5, 'CountryId' => 6, 'StateId' => 7, 'StateTitle' => 8, 'City' => 9, 'Street' => 10, 'Postcode' => 11, 'IsDefault' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, ),
		BasePeer::TYPE_COLNAME => array (AddressBookPeer::ID => 0, AddressBookPeer::MEMBER_ID => 1, AddressBookPeer::GENDER => 2, AddressBookPeer::FIRST_NAME => 3, AddressBookPeer::LAST_NAME => 4, AddressBookPeer::COMPANY => 5, AddressBookPeer::COUNTRY_ID => 6, AddressBookPeer::STATE_ID => 7, AddressBookPeer::STATE_TITLE => 8, AddressBookPeer::CITY => 9, AddressBookPeer::STREET => 10, AddressBookPeer::POSTCODE => 11, AddressBookPeer::IS_DEFAULT => 12, AddressBookPeer::CREATED_AT => 13, AddressBookPeer::UPDATED_AT => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'member_id' => 1, 'gender' => 2, 'first_name' => 3, 'last_name' => 4, 'company' => 5, 'country_id' => 6, 'state_id' => 7, 'state_title' => 8, 'city' => 9, 'street' => 10, 'postcode' => 11, 'is_default' => 12, 'created_at' => 13, 'updated_at' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsAddressBookPlugin.lib.model.map.AddressBookMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AddressBookPeer::getTableMap();
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
		return str_replace(AddressBookPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AddressBookPeer::ID);

		$criteria->addSelectColumn(AddressBookPeer::MEMBER_ID);

		$criteria->addSelectColumn(AddressBookPeer::GENDER);

		$criteria->addSelectColumn(AddressBookPeer::FIRST_NAME);

		$criteria->addSelectColumn(AddressBookPeer::LAST_NAME);

		$criteria->addSelectColumn(AddressBookPeer::COMPANY);

		$criteria->addSelectColumn(AddressBookPeer::COUNTRY_ID);

		$criteria->addSelectColumn(AddressBookPeer::STATE_ID);

		$criteria->addSelectColumn(AddressBookPeer::STATE_TITLE);

		$criteria->addSelectColumn(AddressBookPeer::CITY);

		$criteria->addSelectColumn(AddressBookPeer::STREET);

		$criteria->addSelectColumn(AddressBookPeer::POSTCODE);

		$criteria->addSelectColumn(AddressBookPeer::IS_DEFAULT);

		$criteria->addSelectColumn(AddressBookPeer::CREATED_AT);

		$criteria->addSelectColumn(AddressBookPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(address_book.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT address_book.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AddressBookPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AddressBookPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AddressBookPeer::doSelectRS($criteria, $con);
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
		$objects = AddressBookPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AddressBookPeer::populateObjects(AddressBookPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AddressBookPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AddressBookPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinMember(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AddressBookPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AddressBookPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AddressBookPeer::MEMBER_ID, MemberPeer::ID);

		$rs = AddressBookPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinCountry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AddressBookPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AddressBookPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AddressBookPeer::COUNTRY_ID, CountryPeer::ID);

		$rs = AddressBookPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinState(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AddressBookPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AddressBookPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AddressBookPeer::STATE_ID, StatePeer::ID);

		$rs = AddressBookPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinMember(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AddressBookPeer::addSelectColumns($c);
		$startcol = (AddressBookPeer::NUM_COLUMNS - AddressBookPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MemberPeer::addSelectColumns($c);

		$c->addJoin(AddressBookPeer::MEMBER_ID, MemberPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AddressBookPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MemberPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getMember(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addAddressBook($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAddressBooks();
				$obj2->addAddressBook($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinCountry(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AddressBookPeer::addSelectColumns($c);
		$startcol = (AddressBookPeer::NUM_COLUMNS - AddressBookPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CountryPeer::addSelectColumns($c);

		$c->addJoin(AddressBookPeer::COUNTRY_ID, CountryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AddressBookPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CountryPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCountry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addAddressBook($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAddressBooks();
				$obj2->addAddressBook($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinState(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AddressBookPeer::addSelectColumns($c);
		$startcol = (AddressBookPeer::NUM_COLUMNS - AddressBookPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatePeer::addSelectColumns($c);

		$c->addJoin(AddressBookPeer::STATE_ID, StatePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AddressBookPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = StatePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getState(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addAddressBook($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAddressBooks();
				$obj2->addAddressBook($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AddressBookPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AddressBookPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AddressBookPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(AddressBookPeer::COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(AddressBookPeer::STATE_ID, StatePeer::ID);

		$rs = AddressBookPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AddressBookPeer::addSelectColumns($c);
		$startcol2 = (AddressBookPeer::NUM_COLUMNS - AddressBookPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatePeer::NUM_COLUMNS;

		$c->addJoin(AddressBookPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(AddressBookPeer::COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(AddressBookPeer::STATE_ID, StatePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AddressBookPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = MemberPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMember(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAddressBook($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initAddressBooks();
				$obj2->addAddressBook($obj1);
			}


					
			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCountry(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addAddressBook($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initAddressBooks();
				$obj3->addAddressBook($obj1);
			}


					
			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getState(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addAddressBook($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initAddressBooks();
				$obj4->addAddressBook($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptMember(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AddressBookPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AddressBookPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AddressBookPeer::COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(AddressBookPeer::STATE_ID, StatePeer::ID);

		$rs = AddressBookPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptCountry(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AddressBookPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AddressBookPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AddressBookPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(AddressBookPeer::STATE_ID, StatePeer::ID);

		$rs = AddressBookPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptState(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AddressBookPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AddressBookPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AddressBookPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(AddressBookPeer::COUNTRY_ID, CountryPeer::ID);

		$rs = AddressBookPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptMember(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AddressBookPeer::addSelectColumns($c);
		$startcol2 = (AddressBookPeer::NUM_COLUMNS - AddressBookPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CountryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatePeer::NUM_COLUMNS;

		$c->addJoin(AddressBookPeer::COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(AddressBookPeer::STATE_ID, StatePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AddressBookPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCountry(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAddressBook($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initAddressBooks();
				$obj2->addAddressBook($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getState(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addAddressBook($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initAddressBooks();
				$obj3->addAddressBook($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptCountry(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AddressBookPeer::addSelectColumns($c);
		$startcol2 = (AddressBookPeer::NUM_COLUMNS - AddressBookPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatePeer::NUM_COLUMNS;

		$c->addJoin(AddressBookPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(AddressBookPeer::STATE_ID, StatePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AddressBookPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MemberPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMember(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAddressBook($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initAddressBooks();
				$obj2->addAddressBook($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getState(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addAddressBook($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initAddressBooks();
				$obj3->addAddressBook($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptState(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AddressBookPeer::addSelectColumns($c);
		$startcol2 = (AddressBookPeer::NUM_COLUMNS - AddressBookPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CountryPeer::NUM_COLUMNS;

		$c->addJoin(AddressBookPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(AddressBookPeer::COUNTRY_ID, CountryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AddressBookPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MemberPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMember(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAddressBook($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initAddressBooks();
				$obj2->addAddressBook($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCountry(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addAddressBook($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initAddressBooks();
				$obj3->addAddressBook($obj1);
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
		return AddressBookPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAddressBookPeer', $values, $con);
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

		$criteria->remove(AddressBookPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseAddressBookPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAddressBookPeer', $values, $con);
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
			$comparison = $criteria->getComparison(AddressBookPeer::ID);
			$selectCriteria->add(AddressBookPeer::ID, $criteria->remove(AddressBookPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAddressBookPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAddressBookPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(AddressBookPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AddressBookPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof AddressBook) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AddressBookPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(AddressBook $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AddressBookPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AddressBookPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AddressBookPeer::DATABASE_NAME, AddressBookPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AddressBookPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(AddressBookPeer::DATABASE_NAME);

		$criteria->add(AddressBookPeer::ID, $pk);


		$v = AddressBookPeer::doSelect($criteria, $con);

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
			$criteria->add(AddressBookPeer::ID, $pks, Criteria::IN);
			$objs = AddressBookPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAddressBookPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsAddressBookPlugin.lib.model.map.AddressBookMapBuilder');
}
