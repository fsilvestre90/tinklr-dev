-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'bathrooms'
--
-- ---

DROP TABLE IF EXISTS `bathrooms`;

CREATE TABLE `bathrooms` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `handicap` BINARY NULL DEFAULT NULL,
  `toilet_count` INTEGER NULL DEFAULT NULL,
  `unisex` BINARY NULL DEFAULT NULL,
  `stall_count` INTEGER NULL DEFAULT NULL,
  `key_required` BINARY NULL DEFAULT NULL,
  `changing_table` BINARY NULL DEFAULT NULL,
  `public` BINARY NULL DEFAULT NULL,
  `single_toilet` BINARY NULL DEFAULT NULL,
  `marker_id` INTEGER NULL DEFAULT NULL
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'reviews'
--
-- ---

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `rating` FLOAT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'reviews_bathrooms'
--
-- ---

DROP TABLE IF EXISTS `reviews_bathrooms`;

CREATE TABLE `reviews_bathrooms` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `bathroom_id` BIGINT NULL DEFAULT NULL,
  `review_id` BIGINT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'reviews_markers'
--
-- ---

DROP TABLE IF EXISTS `reviews_markers`;

CREATE TABLE `reviews_markers` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `marker_id` BIGINT NULL DEFAULT NULL,
  `review_id` BIGINT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'markers'
--
-- ---
DROP TABLE IF EXISTS `markers`;

CREATE TABLE `markers` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR( 60 ) NOT NULL ,
    `address` VARCHAR( 80 ) NOT NULL ,
    `lat` FLOAT( 10, 6 ) NOT NULL ,
    `lng` FLOAT( 10, 6 ) NOT NULL,
    PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys
-- ---

ALTER TABLE `reviews_bathrooms` ADD FOREIGN KEY (bathroom_id) REFERENCES `bathrooms` (`id`);
ALTER TABLE `reviews_bathrooms` ADD FOREIGN KEY (review_id) REFERENCES `reviews` (`id`);
ALTER TABLE `reviews_markers` ADD FOREIGN KEY (review_id) REFERENCES `reviews` (`id`);


-- ---
-- Foreign Keys
-- ---

ALTER TABLE `reviews_bathrooms` ADD FOREIGN KEY (bathroom_id) REFERENCES `bathrooms` (`id`);
ALTER TABLE `reviews_bathrooms` ADD FOREIGN KEY (review_id) REFERENCES `reviews` (`id`);
ALTER TABLE `reviews_markers` ADD FOREIGN KEY (review_id) REFERENCES `reviews` (`id`);
ALTER TABLE `reviews_markers` ADD FOREIGN KEY (marker_id) REFERENCES `reviews` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `bathrooms` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `reviews` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `reviews_bathrooms` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `reviews_markers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `markers` ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
