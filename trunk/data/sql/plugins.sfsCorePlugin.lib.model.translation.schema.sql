
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- catalogue
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `catalogue`;


CREATE TABLE `catalogue`
(
	`cat_id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) default '' NOT NULL,
	`source_lang` VARCHAR(100) default '' NOT NULL,
	`target_lang` VARCHAR(100) default '' NOT NULL,
	`date_created` INTEGER(11) default 0 NOT NULL,
	`date_modified` INTEGER(11) default 0 NOT NULL,
	`author` VARCHAR(255) default '' NOT NULL,
	PRIMARY KEY (`cat_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- trans_unit
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `trans_unit`;


CREATE TABLE `trans_unit`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`cat_id` INTEGER(11) default 1 NOT NULL,
	`source` TEXT  NOT NULL,
	`target` TEXT  NOT NULL,
	`comments` TEXT,
	`date_added` INTEGER(11) default 0 NOT NULL,
	`date_modified` INTEGER(11) default 0 NOT NULL,
	`author` VARCHAR(255) default '' NOT NULL,
	`translated` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `trans_unit_FI_1` (`cat_id`),
	CONSTRAINT `trans_unit_FK_1`
		FOREIGN KEY (`cat_id`)
		REFERENCES `catalogue` (`cat_id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
