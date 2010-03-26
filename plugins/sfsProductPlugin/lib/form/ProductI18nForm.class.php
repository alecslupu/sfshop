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
      unset($this['id'], $this['culture']);
      
      $this->widgetSchema['description'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 100,
              'rows'  => 12,
              'class' => 'mce-editor'
            )
        );
      $this->widgetSchema['description_short'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 100,
              'rows'  => 5
            )
        );
      $this->widgetSchema['meta_keywords'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 100,
              'rows'  => 1
            )
        );
      $this->widgetSchema['meta_description'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 100,
              'rows'  => 1
            )
        );
    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Product', 'column' => 'id', 'required' => false)),
      'culture'           => new sfValidatorPropelChoice(array('model' => 'ProductI18n', 'column' => 'culture', 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 255, 'required' => true)),
      'description_short' => new sfValidatorString(array('required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
      'meta_keywords'     => new sfValidatorString(array('required' => false)),
      'meta_description'  => new sfValidatorString(array('required' => false)),
      'noscript'          => new sfValidatorString(array('required' => false)),
    ));
  }
}
