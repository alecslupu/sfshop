<?php
/**
 * sfsWidgetFormSelectRadioServicesList represents radio HTML tags.
 *
 * @package    sfShop
 * @subpackage widget
 * @author     Dmitry Nester
 */
class sfsWidgetFormSelectRadioPaymentList extends sfWidgetFormSelectRadio
{
  public function formatter($widget, $inputs)
  {
    $rows = array();
    
    foreach ($inputs as $input) {
        $subRows = array();
        
        $subRows[] = $this->renderContentTag('li', $input['label'], array('class' => 'label'));
        $subRows[] = $this->renderContentTag('li', $input['input']);
        $subList = $this->renderContentTag('ul', implode($this->getOption('separator'), $subRows), array('class' => 'methods_list'));
        
        $rows[] = $this->renderContentTag('li', $subList, array('class' => 'row'));
    }
    
    return $this->renderContentTag('ul', implode($this->getOption('separator'), $rows), array('class' => 'radio_list'));
  }
}
