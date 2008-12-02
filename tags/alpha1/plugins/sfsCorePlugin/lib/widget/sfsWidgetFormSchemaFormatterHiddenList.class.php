<?php
/**
 * 
 *
 * @package    symfony
 * @subpackage plugin.sfsCorePlugin.widget
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfsWidgetFormSchemaFormatterList.class.php 5995 2007-11-13 15:50:03Z fabien $
 */
class sfsWidgetFormSchemaFormatterHiddenList extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<li style=\"display: none\">\n %label%\n %error%\n %field%%help%\n%hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<div class="help"></div>',
    $decoratorFormat = "<ul style=\"display: none\">\n %content%</ul>";
}
