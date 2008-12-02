<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * OptionTypeAdmin actions.
 *
 * @package    plugins.sfsProductPlugin
 * @subpackage modules.optionTypeAdmin
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class BaseOptionTypeAdminActions extends autooptionTypeAdminActions
{
    public function executeDelete()
    {
        if ($this->hasRequestParameter('id')) {
            $option = OptionTypePeer::retrieveByPK($this->getRequestParameter('id'));
            $this->forward404Unless($option);
            
            $option->setIsDeleted(1);
            $option->save();
            
            $this->redirect('optionTypeAdmin/list');
        }
    }
    
    public function executeValuesList()
    {
        sfLoader::loadHelpers('Url');
        $this->redirect(url_for('optionValueAdmin/list', true) . '?filters[type_id]=' . $this->getRequestParameter('id') . '&filter=filter');
    }
    
    protected function addFiltersCriteria($c)
    {
        parent::addFiltersCriteria($c);
    }
}
