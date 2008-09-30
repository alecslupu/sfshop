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
 * Member forgot password form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsMemberForgotPasswordStepOneForm extends MemberForm
{
    public function configure()
    {
        parent::configure();
        $this->offsetUnset('first_name');
        $this->offsetUnset('last_name');
        $this->offsetUnset('primary_phone');
        $this->offsetUnset('secondary_phone');
    }
}