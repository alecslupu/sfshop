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
 * Base core actions.
 *
 * @package    plugin.sfsCorePlugin
 * @subpackage modules.core
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BaseCoreActions extends sfActions
{
    
   /**
    * Action for 404 error (Page not found).
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeError404()
    {
        return sfView::SUCCESS;
    }
    
   /**
    * Action for 500 error (Server inernal error).
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function executeError500()
    {
        return sfView::SUCCESS;
    }
    
}
