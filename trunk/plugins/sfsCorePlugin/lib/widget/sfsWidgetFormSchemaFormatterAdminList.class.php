<?php
/**
 * 
 *
 * @package    symfony
 * @subpackage plugin.sfsCorePlugin.widget
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfsWidgetFormSchemaFormatterAdminList.class.php 5995 2007-11-13 15:50:03Z fabien $
 */
class sfsWidgetFormSchemaFormatterAdminList extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<div class=\"form-row\">\n %label%\n <div class=\"content\">%error%\n %field% %help%\n</div> %hidden_fields%</div>\n",
    $helpFormat      = '<div class="sf_admin_edit_help">%help%</div>',
    $errorListFormatInARow  = "%errors%",
    $errorRowFormatInARow  = "\n<div class=\"form-error\">↓ %error% ↓</div>\n",
    $decoratorFormat = "<fieldset>\n%content%</fieldset>";
}
