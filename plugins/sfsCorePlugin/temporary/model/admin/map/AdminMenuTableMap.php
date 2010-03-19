<?php


/**
 * This class defines the structure of the 'admin_menu' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.sfsCorePlugin.lib.model.admin.map
 */
class AdminMenuTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.admin.map.AdminMenuTableMap';

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
		$this->setName('admin_menu');
		$this->setPhpName('AdminMenu');
		$this->setClassname('AdminMenu');
		$this->setPackage('plugins.sfsCorePlugin.lib.model.admin');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('PARENT_ID', 'ParentId', 'INTEGER', 'admin_menu', 'ID', false, null, null);
		$this->addColumn('CREDENTIAL', 'Credential', 'VARCHAR', true, 255, 'admin');
		$this->addColumn('MODULE', 'Module', 'VARCHAR', false, 128, null);
		$this->addColumn('ACTION', 'Action', 'VARCHAR', false, 128, null);
		$this->addColumn('ROUTE', 'Route', 'VARCHAR', false, 128, null);
		$this->addColumn('POS', 'Pos', 'INTEGER', false, null, 0);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null, true);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('AdminMenuRelatedByParentId', 'AdminMenu', RelationMap::MANY_TO_ONE, array('parent_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('AdminMenuRelatedByParentId', 'AdminMenu', RelationMap::ONE_TO_MANY, array('id' => 'parent_id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('AdminMenuI18n', 'AdminMenuI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // AdminMenuTableMap
