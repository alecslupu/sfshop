<?php



class AddressBookMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsAddressBookPlugin.lib.model.map.AddressBookMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('address_book');
		$tMap->setPhpName('AddressBook');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('MEMBER_ID', 'MemberId', 'int', CreoleTypes::INTEGER, 'member', 'ID', false, null);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('COMPANY', 'Company', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addForeignKey('COUNTRY_ID', 'CountryId', 'int', CreoleTypes::INTEGER, 'country', 'ID', false, null);

		$tMap->addForeignKey('STATE_ID', 'StateId', 'int', CreoleTypes::INTEGER, 'state', 'ID', false, null);

		$tMap->addColumn('STATE_TITLE', 'StateTitle', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('CITY', 'City', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('STREET', 'Street', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('POSTCODE', 'Postcode', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('IS_DEFAULT', 'IsDefault', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 