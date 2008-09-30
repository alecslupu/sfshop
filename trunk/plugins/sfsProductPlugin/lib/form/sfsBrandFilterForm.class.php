<?php

/**
 * Brand form.
 *
 * @package    form
 * @subpackage brand
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsBrandFilterForm extends BrandForm
{
    public function configure()
    {
        $brands = BrandPeer::getAll();
        
        if ($brands) {
            $arrayBrands = array();
            
            foreach($brands as $brand) {
                $arrayBrands[$brand->getId()] = $brand->getTitle();
            }
        }
        
        $this->setWidgets(
            array(
                'brand_id'   => new sfWidgetFormSelect(array('choices' => $arrayBrands))
             )
        );
        
        $validatorBrandId = new sfValidatorInteger(
            array(
                'required' => false
            )
        );
        
        $this->setValidators(
            array(
               'brand_id'   => $validatorBrandId
            )
        );
        
        $this->defineSfsListFormatter();
    }
}
