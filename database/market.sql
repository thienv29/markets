-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 28, 2021 lúc 06:24 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `market`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `CategoryID` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`CategoryID`, `Name`, `Description`) VALUES
(1, 'Fruit', 'The kind that can be eaten without cooking'),
(2, 'Green Vegetables', 'The kind used to make salads or soups'),
(3, 'Spices', 'The kind used to enhance the taste of food');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(10) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Fullname` varchar(40) NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`CustomerID`, `Password`, `Fullname`, `Address`, `City`) VALUES
(1, 'Abcd1234', 'John Smith', '30 Broadway', 'London'),
(2, 'Abcd1234', 'Jonny English', '99 River View', 'Reading'),
(3, 'Abcd1234', 'Elizabeth', '23 Buckinghamshire', 'York'),
(4, 'Abcd1234', 'Beatrix', '66 Royal Crescent', 'Bath');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `OrderID` int(10) UNSIGNED NOT NULL,
  `CustomerID` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Total` float NOT NULL,
  `Note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`OrderID`, `CustomerID`, `Date`, `Total`, `Note`) VALUES
(0, 1, '2021-08-15', 150000, 'Use environmental protection bags'),
(1, 2, '2021-08-16', 235000, ''),
(2, 3, '2021-08-16', 65000, 'Need fast delivery'),
(3, 3, '2021-08-17', 80000, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderID` int(10) UNSIGNED NOT NULL,
  `VegetableID` int(10) NOT NULL,
  `Quantity` tinyint(4) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`OrderID`, `VegetableID`, `Quantity`, `Price`) VALUES
(0, 1, 1, 30000),
(0, 8, 1, 120000),
(1, 4, 1, 80000),
(1, 2, 1, 35000),
(1, 3, 1, 150000),
(2, 5, 1, 35000),
(2, 7, 2, 30000),
(3, 6, 2, 80000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vegetable`
--

CREATE TABLE `vegetable` (
  `VegetableID` int(10) NOT NULL,
  `CategoryID` int(10) NOT NULL,
  `VegetableName` varchar(30) NOT NULL,
  `Unit` varchar(20) NOT NULL,
  `Amount` int(10) NOT NULL,
  `Image` varchar(50) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `vegetable`
--

INSERT INTO `vegetable` (`VegetableID`, `CategoryID`, `VegetableName`, `Unit`, `Amount`, `Image`, `Price`) VALUES
(1, 1, 'Tomato', 'kg', 100, 'images/tomato.jpg', 30000),
(2, 1, 'potato', 'kg', 150, 'images/potato.jpg', 35000),
(3, 1, 'Apple', 'bag', 50, 'images/apple.jpg', 150000),
(4, 1, 'Water melon', 'per fruit', 20, 'images/watermelon.jpg', 80000),
(5, 2, ' broccoli', 'kg', 50, 'images/broccoli.jpg', 35000),
(6, 2, 'celery', 'kg', 80, 'images/celery.jpg', 40000),
(7, 3, ' spring onion', 'bunch', 50, 'images/springonion.jpg', 15000),
(8, 3, 'garlic', 'kg', 30, 'images/garlic.jpg', 120000);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `VegetableID` (`VegetableID`);

--
-- Chỉ mục cho bảng `vegetable`
--
ALTER TABLE `vegetable`
  ADD PRIMARY KEY (`VegetableID`),
  ADD KEY `CatagoryID` (`CategoryID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `vegetable`
--
ALTER TABLE `vegetable`
  MODIFY `VegetableID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`VegetableID`) REFERENCES `vegetable` (`VegetableID`);

--
-- Các ràng buộc cho bảng `vegetable`
--
ALTER TABLE `vegetable`
  ADD CONSTRAINT `vegetable_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
