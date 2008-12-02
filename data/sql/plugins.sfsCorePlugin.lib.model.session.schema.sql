
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- session
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `session`;


CREATE TABLE `session`
(
	`cid` CHAR(36)  NOT NULL,
	`ses_data` TEXT  NOT NULL,
	`ses_time` DATETIME,
	PRIMARY KEY (`cid`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
