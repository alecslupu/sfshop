<?php



class OrderProductMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsOrderPlugin.lib.model.map.OrderProductMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('order_product');
		$tMap->setPhpName('OrderProduct');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ORDER_ITEM_ID', 'OrderItemId', 'int', CreoleTypes::INTEGER, 'order_item', 'ID', true, null);

		$tMap->addForeignKey('PRODUCT_ID', 'ProductId', 'int', CreoleTypes::INTEGER, 'product', 'ID', true, null);

		$tMap->addColumn('PRICE', 'Price', 'double', CreoleTypes::DECIMAL, false, 10);

		$tMap->addColumn('QUANTITY', 'Quantity', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 