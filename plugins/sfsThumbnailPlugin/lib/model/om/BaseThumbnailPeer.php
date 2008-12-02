<?php


abstract class BaseThumbnailPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'thumbnail';

	
	const CLASS_DEFAULT = 'plugins.sfsThumbnailPlugin.lib.model.Thumbnail';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'thumbnail.ID';

	
	const PARENT_ID = 'thumbnail.PARENT_ID';

	
	const TTAT_ID = 'thumbnail.TTAT_ID';

	
	const MIME_ID = 'thumbnail.MIME_ID';

	
	const ASSET_ID = 'thumbnail.ASSET_ID';

	
	const UUID = 'thumbnail.UUID';

	
	const ASSET_TYPE_MODEL = 'thumbnail.ASSET_TYPE_MODEL';

	
	const MIME_EXTENSION = 'thumbnail.MIME_EXTENSION';

	
	const PATH = 'thumbnail.PATH';

	
	const IS_BLANK = 'thumbnail.IS_BLANK';

	
	const IS_CONVERTED = 'thumbnail.IS_CONVERTED';

	
	const CREATED_AT = 'thumbnail.CREATED_AT';

	
	const UPDATED_AT = 'thumbnail.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ParentId', 'TtatId', 'MimeId', 'AssetId', 'Uuid', 'AssetTypeModel', 'MimeExtension', 'Path', 'IsBlank', 'IsConverted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ThumbnailPeer::ID, ThumbnailPeer::PARENT_ID, ThumbnailPeer::TTAT_ID, ThumbnailPeer::MIME_ID, ThumbnailPeer::ASSET_ID, ThumbnailPeer::UUID, ThumbnailPeer::ASSET_TYPE_MODEL, ThumbnailPeer::MIME_EXTENSION, ThumbnailPeer::PATH, ThumbnailPeer::IS_BLANK, ThumbnailPeer::IS_CONVERTED, ThumbnailPeer::CREATED_AT, ThumbnailPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'parent_id', 'ttat_id', 'mime_id', 'asset_id', 'uuid', 'asset_type_model', 'mime_extension', 'path', 'is_blank', 'is_converted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ParentId' => 1, 'TtatId' => 2, 'MimeId' => 3, 'AssetId' => 4, 'Uuid' => 5, 'AssetTypeModel' => 6, 'MimeExtension' => 7, 'Path' => 8, 'IsBlank' => 9, 'IsConverted' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ),
		BasePeer::TYPE_COLNAME => array (ThumbnailPeer::ID => 0, ThumbnailPeer::PARENT_ID => 1, ThumbnailPeer::TTAT_ID => 2, ThumbnailPeer::MIME_ID => 3, ThumbnailPeer::ASSET_ID => 4, ThumbnailPeer::UUID => 5, ThumbnailPeer::ASSET_TYPE_MODEL => 6, ThumbnailPeer::MIME_EXTENSION => 7, ThumbnailPeer::PATH => 8, ThumbnailPeer::IS_BLANK => 9, ThumbnailPeer::IS_CONVERTED => 10, ThumbnailPeer::CREATED_AT => 11, ThumbnailPeer::UPDATED_AT => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'parent_id' => 1, 'ttat_id' => 2, 'mime_id' => 3, 'asset_id' => 4, 'uuid' => 5, 'asset_type_model' => 6, 'mime_extension' => 7, 'path' => 8, 'is_blank' => 9, 'is_converted' => 10, 'created_at' => 11, 'updated_at' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsThumbnailPlugin.lib.model.map.ThumbnailMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ThumbnailPeer::getTableMap();
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
		return str_replace(ThumbnailPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ThumbnailPeer::ID);

		$criteria->addSelectColumn(ThumbnailPeer::PARENT_ID);

		$criteria->addSelectColumn(ThumbnailPeer::TTAT_ID);

		$criteria->addSelectColumn(ThumbnailPeer::MIME_ID);

		$criteria->addSelectColumn(ThumbnailPeer::ASSET_ID);

		$criteria->addSelectColumn(ThumbnailPeer::UUID);

		$criteria->addSelectColumn(ThumbnailPeer::ASSET_TYPE_MODEL);

		$criteria->addSelectColumn(ThumbnailPeer::MIME_EXTENSION);

		$criteria->addSelectColumn(ThumbnailPeer::PATH);

		$criteria->addSelectColumn(ThumbnailPeer::IS_BLANK);

		$criteria->addSelectColumn(ThumbnailPeer::IS_CONVERTED);

		$criteria->addSelectColumn(ThumbnailPeer::CREATED_AT);

		$criteria->addSelectColumn(ThumbnailPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(thumbnail.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT thumbnail.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ThumbnailPeer::doSelectRS($criteria, $con);
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
		$objects = ThumbnailPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ThumbnailPeer::populateObjects(ThumbnailPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ThumbnailPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ThumbnailPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinThumbnailTypeAssetType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailPeer::TTAT_ID, ThumbnailTypeAssetTypePeer::ID);

		$rs = ThumbnailPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinThumbnailMime(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailPeer::MIME_ID, ThumbnailMimePeer::ID);

		$rs = ThumbnailPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinThumbnailTypeAssetType(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailPeer::addSelectColumns($c);
		$startcol = (ThumbnailPeer::NUM_COLUMNS - ThumbnailPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ThumbnailTypeAssetTypePeer::addSelectColumns($c);

		$c->addJoin(ThumbnailPeer::TTAT_ID, ThumbnailTypeAssetTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ThumbnailTypeAssetTypePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getThumbnailTypeAssetType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addThumbnail($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initThumbnails();
				$obj2->addThumbnail($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinThumbnailMime(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailPeer::addSelectColumns($c);
		$startcol = (ThumbnailPeer::NUM_COLUMNS - ThumbnailPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ThumbnailMimePeer::addSelectColumns($c);

		$c->addJoin(ThumbnailPeer::MIME_ID, ThumbnailMimePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ThumbnailMimePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getThumbnailMime(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addThumbnail($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initThumbnails();
				$obj2->addThumbnail($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailPeer::TTAT_ID, ThumbnailTypeAssetTypePeer::ID);

		$criteria->addJoin(ThumbnailPeer::MIME_ID, ThumbnailMimePeer::ID);

		$rs = ThumbnailPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailPeer::addSelectColumns($c);
		$startcol2 = (ThumbnailPeer::NUM_COLUMNS - ThumbnailPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ThumbnailTypeAssetTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ThumbnailTypeAssetTypePeer::NUM_COLUMNS;

		ThumbnailMimePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ThumbnailMimePeer::NUM_COLUMNS;

		$c->addJoin(ThumbnailPeer::TTAT_ID, ThumbnailTypeAssetTypePeer::ID);

		$c->addJoin(ThumbnailPeer::MIME_ID, ThumbnailMimePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ThumbnailTypeAssetTypePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getThumbnailTypeAssetType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addThumbnail($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initThumbnails();
				$obj2->addThumbnail($obj1);
			}


					
			$omClass = ThumbnailMimePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getThumbnailMime(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addThumbnail($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initThumbnails();
				$obj3->addThumbnail($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptThumbnailRelatedByParentId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailPeer::TTAT_ID, ThumbnailTypeAssetTypePeer::ID);

		$criteria->addJoin(ThumbnailPeer::MIME_ID, ThumbnailMimePeer::ID);

		$rs = ThumbnailPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptThumbnailTypeAssetType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailPeer::MIME_ID, ThumbnailMimePeer::ID);

		$rs = ThumbnailPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptThumbnailMime(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ThumbnailPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ThumbnailPeer::TTAT_ID, ThumbnailTypeAssetTypePeer::ID);

		$rs = ThumbnailPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptThumbnailRelatedByParentId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailPeer::addSelectColumns($c);
		$startcol2 = (ThumbnailPeer::NUM_COLUMNS - ThumbnailPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ThumbnailTypeAssetTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ThumbnailTypeAssetTypePeer::NUM_COLUMNS;

		ThumbnailMimePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ThumbnailMimePeer::NUM_COLUMNS;

		$c->addJoin(ThumbnailPeer::TTAT_ID, ThumbnailTypeAssetTypePeer::ID);

		$c->addJoin(ThumbnailPeer::MIME_ID, ThumbnailMimePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ThumbnailTypeAssetTypePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getThumbnailTypeAssetType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addThumbnail($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initThumbnails();
				$obj2->addThumbnail($obj1);
			}

			$omClass = ThumbnailMimePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getThumbnailMime(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addThumbnail($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initThumbnails();
				$obj3->addThumbnail($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptThumbnailTypeAssetType(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailPeer::addSelectColumns($c);
		$startcol2 = (ThumbnailPeer::NUM_COLUMNS - ThumbnailPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ThumbnailMimePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ThumbnailMimePeer::NUM_COLUMNS;

		$c->addJoin(ThumbnailPeer::MIME_ID, ThumbnailMimePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ThumbnailMimePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getThumbnailMime(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addThumbnail($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initThumbnails();
				$obj2->addThumbnail($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptThumbnailMime(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ThumbnailPeer::addSelectColumns($c);
		$startcol2 = (ThumbnailPeer::NUM_COLUMNS - ThumbnailPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ThumbnailTypeAssetTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ThumbnailTypeAssetTypePeer::NUM_COLUMNS;

		$c->addJoin(ThumbnailPeer::TTAT_ID, ThumbnailTypeAssetTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ThumbnailPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ThumbnailTypeAssetTypePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getThumbnailTypeAssetType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addThumbnail($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initThumbnails();
				$obj2->addThumbnail($obj1);
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
		return ThumbnailPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseThumbnailPeer', $values, $con);
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

		$criteria->remove(ThumbnailPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseThumbnailPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseThumbnailPeer', $values, $con);
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
			$comparison = $criteria->getComparison(ThumbnailPeer::ID);
			$selectCriteria->add(ThumbnailPeer::ID, $criteria->remove(ThumbnailPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseThumbnailPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseThumbnailPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(ThumbnailPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ThumbnailPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Thumbnail) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ThumbnailPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Thumbnail $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ThumbnailPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ThumbnailPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ThumbnailPeer::DATABASE_NAME, ThumbnailPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ThumbnailPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ThumbnailPeer::DATABASE_NAME);

		$criteria->add(ThumbnailPeer::ID, $pk);


		$v = ThumbnailPeer::doSelect($criteria, $con);

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
			$criteria->add(ThumbnailPeer::ID, $pks, Criteria::IN);
			$objs = ThumbnailPeer::doSelect($criteria, $con);
		}
		return $objs;
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
		BaseThumbnailPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsThumbnailPlugin.lib.model.map.ThumbnailMapBuilder');
}
