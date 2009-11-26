<?php
/**
 * 
 *
 * @package    symfony
 * @subpackage plugin.sfsCorePlugin.widget
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id$
 */
class sfsWidgetFormSchemaFormatterList extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat              = "%error%\n<li>\n<div class=\"label\">%label%</div>\n<div class=\"field\"> %field%%help%</div>\n%hidden_fields%</li>\n",
    $errorRowFormat         = "<li>\n%errors%</li>\n",
    $helpFormat             = "<span class=\"help\" style=\"display: none\">%help%</span>",
    $errorListFormatInARow  = "<ul class=\"error\">\n%errors%</ul>\n",
    $decoratorFormat        = "<ul>\n %content%</ul>";
}
