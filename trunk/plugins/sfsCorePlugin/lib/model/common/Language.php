<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Subclass for representing a row from the 'languages' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class Language extends BaseLanguage
{
   /**
    * Gets path to icon on a filesystem.
    * 
    * @param  void
    * @return string
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function getIconPath()
    {
        return sfConfig::get('sf_web_dir') 
            . '/images/' . sfConfig::get('app_languages_images_dir') . '/' 
            . strtolower(str_replace(' ', '', $this->getTitleEnglish())) 
            . '/icon.png';
    }
    
   /**
    * Gets url to icon for web.
    * 
    * @param  void
    * @return string
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function getIconUrl()
    {
        return '/images/' . sfConfig::get('app_languages_images_dir') . '/' 
            . strtolower(str_replace(' ', '', $this->getTitleEnglish())) 
            . '/icon.png';
    }
}
