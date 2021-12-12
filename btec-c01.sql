-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2021 at 11:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btec-c01`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Nguyen Vu', 'cnv@123', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `time` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`id`, `title`, `location`, `time`, `description`, `status`) VALUES
(1, 'Antiques, General, Furniture and Collectibles', 'Hele', '2021-12-19', 'Antiques, General, Furniture and Collectibles', 1),
(2, 'Christmas Quality 740 Lot Sale of Antiques, Collectibles', '21st Halans Church', '2021-12-23', 'Christmas Quality 740 Lot Sale of Antiques, Collectibles, Traditional Furniture, Art, Rugs, Vintage Toys, Jewellery, Silver, Watches - 774 Lots', 0),
(3, 'The Antique Village', 'United Kingdom', '2021-12-31', 'Fine Art, Antiques and Collectables\r\n\r\nDavid Bowie, Textiles, Silver, Jewellery, Antiques & Fine Art, Pablo Picasso, William Russell Flint, Diamonds. Pistols.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `location`) VALUES
(1, 'Barn Vintage ', 'USA'),
(2, 'VintageLand', 'India'),
(3, 'Antique Plaza', 'Korean'),
(4, 'Best Vynil', 'Spain');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_no` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `phone_no`, `email`, `password`) VALUES
(1, 'Duy Hieu', 'Chung cu 789 XD', '0983079271', 'cdh@123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `id_invoice` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quanity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_amount` float NOT NULL,
  `receiver` varchar(40) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `id_customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `description`, `status`, `id_type`, `id_brand`) VALUES
(1, 'Reed E. Barton Silver Plated ', 'https://www.tias.com/stores/ftlogantwo/pictures/fac03235a.jpg', 75, 'Nice Reed E. Barton silver plated candy dish. Signed and numbered on the back. 6-1/8\" in diameter. Very good condition with modest wear. 1950s.', 1, 1, 3),
(2, 'Fruit Bowl Silver Plate Hammer ', 'https://www.tias.com/stores/gea/pictures/sil466a.jpg', 165, 'This is a top quality, fine finish silver plated fruit or center piece bowl with a lightly hammered finish as well are a multi-facetted form! It also has a very sturdy design with a heavy duty round bead around the top rim. The bowl is marked \"DS DIONI ITALY SILVER PLATED\" on metallic stickers on the bottom. A very unique design, and in fine condition! When I first saw it, the bowl reminded me of mercury glass, as it has such a highly polished finish inside and out. The bowl is 3\" tall x 10.5\" diameter at the widest form. It weighs 1.6 pounds. Very nice, quality made! I am not sure if my pictures do it justice, but I know you will be please with it.', 1, 1, 4),
(3, 'Ornate Silver Bowl', 'https://www.tias.com/stores/aalmw/thumbs/2528a.jpg', 34, 'This silver bowl has a very detailed design in the edging of the bowl. The bottom is marked Gorham, E P 01752. The bowl is 9 1/2 in. in diameter and is 1 1/2 in. tall. It is one of the most elegant bowls I have seen.', 1, 1, 2),
(4, 'Hartford Teapot Silverplate 1920\'s', 'https://www.tias.com/stores/gea/pictures/kitch201a.jpg', 45, 'This is a nice silver plated teapot, made by Hartford Sterling Co. Phila. PA Ca. 1901-1930\'s. It has nicely detailed decorations, considered to be of the 1920\'s period style. It is 10\" tall with a good hinged lid. It is in good+ condition with very little silver plating loss, a few tiny scratches and dings noted.\r\nThe mark on the bottom is the trade mark for Hartford Sterling Company Phila. PA U.S.A.. We have lots of other quality silver and silver plated listing including tableware and flatware items for sale!', 2, 1, 4),
(5, 'Lavender Jade/glass Bracelet', 'https://www.tias.com/stores/praz/pictures/1114202113a.jpg', 85, 'Lavender Jade/Glass Stretch Bracelet 7/8 Inch Wide.', 1, 4, 4),
(6, 'Obsidian Navajo Sterling Clip Earrings ', 'https://www.tias.com/stores/praz/pictures/1122202106a.jpg', 160, 'Obsidian Navajo Sterling Silver Clip Earrings 1 3/4 Inches long 3/4 inch wide', 1, 4, 4),
(7, 'Ernest Rangel Purple Spiny Oyster', 'https://www.tias.com/stores/praz/pictures/1114202103a.jpg', 500, 'Ernest Rangel Purple Spiny Oyster Tufa cast Sterling Silver Bracelet 5 1/2 inches inside end to end 1 1/8 inch Gap 30 Grams', 1, 4, 4),
(8, 'Vintage Metal Enamel Iris Earrings', 'https://www.tias.com/stores/silsnw/pictures/f18a.jpg', 18, 'About 1 7/8\" drop, very good, New brand', 2, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Antique'),
(2, 'Decoration'),
(3, 'Furniture'),
(4, 'Jewelry');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD PRIMARY KEY (`id_invoice`,`id_product`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD CONSTRAINT `invoicedetails_ibfk_1` FOREIGN KEY (`id_invoice`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `invoicedetails_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
