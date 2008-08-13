<?php

/**
 * Subclass for representing a row from the 'information' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model.common
 */ 
class Information extends BaseInformation
{
    public function getGeneratorEditTitle()
    {
        $title = $this->getTitle();
        if ($title == '')
        {
            $title = 'Add new page';
        } else {
            $title = "Edit page &ldquo; ${title} &rdquo;";
        }
        
        return $title;
    }
}
