<?php


abstract class BaseThumbnailTypeAssetTypePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'thumbnail_type_asset_type';

	
	const CLASS_DEFAULT = 'plugins.sfsThumbnailPlugin.lib.model.ThumbnailTypeAssetType';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'thumbnail_type_asset_type.ID';

	
	const THUMBNAIL_TYPE_ID = 'thumbnail_type_asset_type.THUMBNAIL_TYPE_ID';

	
	const ASSET_TYPE_ID = 'thumbnail_type_asset_type.ASSET_TYPE_ID';

	
	const THUMBNAIL_TYPE_NAME = 'thumbnail_type_asset_type.THUMBNAIL_TYPE_NAME';

	
	const WIDTH = 'thumbnail_type_asset_type.WIDTH';

	
	const HEIGHT = 'thumbnail_type_asset_type.HEIGHT';

	
	const IS_TRIM = 'thumbnail_type_asset_type.IS_TRIM';

	
	const IS_ACTIVE = 'thumbnail_type_asset_type.IS_ACTIVE';

	
	const CREATED_AT = 'thumbnail_type_asset_type.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ThumbnailTypeId', 'AssetTypeId', 'ThumbnailTypeName', 'Width', 'Height', 'IsTrim', 'IsActive', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (ThumbnailTypeAssetTypePeer::ID, ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME, ThumbnailTypeAssetTypePeer::WIDTH, ThumbnailTypeAssetTypePeer::HEIGHT, ThumbnailTypeAssetTypePeer::IS_TRIM, ThumbnailTypeAssetTypePeer::IS_ACTIVE, ThumbnailTypeAssetTypePeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'thumbnail_type_id', 'asset_type_id', 'thumbnail_type_name', 'width', 'height', 'is_trim', 'is_active', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ThumbnailTypeId' => 1, 'AssetTypeId' => 2, 'ThumbnailTypeName' => 3, 'Width' => 4, 'Height' => 5, 'IsTrim' => 6, 'IsActive' => 7, 'CreatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (ThumbnailTypeAssetTypePeer::ID => 0, ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID => 1, ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID => 2, ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME => 3, ThumbnailTypeAssetTypePeer::WIDTH => 4, ThumbnailTypeAssetTypePeer::HEIGHT => 5, ThumbnailTypeAssetTypePeer::IS_TRIM => 6, ThumbnailTypeAssetTypePeer::IS_ACTIVE => 7, ThumbnailTypeAssetTypePeer::CREATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'thumbnail_type_id' => 1, 'asset_type_id' => 2, 'thumbnail_type_name' => 3, 'width' => 4, 'height' => 5, 'is_trim' => 6, 'is_active' => 7, 'created_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsThumbnailPlugin.lib.model.map.ThumbnailTypeAssetTypeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ThumbnailTypeAssetTypePeer::getTableMap();
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
		return str_replace(ThumbnailTypeAssetTypePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::ID);

		$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID);

		$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID);

		$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_NAME);

		$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::WIDTH);

		$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::HEIGHT);

		$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::IS_TRIM);

		$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::IS_ACTIVE);

		$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::CREATED_AT);

	}

	const COUNT = 'COUNT(thumbnail_type_asset_type.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT thumbnail_type_asset_type.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ThumbnailTypeAssetTypePeer::doSelectRS($criteria, $con);
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
		$objects = ThumbnailTypeAssetTypePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ThumbnailTypeAssetTypePeer::populateObjects(ThumbnailTypeAssetTypePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ThumbnailTypeAssetTypePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ThumbnailTypeAssetTypePeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinThumbnailType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, ThumbnailTypePeer::ID);

		$rs = ThumbnailTypeAssetTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAssetType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, AssetTypePeer::ID);

		$rs = ThumbnailTypeAssetTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinThumbnailType(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailTypeAssetTypePeer::addSelectColumns($c);
		$startcol = (ThumbnailTypeAssetTypePeer::NUM_COLUMNS - ThumbnailTypeAssetTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ThumbnailTypePeer::addSelectColumns($c);

		$c->addJoin(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, ThumbnailTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailTypeAssetTypePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ThumbnailTypePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getThumbnailType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addThumbnailTypeAssetType($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initThumbnailTypeAssetTypes();
				$obj2->addThumbnailTypeAssetType($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAssetType(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailTypeAssetTypePeer::addSelectColumns($c);
		$startcol = (ThumbnailTypeAssetTypePeer::NUM_COLUMNS - ThumbnailTypeAssetTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AssetTypePeer::addSelectColumns($c);

		$c->addJoin(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, AssetTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailTypeAssetTypePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AssetTypePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAssetType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addThumbnailTypeAssetType($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initThumbnailTypeAssetTypes();
				$obj2->addThumbnailTypeAssetType($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, ThumbnailTypePeer::ID);

		$criteria->addJoin(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, AssetTypePeer::ID);

		$rs = ThumbnailTypeAssetTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailTypeAssetTypePeer::addSelectColumns($c);
		$startcol2 = (ThumbnailTypeAssetTypePeer::NUM_COLUMNS - ThumbnailTypeAssetTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ThumbnailTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ThumbnailTypePeer::NUM_COLUMNS;

		AssetTypePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AssetTypePeer::NUM_COLUMNS;

		$c->addJoin(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, ThumbnailTypePeer::ID);

		$c->addJoin(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, AssetTypePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailTypeAssetTypePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ThumbnailTypePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getThumbnailType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addThumbnailTypeAssetType($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initThumbnailTypeAssetTypes();
				$obj2->addThumbnailTypeAssetType($obj1);
			}


					
			$omClass = AssetTypePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAssetType(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addThumbnailTypeAssetType($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initThumbnailTypeAssetTypes();
				$obj3->addThumbnailTypeAssetType($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptThumbnailType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, AssetTypePeer::ID);

		$rs = ThumbnailTypeAssetTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptAssetType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailTypeAssetTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, ThumbnailTypePeer::ID);

		$rs = ThumbnailTypeAssetTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptThumbnailType(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailTypeAssetTypePeer::addSelectColumns($c);
		$startcol2 = (ThumbnailTypeAssetTypePeer::NUM_COLUMNS - ThumbnailTypeAssetTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AssetTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AssetTypePeer::NUM_COLUMNS;

		$c->addJoin(ThumbnailTypeAssetTypePeer::ASSET_TYPE_ID, AssetTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailTypeAssetTypePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AssetTypePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAssetType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addThumbnailTypeAssetType($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initThumbnailTypeAssetTypes();
				$obj2->addThumbnailTypeAssetType($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptAssetType(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailTypeAssetTypePeer::addSelectColumns($c);
		$startcol2 = (ThumbnailTypeAssetTypePeer::NUM_COLUMNS - ThumbnailTypeAssetTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ThumbnailTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ThumbnailTypePeer::NUM_COLUMNS;

		$c->addJoin(ThumbnailTypeAssetTypePeer::THUMBNAIL_TYPE_ID, ThumbnailTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailTypeAssetTypePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ThumbnailTypePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getThumbnailType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addThumbnailTypeAssetType($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initThumbnailTypeAssetTypes();
				$obj2->addThumbnailTypeAssetType($obj1);
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
		return ThumbnailTypeAssetTypePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $values, $con);
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

		$criteria->remove(ThumbnailTypeAssetTypePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $values, $con);
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
			$comparison = $criteria->getComparison(ThumbnailTypeAssetTypePeer::ID);
			$selectCriteria->add(ThumbnailTypeAssetTypePeer::ID, $criteria->remove(ThumbnailTypeAssetTypePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseThumbnailTypeAssetTypePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailTypeAssetTypePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(ThumbnailTypeAssetTypePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ThumbnailTypeAssetTypePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ThumbnailTypeAssetType) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ThumbnailTypeAssetTypePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ThumbnailTypeAssetType $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ThumbnailTypeAssetTypePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ThumbnailTypeAssetTypePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ThumbnailTypeAssetTypePeer::DATABASE_NAME, ThumbnailTypeAssetTypePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ThumbnailTypeAssetTypePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ThumbnailTypeAssetTypePeer::DATABASE_NAME);

		$criteria->add(ThumbnailTypeAssetTypePeer::ID, $pk);


		$v = ThumbnailTypeAssetTypePeer::doSelect($criteria, $con);

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
			$criteria->add(ThumbnailTypeAssetTypePeer::ID, $pks, Criteria::IN);
			$objs = ThumbnailTypeAssetTypePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

   
    
    public static function addAdminCriteria(Criteria $criteria)
    {
    }
    
    
   
    
    public static function addPublicCriteria(Criteria $criteria)
    {
        self::addAdminCriteria($criteria);
        
        $criteria->addAnd(self::IS_ACTIVE, 1);
    
    }
    
    
   
    public static function retrieveById($id, $criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        $criteria->add(self::ID, $id);
        
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
    
} 
if (Propel::isInit()) {
			try {
		BaseThumbnailTypeAssetTypePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsThumbnailPlugin.lib.model.map.ThumbnailTypeAssetTypeMapBuilder');
}
