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

		$tMap->addColumn('CLASS_NAME', 'ClassName', 'string', CreoleTypes::VARCHAR, true, 16);

		$tMap->addColumn('ICON', 'Icon', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('PARAMS', 'Params', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 