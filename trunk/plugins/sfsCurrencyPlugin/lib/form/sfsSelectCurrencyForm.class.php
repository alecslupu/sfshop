<?php

/**
 * sfsSelectCurrencyForm form.
 *
 * @package    form
 * @subpackage currencies
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsSelectCurrencyForm extends BaseCurrencyForm
{
    public function configure()
    {
        parent::configure();
        
        $criteria = new Criteria();
        CurrencyPeer::addPublicCriteria($criteria);
        $arrayCurrencies = CurrencyPeer::getHash($criteria);
        
        $this->setWidgets(
            array('id' => new sfWidgetFormSelect(array('choices' => $arrayCurrencies), array('onchange' => 'this.form.submit()')))
        );
        
        $this->widgetSchema->setLabel('id', 'Currency');
        
        $validatorCurrencyId = new sfValidatorChoice(
            array('choices' => $arrayCurrencies)
        );
        
        $this->setValidators(array('id' => $validatorCurrencyId));
        $this->getWidgetSchema()->setNameFormat('currency[%s]');
        $this->defineSfsListFormatter();
    }
}
