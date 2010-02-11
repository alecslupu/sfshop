<?php if(!isset($component_list)): ?>

<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
    <table cellspacing="0">
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
          <?php include_partial('categoryAdmin/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="6">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('categoryAdmin/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $category): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
            <?php include_partial('categoryAdmin/list_td_batch_actions', array('category' => $category, 'helper' => $helper)) ?>
            <?php include_partial('categoryAdmin/list_td_tabular', array('category' => $category)) ?>
            <?php include_partial('categoryAdmin/list_td_actions', array('category' => $category, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(index in boxes) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>

<?php else: ?>


<?php use_helper('sfsCategory') ?>

<?php if (isset($parentCategory) && $parentCategory !== null): ?>
    <tr>
        <td colspan="6">
            <?php echo link_to(image_tag(sfConfig::get('app_sfshop_admin_images_dir').'go-up.png') . __('Up on one level'), 'catalogAdmin/list?path=' .generate_category_path_for_url($parentCategory->getPath())) ?>
        </td>
    </tr>
<?php endif; ?>

<?php if (count($categories) > 0): ?>
    <?php foreach ($categories as $category): ?>
        <tr>
            <?php include_partial('categoryAdmin/list_td_tabular', array('category' => $category)) ?>
            <?php include_partial('categoryAdmin/list_td_actions', array('category' => $category, 'helper' => $helper)) ?>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>

<?php endif; ?>
