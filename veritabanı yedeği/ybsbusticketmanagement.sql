-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 31 May 2020, 17:35:16
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ybsbusticketmanagement`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `assign_bus`
--

CREATE TABLE `assign_bus` (
  `assign_bus_no` int(5) NOT NULL COMMENT 'Birincil anahtar',
  `userName` varchar(10) NOT NULL COMMENT 'Sistem Kullanıcı Adı',
  `busNo` varchar(10) NOT NULL COMMENT 'Otobüs Güzergah Numarası',
  `date` date NOT NULL COMMENT 'Güzergah belirleme tarihi',
  `sql` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Transaction Table is store who is assing Route for Bus';

--
-- Tablo döküm verisi `assign_bus`
--

INSERT INTO `assign_bus` (`assign_bus_no`, `userName`, `busNo`, `date`, `sql`) VALUES
(37, 'Enes', '34YBS81', '2020-05-31', 'I');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `assign_coductor`
--

CREATE TABLE `assign_coductor` (
  `assingConductorNo` int(11) NOT NULL COMMENT 'Birincil Anahtar',
  `userName` varchar(10) NOT NULL COMMENT 'Sistem Kullanıcı Adı',
  `conductorNo` varchar(10) NOT NULL COMMENT 'Muavin No',
  `date` date NOT NULL COMMENT 'Muavin Atama Tarihi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Transaction Table is store who is assing conductor for Bus';

--
-- Tablo döküm verisi `assign_coductor`
--

INSERT INTO `assign_coductor` (`assingConductorNo`, `userName`, `conductorNo`, `date`) VALUES
(8, 'Enes', '001', '2020-05-31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `available_seat`
--

CREATE TABLE `available_seat` (
  `seatNo` int(2) NOT NULL COMMENT 'Otobüs Koltuğu Numarası',
  `busNo` varchar(10) NOT NULL COMMENT 'YBS Otobüs Numarası',
  `journeyNo` varchar(10) NOT NULL COMMENT 'Sefer No',
  `status` varchar(2) NOT NULL COMMENT 'Koltuk Durumu',
  `date` date NOT NULL COMMENT 'İşlem Tarihi',
  `time` time NOT NULL COMMENT 'İşlem Saati'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Transaction Table is current Stauts a Bus Seat';

--
-- Tablo döküm verisi `available_seat`
--

INSERT INTO `available_seat` (`seatNo`, `busNo`, `journeyNo`, `status`, `date`, `time`) VALUES
(6, '34YBS81', 'IST-DUZ-1', 'B', '2020-05-31', '18:13:58'),
(7, '34YBS81', 'IST-DUZ-1', 'B', '2020-05-31', '18:28:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `booker`
--

CREATE TABLE `booker` (
  `bookerTCNo` varchar(11) NOT NULL COMMENT 'Otobüs Rezervasyon TC Numarası',
  `bookerName` varchar(20) NOT NULL COMMENT 'Yolcu Adı',
  `bookerMNo` varchar(10) NOT NULL COMMENT 'Yolcu Telefon Numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Master Table is store Bus Booker Data';

--
-- Tablo döküm verisi `booker`
--

INSERT INTO `booker` (`bookerTCNo`, `bookerName`, `bookerMNo`) VALUES
('12548562147', 'ENES KARADAĞ', '5515974615'),
('12548562154', 'GÜROL İSPİROĞLU', '5515974615');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `booking`
--

CREATE TABLE `booking` (
  `bookingID` varchar(25) NOT NULL COMMENT 'Rezervasyon Numarası',
  `bookerTCNo` varchar(11) NOT NULL COMMENT 'Otobüs Rezervasyon TC Numarası',
  `busNo` varchar(10) NOT NULL COMMENT 'Otobüs numarası',
  `journeyNo` varchar(10) NOT NULL COMMENT 'Sefer Numarası',
  `no_of_seat` int(2) NOT NULL COMMENT 'Koltuk Sayısı',
  `entryPointNo` int(2) NOT NULL COMMENT 'Biniş Noktası',
  `ammount` float NOT NULL COMMENT 'Otobüs Bileti Toplam Tutarı',
  `date` date NOT NULL COMMENT 'Bilet alma tarihi',
  `payment_status` varchar(2) NOT NULL DEFAULT 'P' COMMENT 'Ödeme Tipi',
  `s_bookin_time` time NOT NULL COMMENT 'İşlem Saati'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Transaction Table is store Receive booking invoice';

--
-- Tablo döküm verisi `booking`
--

INSERT INTO `booking` (`bookingID`, `bookerTCNo`, `busNo`, `journeyNo`, `no_of_seat`, `entryPointNo`, `ammount`, `date`, `payment_status`, `s_bookin_time`) VALUES
('34YBS81IST-DUZ-120053100', '12548562154', '34YBS81', 'IST-DUZ-1', 1, 26, 60, '2020-05-31', 'Ok', '18:24:58'),
('34YBS81IST-DUZ-120053101', '12548562147', '34YBS81', 'IST-DUZ-1', 1, 26, 60, '2020-05-31', 'Ok', '18:39:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bus`
--

