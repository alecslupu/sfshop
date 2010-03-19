<?php
/**
 * 
 *
 * @package    symfony
 * @subpackage plugin.sfsCorePlugin.widget
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfsWidgetFormSchemaFormatterHiddenList.class.php 441 2008-12-22 21:53:14Z nesterukd $
 */
class sfsWidgetFormSchemaFormatterHiddenList extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<li style=\"display: none\">\n %label%\n %error%\n %field%%help%\n%hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<div class="help"></div>',
    $decoratorFormat = "<ul style=\"display: none\">\n %content%</ul>";
}
