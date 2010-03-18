<?php
if (sfConfig::get('sf_app') == 'frontend')
{
  sfConfig::set('sf_enabled_modules', array_merge(sfConfig::get('sf_enabled_modules'), array('brand', 'product')));
}else
if (sfConfig::get('sf_app') == 'backend')
{
  sfConfig::set('sf_enabled_modules', array_merge(sfConfig::get('sf_enabled_modules'), array('brandAdmin', 'product', 'optionTypeAdmin', 'optionValueAdmin','productAdmin')));
}