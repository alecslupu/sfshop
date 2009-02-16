<div id="container_info_tax" class="container_info">
    <span class="caption"><?php echo __('Tax') ?></span>
    <br/><br/>
    <table>
        <thead>
        <tr><th><?php echo __('Tax type') ?></th><th><?php echo __('Net price') ?></th><th><?php echo __('Tax') ?></th><th><?php echo __('Gross price') ?></th></tr>
        </thead>
        <tbody>
        <?php foreach($price as $price_item): ?>
        <tr><td><?php echo $price_item['tax_title']?></td><td><?php echo format_currency($price_item['net_price'],$item->getCurrencyId(),false,isset($noCurrencyConversion) ? $noCurrencyConversion : false)?></td><td><?php echo format_currency($price_item['tax'],$item->getCurrencyId(),false,isset($noCurrencyConversion) ? $noCurrencyConversion : false)?></td><td><?php echo format_currency($price_item['gross_price'],$item->getCurrencyId(),false,isset($noCurrencyConversion) ? $noCurrencyConversion : false)?></td></tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr><td><b><?php echo __('Total') ?></b></td><td><?php echo format_currency($totalNet,$item->getCurrencyId(),false,isset($noCurrencyConversion) ? $noCurrencyConversion : false) ?></td><td><?php echo format_currency($totalTax,$item->getCurrencyId(),false,isset($noCurrencyConversion) ? $noCurrencyConversion : false) ?></td><td><?php echo format_currency($totalGross,$item->getCurrencyId(),false,isset($noCurrencyConversion) ? $noCurrencyConversion : false) ?></td></tr>
        </tfoot>
        </table>
    
    <div align="right">
        <span class="total_price"><?php echo __('Total') ?>: <?php echo format_currency(
            $totalGross,
            $item->getCurrencyId(),
            false,
            isset($noCurrencyConversion) ? $noCurrencyConversion : false
        ) ?></span>
    </div>
    
    
</div>