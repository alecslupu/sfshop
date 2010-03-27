<?php

require_once dirname(__FILE__) . '/../../../unit.php';

$t = new lime_test(2);

sfConfig::set('app_languages_images_dir', 'languages');

$test_object = new sfsLanguage();
$test_object->setTitleOwn('test');
$test_object->setCulture('en');

$t->is($test_object->getIconUrl(), 'languages/en.png', '->getIconUrl() return expected value');
$t->is($test_object->getTitle(), 'test', '->getTitle() return expected value');
