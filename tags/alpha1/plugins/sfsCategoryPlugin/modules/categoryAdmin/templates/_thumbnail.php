<?php use_helper('sfsThumbnail'); ?>

<?php if (!$category->isNew()): ?>
    <?php $thumbnail = $category->getThumbnail(ThumbnailPeer::SMALL); ?>
<?php endif; ?>

<?php if (isset($thumbnail) && $thumbnail !== null && !$thumbnail->getIsBlank()): ?>
    <?php echo thumbnail_tag($thumbnail, '', true) ?><br/>
    <?php echo link_to('Remove', 'categoryAdmin/deleteThumbnail?id=' . $sf_request->getParameter('id')); ?>
<?php else: ?>
    <?php echo input_file_tag('category[thumbnail]'); ?>
<?php endif; ?>


