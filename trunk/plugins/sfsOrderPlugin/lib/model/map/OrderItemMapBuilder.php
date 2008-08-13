<?php



class OrderItemMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsOrderPlugin.lib.model.map.OrderItemMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('order_item');
		$tMap->setPhpName('OrderItem');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('UUID', 'Uuid', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addForeignKey('MEMBER_ID', 'MemberId', 'int', CreoleTypes::INTEGER, 'member', 'ID', true, null);

		$tMap->addColumn('MEMBER_FIRST_NAME', 'MemberFirstName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('MEMBER_LAST_NAME', 'MemberLastName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addForeignKey('MEMBER_COUNTRY_ID', 'MemberCountryId', 'int', CreoleTypes::INTEGER, 'country', 'ID', false, null);

		$tMap->addForeignKey('MEMBER_STATE_ID', 'MemberStateId', 'int', CreoleTypes::INTEGER, 'state', 'ID', false, null);

		$tMap->addColumn('MEMBER_STATE_TITLE', 'MemberStateTitle', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('MEMBER_CITY', 'MemberCity', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('MEMBER_STREET', 'MemberStreet', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('MEMBER_POSTCODE', 'MemberPostcode', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('BILLING_FIRST_NAME', 'BillingFirstName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('BILLING_LAST_NAME', 'BillingLastName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addForeignKey('BILLING_COUNTRY_ID', 'BillingCountryId', 'int', CreoleTypes::INTEGER, 'country', 'ID', false, null);

		$tMap->addForeignKey('BILLING_STATE_ID', 'BillingStateId', 'int', CreoleTypes::INTEGER, 'state', 'ID', false, null);

		$tMap->addColumn('BILLING_STATE_TITLE', 'BillingStateTitle', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('BILLING_CITY', 'BillingCity', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('BILLING_STREET', 'BillingStreet', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('BILLING_POSTCODE', 'BillingPostcode', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('DELIVERY_FIRST_NAME', 'DeliveryFirstName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('DELIVERY_LAST_NAME', 'DeliveryLastName', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addForeignKey('DELIVERY_COUNTRY_ID', 'DeliveryCountryId', 'int', CreoleTypes::INTEGER, 'country', 'ID', false, null);

		$tMap->addForeignKey('DELIVERY_STATE_ID', 'DeliveryStateId', 'int', CreoleTypes::INTEGER, 'state', 'ID', false, null);

		$tMap->addColumn('DELIVERY_STATE_TITLE', 'DeliveryStateTitle', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('DELIVERY_CITY', 'DeliveryCity', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('DELIVERY_STREET', 'DeliveryStreet', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('DELIVERY_POSTCODE', 'DeliveryPostcode', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('DELIVERY_COST', 'DeliveryCost', 'double', CreoleTypes::DECIMAL, false, 10);

		$tMap->addColumn('DELIVERY_DESCRIPTION', 'DeliveryDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, 'order_status', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 