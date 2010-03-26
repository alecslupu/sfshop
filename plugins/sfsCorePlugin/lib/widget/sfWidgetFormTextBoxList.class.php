<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormJQueryDate represents a date widget rendered by DHTML Calendar.
 *
 *
 * @package    symfony
 * @subpackage widget
 * @author     Florain Klein (2le) <florian@2le.net>
 * @version    SVN: $Id: sfWidgetFormCalendarInputDate.class.php 12875 2008-11-10 12:22:33Z florian $
 */
class sfWidgetFormTextBoxList extends sfWidgetFormInput
{
    /**
     * Configures the current widget.
     *
     * Available options:
     *
     *  * image:   The image path to represent the widget (false by default)
     *  * config:  A JavaScript array that configures the JQuery date widget
     *  * culture: The user culture
     *
     * @param array $options     An array of options
     * @param array $attributes  An array of default HTML attributes
     *
     * @see sfWidgetForm
     */
    protected function configure($options = array(), $attributes = array())
    {
        $this->addOption('config', '{}');
        $this->addOption('help', 'Type a string here...');
        $this->addRequiredOption('url');
        $this->addRequiredOption('model');
        parent::configure($options, $attributes);
    }
    
    public function getJavascripts()
    {
        return array(
            '/sfsCorePlugin/js/textboxlist/textboxlist'
        );
    }
    
    public function getStylesheets()
    {
        return array(
            '/sfsCorePlugin/css/textboxlist/test' => 'all',
        );
    }
    
    /**
     * @param  string $name        The element name
     * @param  string $value       The date displayed in this widget
     * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
     * @param  array  $errors      An array of errors for the field
     *
     * @return string An HTML tag string
     *
     * @see sfWidgetForm
     */

    public function render($name, $value = null, $attributes = array(), $errors = array()) {
        
        $id = $this->generateId($name);

        $js = sprintf("
        document.observe('dom:loaded', function() {
            new TextBoxList('autocomplete-%s-hidden', 'autocomplete-%s-help', { fetchFile: '%s' }); 
        });", $id, $id, $this->getOption('url'));

        //$html = $this->renderTag('input', array_merge(array('id' => 'autocomplete-'.$id.'-hidden', 'type' => 'hidden', 'value' => $value, 'name' => $name), $attributes));
        $help = $this->renderContentTag('div', $this->getOption('help'), array_merge(array('class' => 'default'), $attributes));
        $autoresults = $this->renderContentTag('ul', $this->getValues($value, $name), array('class' => 'holder'));
        $html = $this->renderContentTag('div', $help.$autoresults, array_merge(array('id' => 'autocomplete-'.$id.'-help'), $attributes));
        $html .= $this->renderContentTag('script', $js, array('type' => 'text/javascript'));
        
        return $html;
    }
    
    public function getValues($values, $name) {
        $html = '';
        foreach($values as $v)
        {
            if($object = call_user_func(array(constant($this->getOption('model').'::PEER'), 'retrieveById'), $v))
            {
                $sub_li = $this->renderContentTag('li', $this->renderTag('input', array('name' => $name.'[]', 'value' => $object->getPrimaryKey(), 'class' => 'smallinput', 'type' => 'hidden')), array('class' => 'bit-input'));
                $html .= $this->renderContentTag('li', ((string) $object).$sub_li, array('class' => 'bit-box'));
            }
        }
        return $html;
    }
}
