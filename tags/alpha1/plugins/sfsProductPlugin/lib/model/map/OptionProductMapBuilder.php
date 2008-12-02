<?php



class OptionProductMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsProductPlugin.lib.model.map.OptionProductMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('option_product');
		$tMap->setPhpName('OptionProduct');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('OPTION_VALUE_ID', 'OptionValueId', 'int', CreoleTypes::INTEGER, 'option_value', 'ID', true, null);

		$tMap->addForeignKey('PRODUCT_ID', 'ProductId', 'int', CreoleTypes::INTEGER, 'product', 'ID', true, null);

		$tMap->addColumn('PRICE_TYPE', 'PriceType', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('PRICE', 'Price', 'double', CreoleTypes::DECIMAL, false, 10);

		$tMap->addColumn('QUANTITY', 'Quantity', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 