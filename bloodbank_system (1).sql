-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 24, 2026 at 08:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `bank_id`) VALUES
(1, 'Raj Sharma', 'raj1@gmail.com', '1234', 1),
(6, 'Vijay Sharma', 'vijay2@gmail.com', '4321', 6),
(8, 'Sumit Narayan', 'sumit34@gmail.com', '2387', 7),
(12, 'Rashmika Biswa', 'rashmika@gmail.com', '2134', 10),
(13, 'Vedant Keshav', 'vedant7@gmail.com', '9800', 8),
(14, 'Mihita Choudhary', 'mihi29@gmail.com', '4598', 9);

-- --------------------------------------------------------

--
-- Table structure for table `blood_banks`
--

CREATE TABLE `blood_banks` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_banks`
--

INSERT INTO `blood_banks` (`bank_id`, `bank_name`, `address`, `contact`) VALUES
(1, 'Odisha Blood Bank', 'Capital Hospital Rd,Bhubaneshwar,Odisha', '6742394985'),
(6, 'KIMS blood bank', 'KIIT university,Patia,Bhubaneshwar,Odisha', '3456782376'),
(7, 'Red Cross Blood Centre', 'Road No:2,Unit-9,Bhubaneswar,Odisha', '7623457687'),
(8, 'Apollo 24/7 Lab Test', 'KIIT Rd,opp.SBI Bank,Patia,Bhubaneswar', '0804885103'),
(9, 'Indian Red Cross Society', 'Near Canara Bank,Unit-9,Bhubaneswar', '6742390712'),
(10, 'Pradyumna Bal Memorial Hospital', 'KIIT University,Chandaka Industrial Estate,Patia,Bhubaneswar', '6742304400');

-- --------------------------------------------------------

--
-- Table structure for table `blood_stock`
--

CREATE TABLE `blood_stock` (
  `stock_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `units` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_stock`
--

INSERT INTO `blood_stock` (`stock_id`, `bank_id`, `blood_group`, `units`) VALUES
(1, 1, 'A+', 5),
(2, 1, 'A-', 4),
(3, 1, 'B+', 0),
(4, 1, 'B-', 6),
(5, 1, 'AB+', 0),
(6, 1, 'AB-', 0),
(7, 1, 'O+', 3),
(8, 1, 'O-', 1),
(9, 6, 'A+', 6),
(10, 6, 'A-', 3),
(11, 6, 'B+', 2),
(12, 6, 'B-', 6),
(13, 6, 'AB+', 2),
(14, 6, 'AB-', 2),
(15, 6, 'O+', 10),
(16, 6, 'O-', 3),
(17, 8, 'A+', 1),
(18, 7, 'A+', 2),
(26, 7, 'O-', 2),
(27, 7, 'B+', 2),
(28, 7, 'A-', 1),
(29, 7, 'B-', 0),
(30, 7, 'AB+', 1),
(31, 7, 'AB-', 0),
(32, 7, 'O+', 5),
(40, 8, 'O-', 2),
(41, 8, 'A-', 0),
(42, 8, 'B+', 1),
(43, 8, 'B-', 2),
(44, 8, 'AB+', 1),
(45, 8, 'AB-', 0),
(46, 8, 'O+', 4),
(71, 9, 'A+', 9),
(72, 9, 'A-', 2),
(73, 9, 'B+', 1),
(74, 9, 'B-', 0),
(75, 9, 'AB+', 1),
(76, 9, 'AB-', 0),
(77, 9, 'O+', 7),
(78, 9, 'O-', 2),
(79, 10, 'A+', 5),
(80, 10, 'A-', 0),
(81, 10, 'B+', 1),
(82, 10, 'B-', 0),
(83, 10, 'AB+', 2),
(84, 10, 'AB-', 3),
(85, 10, 'O+', 3),
(86, 10, 'O-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `units` int(11) NOT NULL CHECK (`units` > 0),
  `collection_place` varchar(150) NOT NULL,
  `donation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `donor_id`, `bank_id`, `blood_group`, `units`, `collection_place`, `donation_date`) VALUES
