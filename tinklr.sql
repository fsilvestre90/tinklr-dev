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
  `unisex` BINARY NULL DEFAULT NULL,
  `key_required` BINARY NULL DEFAULT NULL,
  `changing_table` BINARY NULL DEFAULT NULL,
  `public` BINARY NULL DEFAULT NULL,
  `marker_id` INTEGER NULL DEFAULT NULL,
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
    `lat` DECIMAL( 10, 6 ) NOT NULL ,
    `lng` DECIMAL( 10, 6 ) NOT NULL,
    `type` VARCHAR( 60 ) NOT NULL ,
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

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'Frankie Johnnie & Luigo Too', '939 W El Camino Real, Mountain View, CA 94040', 37.386337, -122.085823, 'restaurant'),
(2, 'Amici''s East Coast Pizzeria', '790 Castro St, Mountain View, CA 94041', 37.387138, -122.083237, 'restaurant'),
(3, 'Kapp''s Pizza Bar & Grill', '191 Castro St, Mountain View, CA 94041', 37.393887, -122.078918, 'restaurant'),
(4, 'Round Table Pizza: Mountain View', '570 N Shoreline Blvd, Mountain View, CA 94043', 37.402653, -122.079353, 'restaurant'),
(5, 'Tony & Alba''s Pizza & Pasta', '619 Escuela Ave, Mountain View, CA 94043', 37.394012, -122.095528, 'restaurant'),
(6, 'Oregano''s Wood-Fired Pizza', '4546 El Camino Real, Los Altos, CA 94022', 37.401726, -122.114647, 'restaurant'),
(7, 'Pan Africa Market', '1521 1st Ave, Seattle, WA 98101', 47.608940, -122.340141, 'restaurant'),
(8, 'Buddha Thai & Bar', '2222 2nd Ave, Seattle, WA 98121', 47.613590, -122.344391, 'bar'),
(9, 'The Melting Pot', '14 Mercer St, Seattle, WA 98109', 47.624561, -122.356445, 'restaurant'),
(10, 'Ipanema Grill', '1225 1st Ave, Seattle, WA 98101', 47.606365, -122.337654, 'restaurant'),
(11, 'Sake House', '2230 1st Ave, Seattle, WA 98121', 47.612823, -122.345673, 'bar'),
(12, 'Crab Pot', '1301 Alaskan Way, Seattle, WA 98101', 47.605961, -122.340363, 'restaurant'),
(13, 'Mama''s Mexican Kitchen', '2234 2nd Ave, Seattle, WA 98121', 47.613976, -122.345467, 'bar'),
(14, 'Wingdome', '1416 E Olive Way, Seattle, WA 98122', 47.617214, -122.326584, 'bar'),
(15, 'Piroshky Piroshky', '1908 Pike pl, Seattle, WA 98101', 47.610126, -122.342834, 'restaurant');
