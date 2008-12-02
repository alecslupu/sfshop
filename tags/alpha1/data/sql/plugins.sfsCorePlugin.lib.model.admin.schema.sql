
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- admin
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;


CREATE TABLE `admin`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`credential` VARCHAR(255) default 'admin' NOT NULL,
	`email` VARCHAR(128),
	`password` VARCHAR(32),
	`first_name` VARCHAR(128),
	`last_name` VARCHAR(128),
	`is_active` INTEGER default 0 NOT NULL,
	`access_num` INTEGER default 1 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`modified_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `uni_username` (`email`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- admin_menu
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `admin_menu`;


CREATE TABLE `admin_menu`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`parent_id` INTEGER,
	`credential` VARCHAR(255) default 'admin' NOT NULL,
	`title` VARCHAR(128),
	`route` VARCHAR(128),
	`pos` INTEGER default 0,
	`is_active` INTEGER default 1 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `admin_menu_FI_1` (`parent_id`),
	CONSTRAINT `admin_menu_FK_1`
		FOREIGN KEY (`parent_id`)
		REFERENCES `admin_menu` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
