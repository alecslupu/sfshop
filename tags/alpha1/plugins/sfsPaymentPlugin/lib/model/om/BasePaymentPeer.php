<?php


abstract class BasePaymentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'payment';

	
	const CLASS_DEFAULT = 'plugins.sfsPaymentPlugin.lib.model.Payment';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'payment.ID';

	
	const NAME = 'payment.NAME';

	
	const ACCEPT_CURRENCIES_CODES = 'payment.ACCEPT_CURRENCIES_CODES';

	
	const NAME_CLASS_FORM_PARAMS = 'payment.NAME_CLASS_FORM_PARAMS';

	
	const CHARGE_ROUTE = 'payment.CHARGE_ROUTE';

	
	const ICON = 'payment.ICON';

	
	const PARAMS = 'payment.PARAMS';

	
	const IS_ACTIVE = 'payment.IS_ACTIVE';

	
	const IS_DELETED = 'payment.IS_DELETED';

	
	const CREATED_AT = 'payment.CREATED_AT';

	
	const UPDATED_AT = 'payment.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'AcceptCurrenciesCodes', 'NameClassFormParams', 'ChargeRoute', 'Icon', 'Params', 'IsActive', 'IsDeleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (PaymentPeer::ID, PaymentPeer::NAME, PaymentPeer::ACCEPT_CURRENCIES_CODES, PaymentPeer::NAME_CLASS_FORM_PARAMS, PaymentPeer::CHARGE_ROUTE, PaymentPeer::ICON, PaymentPeer::PARAMS, PaymentPeer::IS_ACTIVE, PaymentPeer::IS_DELETED, PaymentPeer::CREATED_AT, PaymentPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'accept_currencies_codes', 'name_class_form_params', 'charge_route', 'icon', 'params', 'is_active', 'is_deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'AcceptCurrenciesCodes' => 2, 'NameClassFormParams' => 3, 'ChargeRoute' => 4, 'Icon' => 5, 'Params' => 6, 'IsActive' => 7, 'IsDeleted' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
		BasePeer::TYPE_COLNAME => array (PaymentPeer::ID => 0, PaymentPeer::NAME => 1, PaymentPeer::ACCEPT_CURRENCIES_CODES => 2, PaymentPeer::NAME_CLASS_FORM_PARAMS => 3, PaymentPeer::CHARGE_ROUTE => 4, PaymentPeer::ICON => 5, PaymentPeer::PARAMS => 6, PaymentPeer::IS_ACTIVE => 7, PaymentPeer::IS_DELETED => 8, PaymentPeer::CREATED_AT => 9, PaymentPeer::UPDATED_AT => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'accept_currencies_codes' => 2, 'name_class_form_params' => 3, 'charge_route' => 4, 'icon' => 5, 'params' => 6, 'is_active' => 7, 'is_deleted' => 8, 'created_at' => 9, 'updated_at' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('plugins.sfsPaymentPlugin.lib.model.map.PaymentMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PaymentPeer::getTableMap();
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
		return str_replace(PaymentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PaymentPeer::ID);

		$criteria->addSelectColumn(PaymentPeer::NAME);

		$criteria->addSelectColumn(PaymentPeer::ACCEPT_CURRENCIES_CODES);

		$criteria->addSelectColumn(PaymentPeer::NAME_CLASS_FORM_PARAMS);

		$criteria->addSelectColumn(PaymentPeer::CHARGE_ROUTE);

		$criteria->addSelectColumn(PaymentPeer::ICON);

		$criteria->addSelectColumn(PaymentPeer::PARAMS);

		$criteria->addSelectColumn(PaymentPeer::IS_ACTIVE);

		$criteria->addSelectColumn(PaymentPeer::IS_DELETED);

		$criteria->addSelectColumn(PaymentPeer::CREATED_AT);

		$criteria->addSelectColumn(PaymentPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(payment.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT payment.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PaymentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PaymentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PaymentPeer::doSelectRS($criteria, $con);
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
		$objects = PaymentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PaymentPeer::populateObjects(PaymentPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasePaymentPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BasePaymentPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PaymentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PaymentPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

  
  public static function doSelectWithI18n(Criteria $c, $culture = null, $con = null)
  {
    if ($culture === null)
    {
      $culture = sfPropel::getDefaultCulture();
    }


    foreach (sfMixer::getCallables('BasePaymentPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePaymentPeer', $c, $con);
    }


        if ($c->getDbName() == Propel::getDefaultDB())
    {
      $c->setDbName(self::DATABASE_NAME);
    }

    PaymentPeer::addSelectColumns($c);
    $startcol = (PaymentPeer::NUM_COLUMNS - PaymentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    PaymentI18nPeer::addSelectColumns($c);

    $c->addJoin(PaymentPeer::ID, PaymentI18nPeer::ID);
    $c->add(PaymentI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = PaymentPeer::getOMClass();

      $cls = sfPropel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = PaymentI18nPeer::getOMClass($rs, $startcol);

      $cls = sfPropel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setPaymentI18nForCulture($obj2, $culture);
      $obj2->setPayment($obj1);

      $results[] = $obj1;
    }
    return $results;
  }


  
  public static function getI18nModel()
  {
    return 'PaymentI18n';
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
		return PaymentPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePaymentPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePaymentPeer', $values, $con);
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

		$criteria->remove(PaymentPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasePaymentPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePaymentPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePaymentPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePaymentPeer', $values, $con);
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
			$comparison = $criteria->getComparison(PaymentPeer::ID);
			$selectCriteria->add(PaymentPeer::ID, $criteria->remove(PaymentPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePaymentPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePaymentPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(PaymentPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PaymentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Payment) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PaymentPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Payment $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PaymentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PaymentPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PaymentPeer::DATABASE_NAME, PaymentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PaymentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PaymentPeer::DATABASE_NAME);

		$criteria->add(PaymentPeer::ID, $pk);


		$v = PaymentPeer::doSelect($criteria, $con);

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
			$criteria->add(PaymentPeer::ID, $pks, Criteria::IN);
			$objs = PaymentPeer::doSelect($criteria, $con);
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
    
   
    public static function getAll($criteria = null, $withI18n = false)
    {
        if ($criteria == null) {
            $criteria = new Criteria();
        }
        
        if ($withI18n) {
            return self::doSelectWithI18n($criteria);
        }
        else {
            return self::doSelect($criteria);
        }
    }
    
   
    public static function doSelectWithTranslation(Criteria $c, $culture = null, $con = null)
    {
        $results = self::doSelectWithI18n($c, $culture, $con);
        
        if ($results == null) {
            $defaultCulture = LanguagePeer::getDefault();
            $results = self::doSelectWithI18n($c, $defaultCulture->getCulture());
        }
        
        return $results;
    }

} 
if (Propel::isInit()) {
			try {
		BasePaymentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('plugins.sfsPaymentPlugin.lib.model.map.PaymentMapBuilder');
}
