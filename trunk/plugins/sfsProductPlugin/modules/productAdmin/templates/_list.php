<?php if(!isset($component_list)): ?>
<div class="sf_admin_list">
    <table cellspacing="0">
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
          <?php include_partial('productAdmin/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <?php include_partial('productAdmin/list_th_filters', array('filters' => $filters, 'configuration' => $configuration)) ?>
            <th>
                <?php echo $filters->renderHiddenFields() ?>
                <?php echo link_to(__('Reset', array(), 'sf_admin'), 'productAdmin_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
            </th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="7">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('productAdmin/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
      <?php if ( ! $pager->getNbResults()): ?>
        <tr>
            <td colspan="7"><?php echo __('No result', array(), 'sf_admin') ?></td>
        </tr>
      <?php else: ?>
        <?php foreach ($pager->getResults() as $i => $product): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
            <?php include_partial('productAdmin/list_td_batch_actions', array('product' => $product, 'helper' => $helper)) ?>
            <?php include_partial('productAdmin/list_td_tabular', array('product' => $product)) ?>
            <?php include_partial('productAdmin/list_td_actions', array('product' => $product, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
       <?php endif ?>
      </tbody>
    </table>
</div>
<script type="text/javascript">
/* <![CDATA[  */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(index in boxes) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>

<?php else: ?>

<?php if (isset($pager)): ?>
    <tfoot>
    <tr><th colspan="11">
        <div class="float-right">
        <?php if ($pager->haveToPaginate()): ?>
          <?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/first.png', array('align' => 'absmiddle', 'alt' => __('First'), 'title' => __('First'))), 'productAdmin/list?page=1') ?>
          <?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/previous.png', array('align' => 'absmiddle', 'alt' => __('Previous'), 'title' => __('Previous'))), 'productAdmin/list?page='.$pager->getPreviousPage()) ?>
          
          <?php foreach ($pager->getLinks() as $page): ?>
            <?php echo link_to_unless($page == $pager->getPage(), $page, 'productAdmin/list?page='.$page) ?>
          <?php endforeach; ?>
          
          <?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/next.png', array('align' => 'absmiddle', 'alt' => __('Next'), 'title' => __('Next'))), 'productAdmin/list?page='.$pager->getNextPage()) ?>
          <?php echo link_to(image_tag(sfConfig::get('sf_admin_web_dir').'/images/last.png', array('align' => 'absmiddle', 'alt' => __('Last'), 'title' => __('Last'))), 'productAdmin/list?page='.$pager->getLastPage()) ?>
        <?php endif; ?>
        </div>
        <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
        </th></tr>
    </tfoot>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $product): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
            <?php include_partial('productAdmin/list_td_tabular', array('product' => $product)) ?>
            <?php include_partial('productAdmin/list_td_actions', array('product' => $product, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>

<?php endif; ?>

<?php endif; ?>
