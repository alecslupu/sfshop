

ALTER TABLE `product` ADD `sku` VARCHAR( 255 ) NOT NULL AFTER `id`;
ALTER TABLE `product` ADD `is_new_product` TINYINT NOT NULL DEFAULT 0;
ALTER TABLE `product` ADD `is_promo` TINYINT NOT NULL DEFAULT 0 AFTER is_new_product;
ALTER TABLE `product` ADD `promo_price` DECIMAL(10,4) AFTER price;
ALTER TABLE `product` ADD `stock_message` VARCHAR(255) AFTER allow_out_of_stock;
ALTER TABLE `product` ADD `url_key` VARCHAR(255);

ALTER TABLE `option_product` ADD `sku` VARCHAR(255);

ALTER TABLE `product_i18n` ADD `noscript` TEXT;

ALTER TABLE `category_i18n` ADD `noscript` TEXT;
