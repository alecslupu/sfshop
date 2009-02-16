<?php

/**
 * default actions.
 *
 * @package    sfShop
 * @subpackage default
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class defaultActions extends sfActions
{
    public function executeIndex()
    {
        return sfView::SUCCESS;
    }
}
