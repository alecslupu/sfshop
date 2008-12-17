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
 * EmailTemplateForm form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.form.common
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class EmailTemplateForm extends BaseEmailTemplateForm
{
    public function configure()
    {
        parent::configure();
        
        $this->offsetUnset('name');
        $this->offsetUnset('created_at');
        $this->offsetUnset('updated_at');
        
        $this->embedI18n(sfContext::getInstance()->getUser()->getCultures());
    }
}
