<?php

/**
 * OptionValue filter form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
class OptionValueFormFilter extends BaseOptionValueFormFilter
{
    public function configure()
    {
        $widgetTypeId = new sfWidgetFormPropelChoice(
            array(
                'model'        => 'OptionType',
                'peer_method'  => 'getAll',
                'add_empty'    => true
            )
        );
        
        $this->setWidget('type_id', $widgetTypeId);
    }
}
