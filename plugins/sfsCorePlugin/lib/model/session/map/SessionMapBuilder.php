<?php



class SessionMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.session.map.SessionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap('session');

		$tMap = $this->dbMap->addTable('session');
		$tMap->setPhpName('Session');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CID', 'Cid', 'string', CreoleTypes::CHAR, true, 36);

		$tMap->addColumn('SES_DATA', 'SesData', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('SES_TIME', 'SesTime', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 