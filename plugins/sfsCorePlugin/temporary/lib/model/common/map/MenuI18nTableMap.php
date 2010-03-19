<?php


/**
 * This class defines the structure of the 'menu_i18n' table.
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
class MenuI18nTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfsCorePlugin.lib.model.common.map.MenuI18nTableMap';

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
		$this->setName('menu_i18n');
		$this->setPhpName('MenuI18n');
		$this->setClassname('MenuI18n');
		$this->setPackage('plugins.sfsCorePlugin.lib.model.common');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'menu', 'ID', true, null, null);
		$this->addPrimaryKey('CULTURE', 'Culture', 'VARCHAR', true, 7, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, null);
		$this->addColumn('META_KEYWORDS', 'MetaKeywords', 'LONGVARCHAR', false, null, null);
		$this->addColumn('META_DESCRIPTION', 'MetaDescription', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Menu', 'Menu', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', 'CASCADE');
	} // buildRelations()

} // MenuI18nTableMap
