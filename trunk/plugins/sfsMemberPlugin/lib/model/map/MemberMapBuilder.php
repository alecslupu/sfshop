<?php



class MemberMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsMemberPlugin.lib.model.map.MemberMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('member');
		$tMap->setPhpName('Member');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREDENTIAL', 'Credential', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('GENDER', 'Gender', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addForeignKey('DEFAULT_ADDRESS_ID', 'DefaultAddressId', 'int', CreoleTypes::INTEGER, 'address_book', 'ID', false, null);

		$tMap->addColumn('SECRET_QUESTION', 'SecretQuestion', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SECRET_ANSWER', 'SecretAnswer', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PHONE', 'Phone', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('MOBILE', 'Mobile', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('CONFIRM_CODE', 'ConfirmCode', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('IS_CONFIRMED', 'IsConfirmed', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_DELETED', 'IsDeleted', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('ACCESS_NUM', 'AccessNum', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('MODIFIED_AT', 'ModifiedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 