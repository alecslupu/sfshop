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

$con = Propel::getConnection();

$thumbnails = sfsThumbnailPeer::getUnconverted();

if ($thumbnails !== null) {
    
    $baseDir = sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_thumbnails_dir');
    
    foreach ($thumbnails as $thumbnail) {
        $originalThumbnail = sfsThumbnailPeer::retrieveByPK($thumbnail->getParentId());
        
        $origDir = $baseDir 
            . DIRECTORY_SEPARATOR 
            . sfConfig::get('app_thumbnails_original_dir_name') 
            . DIRECTORY_SEPARATOR 
            . $originalThumbnail->getPath() 
            . DIRECTORY_SEPARATOR;
        
        $originalFile = $origDir . $originalThumbnail->getUuid() . '.' . $thumbnail->getExtension();
        
        $thumbDir = $baseDir 
            . DIRECTORY_SEPARATOR 
            . sfConfig::get('app_thumbnails_converted_dir_name') 
            . DIRECTORY_SEPARATOR 
            . $thumbnail->getPath() 
            . DIRECTORY_SEPARATOR;
            
        $thumbFile = $thumbDir . $thumbnail->getUuid() . '.' . $thumbnail->getExtension();
        
        if (!is_dir($pathToThumbs)) {
            sfsThumbnailUtil::mkdirTree($thumbDir);
        }
        
        $thumbnail->setIsConverted(1);
        $thumbnail->save();
        
        $thumb = new sfThumbnail($thumbnail->getWidth(), $thumbnail->getHeight(), true, true, 75, 'sfGDAdapter');
        $thumb->loadFile($originalFile);
        $thumb->save($thumbFile, $thumbnail->getMime());
    }
}
