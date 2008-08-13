<?php

/**
 * test actions.
 *
 * @package    sfShop
 * @subpackage test
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class testActions extends sfActions
{
    
   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex()
    {
        //
        // TEST ODFL Trace class
        //
        $t = new sfsODFLTrace();
        $t->call_getTraceData(
            array(
                'pro'  => '7',
                'type' => 'P',
            ),
            ''
        );
        
        echo "'";
        echo($t->getTraceData('proNum') === null ? 'NULL' : $t->getTraceData('proNum'));
        echo "'<br>";
        echo "'";
        echo($t->getTraceData('errorMessage') === null ? 'NULL' : $t->getTraceData('errorMessage'));
        echo "'<br>";
        
        
        
        
        //
        // TEST ODFL Rate class
        //
        $r = new sfsODFLRate();
        
        $r->call_calculateRate(
            array(
                'oZip'            => '27262',
                'oCity'           => 'High Point',
                'oState'          => 'NC',
                'oCountry'        => 'USA',
                'dZip'            => '90210',
                'dCity'           => 'Beverly Hills',
                'dState'          => 'CA',
                'dCountry'        => 'USA',
                'inboundOutbound' => 'o',
                'discountRate'    => '0',
                'user'            => 'none',
                'pWord'           => 'none',
                'account'         => 'none',
                'weights'         => array(1, 0, 0, 0, 0),
                'classes'         => array(55, 0, 0, 0, 0),
                'accessorials'    => array('n', 'n', 'n', 'n', 'n', 'n'),
                'intTerminal'     => 'none',
                'cube'            => 2,
                'currency'        => 'USD',
                'refNumber'       => 'N',
            ),
            ''
        );
        
        
        
        
        echo "'";
        echo($r->calculateRate('sippingDays') === null ? 'NULL' : $r->calculateRate('sippingDays'));
        echo "'<br>";
        echo "'";
        echo($r->calculateRate('errorCode') === null ? 'NULL' : $r->calculateRate('errorCode'));
        echo "'<br>";
        echo "'";
        echo($r->calculateRate('errorMessage') === null ? 'NULL' : $r->calculateRate('errorMessage'));
        echo "'<br>";
        echo "'";
        echo($r->calculateRate('destinationServiceCenter', 'serviceCenterCountry') === null ? 'NULL' : $r->calculateRate('destinationServiceCenter', 'serviceCenterCountry'));
        echo "'<br>";
        
        
        echo '<br /><br />' . $r->getErrorMessage(301) . '<br /><br /><br />';
        
        echo '<pre>';
        print_r($t->getTraceData());
        print_r($r->calculateRate());
        echo '</pre>';
        
        
        
        exit;
        
        
        
        return sfView::SUCCESS;
    }
    
    
    
    
    
    public function executePaypalIndex()
    {
        $total = $this->getRequestParameter('total', '2.50');
        
        $cc = new sfPaypalDirect(sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . 'paypal/php-sdk/lib');
        
        $cc->setUserName('seller_1212764623_biz_api1.inbox.ru');
        $cc->setPassword('1212764627');
        $cc->setSignature('AW5s-AZgM7K7OL1McV49qCXFbPAJAKap7DQ9nPMD5BrcqDEBrHQS7Ox7');
        $cc->setTestMode(true);
        
        $cc->setTransactionTotal($total);
        $cc->setTransactionDescription('Registration');
        
        sfLoader::loadHelpers(array('Url'));
        // URL to go to if the cancel payment
        $cc->setCancelURL(url_for('test/paypalCancel', true));
        
        // URL to verify or charge transaction
        $cc->setReturnURL(url_for('test/paypalCharge', true));
        
        // Get a Paypal URL to go to
        $goto = $cc->GetExpressUrl();
        if ($goto)
        {
            $this->redirect($goto);
        }
        else
        {
            $this->message = 'Error: ' . $cc->getErrorString();
            //return $this->renderText('Error: ' . $cc->getErrorString());
        }
        
        return sfView::SUCCESS;
    }
    
    public function executePaypalCharge()
    {
        $total = $this->getRequestParameter('total', '2.50');
        
        $cc = new sfPaypalDirect(sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . 'paypal/php-sdk/lib');
        
        $cc->setUserName('seller_1212764623_biz_api1.inbox.ru');
        $cc->setPassword('1212764627');
        $cc->setSignature('AW5s-AZgM7K7OL1McV49qCXFbPAJAKap7DQ9nPMD5BrcqDEBrHQS7Ox7');
        $cc->setTestMode(true);

        $cc->setTransactionTotal($total);
        $cc->setTransactionDescription('tracsaction description !!!!!!!!!!!!!!!!!!!!!!!');
        $cc->setTransactionCustom('tracsaction custom');
        
        $cc->setBillingFirstName('firstname');
        $cc->setBillingLastName('lastname');
        $cc->setBillingStreet1('address');
        $cc->setBillingStreet2('address2');
        $cc->setBillingCity('city');
        $cc->setBillingState('state');
        $cc->setBillingZip('zip');
        
        
        
        
        if ( $cc->chargeExpressCheckout($this->getRequestParameter('token')) )
        {
            $this->message = 'OK';
            //return $this->renderText('Charged successfully');
        }
        else
        {
            $this->message = 'Error: ' . $cc->getErrorString();
            //return $this->renderText('Error: ' . $cc->getErrorString());
        }
        
        return sfView::SUCCESS;
    }
}
