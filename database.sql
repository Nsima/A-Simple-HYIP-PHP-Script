-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2017 at 08:57 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pay`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_queue`
--

CREATE TABLE IF NOT EXISTS `action_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_time` varchar(100) DEFAULT NULL,
  `action_repeat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=633 ;

--
-- Dumping data for table `action_queue`
--

INSERT INTO `action_queue` (`id`, `action_time`, `action_repeat`) VALUES
(632, '1491643431', '3600');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL,
  `news` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `news`) VALUES
(1, 'Registration is ongoing \r\nProgrammers are working to ensure all participants can get on the site without difficulty or server errors. \r\nThe list will be out by 6pm today. \r\nPlease bear with us.');

-- --------------------------------------------------------

--
-- Table structure for table `list_date`
--

CREATE TABLE IF NOT EXISTS `list_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `release_time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=408 ;

--
-- Dumping data for table `list_date`
--

INSERT INTO `list_date` (`id`, `release_time`) VALUES
(407, '1491033602');

-- --------------------------------------------------------

--
-- Table structure for table `list_status`
--

CREATE TABLE IF NOT EXISTS `list_status` (
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_status`
--

INSERT INTO `list_status` (`status`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `match_queue`
--

CREATE TABLE IF NOT EXISTS `match_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payer_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `confirmed` int(11) DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `complete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `idu` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `acc_name` varchar(100) DEFAULT NULL,
  `acc_number` varchar(15) DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `admin_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`idu`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=264 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`idu`, `name`, `username`, `email`, `password`, `phonenumber`, `bank_name`, `acc_name`, `acc_number`, `block`, `date`, `admin_user`) VALUES
(1, 'nkem', 'sholake', 'nkemdirimarukwe@gmail.com', 'happygallow', '08124043226', 'Access Bank', 'Arukwe Chinelo Oluchi', '0055919911', 0, '2017-03-30 21:00:40', 1),
(3, 'Cindy', 'Cindyberry', 'minajcindy@yahoo.com', 'cindy123', '08095909224', 'Zenith bank', 'Cynthia', '2081698060', 0, '2017-03-30 21:01:33', 0),
(4, 'Ife clinecole', 'Ifybaby', 'ifecole@yahoo.com', 'ifeyinwa2015', '08033340468', 'Diamond bank', 'Ifeyinwa cline-cole', '0000868070', 0, '2017-03-30 21:03:13', 0),
(5, 'olawale stacey', 'Yecats', 'staceyola1@gmail.com', 'webmaster001', '08135630662', 'UBA Bank', 'Olawale Stacey', '2076441569', 0, '2017-03-30 21:03:32', 0),
(6, 'Olorunsola Isaac', 'Topccy', 'topeolorunsola@yahoo.com', 'Mcfish0001', '09038614417', 'First bank', 'Olorunsola Temitope Isaac', '2031652511', 0, '2017-03-30 21:03:42', 0),
(7, 'florence', 'floxy88', 'ayeuriah@gmail.com', 'otonye89', '08062568640', 'fidelity', 'florence anokwuru', '6171632469', 0, '2017-03-30 21:04:12', 0),
(8, 'magu', 'maguu', 'neloarukwe@gmail.com', 'nkem', '94837249389', 'Access Bank', 'Arukwe Chinelo Oluchi', '0055919911', 0, '2017-03-30 21:04:15', 0),
(9, 'tina', 'TInny', 'tinaofume9@gmail.com', 'demilola', '08134973268', 'fidelity bank', 'ofume tina', '6235565492', 0, '2017-03-30 21:04:51', 0),
(10, 'Onuwaje tuale', 'tfame3865', 'tualety49@gmail.com', '38656172', '08138656172', 'Access bank', 'Onuwaje tuale', '0689530340', 0, '2017-03-30 21:05:50', 0),
(11, 'Oladimeji', 'bollarcash', 'adaramoyeoladimeji@yahoo.com', 'tolu2010', '07034215360', '1St bank', 'Oladimeji adaramoye', '2031652360', 0, '2017-03-30 21:06:36', 0),
(12, 'BENJAMIN ONYEOCHA', 'daddyben', 'benjaminonyeocha@yahoo.com', 'heavenlove', '08068176738', 'Access', 'ONYEOCHA BENJAMIN', '0019977548', 0, '2017-03-30 21:07:09', 0),
(13, 'Abaniwo Rose', 'Realme', 'abaniworose@gmail.com', 'mafo12', '08069314998', 'GT Bank', 'Abaniwo rose mafo', '0150245084', 0, '2017-03-30 21:09:14', 0),
(14, 'Mina Allison', 'Juminaj', 'minajjumbo@gmail.com', 'titanic1', '07037349992', 'Diamond bank', 'Mina Allison', '0000543209', 0, '2017-03-30 21:10:01', 0),
(15, 'ada ibekwe', 'adaibekwe', 'ada_ibekwe@yahoo.com', 'miracle@', '08033805719', 'skye', 'ibekwe nkiru ada', '3010718926', 0, '2017-03-30 21:10:32', 0),
(16, 'Adeyinka Adeleke', 'ayinkuzee', 'ayinkuzee@yahoo.com', 'AYinka@83', '08034285215', 'GTB', 'Adeyinka Adeleke', '0013989768', 0, '2017-03-30 21:13:15', 0),
(17, 'Akande', 'sambio', 'akabiosam1@gmail.com', 'odunayomi', '08061138146', 'Gtb', 'Akande Biodun Samuel', '0125977503', 0, '2017-03-30 21:14:41', 0),
(18, 'Ibrahim Fuad', 'Rolayoib', 'rolayoib@yahoo.com', 'rolayo', '09069722077', 'GTB', 'Ibrahim fuad', '0171174316', 0, '2017-03-30 21:14:44', 0),
(19, 'Offor Franklin Chibuike', 'Blankis88', 'offorfranklinchibuike@gmail.com', 'amanda4me', '08065446781', 'First Bank', 'Offor Franklin Chibuike', '3099986253', 0, '2017-03-30 21:17:00', 0),
(20, 'Stanley', 'Stanleynuel', 'stanleychibuzor83@gmail.com', 'stanleychi', '08164608101', 'Eco', 'Odozie chibuzor Stanley', '2151295424', 0, '2017-03-30 21:17:49', 0),
(21, 'Jonathan', 'Lanjonath', 'Lanjonath@hotmail.com', 'mafloy', '08131506603', 'Zenith', 'Jonathan Idowu', '2081244986', 0, '2017-03-30 21:20:13', 0),
(22, 'olusola', 'solad5159', 'solad5159@yahoo.com', 'oladimeji6069', '08060695159', 'GTB', 'oladimeji olusola o', '0037046142', 0, '2017-03-30 21:20:16', 0),
(23, 'Hannah', 'ChallyHan', 'hannahdavidabaniwo@gmail.com', '20081995', '08138896434', 'Zenith Bank', 'Abaniwo Hannah Esuga', '2083593499', 0, '2017-03-30 21:21:10', 0),
(24, 'Boom', 'Boom', 'BBoom7037@gmail.com', 'bookbook', '09076540454', 'FirstBank', 'Nneka Emelieze', '3055310973', 0, '2017-03-30 21:21:15', 0),
(25, 'Doris', 'amanda2013', 'ujunwamelu@gmail.com', 'uju1990', '08034833498', 'diamond Bank', 'OLUA Doris uju', '0022876837', 0, '2017-03-30 21:21:53', 0),
(26, 'Frank val', 'frankyvalll', 'ifezimefrank3@gmail.com', 'fevi14', '08038784508', 'ZENITH', 'IFEZIME FRANKLIN', '2085661965', 0, '2017-03-30 21:22:00', 0),
(27, 'Akinoso Bolaji', 'zeemaraj', 'Akinosobolaji@gmail.com', 'tolulope51', '08062574216', 'Stanbic ibtc', 'Akinoso Bolaji', '0005512929', 0, '2017-03-30 21:22:16', 0),
(28, 'johnson', 'breeze', 'adeayobi@gmail.com', 'skillet', '08037641811', 'zenith', 'johnson akanbi', '2003345702', 0, '2017-03-30 21:22:42', 0),
(29, 'Ohanebo Monica', 'Mhornikhar', 'onyinyefrancisca14@gmail.com', '666426', '08137441333', 'Diamond bank', 'Ohanebo Monica Onyinyechukwu', '0030153054', 0, '2017-03-30 21:23:16', 0),
(30, 'Prekuna', 'Prekuna', 'kunaplanet@gmail.com', '40d765e4', '08039410786', 'Zenith bank', 'Caleb sagbe', '2176448417', 0, '2017-03-30 21:24:29', 0),
(31, 'Aisha aisha', 'aisha', 'ashizzy19@yahoo.com', 'adeigbe19', '09032645540', 'Gtbank', 'Adeigbe Aishat Omowunmi', '0137358114', 0, '2017-03-30 21:25:16', 0),
(32, 'Jay', 'cashthings', 'kingoscardon@gmail.com', 'thebossman%$', '07036710873', 'GTB', 'Oscar Uzoma', '0029935207', 0, '2017-03-30 21:25:33', 0),
(33, 'Ugheoke Itsoghena Mary', 'oshiomamo', 'itsoghenamary@yahoo.com', 'awesome', '08057398166', 'First Bank', 'Ugheoke Itsoghena Mary', '3024136504', 0, '2017-03-30 21:26:53', 0),
(34, 'Ajibade olushola', 'shola89', 'ajibadeolushola89@gmail.com', 'shollyman4973', '08064467672', 'fcmb', 'ajibade olushola', '2680065017', 0, '2017-03-30 21:27:54', 0),
(35, 'Akingbulu Adewumi', 'Adewumi', 'folasadeadewumi.aa@gmail.com', 'emerald96', '07017229466', 'Gt bank', 'Akingbulu Adewumi', '0126897130', 0, '2017-03-30 21:28:15', 0),
(36, 'Odofin David', 'Khulong', 'david.odofin@yahoo.com', 'Olasunkanmi@1', '08030728572', 'First bank', 'Odofin David', '3034805140', 0, '2017-03-30 21:28:42', 0),
(37, 'Jennifer ndukwe', 'hottie', 'jaykaybeu@yahoo.com', '080ndukwe', '08032723295', 'first bank', 'Jennifer ndukwe', '3016048011', 0, '2017-03-30 21:28:49', 0),
(38, 'loveth nwosu', 'loveth', 'lovethnwosu@ymail.com', 'ronnexy030589', '07062630017', 'diamond bank', 'loveth nwosu', '0004245783', 0, '2017-03-30 21:29:26', 0),
(39, 'George Ani', 'George', 'georgeosinachiani@gmail.com', 'chukwunyeremaka', '08142374909', 'First Bank', 'George Osinachi Ani', '3077602410', 0, '2017-03-30 21:32:11', 0),
(40, 'olori dee', 'olori', 'mintgreenventures@gmail.com', 'temitope', '08033685693', 'first bank plc', 'Damola-Ogunsola Olubunmi', '3089639208', 0, '2017-03-30 21:33:13', 0),
(41, 'Chidinma', 'Dinmadamsy', 'kingsjudith@gmail.com', 'kings1990', '08061277451', 'Diamond', 'Eze Chidinma Judith', '0019327111', 0, '2017-03-30 21:33:38', 0),
(42, 'Helen imaghodor', 'Lenosa', 'imaggs.ie@gmail.com', 'eghosa1998', '08033259561', 'UBA', 'helen Imaghodor', '2002716596', 0, '2017-03-30 21:34:42', 0),
(43, 'Charisma', 'Charismaagu', 'charismaagu@gmail.com', 'password', '09053056489', 'Gtbank', 'Charisma Agu', '0109089903', 0, '2017-03-30 21:34:56', 0),
(44, 'Bokolo uzoamaka', 'Clarryb', 'bokolouzoamaka@gmail.com', '98659', '08169175676', 'Diamond bank', 'Bokolo uzoamaka', '0086414877', 0, '2017-03-30 21:35:18', 0),
(45, 'Bosede', 'Bosman', 'bosedw@yahoo.com', 'tife7278', '07063341686', 'GTbank', 'Bosede Oyekunle', '0140457716', 0, '2017-03-30 21:35:49', 0),
(46, 'Nwankwo Ebenezar', 'BenTej', 'donebey@gmail.com', 'ebeny101', '08134015098', 'Gtbank', 'nwankwo ebenezar', '0233280599', 0, '2017-03-30 21:37:17', 0),
(47, 'Patience', 'Elijah', 'patteeglamour@gmail.com', 'blissmi', '08066888984', 'UBA', 'Patience Elijah', '2043839812', 0, '2017-03-30 21:37:39', 0),
(48, 'Ayomiposi', 'Ajicom', 'aribilolaayomiposi@gmail.com', 'Sogbeminija01', '08032425145', 'GT bank', 'ARIBILOLA Ayomiposi', '0049623799', 0, '2017-03-30 21:40:57', 0),
(49, 'saint', 'saint', 'opeyemidairo0007@gmail.com', 'micheal', '07030536090', 'Access bank', 'Dairo Opeyemi', '0693773058', 0, '2017-03-30 21:42:45', 0),
(50, 'Lekan', 'Geo-Seedorph', 'Lekkyworld@gmail.com', 'Olami4891', '08038519466', 'First Bank', 'Ogundare Saheed Tunji', '3048347771', 0, '2017-03-30 21:44:51', 0),
(52, 'Blessing banro', 'Blessyn', 'blessingbanro@yahoo.com', 'adebunmi1', '08031849978', 'Fcmb', 'Banro blessing', '2286592012', 0, '2017-03-30 21:45:45', 0),
(53, 'linda', 'lindie', 'lindachukwu@yahoo.com', 'sheila61', '07038254003', 'first bank', 'Linda chukwu', '3086003141', 0, '2017-03-30 21:46:02', 0),
(54, 'Ojo', 'Ayoola11', 'ojoayoola1130@gmail.com', 'olorun1130', '08163466962', 'Gtb', 'Ojo Ayoola', '0036241029', 0, '2017-03-30 21:50:12', 0),
(55, 'Segun Tyson', 'Toyinseg', 'ayodele.toyin1@gmail.com', 'joseph12', '08032238808', 'Guaranty Trust Bank plc', 'Ayodele Joseph Segun', '0126754200', 0, '2017-03-30 21:51:05', 0),
(56, 'Goke Tobi', 'goketobi', 'goketobi@gmail.com', 'oluwatobi/88', '08106701252', 'Access Bank', 'Olagoke Oluwatobi', '0689665387', 0, '2017-03-30 21:51:30', 0),
(57, 'Philemon', 'Pamipolo', 'philemondavid604@yahoo.com', 'sairuwa1', '08065645360', 'Zenith bank', 'Sairuwa Philemon', '2087048863', 0, '2017-03-30 21:52:58', 0),
(58, 'Nwachukwu Stanley', 'Stankonia', 'stankonia58@gmail.com', 'obumneke', '07033770647', 'FCMB', 'Nwachukwu Stanley', '3738762018', 0, '2017-03-30 21:53:55', 0),
(59, 'Abdulsalam ibn abdulsalam', 'Sirlamkhan', 'sirlamkhan@gmail.com', 'babatunde123', '08164900490', 'Gtbank', 'Abdulsalam ibn abdulsalam', '0140367978', 0, '2017-03-30 21:54:36', 0),
(60, 'Hannah Ikuenobe', 'Onose2017', 'ihannah82@yahoo.com', 'Azuka2017', '08067908718', 'Zenith Bank', 'Hannah Ikuenobe', '2088761615', 0, '2017-03-30 21:54:39', 0),
(61, 'Fatoyinbo', 'Sunnyx90', 'sunnyx90@yahoo.com', 'sunday4real', '07031821795', 'Gtb', 'Fatoyinbo Gbenga', '0152922651', 0, '2017-03-30 21:55:03', 0),
(62, 'Samson falade', 'Psammy', 'samade4luv@yahoo.com', 'babatunde', '08060906100', 'Firstbank', 'Samson falade', '3023527839', 0, '2017-03-30 21:55:03', 0),
(63, 'Babatunde', 'KingDavid', 'tunde.olambo@gmail.com', 'john3162017', '08030483869', 'GTbank', 'Olambo Babatunde', '0011268353', 0, '2017-03-30 21:55:19', 0),
(64, 'Choice', 'ChoiceTeejay', 'choiceomokiniovo@gmail.com', 'ouchboss', '08135210271', 'Unity', 'Choice', '0026557382', 0, '2017-03-30 21:55:47', 0),
(65, 'Edidiong James', 'Eddyjames', 'Edijames11@yahoo.com', '19999999', '08179127278', 'Diamond bank', 'James Edidiong', '0029652670', 0, '2017-03-30 21:56:33', 0),
(66, 'Chris', 'kristo', 'oyakhirechris1@gmail.com', 'master', '08124368086', 'Diamond bank', 'Chris Itavbusiogben', '0085656641', 0, '2017-03-30 21:57:30', 0),
(67, 'Ogu Hope', 'Hope1', 'Hopeogu90@gmail.com', 'ogu12345', '08062590412', 'First bank', 'Ogu Hope A', '3025887580', 0, '2017-03-30 22:01:27', 0),
(68, 'Adebowale femi', 'steamy7', 'kausedavid@gmail.com', 'danjuman', '08080806940', 'Accessbank', 'Adebowale femi', '0037116129', 0, '2017-03-30 22:03:29', 0),
(69, 'Ugochukwu Aniegboka', 'Emma_047', 'aniegbokaugochukwu@gmail.com', 'hydrocarbon', '08144536627', 'Zenith Bank', 'Aniegboka ugochukwu', '2082154602', 0, '2017-03-30 22:04:11', 0),
(70, 'Lite', 'ThankGod', 'orjithankgod25@gmail.com', 'power12345', '08060539289', 'Diamond bank', 'Orji o', '0055256208', 0, '2017-03-30 22:04:49', 0),
(71, 'Isiono Sada', 'Elita', 'isionosada78@gmail.com', 'mimi@40', '08089344796', 'Gtb', 'Isiono sada', '0009999258', 0, '2017-03-30 22:05:12', 0),
(72, 'Nkechi', 'Anyanwu', 'nkechimatara@gmail.com', 'lilian', '08062177531', 'Gtb', 'Nkechi Anyanwu', '0117694205', 0, '2017-03-30 22:06:46', 0),
(73, 'samson Ediogyawere', 'sam333', 'sam33@gmail.com', '08052056099', '08065678342', 'first bank', 'samson Ediogyawere', '0108566789', 0, '2017-03-30 22:08:32', 0),
(74, 'Amina', 'Amina', 'aminat@gmail.com', 'amina070', '09076220275', 'Gtbank', 'Husseini zuwaira', '0115588955', 0, '2017-03-30 22:11:07', 0),
(75, 'Lucky Euna', 'Eunex', 'eunex250@gmail.com', 'secouc', '08038679636', 'FCMB', 'Lucky C Euna', '2470384010', 0, '2017-03-30 22:13:20', 0),
(76, 'Lola', 'lolyloly', 'loly2g@yahoo.com', 'lolypop', '08029315076', 'Access', 'Owolabi lolade', '0004520784', 0, '2017-03-30 22:17:09', 0),
(77, 'Ozang Stephen', 'stevoo11', 'sirraymond2@gmail.com', 'stevoo11', '08062250869', 'Skye Bank', 'Ozang Stephen', '3031020415', 0, '2017-03-30 22:18:44', 0),
(78, 'Ifejokwu', 'Kachy', 'kachy_2@yahoo.com', '08067138685', '08067138685', 'Eco bank', 'Ifejokwu Onyekachi', '4371068518', 0, '2017-03-30 22:29:08', 0),
(79, 'Nze', 'Raphael', 'nzeraph@gmail.com', '123456', '07063009987', 'first bank', 'Nzekwe onyeka', '3089536912', 0, '2017-03-30 22:29:35', 0),
(80, 'Gbebikan racheal', 'rachygbebs', 'rachypels50@gmail.com', 'anike.96', '08109672511', 'Gtbank', 'Gbebikan Rachael', '0127066733', 0, '2017-03-30 22:31:48', 0),
(81, 'ken Isi', 'keb16', 'kenebhomielen@gmail.com', '08064679200', '08099144443', 'GTB', 'kenneth Ebhomielen', '0107588639', 0, '2017-03-30 22:34:22', 0),
(82, 'Keji tayo', 'kgytayo', 'keshy4life@yahoo.com', 'investment17', '08028152434', 'GTB', 'Keji tayo', '0016921668', 0, '2017-03-30 22:34:50', 0),
(83, 'Abiodun Ganiyat', 'Timilehinab', 'timmy4u@live.com', 'thimmie', '07067342718', 'Ecobank', 'Abiodun Ganiyat', '4572106518', 0, '2017-03-30 22:35:48', 0),
(84, 'Akinbodewa emmanuel o', 'tossy1212', 'tossyemmanuel@gmail.com', 'tossycatty', '08030497624', 'First bank', 'Akinbodewa Emmanuel o', '3030495734', 0, '2017-03-30 22:39:31', 0),
(85, 'Shola Oyeniyi', 'shola', 'sholaoyeniyi@yahoo.com', 'kolade', '08073801732', 'Access Bank', 'Oyeniyi Olushola M', '0046263858', 0, '2017-03-30 22:40:26', 0),
(86, 'Chizoba Okechukwu', 'sunshyne', 'chizysunshyne@gmail.com', 'prechizy', '08137587284', 'first bank', 'Okechukwu Chizoba', '3033832734', 0, '2017-03-30 22:41:13', 0),
(87, 'Mma Achugwo', 'Moraz', 'morazulike2000@yahoo.com', 'morazmoraz', '08034817860', 'Zenith bank', 'Mmachukwu Achugwo', '2020130893', 0, '2017-03-30 22:43:40', 0),
(88, 'Yomi', 'ababalola', 'abayomi4u@gmail.com', 'Mine4eva!', '08034254246', 'GTB', 'Abayomi Samuel Babalola', '0122459806', 0, '2017-03-30 22:44:46', 0),
(89, 'Ugochukwu', 'Nedu', 'Emma_047@yahoo.com', 'hydrocarbon', '08144526627', 'Zenith Bank', 'Aniegboka ugochukwu', '2082154602', 0, '2017-03-30 22:47:02', 0),
(90, 'Ukachi Jane', 'Zinny25', 'godfav6@gmail.com', '909090', '08155132568', 'Access Bank', 'Ukachi Jane', '0054725481', 0, '2017-03-30 22:49:12', 0),
(91, 'Basuo otonye', 'BOSSMANT', 'oti_basuo@yahoo.com', 'otonye89', '08063842424', 'Access Bank', 'Basuo Collins otonye', '0019713418', 0, '2017-03-30 22:52:03', 0),
(92, 'Ruth', 'Pearlryl', 'pearlryl@gmail.com', '26102610', '08062424133', 'First Bank', 'Ruth James', '3085478281', 0, '2017-03-30 22:54:48', 0),
(93, 'Tetra Zee', 'tetrazee', 'Funmiada1@gmail.com', 'bracelet', '08090150406', 'Diamond Bank', 'Elsie Aka', '0004012864', 0, '2017-03-30 22:55:37', 0),
(94, 'Skyrider', 'Skyrider', 'donhui@zoho.com', 'batuta123', '08033333168', 'First bank', 'Ikenna', '3102993009', 0, '2017-03-30 22:55:43', 0),
(95, 'Eboselume', 'Eboski', 'eby.fidelis@yahoo.com', 'forever2017', '07033430707', 'Zenith bank', 'Oigiagbe Eboselume', '2006758349', 0, '2017-03-30 23:10:14', 0),
(96, 'Franca', 'francip', 'francpalmero@gmail.com', 'trident12', '07032171618', 'diamondbank', 'FranciscaPalmer', '0029875011', 0, '2017-03-30 23:11:28', 0),
(97, 'Ogundele Damilola', 'Aquarium', 'dimpleddara15@gmail.com', 'dara2017', '08148759151', 'Access', 'Ogundele Damilola', '0034865574', 0, '2017-03-30 23:13:11', 0),
(98, 'MADU OKEHI', 'MAZINO', 'maduokehi@gmail.com', 'zimkpa4u', '08031966404', 'ACCESS', 'OKEHI MADUZIMKPA', '0017124520', 0, '2017-03-30 23:14:01', 0),
(99, 'Michael', 'Teguss', 'oteguss@gmail.com', 'praises', '07066559494', 'Diamond Bank', 'Tega Michael Igbinedion', '0029890591', 0, '2017-03-30 23:16:48', 0),
(100, 'Olisa', 'Olisa123', 'quizzy_83@hotmail.com', 'chibusky', '08025957443', 'Diamond bank', 'Okechukwu okwuolisa chibuzo', '0069701370', 0, '2017-03-30 23:23:07', 0),
(101, 'Nnennaya', 'Nnennaya', 'eboselumeoigiagbe93@gmail.com', 'burger', '08112708685', 'UBA', 'Mba Nnennaya', '2050780154', 0, '2017-03-30 23:27:45', 0),
(102, 'Janta', 'Janta123', 'wasbusted@yahoo.com', 'chibusky', '07054184178', 'Diamond bank', 'Okechukwu okwuolisa chibuzo', '0069701370', 0, '2017-03-30 23:27:45', 0),
(103, 'Ajala Desola', 'dezzy', 'desolaakinbolu@yahoo.com', 'lovelyday', '08020591961', 'Fcmb', 'Ajala Desola', '0564245016', 0, '2017-03-30 23:29:27', 0),
(104, 'Awofeso Kudirat', 'Kudirat', 'kouldstylist@yahoo.com', 'thimmie', '07067342718', 'Gtb', 'Awofeso Kudirat', '0235058671', 0, '2017-03-30 23:30:14', 0),
(105, 'Tgot', 'Tgot', 'tgot1960@gmail.com', 'bookbook', '09076540454', 'FirstBank', 'Nneka Emelieze', '3055310973', 0, '2017-03-30 23:31:41', 0),
(106, 'Ethel', 'Xclusivee', 'd.xcluzzy16@gmail.com', 'XCLUSIVEE1', '08167641499', 'Access Bank', 'Agba Ethel Amarachi', '0058849972', 0, '2017-03-30 23:31:41', 0),
(107, 'Afees Olufemi Kushimo', 'phemmykush', 'phemmykush@gmail.com', 'obstacle', '08038549879', 'Guaranty Trust Bank PLC', 'Afees Olufemi Kushimo', '0026814848', 0, '2017-03-30 23:34:08', 0),
(108, 'Rauf Ganiu', 'tyoung', 'fatykikeduservices@gmail.com', 'education', '08030457673', 'ZENITH BANK', 'Rauf Ganiu', '2005017030', 0, '2017-03-30 23:36:37', 0),
(109, 'Ezeigbo frank chisom', 'kingfrank', 'ezeigbofrank02@gmail.com', 'Asadon12', '08143553372', 'firstbank', 'Ezeigbo frank chisom', '3049753504', 0, '2017-03-30 23:41:49', 0),
(110, 'Obum', 'Obum', 'stone2ken@gmail.com', 'chibusky', '08025957443', 'Fidelity', 'Carousel intl', '5600179092', 0, '2017-03-30 23:42:09', 0),
(111, 'Stone', 'Stone', 'joleribe@yahoo.com', 'chibusky', '08025957443', 'Fidelity', 'Carousel intl', '5600179092', 0, '2017-03-30 23:45:06', 0),
(112, 'Titilayo', 'Teety', 'odukoyatitilayo11@gmail.com', '123456', '08035273157', 'First bank', 'Titilayo Odukoya', '3039809435', 0, '2017-03-30 23:49:07', 0),
(113, 'Muna Achugwo', 'Obeleagu', 'munaachugwo1111@gmail.com', 'morazmoraz', '08034817860', 'Zenith bank', 'Munachimso Achugwo', '2050411171', 0, '2017-03-30 23:51:58', 0),
(114, 'Remilekun Amos', 'Remi007', 'remilekunamos2050@gmail.com', 'remi007', '08053118537', 'First bank', 'Remilekun Amos Beatrice', '3017873726', 0, '2017-03-30 23:59:18', 0),
(115, 'Olaide soda', 'Olaheedey', 'olaheedeymafe@yahoo.com', 'lasvegas06', '08099441610', 'Uba', 'Olaide soda', '2019443940', 0, '2017-03-31 00:03:43', 0),
(116, 'Susan Maggs', 'Susan', 'mailsuzane@gmail.com', 'omojohnson', '08117797517', 'Gtb', 'Susan Johnson', '0121710955', 0, '2017-03-31 00:08:54', 0),
(117, 'Olorunsola Tosin', 'Olorunsketch', 'olorunsketch@gmail.com', 'rimolla123', '07084255556', 'Gtb', 'Olorunsola Tosin Emmanuel', '0045519195', 0, '2017-03-31 00:10:50', 0),
(118, 'Adekunle', 'koonlay', 'koonlayoshodi@gmail.com', 'manmee', '08099441234', 'Diamond Bank', 'Adekunle Oshodi', '0016030573', 0, '2017-03-31 00:18:34', 0),
(119, 'Efe Odiri', 'effe', 'odiriendurance@gmail.com', 'rimolla123', '08134379528', 'Zenith Bank', 'Efe Odiri', '2100092675', 0, '2017-03-31 00:25:19', 0),
(120, 'Maximus Njoku', 'MajorMax', 'maximus.njoku@yahoo.com', 'smanhadley', '07038371182', 'Fidelity', 'Njoku Maximus U.', '6171469724', 0, '2017-03-31 00:38:55', 0),
(121, 'Abdul Jubril', 'Lakun', 'habdullahjibreal@gmail.com', 'olakunle', '09030576903', 'First bank', 'Abdullah jubril', '3110860131', 0, '2017-03-31 00:42:04', 0),
(122, 'Asadu James', 'James82', 'funkyjay12@gmail.com', 'james82', '07032042882', 'UBA', 'Asadu James Obiora', '2044208648', 0, '2017-03-31 00:48:21', 0),
(123, 'Syntyche Esenowo', 'Syntech01', 'esenowosyntyche@gmail.com', 'syntech01', '08135371064', 'GTB', 'Esenowo Syntyche', '0142138051', 0, '2017-03-31 00:54:28', 0),
(124, 'Bblizy', 'bblizy43', 'bblizy43@gmail.com', 'bblizy43', '08164029879', 'UBA', 'Okoror', '2063846379', 0, '2017-03-31 00:56:47', 0),
(125, 'henry cyprian c', 'hendox', 'chukwuka31@yahoo.com', 'henro26', '08130692991', 'first bank of nigeria', 'henry chukwuka', '3020954854', 0, '2017-03-31 00:57:21', 0),
(126, 'Rolly Swiss', 'Rollyswiss', 'Princessgoldie03@gmail.com', 'Goldie10', '2349036626375', 'Skyebank', 'OMOEDEH RICHWELL', '3019451857', 0, '2017-03-31 01:01:56', 0),
(127, 'Stephanie', 'treasure', 'joypopins@yahoo.com', 'hub55', '09029649435', 'access', 'Okedinachi stephanie joy', '0006712097', 0, '2017-03-31 01:11:59', 0),
(128, 'gerald cy', 'gerald12', 'geraldcyprian@gmail.com', 'HENRO26', '08069208966', 'GTB', 'GERALD CHUKWUKA', '0109512539', 0, '2017-03-31 01:13:10', 0),
(129, 'Cordelia Nwadi', 'Nwadi001', 'cordeliannjoku@gmail.com', 'nwadi001', '08087702665', 'Skye bank', 'Cordelia Nwadi Njoku', '3016583414', 0, '2017-03-31 01:17:29', 0),
(130, 'Bibian Nwankwo', 'keshmum', 'keshmum76@yahoo.com', '39489970', '07039489970', 'Diamond bank', 'Bibian Nwankwo', '0021086929', 0, '2017-03-31 01:19:49', 0),
(131, 'Elina onos', 'Elina', 'elina.onomuophu@gmail.com', 'elina09', '08099449010', 'First bank', 'Elina onomuophu', '3066279137', 0, '2017-03-31 01:23:35', 0),
(132, 'EMEKA CHUKWUKA', 'Emmyboy', 'chukaemeka@gmail.com', 'henro26', '08186999767', 'fidelity bank', 'chukwuka henry', '6171992714', 0, '2017-03-31 01:30:17', 0),
(133, 'Akinleye odunola', 'Olamii', 'bettychard15@yahoo.com', 'dhix96', '08104215018', 'Wema bank', 'Akinleye odunola', '0228322502', 0, '2017-03-31 01:41:05', 0),
(134, 'Vivian Elekwa', 'Ninaviv91', 'vivianelekwa@gmail.com', 'nnenna91', '08184809264', 'Diamond bank', 'Elekwa Vivian', '0018282053', 0, '2017-03-31 01:45:46', 0),
(135, 'precious onu', 'precie40', 'nkechif1986@gmail.com', '2012jeffrey', '08182245733', 'fcmb', 'ou precious E', '3077419013', 0, '2017-03-31 01:45:57', 0),
(136, 'gerald chukwuka', 'gboy', 'geraldchukwuka@yahoo.com', 'henro26', '09055044344', 'stanbic IBTC', 'GERALD CHUKWUKA', '0011785209', 0, '2017-03-31 01:50:19', 0),
(138, 'olapade Samuel', 'samest', 'olapadesam00@yahoo.com', 'iamawinner', '08067612109', 'access bank', 'olapade Samuel', '0051854803', 0, '2017-03-31 01:58:37', 0),
(139, 'Idachaba Friday', 'Pato', 'idachabafriday02@yahoo.com', 'rimolla123', '08062321065', 'GTB', 'Idachaba Friday', '0159974398', 0, '2017-03-31 02:00:52', 0),
(140, 'Ikebunwa Nchekwube', 'Nikebunwa', 'Nikeodogwu@gmail.com', '08069507152', '08069507152', 'Fidelity bank', 'Ikebunwa Nchekwube', '6170898084', 0, '2017-03-31 02:10:28', 0),
(141, 'Amusan Michael', 'amusanmikel', 'amusanmikel@gmail.com', 'mayowa', '08032122586', 'Gtb', 'Amusan michael', '0126452740', 0, '2017-03-31 02:23:16', 0),
(142, 'Ekere', 'Waris', 'warisekere@gmail.com', 'goodluck', '08063067297', 'Diamond bank', 'Ekere Francis', '0022671537', 0, '2017-03-31 03:26:11', 0),
(143, 'obiora anthonia', 'toniaj', 'menajiv@gmail.com', 'menajiv', '08036651806', 'fidelity', 'obiora effe', '5070120507', 0, '2017-03-31 03:57:43', 0),
(144, 'Oluwatoyin', 'Lorioba', 'adetutu2603@gmail.com', 'treasure', '07035041063', 'StanbicIBTC Bank', 'Oluwatoyin Adetutu Akapo', '0009628369', 0, '2017-03-31 04:04:22', 0),
(145, 'Favoured', 'Florish', 'Charityezeigbo123@gmail.com', 'holy2017', '08186475051', 'Firstbank', 'Firstbank', '3058542793', 0, '2017-03-31 04:08:25', 0),
(146, 'Chioma', 'mallycee', 'mallyc09@gmail.com', 'philewlin1992', '08062441223', 'Diamond Bank', 'Chioma Okechukwu', '0087177854', 0, '2017-03-31 04:14:18', 0),
(147, 'Joyous', 'Cheerful', 'Ezeigbo56@gmail.com', 'mark1990', '08186475051', 'Firstbank', 'Ezeigbo Charity', '3058542793', 0, '2017-03-31 04:18:18', 0),
(148, 'Tomoye Collins', 'Tomcollins', 'send2tomcollins@gmail.com', 'ayebanoa', '08064985196', 'Access Bank', 'Ayolagha CollinsTomoye', '0019713425', 0, '2017-03-31 04:18:40', 0),
(149, 'Chalse', 'Favoured', 'Charityezeigbo@gmail.com', 'Loveu2', '08186475051', 'Firstbank', 'Ezeigbo Charity', '3058542793', 0, '2017-03-31 04:24:11', 0),
(150, 'Olawale Yusuf', 'emeritus', 'fountainptserv@gmail.com', 'lagoscity', '08062389651', 'Diamond Bank', 'Yusuf Olawale F', '0002725182', 0, '2017-03-31 04:41:21', 0),
(151, 'Muna Egu', 'Munsman', 'egu.muna@gmail.com', 'Fatinrat1', '07062024442', 'Guaranty Trust Bank', 'Egu Muna Maurice', '0039732977', 0, '2017-03-31 04:50:50', 0),
(152, 'osas', 'osas', 'dohuber1@yahoo.com', '456789', '08119292899', 'zenith bank', 'osakpolor omorogbe', '2080305785', 0, '2017-03-31 04:52:58', 0),
(153, 'Olasimbo', 'Fredasam', 'simbebe2001@yahoo.com', 'kolorogun', '08023423897', 'Gtbank', 'Olasimbo Oshagbami', '0004458851', 0, '2017-03-31 05:01:28', 0),
(154, 'John Ani', 'bigjohn', 'ajmovies2016@gmail.com', '08036068665', '08036068665', 'Diamond bank', 'Ani john', '0034692199', 0, '2017-03-31 05:23:47', 0),
(155, 'Anaba Solomon chinedu', 'solomonjoe', 'solomondewise009@yahoo.com', 'belong009', '08080000296', 'diamond bank', 'Anaba Solomon chinedu', '0034770761', 0, '2017-03-31 05:25:06', 0),
(156, 'John Abah', 'Johnabah', 'Bigjformular@yahoo.com', '08036068665', '09079223485', 'Zenith bank', 'John Ani', '2084211741', 0, '2017-03-31 05:30:05', 0),
(157, 'abiodun', 'gbadu2k', 'gbadu2k@yahoo.com', 'opemywifee', '08029112797', 'gtbank', 'gbadebo abiodun', '0009708908', 0, '2017-03-31 05:32:20', 0),
(158, 'Oduwaye Mary', 'Goldenbimsy', 'bwealth6@gmail.com', 'olawalemi', '08185334164', 'Access Bank', 'Oduwaye Mary', '0035872333', 0, '2017-03-31 05:33:17', 0),
(159, 'Esther Akpan', 'Wemablooms', 'kowemaprofile@yahoo.co.uk', '@&amp;bloomyloo1', '08064956690', 'Access', 'Esther Akpan', '0690154289', 0, '2017-03-31 05:56:37', 0),
(160, 'Fola', 'moshow97', 'moshow97@yahoo.com', 'tomilosho', '09092132498', 'Fcmb', 'Afolabi moshood Abiola', '0586309017', 0, '2017-03-31 05:57:36', 0),
(161, 'Chukwudi endy', 'endyoflife', 'enddyofliffe@yahoo.com', 'ikenna1', '08065776084', 'Zenith', 'Chukwudi endy Ikenna', '2110657880', 0, '2017-03-31 05:59:09', 0),
(162, 'Amaka bassey', 'Amaka', 'casikeche@yahoo.com', 'xora2011', '08063928853', 'GTBank', 'Bassey Amaka', '0038347293', 0, '2017-03-31 06:00:33', 0),
(163, 'Oriasotie Oseghale', 'princefavian', 'oriasotieoseghale@gmail.com', 'innocent1993', '08137339300', 'first bank', 'Oriasotie Oseghale', '3085492290', 0, '2017-03-31 06:03:05', 0),
(164, 'Aidee mbre', 'Aidee', 'idongesitmbre@gmail.com', 'imembre', '08055121611', 'access bank', 'Idongesit mbre', '0045895005', 0, '2017-03-31 06:06:24', 0),
(165, 'Boma Jumbo', 'Jubom', 'bomajuliusjumbo@gmail.com', 'titanic1', '08124196426', 'First Bank', 'Boma Jumbo', '3022204649', 0, '2017-03-31 06:11:40', 0),
(166, 'ARTHUR RICHARD', 'Arthur2k5', 'Arthur2k5@gmail.com', 'onyekamother2020', '07030616719', 'DIAMOND BANK', 'ARTHUR RICHARD', '0077806223', 0, '2017-03-31 06:11:49', 0),
(167, 'Jane Ononyume', 'Awesome007', 'janeomayume@gmail.com', 'awesome', '08130664503', 'First Bank', 'ONONYUME OMAMOREDE JANE', '3048995299', 0, '2017-03-31 06:13:49', 0),
(168, 'Sharon Agu', 'Asharon', 'agusharon22@gmail.com', 'wonderful', '07062679262', 'Access bank', 'Agu Sharon', '0697368928', 0, '2017-03-31 06:20:03', 0),
(169, 'Temitope Opeyemi', 'Temmy', 'danieljomiloju@yahoo.com', 'King1011', '08172079044', 'Diamond Bank', 'Temitope Opeyemi', '0021110505', 0, '2017-03-31 06:26:12', 0),
(170, 'Adeola Adeniji', 'adeolas', 'adexy4u2nv@yahoo.com', 'adeniji', '08137990252', 'GTBank', 'Adeola Adeniji', '0114122512', 0, '2017-03-31 06:26:30', 0),
(171, 'Femi', 'Infinity', 'pheminiyi@gmail.com', 'kayode', '07031224290', 'Zenith bank', 'OYENIYI OLUWAFEMI', '2002255723', 0, '2017-03-31 06:31:55', 0),
(172, 'Chidimma', 'Luvlicindi', 'luvlicindi@gmail.com', 'nneamaka89', '08068841916', 'UBA', 'Okeke chidimma', '2046741385', 0, '2017-03-31 06:33:49', 0),
(173, 'Okonkwo maureen', 'talktomomo', 'talktomomo@yahoo.co.uk', 'maugirl1629', '08037758083', 'Diamond bank', 'Okonkwo maureen chinenye', '0071541751', 0, '2017-03-31 06:34:10', 0),
(174, 'wumi', 'sleek', 'wumit10@gmail.com', 'skillet', '08033682323', 'StanbicIbtc', 'Wumi Oyeniyi', '9304106796', 0, '2017-03-31 06:34:17', 0),
(175, 'Ayebaifie', 'ayecrown', 'ayebaifie22@gmail.com', 'ayeba001', '08062762110', 'Zenith bank', 'Ayebaifie obed', '2080801593', 0, '2017-03-31 06:37:31', 0),
(176, 'obi onyinye', 'onyi6060', 'onyinyeobi24@gmail.com', 'jehovaGod@123', '07063551063', 'uba', 'obi onyinye', '2062996435', 0, '2017-03-31 06:38:17', 0),
(177, 'Joseph Njuare', 'Jonjuare', 'Josephbisong@gmail.com', 'joseph3313', '08054564499', 'Diamond Bank', 'Joseph Bisong', '0049587165', 0, '2017-03-31 06:39:00', 0),
(178, 'Esther Abraham Adesola', 'Esther_', 'abrahamhaddassah@yahoo.com', 'password', '08082879650', 'Gtbank', 'Abraham Esther Adesola', '0111822213', 0, '2017-03-31 06:39:14', 0),
(179, 'onuorah shedrach', 'shedluv', 'motionshedon4life@yahoo.com', 'love.com', '08100161703', 'FCMB', 'onuorah shedrach', '4153260017', 0, '2017-03-31 06:40:01', 0),
(180, 'Ime Itabina', 'Ime3', 'imeitabina09@gmail.com', 'Idongesit', '08060819940', 'Zenith', 'Itabina Ime', '2087184330', 0, '2017-03-31 06:40:18', 0),
(181, 'Ukaoha Victoria', 'Babyjasparo', 'babyjasparo@gmail.com', 'adanta16', '08064156973', 'access bank', 'Ukaoha Victoria', '0047520192', 0, '2017-03-31 06:43:48', 0),
(182, 'Jayeola', 'Jayeola', 'jayeesho@gmail.com', 'temiesho1', '08188581240', 'Diamond Bank', 'Temitope Akande', '0011903922', 0, '2017-03-31 06:44:21', 0),
(183, 'David', 'Buraimoh', 'desmonddemix4u@yahoo.com', 'Password.009', '08028076163', 'Access bank', 'Buraimoh David', '0034726549', 0, '2017-03-31 06:44:57', 0),
(184, 'Anthony onyenakie', 'Anthonyo', 'onyenakieanthony@gmail.com', 'bracelet', '08166278819', 'Diamond bank', 'Akawushim kelechi green', '0074917683', 0, '2017-03-31 06:47:18', 0),
(185, 'Kesiena emefeke', 'kessya1', 'kessya1@yahoo.com', 'ga0891', '08053199064', 'Gtb', 'Kesiena emefeke', '0226815078', 0, '2017-03-31 06:48:30', 0),
(186, 'lian', 'lian79', 'lianintegrated@gmail.com', '08064679200', '08052777896', 'zenith bank', 'lian integrated service', '1013151365', 0, '2017-03-31 06:49:33', 0),
(187, 'Ijeoma', 'mayon', 'luchiangel@yahoo.com', 'keren123', '09067387888', 'Zenith Bank', 'Ijeoma Akalugwu', '2003054844', 0, '2017-03-31 06:55:06', 0),
(188, 'Sidney', 'siduz', 'siduzy@gmail.com', 'maximusnjoku', '08061371361', 'GTB', 'Uzor Sidney C.', '0041763952', 0, '2017-03-31 06:55:36', 0),
(189, 'Ngwubike Onyinye', 'Onyinye', 'luvlypeace4don@gmail.com', 'Onyinye', '08036064471', 'zenith', 'Ngwubike Onyinye Peace', '2120523098', 0, '2017-03-31 06:56:59', 0),
(190, 'Freda', 'Phreda', 'fredafredrick@ymail.com', 'fredevelyn1.', '08135844750', 'Zenith Bank', 'Dibie Freda', '2009658653', 0, '2017-03-31 06:57:05', 0),
(191, 'Esther Abraham Adesola', 'Grace_', 'muumywunmi12@gmail.com', 'password', '08032780206', 'Diamond bank', 'Abraham Esther Adesola', '0074882347', 0, '2017-03-31 06:58:02', 0),
(192, 'Iloegbunam Mike', 'mikechi', 'iloegbunamchinonsomike@gmail.com', 'progress', '08163496928', 'UBA', 'Iloegbunam Mike', '2062299260', 0, '2017-03-31 07:00:01', 0),
(193, 'Iloegbunam Agnes', 'agychi', 'agneschikwado@yahoo.com', 'benitaanita', '07080224785', 'UBA', 'Iloegbunam Agnes', '2034753251', 0, '2017-03-31 07:03:18', 0),
(194, 'Salisu', 'Salami', 'kingwizwayne@gmail.com', '52568968', '09054467911', 'Eco bank', 'Salami Salisu', '2382132381', 0, '2017-03-31 07:04:48', 0),
(195, 'Uju Chiama', 'wealth', 'ujuchiama@gmail.com', 'ujuchiama', '08122238883', 'Diamond bank', 'Uju chiama', '0027776080', 0, '2017-03-31 07:06:09', 0),
(196, 'Salihu Muhammed Salami', 'Muhammed', 'salihumuhammed71@gmail.com', '52568968', '07086692171', 'Gtbank', 'Salihu Muhammed salami', '0179009353', 0, '2017-03-31 07:07:49', 0),
(197, 'Ahmed Lukman', 'Lukman', 'lukahmed@yahoo.com', 'omeiza', '08108811598', 'Access Bank', 'Ahmed Lukman Omeiza', '0700436989', 0, '2017-03-31 07:10:37', 0),
(198, 'Clifford', 'legend27', 'peaz2004@gmail.com', 'pere070485', '08034356079', 'Gtbank', 'Clifford Ekinabhari', '0042339381', 0, '2017-03-31 07:11:58', 0),
(199, 'Modupelola', 'Oyekunle', 'boseoye3@gmail.com', 'tife7278', '08171884043', 'Diamond Bank', 'Modupelola Oyekunle', '0073911983', 0, '2017-03-31 07:16:47', 0),
(200, 'Jane Abeng', 'Djane', 'gabrieljane70@gmail.com', 'jane123', '08032353125', 'Fidelity', 'Abeng jane', '6233445305', 0, '2017-03-31 07:17:50', 0),
(201, 'Ife', 'ifelarry', 'ifelarry@gmail.com', 'ospiro', '09057152775', 'UBA', 'Ife Oluwatuyi', '2091584711', 0, '2017-03-31 07:19:33', 0),
(202, 'obih ifeanyi', 'maxihyfr', 'maxihyfr123@gmail.com', 'suckerpunch', '08063726386', 'Zenith Bank', 'obih ifeanyi', '2200002101', 0, '2017-03-31 07:23:37', 0),
(203, 'Kate john', 'Gordon1', 'queentreasure797@gmail.com', '777777', '08066889729', 'first bank', 'Kate john', '3077624975', 0, '2017-03-31 07:23:38', 0),
(204, 'Morgan uwaya', 'Morganvm', 'vicmee2000@gmail.com', 'promise123', '08131801200', 'Diamond Bank', 'Uwaya Morgan', '0007985082', 0, '2017-03-31 07:24:36', 0),
(205, 'Obikee', 'Kenpet', 'Kenpet4christ@gmail.com', 'osinachi', '08035141744', 'First Bank', 'Obikee Kennedy', '3063773816', 0, '2017-03-31 07:25:11', 0),
(206, 'Yusuf Oladimeji', 'yoosoph', 'yoosoph4real@yahoo.com', 'dimeji78', '08032851940', 'Access Bank Plc', 'Yusuf Y Oladimeji', '0036521683', 0, '2017-03-31 07:26:07', 0),
(207, 'Collins', 'Shuga', 'csandyluv@gmail.com', '301995', '08154546948', 'First bank', 'A. Collins', '3113101600', 0, '2017-03-31 07:27:02', 0),
(208, 'ike chiamaka chinwe', 'bigbold', 'babyasses@yahoo.com', '505050', '07064420513', 'diamond', 'ike chiamaka chinwe', '0015948617', 0, '2017-03-31 07:28:59', 0),
(209, 'Jones Amaechi', 'razorfyne', 'razorfyne@gmail.com', 'Anjola001', '08032128172', 'Skye Bank', 'Jones Amaechi', '1780007336', 0, '2017-03-31 07:30:47', 0),
(210, 'Kayode odunayo', 'Sunshine', 'Odunayokayode11@gmail.com', '284878', '08169750080', 'First bank', 'Kayode Henry', '3065362656', 0, '2017-03-31 07:31:33', 0),
(211, 'Omolara', 'Lara', 'ladeniyi17@gmail.com', 'Favour@1', '08050276744', 'gtb', 'Afusat Adeniyi', '0034768920', 0, '2017-03-31 07:34:28', 0),
(213, 'Adenike', 'Adenyke', 'adenikeadesina@gmail.com', 'Adenyke@123', '08179725412', 'Access Bank', 'Adenike Adesina', '0727049012', 0, '2017-03-31 07:37:53', 0),
(214, 'Franklin Olubadejo', 'GRACE1', 'folubadejo@yahoo.com', 'ajebo1', '07082945432', 'UBA', 'OLUBADEJO FRANKLIN', '2069604225', 0, '2017-03-31 07:38:26', 0),
(215, 'Lawal Oyinlola', 'honeyzrich', 'honeyzrich1705@gmail.com', '17may1996', '08175083988', 'Access Bank', 'Oyinlola Lawal', '0690821941', 0, '2017-03-31 07:39:51', 0),
(216, 'Ogechi', 'Richman888', 'Ogcares4@yahoo.com', 'Tissue', '09068922788', 'Diamond', 'Ogechi Odoemenam', '0016759461', 0, '2017-03-31 07:39:53', 0),
(217, 'Gabriel Abadi', 'Riel', 'gaberiel7.ga@gmail.com', '07017493943', '07017493943', 'Diamond bank', 'Gabriel Abadi', '0063486882', 0, '2017-03-31 07:41:01', 0),
(218, 'Titilayo Taiwo', 'titilar', 'titilayoenitan.taiwo@gmail.com', 'anjorint', '08029661124', 'Gtb', 'Titilayo Taiwo', '0157057758', 0, '2017-03-31 07:41:39', 0),
(219, 'Amaka', 'Maks', 'amaka.mordi56@gmail.com', 'karen0708', '08110831492', 'First bank', 'Ndidiamaka mordi', '3038982847', 0, '2017-03-31 07:41:51', 0),
(220, 'Dammy ola', 'Dammy97', 'kafayatmodel2@yahoo.com', 'damilola97', '08038443649', 'First bank', 'Giwa kafayat', '3017489589', 0, '2017-03-31 07:43:14', 0),
(221, 'Tiana Chukwueke', 'Tiana24', 'Ninaelekwa@yahoo.com', 'unn1993', '08136517682', 'Access bank', 'Tiana Chukwueke', '0000456054', 0, '2017-03-31 07:46:12', 0),
(222, 'Udoidang Idaraobong', 'IdyOriginal', 'aideeoriginal@gmail.com', 'original1234', '07067024178', 'Diamond bank', 'Udodidang idaraobong', '0085597478', 0, '2017-03-31 07:47:10', 0),
(223, 'Odafenye Timothy', 'sirtim', 'timo4christ101@gmail.com', '567890', '08167107246', 'Zenith', 'Odafenye Timothy', '2189316118', 0, '2017-03-31 07:48:27', 0),
(224, 'Nnedi', 'preacher', 'ibekwe.stella@yahoo.com', 'Ebele4', '08065234286', 'GTBank', 'Nnedi S Okafor', '0046912281', 0, '2017-03-31 07:49:07', 0),
(225, 'Adedayo Caleb', 'act4real', 'adedayocaleb@yahoo.com', 'caleb1991', '08069429033', 'GTB', 'Adedayo Caleb', '020889523', 0, '2017-03-31 07:50:03', 0),
(226, 'Gbenga john', 'Ochipopo', 'adenusigbenga@gmail.com', 'timebobo1', '09071669373', 'Zenith bank', 'Gbenga John A', '2087443011', 0, '2017-03-31 07:50:57', 0),
(227, 'Oluwaseyi', 'Starlet', 'starletico@gmail.com', 'seyi@20', '07089997734', 'Heritage bank', 'Oluwaseyi Ijaola', '1000340261', 0, '2017-03-31 07:51:54', 0),
(228, 'Chinedu Emmanuel', 'Manuelned', 'oriebizline@gmail.com', 'calculus2689', '07035052689', 'Diamond', 'Chinedu Emmanuel Orie', '0086694831', 0, '2017-03-31 07:52:27', 0),
(229, 'Abdulsalam Yusuf', 'Elhadj', 'lilmoh97@gmail.com', '1doublem', '08066984983', 'First bank', 'Yusuf Muhammad', '3113028040', 0, '2017-03-31 07:54:01', 0),
(230, 'Harold A', 'HaroldA', 'abrahamharold22@gmail.com', 'hub_333', '08077416484', 'Heritage Bank', 'Abraham Harold', '1000409166', 0, '2017-03-31 07:54:04', 0),
(231, 'taiwo george', 'oluomot', 'taiwogeorge2013@gmail.com', 'echen111', '08023801718', 'first bank', 'george taiwo echen', '3053175279', 0, '2017-03-31 07:55:03', 0),
(232, 'Joshua Victor', 'Moondust', 'faemevic17@gmail.com', 'timzy001', '08108089377', 'Gtb', 'Joshua Victor Chukwuemeka', '0241320373', 0, '2017-03-31 07:56:17', 0),
(234, 'Odochi', 'odobekee', 'odee_24m@yahoo.com', 'simplyred', '08035514846', 'Diamondbank', 'Ajaero Odochi', '0049563280', 0, '2017-03-31 08:05:21', 0),
(235, 'Kenneth unachukwu', 'Dandy', 'kennygee2k@yahoo.co.uk', '303.636.939.k', '08037890512', 'First bank', 'Kenneth unachukwu', '3063932408', 0, '2017-03-31 08:11:47', 0),
(236, 'Faith', 'Andre', 'ennyadeniran@gmail.com', 'egbe1805', '08069421619', 'Diamomd', 'Morounkeji Adeniran', '0028016637', 0, '2017-03-31 08:14:45', 0),
(237, 'Amara Juliet', 'Amaa', 'Ama@gmail.com', 'wealth', '08119477011', 'GTBank', 'Amara Juliet', '0173118677', 0, '2017-03-31 08:15:25', 0),
(238, 'Okechukwu', 'Okies', 'obinnannamdi@yahoomail.com', 'senator', '08015505186', 'diamond', 'Okies', '0165235896', 0, '2017-03-31 08:24:36', 0),
(239, 'Abe', 'Goldie', 'amanda_capo27@yahoo.com', '52568968', '08085089019', 'AccessBank', 'Abe Olajumoke', '0020673349', 0, '2017-03-31 08:28:13', 0),
(240, 'sonia brown', 'tarabrown', 'taribrown75@gmail.com', '112233t', '08063438640', 'eco bank', 'question tamaratari', '3091154150', 0, '2017-03-31 08:34:44', 0),
(241, 'shakiru fatai gbenga', 'makewell', 'olugbenga.agunbiade@yahoo.com', 'omolabake', '07039225646', 'gtb', 'shakiru fatai', '0015208407', 0, '2017-03-31 08:35:04', 0),
(242, 'taiwo ajetunmobi', 'taiwoajet', 'ajetunmobibaby@yahoo.com', 'kenny@123', '08066699620', 'GTB', 'taiwo ajetunmobi', '0176331150', 0, '2017-03-31 08:36:35', 0),
(243, 'olalekan odurinde', 'lakesboy', 'lakesbabs007@yahoo.com', 'pigtail007', '07032463894', 'access bank', 'olalekan odurinde', '0028581864', 0, '2017-03-31 08:49:48', 0),
(244, 'JACKSON', 'xclusivedon', 'chukwudijackson139@gmail.com', 'chuddy9', '09054743626', 'FIRST BANK', 'CHUKWUDI KANU', '3113582258', 0, '2017-03-31 08:57:09', 0),
(245, 'Immaculata Achugwo', 'Ekemma', 'gloria_joseph@yahoo.com', 'morazmoraz', '08034817860', 'Diamond Bank', 'Mmachukwu ImmaculataAchugwo', '0060950584', 0, '2017-03-31 09:11:17', 0),
(246, 'Olaolu Olajubu', 'laolu', 'Laolu2014@gmail.com', 'adejubu4eva', '08142471315', 'Gtbank', 'Olaolu Olajubu', '0023527619', 0, '2017-03-31 09:17:26', 0),
(247, 'Aremu-Dele', 'Tallaremu', 'Seggzzy@gmail.com', 'origin', '07036799300', 'StanbicIBTC', 'Aremu Dele Olusegun', '0015074879', 0, '2017-03-31 09:30:02', 0),
(248, 'Raphael', 'Geezee', 'Geezeeguy@gmail.com', '19921992', '08154546949', 'Diamond', 'Raphael abadi', '0042873854', 0, '2017-03-31 09:33:24', 0),
(249, 'AGU DIANAH IJEOMA', 'Aijeoma', 'ijeomaagu37@gmail.com', 'ijeoma', '08033199898', 'Union bank', 'Agu Dianah ijeoma', '0003813628', 0, '2017-03-31 09:38:13', 0),
(250, 'George Nsima', 'nsimageorge', 'georgensima@gmail.com', 'password', '08069707549', 'Eco Bank', 'Nsima George', '0201064943', 0, '2017-03-31 10:21:38', 0),
(252, 'Sandar', 'Sandra25', 'akonkeade@yahoo.com', 'zozi25', '08024151434', 'Diamond bank', 'Sandra peter', '0043195537', 0, '2017-03-31 11:41:58', 0),
(253, 'John Oyeniyi', 'Desire', 'contactjohnoyeniyi@gmail.com', 'annie2016', '07068152755', 'Zenith', 'John Oyeniyi', '2080435167', 0, '2017-03-31 11:43:48', 0),
(254, 'Chia Faith Onyinye E.', 'Potter', 'Jniyi4real03@yahoo.com', 'annie2016', '09021382091', 'First bank', 'Chia Faith Onyinye E.', '3040469013', 0, '2017-03-31 11:57:36', 0),
(255, 'Johnson o', 'Olembe', 'bjoneil2002@yahoo.com', 'john123', '08069001993', 'Accessbank', '0006954765', '0006954765', 0, '2017-03-31 12:03:36', 0),
(256, 'Enoch Chilge A', 'Kush', 'Jniyi4real02@yahoo.com', 'annie2016', '07055803853', 'Zenith Bank', 'Enoch Chilge A.', '2007114634', 0, '2017-03-31 12:05:35', 0),
(257, 'Eboselume Oigiagbe', 'Kayus', 'Jniyi4real01@yahoo.com', 'annie2016', '07067828847', 'Zenith Bank', 'Eboselume Oigiagbe', '2006758349', 0, '2017-03-31 12:16:00', 0),
(258, 'Elizabeth Abadoo', 'lizzyab', 'lizzynina100@gmail.com', 'lizzy1234', '09095439002', 'Heritage Bank', 'Elizabeth Abadoo', '1912264433', 0, '2017-03-31 12:26:44', 0),
(259, 'Shakir', 'Atilolar', 'Boyopumping23@yahoo.com', 'adebanke', '08086291670', 'FCMB', 'Akinmade Shakir O', '0437193011', 0, '2017-03-31 12:36:34', 0),
(260, 'Ogbonna chisom', 'Chisomwealth', 'uzomachisomogbonna@gmail.com', 'chisom324', '09069589075', 'FCMB', 'Ogbonna chisom', '3769844019', 0, '2017-03-31 15:59:43', 0),
(262, 'Testing one', 'test1', 'mail@ma.com', 'test123', '08124043226', 'Access Bank', 'my account', '12344445', 0, '2017-04-01 11:21:25', 0),
(263, 'Admin 2', 'admin', 'mail@admin.com', 'test123', '08032125708', 'Bank', 'Account', 'number', 0, '2017-04-01 11:23:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `no_of_people_list`
--

CREATE TABLE IF NOT EXISTS `no_of_people_list` (
  `no` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `no_of_people_list`
--

INSERT INTO `no_of_people_list` (`no`) VALUES
(20);

-- --------------------------------------------------------

--
-- Table structure for table `paid`
--

CREATE TABLE IF NOT EXISTS `paid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `time_paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paid`
--

INSERT INTO `paid` (`id`, `idu`, `amount`, `time_paid`) VALUES
(1, 120, 500, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_list`
--

CREATE TABLE IF NOT EXISTS `payment_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `complete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1164 ;

--
-- Dumping data for table `payment_list`
--

INSERT INTO `payment_list` (`id`, `idu`, `section`, `amount`, `complete`) VALUES
(1151, 120, '', 75000, 0),
(1153, 123, '', 45000, 0),
(1154, 125, '', 75000, 0),
(1155, 128, '', 55000, 0),
(1156, 129, '', 50000, 0),
(1157, 132, '', 40000, 0),
(1158, 136, '', 30000, 0),
(1159, 139, '', 40000, 0),
(1160, 253, '', 70000, 0),
(1161, 254, '', 30000, 0),
(1162, 256, '', 45000, 0),
(1163, 257, '', 55000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pay_queue`
--

CREATE TABLE IF NOT EXISTS `pay_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `complete` int(11) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `pledged` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pay_queue`
--

INSERT INTO `pay_queue` (`id`, `idu`, `amount`, `complete`, `section`, `pledged`) VALUES
(10, 451, 30000, 0, 30000, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `idq` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `payto` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date_peered` datetime NOT NULL,
  `date_expire` datetime NOT NULL,
  `paid` int(11) NOT NULL,
  PRIMARY KEY (`idq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `received`
--

CREATE TABLE IF NOT EXISTS `received` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `time_paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `received_help`
--

CREATE TABLE IF NOT EXISTS `received_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `receive_queue`
--

CREATE TABLE IF NOT EXISTS `receive_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `complete` int(11) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `listed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `receive_queue`
--

INSERT INTO `receive_queue` (`id`, `idu`, `amount`, `complete`, `section`, `listed`) VALUES
(1, 114, 60000, 0, '', 0),
(2, 117, 20000, 0, '', 0),
(3, 119, 30000, 0, '', 0),
(4, 120, 75000, 0, '', 1),
(5, 122, 50000, 0, '', 0),
(6, 123, 45000, 0, '', 1),
(7, 125, 75000, 0, '', 1),
(8, 128, 55000, 0, '', 1),
(9, 129, 50000, 0, '', 1),
(10, 132, 40000, 0, '', 1),
(11, 136, 30000, 0, '', 1),
(13, 139, 40000, 0, '', 1),
(17, 253, 70000, 0, '', 1),
(18, 254, 30000, 0, '', 1),
(19, 256, 45000, 0, '', 1),
(20, 257, 55000, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section_five`
--

CREATE TABLE IF NOT EXISTS `section_five` (
  `id_five` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `pay_one` int(11) NOT NULL,
  `pay_two` int(11) NOT NULL,
  `complete` int(11) NOT NULL,
  PRIMARY KEY (`id_five`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `section_four`
--

CREATE TABLE IF NOT EXISTS `section_four` (
  `id_four` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `pay_one` int(11) NOT NULL,
  `pay_two` int(11) NOT NULL,
  `complete` int(11) NOT NULL,
  PRIMARY KEY (`id_four`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `section_one`
--

CREATE TABLE IF NOT EXISTS `section_one` (
  `id_one` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `pay_one` int(11) NOT NULL,
  `pay_two` int(11) NOT NULL,
  `complete` int(11) NOT NULL,
  PRIMARY KEY (`id_one`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `section_three`
--

CREATE TABLE IF NOT EXISTS `section_three` (
  `id_three` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `pay_one` int(11) NOT NULL,
  `pay_two` int(11) NOT NULL,
  `complete` int(11) NOT NULL,
  PRIMARY KEY (`id_three`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `section_two`
--

CREATE TABLE IF NOT EXISTS `section_two` (
  `id_two` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `pay_one` int(11) NOT NULL,
  `pay_two` int(11) NOT NULL,
  `complete` int(11) NOT NULL,
  PRIMARY KEY (`id_two`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sent_help`
--

CREATE TABLE IF NOT EXISTS `sent_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE IF NOT EXISTS `testing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nothing` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `testing`
--

INSERT INTO `testing` (`id`, `nothing`) VALUES
(1, ''),
(2, ''),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, ''),
(8, ''),
(9, ''),
(10, ''),
(11, ''),
(12, ''),
(13, ''),
(14, ''),
(15, ''),
(16, ''),
(17, ''),
(18, ''),
(19, ''),
(20, ''),
(21, ''),
(22, ''),
(23, ''),
(24, ''),
(25, ''),
(26, ''),
(27, ''),
(28, ''),
(29, ''),
(30, ''),
(31, ''),
(32, ''),
(33, ''),
(34, ''),
(35, ''),
(36, '');

-- --------------------------------------------------------

--
-- Table structure for table `tidy_up`
--

CREATE TABLE IF NOT EXISTS `tidy_up` (
  `last_time` varchar(20) DEFAULT NULL,
  `nothing` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tidy_up`
--

INSERT INTO `tidy_up` (`last_time`, `nothing`, `id`) VALUES
('1491860277', NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
