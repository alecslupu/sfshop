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
 * Base memberAdmin actions.
 *
 * @package    plugins.sfsMemberPlugin
 * @subpackage modules.memberAdmin.lib
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseMemberAdminActions extends automemberAdminActions
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
        $criteria->add(MemberPeer::ID, $ids, Criteria::IN);
        
        $members = MemberPeer::getAll($criteria);
        
        foreach ($members as $member) {
            $member->setIsDeleted(true);
            $member->save();
        }
        
        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        
        $this->redirect('@memberAdmin');
    }
}
