<?php

/**
 * productAdmin module helper.
 *
 * @package    sfShop
 * @subpackage productAdmin
 * @author     Your name here
 * @version    SVN: $Id: helper.php 12474 2008-10-31 10:41:27Z fabien $
 */
class productAdminGeneratorHelper extends BaseProductAdminGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'product' : 'product_'.$action;
  }    
}
