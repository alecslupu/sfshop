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
 * Member contact form.
 *
 * @package    plugin.sfsMemberPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsMemberContactForm extends MemberForm
{
    public function configure()
    {
        parent::configure();
        $this->offsetUnset('email');
        $this->offsetUnset('first_name');
        $this->offsetUnset('last_name');
    }
}