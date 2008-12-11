<?php

if (sfConfig::get('sf_app') == 'backend') {
    $enabledModules = sfConfig::get('sf_enabled_modules');
    $enabledModules = array_merge($enabledModules, array('languageAdmin', 'informationAdmin'));
    sfConfig::set('sf_enabled_modules', $enabledModules);
}