CREATE TABLE `bus` (
  `busNo` varchar(10) NOT NULL COMMENT 'Otobüs Numarası',
  `busModel` varchar(15) NOT NULL COMMENT 'Otobüs Modeli',
  `numberOfSeat` int(2) NOT NULL COMMENT 'Koltuk Sayısı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Master Table is store Bus Data';

--
-- Tablo döküm verisi `bus`
--

INSERT INTO `bus` (`busNo`, `busModel`, `numberOfSeat`) VALUES
('34YBS81', 'MERCEDES', 40);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `conductor`
--

CREATE TABLE `conductor` (
  `conductorNo` varchar(10) NOT NULL COMMENT 'Muavin No',
  `conductorName` varchar(20) NOT NULL COMMENT 'Muavin Adı Soyadı',
  `conductorMNo` varchar(10) NOT NULL COMMENT 'Muavin Telefon Numarası',
  `busNo` varchar(10) DEFAULT NULL COMMENT 'Atandığı Otobüs No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Master Table is store Conductor Data';

--
-- Tablo döküm verisi `conductor`
--

INSERT INTO `conductor` (`conductorNo`, `conductorName`, `conductorMNo`, `busNo`) VALUES
('001', 'Cengiz', '5362154875', '34YBS81');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `entrypoint_for_journey`
--

CREATE TABLE `entrypoint_for_journey` (
  `entryPoint_for_journeyNo` int(3) NOT NULL COMMENT 'Birincil Anahtar',
  `journeyNo` varchar(10) NOT NULL COMMENT 'Otobüs Sefer Numarası',
  `entryPointNo` int(2) NOT NULL COMMENT 'Otobüs Biniş Noktası No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Transaction Table is assing Entry Point for Bus Route';

--
-- Tablo döküm verisi `entrypoint_for_journey`
--

INSERT INTO `entrypoint_for_journey` (`entryPoint_for_journeyNo`, `journeyNo`, `entryPointNo`) VALUES
(89, 'IST-DUZ-1', 26);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `entry_point`
--

CREATE TABLE `entry_point` (
  `entryPointNo` int(2) NOT NULL COMMENT 'Otobüs Biniş Noktası No',
  `entryPoint` varchar(50) NOT NULL COMMENT 'Biniş Noktası Adı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Master Table is store Entry Point for bus Route';

--
-- Tablo döküm verisi `entry_point`
--

INSERT INTO `entry_point` (`entryPointNo`, `entryPoint`) VALUES
(26, 'ESENLER - OTOGAR');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `journey`
--

CREATE TABLE `journey` (
  `journeyNo` varchar(10) NOT NULL COMMENT 'Sefer Numarası',
  `routeNo` varchar(200) NOT NULL COMMENT 'Seferin Güzergah Rotası',
  `journeyFrom` varchar(10) NOT NULL COMMENT 'Sefer Başlangıç Şehri',
  `journeyTo` varchar(10) NOT NULL COMMENT 'Sefer Bitiş Şehri',
  `departureTime` time NOT NULL COMMENT 'Otobüs Hareket Saati',
  `arrivalTime` time NOT NULL COMMENT 'Otobüs Varış Saati',
  `price` float NOT NULL COMMENT 'Bilet Fiyatı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Master Table is store Bus Route Data';

--
-- Tablo döküm verisi `journey`
--

INSERT INTO `journey` (`journeyNo`, `routeNo`, `journeyFrom`, `journeyTo`, `departureTime`, `arrivalTime`, `price`) VALUES
('IST-DUZ-1', 'İSTANBUL - KOCAELİ - SAKARYA - DÜZCE', 'İSTANBUL', 'DÜZCE', '21:00:00', '24:00:00', 60);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `journey_for_bus`
--

CREATE TABLE `journey_for_bus` (
  `journey_for_bus_No` int(3) NOT NULL COMMENT 'Birincil Anahtar',
  `busNo` varchar(10) NOT NULL COMMENT 'Sefere Atanacak Otobüs',
  `journeyNo` varchar(10) NOT NULL COMMENT 'Sefer Numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `journey_for_bus`
--

INSERT INTO `journey_for_bus` (`journey_for_bus_No`, `busNo`, `journeyNo`) VALUES
(50, '34YBS81', 'IST-DUZ-1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `manual_booking`
--

CREATE TABLE `manual_booking` (
  `manualBookingNo` int(11) NOT NULL COMMENT 'Birincil Anahtar',
  `userName` varchar(10) NOT NULL COMMENT 'Sistem Kullanıcı Adı',
  `bookingID` varchar(20) NOT NULL,
  `date` date NOT NULL COMMENT 'Rezervasyon Yaptığı Tarih'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Transaction Table is store who is manual booking Booker';

--
-- Tablo döküm verisi `manual_booking`
--

INSERT INTO `manual_booking` (`manualBookingNo`, `userName`, `bookingID`, `date`) VALUES
(23, 'Ali', '34YBS81IST-DUZ-12005', '2020-05-31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `receive_ticke`
--

CREATE TABLE `receive_ticke` (
  `ticketNo` varchar(25) NOT NULL COMMENT 'Bilet Numarası',
  `passengerName` varchar(25) NOT NULL COMMENT 'Yolcu Adı',
  `seatNo` int(2) NOT NULL COMMENT 'Koltuk Numarası',
  `gender` varchar(1) NOT NULL COMMENT 'Cinsiyeti',
  `bookingID` varchar(25) NOT NULL COMMENT 'Rezervasyon Numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Transaction Table is store booking data';

--
-- Tablo döküm verisi `receive_ticke`
--

INSERT INTO `receive_ticke` (`ticketNo`, `passengerName`, `seatNo`, `gender`, `bookingID`) VALUES
('34YBS81IST-DUZ-12005316', 'Gürol İSPİROĞLU', 6, 'E', '34YBS81IST-DUZ-120053100'),
('34YBS81IST-DUZ-12005317', 'ENES KARADAĞ', 7, 'E', '34YBS81IST-DUZ-120053101');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `seat`
--

CREATE TABLE `seat` (
  `seatNo` int(2) NOT NULL COMMENT 'Otobüs Koltuk Numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Master Table is store Bus Seat Number';

--
-- Tablo döküm verisi `seat`
--

INSERT INTO `seat` (`seatNo`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `system_user`
--

CREATE TABLE `system_user` (
  `userName` varchar(10) NOT NULL COMMENT 'Sisteme giriş için Kullanıcı Adı',
  `empolyeeNo` varchar(8) NOT NULL COMMENT 'Çalışan Sistem Kullanıcısı No',
  `empolyeeName` varchar(20) NOT NULL COMMENT 'Sistem Kullanıcısının Gerçek Adı',
  `empolyeeMNo` varchar(10) NOT NULL COMMENT 'Sistem Kullanıcısının Telefon Numarası	',
  `password` varchar(250) DEFAULT NULL COMMENT 'Sisteme giriş için şifre',
  `privilege` varchar(11) NOT NULL DEFAULT 'Not User' COMMENT 'Görev Ataması'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This Master Table is store System User Data and Login Data';

--
-- Tablo döküm verisi `system_user`
--

INSERT INTO `system_user` (`userName`, `empolyeeNo`, `empolyeeName`, `empolyeeMNo`, `password`, `privilege`) VALUES
('Admin', '001', 'Gürol', '0717226079', '1e6bdb9d266d9c4073b34cdfa174b635', 'Admin'),
('Ahmet', '004', 'Ahmet', '1234567890', '1e6bdb9d266d9c4073b34cdfa174b635', 'Muavin'),
('Ali', '003', 'Ali', '0717226079', '1e6bdb9d266d9c4073b34cdfa174b635', 'Rezervasyon'),
('Cengiz', '005', 'Cengiz', '5362145897', '1e6bdb9d266d9c4073b34cdfa174b635', 'Muavin'),
('Enes', '002', 'Enes', '5515974615', '1e6bdb9d266d9c4073b34cdfa174b635', 'Yonetici');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `assign_bus`
--
ALTER TABLE `assign_bus`
  ADD PRIMARY KEY (`assign_bus_no`),
  ADD KEY `userName` (`userName`,`busNo`),
  ADD KEY `routeNo` (`busNo`);

--
-- Tablo için indeksler `assign_coductor`
--
ALTER TABLE `assign_coductor`
  ADD PRIMARY KEY (`assingConductorNo`),
  ADD KEY `userName` (`userName`,`conductorNo`),
  ADD KEY `userName_2` (`userName`),
  ADD KEY `conductorNo` (`conductorNo`);

--
-- Tablo için indeksler `available_seat`
--
ALTER TABLE `available_seat`
  ADD PRIMARY KEY (`seatNo`,`busNo`,`journeyNo`,`date`),
  ADD KEY `seatNo` (`seatNo`,`busNo`),
  ADD KEY `busNo` (`busNo`);

--
-- Tablo için indeksler `booker`
--
ALTER TABLE `booker`
  ADD PRIMARY KEY (`bookerTCNo`);

--
-- Tablo için indeksler `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `bookerNICNo` (`bookerTCNo`,`busNo`),
  ADD KEY `bookerNICNo_2` (`bookerTCNo`),
  ADD KEY `busNo` (`busNo`);

--
-- Tablo için indeksler `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`busNo`);

--
-- Tablo için indeksler `conductor`
--
ALTER TABLE `conductor`
  ADD PRIMARY KEY (`conductorNo`),
  ADD KEY `busNo` (`busNo`);

--
-- Tablo için indeksler `entrypoint_for_journey`
--
ALTER TABLE `entrypoint_for_journey`
  ADD PRIMARY KEY (`entryPoint_for_journeyNo`),
  ADD KEY `entryPointNo` (`entryPointNo`),
  ADD KEY `journeyNo` (`journeyNo`);

--
-- Tablo için indeksler `entry_point`
--
ALTER TABLE `entry_point`
  ADD PRIMARY KEY (`entryPointNo`),
  ADD KEY `entryPoint` (`entryPoint`);

--
-- Tablo için indeksler `journey`
--
ALTER TABLE `journey`
  ADD PRIMARY KEY (`journeyNo`);

--
-- Tablo için indeksler `journey_for_bus`
--
ALTER TABLE `journey_for_bus`
  ADD PRIMARY KEY (`journey_for_bus_No`),
  ADD KEY `busNo` (`busNo`),
  ADD KEY `journeyNo` (`journeyNo`);

--
-- Tablo için indeksler `manual_booking`
--
ALTER TABLE `manual_booking`
  ADD PRIMARY KEY (`manualBookingNo`),
  ADD KEY `userName` (`userName`,`bookingID`),
  ADD KEY `bookerNICNo` (`bookingID`);

--
-- Tablo için indeksler `receive_ticke`
--
ALTER TABLE `receive_ticke`
  ADD PRIMARY KEY (`ticketNo`),
  ADD KEY `bookerNICNo` (`passengerName`),
  ADD KEY `seatNo` (`seatNo`),
  ADD KEY `ticketNo` (`ticketNo`);

--
-- Tablo için indeksler `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`seatNo`);

--
-- Tablo için indeksler `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`userName`),
  ADD KEY `empoyeeName` (`empolyeeName`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `assign_bus`
--
ALTER TABLE `assign_bus`
  MODIFY `assign_bus_no` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Birincil anahtar', AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `assign_coductor`
--
ALTER TABLE `assign_coductor`
  MODIFY `assingConductorNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Birincil Anahtar', AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `entrypoint_for_journey`
--
ALTER TABLE `entrypoint_for_journey`
  MODIFY `entryPoint_for_journeyNo` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Birincil Anahtar', AUTO_INCREMENT=90;

--
-- Tablo için AUTO_INCREMENT değeri `entry_point`
--
ALTER TABLE `entry_point`
  MODIFY `entryPointNo` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Otobüs Biniş Noktası No', AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `journey_for_bus`
--
ALTER TABLE `journey_for_bus`
  MODIFY `journey_for_bus_No` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Birincil Anahtar', AUTO_INCREMENT=51;

--
-- Tablo için AUTO_INCREMENT değeri `manual_booking`
--
ALTER TABLE `manual_booking`
  MODIFY `manualBookingNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Birincil Anahtar', AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `seat`
--
ALTER TABLE `seat`
  MODIFY `seatNo` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Otobüs Koltuk Numarası', AUTO_INCREMENT=50;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `assign_bus`
--
ALTER TABLE `assign_bus`
  ADD CONSTRAINT `assign_bus_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `system_user` (`userName`);

--
-- Tablo kısıtlamaları `assign_coductor`
--
ALTER TABLE `assign_coductor`
  ADD CONSTRAINT `assign_coductor_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `system_user` (`userName`),
  ADD CONSTRAINT `assign_coductor_ibfk_2` FOREIGN KEY (`conductorNo`) REFERENCES `conductor` (`conductorNo`);

--
-- Tablo kısıtlamaları `available_seat`
--
ALTER TABLE `available_seat`
  ADD CONSTRAINT `available_seat_ibfk_1` FOREIGN KEY (`busNo`) REFERENCES `bus` (`busNo`),
  ADD CONSTRAINT `available_seat_ibfk_2` FOREIGN KEY (`seatNo`) REFERENCES `seat` (`seatNo`);

--
-- Tablo kısıtlamaları `conductor`
--
ALTER TABLE `conductor`
  ADD CONSTRAINT `conductor_ibfk_1` FOREIGN KEY (`busNo`) REFERENCES `bus` (`busNo`);

--
-- Tablo kısıtlamaları `entrypoint_for_journey`
--
ALTER TABLE `entrypoint_for_journey`
  ADD CONSTRAINT `entrypoint_for_journey_ibfk_1` FOREIGN KEY (`entryPointNo`) REFERENCES `entry_point` (`entryPointNo`),
  ADD CONSTRAINT `entrypoint_for_journey_ibfk_2` FOREIGN KEY (`journeyNo`) REFERENCES `journey` (`journeyNo`);

--
-- Tablo kısıtlamaları `journey_for_bus`
--
ALTER TABLE `journey_for_bus`
  ADD CONSTRAINT `journey_for_bus_ibfk_1` FOREIGN KEY (`busNo`) REFERENCES `bus` (`busNo`),
  ADD CONSTRAINT `journey_for_bus_ibfk_2` FOREIGN KEY (`journeyNo`) REFERENCES `journey` (`journeyNo`);

--
-- Tablo kısıtlamaları `manual_booking`
--
ALTER TABLE `manual_booking`
  ADD CONSTRAINT `manual_booking_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `system_user` (`userName`);

--
-- Tablo kısıtlamaları `receive_ticke`
--
ALTER TABLE `receive_ticke`
  ADD CONSTRAINT `receive_ticke_ibfk_1` FOREIGN KEY (`seatNo`) REFERENCES `seat` (`seatNo`);

DELIMITER $$
--
-- Olaylar
--
CREATE DEFINER=`root`@`localhost` EVENT `expires_booking_seat_delete` ON SCHEDULE EVERY 60 SECOND STARTS '2020-02-17 17:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM available_seat WHERE (NOW()>addtime(time,'00:11:00') AND status="P")$$

CREATE DEFINER=`root`@`localhost` EVENT `expires_booking_ticke_delete` ON SCHEDULE EVERY 60 SECOND STARTS '2020-02-17 17:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM booking WHERE (NOW()>s_bookin_time AND payment_status="P")$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
