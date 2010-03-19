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
 * 
 *
 * @package    symfony
 * @subpackage plugin.sfsCorePlugin.widget
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfsWidgetFormSchemaFormatterAdminList.class.php 444 2008-12-22 22:56:18Z nesterukd $
 */
class sfsWidgetFormSchemaFormatterAdminList extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat              = "<div class=\"sf_admin_form_row sf_admin_text sf_admin_form_field\">\n %error%\n <div>%label% %field%</div> %hidden_fields%</div>\n",
    $errorRowFormat         = "\n%errors%\n",
    $errorListFormatInARow  = "<ul class=\"error\">\n%errors%</ul>\n",
    $decoratorFormat        = "\n%content%";
}
