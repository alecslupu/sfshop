
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- order_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `order_item`;


CREATE TABLE `order_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`uuid` VARCHAR(32)  NOT NULL,
	`delivery_id` INTEGER,
	`delivery_method_title` VARCHAR(255),
	`delivery_description` TEXT,
	`delivery_price` DECIMAL(10,2) default 0.00,
	`member_id` INTEGER  NOT NULL,
	`member_first_name` VARCHAR(128),
	`member_last_name` VARCHAR(128),
	`member_country_id` INTEGER,
	`member_state_id` INTEGER,
	`member_state_title` VARCHAR(64),
	`member_city` VARCHAR(64),
	`member_street` VARCHAR(128),
	`member_postcode` VARCHAR(16),
	`billing_first_name` VARCHAR(128),
	`billing_last_name` VARCHAR(128),
	`billing_country_id` INTEGER,
	`billing_state_id` INTEGER,
	`billing_state_title` VARCHAR(64),
	`billing_city` VARCHAR(64),
	`billing_street` VARCHAR(128),
	`billing_postcode` VARCHAR(16),
	`delivery_first_name` VARCHAR(128),
	`delivery_last_name` VARCHAR(128),
	`delivery_country_id` INTEGER,
	`delivery_state_id` INTEGER,
	`delivery_state_title` VARCHAR(64),
	`delivery_city` VARCHAR(64),
	`delivery_street` VARCHAR(128),
	`delivery_postcode` VARCHAR(16),
	`comment` VARCHAR(255),
	`status_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `order_item_U_1` (`uuid`),
	INDEX `order_item_FI_1` (`delivery_id`),
	CONSTRAINT `order_item_FK_1`
		FOREIGN KEY (`delivery_id`)
		REFERENCES `delivery` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `order_item_FI_2` (`member_id`),
	CONSTRAINT `order_item_FK_2`
		FOREIGN KEY (`member_id`)
		REFERENCES `member` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `order_item_FI_3` (`member_country_id`),
	CONSTRAINT `order_item_FK_3`
		FOREIGN KEY (`member_country_id`)
		REFERENCES `country` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `order_item_FI_4` (`member_state_id`),
	CONSTRAINT `order_item_FK_4`
		FOREIGN KEY (`member_state_id`)
		REFERENCES `state` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `order_item_FI_5` (`billing_country_id`),
	CONSTRAINT `order_item_FK_5`
		FOREIGN KEY (`billing_country_id`)
		REFERENCES `country` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `order_item_FI_6` (`billing_state_id`),
	CONSTRAINT `order_item_FK_6`
		FOREIGN KEY (`billing_state_id`)
		REFERENCES `state` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `order_item_FI_7` (`delivery_country_id`),
	CONSTRAINT `order_item_FK_7`
		FOREIGN KEY (`delivery_country_id`)
		REFERENCES `country` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `order_item_FI_8` (`delivery_state_id`),
	CONSTRAINT `order_item_FK_8`
		FOREIGN KEY (`delivery_state_id`)
		REFERENCES `state` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `order_item_FI_9` (`status_id`),
	CONSTRAINT `order_item_FK_9`
		FOREIGN KEY (`status_id`)
		REFERENCES `order_status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- order_status
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `order_status`;


CREATE TABLE `order_status`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(128),
	`is_active` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- order_status_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `order_status_i18n`;


CREATE TABLE `order_status_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(128),
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `order_status_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `order_status` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- order_product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `order_product`;


CREATE TABLE `order_product`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`order_item_id` INTEGER  NOT NULL,
	`product_id` INTEGER  NOT NULL,
	`price` DECIMAL(10,2),
	`quantity` INTEGER default 1 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `order_product_FI_1` (`order_item_id`),
	CONSTRAINT `order_product_FK_1`
		FOREIGN KEY (`order_item_id`)
		REFERENCES `order_item` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `order_product_FI_2` (`product_id`),
	CONSTRAINT `order_product_FK_2`
		FOREIGN KEY (`product_id`)
		REFERENCES `product` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- order_product2option_product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `order_product2option_product`;


CREATE TABLE `order_product2option_product`
(
	`order_product_id` INTEGER  NOT NULL,
	`option_product_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`order_product_id`,`option_product_id`),
	CONSTRAINT `order_product2option_product_FK_1`
		FOREIGN KEY (`order_product_id`)
		REFERENCES `order_product` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `order_product2option_product_FI_2` (`option_product_id`),
	CONSTRAINT `order_product2option_product_FK_2`
		FOREIGN KEY (`option_product_id`)
		REFERENCES `option_product` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
