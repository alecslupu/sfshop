<?php



class AddressFormatMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsAddressBookPlugin.lib.model.map.AddressFormatMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('address_format');
		$tMap->setPhpName('AddressFormat');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addPrimaryKey('LOCATION', 'Location', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addColumn('FORMAT', 'Format', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_DEFAULT', 'IsDefault', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 