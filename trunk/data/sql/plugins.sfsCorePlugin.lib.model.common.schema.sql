
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- information
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `information`;


CREATE TABLE `information`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`is_active` INTEGER default 1 NOT NULL,
	`is_deleted` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- information_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `information_i18n`;


CREATE TABLE `information_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(255),
	`description` TEXT,
	`meta_keywords` TEXT,
	`meta_description` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `information_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `information` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- asset_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `asset_type`;


CREATE TABLE `asset_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(128),
	`model` VARCHAR(128),
	`has_thumbnail` TINYINT(1) default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- language
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `language`;


CREATE TABLE `language`
(
	`culture` VARCHAR(7)  NOT NULL,
	`title_english` VARCHAR(128),
	`title_own` VARCHAR(128),
	`is_default` INTEGER default 0 NOT NULL,
	`is_active` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`culture`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- country
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `country`;


CREATE TABLE `country`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`iso` CHAR(2)  NOT NULL,
	`iso_a3` CHAR(3)  NOT NULL,
	`iso_n` CHAR(3)  NOT NULL,
	`title_english` VARCHAR(128),
	`is_active` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- country_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `country_i18n`;


CREATE TABLE `country_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(128),
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `country_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `country` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- state
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `state`;


CREATE TABLE `state`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`country_id` INTEGER  NOT NULL,
	`iso` CHAR(2)  NOT NULL,
	`title_english` VARCHAR(128),
	`is_active` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `state_FI_1` (`country_id`),
	CONSTRAINT `state_FK_1`
		FOREIGN KEY (`country_id`)
		REFERENCES `country` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- state_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `state_i18n`;


CREATE TABLE `state_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(128),
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `state_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `state` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- email_template
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `email_template`;


CREATE TABLE `email_template`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(128),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- email_template_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `email_template_i18n`;


CREATE TABLE `email_template_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`subject` VARCHAR(255),
	`body` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `email_template_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `email_template` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- menu
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;


CREATE TABLE `menu`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` TINYINT,
	`route` VARCHAR(128),
	`pos` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- menu_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `menu_i18n`;


CREATE TABLE `menu_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(255),
	`meta_keywords` TEXT,
	`meta_description` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `menu_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `menu` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
