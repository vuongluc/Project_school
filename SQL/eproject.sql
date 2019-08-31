-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Phiên bản:           9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for eprojects
CREATE DATABASE IF NOT EXISTS `eprojects` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `eprojects`;

-- Dumping structure for table eprojects.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table eprojects.admins: ~3 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT IGNORE INTO `admins` (`AdminID`, `Name`, `Email`, `UserName`, `Password`) VALUES
	(1, 'Hai', 'hainguyen2112000@gmail.com', 'nguyenhai', 'hai2112000'),
	(2, 'Linh', 'hoangvanlinh7200@gmail.com', 'hoanglinh', 'linh07022000'),
	(3, 'Luc', 'vuongluc2708@gmail.com', 'vuongluc', 'luc27082000');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table eprojects.book_tour
CREATE TABLE IF NOT EXISTS `book_tour` (
  `BT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) DEFAULT NULL,
  `TourID` int(11) DEFAULT NULL,
  `Date_Book` datetime DEFAULT CURRENT_TIMESTAMP,
  `Number_of_Adults` int(11) NOT NULL,
  `Number_of_Children` int(11) DEFAULT NULL,
  `Date_go` datetime DEFAULT NULL,
  `Message` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`BT_ID`),
  KEY `CustomerID` (`CustomerID`),
  KEY `TourID` (`TourID`),
  CONSTRAINT `book_tour_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  CONSTRAINT `book_tour_ibfk_2` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table eprojects.book_tour: ~0 rows (approximately)
/*!40000 ALTER TABLE `book_tour` DISABLE KEYS */;
/*!40000 ALTER TABLE `book_tour` ENABLE KEYS */;

-- Dumping structure for table eprojects.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Phone` varchar(30) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table eprojects.customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table eprojects.pay
CREATE TABLE IF NOT EXISTS `pay` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) DEFAULT NULL,
  `Pile` float DEFAULT NULL,
  `Method` varchar(30) NOT NULL,
  `Bank` varchar(50) DEFAULT NULL,
  `Account_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `CustomerID` (`CustomerID`),
  CONSTRAINT `pay_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table eprojects.pay: ~0 rows (approximately)
/*!40000 ALTER TABLE `pay` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay` ENABLE KEYS */;

-- Dumping structure for table eprojects.tour
CREATE TABLE IF NOT EXISTS `tour` (
  `TourID` int(11) NOT NULL AUTO_INCREMENT,
  `IMG_URL` varchar(100) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Time` varchar(20) NOT NULL,
  `Price` float NOT NULL,
  `Place_Go` varchar(50) NOT NULL,
  `Schedule` text NOT NULL,
  `Introduce` text NOT NULL,
  `Tour_Type` varchar(50) NOT NULL,
  PRIMARY KEY (`TourID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table eprojects.tour: ~4 rows (approximately)
/*!40000 ALTER TABLE `tour` DISABLE KEYS */;
INSERT IGNORE INTO `tour` (`TourID`, `IMG_URL`, `Name`, `Time`, `Price`, `Place_Go`, `Schedule`, `Introduce`, `Tour_Type`) VALUES
	(1, './trunk/image/Beach_Tour/HaLong.jpg', 'Ha Noi - Ha Long Bay', '2 day 1 night', 100, 'Ha Noi', '                <div class="col-xs-12 col-sm-12 col-lg-12">\r\n                           <h2 align="center">HA NOI - HA LONG BAY 2 DAYS</h2>\r\n                           <p id="p1">Night tour on Halong Bay for 2 days 1 night,\r\n                           with the schedule to visit the most famous destinations today such as Ga Choi island,\r\n                           Sung Sot cave - Ti Top beach, Bai Tu Long, Ngoc Vung island, ... When night falls between the dim, \r\n                           quiet space,Guests have the opportunity to eat together, watch the moon and stars.\r\n                           But "enjoy" especially those who go "double" on the moonlit nights, and drift around in the bay.\r\n                           This is the type of honeymoon tour that domestic tourists have chosen over time.</p>\r\n                            <br><br>    \r\n                            \r\n                            <h5>DAY 1: HANOI - HA LONG BAY :</h5>\r\n                            <p id="p1">We will pick  guests up at the hotel in the center of Hanoi. But tourists who move to Hanoi, \r\n                                       please be at the meeting place 8 hours in advance.</p>\r\n                            <p id="p1">08:15am: Departure in Hanoi to Ha Long, start the Ha Long 2-day / 1-night journey.<p>\r\n                            <p id="p1">09:45am: Stay on the way at Sao Do hotel - Hai Duong province. </p>\r\n                            <p id="p1">11:30am: You arrive in Ha Long, start your journey to visit Ha Long Bay. Lunch on board.</p>\r\n                            <p id="p1">01:30pm: Visiting Ha Long Bay - world natural heritage with Thien Cung cave, Oan island, \r\n                                       Dinh Huong island, Dog Da island, Ga Choi island - "symbol of Ha Long bay" ...</p>\r\n                            <p id="p1">05:30pm: Boat takes you back to the pier. You get a hotel room. Dinner and free to explore\r\n                                       the bay on the night.</p>\r\n                            \r\n                            <br>\r\n                            <h5>DAY 2: HA LONG SUNWORLD PARK - HANOI :</h5>  \r\n                            <p id="p1">07:30 am -  8:30am: You have breakfast at the hotel.</p>\r\n                            <p id="p1">09:00am - 11:00am: Freedom to participate in entertaining games in the fascinating Sun World Park \r\n                            and interesting for the first days of the spring of the Pig season 2019. </p>\r\n                            <p id="p1">11:30am: You have lunch.</p>\r\n                            <p id="p1">12:30pm: Pick up passengers back to Hanoi. </p>\r\n                            <p id="p1">02:00pm:Stop at Sao Do hotel - Hai Duong province for you to buy specialties Green bean cake, \r\n                            ramie cake, ... as a gift for friends and relatives.</p>\r\n                            <p id="p1">04:30pm: Go to Hanoi. End of the program 2 days 1 night Halong tour exciting and rewarding. Say goodbye and see you later.</p>\r\n                            </p> \r\n                            <br>\r\n                            \r\n                    </div>                ', '                Ha Long Bay (bay where dragons land), a stunningly scenic spot is located in Quang Ninh province in the northeast of Vietnam. The bay covers an area of over 1500 sq km, includes over 1600 islands and islets which form a spectacular seascape of limestone. This is an unique heritage as it marks important events in the formation and development of Viet Nam history; simultaneously, it is also blessed by mother nature with breathtaking views. In addition,your trip to Ha Long Bay will not be complete and perfect if you miss Bo Hon island- the home of variety of flora and fauna, Yen Tu mountain, Surprise Cave or Kissing rocks. Futhermore, it enjoys warm and tropical climate which is suitable for tourists to visit at any time. Come to Ha Long, besides immersing yourselves in her natural beauty, tourists can have an opportunity to savour delicious seafood with reasonable price and best service as well as relax with water sports such as swimming, scuba-diving, water- skiingâ€¦ Moreover, residents here are very amiable, hospitable and ready to help anyone if you are in a fix.                ', 'Beach Tour'),
	(2, './trunk/image/Beach_Tour/nhatrang.jpg', 'Ho Chi Minh - Nha Trang', '2 day 1 night', 250, 'Ho Chi Minh', '        <div class="col-xs-12 col-sm-12 col-lg-12">\r\n                           <h2 align="center">HO CHI MINH CITY - NHA TRANG <br> 3 DAYS / 2 NIGHTS</h2>\r\n                            <br>    \r\n                            \r\n                            <h5>DAY 1: HO CHI MINH CITY â€“ NHA TRANG - VINPEARLAND :</h5>\r\n                            <p id="p1">You are present at Tan Son Nhat airport for a flight to Nha Trang. We will pick you up at Cam Ranh Airport. \r\n                            Then take you to tourist resort Vinpearland..</p>\r\n                            <p id="p1">You will pass 3320 meters of seaway by cable car to paradise travel and entertainment Vinpearland.\r\n                            you will be free to explore the beautiful recreational paradise at the outdoor adventure game area, watching 4D movies,\r\n                            entertainment with modern games in the indoor game area, visit Vinpearl aquarium with special fish show,\r\n                            drop off at the beautiful beach, join the death-row thrill game system at Vinpearl water park.\r\n                            enjoy the special magic screen and dolphin circus cute and funny.\r\n                            especially admire the performances of lively and colorful water music is a pride of Vinpearland.<p>\r\n                            <p id="p1">Evening: Back to the mainland, we will take you to use grilled Nem Ninh Hoa - a culinary culture of Nha Trang.\r\n                            Return to the hotel to relax.</p>                       \r\n                            <br>\r\n\r\n                            <h5>DAY 2: NHA TRANG - TOUR 4 ISLAND: </h5>  \r\n                            <p id="p1">Morning: You have breakfast.</p>\r\n                            <p id="p1">09:00 am - 09:20 am: Pick  guests up at the hotel</p>\r\n                            <p id="p1">09:30 am: Departure of the island trip</p>\r\n                            <p id="p1">09:45 am - 10:45 am: Arrive in Mieu Island Visit Tri Nguyen Aquarium.</p>\r\n                            <p id="p1">11:20 am - 12:30 pm: Arrive at the Crib (near the shore). Swim, watch corals and ornamental fish by diving goggles or glass bottom boat.\r\nÂ Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â  Play thrilling games on the sea: flying parachutes, jet skis, scuba diving and ocean exploration.\r\nÂ Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â  <p>\r\n                            <p id="p1">12:50pm â€“ 03:00pm: We will go to Hon Tre Island. \r\n                            The boat will take you along Nha Trang beach and then you will have lunch at Con Se Tre restaurant</p> \r\n                            <p id="p1">03:00 pm - 04:15 pm: Come to Vinpearl  </p>\r\n                            <p id="p1">04:30 pm: Take you to the hotel</p>\r\n                            <p id="p1">Evening: We will take you to dinner at the restaurant.</p>\r\n                            <br>\r\n                            <h5>DAY 3:NHA TRANG â€“ HO CHI MINH City </h5>\r\n                            <p id="p1">08:00am :You have breakfast.</p>\r\n                            <p id="p1">09:30am Tour guide will take you to visit: Thap Ba PONAGA , Long Son pagoda .</p>\r\n                            <p id="p1">Afternoon: we will take you to Cam Ranh airport. End program. Goobye! </p>\r\n\r\n                            <br><br><br>\r\n                            \r\n\r\n\r\n\r\n                            \r\n                            \r\n                    </div>        ', '        Regarded as Vietnamâ€™s most famous seaside resort-town, Nha Trang attracts foreign tourists for not only its stunningly pristine beaches but the urban atmosphere of a young tourist city. Together with the heavenly beaches, the hot springs, diversified kinds of fish, and the colorful coral reef underwater has made Nha Trang become one of the best spots for scuba diving and snorkeling. Coming to Nha Trang in the period from January to August, people will have the chance to experience the most wonderful weather for swimming and sunbathing.        ', 'Beach Tour'),
	(3, './trunk/image/Beach_Tour/phanthiet.jpg', 'Ho Chi Minh - Phan Thiet', '2 day 1 night', 200, 'Ho Chi Minh', '        <div class="col-xs-12 col-sm-12 col-lg-12">\r\n                           <h2 align="center"> WELCOME PHAN THIET Tour</h2>\r\n                           br>    \r\n                            \r\n                           <h5> DAY 1: DAY 1: SAI GON - PHAN THIET </h5>\r\n                           <p id = "p1"> In the morning, Vietnam Travel Tour Guide picks you up at Ben Thanh Market, you get on the bus to depart Phan Thiet. Arrive in Phan Thiet (Binh Thuan province), the delegation goes through the city center of the city, admiring the peaceful Ca Ty river. Then, take the car to the restaurant for lunch\r\n                           <p id = "p1"> In the afternoon, the car drove the group to Hon Rom, on the way, the delegation passed by and looked at the scenic spots of Phan Thiet such as: the relics of Lau Ong Hoang, Cham Poncho Tower, Bai Da Ong Location, ... and watching the boat of fishermen coming to the port at Mui Ne Marina. You swim and enjoy fresh seafood at affordable prices. After enjoying the sweet taste of coconut 3 times, you continue to conquer Sand Hill Bay, Hong stream, admire the sunset on Phan Thiet beach. </p>\r\n                           <p id = "p1"> In the evening, you walk around the coastal town, overnight at Phan Thiet. </p>\r\nÂ Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â \r\nÂ Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â <br>\r\n                           <h5> DAY 2: PHAN THIET - SAI GON: </h5>\r\n                           <p id = "p1"> In the morning, you swim at Doi Duong beach (if you stay at the City center),or take a bath at the resorts. </p>\r\n                           <p id = "p1"> In the afternoon, check out, go to Phan Thiet market, you buy Phan Thiet specialties. The car brought the delegation back to Ho Chi Minh City. On the way back, we will visit the tourist area of â€‹â€‹Ta Cu Mountain .. </p>\r\n                           <p id = "p1"> In the afternoon, go back to Ho Chi Minh City, bid farewell and say goodbye to you. Ending the exciting Phan Thiet tour. </p>\r\n                           <br>\r\n                            \r\n                    </div>        ', '        Phan Thiet is the center of cultural economy and scientific development of Binh Thuan province. Currently, this is also a particularly attractive tourist destination attracting a large number of domestic and international visitors to Phan Thiet city. The natural beauty of Phan Thiet city has relatively flat terrain with sand dunes along the hills. like a beautiful picture. Here with the system of resorts, hotels and fast food outlets bring visitors convenience in the process of discovery. With sunshine all year round and romantic scenery. Phan Thiet beach city is always attractive to tourists every summer and there are many interesting experiences that you should not ignore.        ', 'Beach Tour'),
	(4, './trunk/image/Beach_Tour/phuquoc.jpg', 'Ho Chi Minh - Phu Quoc', '3 day 2 night', 300, 'Ho Chi Minh', '        <div class="col-xs-12 col-sm-12 col-lg-12">\r\n                           <h2 align="center">HO CHI MINH - PHU QUOC</h2>\r\n                        \r\n                            <br><br>    \r\n                            \r\n                            <h5>DAY 1: PHU QUOC - DISCOVER NATURAL :</h5>\r\n                            <p id="p1">Tour guides pick tourists up at Ho Chi Minh City, take you to the hotel and start the Phu Quoc Travel tour.<p>\r\n                            <p id="p1">11:30am: tour guide will take the group to lunch with specialties of Phu Quoc.<p>\r\n                            <p id="p1">02:00pm: Departure tour to the east of Phu Quoc island</p>\r\n                            <p id="p1">Guests are free to dine at the restaurant with local specialties and then return to the hotel to rest.</p>\r\n                            \r\n                            <br>\r\n                            <h5>DAY 2:Visit the south of the island </h5>  \r\n                            <p id = "p1"> Morning: you will use breakfast at the hotel </p>\r\n                            <p id = "p1"> 08:00 am: Vehicles will take visitors to visit </p>\r\n                            <p id = "p1"> 11:30 am: You have lunch. </p>\r\n                            <p id = "p1"> 02:00 pm: You continue to visit: Ngoc Hien pearl culture facility,\r\n                            Visit Sao Beach - the most beautiful white sand beach in Phu Quoc </p>\r\n                            <p id = "p1"> 06:00 pm: Dinner with grilled seafood dishes </p>\r\nÂ Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â  <br>\r\n\r\n                            <h5> DAY 3:  PHU QUOC - SAI GON </h5>\r\n                            <p id = "p1"> You have breakfast, free swimming, resting or shopping at Duong Dong market\r\n                            until check out, the car takes visitors to Phu Quoc airport, goodbye!. </p>\r\nÂ Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â Â <br> <br>\r\n                            \r\n\r\n                            \r\n                    </div>        ', '        Phu Quoc Island is located 45 kilometres west of Ha Tien in the far south of Vietnam, the northern part of the island is relatively untouched due to its status as a UNESCO-listed national park but there are plenty of luxurious resorts, funky bars, and quaint cafes along the southern coastline. Aside from beachside activities, visitors can also explore traditional villages, expansive nature parks and Buddhist pagodas, all of which are easily accessible via motorcycle, taxi, bus or even daytrips by reputable companies. Catering to just about any budget level and preference, Phu Quocï¿½s dining scene ranges from local markets selling fresh seafood and Vietnamese street food to expat-owned bistros offering authentic western and European fare.        ', 'Beach Tour');
/*!40000 ALTER TABLE `tour` ENABLE KEYS */;

-- Dumping structure for table eprojects.transport
CREATE TABLE IF NOT EXISTS `transport` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BT_ID` int(11) DEFAULT NULL,
  `VehicleID` int(11) DEFAULT NULL,
  `Quantity_Vehicle` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `BT_ID` (`BT_ID`),
  KEY `VehicleID` (`VehicleID`),
  CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`BT_ID`) REFERENCES `book_tour` (`BT_ID`),
  CONSTRAINT `transport_ibfk_2` FOREIGN KEY (`VehicleID`) REFERENCES `vehicle` (`VehicleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table eprojects.transport: ~0 rows (approximately)
/*!40000 ALTER TABLE `transport` DISABLE KEYS */;
/*!40000 ALTER TABLE `transport` ENABLE KEYS */;

-- Dumping structure for table eprojects.vehicle
CREATE TABLE IF NOT EXISTS `vehicle` (
  `VehicleID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`VehicleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table eprojects.vehicle: ~0 rows (approximately)
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
