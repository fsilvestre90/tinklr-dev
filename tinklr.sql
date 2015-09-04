SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tinklr`
--
CREATE DATABASE IF NOT EXISTS `tinklr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tinklr`;

-- --------------------------------------------------------

--
-- Table structure for table `bathrooms`
--

DROP TABLE IF EXISTS `bathrooms`;
CREATE TABLE `bathrooms` (
  `id` bigint(20) NOT NULL,
  `handicap` binary(1) DEFAULT NULL,
  `unisex` binary(1) DEFAULT NULL,
  `key_required` binary(1) DEFAULT NULL,
  `changing_table` binary(1) DEFAULT NULL,
  `public` binary(1) DEFAULT NULL,
  `marker_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

DROP TABLE IF EXISTS `markers`;
CREATE TABLE `markers` (
  `id` bigint(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` decimal(10,6) NOT NULL,
  `lng` decimal(10,6) NOT NULL,
  `type` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint(20) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews_bathrooms`
--

DROP TABLE IF EXISTS `reviews_bathrooms`;
CREATE TABLE `reviews_bathrooms` (
  `id` bigint(20) NOT NULL,
  `bathroom_id` bigint(20) DEFAULT NULL,
  `review_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews_markers`
--

DROP TABLE IF EXISTS `reviews_markers`;
CREATE TABLE `reviews_markers` (
  `id` bigint(20) NOT NULL,
  `marker_id` bigint(20) DEFAULT NULL,
  `review_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bathrooms`
--
ALTER TABLE `bathrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews_bathrooms`
--
ALTER TABLE `reviews_bathrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bathroom_id` (`bathroom_id`),
  ADD KEY `review_id` (`review_id`);

--
-- Indexes for table `reviews_markers`
--
ALTER TABLE `reviews_markers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_id` (`review_id`),
  ADD KEY `marker_id` (`marker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bathrooms`
--
ALTER TABLE `bathrooms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reviews_bathrooms`
--
ALTER TABLE `reviews_bathrooms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reviews_markers`
--
ALTER TABLE `reviews_markers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews_bathrooms`
--
ALTER TABLE `reviews_bathrooms`
  ADD CONSTRAINT `reviews_bathrooms_ibfk_4` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`),
  ADD CONSTRAINT `reviews_bathrooms_ibfk_1` FOREIGN KEY (`bathroom_id`) REFERENCES `bathrooms` (`id`) ON DELETE CASCADE
       ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_bathrooms_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`),
  ADD CONSTRAINT `reviews_bathrooms_ibfk_3` FOREIGN KEY (`bathroom_id`) REFERENCES `bathrooms` (`id`) ON DELETE CASCADE
       ON UPDATE CASCADE;

--
-- Constraints for table `reviews_markers`
--
ALTER TABLE `reviews_markers`
  ADD CONSTRAINT `reviews_markers_ibfk_3` FOREIGN KEY (`marker_id`) REFERENCES `reviews` (`id`),
  ADD CONSTRAINT `reviews_markers_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`),
  ADD CONSTRAINT `reviews_markers_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`);

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
