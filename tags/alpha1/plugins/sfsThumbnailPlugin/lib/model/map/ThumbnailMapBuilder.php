<?php



class ThumbnailMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsThumbnailPlugin.lib.model.map.ThumbnailMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('thumbnail');
		$tMap->setPhpName('Thumbnail');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, 'thumbnail', 'ID', false, null);

		$tMap->addForeignKey('TTAT_ID', 'TtatId', 'int', CreoleTypes::INTEGER, 'thumbnail_type_asset_type', 'ID', false, null);

		$tMap->addForeignKey('MIME_ID', 'MimeId', 'int', CreoleTypes::INTEGER, 'thumbnail_mime', 'ID', false, null);

		$tMap->addColumn('ASSET_ID', 'AssetId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('UUID', 'Uuid', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('ASSET_TYPE_MODEL', 'AssetTypeModel', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('MIME_EXTENSION', 'MimeExtension', 'string', CreoleTypes::VARCHAR, false, 8);

		$tMap->addColumn('PATH', 'Path', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_BLANK', 'IsBlank', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_CONVERTED', 'IsConverted', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 