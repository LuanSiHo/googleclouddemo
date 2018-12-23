-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 18, 2017 at 06:08 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hqt-csdl`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `dangky`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `dangky` (IN `hoten` VARCHAR(50), IN `gioitinh` INT, IN `cmnd` VARCHAR(50), IN `email` VARCHAR(50), IN `sdt` VARCHAR(50), IN `quocgia` INT, IN `ngaysinh` DATE)  BEGIN
insert into dangky_tns
(dk_hoten, dk_gioitinh, dk_cmnd, dk_email, dk_sdt, dk_id_quocgia, dk_ngaysinh)
values(hoten, gioitinh, cmnd, email, sdt, quocgia, ngaysinh);
END$$

DROP PROCEDURE IF EXISTS `huythongtin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `huythongtin` (`id` INT)  READS SQL DATA
BEGIN
delete from dangky_tns where id_dk=id;

END$$

DROP PROCEDURE IF EXISTS `tao_user`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `tao_user` (`email` VARCHAR(40), `pass` VARCHAR(40))  READS SQL DATA
BEGIN

		insert into taikhoan(tk_email, tk_password) values(email,pass);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dangky_tns`
--

DROP TABLE IF EXISTS `dangky_tns`;
CREATE TABLE IF NOT EXISTS `dangky_tns` (
  `id_dk` int(11) NOT NULL AUTO_INCREMENT,
  `dk_hoten` varchar(255) NOT NULL,
  `dk_ngaysinh` int(11) DEFAULT NULL,
  `dk_gioitinh` int(11) NOT NULL DEFAULT '0',
  `dk_cmnd` varchar(255) NOT NULL,
  `dk_email` varchar(255) NOT NULL,
  `dk_sdt` varchar(255) NOT NULL,
  `dk_id_quocgia` int(11) NOT NULL,
  PRIMARY KEY (`id_dk`),
  KEY `fk_dangky_tns_quocgia` (`dk_id_quocgia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dangky_tns`
--

INSERT INTO `dangky_tns` (`id_dk`, `dk_hoten`, `dk_ngaysinh`, `dk_gioitinh`, `dk_cmnd`, `dk_email`, `dk_sdt`, `dk_id_quocgia`) VALUES
(1, 'Trần Minh Thuận', 1513036800, 1, '371703473', 'thuantm280@gmail.com', '01645471240', 1),
(3, 'Nguyễn Tấn Tài', 1513036800, 2, '123456789', 'thuantm22@gmail.com', '01645876985', 3),
(4, 'Trịnh Quốc', 19970707, 2, '123456788', 'thuant2m@gmail.com', '01478526699', 2),
(5, 'Nguyễn Văn Anh', 28971996, 1, '123456789', 'Anhnv@gmail.com', '0164655666', 1),
(6, 'Trinh Cao Thanh', 15141992, 2, '123456789', 'adsf@gmail.com', '0132501346', 1),
(7, 'Trần Sinh', 1512604800, 1, '123456789', 'thuantm9@gmail.com', '0135888888', 2);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

DROP TABLE IF EXISTS `donhang`;
CREATE TABLE IF NOT EXISTS `donhang` (
  `id_donhang` int(11) NOT NULL AUTO_INCREMENT,
  `id_quocgia` int(11) NOT NULL,
  `id_linhvuc` int(11) NOT NULL,
  `dh_chudonhang` varchar(255) DEFAULT NULL,
  `dh_tendonhang` varchar(255) NOT NULL,
  `dh_sltuyen` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_donhang`),
  KEY `id_quocgia` (`id_quocgia`),
  KEY `id_linhvuc` (`id_linhvuc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`id_donhang`, `id_quocgia`, `id_linhvuc`, `dh_chudonhang`, `dh_tendonhang`, `dh_sltuyen`, `status`) VALUES
(1, 1, 3, 'Akira', 'ten don hang 1', 1, 1),
(2, 1, 5, 'Garuda', 'ten don hang 2', 1, 1),
(3, 2, 4, 'Eun Ji', 'ten don hang 3', 1, 1),
(4, 2, 7, 'Eun Ji', 'ten don hang 4', 1, 1),
(5, 3, 1, 'Jackma', 'ten don hang 5', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hoso`
--

DROP TABLE IF EXISTS `hoso`;
CREATE TABLE IF NOT EXISTS `hoso` (
  `id_hoso` int(11) NOT NULL AUTO_INCREMENT,
  `id_tns` int(11) NOT NULL,
  `hs_hoanthanhcoc` int(11) NOT NULL DEFAULT '0',
  `hs_1tuanhoc` int(11) NOT NULL DEFAULT '0',
  `id_donhang` int(11) DEFAULT '0',
  `hs_ketquaphongvan` int(11) DEFAULT '0',
  `hs_solanrot` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_hoso`),
  KEY `id_tns` (`id_tns`),
  KEY `id_donhang` (`id_donhang`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hoso`
--

INSERT INTO `hoso` (`id_hoso`, `id_tns`, `hs_hoanthanhcoc`, `hs_1tuanhoc`, `id_donhang`, `hs_ketquaphongvan`, `hs_solanrot`) VALUES
(2, 4, 1, 1, 5, 1, 0),
(3, 6, 1, 1, NULL, 0, 1),
(10, 14, 1, 0, 0, 0, 0),
(12, 15, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `linhvuc`
--

DROP TABLE IF EXISTS `linhvuc`;
CREATE TABLE IF NOT EXISTS `linhvuc` (
  `id_linhvuc` int(11) NOT NULL AUTO_INCREMENT,
  `tenlinhvuc` varchar(255) NOT NULL,
  PRIMARY KEY (`id_linhvuc`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `linhvuc`
--

INSERT INTO `linhvuc` (`id_linhvuc`, `tenlinhvuc`) VALUES
(1, 'Điện tử'),
(2, 'Thuỷ sản'),
(3, 'Lưới (đan lưới)'),
(4, 'Nông nghiệp'),
(5, 'May'),
(6, 'Xây dựng'),
(7, 'Hàn-Tiện');

-- --------------------------------------------------------

--
-- Table structure for table `quocgia`
--

DROP TABLE IF EXISTS `quocgia`;
CREATE TABLE IF NOT EXISTS `quocgia` (
  `id_quocgia` int(11) NOT NULL AUTO_INCREMENT,
  `tenquocgia` varchar(255) NOT NULL,
  PRIMARY KEY (`id_quocgia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quocgia`
--

INSERT INTO `quocgia` (`id_quocgia`, `tenquocgia`) VALUES
(1, 'Nhật'),
(2, 'Hàn Quốc'),
(3, 'Singapore');

-- --------------------------------------------------------

--
-- Table structure for table `quocgia_linhvuc`
--

DROP TABLE IF EXISTS `quocgia_linhvuc`;
CREATE TABLE IF NOT EXISTS `quocgia_linhvuc` (
  `id_quocgia_linhvuc` int(11) NOT NULL AUTO_INCREMENT,
  `id_quocgia` int(11) NOT NULL,
  `id_linhvuc` int(11) NOT NULL,
  PRIMARY KEY (`id_quocgia_linhvuc`),
  UNIQUE KEY `unique_quocgia_linhvuc` (`id_quocgia`,`id_linhvuc`) USING BTREE,
  KEY `fk_mix_quocgia_linhvuc_2` (`id_linhvuc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

DROP TABLE IF EXISTS `taikhoan`;
CREATE TABLE IF NOT EXISTS `taikhoan` (
  `id_taikhoan` int(11) NOT NULL AUTO_INCREMENT,
  `tk_email` varchar(255) NOT NULL,
  `tk_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_taikhoan`),
  UNIQUE KEY `tk_email` (`tk_email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id_taikhoan`, `tk_email`, `tk_password`) VALUES
(1, 'admin@gmail.com', 'admin'),
(2, 'quan@gmail.com', '123456'),
(5, 'test1@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tns_camket_khamsk`
--

DROP TABLE IF EXISTS `tns_camket_khamsk`;
CREATE TABLE IF NOT EXISTS `tns_camket_khamsk` (
  `id_camket_khamsk` int(11) NOT NULL AUTO_INCREMENT,
  `id_tns` int(11) NOT NULL,
  `dacamket` int(11) NOT NULL DEFAULT '0',
  `solankhamsk` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0: chua hoan thanh',
  `ghichu` text,
  PRIMARY KEY (`id_camket_khamsk`),
  UNIQUE KEY `id_tns_2` (`id_tns`),
  KEY `id_tns` (`id_tns`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tns_camket_khamsk`
--

INSERT INTO `tns_camket_khamsk` (`id_camket_khamsk`, `id_tns`, `dacamket`, `solankhamsk`, `status`, `ghichu`) VALUES
(1, 4, 1, 7, 1, NULL),
(2, 6, 1, 0, 1, NULL),
(3, 3, 1, 0, 1, NULL),
(4, 7, 1, 0, 1, NULL),
(5, 14, 1, 0, 1, NULL),
(6, 15, 1, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tunghiepsinh`
--

DROP TABLE IF EXISTS `tunghiepsinh`;
CREATE TABLE IF NOT EXISTS `tunghiepsinh` (
  `id_tns` int(11) NOT NULL AUTO_INCREMENT,
  `tns_hoten` varchar(255) NOT NULL,
  `tns_ngaysinh` int(11) NOT NULL,
  `tns_gioitinh` int(11) NOT NULL DEFAULT '0',
  `tns_cmnd` varchar(255) NOT NULL,
  `tns_email` varchar(255) NOT NULL,
  `tns_sodt` varchar(255) NOT NULL,
  `tns_diachi` varchar(255) NOT NULL,
  `tns_id_quocgia` int(11) NOT NULL,
  PRIMARY KEY (`id_tns`),
  UNIQUE KEY `tns_cmnd` (`tns_cmnd`),
  KEY `tns_id_quocgia` (`tns_id_quocgia`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tunghiepsinh`
--

INSERT INTO `tunghiepsinh` (`id_tns`, `tns_hoten`, `tns_ngaysinh`, `tns_gioitinh`, `tns_cmnd`, `tns_email`, `tns_sodt`, `tns_diachi`, `tns_id_quocgia`) VALUES
(3, 'test1', 1484784000, 2, '11111cmnd', 'abc@gmail.com', '987654321', 'day la nha test1', 3),
(4, 'Tran Van Muoi', 727574400, 1, '022123456', 'muoi@gmail.com', '123456789', 'Địa chỉ nhà ông 10 đây nha', 3),
(6, 'Trần Đức test3', 1484784000, 1, '555555555', 'test3@yahoo.com', '987654321', '55 Phạm Văn Chiêu, F.14, Q.Gò Vấp', 1),
(7, 'Bui Văn Chiến', 1485475200, 2, '66666666', 'chien@yopmail.com', '54561351', 'vcdzvzvczsvz', 1),
(14, 'Tran Duc A', 1484784000, 1, '456456456', 'abc@gmail.com', '654654654', 'tgsergse', 2),
(15, 'Lại Văn Công', 1476835200, 2, '1864134', 'cong@gmail.com', '16441348641', 'huigyh', 1),
(16, 'Nguyễn Thanh Xuân', 1513036800, 1, '371755478', 'tragnhan@gmail.com', '0166587996', '9 Trung Lang', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dangky_tns`
--
ALTER TABLE `dangky_tns`
  ADD CONSTRAINT `fk_dangky_tns_quocgia` FOREIGN KEY (`dk_id_quocgia`) REFERENCES `quocgia` (`id_quocgia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`id_quocgia`) REFERENCES `quocgia` (`id_quocgia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`id_linhvuc`) REFERENCES `linhvuc` (`id_linhvuc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hoso`
--
ALTER TABLE `hoso`
  ADD CONSTRAINT `hoso_ibfk_1` FOREIGN KEY (`id_tns`) REFERENCES `tunghiepsinh` (`id_tns`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quocgia_linhvuc`
--
ALTER TABLE `quocgia_linhvuc`
  ADD CONSTRAINT `fk_mix_quocgia_linhvuc_1` FOREIGN KEY (`id_quocgia`) REFERENCES `quocgia` (`id_quocgia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mix_quocgia_linhvuc_2` FOREIGN KEY (`id_linhvuc`) REFERENCES `linhvuc` (`id_linhvuc`);

--
-- Constraints for table `tns_camket_khamsk`
--
ALTER TABLE `tns_camket_khamsk`
  ADD CONSTRAINT `tns_camket_khamsk_ibfk_1` FOREIGN KEY (`id_tns`) REFERENCES `tunghiepsinh` (`id_tns`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tunghiepsinh`
--
ALTER TABLE `tunghiepsinh`
  ADD CONSTRAINT `fk_tunghiepsinh_quocgia` FOREIGN KEY (`tns_id_quocgia`) REFERENCES `quocgia` (`id_quocgia`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
