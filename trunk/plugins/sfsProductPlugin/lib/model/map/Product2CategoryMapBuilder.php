<?php



class Product2CategoryMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsProductPlugin.lib.model.map.Product2CategoryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('product2category');
		$tMap->setPhpName('Product2Category');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('PRODUCT_ID', 'ProductId', 'int' , CreoleTypes::INTEGER, 'product', 'ID', true, null);

		$tMap->addForeignPrimaryKey('CATEGORY_ID', 'CategoryId', 'int' , CreoleTypes::INTEGER, 'category', 'ID', true, null);

		$tMap->addColumn('POS', 'Pos', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 