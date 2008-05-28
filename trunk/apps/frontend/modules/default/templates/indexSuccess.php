<br/>
<?php use_helper('sfsCategory') ?>
<table cellspacing="0" cellpadding="0" width="100%">
<tr><td valign="top" width="230">
    <?php include_component('categories', 'menuTree', array('item_routing' => '@products_list')) ?>
</td>
<td valign="top" width="100%">
    <?php //include_partial('search_form'); ?>
    <?php //include_partial('list', array('action' => '@assetsList', 'pager' => $pager,)) ?>
</td></tr></table>
<br/>
    <?php //include_component('tags', 'popular'); ?>
<br/>