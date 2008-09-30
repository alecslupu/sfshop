<?php
/**
 * 
 *
 * @package    symfony
 * @subpackage plugin.sfsCorePlugin.widget
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: sfsWidgetFormSchemaFormatterList.class.php 5995 2007-11-13 15:50:03Z fabien $
 */
class sfsWidgetFormSchemaFormatterList extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<li>%error%</li>\n<li>\n %label%\n %field%%help%\n%hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<span class="help" style="display: none">%help%</span>',
    $decoratorFormat = "<ul>\n %content%</ul>";
}
