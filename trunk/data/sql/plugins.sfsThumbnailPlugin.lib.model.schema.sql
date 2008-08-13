
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- thumbnail_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `thumbnail_type`;


CREATE TABLE `thumbnail_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(128),
	`is_active` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- thumbnail_type_asset_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `thumbnail_type_asset_type`;


CREATE TABLE `thumbnail_type_asset_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`thumbnail_type_id` INTEGER  NOT NULL,
	`asset_type_id` INTEGER  NOT NULL,
	`thumbnail_type_name` VARCHAR(128),
	`width` INTEGER default 0 NOT NULL,
	`height` INTEGER default 0 NOT NULL,
	`is_trim` INTEGER default 0 NOT NULL,
	`is_active` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `thumbnail_type_asset_type_FI_1` (`thumbnail_type_id`),
	CONSTRAINT `thumbnail_type_asset_type_FK_1`
		FOREIGN KEY (`thumbnail_type_id`)
		REFERENCES `thumbnail_type` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `thumbnail_type_asset_type_FI_2` (`asset_type_id`),
	CONSTRAINT `thumbnail_type_asset_type_FK_2`
		FOREIGN KEY (`asset_type_id`)
		REFERENCES `asset_type` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- thumbnail
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `thumbnail`;


CREATE TABLE `thumbnail`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`parent_id` INTEGER,
	`ttat_id` INTEGER,
	`mime_id` INTEGER,
	`asset_id` INTEGER,
	`uuid` VARCHAR(32)  NOT NULL,
	`asset_type_model` VARCHAR(128),
	`mime_extension` VARCHAR(8),
	`path` VARCHAR(255),
	`is_blank` INTEGER default 0 NOT NULL,
	`is_converted` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `thumbnail_FI_1` (`parent_id`),
	CONSTRAINT `thumbnail_FK_1`
		FOREIGN KEY (`parent_id`)
		REFERENCES `thumbnail` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `thumbnail_FI_2` (`ttat_id`),
	CONSTRAINT `thumbnail_FK_2`
		FOREIGN KEY (`ttat_id`)
		REFERENCES `thumbnail_type_asset_type` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `thumbnail_FI_3` (`mime_id`),
	CONSTRAINT `thumbnail_FK_3`
		FOREIGN KEY (`mime_id`)
		REFERENCES `thumbnail_mime` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- thumbnail_mime
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `thumbnail_mime`;


CREATE TABLE `thumbnail_mime`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`mime` VARCHAR(128),
	`extension` VARCHAR(8),
	`extensions` VARCHAR(128),
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
