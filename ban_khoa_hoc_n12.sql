-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 04:03 PM
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
-- Database: `ban_khoa_hoc_n7`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `name_admin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL,
  `level` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email_admin`, `name_admin`, `password_admin`, `level`) VALUES
(6, 'nhom7@gmail.com', 'anhemnhom7', '202cb962ac59075b964b07152d234b70', 2);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` int(100) NOT NULL,
  `number_lessons` int(100) NOT NULL,
  `context` varchar(1000) NOT NULL,
  `request` varchar(1000) NOT NULL,
  `number_student` int(100) NOT NULL,
  `duration_course` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `image`, `price`, `number_lessons`, `context`, `request`, `number_student`, `duration_course`) VALUES
(1, 'PHP cơ bản', 'php.png', 200000, 6, 'PHP bản chất là một ngôn ngữ kịch bản (script) thường dùng để phát triển các ứng dụng Web, tuy vậy nó vẫn được sử dụng như một ngôn ngữ lập trình hoàn chỉnh. Đầu tiên PHP được tạo ra bởi Rasmus Lerdorf năm 1994, giờ nó được phát triển bởi PHP Group (gồm nhiều cá nhân và tổ chức - xem tại: credits php). PHP với nghĩa ban đầu là Personal Home Page (Trang chủ cá nhân), nhưng giờ nó mang nghĩa là Hypertext Preprocessor (Bộ tiền xử lý cho siêu văn bản).', 'Có kiến thức cơ bản về HTML JS CSS', 0, 0),
(2, 'CSS zero to hero', 'CSS.png', 999999, 7, 'CSS (Cascading Style Sheets) là ngôn ngữ biểu định kiểu, tức là định dạng và trang trí cho trang web như điều chỉnh màu sắc, font chữ, khoảng cách, bố cục, hiệu ứng hình ảnh,… CSS giúp trang web trở nên đẹp mắt và thu hút hơn với người dùng.\r\n\r\nTrong lập trình web, CSS có thể được chèn vào HTML theo 3 cách CSS nội tuyến (Inline CSS), CSS nội bộ (Internal CSS) và CSS bên ngoài (External CSS). Mỗi cách thêm CSS được thực hiện khác nhau nhưng đều đảm bảo thực hiện các vai trò: Định dạng và trình bày trang web, tăng khả năng truy cập của website.', 'Đam mê, chăm chỉ cày cuốc', 0, 0),
(3, 'JavaScript cơ bản', 'jscoban.jpg', 399000, 9, 'Biến và kiểu dữ liệu: Sử dụng các kiểu dữ liệu như string, number, boolean, array, object, v.v.\r\nCâu lệnh điều kiện: Sử dụng if, else, switch để xử lý điều kiện.\r\nVòng lặp: Làm quen với các vòng lặp như for, while, và do-while.\r\nHàm: Xây dựng và gọi hàm, hiểu về tham số và giá trị trả về.\r\nMảng và đối tượng: Làm việc với các cấu trúc dữ liệu như mảng và đối tượng trong JavaScript.', ' - Kiến thức cơ bản về lập trình\r\n- Cấu trúc lập trình cơ bản: Người học cần có nền tảng về các khái niệm cơ bản như biến, kiểu dữ liệu, vòng lặp, điều kiện, và hàm.\r\n- Lý thuyết về thuật toán: Một số hiểu biết về cách xây dựng và tối ưu hóa các thuật toán cơ bản.\r\n- Kiến thức về HTML và CSS', 0, 0),
(4, 'C++ cơ bản', 'ngon-ngu-lap-trinh-c++-CareerBuilder-1.jpg', 599000, 9, '- Cấu trúc dữ liệu trong C++\r\n- Mảng (Arrays): Cách khai báo và sử dụng mảng một chiều và mảng đa chiều.\r\n- Chuỗi (Strings): Làm việc với chuỗi trong C++ (chuỗi ký tự string).\r\n- Cấu trúc (Structures): Cách định nghĩa và sử dụng cấu trúc dữ liệu với struct trong C++.\r\n- Liên kết (Linked Lists): Làm quen với cấu trúc dữ liệu danh sách liên kết (linked list).\r\n- Con trỏ (Pointers): Hiểu về con trỏ, cách sử dụng con trỏ trong C++, và quản lý bộ nhớ. \r\n\r\n-Khái niệm OOP: Hiểu các nguyên lý cơ bản của lập trình hướng đối tượng, bao gồm Encapsulation (đóng gói), Inheritance (kế thừa), Polymorphism (đa hình), và Abstraction (trừu tượng).\r\n- Lớp và đối tượng (Classes and Objects): Cách định nghĩa lớp, tạo đối tượng, và sử dụng các thành phần như thuộc tính và phương thức.\r\n- Kế thừa (Inheritance): Cách kế thừa các thuộc tính và phương thức từ lớp cha trong các lớp con.\r\n- Đa hình (Polymorphism): Cách sử dụng đa hình trong C++ với các phương thức ảo (virtual) và hàm ảo thuần túy (pure virtual fu', 'Kiến thức cơ bản về lập trình,Tư duy thuật toán', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_cart`
--

