<?php


abstract class BaseOrderProduct2OptionProductPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'order_product2option_product';

	
	const CLASS_DEFAULT = 'plugins.sfsOrderPlugin.lib.model.OrderProduct2OptionProduct';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ORDER_PRODUCT_ID = 'order_product2option_product.ORDER_PRODUCT_ID';

	
	const OPTION_PRODUCT_ID = 'order_product2option_product.OPTION_PRODUCT_ID';

	
	const CREATED_AT = 'order_product2option_product.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('OrderProductId', 'OptionProductId', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, OrderProduct2OptionProductPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('order_product_id', 'option_product_id', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('OrderProductId' => 0, 'OptionProductId' => 1, 'CreatedAt' => 2, ),
		BasePeer::TYPE_COLNAME => array (OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID => 0, OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID => 1, OrderProduct2OptionProductPeer::CREATED_AT => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('order_product_id' => 0, 'option_product_id' => 1, 'created_at' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsOrderPlugin.lib.model.map.OrderProduct2OptionProductMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OrderProduct2OptionProductPeer::getTableMap();
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
		return str_replace(OrderProduct2OptionProductPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID);

		$criteria->addSelectColumn(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID);

		$criteria->addSelectColumn(OrderProduct2OptionProductPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(order_product2option_product.ORDER_PRODUCT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT order_product2option_product.ORDER_PRODUCT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OrderProduct2OptionProductPeer::doSelectRS($criteria, $con);
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
		$objects = OrderProduct2OptionProductPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OrderProduct2OptionProductPeer::populateObjects(OrderProduct2OptionProductPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OrderProduct2OptionProductPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OrderProduct2OptionProductPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOrderProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, OrderProductPeer::ID);

		$rs = OrderProduct2OptionProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOptionProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, OptionProductPeer::ID);

		$rs = OrderProduct2OptionProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOrderProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProduct2OptionProductPeer::addSelectColumns($c);
		$startcol = (OrderProduct2OptionProductPeer::NUM_COLUMNS - OrderProduct2OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OrderProductPeer::addSelectColumns($c);

		$c->addJoin(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, OrderProductPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProduct2OptionProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OrderProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOrderProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderProduct2OptionProduct($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderProduct2OptionProducts();
				$obj2->addOrderProduct2OptionProduct($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOptionProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProduct2OptionProductPeer::addSelectColumns($c);
		$startcol = (OrderProduct2OptionProductPeer::NUM_COLUMNS - OrderProduct2OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OptionProductPeer::addSelectColumns($c);

		$c->addJoin(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, OptionProductPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProduct2OptionProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OptionProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOptionProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderProduct2OptionProduct($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderProduct2OptionProducts();
				$obj2->addOrderProduct2OptionProduct($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, OrderProductPeer::ID);

		$criteria->addJoin(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, OptionProductPeer::ID);

		$rs = OrderProduct2OptionProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProduct2OptionProductPeer::addSelectColumns($c);
		$startcol2 = (OrderProduct2OptionProductPeer::NUM_COLUMNS - OrderProduct2OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OrderProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OrderProductPeer::NUM_COLUMNS;

		OptionProductPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OptionProductPeer::NUM_COLUMNS;

		$c->addJoin(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, OrderProductPeer::ID);

		$c->addJoin(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, OptionProductPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProduct2OptionProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OrderProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOrderProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOrderProduct2OptionProduct($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderProduct2OptionProducts();
				$obj2->addOrderProduct2OptionProduct($obj1);
			}


					
			$omClass = OptionProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOptionProduct(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderProduct2OptionProduct($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderProduct2OptionProducts();
				$obj3->addOrderProduct2OptionProduct($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOrderProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, OptionProductPeer::ID);

		$rs = OrderProduct2OptionProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOptionProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProduct2OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, OrderProductPeer::ID);

		$rs = OrderProduct2OptionProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOrderProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProduct2OptionProductPeer::addSelectColumns($c);
		$startcol2 = (OrderProduct2OptionProductPeer::NUM_COLUMNS - OrderProduct2OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OptionProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OptionProductPeer::NUM_COLUMNS;

		$c->addJoin(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, OptionProductPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProduct2OptionProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OptionProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOptionProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOrderProduct2OptionProduct($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderProduct2OptionProducts();
				$obj2->addOrderProduct2OptionProduct($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOptionProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProduct2OptionProductPeer::addSelectColumns($c);
		$startcol2 = (OrderProduct2OptionProductPeer::NUM_COLUMNS - OrderProduct2OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OrderProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OrderProductPeer::NUM_COLUMNS;

		$c->addJoin(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, OrderProductPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProduct2OptionProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OrderProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOrderProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOrderProduct2OptionProduct($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderProduct2OptionProducts();
				$obj2->addOrderProduct2OptionProduct($obj1);
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
		return OrderProduct2OptionProductPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $values, $con);
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

		
    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $values, $con);
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
			$comparison = $criteria->getComparison(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID);
			$selectCriteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $criteria->remove(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID), $comparison);

			$comparison = $criteria->getComparison(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID);
			$selectCriteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $criteria->remove(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseOrderProduct2OptionProductPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseOrderProduct2OptionProductPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(OrderProduct2OptionProductPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OrderProduct2OptionProductPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OrderProduct2OptionProduct) {

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

			$criteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $vals[0], Criteria::IN);
			$criteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(OrderProduct2OptionProduct $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OrderProduct2OptionProductPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OrderProduct2OptionProductPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OrderProduct2OptionProductPeer::DATABASE_NAME, OrderProduct2OptionProductPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OrderProduct2OptionProductPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $order_product_id, $option_product_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(OrderProduct2OptionProductPeer::ORDER_PRODUCT_ID, $order_product_id);
		$criteria->add(OrderProduct2OptionProductPeer::OPTION_PRODUCT_ID, $option_product_id);
		$v = OrderProduct2OptionProductPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
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
		BaseOrderProduct2OptionProductPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsOrderPlugin.lib.model.map.OrderProduct2OptionProductMapBuilder');
}
