
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- payment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `payment`;


CREATE TABLE `payment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64)  NOT NULL,
	`accept_currencies_codes` VARCHAR(255),
	`name_class_form_params` VARCHAR(64)  NOT NULL,
	`charge_route` VARCHAR(128),
	`icon` VARCHAR(100),
	`params` TEXT,
	`is_active` INTEGER default 0 NOT NULL,
	`is_deleted` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- payment_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `payment_i18n`;


CREATE TABLE `payment_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(255),
	`description` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `payment_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `payment` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
