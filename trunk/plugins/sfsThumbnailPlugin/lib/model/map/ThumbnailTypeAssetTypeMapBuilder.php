<?php



class ThumbnailTypeAssetTypeMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsThumbnailPlugin.lib.model.map.ThumbnailTypeAssetTypeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('thumbnail_type_asset_type');
		$tMap->setPhpName('ThumbnailTypeAssetType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('THUMBNAIL_TYPE_ID', 'ThumbnailTypeId', 'int', CreoleTypes::INTEGER, 'thumbnail_type', 'ID', true, null);

		$tMap->addForeignKey('ASSET_TYPE_ID', 'AssetTypeId', 'int', CreoleTypes::INTEGER, 'asset_type', 'ID', true, null);

		$tMap->addColumn('THUMBNAIL_TYPE_NAME', 'ThumbnailTypeName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('IS_TRIM', 'IsTrim', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 