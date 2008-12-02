<?php



class CurrencyI18nMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsCurrencyPlugin.lib.model.map.CurrencyI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('currency_i18n');
		$tMap->setPhpName('CurrencyI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'currency', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('SYMBOL_LEFT', 'SymbolLeft', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('SYMBOL_RIGHT', 'SymbolRight', 'string', CreoleTypes::VARCHAR, false, 16);

	} 
} 