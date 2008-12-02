<?php



class EmailTemplateI18nMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.common.map.EmailTemplateI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('email_template_i18n');
		$tMap->setPhpName('EmailTemplateI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'email_template', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addColumn('SUBJECT', 'Subject', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BODY', 'Body', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 