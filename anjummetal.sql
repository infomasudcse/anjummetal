-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 03:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anjummetal`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accessories_receive`
--

CREATE TABLE `accessories_receive` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(30) NOT NULL,
  `chalan_date` date NOT NULL,
  `acc_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accessories_receive_chalan`
--

CREATE TABLE `accessories_receive_chalan` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(30) NOT NULL,
  `chalan_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `total` float(10,2) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accessories_stock`
--

CREATE TABLE `accessories_stock` (
  `id` int(11) NOT NULL,
  `accessories_id` int(11) NOT NULL,
  `add_qty` int(11) NOT NULL DEFAULT 0,
  `remove_qty` int(11) NOT NULL DEFAULT 0,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `debit` float(8,2) NOT NULL DEFAULT 0.00,
  `credit` float(8,2) NOT NULL DEFAULT 0.00,
  `purpose` enum('buy','sale','payment','old') NOT NULL,
  `type` enum('cash','cheque','-','rejection','TT') NOT NULL DEFAULT '-',
  `chalan_id` int(11) NOT NULL,
  `chalan_no` varchar(20) NOT NULL DEFAULT '0',
  `payment_date` date NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL,
  `details` tinytext DEFAULT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account_supplier`
--

CREATE TABLE `account_supplier` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `debit` float(8,2) NOT NULL DEFAULT 0.00,
  `credit` float(8,2) NOT NULL DEFAULT 0.00,
  `purpose` enum('buy','sale','payment','old','manual') NOT NULL,
  `type` enum('cash','cheque','-','rejection') NOT NULL DEFAULT '-',
  `chalan_id` int(11) NOT NULL,
  `chalan_no` varchar(20) NOT NULL DEFAULT '0',
  `payment_date` date NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL,
  `material` varchar(50) DEFAULT NULL,
  `weight` double(10,3) NOT NULL DEFAULT 0.000,
  `details` tinytext DEFAULT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cost` float(10,2) NOT NULL DEFAULT 0.00,
  `qty` mediumint(9) NOT NULL,
  `description` tinytext NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assets_edit_note`
--

CREATE TABLE `assets_edit_note` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `attendence_date` date NOT NULL,
  `operator_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buyer_payment`
--

CREATE TABLE `buyer_payment` (
  `payment_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `department_status` enum('1','0') NOT NULL DEFAULT '1',
  `creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL DEFAULT 0,
  `salary_per_unit_product` float(6,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_account`
--

CREATE TABLE `employee_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `debit` float(8,2) NOT NULL DEFAULT 0.00,
  `credit` float(8,2) NOT NULL DEFAULT 0.00,
  `type` enum('production','salary','advance') NOT NULL,
  `ref` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `expense_type_id` int(11) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `note` varchar(150) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fixed_salary`
--

CREATE TABLE `fixed_salary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `salary` float(8,2) NOT NULL DEFAULT 0.00,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `goods_receive`
--

CREATE TABLE `goods_receive` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(30) NOT NULL,
  `chalan_date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `goods_receive_chalan`
--

CREATE TABLE `goods_receive_chalan` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(30) NOT NULL,
  `chalan_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `total` float(10,2) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hour_salary`
--

CREATE TABLE `hour_salary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `salary` float(8,2) NOT NULL DEFAULT 0.00,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material_consume`
--

CREATE TABLE `material_consume` (
  `id` int(11) NOT NULL,
  `material_type_id` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `weight` double(8,2) NOT NULL,
  `unit` varchar(10) NOT NULL DEFAULT 'Kg',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `making_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_sale_chalan`
--

CREATE TABLE `product_sale_chalan` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(30) NOT NULL,
  `chalan_date` date NOT NULL,
  `from_dep` int(6) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `operator_id` int(6) NOT NULL,
  `total` double(16,2) NOT NULL,
  `totweight` double(8,4) NOT NULL,
  `other_expense` double(8,2) NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_sell`
--

CREATE TABLE `product_sell` (
  `id` int(11) NOT NULL,
  `chalan_id` int(11) NOT NULL,
  `chalan_no` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `qty` double(8,3) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `weight` double(8,3) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `id` int(11) NOT NULL,
  `stock_chalan_id` int(11) NOT NULL,
  `chalan_no` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `qty` double(8,3) NOT NULL,
  `price` double(8,2) NOT NULL,
  `weight` double(8,2) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `subtotal` double(8,2) NOT NULL DEFAULT 0.00,
  `chalan_date` date NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_chalan`
--

CREATE TABLE `product_stock_chalan` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(50) NOT NULL,
  `chalan_date` date NOT NULL,
  `total` double(8,2) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `totweight` double(8,3) NOT NULL DEFAULT 0.000,
  `type` enum('new','old') NOT NULL DEFAULT 'new',
  `updated_at` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_transfer`
--

CREATE TABLE `product_transfer` (
  `id` int(11) NOT NULL,
  `chalan_no` int(11) NOT NULL,
  `chalan_date` date NOT NULL,
  `to_dep` int(11) NOT NULL,
  `from_dep` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` float(6,2) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_transfer_chalan`
--

CREATE TABLE `product_transfer_chalan` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(20) NOT NULL,
  `chalan_date` date NOT NULL,
  `from_dep` int(5) NOT NULL,
  `to_dep` int(5) NOT NULL,
  `operator_id` int(8) NOT NULL,
  `total` float(10,2) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL,
  `type_name` varchar(80) NOT NULL,
  `description` tinytext NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `raw_material`
--

CREATE TABLE `raw_material` (
  `id` int(11) NOT NULL,
  `material_chalan_id` int(11) NOT NULL,
  `chalan_no` varchar(20) NOT NULL,
  `material_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `price` float(8,2) NOT NULL,
  `quantity` double(8,3) NOT NULL DEFAULT 0.000,
  `subtotal` float(10,2) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_chalan`
--

CREATE TABLE `raw_material_chalan` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(20) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `chalan_date` date NOT NULL,
  `operator_id` int(11) NOT NULL,
  `total` float(10,2) NOT NULL,
  `totweight` double(8,3) NOT NULL DEFAULT 0.000,
  `other_expense` double(8,2) NOT NULL DEFAULT 0.00,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `updated_at` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_type`
--

CREATE TABLE `raw_material_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `type_desc` tinytext NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recycle`
--

CREATE TABLE `recycle` (
  `id` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `material_type_id` int(11) NOT NULL,
  `recycle_qty` float(8,2) NOT NULL,
  `from_waste_qty` float(8,2) NOT NULL,
  `final_waste_qty` float(8,2) NOT NULL,
  `uncountable_qty` float(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reject_product`
--

CREATE TABLE `reject_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `note` tinytext NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scrab`
--

CREATE TABLE `scrab` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scrab_delivery`
--

CREATE TABLE `scrab_delivery` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(30) NOT NULL,
  `chalan_date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `from_dep` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scrab_delivery_chalan`
--

CREATE TABLE `scrab_delivery_chalan` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(30) NOT NULL,
  `chalan_date` date NOT NULL,
  `from_dep` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `total` float(10,2) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spare_parts`
--

CREATE TABLE `spare_parts` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `operator_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spare_parts_chalan`
--

CREATE TABLE `spare_parts_chalan` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(15) NOT NULL,
  `chalan_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `total` float(6,2) NOT NULL,
  `status` enum('unverified','verified') NOT NULL DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spare_parts_receive`
--

CREATE TABLE `spare_parts_receive` (
  `id` int(11) NOT NULL,
  `chalan_no` varchar(15) NOT NULL,
  `chalan_date` date NOT NULL,
  `parts_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `price` float(6,2) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `subtotal` float(6,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `staff_salary` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payment`
--

CREATE TABLE `supplier_payment` (
  `payment_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '0',
  `password` varchar(32) NOT NULL DEFAULT '0',
  `full_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `nid` varchar(20) NOT NULL,
  `address` tinytext NOT NULL,
  `mobile` varchar(20) NOT NULL DEFAULT '01010101010',
  `role` enum('admin','staff','employee','supplier','buyer','stock') NOT NULL DEFAULT 'employee',
  `status` enum('1','0') NOT NULL,
  `image` varchar(32) DEFAULT 'default.jpg',
  `comments` tinytext NOT NULL,
  `salary_type_id` int(11) NOT NULL DEFAULT 0,
  `department_id` int(11) NOT NULL DEFAULT 0,
  `metal_id` varchar(15) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL,
  `old_account` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `waste`
--

CREATE TABLE `waste` (
  `id` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `qty` double(10,3) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accessories_receive`
--
ALTER TABLE `accessories_receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accessories_receive_chalan`
--
ALTER TABLE `accessories_receive_chalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accessories_stock`
--
ALTER TABLE `accessories_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_supplier`
--
ALTER TABLE `account_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets_edit_note`
--
ALTER TABLE `assets_edit_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyer_payment`
--
ALTER TABLE `buyer_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixed_salary`
--
ALTER TABLE `fixed_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_receive`
--
ALTER TABLE `goods_receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_receive_chalan`
--
ALTER TABLE `goods_receive_chalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hour_salary`
--
ALTER TABLE `hour_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_consume`
--
ALTER TABLE `material_consume`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_sale_chalan`
--
ALTER TABLE `product_sale_chalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sell`
--
ALTER TABLE `product_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stock_chalan`
--
ALTER TABLE `product_stock_chalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_transfer`
--
ALTER TABLE `product_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_transfer_chalan`
--
ALTER TABLE `product_transfer_chalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material_chalan`
--
ALTER TABLE `raw_material_chalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material_type`
--
ALTER TABLE `raw_material_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `recycle`
--
ALTER TABLE `recycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reject_product`
--
ALTER TABLE `reject_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scrab`
--
ALTER TABLE `scrab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scrab_delivery`
--
ALTER TABLE `scrab_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scrab_delivery_chalan`
--
ALTER TABLE `scrab_delivery_chalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spare_parts`
--
ALTER TABLE `spare_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spare_parts_chalan`
--
ALTER TABLE `spare_parts_chalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spare_parts_receive`
--
ALTER TABLE `spare_parts_receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `supplier_payment`
--
ALTER TABLE `supplier_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waste`
--
ALTER TABLE `waste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accessories_receive`
--
ALTER TABLE `accessories_receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accessories_receive_chalan`
--
ALTER TABLE `accessories_receive_chalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accessories_stock`
--
ALTER TABLE `accessories_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `account_supplier`
--
ALTER TABLE `account_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assets_edit_note`
--
ALTER TABLE `assets_edit_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buyer_payment`
--
ALTER TABLE `buyer_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_account`
--
ALTER TABLE `employee_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fixed_salary`
--
ALTER TABLE `fixed_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods_receive`
--
ALTER TABLE `goods_receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods_receive_chalan`
--
ALTER TABLE `goods_receive_chalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hour_salary`
--
ALTER TABLE `hour_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_consume`
--
ALTER TABLE `material_consume`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sale_chalan`
--
ALTER TABLE `product_sale_chalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sell`
--
ALTER TABLE `product_sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock`
--
ALTER TABLE `product_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock_chalan`
--
ALTER TABLE `product_stock_chalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_transfer`
--
ALTER TABLE `product_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_transfer_chalan`
--
ALTER TABLE `product_transfer_chalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_material`
--
ALTER TABLE `raw_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_material_chalan`
--
ALTER TABLE `raw_material_chalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `raw_material_type`
--
ALTER TABLE `raw_material_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recycle`
--
ALTER TABLE `recycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reject_product`
--
ALTER TABLE `reject_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scrab`
--
ALTER TABLE `scrab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scrab_delivery`
--
ALTER TABLE `scrab_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scrab_delivery_chalan`
--
ALTER TABLE `scrab_delivery_chalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spare_parts`
--
ALTER TABLE `spare_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spare_parts_chalan`
--
ALTER TABLE `spare_parts_chalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spare_parts_receive`
--
ALTER TABLE `spare_parts_receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_payment`
--
ALTER TABLE `supplier_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waste`
--
ALTER TABLE `waste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
