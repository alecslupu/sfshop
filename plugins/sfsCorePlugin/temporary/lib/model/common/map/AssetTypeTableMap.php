<?php


/**
 * This class defines the structure of the 'asset_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.sfsCorePlugin.lib.model.common.map
 */
class AssetTypeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.common.map.AssetTypeTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('asset_type');
		$this->setPhpName('AssetType');
		$this->setClassname('AssetType');
		$this->setPackage('plugins.sfsCorePlugin.lib.model.common');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'CHAR', false, 32, null);
		$this->addColumn('MODEL', 'Model', 'VARCHAR', false, 128, null);
		$this->addColumn('HAS_THUMBNAIL', 'HasThumbnail', 'TINYINT', false, null, 0);
		$this->addColumn('HAS_I18N', 'HasI18n', 'TINYINT', false, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ThumbnailTypeAssetType', 'ThumbnailTypeAssetType', RelationMap::ONE_TO_MANY, array('id' => 'asset_type_id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // AssetTypeTableMap
