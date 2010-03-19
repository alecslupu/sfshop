<?php


/**
 * This class defines the structure of the 'country' table.
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
class CountryTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.common.map.CountryTableMap';

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
		$this->setName('country');
		$this->setPhpName('Country');
		$this->setClassname('Country');
		$this->setPackage('plugins.sfsCorePlugin.lib.model.common');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ISO', 'Iso', 'CHAR', true, 2, null);
		$this->addColumn('ISO_A3', 'IsoA3', 'CHAR', true, 3, null);
		$this->addColumn('ISO_N', 'IsoN', 'CHAR', true, 3, null);
		$this->addColumn('TITLE_ENGLISH', 'TitleEnglish', 'VARCHAR', false, 128, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null, false);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('AddressBook', 'AddressBook', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Location2TaxGroup', 'Location2TaxGroup', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('CountryI18n', 'CountryI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('State', 'State', RelationMap::ONE_TO_MANY, array('id' => 'country_id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('OrderItemRelatedByBillingCountryId', 'OrderItem', RelationMap::ONE_TO_MANY, array('id' => 'billing_country_id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('OrderItemRelatedByDeliveryCountryId', 'OrderItem', RelationMap::ONE_TO_MANY, array('id' => 'delivery_country_id', ), 'RESTRICT', 'RESTRICT');
	} // buildRelations()

} // CountryTableMap
