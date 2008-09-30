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
 * Member components.
 *
 * @package    plugins.sfsMemberPlugin
 * @subpackage modules.member
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class memberComponents extends sfComponents
{
   /**
    * Form for set contact info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeContactForm()
    {
        $this->form = new sfsContactForm();
        
        $this->member = $this->getUser()->getUser();
        
        $this->form->setDefaults(
            array(
                'phone'   => $this->member->getPhone(),
                'mobile'  => $this->member->getMobile()
            )
        );
    }
    
   /**
    * Contact info.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk <nest@dev-zp.com>
    * @access public
    */
    public function executeContactInfo()
    {
        $this->member = $this->getUser()->getUser();
        
        $this->info = array(
            'phone'  => $this->member->getPhone(),
            'mobile' => $this->member->getMobile()
        );
    }
}
