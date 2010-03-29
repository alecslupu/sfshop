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
 * Brand form.
 *
 * @package    plugin.sfsProductPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BrandForm extends BaseBrandForm
{
    public function configure()
    {
        $this->setWidget('url', new sfWidgetFormInput(array(), array('size' => 80)));
        
        $this->setValidator('url', new sfValidatorUrl(
            array('required' => false),
            array('invalid'  => 'This is not a valid url')
        ));
        
        $this->embedThumbnailForm();
        $this->embedI18nForAllCultures();
    }
    
    public function save($con = null)
    {
        $this->preSaveThumbnail();
        
        parent::save($con);
        
        $this->postSaveThumbnail();
        
        return $this->getObject();
    }
}
