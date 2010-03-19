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
 * @version    SVN: $Id: EmailTemplateForm.class.php 457 2008-12-24 10:54:22Z nesterukd $
 */
class EmailTemplateForm extends BaseEmailTemplateForm
{
    public function configure()
    {
        parent::configure();
        
        $this->offsetUnset('name');
        
        $this->embedI18nForAllCultures();
    }
}
