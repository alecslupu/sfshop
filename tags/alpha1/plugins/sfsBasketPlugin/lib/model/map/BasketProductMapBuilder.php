<?php



class BasketProductMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsBasketPlugin.lib.model.map.BasketProductMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('basket_product');
		$tMap->setPhpName('BasketProduct');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('BASKET_ID', 'BasketId', 'int', CreoleTypes::INTEGER, 'basket', 'ID', true, null);

		$tMap->addForeignKey('PRODUCT_ID', 'ProductId', 'int', CreoleTypes::INTEGER, 'product', 'ID', true, null);

		$tMap->addColumn('OPTIONS_LIST', 'OptionsList', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('QUANTITY', 'Quantity', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 