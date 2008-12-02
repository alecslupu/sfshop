<?php



class MemberSecretQuestionI18nMapBuilder {

	
	const CLASS_NAME = 'plugins.sfsMemberPlugin.lib.model.map.MemberSecretQuestionI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('member_secret_question_i18n');
		$tMap->setPhpName('MemberSecretQuestionI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'member_secret_question', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addColumn('QUESTION', 'Question', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 