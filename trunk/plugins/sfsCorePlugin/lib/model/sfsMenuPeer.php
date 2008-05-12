<?php

/**
 * Subclass for performing query and update operations on the 'menu' table.
 *
 * 
 *
 * @package plugins.sfsCorePlugin.lib.model
 */ 
class sfsMenuPeer extends BasesfsMenuPeer
{
    const TYPE_TOP     = 1;
    const TYPE_BOTTOM  = 2;
    const TYPE_PROFILE = 3;
    const TYPE_MAIN    = 4;
}
