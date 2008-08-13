<?php
/**
 * sfsWidgetFormSelectRadioServicesList represents radio HTML tags.
 *
 * @package    sfShop
 * @subpackage widget
 * @author     Dmitry Nester
 */
class sfsWidgetFormSelectRadioServicesList extends sfWidgetFormSelectRadio
{

  /**
   * @param  string $name        The element name
   * @param  string $value       The value selected in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $choices = $this->getOption('choices');
    
    if ($choices instanceof sfCallable)
    {
      $choices = $choices->call();
    }
    
    $sections = array();
    
    foreach ($choices as $sectionKey => $section)
    {
      foreach ($section['choices'] as $key => $method)
      {
          $baseAttributes = array(
            'name'  => $name,
            'type'  => 'radio',
            'value' => self::escapeOnce($key),
            'id'    => $id = $this->generateId($name.'[]', self::escapeOnce($key)),
          );
          
          if (strval($key) == strval($value === false ? 0 : $value))
          {
            $baseAttributes['checked'] = 'checked';
          }
          
          $sections[$sectionKey]['inputs'][] = array(
            'input' => $this->renderTag('input', array_merge($baseAttributes, $attributes)),
            'label' => $this->renderContentTag('label', $method['title'], array('for' => $id)),
            'price'  => $method['price']
          );
       }
       
       $sections[$sectionKey]['title'] = $section['title'];
       
       if (isset($section['icon'])) {
           $sections[$sectionKey]['icon'] = $section['icon'];
       }
    }

    return call_user_func($this->getOption('formatter'), $this, $sections);
  }

  public function formatter($widget, $sections)
  {
    sfLoader::loadHelpers('sfsCurrency');
    
    $rows = array();
    foreach ($sections as $section)
    {
       $icon = '';
       
       if (isset($section['icon'])) {
           $icon = $section['icon'];
       }
       
       $rows[] = $this->renderContentTag('li', $section['title']  . '&nbsp;' . $icon, array('class' => 'row'));
       
       $subRows = array();
       
       foreach($section['inputs'] as $input)
       {
         $subRows[] = $this->renderContentTag('li', $input['label'], array('class' => 'label'));
         $subRows[] = $this->renderContentTag('li', format_currency($input['price']), array('class' => 'price'));
         $subRows[] = $this->renderContentTag('li', $input['input']);
       }
       
       $subList = $this->renderContentTag('ul', implode($this->getOption('separator'), $subRows), array('class' => 'methods_list'));
       $rows[] = $this->renderContentTag('li', $subList, array('class' => 'row'));
    }
    
    return $this->renderContentTag('ul', implode($this->getOption('separator'), $rows), array('class' => 'delivery_list'));
  }
}
