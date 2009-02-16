<?php  if ($pager->haveToPaginate()): ?>
    <div class="left_content_line">
        <div class="right_content_line">
            <div style="margin-left: 1px; margin-right: 1px; padding-right: 20px; height: 20px; text-align: center; background: #f8f9f3">
                <?php if ($sf_request->hasParameter('path')): ?>
                    <?php $path = '&path=' . $sf_request->getParameter('path') ?>
                <?php else: ?>
                    <?php $path = '' ?>
                <?php endif; ?>
                    
                  <?php if (1 != $pager->getPage()): ?>
                      <?php echo link_to('<<', $action . '?page=1' . $path, array('align' => 'absmiddle', 'alt' => __('First'), 'title' => __('First'))) ?>
                      <?php echo link_to('<', $action . '?page='.$pager->getPreviousPage() . $path, array('align' => 'absmiddle', 'alt' => __('Previous'), 'title' => __('Previous'))) ?>
                  <?php endif; ?>
                    
                  <?php foreach ($pager->getLinks() as $page): ?>
                    <?php echo link_to_unless($page == $pager->getPage(), $page, $action . '?page=' . $page . $path) ?>
                  <?php endforeach; ?>
                    
                  <?php if ($pager->getLastPage() != $pager->getPage()): ?>
                      <?php echo link_to('>', $action . '?page='.$pager->getNextPage() . $path, array('alt' => __('Next'))) ?>
                      <?php echo link_to('>>',$action . '?page='.$pager->getLastPage() . $path, array('alt' => __('Last'))) ?>
                  <?php endif; ?>
             </div>
            <div class="top_bottom_content_line"></div>
        </div>
    </div>
<?php endif; ?>