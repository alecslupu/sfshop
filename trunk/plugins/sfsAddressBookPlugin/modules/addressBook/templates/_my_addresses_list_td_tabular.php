<td class="asset_table_right_border" width="90%">
    <?php echo format_address($address) ?> 
    <?php if ($address->getIsDefault()): ?>
        <b><?php echo __('defaut') ?></b>
    <?php endif; ?>
</td>
