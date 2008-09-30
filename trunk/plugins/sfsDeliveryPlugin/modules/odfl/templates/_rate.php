<div>
    <div><?php echo __('Rate') ?>: <?php echo format_currency($odflRate->calculateRate('totalCharge')) ?></div>
    
    <?php if ($odflRate->calculateRate('destinationServiceCenter', 'serviceCenterCountry') !== 'none'): ?>
        <div><?php echo $odflRate->calculateRate('destinationServiceCenter', 'serviceCenterCountry') ?></div>
    <?php endif; ?>
    
    <?php if ($odflRate->calculateRate('destinationServiceCenter', 'serviceCenterFax') !== 'none'): ?>
        <div><?php echo $odflRate->calculateRate('destinationServiceCenter', 'serviceCenterFax') ?></div>
    <?php endif; ?>
    
    <?php if ($odflRate->calculateRate('destinationServiceCenter', 'serviceCenterManager') !== 'none'): ?>
        <div><?php echo $odflRate->calculateRate('destinationServiceCenter', 'serviceCenterManager') ?></div>
    <?php endif; ?>
    
    <?php if ($odflRate->calculateRate('destinationServiceCenter', 'serviceCenterName') !== 'none'): ?>
        <div><?php echo $odflRate->calculateRate('destinationServiceCenter', 'serviceCenterName') ?></div>
    <?php endif; ?>
    
    <?php if ($odflRate->calculateRate('destinationServiceCenter', 'serviceCenterPhone') !== 'none'): ?>
        <div><?php echo $odflRate->calculateRate('destinationServiceCenter', 'serviceCenterPhone') ?></div>
    <?php endif; ?>
    
    <?php if ($odflRate->calculateRate('destinationServiceCenter', 'serviceCenterAlphaCode') !== 'none'): ?>
        <div><?php echo $odflRate->calculateRate('destinationServiceCenter', 'serviceCenterAlphaCode') ?></div>
    <?php endif; ?>
    
    <?php if ($odflRate->calculateRate('destinationServiceCenter', 'serviceCenterAddress') !== 'none'): ?>
        <div><?php echo $odflRate->calculateRate('destinationServiceCenter', 'serviceCenterAddress') ?></div>
    <?php endif; ?>
    
    <?php if ($odflRate->calculateRate('destinationServiceCenter', 'serviceCenterCityStateZip') !== 'none'): ?>
        <div><?php echo $odflRate->calculateRate('destinationServiceCenter', 'serviceCenterCityStateZip') ?></div>
    <?php endif; ?>

    (The total summ doesn't include the delivery cost. You should pay it after the product will be delivered.)
</div>