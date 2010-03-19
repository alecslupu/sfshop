<?php

/**
 * Country form.
 *
 * @package    form
 * @subpackage countries
 * @version    SVN: $Id: CountryForm.class.php 515 2009-03-16 01:27:14Z nyholmsolutions $
 */
class CountryForm extends BaseCountryForm
{
  public function configure()
  {
        $this->embedI18nForAllCultures();
      
  }
}
