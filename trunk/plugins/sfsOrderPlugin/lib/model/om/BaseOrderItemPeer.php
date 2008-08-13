<?php


abstract class BaseOrderItemPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'order_item';

	
	const CLASS_DEFAULT = 'plugins.sfsOrderPlugin.lib.model.OrderItem';

	
	const NUM_COLUMNS = 32;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'order_item.ID';

	
	const UUID = 'order_item.UUID';

	
	const MEMBER_ID = 'order_item.MEMBER_ID';

	
	const MEMBER_FIRST_NAME = 'order_item.MEMBER_FIRST_NAME';

	
	const MEMBER_LAST_NAME = 'order_item.MEMBER_LAST_NAME';

	
	const MEMBER_COUNTRY_ID = 'order_item.MEMBER_COUNTRY_ID';

	
	const MEMBER_STATE_ID = 'order_item.MEMBER_STATE_ID';

	
	const MEMBER_STATE_TITLE = 'order_item.MEMBER_STATE_TITLE';

	
	const MEMBER_CITY = 'order_item.MEMBER_CITY';

	
	const MEMBER_STREET = 'order_item.MEMBER_STREET';

	
	const MEMBER_POSTCODE = 'order_item.MEMBER_POSTCODE';

	
	const BILLING_FIRST_NAME = 'order_item.BILLING_FIRST_NAME';

	
	const BILLING_LAST_NAME = 'order_item.BILLING_LAST_NAME';

	
	const BILLING_COUNTRY_ID = 'order_item.BILLING_COUNTRY_ID';

	
	const BILLING_STATE_ID = 'order_item.BILLING_STATE_ID';

	
	const BILLING_STATE_TITLE = 'order_item.BILLING_STATE_TITLE';

	
	const BILLING_CITY = 'order_item.BILLING_CITY';

	
	const BILLING_STREET = 'order_item.BILLING_STREET';

	
	const BILLING_POSTCODE = 'order_item.BILLING_POSTCODE';

	
	const DELIVERY_FIRST_NAME = 'order_item.DELIVERY_FIRST_NAME';

	
	const DELIVERY_LAST_NAME = 'order_item.DELIVERY_LAST_NAME';

	
	const DELIVERY_COUNTRY_ID = 'order_item.DELIVERY_COUNTRY_ID';

	
	const DELIVERY_STATE_ID = 'order_item.DELIVERY_STATE_ID';

	
	const DELIVERY_STATE_TITLE = 'order_item.DELIVERY_STATE_TITLE';

	
	const DELIVERY_CITY = 'order_item.DELIVERY_CITY';

	
	const DELIVERY_STREET = 'order_item.DELIVERY_STREET';

	
	const DELIVERY_POSTCODE = 'order_item.DELIVERY_POSTCODE';

	
	const DELIVERY_COST = 'order_item.DELIVERY_COST';

	
	const DELIVERY_DESCRIPTION = 'order_item.DELIVERY_DESCRIPTION';

	
	const STATUS_ID = 'order_item.STATUS_ID';

	
	const CREATED_AT = 'order_item.CREATED_AT';

	
	const UPDATED_AT = 'order_item.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Uuid', 'MemberId', 'MemberFirstName', 'MemberLastName', 'MemberCountryId', 'MemberStateId', 'MemberStateTitle', 'MemberCity', 'MemberStreet', 'MemberPostcode', 'BillingFirstName', 'BillingLastName', 'BillingCountryId', 'BillingStateId', 'BillingStateTitle', 'BillingCity', 'BillingStreet', 'BillingPostcode', 'DeliveryFirstName', 'DeliveryLastName', 'DeliveryCountryId', 'DeliveryStateId', 'DeliveryStateTitle', 'DeliveryCity', 'DeliveryStreet', 'DeliveryPostcode', 'DeliveryCost', 'DeliveryDescription', 'StatusId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (OrderItemPeer::ID, OrderItemPeer::UUID, OrderItemPeer::MEMBER_ID, OrderItemPeer::MEMBER_FIRST_NAME, OrderItemPeer::MEMBER_LAST_NAME, OrderItemPeer::MEMBER_COUNTRY_ID, OrderItemPeer::MEMBER_STATE_ID, OrderItemPeer::MEMBER_STATE_TITLE, OrderItemPeer::MEMBER_CITY, OrderItemPeer::MEMBER_STREET, OrderItemPeer::MEMBER_POSTCODE, OrderItemPeer::BILLING_FIRST_NAME, OrderItemPeer::BILLING_LAST_NAME, OrderItemPeer::BILLING_COUNTRY_ID, OrderItemPeer::BILLING_STATE_ID, OrderItemPeer::BILLING_STATE_TITLE, OrderItemPeer::BILLING_CITY, OrderItemPeer::BILLING_STREET, OrderItemPeer::BILLING_POSTCODE, OrderItemPeer::DELIVERY_FIRST_NAME, OrderItemPeer::DELIVERY_LAST_NAME, OrderItemPeer::DELIVERY_COUNTRY_ID, OrderItemPeer::DELIVERY_STATE_ID, OrderItemPeer::DELIVERY_STATE_TITLE, OrderItemPeer::DELIVERY_CITY, OrderItemPeer::DELIVERY_STREET, OrderItemPeer::DELIVERY_POSTCODE, OrderItemPeer::DELIVERY_COST, OrderItemPeer::DELIVERY_DESCRIPTION, OrderItemPeer::STATUS_ID, OrderItemPeer::CREATED_AT, OrderItemPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'uuid', 'member_id', 'member_first_name', 'member_last_name', 'member_country_id', 'member_state_id', 'member_state_title', 'member_city', 'member_street', 'member_postcode', 'billing_first_name', 'billing_last_name', 'billing_country_id', 'billing_state_id', 'billing_state_title', 'billing_city', 'billing_street', 'billing_postcode', 'delivery_first_name', 'delivery_last_name', 'delivery_country_id', 'delivery_state_id', 'delivery_state_title', 'delivery_city', 'delivery_street', 'delivery_postcode', 'delivery_cost', 'delivery_description', 'status_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Uuid' => 1, 'MemberId' => 2, 'MemberFirstName' => 3, 'MemberLastName' => 4, 'MemberCountryId' => 5, 'MemberStateId' => 6, 'MemberStateTitle' => 7, 'MemberCity' => 8, 'MemberStreet' => 9, 'MemberPostcode' => 10, 'BillingFirstName' => 11, 'BillingLastName' => 12, 'BillingCountryId' => 13, 'BillingStateId' => 14, 'BillingStateTitle' => 15, 'BillingCity' => 16, 'BillingStreet' => 17, 'BillingPostcode' => 18, 'DeliveryFirstName' => 19, 'DeliveryLastName' => 20, 'DeliveryCountryId' => 21, 'DeliveryStateId' => 22, 'DeliveryStateTitle' => 23, 'DeliveryCity' => 24, 'DeliveryStreet' => 25, 'DeliveryPostcode' => 26, 'DeliveryCost' => 27, 'DeliveryDescription' => 28, 'StatusId' => 29, 'CreatedAt' => 30, 'UpdatedAt' => 31, ),
		BasePeer::TYPE_COLNAME => array (OrderItemPeer::ID => 0, OrderItemPeer::UUID => 1, OrderItemPeer::MEMBER_ID => 2, OrderItemPeer::MEMBER_FIRST_NAME => 3, OrderItemPeer::MEMBER_LAST_NAME => 4, OrderItemPeer::MEMBER_COUNTRY_ID => 5, OrderItemPeer::MEMBER_STATE_ID => 6, OrderItemPeer::MEMBER_STATE_TITLE => 7, OrderItemPeer::MEMBER_CITY => 8, OrderItemPeer::MEMBER_STREET => 9, OrderItemPeer::MEMBER_POSTCODE => 10, OrderItemPeer::BILLING_FIRST_NAME => 11, OrderItemPeer::BILLING_LAST_NAME => 12, OrderItemPeer::BILLING_COUNTRY_ID => 13, OrderItemPeer::BILLING_STATE_ID => 14, OrderItemPeer::BILLING_STATE_TITLE => 15, OrderItemPeer::BILLING_CITY => 16, OrderItemPeer::BILLING_STREET => 17, OrderItemPeer::BILLING_POSTCODE => 18, OrderItemPeer::DELIVERY_FIRST_NAME => 19, OrderItemPeer::DELIVERY_LAST_NAME => 20, OrderItemPeer::DELIVERY_COUNTRY_ID => 21, OrderItemPeer::DELIVERY_STATE_ID => 22, OrderItemPeer::DELIVERY_STATE_TITLE => 23, OrderItemPeer::DELIVERY_CITY => 24, OrderItemPeer::DELIVERY_STREET => 25, OrderItemPeer::DELIVERY_POSTCODE => 26, OrderItemPeer::DELIVERY_COST => 27, OrderItemPeer::DELIVERY_DESCRIPTION => 28, OrderItemPeer::STATUS_ID => 29, OrderItemPeer::CREATED_AT => 30, OrderItemPeer::UPDATED_AT => 31, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'uuid' => 1, 'member_id' => 2, 'member_first_name' => 3, 'member_last_name' => 4, 'member_country_id' => 5, 'member_state_id' => 6, 'member_state_title' => 7, 'member_city' => 8, 'member_street' => 9, 'member_postcode' => 10, 'billing_first_name' => 11, 'billing_last_name' => 12, 'billing_country_id' => 13, 'billing_state_id' => 14, 'billing_state_title' => 15, 'billing_city' => 16, 'billing_street' => 17, 'billing_postcode' => 18, 'delivery_first_name' => 19, 'delivery_last_name' => 20, 'delivery_country_id' => 21, 'delivery_state_id' => 22, 'delivery_state_title' => 23, 'delivery_city' => 24, 'delivery_street' => 25, 'delivery_postcode' => 26, 'delivery_cost' => 27, 'delivery_description' => 28, 'status_id' => 29, 'created_at' => 30, 'updated_at' => 31, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsOrderPlugin.lib.model.map.OrderItemMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OrderItemPeer::getTableMap();
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
		return str_replace(OrderItemPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OrderItemPeer::ID);

		$criteria->addSelectColumn(OrderItemPeer::UUID);

		$criteria->addSelectColumn(OrderItemPeer::MEMBER_ID);

		$criteria->addSelectColumn(OrderItemPeer::MEMBER_FIRST_NAME);

		$criteria->addSelectColumn(OrderItemPeer::MEMBER_LAST_NAME);

		$criteria->addSelectColumn(OrderItemPeer::MEMBER_COUNTRY_ID);

		$criteria->addSelectColumn(OrderItemPeer::MEMBER_STATE_ID);

		$criteria->addSelectColumn(OrderItemPeer::MEMBER_STATE_TITLE);

		$criteria->addSelectColumn(OrderItemPeer::MEMBER_CITY);

		$criteria->addSelectColumn(OrderItemPeer::MEMBER_STREET);

		$criteria->addSelectColumn(OrderItemPeer::MEMBER_POSTCODE);

		$criteria->addSelectColumn(OrderItemPeer::BILLING_FIRST_NAME);

		$criteria->addSelectColumn(OrderItemPeer::BILLING_LAST_NAME);

		$criteria->addSelectColumn(OrderItemPeer::BILLING_COUNTRY_ID);

		$criteria->addSelectColumn(OrderItemPeer::BILLING_STATE_ID);

		$criteria->addSelectColumn(OrderItemPeer::BILLING_STATE_TITLE);

		$criteria->addSelectColumn(OrderItemPeer::BILLING_CITY);

		$criteria->addSelectColumn(OrderItemPeer::BILLING_STREET);

		$criteria->addSelectColumn(OrderItemPeer::BILLING_POSTCODE);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_FIRST_NAME);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_LAST_NAME);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_COUNTRY_ID);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_STATE_ID);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_STATE_TITLE);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_CITY);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_STREET);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_POSTCODE);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_COST);

		$criteria->addSelectColumn(OrderItemPeer::DELIVERY_DESCRIPTION);

		$criteria->addSelectColumn(OrderItemPeer::STATUS_ID);

		$criteria->addSelectColumn(OrderItemPeer::CREATED_AT);

		$criteria->addSelectColumn(OrderItemPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(order_item.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT order_item.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
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
		$objects = OrderItemPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OrderItemPeer::populateObjects(OrderItemPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OrderItemPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OrderItemPeer::getOMClass();
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
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinCountryRelatedByMemberCountryId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinStateRelatedByMemberStateId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinCountryRelatedByBillingCountryId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinStateRelatedByBillingStateId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinCountryRelatedByDeliveryCountryId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinStateRelatedByDeliveryStateId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOrderStatus(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinMember(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MemberPeer::addSelectColumns($c);

		$c->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

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
										$temp_obj2->addOrderItem($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinCountryRelatedByMemberCountryId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CountryPeer::addSelectColumns($c);

		$c->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CountryPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCountryRelatedByMemberCountryId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderItemRelatedByMemberCountryId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderItemsRelatedByMemberCountryId();
				$obj2->addOrderItemRelatedByMemberCountryId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinStateRelatedByMemberStateId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatePeer::addSelectColumns($c);

		$c->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = StatePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getStateRelatedByMemberStateId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderItemRelatedByMemberStateId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderItemsRelatedByMemberStateId();
				$obj2->addOrderItemRelatedByMemberStateId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinCountryRelatedByBillingCountryId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CountryPeer::addSelectColumns($c);

		$c->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CountryPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCountryRelatedByBillingCountryId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderItemRelatedByBillingCountryId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderItemsRelatedByBillingCountryId();
				$obj2->addOrderItemRelatedByBillingCountryId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinStateRelatedByBillingStateId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatePeer::addSelectColumns($c);

		$c->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = StatePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getStateRelatedByBillingStateId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderItemRelatedByBillingStateId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderItemsRelatedByBillingStateId();
				$obj2->addOrderItemRelatedByBillingStateId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinCountryRelatedByDeliveryCountryId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CountryPeer::addSelectColumns($c);

		$c->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CountryPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCountryRelatedByDeliveryCountryId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderItemRelatedByDeliveryCountryId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderItemsRelatedByDeliveryCountryId();
				$obj2->addOrderItemRelatedByDeliveryCountryId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinStateRelatedByDeliveryStateId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatePeer::addSelectColumns($c);

		$c->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = StatePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getStateRelatedByDeliveryStateId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderItemRelatedByDeliveryStateId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderItemsRelatedByDeliveryStateId();
				$obj2->addOrderItemRelatedByDeliveryStateId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOrderStatus(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OrderStatusPeer::addSelectColumns($c);

		$c->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OrderStatusPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOrderStatus(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderItem($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol2 = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatePeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatePeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol9 = $startcol8 + StatePeer::NUM_COLUMNS;

		OrderStatusPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + OrderStatusPeer::NUM_COLUMNS;

		$c->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();


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
					$temp_obj2->addOrderItem($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1);
			}


					
			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCountryRelatedByMemberCountryId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderItemRelatedByMemberCountryId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderItemsRelatedByMemberCountryId();
				$obj3->addOrderItemRelatedByMemberCountryId($obj1);
			}


					
			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStateRelatedByMemberStateId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOrderItemRelatedByMemberStateId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOrderItemsRelatedByMemberStateId();
				$obj4->addOrderItemRelatedByMemberStateId($obj1);
			}


					
			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCountryRelatedByBillingCountryId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOrderItemRelatedByBillingCountryId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initOrderItemsRelatedByBillingCountryId();
				$obj5->addOrderItemRelatedByBillingCountryId($obj1);
			}


					
			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStateRelatedByBillingStateId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOrderItemRelatedByBillingStateId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initOrderItemsRelatedByBillingStateId();
				$obj6->addOrderItemRelatedByBillingStateId($obj1);
			}


					
			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getCountryRelatedByDeliveryCountryId(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOrderItemRelatedByDeliveryCountryId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj7->initOrderItemsRelatedByDeliveryCountryId();
				$obj7->addOrderItemRelatedByDeliveryCountryId($obj1);
			}


					
			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj8 = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getStateRelatedByDeliveryStateId(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOrderItemRelatedByDeliveryStateId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj8->initOrderItemsRelatedByDeliveryStateId();
				$obj8->addOrderItemRelatedByDeliveryStateId($obj1);
			}


					
			$omClass = OrderStatusPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj9 = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getOrderStatus(); 				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addOrderItem($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj9->initOrderItems();
				$obj9->addOrderItem($obj1);
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
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptCountryRelatedByMemberCountryId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptStateRelatedByMemberStateId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptCountryRelatedByBillingCountryId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptStateRelatedByBillingStateId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptCountryRelatedByDeliveryCountryId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptStateRelatedByDeliveryStateId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOrderStatus(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$criteria->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$rs = OrderItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptMember(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol2 = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CountryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatePeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatePeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatePeer::NUM_COLUMNS;

		OrderStatusPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OrderStatusPeer::NUM_COLUMNS;

		$c->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getCountryRelatedByMemberCountryId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOrderItemRelatedByMemberCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderItemsRelatedByMemberCountryId();
				$obj2->addOrderItemRelatedByMemberCountryId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStateRelatedByMemberStateId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderItemRelatedByMemberStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderItemsRelatedByMemberStateId();
				$obj3->addOrderItemRelatedByMemberStateId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCountryRelatedByBillingCountryId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOrderItemRelatedByBillingCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOrderItemsRelatedByBillingCountryId();
				$obj4->addOrderItemRelatedByBillingCountryId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getStateRelatedByBillingStateId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOrderItemRelatedByBillingStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOrderItemsRelatedByBillingStateId();
				$obj5->addOrderItemRelatedByBillingStateId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getCountryRelatedByDeliveryCountryId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOrderItemRelatedByDeliveryCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOrderItemsRelatedByDeliveryCountryId();
				$obj6->addOrderItemRelatedByDeliveryCountryId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getStateRelatedByDeliveryStateId(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOrderItemRelatedByDeliveryStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOrderItemsRelatedByDeliveryStateId();
				$obj7->addOrderItemRelatedByDeliveryStateId($obj1);
			}

			$omClass = OrderStatusPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOrderStatus(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOrderItems();
				$obj8->addOrderItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptCountryRelatedByMemberCountryId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol2 = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatePeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatePeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatePeer::NUM_COLUMNS;

		OrderStatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OrderStatusPeer::NUM_COLUMNS;

		$c->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

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
					$temp_obj2->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStateRelatedByMemberStateId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderItemRelatedByMemberStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderItemsRelatedByMemberStateId();
				$obj3->addOrderItemRelatedByMemberStateId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStateRelatedByBillingStateId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOrderItemRelatedByBillingStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOrderItemsRelatedByBillingStateId();
				$obj4->addOrderItemRelatedByBillingStateId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getStateRelatedByDeliveryStateId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOrderItemRelatedByDeliveryStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOrderItemsRelatedByDeliveryStateId();
				$obj5->addOrderItemRelatedByDeliveryStateId($obj1);
			}

			$omClass = OrderStatusPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOrderStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOrderItems();
				$obj6->addOrderItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptStateRelatedByMemberStateId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol2 = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CountryPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CountryPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CountryPeer::NUM_COLUMNS;

		OrderStatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OrderStatusPeer::NUM_COLUMNS;

		$c->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

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
					$temp_obj2->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCountryRelatedByMemberCountryId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderItemRelatedByMemberCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderItemsRelatedByMemberCountryId();
				$obj3->addOrderItemRelatedByMemberCountryId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCountryRelatedByBillingCountryId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOrderItemRelatedByBillingCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOrderItemsRelatedByBillingCountryId();
				$obj4->addOrderItemRelatedByBillingCountryId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCountryRelatedByDeliveryCountryId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOrderItemRelatedByDeliveryCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOrderItemsRelatedByDeliveryCountryId();
				$obj5->addOrderItemRelatedByDeliveryCountryId($obj1);
			}

			$omClass = OrderStatusPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOrderStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOrderItems();
				$obj6->addOrderItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptCountryRelatedByBillingCountryId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol2 = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatePeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatePeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatePeer::NUM_COLUMNS;

		OrderStatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OrderStatusPeer::NUM_COLUMNS;

		$c->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

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
					$temp_obj2->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStateRelatedByMemberStateId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderItemRelatedByMemberStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderItemsRelatedByMemberStateId();
				$obj3->addOrderItemRelatedByMemberStateId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStateRelatedByBillingStateId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOrderItemRelatedByBillingStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOrderItemsRelatedByBillingStateId();
				$obj4->addOrderItemRelatedByBillingStateId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getStateRelatedByDeliveryStateId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOrderItemRelatedByDeliveryStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOrderItemsRelatedByDeliveryStateId();
				$obj5->addOrderItemRelatedByDeliveryStateId($obj1);
			}

			$omClass = OrderStatusPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOrderStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOrderItems();
				$obj6->addOrderItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptStateRelatedByBillingStateId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol2 = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CountryPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CountryPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CountryPeer::NUM_COLUMNS;

		OrderStatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OrderStatusPeer::NUM_COLUMNS;

		$c->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

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
					$temp_obj2->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCountryRelatedByMemberCountryId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderItemRelatedByMemberCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderItemsRelatedByMemberCountryId();
				$obj3->addOrderItemRelatedByMemberCountryId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCountryRelatedByBillingCountryId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOrderItemRelatedByBillingCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOrderItemsRelatedByBillingCountryId();
				$obj4->addOrderItemRelatedByBillingCountryId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCountryRelatedByDeliveryCountryId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOrderItemRelatedByDeliveryCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOrderItemsRelatedByDeliveryCountryId();
				$obj5->addOrderItemRelatedByDeliveryCountryId($obj1);
			}

			$omClass = OrderStatusPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOrderStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOrderItems();
				$obj6->addOrderItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptCountryRelatedByDeliveryCountryId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol2 = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatePeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatePeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatePeer::NUM_COLUMNS;

		OrderStatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OrderStatusPeer::NUM_COLUMNS;

		$c->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

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
					$temp_obj2->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStateRelatedByMemberStateId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderItemRelatedByMemberStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderItemsRelatedByMemberStateId();
				$obj3->addOrderItemRelatedByMemberStateId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStateRelatedByBillingStateId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOrderItemRelatedByBillingStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOrderItemsRelatedByBillingStateId();
				$obj4->addOrderItemRelatedByBillingStateId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getStateRelatedByDeliveryStateId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOrderItemRelatedByDeliveryStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOrderItemsRelatedByDeliveryStateId();
				$obj5->addOrderItemRelatedByDeliveryStateId($obj1);
			}

			$omClass = OrderStatusPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOrderStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOrderItems();
				$obj6->addOrderItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptStateRelatedByDeliveryStateId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol2 = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CountryPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CountryPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CountryPeer::NUM_COLUMNS;

		OrderStatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OrderStatusPeer::NUM_COLUMNS;

		$c->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::STATUS_ID, OrderStatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

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
					$temp_obj2->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCountryRelatedByMemberCountryId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderItemRelatedByMemberCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderItemsRelatedByMemberCountryId();
				$obj3->addOrderItemRelatedByMemberCountryId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCountryRelatedByBillingCountryId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOrderItemRelatedByBillingCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOrderItemsRelatedByBillingCountryId();
				$obj4->addOrderItemRelatedByBillingCountryId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCountryRelatedByDeliveryCountryId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOrderItemRelatedByDeliveryCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOrderItemsRelatedByDeliveryCountryId();
				$obj5->addOrderItemRelatedByDeliveryCountryId($obj1);
			}

			$omClass = OrderStatusPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOrderStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOrderItems();
				$obj6->addOrderItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOrderStatus(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderItemPeer::addSelectColumns($c);
		$startcol2 = (OrderItemPeer::NUM_COLUMNS - OrderItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MemberPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MemberPeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatePeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatePeer::NUM_COLUMNS;

		CountryPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + CountryPeer::NUM_COLUMNS;

		StatePeer::addSelectColumns($c);
		$startcol9 = $startcol8 + StatePeer::NUM_COLUMNS;

		$c->addJoin(OrderItemPeer::MEMBER_ID, MemberPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::MEMBER_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::BILLING_STATE_ID, StatePeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_COUNTRY_ID, CountryPeer::ID);

		$c->addJoin(OrderItemPeer::DELIVERY_STATE_ID, StatePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderItemPeer::getOMClass();

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
					$temp_obj2->addOrderItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderItems();
				$obj2->addOrderItem($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCountryRelatedByMemberCountryId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderItemRelatedByMemberCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderItemsRelatedByMemberCountryId();
				$obj3->addOrderItemRelatedByMemberCountryId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStateRelatedByMemberStateId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOrderItemRelatedByMemberStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOrderItemsRelatedByMemberStateId();
				$obj4->addOrderItemRelatedByMemberStateId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCountryRelatedByBillingCountryId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOrderItemRelatedByBillingCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOrderItemsRelatedByBillingCountryId();
				$obj5->addOrderItemRelatedByBillingCountryId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStateRelatedByBillingStateId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOrderItemRelatedByBillingStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOrderItemsRelatedByBillingStateId();
				$obj6->addOrderItemRelatedByBillingStateId($obj1);
			}

			$omClass = CountryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getCountryRelatedByDeliveryCountryId(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOrderItemRelatedByDeliveryCountryId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOrderItemsRelatedByDeliveryCountryId();
				$obj7->addOrderItemRelatedByDeliveryCountryId($obj1);
			}

			$omClass = StatePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getStateRelatedByDeliveryStateId(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOrderItemRelatedByDeliveryStateId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOrderItemsRelatedByDeliveryStateId();
				$obj8->addOrderItemRelatedByDeliveryStateId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array(array('uuid'));
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return OrderItemPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOrderItemPeer', $values, $con);
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

		$criteria->remove(OrderItemPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseOrderItemPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOrderItemPeer', $values, $con);
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
			$comparison = $criteria->getComparison(OrderItemPeer::ID);
			$selectCriteria->add(OrderItemPeer::ID, $criteria->remove(OrderItemPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseOrderItemPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseOrderItemPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(OrderItemPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OrderItemPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OrderItem) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OrderItemPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OrderItem $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OrderItemPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OrderItemPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OrderItemPeer::DATABASE_NAME, OrderItemPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OrderItemPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OrderItemPeer::DATABASE_NAME);

		$criteria->add(OrderItemPeer::ID, $pk);


		$v = OrderItemPeer::doSelect($criteria, $con);

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
			$criteria->add(OrderItemPeer::ID, $pks, Criteria::IN);
			$objs = OrderItemPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOrderItemPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsOrderPlugin.lib.model.map.OrderItemMapBuilder');
}
