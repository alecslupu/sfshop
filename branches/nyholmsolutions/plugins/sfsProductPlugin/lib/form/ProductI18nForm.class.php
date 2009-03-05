<?php

/**
 * ProductI18n form.
 *
 * @package    form
 * @subpackage products_i18n
 * @version    SVN: $Id$
 */
class ProductI18nForm extends BaseProductI18nForm
{
  public function configure()
  {
      $this->widgetSchema['description'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 110,
              'rows'  => 12,
              'class' => 'mce-editor'
            )
        );
      $this->widgetSchema['description_short'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 60,
              'rows'  => 5
            )
        );
      $this->widgetSchema['meta_keywords'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 110,
              'rows'  => 1
            )
        );
      $this->widgetSchema['meta_description'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 110,
              'rows'  => 1
            )
        );
        
  }
}
