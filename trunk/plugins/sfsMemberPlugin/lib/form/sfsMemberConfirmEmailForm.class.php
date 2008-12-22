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
 * Member confirm email form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsMemberConfirmEmailForm extends MemberForm
{
    public function configure()
    {
        parent::configure();
        $this->setWidgets(array('confirm_code' => new sfWidgetFormInput()));
        
        $validatorConfirmCode= new sfValidatorString(
            array('required' => true),
            array('required'  => 'Confirm code is a required field')
        );
        
        $this->setValidators(array('confirm_code' => $validatorConfirmCode));
        $this->defineSfsListFormatter();
    }
}