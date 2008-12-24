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
 * OptionTypeAdmin actions.
 *
 * @package    plugins.sfsProductPlugin
 * @subpackage modules.optionTypeAdmin
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseOptionTypeAdminActions extends autooptionTypeAdminActions
{
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();
        
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        
        $this->getRoute()->getObject()->setIsDeleted(true);
        $this->getRoute()->getObject()->save();
        
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@memberAdmin');
    }
    
    protected function executeBatchDelete(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        
        $criteria = new Criteria();
        $criteria->add(OptionTypePeer::ID, $ids, Criteria::IN);
        
        $optionTypes = OptionTypePeer::getAll($criteria);
        
        foreach ($optionTypes as $optionType) {
            $optionType->setIsDeleted(true);
            $optionType->save();
        }
        
        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        
        $this->redirect('@memberAdmin');
    }
    
    public function executeValuesList()
    {
        sfLoader::loadHelpers('Url');
        $this->redirect(url_for('optionValueAdmin/list', true) . '?filters[type_id]=' . $this->getRequestParameter('id') . '&filter=filter');
    }
}
