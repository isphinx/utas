SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Country` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Population` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ID`, `Country`, `City`, `Population`) VALUES
(1, 'AU', 'Adelaide', 1262940),
(2, 'AU', 'Brisbane', 2146577),
(3, 'AU', 'Canberra', 418292),
(4, 'AU', 'Darwin', 129062),
(5, 'AU', 'Hobart', 216276),
(6, 'AU', 'Melbourne', 4169103),
(7, 'AU', 'Perth', 1832114),
(8, 'AU', 'Sydney', 4605992),
(9, 'UK', 'Birmingham', 2284093),
(10, 'UK', 'Glasgow', 1199629),
(11, 'UK', 'Leeds', 1499465),
(12, 'UK', 'Liverpool', 816216),
(13, 'UK', 'London', 8278251),
(14, 'UK', 'Manchester', 2240230),
(15, 'UK', 'Newcastle', 879996),
(16, 'UK', 'Nottingham', 666358),
(17, 'US', 'Chicago', 9504753),
(18, 'US', 'Dallas', 6526548),
(19, 'US', 'Houston', 6086538),
(20, 'US', 'Los Angeles', 12944801),
(21, 'US', 'Maimi', 5670125),
(22, 'US', 'New York City', 19015900),
(23, 'US', 'Phiadelphia', 5922414),
(24, 'US', 'Washington, D.C', 5703948);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
