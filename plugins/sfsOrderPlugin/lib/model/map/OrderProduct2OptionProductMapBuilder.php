<?php



class OrderProduct2OptionProductMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsOrderPlugin.lib.model.map.OrderProduct2OptionProductMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('order_product2option_product');
		$tMap->setPhpName('OrderProduct2OptionProduct');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ORDER_PRODUCT_ID', 'OrderProductId', 'int' , CreoleTypes::INTEGER, 'order_product', 'ID', true, null);

		$tMap->addForeignPrimaryKey('OPTION_PRODUCT_ID', 'OptionProductId', 'int' , CreoleTypes::INTEGER, 'option_product', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 