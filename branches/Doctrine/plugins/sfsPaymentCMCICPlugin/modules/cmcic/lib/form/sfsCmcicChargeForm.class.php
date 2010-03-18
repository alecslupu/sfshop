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
 * The form for do request to webmoney service.
 *
 * @package    plugins.sfsPaymentCmcicPlugin
 * @subpackage modules.cmcic.lib
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfsWebmoneyChargeForm.class.php 450 2008-12-23 22:08:43Z nesterukd $
 */
class sfsCmcicChargeForm extends sfForm
{
    public function configure()
    {
        
    	
        $this->setWidgets(
            array(
                'version' 			=> new sfWidgetFormInputHidden(),
                'TPE'   			=> new sfWidgetFormInputHidden(),
                'date'    			=> new sfWidgetFormInputHidden(),
                'montant'       	=> new sfWidgetFormInputHidden(),
                'reference'     	=> new sfWidgetFormInputHidden(),
                'MAC'   	 		=> new sfWidgetFormInputHidden(),
                'url_retour'    	=> new sfWidgetFormInputHidden(),
                'url_retour_ok' 	=> new sfWidgetFormInputHidden(),
	            'url_retour_err'    => new sfWidgetFormInputHidden(),
            	'lgue'				=> new sfWidgetFormInputHidden(),
            	'societe'			=> new sfWidgetFormInputHidden(),
            	'texte-libre'		=> new sfWidgetFormInputHidden()
             )
        );
    	    	     
        parent::configure();
    }
}