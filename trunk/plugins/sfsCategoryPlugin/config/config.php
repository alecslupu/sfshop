<?php
if (sfConfig::get('sf_app') == 'frontend')
{
  sfConfig::set('sf_enabled_modules', array_merge(sfConfig::get('sf_enabled_modules'), array('category')));
}
else
if (sfConfig::get('sf_app') == 'backend')
{
  sfConfig::set('sf_enabled_modules', array_merge(sfConfig::get('sf_enabled_modules'), array('categoryAdmin')));
}
