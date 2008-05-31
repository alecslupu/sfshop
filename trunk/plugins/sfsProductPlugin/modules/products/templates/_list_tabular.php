<div class="left_content_line">
    <div class="right_content_line">
        <div style="margin-left: 1px; margin-right: 1px; padding-right: 20px; background: #f8f9f3">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0" style="padding: 10px">
                <tr align="left" valign="top">
                    <?php $thumbnail = $product->getThumbnail(sfsThumbnailPeer::SMALL); ?>
                    <td width="110"><?php echo link_to(thumbnail_tag($thumbnail, $product->getTitle()), '@products_details?id=' . $product->getId()); ?></td>
                    <td>
                        <?php echo link_to($product->getTitle(),'@products_details?id=' . $product->getId(), array('class' => 'product_title')); ?><br/><br/>
                        <?php echo $product->getDescriptionShort(); ?>
                    </td>
                </tr>
            </table>
            &nbsp;&nbsp;<b><?php echo __('Added at') ?>:</b> <?php echo $product->getCreatedAt() ?><br/>
            <br/> <br/>
         </div>
        <div class="top_bottom_content_line"></div>
    </div>
</div>
