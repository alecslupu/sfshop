#!/usr/bin/env php
<?php

/**
 *  batch script
 *
 * Script for convertation thumbnails.
 *
 * @package    sfShop
 * @subpackage batch
 * @version    $Id$
 */

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
sfContext::createInstance($configuration);

$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->loadConfiguration();

sfsThumbnailUtil::convert();
