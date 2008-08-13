<?php

/**
 * category actions.
 *
 * @package    plugins.sfsCategoryPlugin.modules
 * @subpackage categories
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class categoryActions extends sfActions
{
    /**
     * Executes index action
     *
     */
    public function executeIndex()
    {
        $this->forward('default', 'module');
    }
}