CREATE TABLE `course_cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `course_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_videos`
--

CREATE TABLE `course_videos` (
  `id` int(100) NOT NULL,
  `course_id` int(100) NOT NULL,
  `video` varchar(500) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text DEFAULT NULL,
  `duration` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_videos`
--

INSERT INTO `course_videos` (`id`, `course_id`, `video`, `title`, `description`, `duration`) VALUES
(78, 2, 'css vai tro.mp4', 'Vai trò CSS', NULL, '5:43'),
(79, 1, 'B1.mp4', 'Bài 1. Cài đặt Xampp', 'cai dat xamppp', '9:53'),
(80, 1, 'B2.mp4', 'Bài 2. Cú pháp PHP', NULL, '13:37'),
(81, 1, 'B3.mp4', 'Bài 3. Bình luận trong PHP', NULL, '5:46'),
(82, 1, 'B4.mp4', 'Bài 4. Chèn HTML vào PHP', NULL, '2:51'),
(83, 1, 'B5.mp4', 'Bài 5: Hằng trong PHP', NULL, '5:12'),
(84, 1, 'B6.mp4', 'Bài 6.  \' \'  và  \" \"', NULL, '3:03'),
(85, 3, 'Khai báo biến .mp4', 'Bài 1: Khai báo biến trong JavaScript', 'Khai báo biến trong JavaScript một cách tự nhiên', '4:06'),
(86, 3, 'Sử dụng Comments trong JavaScript .mp4', 'Bài 2: sử dụng comment trong JavaScript', NULL, '5:36'),
(87, 3, 'Một số hàm built-in trong JavaScript .mp4', 'Bài 3: Một số hàm built-in trong JavaScript', NULL, '7:47'),
(88, 3, 'Làm quen với toán tử trong JavaScript .mp4', 'Bài 4: Toán tử trong JavaScript', NULL, '5:23'),
(89, 3, 'Toán tử số học trong JavaScript .mp4', 'Bài 5: Toán tử số học', NULL, '5:33'),
(90, 3, 'Toán tử ++  -- với tiền tố & hậu tố (Prefix & Postfix) trong JavaScript.mp4', 'Bài 6: Toán tử tiền tố - hậu tố', NULL, '11:45'),
(91, 3, 'Toán tử gán trong JavaScript .mp4', 'Bài 7: Toán tử gán', NULL, '5:25'),
(92, 3, 'Toán tử so sánh trong Javascript (phần 1).mp4', 'Bài 8: Toán tử so sánh ', NULL, '4:26'),
(93, 3, 'Câu lệnh điều kiện If - Else trong JavaScript.mp4', 'Bài 9: Câu lệnh điều kiện if-else', NULL, '6:29'),
(95, 2, 'ID và Class trong CSS selectors.mp4', 'Id và Class ', NULL, '4:17'),
(96, 2, 'Mức độ ưu tiên trong CSS.mp4', 'Độ ưu tiên trong Css', NULL, '10:31'),
(97, 2, 'Thuộc tính Padding trong CSS .mp4', 'Thuộc tính Padding', NULL, '6:20'),
(98, 2, 'Thuộc tính Border trong CSS .mp4', 'Thuộc tính Border', NULL, '6:06'),
(99, 2, 'Thuộc tính Margin trong CSS .mp4', 'Thuộc tính margin', NULL, '5:30'),
(100, 4, '2. Cài đặt công cụ viết code - Dev C++ .mp4', 'Bài 1: Cài đặt công cụ học tập', 'Cài đặt công cụ lập trình alo alo', '2:31'),
(101, 4, '3. Làm quen với công cụ Dev-C++ .mp4', 'Bài 2: Làm quen với công cụ Dev C++', NULL, '3:33'),
(102, 4, '4. Khái niệm biến_ .mp4', 'Bài 3: Khái niệm biến trong C++', NULL, '7:34'),
(103, 4, '5. Kiểu dữ liệu thường gặp trong C++.mp4', 'Bài 4: Các kiểu dữ liệu thường gặp', NULL, '5:43'),
(104, 4, '6. Biến cục bộ và biến toàn cục trong C++.mp4', 'Bài 5: Biến cục bộ và biến toàn cục', NULL, '6:41'),
(105, 4, '7. Hằng số trong C++ .mp4', 'Bài 6: Hằng số trong C++', NULL, '3:37'),
(106, 4, '10. Ép kiểu dữ liệu và bảng mã ASCII trong C++.mp4', 'Bài 7:  Ép kiểu dữ liệu và bảng mã ASCII trong C++', NULL, '8:52'),
(107, 4, '12. Cấu trúc if else .mp4', 'Bài 8: Cấu trúc if - else', NULL, '9:22'),
(108, 4, '14. Toán tử 3 ngôi trong C++.mp4', 'Bài 9: Toán tử 3 ngôi trong C++', NULL, '5:32');

