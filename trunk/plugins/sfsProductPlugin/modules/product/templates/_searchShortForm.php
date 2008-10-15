<form action="<?php echo url_for('@product_search'); ?>" method="post" name="form_search_short" class="form form_search_short">
    <table cellspacing="0" cellpadding="0">
       <tr>
          <td width="4" height="37" background="/images/m3.gif"></td>
          <td width="248" height="37" background="/images/m4.gif" class="ML4-W" style="padding-top: 3px;">
              <span class="search_label"><?php echo __('SEARCH') ?></span>
              <?php echo $form['query']->render(array('class' => 'se2')) ?>&nbsp;<input type="submit" value="" class="button"/>
          </td>
       </tr>
  </table>
</form>
