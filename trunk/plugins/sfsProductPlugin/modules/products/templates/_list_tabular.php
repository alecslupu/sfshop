<div class="left_content_line">
    <div class="right_content_line">
        <div class="top_bottom_content_line"></div>
        <div style="margin-left: 1px; margin-right: 1px; padding-right: 20px">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0" style="padding: 10px">
                <tr align="left" valign="top">
                    
                    <?php /*$urlToThumbnail = $asset->getUrlToThumbnail(PhotoPeer::MEDIUM);
                        if ($urlToThumbnail): ?>
                        <td width="110"><?php echo link_to(image_tag($urlToThumbnail, array('width' => '100', 'height' => '80')), '@assetDetails?id=' . $asset->getId()); ?></td>
                    <?php endif; */?>
                    <td>
                        <?php echo link_to($asset->getTitle(),'@products_details?id=' . $asset->getId(), array('class' => 'asset_title')); ?><br/><br/>
                        <?php echo $asset->getDescriptionShort(); ?>
                    </td>
                </tr>
            </table>
            &nbsp;&nbsp;<b><?php echo __('Added at') ?>:</b> <?php echo $asset->getCreatedAt() ?><br/>
            <br/> <br/>
         </div>
        <div class="top_bottom_content_line"></div>
    </div>
</div>
<div style="background: #d8d8d8; height: 4px"></div>