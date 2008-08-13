<?php

/**
 * sfsProductFilter form.
 *
 * @package    form
 * @subpackage products
 * @author Dmitry Nesteruk
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsProductFilterForm extends ProductForm
{
  public function configure()
  {
        $this->setWidgets(
            array(
             )
        );
        
        $this->setValidators(
            array(
            )
        );
        
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
        $this->getWidgetSchema()->setNameFormat('filter[%s]');
  }
}
