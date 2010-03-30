<?php

class sfWidgetFormCategoryChoiceMany extends sfWidgetFormPropelChoiceMany
{
    /**
     * Constructor.
     *
     * @see sfWidgetFormPropelChoiceMany
     */
    protected function configure($options = array(), $attributes = array())
    {
        parent::configure($options, $attributes);

        $this->setOption('multiple', true);
        $this->setOption('model', 'Category');
        $this->addRequiredOption('category');
        $this->addOption('deep', true);
        $this->addOption('with_i18n', true);
    }
    
    public function getChoices() 
    {
        $choices = array();
        $cats = $this->getOption('category')->getChildren($this->getOption('criteria'), $this->getOption('deep'), $this->getOption('with_i18n'));
        foreach($cats as $cat)
        {
            $choices[$cat['cat']->getId()] = self::fillLevel($cat['level']).$cat['cat'];
        }
        return $choices;
    }
    
    public static function fillLevel($level)
    {
        $filled = '';
        for($i=0;$i < $level; $i++)
        {
            $filled .= '&nbsp;&nbsp;&nbsp;';
        }
        return $filled;
    }
}