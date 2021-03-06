-- SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `uid` int(11) NOT NULL,
  `theme` varchar(200) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `notes` (`id`, `date`, `uid`, `theme`, `text`) VALUES
(1, '2019-01-01', 1, 'New theme', 'Test note for new theme');


ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;
