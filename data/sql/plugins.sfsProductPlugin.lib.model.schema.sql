
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- brand
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `brand`;


CREATE TABLE `brand`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(128)  NOT NULL,
	`url` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `uni_name` (`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- brand_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `brand_i18n`;


CREATE TABLE `brand_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(255),
	`description` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `brand_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `brand` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;


CREATE TABLE `product`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`brand_id` INTEGER,
	`price` DECIMAL(10,2),
	`quantity` INTEGER default 0 NOT NULL,
	`weight` DECIMAL(10,3),
	`cube` DECIMAL(10,3),
	`has_options` TINYINT(1) default 0,
	`is_active` INTEGER default 1 NOT NULL,
	`is_deleted` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `product_FI_1` (`brand_id`),
	CONSTRAINT `product_FK_1`
		FOREIGN KEY (`brand_id`)
		REFERENCES `brand` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- product_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `product_i18n`;


CREATE TABLE `product_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(255),
	`description_short` TEXT,
	`description` TEXT,
	`meta_keywords` TEXT,
	`meta_description` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `product_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `product` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- option_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `option_type`;


CREATE TABLE `option_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(34),
	`pos` INTEGER default 1 NOT NULL,
	`is_active` INTEGER default 1 NOT NULL,
	`is_deleted` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- option_type_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `option_type_i18n`;


CREATE TABLE `option_type_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(255),
	`description` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `option_type_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `option_type` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- option_value
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `option_value`;


CREATE TABLE `option_value`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type_id` INTEGER  NOT NULL,
	`name` VARCHAR(34),
	`pos` INTEGER default 1 NOT NULL,
	`is_active` INTEGER default 1 NOT NULL,
	`is_deleted` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `option_value_FI_1` (`type_id`),
	CONSTRAINT `option_value_FK_1`
		FOREIGN KEY (`type_id`)
		REFERENCES `option_type` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- option_value_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `option_value_i18n`;


CREATE TABLE `option_value_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(255),
	`description` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `option_value_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `option_value` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- option_product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `option_product`;


CREATE TABLE `option_product`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`option_value_id` INTEGER  NOT NULL,
	`product_id` INTEGER  NOT NULL,
	`price_type` TINYINT default 0 NOT NULL,
	`price` DECIMAL(10,2),
	`quantity` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `option_product_FI_1` (`option_value_id`),
	CONSTRAINT `option_product_FK_1`
		FOREIGN KEY (`option_value_id`)
		REFERENCES `option_value` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `option_product_FI_2` (`product_id`),
	CONSTRAINT `option_product_FK_2`
		FOREIGN KEY (`product_id`)
		REFERENCES `product` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- product2category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `product2category`;


CREATE TABLE `product2category`
(
	`product_id` INTEGER  NOT NULL,
	`category_id` INTEGER  NOT NULL,
	`pos` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`product_id`,`category_id`),
	CONSTRAINT `product2category_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `product` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `product2category_FI_2` (`category_id`),
	CONSTRAINT `product2category_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
