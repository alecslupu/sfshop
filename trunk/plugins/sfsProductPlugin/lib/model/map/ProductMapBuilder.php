<?php



class ProductMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsProductPlugin.lib.model.map.ProductMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('product');
		$tMap->setPhpName('Product');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('BRAND_ID', 'BrandId', 'int', CreoleTypes::INTEGER, 'brand', 'ID', false, null);

		$tMap->addColumn('PRICE', 'Price', 'double', CreoleTypes::DECIMAL, false, 10);

		$tMap->addColumn('QUANTITY', 'Quantity', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('WEIGHT', 'Weight', 'double', CreoleTypes::DECIMAL, false, 10);

		$tMap->addColumn('CUBE', 'Cube', 'double', CreoleTypes::DECIMAL, false, 10);

		$tMap->addColumn('HAS_OPTIONS', 'HasOptions', 'int', CreoleTypes::TINYINT, false, 1);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_DELETED', 'IsDeleted', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 