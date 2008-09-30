<div class="container">
    <div class="container_header">
        <div class="corner_left">
            <div class="corner_right">
                <div class="content"><?php echo __('Change password') ?></div>
            </div>
        </div>
    </div>
    <div class="container_content">
        <div class="corner_left">
            <div class="corner_right">
                <div class="content">
                    <form action="<?php echo url_for('@member_changePassword'); ?>" method="post" class="form">
                      <ul class="main">
                          <?php echo $form ?>
                          <li class="button">
                              <input type="submit" value="<?php echo __('Save') ?>" class="button"/>&nbsp;<input type="button" value="<?php echo __('Cancel') ?>" class="button" onclick="window.location='<?php echo $sf_request->getReferer() ?>'"/>
                          </li>
                      </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container_footer">
        <div class="corner_left">
            <div class="corner_right">
                <div class="content"></div>
            </div>
        </div>
    </div>
</div>
