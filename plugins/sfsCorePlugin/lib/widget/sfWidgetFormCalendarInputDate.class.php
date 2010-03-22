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
class sfWidgetFormCalendarInputDate extends sfWidgetFormInput
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
        $this->addOption('image', false);
        $this->addOption('config', '{}');
        $this->addOption('culture', '');

        $this->addOption('with_time', false);
        
        $this->addOption('format', 'd/m/Y');
        $this->addOption('ifFormat', '%Y-%m-%d');
        $this->addOption('daFormat', '%d/%m/%Y');

        parent::configure($options, $attributes);

        if ('en' == $this->getOption('culture'))
        {
            $this->setOption('culture', 'en');
        }
    }
    
    public function getJavascripts()
    {
        return array(
            '/sfsCorePlugin/js/calendar/calendar',
            '/sfsCorePlugin/js/calendar/lang/calendar-fr',
            '/sfsCorePlugin/js/calendar/calendar-setup',
        );
    }
    
    public function getStylesheets()
    {
        return array(
            '/sfsCorePlugin/js/calendar/skins/aqua/theme' => 'all',
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

        $js = '
            document.getElementById("'.$id.'_cal_button").disabled = false;
            Calendar.setup({
              inputField : "'.$id.'",
              displayArea : "'.$id.'_da",
              ifFormat : "'.$this->getOption('ifFormat').'",
              daFormat : "'.$this->getOption('daFormat').'",
              button : "'.$id.'_cal_button"';
    
        if ($this->getOption('with_time')) {
            $js .= ",\n showsTime : true";
        }

        if ($calendar_options = $this->getOption('calendar_options')) {
            $js .= ",\n".$calendar_options;
        }
        $js .= '});';

        $calendar_button = $this->renderTag('img', array('src' => '/sfsCorePlugin/images/date.png', 'alt' => 'calendar'));
        
        $date = new Datetime($value);
        
        $html = $this->renderTag('input', array_merge(array('type' => 'hidden', 'value' => $value, 'name' => $name), $attributes));
        $html .= $this->renderContentTag('span', $value ? $date->format($this->getOption('format')) : '', array_merge(array('id' => $id.'_da'), $attributes));
        $html .= $this->renderContentTag('button', $calendar_button, array('type' => 'button', 'disabled' => 'disabled', 'onclick' => 'return false', 'id' => $id.'_cal_button'));
        $html .= $this->renderContentTag('script', $js, array('type' => 'text/javascript'));
        
        return $html;
    }
}
