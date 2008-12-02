<?php



class CurrencyMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsCurrencyPlugin.lib.model.map.CurrencyMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('currency');
		$tMap->setPhpName('Currency');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CODE', 'Code', 'string', CreoleTypes::CHAR, false, 4);

		$tMap->addColumn('DECIMAL_POINT', 'DecimalPoint', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('THOUSANDS_POINT', 'ThousandsPoint', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('DECIMAL_PLACES', 'DecimalPlaces', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('VALUE', 'Value', 'double', CreoleTypes::DECIMAL, false, 10);

		$tMap->addColumn('IS_DEFAULT', 'IsDefault', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 