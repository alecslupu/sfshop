<?php


abstract class BaseOrderProductPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'order_product';

	
	const CLASS_DEFAULT = 'plugins.sfsOrderPlugin.lib.model.OrderProduct';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'order_product.ID';

	
	const ORDER_ITEM_ID = 'order_product.ORDER_ITEM_ID';

	
	const PRODUCT_ID = 'order_product.PRODUCT_ID';

	
	const PRICE = 'order_product.PRICE';

	
	const QUANTITY = 'order_product.QUANTITY';

	
	const CREATED_AT = 'order_product.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'OrderItemId', 'ProductId', 'Price', 'Quantity', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (OrderProductPeer::ID, OrderProductPeer::ORDER_ITEM_ID, OrderProductPeer::PRODUCT_ID, OrderProductPeer::PRICE, OrderProductPeer::QUANTITY, OrderProductPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'order_item_id', 'product_id', 'price', 'quantity', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'OrderItemId' => 1, 'ProductId' => 2, 'Price' => 3, 'Quantity' => 4, 'CreatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (OrderProductPeer::ID => 0, OrderProductPeer::ORDER_ITEM_ID => 1, OrderProductPeer::PRODUCT_ID => 2, OrderProductPeer::PRICE => 3, OrderProductPeer::QUANTITY => 4, OrderProductPeer::CREATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'order_item_id' => 1, 'product_id' => 2, 'price' => 3, 'quantity' => 4, 'created_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsOrderPlugin.lib.model.map.OrderProductMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OrderProductPeer::getTableMap();
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
		return str_replace(OrderProductPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OrderProductPeer::ID);

		$criteria->addSelectColumn(OrderProductPeer::ORDER_ITEM_ID);

		$criteria->addSelectColumn(OrderProductPeer::PRODUCT_ID);

		$criteria->addSelectColumn(OrderProductPeer::PRICE);

		$criteria->addSelectColumn(OrderProductPeer::QUANTITY);

		$criteria->addSelectColumn(OrderProductPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(order_product.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT order_product.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OrderProductPeer::doSelectRS($criteria, $con);
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
		$objects = OrderProductPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OrderProductPeer::populateObjects(OrderProductPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProductPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseOrderProductPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OrderProductPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OrderProductPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOrderItem(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProductPeer::ORDER_ITEM_ID, OrderItemPeer::ID);

		$rs = OrderProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProductPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = OrderProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOrderItem(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProductPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderProductPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProductPeer::addSelectColumns($c);
		$startcol = (OrderProductPeer::NUM_COLUMNS - OrderProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OrderItemPeer::addSelectColumns($c);

		$c->addJoin(OrderProductPeer::ORDER_ITEM_ID, OrderItemPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OrderItemPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOrderItem(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderProduct($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderProducts();
				$obj2->addOrderProduct($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProductPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOrderProductPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProductPeer::addSelectColumns($c);
		$startcol = (OrderProductPeer::NUM_COLUMNS - OrderProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProductPeer::addSelectColumns($c);

		$c->addJoin(OrderProductPeer::PRODUCT_ID, ProductPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOrderProduct($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOrderProducts();
				$obj2->addOrderProduct($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProductPeer::ORDER_ITEM_ID, OrderItemPeer::ID);

		$criteria->addJoin(OrderProductPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = OrderProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProductPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseOrderProductPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProductPeer::addSelectColumns($c);
		$startcol2 = (OrderProductPeer::NUM_COLUMNS - OrderProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OrderItemPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OrderItemPeer::NUM_COLUMNS;

		ProductPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProductPeer::NUM_COLUMNS;

		$c->addJoin(OrderProductPeer::ORDER_ITEM_ID, OrderItemPeer::ID);

		$c->addJoin(OrderProductPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OrderItemPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOrderItem(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOrderProduct($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderProducts();
				$obj2->addOrderProduct($obj1);
			}


					
			$omClass = ProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProduct(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOrderProduct($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOrderProducts();
				$obj3->addOrderProduct($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOrderItem(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProductPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = OrderProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OrderProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OrderProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OrderProductPeer::ORDER_ITEM_ID, OrderItemPeer::ID);

		$rs = OrderProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOrderItem(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProductPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderProductPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProductPeer::addSelectColumns($c);
		$startcol2 = (OrderProductPeer::NUM_COLUMNS - OrderProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductPeer::NUM_COLUMNS;

		$c->addJoin(OrderProductPeer::PRODUCT_ID, ProductPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOrderProduct($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderProducts();
				$obj2->addOrderProduct($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProductPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOrderProductPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OrderProductPeer::addSelectColumns($c);
		$startcol2 = (OrderProductPeer::NUM_COLUMNS - OrderProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OrderItemPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OrderItemPeer::NUM_COLUMNS;

		$c->addJoin(OrderProductPeer::ORDER_ITEM_ID, OrderItemPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OrderProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OrderItemPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOrderItem(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOrderProduct($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOrderProducts();
				$obj2->addOrderProduct($obj1);
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
		return OrderProductPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProductPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOrderProductPeer', $values, $con);
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

		$criteria->remove(OrderProductPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseOrderProductPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseOrderProductPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOrderProductPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOrderProductPeer', $values, $con);
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
			$comparison = $criteria->getComparison(OrderProductPeer::ID);
			$selectCriteria->add(OrderProductPeer::ID, $criteria->remove(OrderProductPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseOrderProductPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseOrderProductPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(OrderProductPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OrderProductPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OrderProduct) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OrderProductPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OrderProduct $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OrderProductPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OrderProductPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OrderProductPeer::DATABASE_NAME, OrderProductPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OrderProductPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OrderProductPeer::DATABASE_NAME);

		$criteria->add(OrderProductPeer::ID, $pk);


		$v = OrderProductPeer::doSelect($criteria, $con);

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
			$criteria->add(OrderProductPeer::ID, $pks, Criteria::IN);
			$objs = OrderProductPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOrderProductPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsOrderPlugin.lib.model.map.OrderProductMapBuilder');
}
