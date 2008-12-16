<?php

/**
 * Information form.
 *
 * @package    form
 * @subpackage information
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class InformationForm extends BaseInformationForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'is_active'  => new sfWidgetFormInputCheckbox(),
            'is_deleted' => new sfWidgetFormInputCheckbox()
        ));
        
        $this->embedI18n(sfContext::getInstance()->getUser()->getCultures());
        
    }
}
