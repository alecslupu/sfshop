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
 * Language form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.form.common
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: LanguageForm.class.php 443 2008-12-22 22:44:53Z nesterukd $
 */
class LanguageForm extends BaseLanguageForm
{
    public function configure()
    {
        $this->offsetUnset('created_at');
        $this->offsetUnset('updated_at');
        
        $this->setWidget('title_english', new sfWidgetFormInput(array(), array('size' => 80)));
        $this->setWidget('title_own', new sfWidgetFormInput(array(), array('size' => 80)));
        
        $this->setWidget('icon', new sfWidgetFormInputFile());
        
        $cultureValidator = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 2,
                'max_length' => 7
            ),
            array(
                'required'   => 'Culture is a required field',
                'min_length' => 'Culture must be 2 or more characters',
                'max_length' => 'Culture can not be more 7 characters'
            )
        );
        
        $titleEnglishValidator = new sfValidatorString(
            array('required' => true),
            array('required' => 'Title english is a required field')
        );
        
        $titleOwnValidator = new sfValidatorString(
            array('required' => true),
            array('required' => 'Title own is a required field')
        );
        
        $iconValidator = new sfValidatorFile(
            array(
                'required' => false,
                'mime_types' => array(
                    'image/jpeg',
                    'image/pjpeg',
                    'image/png',
                    'image/x-png',
                    'image/gif'
                )
            ),
            array('mime_types' => 'Only PNG, JPEG and GIF files are allowed')
        );
        
        $this->setValidator('culture', $cultureValidator);
        $this->setValidator('title_english', $titleEnglishValidator);
        $this->setValidator('title_own', $titleOwnValidator);
        $this->setValidator('icon', $iconValidator);
    }
}
