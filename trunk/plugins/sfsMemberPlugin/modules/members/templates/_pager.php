<div style="width: 100%; text-align: center">
<?php if ($pager->haveToPaginate()): ?>
  <?php if (1 != $pager->getPage()): ?>
      <?php echo link_to('<<', $action . '?page=1', array('align' => 'absmiddle', 'alt' => __('First'), 'title' => __('First'))) ?>
      <?php echo link_to('<', $action . '?page='.$pager->getPreviousPage(), array('align' => 'absmiddle', 'alt' => __('Previous'), 'title' => __('Previous'))) ?>
  <?php endif; ?>

  <?php foreach ($pager->getLinks() as $page): ?>
    <?php echo link_to_unless($page == $pager->getPage(), $page, $action . '?page='.$page) ?>
  <?php endforeach; ?>

  <?php if ($pager->getLastPage() != $pager->getPage()): ?>
      <?php echo link_to('>', $action . '?page='.$pager->getNextPage(), array('alt' => __('Next'))) ?>
      <?php echo link_to('>>',$action . '?page='.$pager->getLastPage(), array('alt' => __('Last'))) ?><?php endif; ?>
  <?php endif; ?>
</div>