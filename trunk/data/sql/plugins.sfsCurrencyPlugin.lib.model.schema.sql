
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- currency
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `currency`;


CREATE TABLE `currency`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(128),
	`code` CHAR(4),
	`symbol_left` VARCHAR(16),
	`symbol_right` VARCHAR(16),
	`decimal_point` CHAR(1),
	`thousands_point` CHAR(1),
	`decimal_places` CHAR(1),
	`value` DECIMAL(10,2),
	`is_default` INTEGER default 0 NOT NULL,
	`is_active` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