(1, 1, 6, 'O+', 1, 'KIIT University', '2025-02-03'),
(2, 1, 6, 'O+', 1, 'KIIT University', '2026-01-30'),
(5, 4, 6, 'AB+', 3, 'KISS School', '2025-05-09'),
(6, 5, 1, 'A-', 1, 'Legal ground', '2026-01-07'),
(7, 1, 1, 'O+', 1, 'Odisha Blood Bank', '2026-03-01'),
(8, 4, 6, 'AB+', 2, 'KIMS Blood Bank', '2026-03-02'),
(9, 5, 7, 'A-', 1, 'Red Cross Blood Centre', '2026-03-03'),
(10, 6, 8, 'AB+', 2, 'Apollo 24/7 Lab Test', '2026-03-04'),
(11, 7, 9, 'A+', 1, 'Indian Red Cross Society', '2026-03-05'),
(12, 8, 10, 'B+', 3, 'Pradyumna Bal Memorial Hospital', '2026-03-06'),
(13, 9, 1, 'O+', 2, 'Odisha Blood Bank', '2026-03-07'),
(14, 10, 6, 'AB+', 1, 'KIMS Blood Bank', '2026-03-08'),
(15, 11, 7, 'A-', 2, 'Red Cross Blood Centre', '2026-03-09'),
(16, 12, 8, 'B-', 1, 'Apollo 24/7 Lab Test', '2026-03-10'),
(17, 13, 9, 'O-', 1, 'Indian Red Cross Society', '2026-03-11'),
(18, 14, 10, 'AB-', 2, 'Pradyumna Bal Memorial Hospital', '2026-03-12'),
(19, 15, 1, 'A+', 1, 'Odisha Blood Bank', '2026-03-13'),
(20, 16, 6, 'B+', 2, 'KIMS Blood Bank', '2026-03-14'),
(21, 17, 7, 'O+', 1, 'Red Cross Blood Centre', '2026-03-15'),
(22, 18, 8, 'AB+', 2, 'Apollo 24/7 Lab Test', '2026-03-16'),
(23, 19, 9, 'A-', 1, 'Indian Red Cross Society', '2026-03-17'),
(24, 20, 10, 'B-', 2, 'Pradyumna Bal Memorial Hospital', '2026-03-18'),
(25, 21, 1, 'O-', 1, 'Odisha Blood Bank', '2026-03-19'),
(26, 22, 6, 'AB-', 2, 'KIMS Blood Bank', '2026-03-20'),
(27, 23, 1, 'A+', 1, 'Odisha Blood Bank', '2026-03-21'),
(28, 24, 6, 'B+', 2, 'KIMS Blood Bank', '2026-03-22'),
(29, 25, 7, 'O+', 1, 'Red Cross Blood Centre', '2026-03-23'),
(30, 26, 8, 'AB+', 2, 'Apollo 24/7 Lab Test', '2026-03-24'),
(31, 27, 9, 'A+', 1, 'Indian Red Cross Society', '2026-03-25'),
(32, 28, 10, 'B+', 2, 'Pradyumna Bal Memorial Hospital', '2026-03-26'),
(33, 29, 1, 'O+', 1, 'Odisha Blood Bank', '2026-03-27'),
(34, 30, 6, 'AB+', 2, 'KIMS Blood Bank', '2026-03-28'),
(35, 31, 7, 'A-', 1, 'Red Cross Blood Centre', '2026-03-29'),
(36, 32, 8, 'B-', 2, 'Apollo 24/7 Lab Test', '2026-03-30'),
(37, 33, 9, 'O-', 1, 'Indian Red Cross Society', '2026-03-31'),
(38, 34, 10, 'AB-', 2, 'Pradyumna Bal Memorial Hospital', '2026-04-01'),
(39, 35, 1, 'A+', 1, 'Odisha Blood Bank', '2026-04-02'),
(40, 36, 6, 'B+', 2, 'KIMS Blood Bank', '2026-04-03'),
(41, 37, 7, 'O+', 1, 'Red Cross Blood Centre', '2026-04-04'),
(42, 38, 8, 'AB+', 2, 'Apollo 24/7 Lab Test', '2026-04-05'),
(43, 39, 9, 'A-', 2, 'Indian Red Cross Society', '2026-04-06'),
(44, 40, 10, 'B-', 2, 'Pradyumna Bal Memorial Hospital', '2026-04-07'),
(45, 41, 1, 'O-', 1, 'Odisha Blood Bank', '2026-04-08'),
(46, 42, 6, 'AB-', 2, 'KIMS Blood Bank', '2026-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `name`, `email`, `password`, `contact`, `blood_group`) VALUES
(1, 'Ronita Chakraborty', 'ronita.chakraborty.21@gmail.com', '4923', '1234567892', 'O+'),
(4, 'Mahesh Gupta', 'mahesh2@gmail.com', '1212', '3456789065', 'AB+'),
(5, 'Renuka Das', 'renudas@gmail.com', '2121', '5764892345', 'A-'),
(6, 'Aarya shukla', 'aarya@gmail.com', '7890', '9452367893', 'AB+'),
(7, 'Aarav Sharma', 'aarav.sharma1@gmail.com', '1234', '9876543210', 'A+'),
(8, 'Ananya Gupta', 'ananya.gupta2@gmail.com', '2345', '9123456780', 'B+'),
(9, 'Rohan Mehta', 'rohan.mehta3@gmail.com', '3456', '9988776655', 'O+'),
(10, 'Sneha Iyer', 'sneha.iyer4@gmail.com', '4567', '9876501234', 'AB+'),
(11, 'Vikram Singh', 'vikram.singh5@gmail.com', '5678', '9123409876', 'A-'),
(12, 'Karan Patel', 'karan.patel6@gmail.com', '6789', '9012345678', 'B-'),
(13, 'Priya Nair', 'priya.nair7@gmail.com', '7890', '9988001122', 'O-'),
(14, 'Aditya Verma', 'aditya.verma8@gmail.com', '1122', '9871234560', 'AB-'),
(15, 'Neha Kapoor', 'neha.kapoor9@gmail.com', '2233', '9765432109', 'A+'),
(16, 'Rahul Das', 'rahul.das10@gmail.com', '3344', '9654321098', 'B+'),
(17, 'Saurabh Jain', 'saurabh.jain11@gmail.com', '4455', '9543210987', 'O+'),
(18, 'Pooja Reddy', 'pooja.reddy12@gmail.com', '5566', '9432109876', 'AB+'),
(19, 'Arjun Malhotra', 'arjun.malhotra13@gmail.com', '6677', '9321098765', 'A-'),
(20, 'Kavita Joshi', 'kavita.joshi14@gmail.com', '7788', '9210987654', 'B-'),
(21, 'Amit Kulkarni', 'amit.kulkarni15@gmail.com', '8899', '9109876543', 'O-'),
(22, 'Nikhil Chatterjee', 'nikhil.chatterjee16@gmail.com', '9900', '9098765432', 'AB-'),
(23, 'Riya Banerjee', 'riya.banerjee17@gmail.com', '1010', '8987654321', 'A+'),
(24, 'Manish Yadav', 'manish.yadav18@gmail.com', '2020', '8876543210', 'B+'),
(25, 'Sunita Mishra', 'sunita.mishra19@gmail.com', '3030', '8765432109', 'O+'),
(26, 'Deepak Agarwal', 'deepak.agarwal20@gmail.com', '4040', '8654321098', 'AB+'),
(27, 'Harsh Vardhan', 'harsh.vardhan21@gmail.com', '5151', '8543210987', 'A+'),
(28, 'Meera Nair', 'meera.nair22@gmail.com', '6262', '8432109876', 'B+'),
(29, 'Devansh Kapoor', 'devansh.kapoor23@gmail.com', '7373', '8321098765', 'O+'),
(30, 'Ishita Sharma', 'ishita.sharma24@gmail.com', '8484', '8210987654', 'AB+'),
(31, 'Ritesh Pandey', 'ritesh.pandey25@gmail.com', '9595', '8109876543', 'A-'),
(32, 'Tanvi Deshmukh', 'tanvi.deshmukh26@gmail.com', '1111', '8098765432', 'B-'),
(33, 'Yash Thakur', 'yash.thakur27@gmail.com', '2222', '7987654321', 'O-'),
(34, 'Simran Kaur', 'simran.kaur28@gmail.com', '3333', '7876543210', 'AB-'),
(35, 'Abhishek Tiwari', 'abhishek.tiwari29@gmail.com', '4444', '7765432109', 'A+'),
(36, 'Nandini Rao', 'nandini.rao30@gmail.com', '5555', '7654321098', 'B+'),
(37, 'Kunal Shah', 'kunal.shah31@gmail.com', '6666', '7543210987', 'O+'),
(38, 'Shreya Ghosh', 'shreya.ghosh32@gmail.com', '7777', '7432109876', 'AB+'),
(39, 'Ravi Prakash', 'ravi.prakash33@gmail.com', '8888', '7321098765', 'A-'),
(40, 'Divya Bhatt', 'divya.bhatt34@gmail.com', '9999', '7210987654', 'B-'),
(41, 'Ankit Srivastava', 'ankit.srivastava35@gmail.com', '1212', '7109876543', 'O-'),
(42, 'Payal Jain', 'payal.jain36@gmail.com', '1313', '7098765432', 'AB-'),
(43, 'Gaurav Saxena', 'gaurav.saxena37@gmail.com', '1414', '6987654321', 'A+'),
(44, 'Swati Kulshreshtha', 'swati.kul38@gmail.com', '1515', '6876543210', 'B+'),
(45, 'Mohit Arora', 'mohit.arora39@gmail.com', '1616', '6765432109', 'O+'),
(46, 'Pallavi Sinha', 'pallavi.sinha40@gmail.com', '1717', '6654321098', 'AB+'),
(47, 'Keshavi Mishra', 'keshavi@gmail.com', '2300', '9452367893', 'O-'),
(48, 'Pratvik Kumar', 'pratvik@gmail.com', '4500', '9865743567', 'B+');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `name`, `email`, `contact`, `age`, `gender`, `blood_group`, `password`) VALUES
(1, 'Ronita Chakraborty', 'ronita.chakraborty.20@gmail.com', '1234567892', 20, 'Female', 'O+', '4923'),
(2, 'Suman Chakraborty', 'suman24@gmail.com', '3456789083', 50, 'Male', 'B+', '6789'),
(3, 'Nibedita Chakraborty', 'nita12@gmail.com', '9204419279', 49, 'Female', 'B+', '3456'),
(4, 'Sumona Sanyal', 'sumu3@gmail.com', '9856342145', 23, 'Female', 'AB+', '4326'),
(5, 'Sita Raman', 'sita6@gmail.com', '9812345645', 34, 'Female', 'A+', '0987'),
(6, 'Rajesh Dash', 'rajesh45@gmail.com', '9456789342', 27, 'Male', 'B+', '5698'),
(7, 'Akash Sharma', 'akash9@gmail.com', '9123457698', 22, 'Male', 'AB+', '1290'),
(8, 'Sayon Chakraborty', 'sayon@gmail.com', '9552345981', 23, 'Male', 'B+', '0088'),
(9, 'Arjun Mehta', 'arjun.m@gmail.com', '9876543210', 28, 'Male', 'O+', '1122'),
(10, 'Priya Das', 'priya.das@gmail.com', '8765432109', 24, 'Female', 'B+', '3344'),
(11, 'Vikram Singh', 'vikram.s@gmail.com', '7654321098', 45, 'Male', 'A+', '5566'),
(12, 'Anjali Sharma', 'anjali.s@gmail.com', '6543210987', 31, 'Female', 'O-', '7788'),
(13, 'Rahul Verma', 'rahul.v@gmail.com', '9988776655', 29, 'Male', 'AB+', '9900'),
(14, 'Ishani Bose', 'ishani.b@gmail.com', '8877665544', 22, 'Female', 'B-', '1212'),
(15, 'Sanjay Gupta', 'sanjay.g@gmail.com', '7766554433', 55, 'Male', 'O+', '3434'),
(16, 'Megha Nair', 'megha.n@gmail.com', '6655443322', 27, 'Female', 'A-', '5656'),
(17, 'Amit Tripati', 'amit.t@gmail.com', '9122334455', 40, 'Male', 'B+', '7878'),
(18, 'Sneha Kapoor', 'sneha.k@gmail.com', '8233445566', 21, 'Female', 'AB-', '9090'),
(19, 'Karan Malhotra', 'karan.m@gmail.com', '9822334411', 34, 'Male', 'O+', 'pass1'),
(20, 'Riya Sen', 'riya.sen@gmail.com', '9733445522', 26, 'Female', 'A+', 'pass2'),
(21, 'Deepak Jena', 'deepak.j@gmail.com', '9644556633', 42, 'Male', 'B-', 'pass3'),
(22, 'Sunita Mohanty', 'sunita.m@gmail.com', '9555667744', 38, 'Female', 'AB+', 'pass4'),
(23, 'Abhishek Das', 'abhishek.d@gmail.com', '9466778855', 29, 'Male', 'O-', 'pass5'),
(24, 'Tanaya Rao', 'tanaya.r@gmail.com', '9377889966', 23, 'Female', 'B+', 'pass6'),
(25, 'Manish Tiwari', 'manish.t@gmail.com', '9288990077', 50, 'Male', 'A-', 'pass7'),
(26, 'Pooja Hegde', 'pooja.h@gmail.com', '9199001188', 31, 'Female', 'AB-', 'pass8'),
(27, 'Rohan Mehra', 'rohan.m@gmail.com', '9011223399', 27, 'Male', 'O+', 'pass9'),
(28, 'Aditi Rao', 'aditi.r@gmail.com', '8922334400', 25, 'Female', 'B-', 'pass10'),
(29, 'Suresh Raina', 'suresh.r@gmail.com', '8833445511', 36, 'Male', 'A+', 'pass11'),
(30, 'Kavita Devi', 'kavita.d@gmail.com', '8744556622', 44, 'Female', 'O-', 'pass12'),
(31, 'Vijay Kumar', 'vijay.k@gmail.com', '8655667733', 33, 'Male', 'B+', 'pass13'),
(32, 'Nisha Pillai', 'nisha.p@gmail.com', '8566778844', 28, 'Female', 'AB+', 'pass14'),
(33, 'Rahul Dravid', 'rahul.d@gmail.com', '8477889955', 48, 'Male', 'O+', 'pass15'),
(34, 'Sania Mirza', 'sania.m@gmail.com', '8388990066', 30, 'Female', 'A-', 'pass16'),
(35, 'Varun Dhawan', 'varun.d@gmail.com', '8299001177', 22, 'Male', 'B+', 'pass17'),
(36, 'Ishita Dutta', 'ishita.d@gmail.com', '8100112288', 27, 'Female', 'AB-', 'pass18'),
(37, 'Hardik Pandya', 'hardik.p@gmail.com', '8011223300', 32, 'Male', 'O-', 'pass19'),
(38, 'Kiara Advani', 'kiara.a@gmail.com', '7922334411', 29, 'Female', 'B-', 'pass20'),
(39, 'Keshavi Mishra', 'keshavi@gmail.com', '9756783421', 43, 'Female', 'O-', '4500');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `hospital_name` varchar(150) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `units` int(11) NOT NULL,
  `status` enum('Pending','Accepted','Rejected','Completed') DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `patient_id`, `bank_id`, `hospital_name`, `doctor_name`, `blood_group`, `units`, `status`, `request_date`) VALUES
