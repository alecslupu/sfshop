<?php



class BasketProduct2OptionProductMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsBasketPlugin.lib.model.map.BasketProduct2OptionProductMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('basket_product2option_product');
		$tMap->setPhpName('BasketProduct2OptionProduct');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('BASKET_PRODUCT_ID', 'BasketProductId', 'int' , CreoleTypes::INTEGER, 'basket_product', 'ID', true, null);

		$tMap->addForeignPrimaryKey('OPTION_PRODUCT_ID', 'OptionProductId', 'int' , CreoleTypes::INTEGER, 'option_product', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 