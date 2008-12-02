<?php



class DeliveryMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsDeliveryPlugin.lib.model.map.DeliveryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('delivery');
		$tMap->setPhpName('Delivery');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('ACCEPT_CURRENCIES_CODES', 'AcceptCurrenciesCodes', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('NAME_CLASS_SERVICE', 'NameClassService', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('NAME_CLASS_FORM_PARAMS', 'NameClassFormParams', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('ICON', 'Icon', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('PARAMS', 'Params', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_DELETED', 'IsDeleted', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 