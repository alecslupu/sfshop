<?php

/**
 * TaxGroup form.
 *
 * @package    form
 * @subpackage tax_group
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TaxGroupForm extends BaseTaxGroupForm
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
