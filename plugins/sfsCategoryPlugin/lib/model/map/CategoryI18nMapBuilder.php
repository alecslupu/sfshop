<?php



class CategoryI18nMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsCategoryPlugin.lib.model.map.CategoryI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('category_i18n');
		$tMap->setPhpName('CategoryI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'category', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('META_KEYWORDS', 'MetaKeywords', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('META_DESCRIPTION', 'MetaDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 