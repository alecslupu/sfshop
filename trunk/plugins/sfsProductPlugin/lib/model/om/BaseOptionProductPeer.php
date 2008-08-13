<?php


abstract class BaseOptionProductPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'option_product';

	
	const CLASS_DEFAULT = 'plugins.sfsProductPlugin.lib.model.OptionProduct';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'option_product.ID';

	
	const OPTION_VALUE_ID = 'option_product.OPTION_VALUE_ID';

	
	const PRODUCT_ID = 'option_product.PRODUCT_ID';

	
	const PRICE_TYPE = 'option_product.PRICE_TYPE';

	
	const PRICE = 'option_product.PRICE';

	
	const QUANTITY = 'option_product.QUANTITY';

	
	const CREATED_AT = 'option_product.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'OptionValueId', 'ProductId', 'PriceType', 'Price', 'Quantity', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (OptionProductPeer::ID, OptionProductPeer::OPTION_VALUE_ID, OptionProductPeer::PRODUCT_ID, OptionProductPeer::PRICE_TYPE, OptionProductPeer::PRICE, OptionProductPeer::QUANTITY, OptionProductPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'option_value_id', 'product_id', 'price_type', 'price', 'quantity', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'OptionValueId' => 1, 'ProductId' => 2, 'PriceType' => 3, 'Price' => 4, 'Quantity' => 5, 'CreatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (OptionProductPeer::ID => 0, OptionProductPeer::OPTION_VALUE_ID => 1, OptionProductPeer::PRODUCT_ID => 2, OptionProductPeer::PRICE_TYPE => 3, OptionProductPeer::PRICE => 4, OptionProductPeer::QUANTITY => 5, OptionProductPeer::CREATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'option_value_id' => 1, 'product_id' => 2, 'price_type' => 3, 'price' => 4, 'quantity' => 5, 'created_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsProductPlugin.lib.model.map.OptionProductMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OptionProductPeer::getTableMap();
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
		return str_replace(OptionProductPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OptionProductPeer::ID);

		$criteria->addSelectColumn(OptionProductPeer::OPTION_VALUE_ID);

		$criteria->addSelectColumn(OptionProductPeer::PRODUCT_ID);

		$criteria->addSelectColumn(OptionProductPeer::PRICE_TYPE);

		$criteria->addSelectColumn(OptionProductPeer::PRICE);

		$criteria->addSelectColumn(OptionProductPeer::QUANTITY);

		$criteria->addSelectColumn(OptionProductPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(option_product.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT option_product.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OptionProductPeer::doSelectRS($criteria, $con);
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
		$objects = OptionProductPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OptionProductPeer::populateObjects(OptionProductPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProductPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseOptionProductPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OptionProductPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OptionProductPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOptionValue(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OptionProductPeer::OPTION_VALUE_ID, OptionValuePeer::ID);

		$rs = OptionProductPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OptionProductPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = OptionProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOptionValue(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProductPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOptionProductPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OptionProductPeer::addSelectColumns($c);
		$startcol = (OptionProductPeer::NUM_COLUMNS - OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OptionValuePeer::addSelectColumns($c);

		$c->addJoin(OptionProductPeer::OPTION_VALUE_ID, OptionValuePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OptionProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OptionValuePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOptionValue(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOptionProduct($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOptionProducts();
				$obj2->addOptionProduct($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProductPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseOptionProductPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OptionProductPeer::addSelectColumns($c);
		$startcol = (OptionProductPeer::NUM_COLUMNS - OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProductPeer::addSelectColumns($c);

		$c->addJoin(OptionProductPeer::PRODUCT_ID, ProductPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OptionProductPeer::getOMClass();

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
										$temp_obj2->addOptionProduct($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOptionProducts();
				$obj2->addOptionProduct($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OptionProductPeer::OPTION_VALUE_ID, OptionValuePeer::ID);

		$criteria->addJoin(OptionProductPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = OptionProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProductPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseOptionProductPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OptionProductPeer::addSelectColumns($c);
		$startcol2 = (OptionProductPeer::NUM_COLUMNS - OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OptionValuePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OptionValuePeer::NUM_COLUMNS;

		ProductPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProductPeer::NUM_COLUMNS;

		$c->addJoin(OptionProductPeer::OPTION_VALUE_ID, OptionValuePeer::ID);

		$c->addJoin(OptionProductPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OptionProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OptionValuePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOptionValue(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOptionProduct($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOptionProducts();
				$obj2->addOptionProduct($obj1);
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
					$temp_obj3->addOptionProduct($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOptionProducts();
				$obj3->addOptionProduct($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOptionValue(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OptionProductPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = OptionProductPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OptionProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OptionProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OptionProductPeer::OPTION_VALUE_ID, OptionValuePeer::ID);

		$rs = OptionProductPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOptionValue(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProductPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOptionProductPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OptionProductPeer::addSelectColumns($c);
		$startcol2 = (OptionProductPeer::NUM_COLUMNS - OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductPeer::NUM_COLUMNS;

		$c->addJoin(OptionProductPeer::PRODUCT_ID, ProductPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OptionProductPeer::getOMClass();

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
					$temp_obj2->addOptionProduct($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOptionProducts();
				$obj2->addOptionProduct($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProductPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseOptionProductPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OptionProductPeer::addSelectColumns($c);
		$startcol2 = (OptionProductPeer::NUM_COLUMNS - OptionProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OptionValuePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OptionValuePeer::NUM_COLUMNS;

		$c->addJoin(OptionProductPeer::OPTION_VALUE_ID, OptionValuePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OptionProductPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OptionValuePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOptionValue(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOptionProduct($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOptionProducts();
				$obj2->addOptionProduct($obj1);
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
		return OptionProductPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProductPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOptionProductPeer', $values, $con);
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

		$criteria->remove(OptionProductPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseOptionProductPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseOptionProductPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseOptionProductPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseOptionProductPeer', $values, $con);
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
			$comparison = $criteria->getComparison(OptionProductPeer::ID);
			$selectCriteria->add(OptionProductPeer::ID, $criteria->remove(OptionProductPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseOptionProductPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseOptionProductPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(OptionProductPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OptionProductPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OptionProduct) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OptionProductPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OptionProduct $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OptionProductPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OptionProductPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OptionProductPeer::DATABASE_NAME, OptionProductPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OptionProductPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OptionProductPeer::DATABASE_NAME);

		$criteria->add(OptionProductPeer::ID, $pk);


		$v = OptionProductPeer::doSelect($criteria, $con);

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
			$criteria->add(OptionProductPeer::ID, $pks, Criteria::IN);
			$objs = OptionProductPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOptionProductPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsProductPlugin.lib.model.map.OptionProductMapBuilder');
}
