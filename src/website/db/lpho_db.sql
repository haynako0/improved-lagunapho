-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 05:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpho_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accnt_tbl`
--

CREATE TABLE `accnt_tbl` (
  `accnt_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accnt_type` int(11) NOT NULL,
  `accnt_status` varchar(30) NOT NULL DEFAULT 'inactive' COMMENT 'lock, active, inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accnt_tbl`
--

INSERT INTO `accnt_tbl` (`accnt_id`, `fullname`, `municipality`, `email`, `phone`, `password`, `accnt_type`, `accnt_status`) VALUES
(1, 'LAGUNA PHO ADMIN', NULL, 'kylekuzma1803@gmail.com', '1234567810', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1, 'active'),
(8, 'SANTA CRUZ COOR', 'Santa Cruz', 'santacruzcoor@gmail.com', '1234567810', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 2, 'active'),
(9, 'PAGSANJAN COOR', 'Pagsanjan', 'pagsanjancoor@gmail.com', '0923283883', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(10, 'ALAMINOS COOR', 'Alaminos', 'alaminoscoor@gmail.com', '093872382', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(11, 'BAY COOR', 'Bay', 'baycoor@gmail.com', '09298372973', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(12, 'BIÑAN COOR', 'Biñan', 'binancoor@gmail.com', '095843584', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(13, 'CABUYAO COOR', 'Cabuyao', 'cabuyaocoor@gmail.com', '09238238', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(14, 'CALAMBA COOR', 'Calamba', 'calambacoor@gmail.com', '0923982131', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(15, 'CALAUAN COOR', 'Calauan', 'calauancoor@gmail.com', '09433284328', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(16, 'CAVINTI COOR', 'Cavinti', 'cavinticoor@gmail.com', '092328232312', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(17, 'FAMY COOR', 'Famy', 'famycoor@gmail.com', '0999877737', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(18, 'KALAYAAN COOR', 'Kalayaan', 'kalayaancoor@gmail.com', '092839238', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(19, 'LILIW COOR', 'Liliw', 'liliwcoor@gmail.com', '0988768756', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(20, 'LOS BAÑOS COOR', 'Los banos', 'losbanocoor@gmail.com', '092392927', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(21, 'LUSIANA COOR', 'Luisiana', 'lusianacoor@gmail.com', '093728327', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(22, 'LUMBAN COOR', 'Lumban', 'lumbancoor@gmail.com', '092323289758', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(23, 'MABITAC COOR', 'Mabitac', 'mabitaccoor@gmail.com', '0923823828', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(24, 'MAGDALENA COOR', 'Magdalena', 'magdalenacoor@gmail.com', '093832867686', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(25, 'MAJAYJAY COOR', 'Majayjay', 'majayjaycoor@gmail.com', '029329382392', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(26, 'NAGCARLAN COOR', 'Nagcarlan', 'nagcarlancoor@gmail.com', '09238237', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(27, 'PAETE COOR', 'Paete', 'paetecoor@gmail.com', '092382932', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(28, 'PAKIL COOR', 'Pakil', 'pakilcoor@gmail.com', '092398238238', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(29, 'PANGIL COOR', 'Pangil', 'pangilcoor@gmail.com', '0995959537', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(30, 'PILA COOR', 'Pila', 'pilacoor@gmail.com', '0923823844', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(31, 'RIZAL COOR', 'Rizal', 'rizalcoor@gmail.com', '09698596482', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(32, 'SAN PABLO COOR', 'San Pablo City', 'sanpablocoor@gmail.com', '09943843', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(33, 'SAN PEDRO COOR', 'San Pedro	', 'sanpedrocoor@gmail.com', '09230289329', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(34, 'SANTA MARIA COOR', 'Santa Maria', 'santamariacoor@gmail.com', '091112121214', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(35, 'SANTA ROSA COOR', 'Santa Rosa', 'santarosacoor@gmail.com', '0955165378', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(36, 'VICTORIA COOR', 'Victoria', 'victoriacoor@gmail.com', '098878789735', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active'),
(37, 'SINILOAN COOR', 'Siniloan', 'siniloancoor@gmail.com', '09232939273', '701b389b848a2b1cfab867093101d8d5ac56addd', 2, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `accnt_type`
--

CREATE TABLE `accnt_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accnt_type`
--

INSERT INTO `accnt_type` (`type_id`, `type_name`) VALUES
(1, 'admin'),
(2, 'coordinator');

-- --------------------------------------------------------

--
-- Table structure for table `municipality`
--

CREATE TABLE `municipality` (
  `mun_id` int(11) NOT NULL,
  `mun_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `municipality`
--

INSERT INTO `municipality` (`mun_id`, `mun_name`) VALUES
(1, 'Siniloan'),
(2, 'Lumban'),
(3, 'Kalayaan'),
(4, 'Pagsanjan'),
(5, 'Santa Cruz'),
(6, 'Alaminos'),
(7, 'Los banos'),
(8, 'Bay'),
(9, 'Biñan'),
(10, 'Cabuyao'),
(11, 'Calamba'),
(12, 'Calauan'),
(13, 'Cavinti'),
(14, 'Famy'),
(15, 'Liliw'),
(16, 'Luisiana'),
(17, 'Mabitac'),
(18, 'Magdalena'),
(19, 'Majayjay'),
(20, 'Nagcarlan'),
(21, 'Paete'),
(22, 'Pakil'),
(23, 'Pangil'),
(24, 'Pila'),
(25, 'Rizal'),
(26, 'San Pablo City'),
(27, 'San Pedro	'),
(28, 'Santa Maria'),
(29, 'Santa Rosa'),
(30, 'Victoria');

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `r_id` int(11) NOT NULL,
  `r_date_requested` datetime NOT NULL DEFAULT current_timestamp(),
  `code` varchar(255) DEFAULT NULL,
  `r_name` varchar(255) NOT NULL,
  `name_of_patient` varchar(255) DEFAULT NULL,
  `r_phone` varchar(50) NOT NULL,
  `age` int(2) DEFAULT NULL,
  `r_brgy` varchar(255) NOT NULL,
  `r_municipality` varchar(255) NOT NULL,
  `hospital` mediumtext DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `type_of_assistance` varchar(255) DEFAULT NULL,
  `amount_being_request` int(20) DEFAULT NULL,
  `amount_being_request_in_words` text DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL COMMENT 'walk-in, c/o',
  `used_gl` date DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `proponent` varchar(255) DEFAULT NULL,
  `r_date_updated` datetime DEFAULT NULL,
  `r_status` varchar(255) NOT NULL COMMENT 'pending, approved, disapproved\r\n',
  `r_comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_tbl`
--

INSERT INTO `request_tbl` (`r_id`, `r_date_requested`, `code`, `r_name`, `name_of_patient`, `r_phone`, `age`, `r_brgy`, `r_municipality`, `hospital`, `diagnosis`, `type_of_assistance`, `amount_being_request`, `amount_being_request_in_words`, `remarks`, `used_gl`, `paid`, `proponent`, `r_date_updated`, `r_status`, `r_comment`) VALUES
(38, '2024-10-06 20:53:16', NULL, 'ZADE OCEAN B. DE GUZMAN', 'ZADE OCEAN B. DE GUZMAN', '09126712545', 67, 'BRGY. BANLIC CABUYAO LAGUNA', 'Cabuyao', ' GLOBAL MEDICAL CENTER OF LAGUNA', 'PRETERM', 'HOSPITAL BILL', 8000, 'eight thousand', 'WALK IN', NULL, NULL, NULL, NULL, 'pending', NULL),
(39, '2024-10-06 20:57:12', NULL, 'MARIFE A. ALUNAN', 'MARIFE A. ALUNAN', '09774364543', 51, 'BRGY. SALAC LUMBAN LAGUNA', 'Lumban', 'LAGUNA DOCTORS HOSPITAL', 'DM TYPE II', 'LABORATORY ', 3500, 'three thousand five hundred', 'WALK IN', NULL, NULL, NULL, NULL, 'pending', NULL),
(40, '2024-10-06 21:00:14', NULL, 'MARLENE E. FLORES', 'MARLENE E. FLORES', '09276547653', 56, 'BRGY. POBLACION DOS PAGSANJAN LAGUNA', 'Pagsanjan', 'LAGUNA DOCTORS HOSPITAL', 'CKD', 'DIALYSIS', 8000, 'eight thousand', 'C/O SIR EDWIN LAUREANO', NULL, NULL, NULL, NULL, 'pending', NULL),
(41, '2024-10-06 21:03:03', NULL, 'ABNER V. SERASPE', 'ABNER V. SERASPE', '0948754763', 57, 'BRGY. MAMATID CABUYAO LAGUNA', 'Cabuyao', 'CALAMBA MEDICAL CENTER', 'CKD', 'DIALYSIS', 3000, 'three thousand', 'WALK IN', NULL, NULL, NULL, NULL, 'pending', NULL),
(42, '2024-10-06 21:05:22', NULL, 'JHAYNESSA A. UBALDO', 'JHAYNESSA A. UBALDO', '09377631765', 32, 'BRGY. BALIMBINGAN LUMBAN LAGUNA', 'Lumban', 'LAGUNA HOLY FAMILY HOSPITAL INC.', 'CKD', 'DIALYSIS', 8000, 'eight thousand', 'WALK IN', NULL, NULL, NULL, NULL, 'pending', NULL),
(43, '2024-10-06 21:09:37', NULL, 'ANALY V. BONGANAY', 'ANALY V. BONGANAY', '093547328', 53, 'BRGY. PAGSAWITAN STA CRUZ LAGUNA', 'Santa Cruz', 'LAGUNA DOCTORS HOSPITAL', 'CVD BLEED', 'HOSPITAL BILL', 20000, 'twenty  thousand', 'C/O SIR EDWIN NARDO', NULL, NULL, NULL, NULL, 'pending', NULL),
(44, '2024-10-06 21:13:19', NULL, 'KAIDEN DALE ESCALA AGLIBUT', 'KAIDEN DALE ESCALA AGLIBUT', '09463767812', 1, 'BRGY. POBLACION 1, SANTA CRUZ LAGUNA', 'Santa Cruz', 'LAGUNA HOLY FAMILY HOSPITAL INC.', 'PNEUMONIA', 'HOSPITAL BILL', 14852, 'fourteen thousand eight hundred fifty two', 'C/O MAM LADYLEE ESCALA PDOH', NULL, NULL, NULL, NULL, 'pending', NULL),
(45, '2024-10-06 21:16:40', NULL, 'CRISLYN R. DELOS REYES', 'CRISLYN R. DELOS REYES', '09753542732', 34, 'BRGY. BULILAN NORTE PILA LAGUNA', 'Pila', 'LAGUNA HOLY FAMILY HOSPITAL INC.', 'CALCULUS CHOLECYSTITIS', 'LABORATORY AND MEDICAL PROCEDURE', 4500, 'four thousand five hundred', 'WALK IN', NULL, NULL, NULL, NULL, 'pending', NULL),
(46, '2024-10-06 21:22:13', NULL, 'MARIA ELMIRA PAMADA', 'MARIA ELMIRA PAMADA', '09563157637', 31, 'STA CRUZ LAGUNA', 'Santa Cruz', 'LAGUNA HOLY FAMILY HOSPITAL INC.', 'HYPERTENSION', 'MEDICINE/MEDICAL PROCEDURE', 10000, 'ten thousand', 'WALK IN', NULL, NULL, NULL, NULL, 'pending', NULL),
(47, '2024-10-06 21:25:28', 'CMCMAIPDOHRO4A-082124-LAGREG115', 'MARILOU D. EDRALINDA', 'MARILOU D. EDRALINDA', '095465165', 53, 'BRGY. POBLACION MAGDALENA LAGUNA', 'Magdalena', 'LAGUNA DOCTORS HOSPITAL', 'CKD', 'MEDICAL PROCEDURE', 3320, 'three thousand three hundred twenty', 'WALK IN', '2024-10-06', '3320', 'OFFICE OF THE MAYOR', '2024-10-06 22:58:01', 'approved', 'APPROVED'),
(48, '2024-10-06 21:28:26', NULL, 'AURORA L. ADRIANO', 'AURORA L. ADRIANO', '09764515153', 59, 'BRGY. STO NINO BINAN LAGUNA', 'Biñan', 'PERPETUAL HELP MEDICAL CENTER BINAN', 'DM TYPE II', 'HOSPITAL BILL', 25000, 'twenty five thousand', 'C/O MAM LYDIA', NULL, NULL, NULL, NULL, 'pending', NULL),
(49, '2024-10-06 21:30:47', NULL, 'CATALINA M. MANTALA', 'CATALINA M. MANTALA', '0953651453', 76, 'BRGY. KABULUSAN, PAKIL LAGUNA', 'Pakil', 'LAGUNA HOLY FAMILY HOSPITAL INC.', 'S/P WOUND DEBRIDEMENT', 'HOSPITAL BILL', 50000, 'fifty  thousand', 'DOC MANTALA', NULL, NULL, NULL, NULL, 'pending', NULL),
(50, '2024-10-06 21:33:03', NULL, 'BRIANNA L. CONSTANTINO', 'BRIANNA L. CONSTANTINO', '0967371535', 1, 'BRGY. BULILAN NORTE PILA LAGUNA', 'Pila', 'LAGUNA HOLY FAMILY HOSPITAL INC.', 'AGE MOD DHN', 'HOSPITAL BILL', 20000, 'twenty  thousand', 'C/O SIR KHOY PANTUA', NULL, NULL, NULL, NULL, 'pending', NULL),
(51, '2024-10-06 21:37:36', NULL, 'LYDIA C. BALINGASA', 'LYDIA C. BALINGASA', '0953615748', 65, 'BRGY. MAYONDON LOS BANOS LAGUNA', 'Los banos', 'LOS BANOS DOCTORS HOSPITAL AND MEDICAL CENTER', 'ACUTE RESPIRATORY FAILURE', 'HOSPITAL BILL', 20000, 'twenty  thousand', 'C/O LBDHMC SIR RAM AREVALO', NULL, NULL, NULL, NULL, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `r_request_requirements_tbl`
--

CREATE TABLE `r_request_requirements_tbl` (
  `req_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `r_request_requirements_tbl`
--

INSERT INTO `r_request_requirements_tbl` (`req_id`, `r_id`, `filename`, `path`) VALUES
(31, 38, 'REQ.png', '../upload/REQ.png'),
(32, 39, 'REQ.png', '../upload/REQ.png'),
(33, 40, 'REQ.png', '../upload/REQ.png'),
(34, 41, 'REQ.png', '../upload/REQ.png'),
(35, 42, 'REQ.png', '../upload/REQ.png'),
(36, 43, 'REQ.png', '../upload/REQ.png'),
(37, 44, 'REQ.png', '../upload/REQ.png'),
(38, 45, 'REQ.png', '../upload/REQ.png'),
(39, 46, 'REQ.png', '../upload/REQ.png'),
(40, 47, 'REQ.png', '../upload/REQ.png'),
(41, 48, 'REQ.png', '../upload/REQ.png'),
(42, 49, 'REQ.png', '../upload/REQ.png'),
(43, 50, 'REQ.png', '../upload/REQ.png'),
(44, 51, 'REQ.png', '../upload/REQ.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accnt_tbl`
--
ALTER TABLE `accnt_tbl`
  ADD PRIMARY KEY (`accnt_id`),
  ADD KEY `accnt_type` (`accnt_type`);

--
-- Indexes for table `accnt_type`
--
ALTER TABLE `accnt_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `municipality`
--
ALTER TABLE `municipality`
  ADD PRIMARY KEY (`mun_id`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `r_request_requirements_tbl`
--
ALTER TABLE `r_request_requirements_tbl`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `r_id` (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accnt_tbl`
--
ALTER TABLE `accnt_tbl`
  MODIFY `accnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `accnt_type`
--
ALTER TABLE `accnt_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `municipality`
--
ALTER TABLE `municipality`
  MODIFY `mun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `r_request_requirements_tbl`
--
ALTER TABLE `r_request_requirements_tbl`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accnt_tbl`
--
ALTER TABLE `accnt_tbl`
  ADD CONSTRAINT `accnt_tbl_ibfk_1` FOREIGN KEY (`accnt_type`) REFERENCES `accnt_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_request_requirements_tbl`
--
ALTER TABLE `r_request_requirements_tbl`
  ADD CONSTRAINT `r_request_requirements_tbl_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `request_tbl` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
