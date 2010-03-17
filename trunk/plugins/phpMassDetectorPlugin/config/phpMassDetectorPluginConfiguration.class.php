<?php

if (strpos('@package_version@', '@package_version') === 0) {
    set_include_path(
        dirname(__FILE__) . '/../lib/vendor/pmd/source' .
        PATH_SEPARATOR .
        dirname(__FILE__) . '/../lib/vendor/pmd/lib/pdepend' .
        PATH_SEPARATOR .
        '.'
    );
}
class phpMassDetectorPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
  }
}