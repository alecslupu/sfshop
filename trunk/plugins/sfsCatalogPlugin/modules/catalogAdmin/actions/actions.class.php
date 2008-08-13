<?php

/**
 * catalogAdmin actions.
 *
 * @package    sfShop
 * @subpackage catalogAdmin
 * @author     Your name here
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