(1, 1, 6, 'Apollo Hospital', 'Mohuma Gupta', 'O+', 2, 'Completed', '2026-02-06 15:48:07'),
(2, 2, 1, 'Brahma Hospital', 'Satyam Ghosh', 'B+', 3, 'Completed', '2026-02-11 17:24:46'),
(3, 3, 1, 'Brahma Hospital', 'Sumit Mahato', 'B+', 2, 'Rejected', '2026-02-11 17:33:56'),
(4, 7, 9, 'KIMS Hospital', 'Pratyut Gupta', 'O-', 3, 'Rejected', '2026-03-23 18:51:34'),
(5, 7, 7, 'Brahma Hospital', 'Sushma Ghosh', 'B+', 1, 'Completed', '2026-03-23 19:05:40'),
(6, 8, 10, 'Apollo Hospital', 'Ishika Mahato', 'B+', 3, 'Completed', '2026-03-23 19:11:49'),
(7, 5, 10, 'Brahma Hospital', 'Mukesh Das', 'AB+', 2, 'Completed', '2026-03-23 19:22:23'),
(8, 4, 10, 'KIMS Hospital', 'Pratyut Gupta', 'B+', 2, 'Rejected', '2026-03-24 06:07:44'),
(9, 5, 10, 'Brahma Hospital', 'Pratyut Gupta', 'B-', 2, 'Rejected', '2026-03-24 06:29:18'),
(10, 9, 1, 'Odisha Blood Bank', 'Dr. Mishra', 'O+', 2, 'Pending', '2026-03-24 04:30:00'),
(11, 10, 6, 'KIMS blood bank', 'Dr. Patnaik', 'B+', 1, 'Pending', '2026-03-24 04:45:00'),
(12, 11, 7, 'Red Cross Centre', 'Dr. Ray', 'A+', 3, 'Accepted', '2026-03-24 05:00:00'),
(13, 12, 8, 'Apollo 24/7', 'Dr. Khan', 'O-', 2, 'Pending', '2026-03-24 05:15:00'),
(14, 13, 9, 'Indian Red Cross', 'Dr. Mohanty', 'AB+', 1, 'Completed', '2026-03-24 05:30:00'),
(15, 14, 10, 'Pradyumna Bal Hospital', 'Dr. Das', 'B-', 4, 'Pending', '2026-03-24 05:45:00'),
(16, 15, 1, 'Odisha Blood Bank', 'Dr. Mishra', 'O+', 2, 'Rejected', '2026-03-24 06:00:00'),
(17, 16, 6, 'KIMS blood bank', 'Dr. Patnaik', 'A-', 1, 'Pending', '2026-03-24 06:15:00'),
(18, 17, 10, 'Pradyumna Bal Hospital', 'Dr. Das', 'B+', 2, 'Accepted', '2026-03-24 06:30:00'),
(19, 18, 8, 'Apollo 24/7', 'Dr. Khan', 'AB-', 3, 'Pending', '2026-03-24 06:45:00'),
(20, 19, 1, 'Odisha Blood Bank', 'Dr. Sarangi', 'O+', 1, 'Pending', '2026-03-24 07:30:00'),
(21, 20, 6, 'KIMS blood bank', 'Dr. Mishra', 'A+', 2, 'Pending', '2026-03-24 07:35:00'),
(22, 21, 7, 'Red Cross Blood Centre', 'Dr. Panda', 'B-', 3, 'Accepted', '2026-03-24 07:40:00'),
(23, 22, 8, 'Apollo 24/7 Lab Test', 'Dr. Sethi', 'AB+', 1, 'Pending', '2026-03-24 07:45:00'),
(24, 23, 9, 'Indian Red Cross Society', 'Dr. Behera', 'O-', 2, 'Pending', '2026-03-24 07:50:00'),
(25, 24, 10, 'Pradyumna Bal Hospital', 'Dr. Rout', 'B+', 2, 'Completed', '2026-03-24 07:55:00'),
(26, 25, 1, 'Odisha Blood Bank', 'Dr. Sarangi', 'A-', 1, 'Pending', '2026-03-24 08:00:00'),
(27, 26, 6, 'KIMS blood bank', 'Dr. Mishra', 'AB-', 3, 'Rejected', '2026-03-24 08:05:00'),
(28, 27, 7, 'Red Cross Blood Centre', 'Dr. Panda', 'O+', 2, 'Pending', '2026-03-24 08:10:00'),
(29, 28, 8, 'Apollo 24/7 Lab Test', 'Dr. Sethi', 'B-', 1, 'Accepted', '2026-03-24 08:15:00'),
(30, 29, 9, 'Indian Red Cross Society', 'Dr. Behera', 'A+', 4, 'Pending', '2026-03-24 08:20:00'),
(31, 30, 10, 'Pradyumna Bal Hospital', 'Dr. Rout', 'O-', 1, 'Pending', '2026-03-24 08:25:00'),
(32, 31, 1, 'Odisha Blood Bank', 'Dr. Sarangi', 'B+', 2, 'Pending', '2026-03-24 08:30:00'),
(33, 32, 6, 'KIMS blood bank', 'Dr. Mishra', 'AB+', 1, 'Completed', '2026-03-24 08:35:00'),
(34, 33, 7, 'Red Cross Blood Centre', 'Dr. Panda', 'O+', 3, 'Pending', '2026-03-24 08:40:00'),
(35, 34, 8, 'Apollo 24/7 Lab Test', 'Dr. Sethi', 'A-', 2, 'Rejected', '2026-03-24 08:45:00'),
(36, 35, 9, 'Indian Red Cross Society', 'Dr. Behera', 'B+', 1, 'Pending', '2026-03-24 08:50:00'),
(37, 36, 10, 'Pradyumna Bal Hospital', 'Dr. Rout', 'AB-', 2, 'Pending', '2026-03-24 08:55:00'),
(38, 37, 1, 'Odisha Blood Bank', 'Dr. Sarangi', 'O-', 3, 'Accepted', '2026-03-24 09:00:00'),
(39, 38, 6, 'KIMS blood bank', 'Dr. Mishra', 'B-', 1, 'Pending', '2026-03-24 09:05:00'),
(40, 1, 8, 'Apollo Hospital', 'Ishika Mahato', 'O+', 3, 'Pending', '2026-03-24 07:42:03'),
(41, 1, 7, 'KIMS Hospital', 'Pratyut Gupta', 'O+', 2, 'Pending', '2026-03-24 07:47:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `bank_id` (`bank_id`);

--
-- Indexes for table `blood_banks`
--
ALTER TABLE `blood_banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `blood_stock`
--
ALTER TABLE `blood_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD UNIQUE KEY `bank_id` (`bank_id`,`blood_group`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `donor_id` (`donor_id`),
  ADD KEY `bank_id` (`bank_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `bank_id` (`bank_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `blood_banks`
--
ALTER TABLE `blood_banks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blood_stock`
--
ALTER TABLE `blood_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`bank_id`) REFERENCES `blood_banks` (`bank_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blood_stock`
--
ALTER TABLE `blood_stock`
  ADD CONSTRAINT `blood_stock_ibfk_1` FOREIGN KEY (`bank_id`) REFERENCES `blood_banks` (`bank_id`) ON DELETE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`donor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`bank_id`) REFERENCES `blood_banks` (`bank_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`bank_id`) REFERENCES `blood_banks` (`bank_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
