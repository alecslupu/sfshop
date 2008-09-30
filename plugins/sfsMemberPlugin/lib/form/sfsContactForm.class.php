<?php
/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Member contact form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsContactForm extends MemberForm
{
    public function configure()
    {
        
        $this->setWidgets(
            array(
                'phone'   => new sfWidgetFormInput(),
                'mobile'  => new sfWidgetFormInput()
             )
        );
        
        $this->getWidgetSchema()->setHelps(
            array(
                'phone' => ''
            )
        );
        
        $validatorPhone = new sfValidatorAnd(
            array(
                new sfValidatorRegex(
                    array(
                        'required' => false,
                        'pattern'  => '/^[0-9()]{1,}$/i'
                    ),
                    array('invalid'  => 'Phone number must contain only numerals and "()" symbols')
                ),
                new sfValidatorString(
                    array(
                        'required'   => false,
                        'min_length' => 4
                    ),
                    array(
                        'min_length' => 'Phone number can not be less 4 numerals'
                    )
                )
            ),
            array('required' => true),
            array('required' => 'Please enter a phone number')
        );
        
        $validatorMobile = new sfValidatorAnd(
            array(
                new sfValidatorRegex(
                    array(
                        'required' => false,
                        'pattern'  => '/^[0-9()]{1,}$/i'
                    ),
                    array('invalid'  => 'Mobile phone number must contain only numerals and "()" symbols')
                ),
                new sfValidatorString(
                    array(
                        'min_length' => 11,
                        'max_length' => 15
                    ),
                    array(
                        'min_length' => 'Mobile phone number can not be less 11 characters',
                        'max_length' => 'Mobile phone number can not be more 15 characters',
                    )
                )
            ),
            array('required' => false)
        );
        
        $this->setValidators(
            array(
               'phone'   => $validatorPhone,
               'mobile'  => $validatorMobile
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        
        parent::configure();
    }
}