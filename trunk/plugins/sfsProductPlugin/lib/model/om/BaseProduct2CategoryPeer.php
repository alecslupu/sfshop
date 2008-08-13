<?php


abstract class BaseProduct2CategoryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'product2category';

	
	const CLASS_DEFAULT = 'plugins.sfsProductPlugin.lib.model.Product2Category';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const PRODUCT_ID = 'product2category.PRODUCT_ID';

	
	const CATEGORY_ID = 'product2category.CATEGORY_ID';

	
	const POS = 'product2category.POS';

	
	const CREATED_AT = 'product2category.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ProductId', 'CategoryId', 'Pos', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (Product2CategoryPeer::PRODUCT_ID, Product2CategoryPeer::CATEGORY_ID, Product2CategoryPeer::POS, Product2CategoryPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('product_id', 'category_id', 'pos', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ProductId' => 0, 'CategoryId' => 1, 'Pos' => 2, 'CreatedAt' => 3, ),
		BasePeer::TYPE_COLNAME => array (Product2CategoryPeer::PRODUCT_ID => 0, Product2CategoryPeer::CATEGORY_ID => 1, Product2CategoryPeer::POS => 2, Product2CategoryPeer::CREATED_AT => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('product_id' => 0, 'category_id' => 1, 'pos' => 2, 'created_at' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsProductPlugin.lib.model.map.Product2CategoryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Product2CategoryPeer::getTableMap();
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
		return str_replace(Product2CategoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Product2CategoryPeer::PRODUCT_ID);

		$criteria->addSelectColumn(Product2CategoryPeer::CATEGORY_ID);

		$criteria->addSelectColumn(Product2CategoryPeer::POS);

		$criteria->addSelectColumn(Product2CategoryPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(product2category.PRODUCT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT product2category.PRODUCT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Product2CategoryPeer::doSelectRS($criteria, $con);
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
		$objects = Product2CategoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Product2CategoryPeer::populateObjects(Product2CategoryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseProduct2CategoryPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Product2CategoryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Product2CategoryPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Product2CategoryPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = Product2CategoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinCategory(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Product2CategoryPeer::CATEGORY_ID, CategoryPeer::ID);

		$rs = Product2CategoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseProduct2CategoryPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Product2CategoryPeer::addSelectColumns($c);
		$startcol = (Product2CategoryPeer::NUM_COLUMNS - Product2CategoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProductPeer::addSelectColumns($c);

		$c->addJoin(Product2CategoryPeer::PRODUCT_ID, ProductPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Product2CategoryPeer::getOMClass();

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
										$temp_obj2->addProduct2Category($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProduct2Categorys();
				$obj2->addProduct2Category($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinCategory(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseProduct2CategoryPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Product2CategoryPeer::addSelectColumns($c);
		$startcol = (Product2CategoryPeer::NUM_COLUMNS - Product2CategoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CategoryPeer::addSelectColumns($c);

		$c->addJoin(Product2CategoryPeer::CATEGORY_ID, CategoryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Product2CategoryPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CategoryPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCategory(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addProduct2Category($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProduct2Categorys();
				$obj2->addProduct2Category($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Product2CategoryPeer::PRODUCT_ID, ProductPeer::ID);

		$criteria->addJoin(Product2CategoryPeer::CATEGORY_ID, CategoryPeer::ID);

		$rs = Product2CategoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseProduct2CategoryPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Product2CategoryPeer::addSelectColumns($c);
		$startcol2 = (Product2CategoryPeer::NUM_COLUMNS - Product2CategoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductPeer::NUM_COLUMNS;

		CategoryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CategoryPeer::NUM_COLUMNS;

		$c->addJoin(Product2CategoryPeer::PRODUCT_ID, ProductPeer::ID);

		$c->addJoin(Product2CategoryPeer::CATEGORY_ID, CategoryPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Product2CategoryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ProductPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProduct2Category($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initProduct2Categorys();
				$obj2->addProduct2Category($obj1);
			}


					
			$omClass = CategoryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCategory(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProduct2Category($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initProduct2Categorys();
				$obj3->addProduct2Category($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Product2CategoryPeer::CATEGORY_ID, CategoryPeer::ID);

		$rs = Product2CategoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptCategory(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Product2CategoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Product2CategoryPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = Product2CategoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptProduct(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseProduct2CategoryPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Product2CategoryPeer::addSelectColumns($c);
		$startcol2 = (Product2CategoryPeer::NUM_COLUMNS - Product2CategoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CategoryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CategoryPeer::NUM_COLUMNS;

		$c->addJoin(Product2CategoryPeer::CATEGORY_ID, CategoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Product2CategoryPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CategoryPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCategory(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProduct2Category($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProduct2Categorys();
				$obj2->addProduct2Category($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptCategory(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseProduct2CategoryPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Product2CategoryPeer::addSelectColumns($c);
		$startcol2 = (Product2CategoryPeer::NUM_COLUMNS - Product2CategoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductPeer::NUM_COLUMNS;

		$c->addJoin(Product2CategoryPeer::PRODUCT_ID, ProductPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Product2CategoryPeer::getOMClass();

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
					$temp_obj2->addProduct2Category($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProduct2Categorys();
				$obj2->addProduct2Category($obj1);
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
		return Product2CategoryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseProduct2CategoryPeer', $values, $con);
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

		
    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseProduct2CategoryPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseProduct2CategoryPeer', $values, $con);
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
			$comparison = $criteria->getComparison(Product2CategoryPeer::PRODUCT_ID);
			$selectCriteria->add(Product2CategoryPeer::PRODUCT_ID, $criteria->remove(Product2CategoryPeer::PRODUCT_ID), $comparison);

			$comparison = $criteria->getComparison(Product2CategoryPeer::CATEGORY_ID);
			$selectCriteria->add(Product2CategoryPeer::CATEGORY_ID, $criteria->remove(Product2CategoryPeer::CATEGORY_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseProduct2CategoryPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseProduct2CategoryPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(Product2CategoryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Product2CategoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Product2Category) {

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

			$criteria->add(Product2CategoryPeer::PRODUCT_ID, $vals[0], Criteria::IN);
			$criteria->add(Product2CategoryPeer::CATEGORY_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(Product2Category $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Product2CategoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Product2CategoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Product2CategoryPeer::DATABASE_NAME, Product2CategoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Product2CategoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $product_id, $category_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(Product2CategoryPeer::PRODUCT_ID, $product_id);
		$criteria->add(Product2CategoryPeer::CATEGORY_ID, $category_id);
		$v = Product2CategoryPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseProduct2CategoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsProductPlugin.lib.model.map.Product2CategoryMapBuilder');
}
