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
 * catalogAdmin actions.
 *
 * @package    sfShop
 * @subpackage catalogAdmin
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class catalogAdminActions extends sfActions
{
    public function executeList()
    {
        $this->getContext()->getConfigCache()->import('modules/categoryAdmin/config/generator.yml', false, true);
        $this->getContext()->getController()->getAction('categoryAdmin', 'list');
        
        $this->getContext()->getConfigCache()->import('modules/productAdmin/config/generator.yml', false, true);
        $this->getContext()->getController()->getAction('productAdmin', 'list');
    }
}
