
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- member
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `member`;


CREATE TABLE `member`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`credential` VARCHAR(255) default 'member' NOT NULL,
	`gender` TINYINT,
	`first_name` VARCHAR(128),
	`last_name` VARCHAR(128),
	`email` VARCHAR(128),
	`default_address_id` INTEGER,
	`secret_question` TEXT,
	`secret_answer` TEXT,
	`phone` VARCHAR(32),
	`mobile` VARCHAR(32),
	`password` VARCHAR(32) default '' NOT NULL,
	`confirm_code` VARCHAR(32),
	`is_confirmed` INTEGER default 0 NOT NULL,
	`is_deleted` INTEGER default 0 NOT NULL,
	`is_active` INTEGER default 0 NOT NULL,
	`access_num` INTEGER default 1 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`modified_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `uni_email` (`email`),
	INDEX `member_FI_1` (`default_address_id`),
	CONSTRAINT `member_FK_1`
		FOREIGN KEY (`default_address_id`)
		REFERENCES `address_book` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- member_secret_question
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `member_secret_question`;


CREATE TABLE `member_secret_question`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- member_secret_question_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `member_secret_question_i18n`;


CREATE TABLE `member_secret_question_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`question` TEXT,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `member_secret_question_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `member_secret_question` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
