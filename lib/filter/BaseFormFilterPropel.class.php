<?php

/**
 * Project filter form base class.
 *
 * @package    sfShop
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseFormFilterPropel extends sfFormFilterPropel
{
    public function setup()
    {
        parent::setup();
        //$this->embedI18n(sfConfig::get('app_enabled_cultures', array('en', 'fr')));
    }

    /**
     * Builds a Propel Criteria with processed values.
     *
     * Overload this method instead of {@link buildCriteria()} to avoid running
     * {@link processValues()} multiple times.
     *
     * @param  array $values
     *
     * @return Criteria
     */
    protected function doBuildCriteria(array $values)
    {
        $criteria = new Criteria();
        $peer = constant($this->getModelName().'::PEER');

        $fields = $this->getFields();

        // add those fields that are not represented in getFields() with a null type
        $names = array_merge($fields, array_diff(array_keys($this->validatorSchema->getFields()), array_keys($fields)));
        $fields = array_merge($fields, array_combine($names, array_fill(0, count($names), null)));

        foreach ($fields as $field => $type)
        {
            if (!isset($values[$field]) || null === $values[$field] || '' === $values[$field])
            {
                continue;
            }

            try
            {
                $method = sprintf('add%sColumnCriteria', call_user_func(array($peer, 'translateFieldName'), $field, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME));
            }
            catch (Exception $e)
            {
                if( ! array_key_exists($field, $this->getFields()))
                {
                    // not a "real" column
                    if (!method_exists($this, $method = sprintf('add%sColumnCriteria', self::camelize($field))))
                    {
                        throw new LogicException(sprintf('You must define a "%s" method to be able to filter with the "%s" field.', $method, $field));
                    }
                }
                $method = '';
            }

            if (method_exists($this, $method))
            {
                $this->$method($criteria, $field, $values[$field]);
            }
            else
            {
                if (!method_exists($this, $method = sprintf('add%sCriteria', $type)))
                {
                    throw new LogicException(sprintf('Unable to filter for the "%s" type.', $type));
                }

                $this->$method($criteria, $field, $values[$field]);
            }
        }

        return $criteria;
    }

    protected function getColName($field)
    {
        $peer = constant($this->getModelName().'::PEER');
        if(array_key_exists($field, $this->getFields()) and constant($peer.'::IS_I18N'))
        {
            try {
                return call_user_func(array(constant($this->getModelName().'I18n::PEER'), 'translateFieldName'), $field, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
            }
            catch(PropelException $e)
            {
                return call_user_func(array(constant($this->getModelName().'::PEER'), 'translateFieldName'), $field, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
            }
        }
    }
}
