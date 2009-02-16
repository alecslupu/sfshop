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
 * Member components.
 *
 * @package    plugins.sfsMemberPlugin
 * @subpackage modules.member
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class BaseMemberComponents extends sfComponents
{
   /**
    * Form for set contact info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nesterukd@gmail.com>
    * @access public
    */
    public function executeContactForm()
    {
        $this->member = $this->getUser()->getUser();
        $this->form = new sfsMemberContactForm($this->member);
    }
    
   /**
    * Contact info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk, Andreas Nyholm
    * @access public
    */
    public function executeContactInfo()
    {
        if(!$this->contactInfo) {
            $this->member = $this->getUser()->getUser();
            
            $this->contactInfo = array(
                'email'            => $this->member->getEmail(),
                'primary_phone'    => $this->member->getPrimaryPhone(),
                'secondary_phone'  => $this->member->getSecondaryPhone()
            );
        }
    }
}
