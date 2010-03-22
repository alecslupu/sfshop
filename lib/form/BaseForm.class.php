<?php

/**
 * Base project form.
 *
 * @package    sfShop
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony
{
    public function setup() {

        parent::setup();
        
        $this->handleSpecialWidgets();

        $this->getEventDispatcher()->connect('form.post_configure', array($this, 'listenToPostConfigure'));
    }

    public function getErrors()
    {
        $errors = array();
        foreach ($this as $form_field)
        {
            if ($form_field->hasError())
            {
                $error_obj = $form_field->getError();
                if ($error_obj instanceof sfValidatorErrorSchema)
                {
                    foreach ($error_obj->getErrors() as $error)
                    {
                        $errors[$form_field->getName()] = $error->getMessage();
                    }
                }
                else
                {
                    $errors[$form_field->getName()] = $error_obj->getMessage();
                }
            }
        }
        foreach ($this->getGlobalErrors() as $validator_error)
        {
            $errors[] = $validator_error->getMessage();
        }
        return $errors;
    }

    /**
     * Sets a value for a form field.
     *
     * @param string $field   The field name
     * @param mixed  $value   The default value
     */
    public function setValue($field, $value){
        if(!in_array($field, array_keys($this->values)))
        {
            throw new sfException(sprintf('Unkown field" "%s" in "%s" object.', $field, get_class($this)));
        }
        $this->values[$field] = $value;
    }

    public function listenToPostConfigure(sfEvent $sevent) {
        foreach ($this->getJavascripts() as $file)
        {
            sfContext::getInstance()->getResponse()->addJavascript($file);
        }
        foreach ($this->getStylesheets() as $file => $options)
        {
            sfContext::getInstance()->getResponse()->addStylesheet($file, '', array($options));
        }
    }

    protected function handleSpecialWidgets()
    {
        foreach($this->getWidgetSchema()->getFields() as $name => $widget) {
            if($widget->hasOption('with_empty')) {
                $widget->setOption('with_empty', false);
            }
            if(get_class($widget) == 'sfWidgetFormFilterDate') {
                $this->setWidget($name, new sfWidgetFormFilterDate(array(
                    'template' => ' Du %from_date%<br />Au %to_date%',
                    'from_date' => new sfWidgetFormCalendarInputDate(array(
                        'format' => 'd/m/Y',
                        'daFormat' => '%d/%m/%Y',
                        'ifFormat' => '%Y-%m-%d',
                        'culture' => 'fr',
                )),
                    'to_date' => new sfWidgetFormCalendarInputDate(array(
                        'format' => 'd/m/Y',
                        'daFormat' => '%d/%m/%Y',
                        'ifFormat' => '%Y-%m-%d',
                        'culture' => 'fr',
                )),
                    'with_empty' => false
                )));
            }
            if(get_class($widget) == 'sfWidgetFormDate') {
                $this->setWidget($name, new sfWidgetFormCalendarInputDate(array(
                    'format' => 'd/m/Y',
                    'daFormat' => '%d/%m/%Y',
                    'ifFormat' => '%Y-%m-%d',
                    'culture' => 'fr',
                )));
            }
            if(get_class($widget) == 'sfWidgetFormDateTime') {
                $this->setWidget($name, new sfWidgetFormCalendarInputDate(array(
                    'format' => 'd/m/Y',
                    'daFormat' => '%d/%m/%Y %H:%M:%S',
                    'ifFormat' => '%Y-%m-%d %H:%M:%S',
                    'culture' => 'fr',
                    'with_time' => true
                )));
            }
            if(get_class($widget) == 'sfWidgetFormChoice') {
                if(in_array('yes or no', $widget->getOption('choices', array())))
                {
                    $widget->setOption('choices', array('' => '', 1 => 'oui', 0 => 'non'));
                }
            }
        }
    }
}
