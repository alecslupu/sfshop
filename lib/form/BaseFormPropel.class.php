<?php

/**
 * Project form base class.
 *
 * @package    form
 * @version    SVN: $Id: sfPropelFormBaseTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class BaseFormPropel extends sfFormPropel
{
    
   /**
    * Define error
    *
    * @author Dmitry Nesteruk, Andrey Kotlyarov
    * @param string $fieldName
    * @param string $message
    * @return void
    */
    public function defineError($fieldName, $message)
    {
        $checkName = 'check_define_' . md5($fieldName);
        $this->getErrorSchema()->getValidator()->addOption($checkName);
        $this->getErrorSchema()->getValidator()->addMessage($checkName, $message);
        
        $this->getErrorSchema()->addError(
            new sfValidatorError(
                $this->getErrorSchema()->getValidator(),
                $checkName,
                array(
                    'value' => sfContext::getInstance()->getRequest()->getParameter($fieldName)
                )
            )
        );
        
    }
    
    public function defineSfsListFormatter()
    {
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
    }
    
    
    public function defineSfsAdminListFormatter()
    {
        $this->getWidgetSchema()->addFormFormatter('sfs_admin_list', new sfsWidgetFormSchemaFormatterAdminList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_admin_list');
    }
    
    public static function radioFormatter($widget, $inputs)
    {
        $rows = array();
        
        foreach ($inputs as $input)
        {
            $rows[] = array('input'=> $input['input'], 'label'=> $input['label']);
        }
        
        return $rows;
    }
    
    public function embedI18nForAllCultures()
    {
        $languages = LanguagePeer::getAllPublic();
        $cultures = array();
        
        foreach ($languages as $language) {
            $cultures[] = $language->getCulture();
        }
        
        $this->embedI18n($cultures);
        
        foreach ($languages as $language) {
            $this->getWidgetSchema()->setLabel($language->getCulture(), $language->getTitleEnglish());
        }
    }
}
