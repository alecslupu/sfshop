<td class="asset_table_right_border" width="90%">
    <div style="float: left">
        <?php echo format_address($address) ?> 
    </div>
    <div style="float: left; padding-left: 15px">
        <?php if ($address->getIsDefault()): ?>
            <b><?php echo __('defaut') ?></b>
        <?php endif; ?>
    </div>
</td>
