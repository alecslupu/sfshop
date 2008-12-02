<?php



class ThumbnailMimeMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsThumbnailPlugin.lib.model.map.ThumbnailMimeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('thumbnail_mime');
		$tMap->setPhpName('ThumbnailMime');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('MIME', 'Mime', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('EXTENSION', 'Extension', 'string', CreoleTypes::VARCHAR, false, 8);

		$tMap->addColumn('EXTENSIONS', 'Extensions', 'string', CreoleTypes::VARCHAR, false, 128);

	} 
} 