-- --------------------------------------------------------

--
-- Table structure for table `learning_progress`
--

CREATE TABLE `learning_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `last_watched_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `watch_duration` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(33, 'nhom7', 'nhom7@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE `user_course` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `course_id` int(100) NOT NULL,
  `payment_state` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`id`, `user_id`, `course_id`, `payment_state`) VALUES
(23, 25, 2, 'Xong'),
(24, 26, 2, 'Xong'),
(26, 26, 1, 'Xong'),
(27, 26, 3, 'Xong'),
(48, 33, 3, 'Xong'),
(49, 33, 3, ''),
(50, 33, 4, ''),
(51, 33, 4, ''),
(52, 33, 2, 'Xong');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_cart`
--
ALTER TABLE `course_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_videos`
--
ALTER TABLE `course_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `learning_progress`
--
ALTER TABLE `learning_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_learning_user` (`user_id`),
  ADD KEY `fk_learning_course` (`course_id`),
  ADD KEY `fk_learning_video` (`video_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_course`
--
ALTER TABLE `user_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_cart`
--
ALTER TABLE `course_cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `course_videos`
--
ALTER TABLE `course_videos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `learning_progress`
--
ALTER TABLE `learning_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_course`
--
ALTER TABLE `user_course`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_cart`
--
ALTER TABLE `course_cart`
  ADD CONSTRAINT `course_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_cart_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `learning_progress`
--
ALTER TABLE `learning_progress`
  ADD CONSTRAINT `fk_learning_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_learning_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_learning_video` FOREIGN KEY (`video_id`) REFERENCES `course_videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
