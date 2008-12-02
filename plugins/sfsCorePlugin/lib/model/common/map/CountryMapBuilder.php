<?php



class CountryMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.common.map.CountryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('country');
		$tMap->setPhpName('Country');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('ISO', 'Iso', 'string', CreoleTypes::CHAR, true, 2);

		$tMap->addColumn('ISO_A3', 'IsoA3', 'string', CreoleTypes::CHAR, true, 3);

		$tMap->addColumn('ISO_N', 'IsoN', 'string', CreoleTypes::CHAR, true, 3);

		$tMap->addColumn('TITLE_ENGLISH', 'TitleEnglish', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 