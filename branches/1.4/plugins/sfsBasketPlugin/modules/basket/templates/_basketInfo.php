<span class="header_basket_info" id="header_basket_info"></span>
<?php echo javascript_tag('
  var basketInfoUrl = "'.url_for('@basket_info', true).'";
  basketInfoUrlUpdate();
')?>