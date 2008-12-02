
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- address_book
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `address_book`;


CREATE TABLE `address_book`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`member_id` INTEGER,
	`first_name` VARCHAR(128),
	`last_name` VARCHAR(128),
	`company` VARCHAR(128),
	`country_id` INTEGER,
	`state_id` INTEGER,
	`state_title` VARCHAR(64),
	`city` VARCHAR(64),
	`street` VARCHAR(128),
	`postcode` VARCHAR(16),
	`is_default` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `address_book_FI_1` (`member_id`),
	CONSTRAINT `address_book_FK_1`
		FOREIGN KEY (`member_id`)
		REFERENCES `member` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `address_book_FI_2` (`country_id`),
	CONSTRAINT `address_book_FK_2`
		FOREIGN KEY (`country_id`)
		REFERENCES `country` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `address_book_FI_3` (`state_id`),
	CONSTRAINT `address_book_FK_3`
		FOREIGN KEY (`state_id`)
		REFERENCES `state` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- address_format
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `address_format`;


CREATE TABLE `address_format`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`location` VARCHAR(7)  NOT NULL,
	`format` TEXT,
	`is_default` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`,`location`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
