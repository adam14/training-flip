-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table mini_project_flip.disburse
CREATE TABLE IF NOT EXISTS `disburse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `disburse_id` char(15) DEFAULT NULL,
  `amount` char(20) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `time_served` char(20) DEFAULT NULL,
  `bank_code` char(50) DEFAULT NULL,
  `account_number` char(50) DEFAULT NULL,
  `beneficiary_name` varchar(250) DEFAULT NULL,
  `remark` text,
  `receipt` text,
  `fee` char(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table mini_project_flip.disburse: ~1 rows (approximately)
DELETE FROM `disburse`;
/*!40000 ALTER TABLE `disburse` DISABLE KEYS */;
INSERT INTO `disburse` (`id`, `disburse_id`, `amount`, `status`, `time_served`, `bank_code`, `account_number`, `beneficiary_name`, `remark`, `receipt`, `fee`, `created`, `modified`) VALUES
	(1, '983084193', '200000', 'SUCCESS', '2019-10-14 15:35:42', 'BCA', '123456789', 'PT FLIP', 'remark-bca', 'https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg', '4000', '2019-10-13 01:32:20', '2019-10-14 15:36:37'),
	(2, '1130461373', '10000', 'SUCCESS', '2019-10-14 15:34:46', 'BCA', '987654321', 'PT FLIP', 'remark-2', 'https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg', '4000', '2019-10-14 14:39:42', '2019-10-14 15:35:42');
/*!40000 ALTER TABLE `disburse` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
