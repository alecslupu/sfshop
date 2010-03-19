<?php


/**
 * This class defines the structure of the 'admin' table.
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
class AdminTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.admin.map.AdminTableMap';

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
		$this->setName('admin');
		$this->setPhpName('Admin');
		$this->setClassname('Admin');
		$this->setPackage('plugins.sfsCorePlugin.lib.model.admin');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('CREDENTIAL', 'Credential', 'VARCHAR', true, 255, 'admin');
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 128, null);
		$this->addColumn('ALGORITHM', 'Algorithm', 'VARCHAR', true, 32, 'md5');
		$this->addColumn('SALT', 'Salt', 'VARCHAR', true, 128, '');
		$this->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 128, '');
		$this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 128, null);
		$this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 128, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null, false);
		$this->addColumn('ACCESS_NUM', 'AccessNum', 'INTEGER', true, null, 1);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('MODIFIED_AT', 'ModifiedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // AdminTableMap
