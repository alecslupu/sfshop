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
 * InformationForm form.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage lib.form.common
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: InformationForm.class.php 454 2008-12-24 10:33:52Z nesterukd $
 */
class InformationForm extends BaseInformationForm
{
    public function configure()
    {
        parent::configure();
        
        $this->offsetUnset('created_at');
        $this->offsetUnset('updated_at');
        
        $this->embedI18nForAllCultures();
    }
}
