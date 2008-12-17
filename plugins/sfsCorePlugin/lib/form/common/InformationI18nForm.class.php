<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * InformationI18n form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class InformationI18nForm extends BaseInformationI18nForm
{
    public function configure()
    {
        $this->setWidgets(array(
          'id'               => new sfWidgetFormInputHidden(),
          'culture'          => new sfWidgetFormInputHidden(),
          'title'            => new sfWidgetFormInput(array(), array('size' => 80)),
          'description'      => new sfWidgetFormTextarea(
              array(),
              array(
                  'cols'  => 110,
                  'rows'  => 20,
                  'class' => 'mce-editor'
              )),
          'meta_keywords'    => new sfWidgetFormTextarea(array(), array('cols' => 80, 'rows' => 2)),
          'meta_description' => new sfWidgetFormTextarea(array(), array('cols' => 80, 'rows' => 5)),
        ));
        
        $idValidator = new sfValidatorPropelChoice(
            array('model' => 'Information', 'column' => 'id', 'required' => false)
        );
        
        $cultureValidator = new sfValidatorPropelChoice(
            array('model' => 'InformationI18n', 'column' => 'culture', 'required' => false)
        );
        
        $titleValidator = new sfValidatorString(
            array(
                'required'   => true,
                'max_length' => 255
            ),
            array(
                'required'   => 'Title is a required field',
                'max_length' => 'Title can not be more 255 characters'
            )
        );
        
        $descriptionValidator = new sfValidatorString(
            array('required' => true),
            array('required' => 'Description is a required field')
        );
        
        $this->setValidators(array(
            'id'               => $idValidator,
            'culture'          => $cultureValidator,
            'title'            => $titleValidator,
            'description'      => $descriptionValidator,
            'meta_keywords'    => new sfValidatorString(array('required' => false)),
            'meta_description' => new sfValidatorString(array('required' => false)),
        ));
        
        $this->getWidgetSchema()->setNameFormat('information_i18n[%s]');
    }
}
