
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- basket
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `basket`;


CREATE TABLE `basket`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`member_id` INTEGER,
	`currency_id` INTEGER,
	`access_num` INTEGER default 1 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `basket_FI_1` (`member_id`),
	CONSTRAINT `basket_FK_1`
		FOREIGN KEY (`member_id`)
		REFERENCES `member` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `basket_FI_2` (`currency_id`),
	CONSTRAINT `basket_FK_2`
		FOREIGN KEY (`currency_id`)
		REFERENCES `currency` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- basket_product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `basket_product`;


CREATE TABLE `basket_product`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`basket_id` INTEGER  NOT NULL,
	`product_id` INTEGER  NOT NULL,
	`options_list` VARCHAR(128),
	`quantity` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `basket_product_FI_1` (`basket_id`),
	CONSTRAINT `basket_product_FK_1`
		FOREIGN KEY (`basket_id`)
		REFERENCES `basket` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `basket_product_FI_2` (`product_id`),
	CONSTRAINT `basket_product_FK_2`
		FOREIGN KEY (`product_id`)
		REFERENCES `product` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- basket_product2option_product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `basket_product2option_product`;


CREATE TABLE `basket_product2option_product`
(
	`basket_product_id` INTEGER  NOT NULL,
	`option_product_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`basket_product_id`,`option_product_id`),
	CONSTRAINT `basket_product2option_product_FK_1`
		FOREIGN KEY (`basket_product_id`)
		REFERENCES `basket_product` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `basket_product2option_product_FI_2` (`option_product_id`),
	CONSTRAINT `basket_product2option_product_FK_2`
		FOREIGN KEY (`option_product_id`)
		REFERENCES `option_product` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
