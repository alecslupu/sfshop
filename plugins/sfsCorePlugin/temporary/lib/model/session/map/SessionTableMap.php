<?php


/**
 * This class defines the structure of the 'session' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.sfsCorePlugin.lib.model.session.map
 */
class SessionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.session.map.SessionTableMap';

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
		$this->setName('session');
		$this->setPhpName('Session');
		$this->setClassname('Session');
		$this->setPackage('plugins.sfsCorePlugin.lib.model.session');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('CID', 'Cid', 'CHAR', true, 36, null);
		$this->addColumn('SES_DATA', 'SesData', 'LONGVARCHAR', true, null, null);
		$this->addColumn('SES_TIME', 'SesTime', 'BIGINT', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // SessionTableMap
