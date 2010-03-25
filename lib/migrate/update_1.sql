

ALTER TABLE `product` ADD `sku` VARCHAR( 255 ) NOT NULL AFTER `id`;



ALTER TABLE `product_i18n` ADD 
    `noscript` TEXT;
    
ALTER TABLE `category_i18n` ADD 
    `noscript` TEXT;
    
