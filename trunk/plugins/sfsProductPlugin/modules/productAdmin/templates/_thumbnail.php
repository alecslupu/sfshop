<?php use_helper('sfsThumbnail'); ?>

<?php if (!$product->isNew()): ?>
    <?php $thumbnail = $product->getThumbnail(ThumbnailPeer::SMALL); ?>
<?php endif; ?>

<?php if (isset($thumbnail) && $thumbnail !== null && !$thumbnail->getIsBlank()): ?>
    <?php echo thumbnail_tag($thumbnail, '') ?><br/>
    <?php echo link_to('Remove', 'productAdmin/deleteThumbnail?id=' . $sf_request->getParameter('id')); ?>
<?php else: ?>
    <?php echo input_file_tag('product[thumbnail]'); ?>
<?php endif; ?>


