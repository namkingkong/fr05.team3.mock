CREATE DATABASE  IF NOT EXISTS `fr05_mock_team3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fr05_mock_team3`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: fr05_mock_team3
-- ------------------------------------------------------
-- Server version	5.6.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` VALUES (7,1,1),(8,4,3),(9,2,14),(10,3,15),(11,5,16),(12,6,17);
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (35,'Apple'),(36,'Samsung'),(37,'HTC'),(38,'LG'),(39,'Philipps'),(41,'Kingston'),(42,'Asus'),(43,'HP'),(44,'DELL'),(45,'Sony'),(46,'Nokia'),(47,'Motorola'),(48,'BlackBerry'),(49,'Mobiistar');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (21,'Phone',1,1,NULL),(22,'Mobile Phone',1,2,21),(23,'Tablet',2,1,NULL),(24,'Computer',3,1,NULL),(25,'Desktop',1,3,26),(26,'Laptop',1,2,24),(27,'Smart Phone',1,3,22),(28,'USB',1,2,29),(29,'Accessory',4,1,NULL),(30,'Charger',2,2,29),(31,'Headphone',3,2,29),(32,'Disk USB',1,3,28),(33,'USB 3G',2,3,28),(34,'Android',1,4,27),(35,'IOS',2,4,27),(36,'Windows Phone',3,4,27);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,'iphone-5s-slider.jpg',1,1),(2,'htc-one-m8-slider-sound.jpg',1,2),(3,'nokia-lumia-630-slider-2SIM.jpg',1,3),(4,'nokia-lumia-630-slider-2SIM.jpg',1,4),(5,'IMG_0001.JPG',1,9),(6,'IMG_0030.JPG',0,9),(7,'IMG_0031.JPG',0,9),(8,'IMG_0243.PNG',0,9),(9,'IMG_0253.JPG',0,9),(10,'IMG_0257.PNG',0,9),(11,'IMG_0258.JPG',0,9),(12,'IMG_0259.JPG',0,9),(13,'IMG_0264.JPG',1,10),(14,'IMG_0294.JPG',1,11),(15,'IMG_0284.JPG',1,12),(16,'IMG_0421.JPG',1,13),(17,'HTC-Desire-616-13.jpg',1,14),(18,'iPad-Air-1.jpg',1,15),(19,'iPad-Mini-2-Retina-Cellular-11.jpg',1,16),(20,'Dell-Inspiron-7537-5426G50G-4.jpg',1,17),(21,'Asus-transformer-book-t100ta-pin.jpg',1,18),(22,'Asus-FonePad-7-FE170-pin.jpg',1,19),(23,'Dell-Venue-8-thegioididong-02.jpg',1,20),(24,'the-nho-16G-355x220-300.jpg',1,21),(25,'lg-g-pro-2-slider-camera.jpg',1,22),(26,'IMG_0741.JPG',1,23),(27,'IMG_0740.JPG',0,23),(28,'IMG_0739.JPG',0,23),(29,'IMG_0738.JPG',0,23),(30,'IMG_0727.JPG',0,23),(31,'IMG_0726.JPG',0,23),(32,'nokia-xl-slider-2sim.jpg',1,24),(33,'asus-f451ca-01.jpg',1,25),(34,'samsung-galaxy-note-10-1-2014-01.jpg',1,26),(35,'iPad-Air-2-a-7.jpg',1,27),(36,'Samsumg-Galaxy-Tab-S-10.8.jpg',1,28),(37,'Asus-Transformer-Trio-TX201LA-26.jpg',1,29),(38,'video-nokia-515.jpg',1,30),(39,'nokia-220-slider-camera.jpg',1,31),(40,'IMG_0741.JPG',0,1),(45,'IMG_0666.JPG',0,1),(46,'sony-xpreia-z2-slider-camera-new.jpg',1,32),(47,'Motorola-DROID-XYBOARD-8.2.jpg',1,33),(48,'Motorola-XOOM-Bluetooth-Keyboard-Review-06.jpg',1,34),(49,'Motorola-XOOM-Wi-Fi-0.jpg',0,34),(50,'Motorola-XOOM-Wi-Fi-2.jpg',0,34),(51,'BlackBerry-Z30-7.jpg',1,35),(52,'BlackBerry-Z30-2.jpg',0,35),(53,'BlackBerry-Z30-0.jpg',0,35),(54,'BlackBerry-Q5-6.jpg',1,36),(55,'BlackBerry-Q5-9.jpg',0,36),(56,'BlackBerry-Q5-1.jpg',0,36),(57,'BlackBerry-Q5-0.jpg',0,36);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `link`
--

LOCK TABLES `link` WRITE;
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,'2014-07-24 16:08:00',1,'ronaldo@bernabeu.com','',0,'',0);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
INSERT INTO `order_detail` VALUES (1,1,1,15,2,'Iphone 5s 16GB');
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,35,'Iphone 5s 16GB','The iPhone 5s is not a radical departure in design for Apple, save for one very important feature. No, we don\'t mean the new Space Gray and Gold colors. We have in mind the home button that has been on iPhones from day one, is now turned into a fingerprint scanner dubbed Touch ID. It lets you unlock the phone and authorize purchases, safely storing your fingerprints in the A7 processor itself, out of the reach for anyone but a few default iOS 7 apps. This A7 processor debuts on the iPhone 5s as the first 64-bit mobile chipset in use on a commercial device, utilized by the latest flat and minimalistic iOS 7 that has been rewritten to take advantage of the 64-bit system. It sports a dedicated M7 co-processor for always-on motion sensing, too. The iSight camera stayed 8 MP, but is much improved, with larger pixels, wider aperture, and the ability to shoot slow motion videos, not to mention the dual two-tone LED flash on the back that strives for natural skin color representation.','USA',15000000,0,100,2,NULL),(2,NULL,'HTC One M8','as smart as human being','Taiwan',16190000,0,25,3,'0000-00-00 00:00:00'),(3,43,'Nokia Lumia 630','The Nokia Lumia 630 sports a 4.5-inch FWVGA display, 1.2 GHz processor, 512MB of RAM and 5-megapixels rear-facing camera without flash. The handset runs Windows Phone 8.1 and has dual SIM variant.','Sweden',3500000,0,100,3,NULL),(4,39,'Product1','','',10000000,0,0,4,'2014-07-27 19:21:41'),(5,37,'Product2','','',10000000,0,0,5,'2014-07-29 15:38:38'),(6,42,'Product3','','',15000000,0,0,6,'2014-07-29 15:38:40'),(7,37,'Product4','','',5000000,0,0,7,'2014-07-28 11:47:31'),(8,35,'Product5',NULL,NULL,2000000,NULL,0,NULL,'2014-07-29 15:38:43'),(9,38,'Product6','','',9990000,0,0,8,'2014-07-29 15:39:03'),(10,37,'Product7','','',20000000,0,0,9,'2014-07-29 15:39:06'),(11,NULL,'Product8','','',2990000,0,0,10,'2014-07-29 15:39:18'),(12,36,'Product9','','',12650000,0,0,11,'2014-07-29 15:39:25'),(13,NULL,'Product10','','',8500000,0,0,12,'2014-07-29 15:39:16'),(14,37,'HTC Sensation 4G Follow','HTC Sensation comes with a fresh serving of Android 2.3 Gingerbread, but it\'s all about the HTC Sense UI version 3.0 with a touch of refinement and functionality straight from the lock screen. You can choose between a number of lock screen options such as weather updates, quick access to apps and a handful of clock widgets. A 1.2GHz Qualcomm dual-core chipset supports the nice 3D-like transitions in the menu, all carrying resemblance to the ones on the HTC Flyer tablet. The phone is the first with a contoured glass 4.3-inch display meaning that your Super LCD screen is set back slightly to avoid scratches. The resolution is qHD (540x960) with an aspect ratio of 16:9. On the back you have an 8MP camera with dual-LED flash with “instant capture,” meaning little to no lag between pictures. The camera is also capable of recording video at 30fps in full HD (1080p) resolution','Taiwan',15000000,0,50,4,NULL),(15,35,'Apple iPad 3','The Apple iPad 3, or simply iPad, as it is officially called, is Apple\'s latest foray in the contemporary tablet market - a market the company single-handedly started about two years ago. Although the third-generation iPad remains the same on the outside (not a bad thing), it does bring a lot of improvements on the inside. First of all, it has a new screen resolution of 2048x1536 pixels, delivering an amazing for a tablet pixel density of 264 ppi. Another major improvement has to do with the processor of the device, which is now the so-called A5X - still a dual-core processor, but with a new quad-core GPU for outstanding graphics performance. The camera has also been given a boost and is now much more capable in terms of both photo- and video-taking.','USA',25000000,0,0,5,NULL),(16,35,'Apple iPad 4','The fourth-generation iPad keeps the amazing screen resolution and general look and feel of its predecessor, but bumps up the specs with double the processing power and double the graphics power. The camera is also improved. The new tablet adds a Lightning connector instead of the (not so) good old 30-pin connector. It also has faster Wi-Fi connectivity and expanded LTE.','USA',30000000,0,0,6,NULL),(17,44,'Dell  Vostro 5470','Stay on top of everyday tasks, at work or on the go, with a reliable and sleek laptop equipped with business-class features and essential security.','USA',16700000,0,50,7,NULL),(18,42,'Asus VivoTab','The Asus Vivo Tab carries over the famed Transformer line of Asus Android tablets concept, having its own keyboard/battery dock. It sports 11.6\" screen size and is running Windows 8 powered by a Intel Atom processor. Other niceties include the generous 2GB of RAM, full USB 2.0 port, and an IPS display with the standard for this screen size 1366x768 pixels of resolution. There is an 8MP camera with LED flash on the back for the shutterbug in you, and 32GB of internal storage to store those pics and videos you take.','Taiwan',8900000,0,100,8,NULL),(19,42,'Asus Transformer Book Trio','The ASUS Transformer Book Trio is a dual-boot Android/Windows 8 tablet. The Trio tablet features an 11.6-inch 1080p display, and is powered by an Intel Atom Z2560 1.6GHz processor and 2GB of RAM. You\'ll get the choice of either 16GB, 32GB, or 64GB of storage. The tablet side of course has Android 4.2 on board. The keyboard dock is where you\'ll find the power for the Windows 8 side of things. For that, you\'ll get a choice of processor up to an Intel Core i7 Haswell chip, 4GB of RAM, and up to 1TB of storage. One interesting thing is that the keyboard dock can be hooked up to an external display and used independently of the tablet display.','Taiwan',10000000,0,25,9,NULL),(20,44,'Dell Venue','Dell Venue packs a deafening punch with its 4.1” WVGA OLED touchscreen, 8-megapixel camera, and a Snapdragon processor. In reality, the exciting part about this handset is not found in its chic exterior, but it\'s found instead in the custom UI it\'ll be showing off and something more. Running on top of Android 2.2 will be Dell\'s custom “Stage” UI that integrates some social networking aspects that slightly looks to follow in the footsteps of HTC\'s Sense UI with its nice looks.','USA',9650000,0,100,10,NULL),(21,41,'MicroSD 4GB Kingston','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','China',350000,0,100,11,NULL),(22,37,'HTC One mini 2','The One mini 2 sports a much smaller chassis than the One (M8), housing a 4.5\" display with 720x1280 pixels of resolution. The rest of the specs make it a decent midranger, too, as the munchkin sports a 1.2 GHz quad-core Snapdragon 400 processor, 1 GB of RAM, and 16 GB of internal storage (12 GB user-available). This time HTC has provided a microSD card slot, too. Add to these the new 5 MP wide-angle front camera, the BoomSound stereo speakers at the front, plus a larger, 2100 mAh battery, and the One mini 2 becomes a serious contender in the crowded midrange category. The handset runs on the latest Android 4.4 KitKat, with Sense 6.0 sprinkled on top.','Taiwan',6800000,0,50,12,NULL),(23,35,'Product 11','','',123456,0,0,13,'2014-07-30 14:59:35'),(24,46,'Nokia Lumia 1020','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Finland',10990000,8000000,50,14,NULL),(25,42,'Asus N550JV','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Taiwan',14550000,0,25,15,NULL),(26,36,'Samsung Galaxy Tab 4 10.1','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Taiwan',16900000,16000000,100,16,NULL),(27,35,'Ipad 5','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','USA',38900000,38000000,100,17,NULL),(28,38,'Samsung Galaxy Tab S 10.5','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Korean',19000000,18000000,25,18,NULL),(29,39,'Asus - 15.6\" Laptop','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','USA',18900000,18000000,25,19,NULL),(30,NULL,'Nokia X+','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Finland',3576000,3500000,100,20,NULL),(31,46,'Nokia 225','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Finland',500000,499000,100,21,NULL),(32,45,'Sony Xperia Z2','Home\r\n    ›\r\n    Sony phones\r\n    ›\r\n    Sony Xperia Z2\r\n\r\nSony Xperia Z2 Featured in Best Smart\r\nFollow\r\n\r\n    Specs\r\n    Rivals\r\n    Reviews (22)\r\n    News (130)\r\n    Size\r\n    360 °\r\n    Benchmarks\r\n    Video\r\n    Pics\r\n    more\r\n\r\nAnnounced\r\nFeb 24, 2014\r\nMarket status\r\nReleased\r\nSony Xperia Z2 View all photos (33)\r\nPhoneArena rating:\r\n9.2 Click to read the full review\r\nUser rating:\r\n9 Based on 22 User reviews\r\nPros\r\n\r\n    Big display (5.2 inches)\r\n    High-resolution display (1080 x 1920 pixels)\r\n    Extremely high pixel density screen, over 370ppi (424 ppi)\r\n    High-resolution camera (20.7 megapixels)\r\n    Quad core processor\r\n    Lots of RAM (3072 MB RAM)\r\n    Fast mobile data support (4G)\r\n    NFC\r\n    Water-resistant phone\r\n\r\nCons\r\nNo cons\r\nShare\r\nembed\r\n\r\nDescription\r\nThe water and dust-resistant Xperia Z2 comes only six months after the previous Xperia Z1 flagship was released. Although it\'s quick update, the Xperia Z2 features a larger, 5.2-inch IPS display that boasts a new imaging technology, called Live Color LED. Of course, the screen is not the only improvement over its predecessor. Although it\'s even thinner and lighter, the Xperia Z2 runs on the brand new 2.3 GHz quad-core Snapdragon 801 chipset, paired with a fantastic 3 GB of RAM. The 20.7MP camera on its back is capable of 4K recording, slow-motion video, and adding real-time effects. Stereo speakers are now available, as well as noise cancellation and many more software and hardware extras. The Xperia Z2 is powered by a 3200mAh battery, which considerably improves talk time. It runs the latest Android version, 4.4 KitKat. All things considered, the Z2 is an improvement in every way.','Japan',16990000,0,100,22,NULL),(33,47,'XYBOARD 8.2 Follow','The Motorola DROID XYBOARD 8.2 is the smaller 8.2\" sibling of the DROID XYBOARD 10.1. Under the hood, a 1.2GHz dual-core processor brings plenty of software muscle and there\'s 1GB of RAM to back it up. There\'s also a 5MP camera on the back, and a 1.3MP shooter up front and you can record images and video.','Korean',9000000,0,50,23,NULL),(34,47,'Motorola XOOM Wi-Fi Follow','This is the Wi-Fi only version of the Motorola XOOM, company\'s first ever tablet computer. It features a 10.1-inch capacitive screen with a resolution of 1280x800, a 5MP HD camcorder (front-facing cam included) and the mandatory dual-core ARM-based Tegra 2 chipset, which will allow for full 1080p HD video playback. The device runs Google\'s tablet-optimized Android 3.0 Honeycomb operating system. In addition, the tablet features all the known goodies that we love like an accelerometer, gyroscope and of course, Adobe Flash 10.1 Player support.','Korean',12000000,0,50,24,NULL),(35,48,'BlackBerry Z30 Pictures','The BlackBerry Z30 includes a 5-inch 720p (295 ppi) AMOLED display, the largest of any BB phone, and also the now aging aged Snapdragon S4 Pro with the four CPUs running at 1.7GHz. Blackberry is yet to shed light on whether we\'re talking about a dual-core or quad-core, though the less potent version seems likely. In terms of memory, you\'ll find 2GB RAM, with just 16GB of internal storage, though you can expand that via a microSD card. BlackBerry claims that the battery on the Z30, at 2880mAh, coupled with software optimizations, offers 50% more battery life than its current competitors, though manufactures have a pretty shady track record when it comes to this particular bit of hardware, and its actual capabilities. Turning to the camera on the Z30, an increasingly relevant component of the entire package a smartphone offers lately, we\'re welcomed by a 8MP rear camera with Auto Focus, 5x digital zoom and a an LED flash. The large five element lens with an aperture of f/2.2 mean that the unit will capture a lot of light, resulting in great shots. The snapper, as is to be expected, is capable of 1080p video capture, and comes with what BB chose to call “Time Shift” – a feature that basically allows you to choose and adjust faces from several snaps, so say goodbye to ill-timed shots. In terms of connectivity and extras, the Z30 is anything but lacking – you get GPS, 4G LTE connectivity and Wi-Fi, of course, but also Bluetooth 4.0 LE (low energy), NFC, and the rather nice perk that is a microHDMI port.','USA',20500000,0,100,25,NULL),(36,48,'BlackBerry Q5 Pictures','The BlackBerry Q5 is an affordable BlackBerry 10 QWERTY smartphone. It features a QWERTY keyboard, 3.1\" touchscreen and is offered in 4 colours - black, white, red, pink. Details regarding the hardware specs of the BlackBerry Q5 are scarce at the current moment.','USA',4300000,0,50,26,NULL),(37,NULL,'Product Test 1.1','','',123,0,0,27,'2014-07-30 17:45:31'),(38,NULL,'Product Test 2,1','','',123456,0,0,28,'2014-07-30 17:45:35'),(39,NULL,'Product Test 2.2','','',456678,0,0,29,'2014-07-30 17:45:37'),(40,49,'Mobiistar B207','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce volutpat erat ut nibh suscipit euismod. Morbi ornare fermentum tortor, eget hendrerit libero bibendum eget. Proin justo nunc, sollicitudin et interdum at, cursus at tortor. Etiam egestas sit amet lectus rutrum sollicitudin. Morbi a purus at nulla congue gravida sit amet non libero. Phasellus metus neque, molestie sed vehicula vel, fringilla eu felis. Suspendisse quis ultrices magna. Suspendisse vel posuere erat. Cras ornare risus suscipit tempor molestie. Vivamus mollis mi et facilisis molestie. Phasellus ullamcorper urna eget elementum fermentum. Curabitur est urna, hendrerit vitae imperdiet a, mollis et nunc. Praesent non ipsum pellentesque, feugiat justo eu, vehicula nibh. Integer ac varius sapien. Vestibulum sed feugiat erat.','Viet Nam',300000,0,100,27,NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (3,21,1),(79,21,3),(12,21,6),(18,21,9),(24,21,10),(37,21,14),(89,21,20),(55,21,22),(56,21,23),(58,21,24),(70,21,30),(71,21,31),(74,21,32),(111,21,33),(115,21,34),(118,21,35),(120,21,36),(129,21,40),(2,22,1),(78,22,3),(11,22,6),(17,22,9),(23,22,10),(36,22,14),(88,22,20),(93,22,22),(99,22,24),(69,22,30),(103,22,31),(73,22,32),(110,22,33),(114,22,34),(117,22,35),(119,22,36),(128,22,40),(9,23,6),(81,23,15),(82,23,16),(90,23,18),(85,23,19),(102,23,26),(107,23,27),(106,23,28),(6,24,4),(10,24,6),(29,24,12),(84,24,17),(101,24,25),(105,24,29),(8,25,5),(13,25,7),(20,25,9),(25,25,10),(83,26,17),(100,26,25),(104,26,29),(1,27,1),(77,27,3),(21,27,10),(33,27,14),(87,27,20),(92,27,22),(98,27,24),(72,27,32),(109,27,33),(113,27,34),(116,27,35),(27,28,11),(31,28,13),(95,28,21),(7,29,5),(96,29,21),(28,30,11),(32,30,13),(16,31,9),(22,31,10),(30,32,13),(94,32,21),(26,33,11),(80,34,14),(86,34,20),(91,34,22),(108,34,33),(112,34,34),(75,35,1),(76,36,3),(97,36,24);
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (3,5,'best phone ever',1,'2014-07-29 15:58:00',1,NULL,'minhrau92@gmail.com','Nguyen Dinh Minh'),(4,4,'asdfghjklqwertyujiubdfjbvfvdfbvfbcfbfcbfasdfghjklqwertyujiubdfjbvfvdfbvfbcfbfcbfasdfghjklqwertyujiubdfjbvfvdfbvfbcfbfcbfasdfghjklqwertyujiubdfjbvfvdfbvfbcfbfcbfasdfghjklqwertyujiubdfjbvfvdfbvfbcfbfcbf',1,'2014-07-30 12:31:10',14,NULL,'minhnd@smartosc.com','Nguyen Dinh Minh'),(5,0,'San pham rat tot. Gia rat on',1,'2014-07-30 16:44:41',33,NULL,'namkingkong@hotmail.com','NamMA'),(6,3,'Hang binh thuong!',1,'2014-07-30 16:46:15',33,NULL,'paradi@localhost.com','Paradin'),(7,2.5,'I\'m hjlgfkllhjgtfj',1,'2014-07-30 16:50:19',36,NULL,'vuna@smartosc.com','vu'),(8,5,'Dung chan lam dung dung nhe everybody',1,'2014-07-31 11:44:19',36,NULL,'minhnd@smartos.com','Nguyen Dinh Minh'),(9,0,'hinh anh dau?',1,'2014-07-31 11:52:19',40,NULL,'deoco@hoilamgi.com','Vo Danh');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','$2a$10$Onh8QAFoWNBfoK1SUFy3ZeWdrwKVckdSdsqGJqm1DGI9/3.lh4fUa','admin@localhost.com',1,'I am admin','localhost','0101010101'),(2,'minhnd','12345678','minhnd@smartosc.com',1,'Nguyen Dinh Minh','Ha Noi','01676208364'),(3,'admin1','12345678','admin1@gmail.com',1,'Admin Number 1','Ha Noi','0987654321'),(5,'admin2','1234567888','admin2@gmail.com',2,'Admin Number 2','Somewhere','0987654321'),(6,'admin3','12345678','admin3@gmail.com',1,'Admin Number 3','Somewhere','0987654321'),(7,'admin4','12345678','admin4@gmail.com',1,'Admin Number 4','Somewhere','0987654321');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-31 16:01:31
