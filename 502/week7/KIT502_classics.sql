--
-- Host: localhost
-- Generation Time: Feb 21, 2019 at 12:11 PM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--

-- --------------------------------------------------------

--
-- Table structure for table `KIT502_classics`
--

CREATE TABLE IF NOT EXISTS `KIT502_classics` (
  `ID` int(11) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Type` varchar(32) NOT NULL,
  `Year` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `KIT502_classics`
--

INSERT INTO `KIT502_classics` (`ID`, `Author`, `Title`, `Type`, `Year`) VALUES
(1, 'Charles Darwin', 'The Origin of Species', 'Non-Fiction', '1856'),
(2, 'Jane Austen', 'Pride and Prejudice', 'Fiction', '1929'),
(3, 'JK Rowling', 'Harry Potter', 'Fiction', '1997'),
(4, 'Aaron Vegh', 'Web development with the Mac', 'Non-Fiction', '2010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `KIT502_classics`
--
ALTER TABLE `KIT502_classics`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `ID_2` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
