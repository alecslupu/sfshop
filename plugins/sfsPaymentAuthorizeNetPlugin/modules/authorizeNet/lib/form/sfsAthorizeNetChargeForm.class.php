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
 * The form for do request to webmoney service.
 *
 * @package    plugins.sfsPaymentAuthorizeNetPlugin
 * @subpackage modules.authorizeNet.lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class sfsAuthorizeNetChargeForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'card_number'     => new sfWidgetFormInput(),
                'card_code'       => new sfWidgetFormInput(),
                'card_expire'     => new sfWidgetFormDate(array('format' => '%month%%year%'))
             )
        );
        
        $this->setLabels(array(
            'card_number' => 'Credit card number',
            'card_code'   => 'CCV2',
            'card_expire' => 'Expiration Date'
        ));
        
        $validatorCardNumber = new sfValidatorAnd(
            array(
                new sfValidatorString(
                    array(
                        'min_length' => 12,
                        'max_length' => 16
                    ),
                    array(
                        'min_length' => 'Credit card number is incorrect',
                        'max_length' => 'Credit card number is incorrect'
                    )
                ),
                new sfValidatorRegex(
                    array(
                        'required' => false,
                        'pattern'  => '/^[0-9]{1,}$/i'
                    ),
                    array('invalid'  => 'Credit card number is incorrect')
                )
            ),
            array('required' => true),
            array('required' => 'Credit card number is a required field')
        );
        
        $validatorCardCode = new sfValidatorAnd(
            array(
                new sfValidatorString(
                    array(
                        'min_length' => 3,
                        'max_length' => 5
                    ),
                    array(
                        'min_length' => 'CCV2 security code is incorrect',
                        'max_length' => 'CCV2 security code is incorrect'
                    )
                ),
                new sfValidatorNumber(
                    array('required'  => true),
                    array('invalid'   => 'CCV2 security code is incorrect')
                )
            ),
            array('required' => true),
            array('required' => 'CCV2 security code is a required field')
        );
        
        $validatorCardExpire = new sfValidatorDate(
            array(
                'min'         => time() + 86400,
                'date_format' => '%month%%year%'
            ),
            array(
                'min'  => 'Credit card has expired'
            )
        );
        
        $this->setValidators(
            array(
               'card_number'  => $validatorCardNumber,
               'card_code'    => $validatorCardCode,
               'card_expire'  => $validatorCardExpire
            )
        );
        
        $this->getWidgetSchema()->addFormFormatter('sfs_list', new sfsWidgetFormSchemaFormatterList($this->getWidgetSchema()));
        $this->getWidgetSchema()->setFormFormatterName('sfs_list');
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        
        parent::configure();
    }
}