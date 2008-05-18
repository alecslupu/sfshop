<h3><?php echo __('My profile') ?></h3>

<?php if ($sf_user->hasFlash('message')): ?>
    <div class="message"><?php echo __($sf_user->getFlash('message')) ?></div><br/>
<?php endif; ?>

<div>
    <div class="left_content_line">
        <div class="right_content_line">
            <div class="top_bottom_content_line"></div>
            <div style="margin-left: 1px; margin-right: 1px;; background: #eff0e0">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0" style="padding: 10px">
                    <tr align="left" valign="top">
                        <td width="26"><div style="padding-left:0px; padding-top:0px"><img src="/images/pic_2.jpg" width="14" height="17"></div></td>
                        <td><span class="style2"><b><?php echo __('My account') ?></b></span></td>
                    </tr>
                </table>
            </div>
            <div class="top_bottom_content_line"></div>
            <div style="margin-left: 1px; margin-right: 1px; background: #f8f9f3; padding-right: 20px"><br/>
                <?php include_component('menu', 'profile') ?>
            <br/>
            </div>
            <div class="top_bottom_content_line"></div>
        </div>
    </div>
    
</div>
