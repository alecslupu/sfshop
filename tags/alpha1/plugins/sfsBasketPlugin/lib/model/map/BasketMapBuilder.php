<?php



class BasketMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsBasketPlugin.lib.model.map.BasketMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('basket');
		$tMap->setPhpName('Basket');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('MEMBER_ID', 'MemberId', 'int', CreoleTypes::INTEGER, 'member', 'ID', false, null);

		$tMap->addForeignKey('CURRENCY_ID', 'CurrencyId', 'int', CreoleTypes::INTEGER, 'currency', 'ID', false, null);

		$tMap->addColumn('ACCESS_NUM', 'AccessNum', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 