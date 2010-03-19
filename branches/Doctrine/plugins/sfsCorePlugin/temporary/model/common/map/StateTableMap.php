<?php


/**
 * This class defines the structure of the 'state' table.
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
class StateTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.common.map.StateTableMap';

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
		$this->setName('state');
		$this->setPhpName('State');
		$this->setClassname('State');
		$this->setPackage('plugins.sfsCorePlugin.lib.model.common');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('COUNTRY_ID', 'CountryId', 'INTEGER', 'country', 'ID', true, null, null);
		$this->addColumn('ISO', 'Iso', 'CHAR', true, 2, null);
		$this->addColumn('TITLE_ENGLISH', 'TitleEnglish', 'VARCHAR', false, 128, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null, false);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Country', 'Country', RelationMap::MANY_TO_ONE, array('country_id' => 'id', ), 'RESTRICT', 'CASCADE');
    $this->addRelation('AddressBook', 'AddressBook', RelationMap::ONE_TO_MANY, array('id' => 'state_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Location2TaxGroup', 'Location2TaxGroup', RelationMap::ONE_TO_MANY, array('id' => 'state_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('StateI18n', 'StateI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('OrderItemRelatedByBillingStateId', 'OrderItem', RelationMap::ONE_TO_MANY, array('id' => 'billing_state_id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('OrderItemRelatedByDeliveryStateId', 'OrderItem', RelationMap::ONE_TO_MANY, array('id' => 'delivery_state_id', ), 'RESTRICT', 'RESTRICT');
	} // buildRelations()

} // StateTableMap
