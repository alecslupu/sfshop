<?php



class AdminMenuMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.admin.map.AdminMenuMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('admin_menu');
		$tMap->setPhpName('AdminMenu');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, 'admin_menu', 'ID', false, null);

		$tMap->addColumn('CREDENTIAL', 'Credential', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('ROUTE', 'Route', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('POS', 'Pos', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 