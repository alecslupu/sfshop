<?php
  sfConfig::set('sf_enabled_modules', array_merge(sfConfig::get('sf_enabled_modules'), array('payment')));

if (sfConfig::get('sf_app') == 'backend')
{
  sfConfig::set('sf_enabled_modules', array_merge(sfConfig::get('sf_enabled_modules'), array( 'paymentAdmin')));
}
