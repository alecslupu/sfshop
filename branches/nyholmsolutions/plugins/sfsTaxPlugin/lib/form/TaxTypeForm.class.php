<?php

/**
 * TaxType form.
 *
 * @package    form
 * @subpackage tax_type
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TaxTypeForm extends BaseTaxTypeForm
{
  public function configure()
  {
      unset( 
        $this['id'],
        $this['updated_at'],
        $this['created_at']
      );
      
      $this->embedI18nForAllCultures();
  }
}
