<?php



class ProductI18nMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsProductPlugin.lib.model.map.ProductI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('product_i18n');
		$tMap->setPhpName('ProductI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'product', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION_SHORT', 'DescriptionShort', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('META_KEYWORDS', 'MetaKeywords', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('META_DESCRIPTION', 'MetaDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 