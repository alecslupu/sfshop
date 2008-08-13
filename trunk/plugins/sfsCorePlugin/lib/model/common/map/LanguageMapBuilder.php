<?php



class LanguageMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.common.map.LanguageMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('language');
		$tMap->setPhpName('Language');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addColumn('TITLE_ENGLISH', 'TitleEnglish', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('TITLE_OWN', 'TitleOwn', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('IS_DEFAULT', 'IsDefault', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 