<?php


/**
 * This class defines the structure of the 'country_i18n' table.
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
class CountryI18nTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.common.map.CountryI18nTableMap';

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
		$this->setName('country_i18n');
		$this->setPhpName('CountryI18n');
		$this->setClassname('CountryI18n');
		$this->setPackage('plugins.sfsCorePlugin.lib.model.common');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'country', 'ID', true, null, null);
		$this->addPrimaryKey('CULTURE', 'Culture', 'VARCHAR', true, 7, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 128, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Country', 'Country', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // CountryI18nTableMap
