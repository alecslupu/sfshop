<?php

if (sfConfig::get('sf_app') == 'backend') {
    $enabledModules = sfConfig::get('sf_enabled_modules');
    $enabledModules = array_merge($enabledModules, array(
      'administrationAdmin',
      'countryAdmin',
      'emailTemplateAdmin',
      'coreAdmin',
      'stateAdmin',
      'languageAdmin',
      'informationAdmin'));
    sfConfig::set('sf_enabled_modules', $enabledModules);
} 

if (sfConfig::get('sf_app') == 'frontend')
{
  sfConfig::set('sf_enabled_modules', array_merge(sfConfig::get('sf_enabled_modules'), array('information','core','menu')));
}
