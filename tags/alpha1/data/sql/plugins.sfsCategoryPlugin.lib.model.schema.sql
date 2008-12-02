
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;


CREATE TABLE `category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`parent_id` INTEGER,
	`name` VARCHAR(128),
	`path` VARCHAR(255),
	`pos` INTEGER default 0 NOT NULL,
	`has_child` TINYINT(1) default 0,
	`is_active` INTEGER default 0 NOT NULL,
	`is_deleted` INTEGER default 0 NOT NULL,
	`is_locked` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `category_FI_1` (`parent_id`),
	CONSTRAINT `category_FK_1`
		FOREIGN KEY (`parent_id`)
		REFERENCES `category` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- category_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category_i18n`;


CREATE TABLE `category_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(255),
	`description` TEXT,
	`meta_keywords` TEXT,
	`meta_description` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `category_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `category` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
