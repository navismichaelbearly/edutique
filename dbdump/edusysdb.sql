-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2022 at 02:28 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edusysdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `edu_activity`
--

CREATE TABLE `edu_activity` (
  `activity_id` int(11) NOT NULL,
  `activity_title` varchar(255) NOT NULL,
  `mag_id` int(11) NOT NULL,
  `activity_type_id` int(11) NOT NULL,
  `activity_published_date` datetime NOT NULL,
  `activity_status` varchar(55) NOT NULL,
  `article_id` int(11) NOT NULL,
  `activity_path` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `activity_content` text DEFAULT NULL,
  `activity_style` text DEFAULT NULL,
  `audio_path` text DEFAULT NULL,
  `quick_tips` text DEFAULT NULL,
  `activity_html` text DEFAULT NULL,
  `activity_result` text DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `topic_words` varchar(255) DEFAULT NULL,
  `fiction` varchar(255) DEFAULT NULL,
  `difficulty_level` varchar(255) DEFAULT NULL,
  `word_count` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `issue_no` varchar(255) DEFAULT NULL,
  `audio_support` text DEFAULT NULL,
  `act_year` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_activity`
--

INSERT INTO `edu_activity` (`activity_id`, `activity_title`, `mag_id`, `activity_type_id`, `activity_published_date`, `activity_status`, `article_id`, `activity_path`, `image_path`, `activity_content`, `activity_style`, `audio_path`, `quick_tips`, `activity_html`, `activity_result`, `theme`, `topic_words`, `fiction`, `difficulty_level`, `word_count`, `author`, `issue_no`, `audio_support`, `act_year`) VALUES
(102, 'dvf', 5, 7, '2022-09-14 18:45:29', 'Active', 0, '', 'magazine/iThink/1/1_Page_04.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;fd</span>', '', '', 'test', '<form id=\"situationalwriteId\" method=\"post\"><br /><br /><div class=\"row\"><div class=\"col-lg-12\"><div class=\"form-group\"><textarea id=\"situationalWrite\" name=\"situationalWrite\" rows=\"30\"   placeholder=\"Type your response here.\" class=\"form-control\" style=\"width:100%\" ></textarea></div><div class=\"form-group\"></div></div></div><input type=\"submit\" value=\"Submit\" class=\"btn btn-default btn-xs\" style=\"margin-right:15px; margin-bottom:10px; padding:5px 20px; \"></form>', '&lt;form id=&quot;situationalwriteId&quot; method=&quot;post&quot;&gt;&lt;br /&gt;&lt;br /&gt;&lt;div class=&quot;row&quot;&gt;&lt;div class=&quot;col-lg-12&quot;&gt;&lt;div class=&quot;form-group&quot;&gt;&lt;textarea id=&quot;situationalWrite&quot; name=&quot;situationalWrite&quot; rows=&quot;30&quot;   placeholder=&quot;Type your response here.&quot; class=&quot;form-control&quot; style=&quot;width:100%&quot; &gt;&lt;/textarea&gt;&lt;/div&gt;&lt;div class=&quot;form-group&quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;input type=&quot;submit&quot; value=&quot;Submit&quot; class=&quot;btn btn-default btn-xs&quot; style=&quot;margin-right:15px; margin-bottom:10px; padding:5px 20px; &quot;&gt;&lt;/form&gt;', 'fdg11hhhr', NULL, NULL, 'Lower Elementary', NULL, 'fg', 'iThink 1', 'Yes', '2022-09-14 00:00:00'),
(103, 'nb', 5, 7, '2022-09-14 19:21:49', 'Active', 2, '', 'magazine/iThink/1/art-camping_equipment.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;fc</span>', '', '', 'test', '<form id=\"situationalwriteId\" method=\"post\"><br /><br /><div class=\"row\"><div class=\"col-lg-12\"><div class=\"form-group\"><textarea id=\"situationalWrite\" name=\"situationalWrite\" rows=\"30\"   placeholder=\"Type your response here.\" class=\"form-control\" style=\"width:100%\" ></textarea></div><div class=\"form-group\"></div></div></div><input type=\"submit\" value=\"Submit\" class=\"btn btn-default btn-xs\" style=\"margin-right:15px; margin-bottom:10px; padding:5px 20px; \"></form>', '[]', 'fdg', NULL, NULL, 'Lower Elementary', NULL, 'fdg', 'iThink 1', 'Yes', '2022-09-14 00:00:00'),
(104, 'fg99999', 5, 7, '2022-09-14 19:37:39', 'Active', 3, '', 'magazine/iThink/1/1_Page_04.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;fgff</span>', '', '', 'test', '<form id=\"situationalwriteId\" method=\"post\"><br /><br /><div class=\"row\"><div class=\"col-lg-12\"><div class=\"form-group\"><textarea id=\"situationalWrite\" name=\"situationalWrite\" rows=\"30\"   placeholder=\"Type your response here.\" class=\"form-control\" style=\"width:100%\" ></textarea></div><div class=\"form-group\"></div></div></div><input type=\"submit\" value=\"Submit\" class=\"btn btn-default btn-xs\" style=\"margin-right:15px; margin-bottom:10px; padding:5px 20px; \"></form>', '[]', 'gfh', NULL, NULL, 'Lower Elementary', NULL, 'f', 'iThink 1', 'Select', '2022-09-14 00:00:00'),
(105, 'kkkk8888', 5, 7, '2022-09-14 19:39:25', 'Active', 1, '', 'magazine/iThink/1/ggg.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;gf</span>', '', '', 'test', '<form id=\"situationalwriteId\" method=\"post\"><br /><br /><div class=\"row\"><div class=\"col-lg-12\"><div class=\"form-group\"><textarea id=\"situationalWrite\" name=\"situationalWrite\" rows=\"30\"   placeholder=\"Type your response here.\" class=\"form-control\" style=\"width:100%\" ></textarea></div><div class=\"form-group\"></div></div></div><input type=\"submit\" value=\"Submit\" class=\"btn btn-default btn-xs\" style=\"margin-right:15px; margin-bottom:10px; padding:5px 20px; \"></form>', '[]', 'f', NULL, NULL, 'Lower Elementary', NULL, 'gf', 'iThink 1', 'Select', '2022-09-22 00:00:00'),
(106, 'test 1111', 5, 7, '2022-09-15 18:57:46', 'Active', 0, '', 'magazine/iThink/1/art-camping_equipment.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;</span><span style=\"color:#2a2e2e; font-family:Georgia,Times,serif; font-size:15px\">It a shame that official documentation and many posts lack description of such a basic operations such as getting data from specific row/column from file. All of them stop at getting $excelObj and $activeSheet. It would be more helpful to show up how we can get actual data from row, column, cell, search through data etc.<br /><br />It a shame that official documentation and many posts lack description of such a basic operations such as getting data from specific row/column from file. All of them stop at getting $excelObj and $activeSheet. It would be more helpful to show up how we can get actual data from row, column, cell, search through data etc.<br />It a shame that official documentation and many posts lack description of such a basic operations such as getting data from specific row/column from file. All of them stop at getting $excelObj and $activeSheet. It would be more helpful to show up how we can get actual data from row, column, cell, search through data etc.<br /><br />It a shame that official documentation and many posts lack description of such a basic operations such as getting data from specific row/column from file. All of them stop at getting $excelObj and $activeSheet. It would be more helpful to show up how we can get actual data from row, column, cell, search through data etc.</span>', '', '', 'test', '<form id=\"situationalwriteId\" method=\"post\"><br /><br /><div class=\"row\"><div class=\"col-lg-12\"><div class=\"form-group\"><textarea id=\"situationalWrite\" name=\"situationalWrite\" rows=\"30\"   placeholder=\"Type your response here.\" class=\"form-control\" style=\"width:100%\" ></textarea></div><div class=\"form-group\"></div></div></div><input type=\"submit\" value=\"Submit\" class=\"btn btn-default btn-xs\" style=\"margin-right:15px; margin-bottom:10px; padding:5px 20px; \"></form>', '[\"\",\"\"]', 'fd', NULL, NULL, 'Lower Elementary', NULL, 'fg', 'iThink 1', 'Yes', '2022-09-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `edu_activity_audio`
--

CREATE TABLE `edu_activity_audio` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_activity_audio`
--

INSERT INTO `edu_activity_audio` (`id`, `path`, `activity_id`) VALUES
(75, 'magazine/iThink/1/sample-6s.mp3', 102),
(76, 'magazine/iThink/1/sample-new.mp3', 102),
(77, 'magazine/iThink/1/art2.mp3', 103),
(78, 'magazine/iThink/1/12.mp3', 106);

-- --------------------------------------------------------

--
-- Table structure for table `edu_activity_audio_dummy`
--

CREATE TABLE `edu_activity_audio_dummy` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_activity_dummy`
--

CREATE TABLE `edu_activity_dummy` (
  `activity_id` int(11) NOT NULL,
  `activity_title` varchar(255) NOT NULL,
  `mag_id` int(11) NOT NULL,
  `activity_type_id` int(11) NOT NULL,
  `activity_published_date` datetime NOT NULL,
  `activity_status` varchar(55) NOT NULL,
  `article_id` int(11) NOT NULL,
  `activity_path` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `activity_content` text DEFAULT NULL,
  `activity_style` text DEFAULT NULL,
  `audio_path` text DEFAULT NULL,
  `quick_tips` text DEFAULT NULL,
  `activity_html` text DEFAULT NULL,
  `activity_result` text DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `topic_words` varchar(255) DEFAULT NULL,
  `fiction` varchar(255) DEFAULT NULL,
  `difficulty_level` varchar(255) DEFAULT NULL,
  `word_count` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `issue_no` varchar(255) DEFAULT NULL,
  `audio_support` text DEFAULT NULL,
  `act_year` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_activity_dummy`
--

INSERT INTO `edu_activity_dummy` (`activity_id`, `activity_title`, `mag_id`, `activity_type_id`, `activity_published_date`, `activity_status`, `article_id`, `activity_path`, `image_path`, `activity_content`, `activity_style`, `audio_path`, `quick_tips`, `activity_html`, `activity_result`, `theme`, `topic_words`, `fiction`, `difficulty_level`, `word_count`, `author`, `issue_no`, `audio_support`, `act_year`) VALUES
(66, 'hh', 5, 7, '2022-09-14 19:22:39', 'Active', 4, '', 'magazine/iThink/1/identity.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;cv</span>', '', '', 'test', '<form id=\"situationalwriteId\" method=\"post\"><br /><br /><div class=\"row\"><div class=\"col-lg-12\"><div class=\"form-group\"><textarea id=\"situationalWrite\" name=\"situationalWrite\" rows=\"30\"   placeholder=\"Type your response here.\" class=\"form-control\" style=\"width:100%\" ></textarea></div><div class=\"form-group\"></div></div></div><input type=\"submit\" value=\"Submit\" class=\"btn btn-default btn-xs\" style=\"margin-right:15px; margin-bottom:10px; padding:5px 20px; \"></form>', '[]', 'fgf', NULL, NULL, 'Lower Elementary', NULL, 'gh', 'iThink 1', 'Select', '2022-09-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `edu_activity_result`
--

CREATE TABLE `edu_activity_result` (
  `activity_result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `activity_id` int(11) NOT NULL DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `correct` int(11) DEFAULT 0,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_activity_result`
--

INSERT INTO `edu_activity_result` (`activity_result_id`, `user_id`, `activity_id`, `total`, `correct`, `answer`) VALUES
(29, 632, 78, 30, 0, 'dfd dfbdffdnbf bbr'),
(30, 664, 106, 30, 30, 'It a shame that official documentation and many posts lack description of such a basic operations such as getting data from specific row/column from file. All of them stop at getting $excelObj and $activeSheet. It would be more helpful to show up how we can get actual data from row, column, cell, search through data etc.\r\n\r\nIt a shame that official documentation and many posts lack description of such a basic operations such as getting data from specific row/column from file. All of them stop at getting $excelObj and $activeSheet. It would be more helpful to show up how we can get actual data from row, column, cell, search through data etc.');

-- --------------------------------------------------------

--
-- Table structure for table `edu_activity_type`
--

CREATE TABLE `edu_activity_type` (
  `activity_type_id` int(11) NOT NULL,
  `activity_type` varchar(255) NOT NULL,
  `activity_type_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_activity_type`
--

INSERT INTO `edu_activity_type` (`activity_type_id`, `activity_type`, `activity_type_status`) VALUES
(1, 'Listening Comprehension', 'Active'),
(2, 'Oral', 'Active'),
(3, 'Reading Comprehension', 'Active'),
(4, 'Summary', 'Active'),
(5, 'Language Editing', 'Active'),
(6, 'Continuous Writing', 'Active'),
(7, 'Situational Writing', 'Active'),
(8, 'Language Games', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `edu_aid`
--

CREATE TABLE `edu_aid` (
  `id` int(11) NOT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `art_id` int(11) NOT NULL,
  `act_id` int(11) DEFAULT NULL,
  `content_aid_title` varchar(255) DEFAULT NULL,
  `supplementary_aid` varchar(255) DEFAULT NULL,
  `uploadded_date` datetime NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `content_aid_file_path` varchar(255) DEFAULT NULL,
  `status` varchar(55) DEFAULT NULL,
  `embedvideo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_aid`
--

INSERT INTO `edu_aid` (`id`, `mag_id`, `art_id`, `act_id`, `content_aid_title`, `supplementary_aid`, `uploadded_date`, `uploaded_by`, `content_aid_file_path`, `status`, `embedvideo`) VALUES
(12, 5, 4, 0, 'ttet', '', '2022-07-14 20:08:27', 207, 'contentaid/1_Page_04.jpg', 'Active', ''),
(15, 5, 4, 0, 'New excel', '', '2022-07-15 17:54:50', 207, 'contentaid/Copy of userUpload.xlsx', 'Active', ''),
(16, 5, 4, 0, 'New audio', '', '2022-07-15 17:55:57', 207, 'contentaid/abc.mp3', 'Active', ''),
(17, 5, 4, 0, 'New video', '', '2022-07-15 18:21:21', 207, 'contentaid/Piper.mp4', 'Active', ''),
(18, 5, 4, 0, 'Educational Video', '', '2022-07-15 19:15:01', 207, '', 'Active', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/kCHeKc2R96o\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `edu_annotation_bookmark`
--

CREATE TABLE `edu_annotation_bookmark` (
  `id` int(11) NOT NULL,
  `bookmark` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `anno_by` int(11) DEFAULT NULL,
  `published_date` datetime DEFAULT NULL,
  `art_id` int(11) DEFAULT NULL,
  `act_id` int(11) DEFAULT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `bookmark_type` int(11) DEFAULT NULL,
  `foldnameid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_annotation_bookmark`
--

INSERT INTO `edu_annotation_bookmark` (`id`, `bookmark`, `status`, `anno_by`, `published_date`, `art_id`, `act_id`, `mag_id`, `bookmark_type`, `foldnameid`) VALUES
(85, 1, 'Active', 1, '2022-08-10 21:53:44', 1, 0, 5, 17, 45),
(86, 1, 'Active', 626, '2022-08-10 21:55:58', 2, 0, 5, 18, 46);

-- --------------------------------------------------------

--
-- Table structure for table `edu_annotation_comments`
--

CREATE TABLE `edu_annotation_comments` (
  `id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `anno_by` int(11) DEFAULT NULL,
  `published_date` datetime DEFAULT NULL,
  `art_id` int(11) DEFAULT NULL,
  `act_id` int(11) DEFAULT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `highlighted_text` text DEFAULT NULL,
  `style` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_annotation_comments`
--

INSERT INTO `edu_annotation_comments` (`id`, `comments`, `status`, `anno_by`, `published_date`, `art_id`, `act_id`, `mag_id`, `highlighted_text`, `style`) VALUES
(149, 'test', 'Active', 1, '2022-07-01 10:00:29', 65, 0, 49, 'ut what it would be like to experienc', '645.8333129882812'),
(150, 'cxdc', 'Active', 1, '2022-08-25 18:14:45', 27, 0, 17, 'star quality to even the most', '603.0999908447266'),
(151, 'ffffff', 'Active', 1, '2022-08-25 18:15:01', 27, 0, 17, 'I wonder, can I make him cry at last?', '717.0999908447266'),
(152, 'bbbbb', 'Active', 1, '2022-08-25 18:15:16', 27, 0, 17, 'rants, do you', '603.0999908447266'),
(153, 'dfdg', 'Active', 1, '2022-08-25 18:15:38', 27, 0, 17, 'rhetorical questions.', '603.0999908447266'),
(154, 'sfds', 'Active', 1, '2022-08-25 18:19:22', 27, 0, 17, 'would make a perfect', '622.0999908447266'),
(155, 'dgfd', 'Active', 1, '2022-08-25 18:19:32', 27, 0, 17, 'prophecy by givin', '774.0999908447266'),
(156, 'fdgd', 'Active', 1, '2022-08-25 18:19:42', 27, 0, 17, 'lmost-famous mous', '964.0999908447266'),
(157, 'gdgd', 'Active', 632, '2022-08-29 01:26:04', 4, 66, 5, 'volunteers', '136.3000030517578'),
(158, 'ewrew', 'Active', 632, '2022-08-29 19:41:35', 2, 0, 5, 't’s a great responsibility', '583.7333526611328'),
(159, 'dfds', 'Active', 632, '2022-08-29 19:41:46', 2, 0, 5, 'but all professions', '583.7333221435547'),
(160, 'fgd', 'Active', 632, '2022-08-29 19:43:20', 2, 0, 5, 'I hope ', '704.8333435058594'),
(161, 'fbd', 'Active', 632, '2022-08-29 19:43:31', 2, 0, 5, 'fashion accessories', '704.8333435058594'),
(162, 'hgfdh', 'Active', 632, '2022-08-29 19:43:44', 2, 0, 5, 'My father supports', '917.0333099365234'),
(163, 'dfgdf', 'Active', 632, '2022-08-29 19:43:52', 2, 0, 5, 'holding two', '917.0333557128906'),
(164, 'fdgd', 'Active', 632, '2022-08-29 19:53:51', 2, 0, 5, 'My dream is ', '1098.8666534423828'),
(165, 'gggf', 'Active', 632, '2022-08-29 19:54:03', 2, 0, 5, 'music artiste', '1098.8666534423828'),
(166, 'cvxcv', 'Active', 632, '2022-08-29 19:54:12', 2, 0, 5, 'music is loved ', '1098.8666534423828'),
(167, 'ghhf', 'Active', 632, '2022-08-29 19:55:14', 3, 0, 5, ' I still wouldn’t! ', '532.9999847412109'),
(168, 'gkjgk', 'Active', 632, '2022-08-29 19:55:22', 3, 0, 5, 'boring or unfashionable,', '532.9999847412109'),
(169, 'fhfhf', 'Active', 632, '2022-08-29 19:55:30', 3, 0, 5, 'oils down to ho', '533.0000152587891'),
(170, 'mounika1', 'Active', 632, '2022-08-29 19:56:34', 3, 0, 5, 'can ca', '533'),
(171, 'gjhgj', 'Active', 1, '2022-08-29 19:58:37', 3, 0, 5, 'I still wouldn’t! You', '469.97503662109375'),
(172, 'hhhhh', 'Active', 1, '2022-08-29 19:58:45', 3, 0, 5, 'call me boring', '469.9750061035156'),
(173, 'dsfds', 'Active', 1, '2022-08-29 20:04:44', 15, 0, 6, 'The highest score', '316.4375'),
(174, 'dfsdf', 'Active', 1, '2022-08-29 20:04:49', 15, 0, 6, 'soccer game', '316.4375'),
(175, 'fef', 'Active', 1, '2022-08-29 20:04:55', 15, 0, 6, 'A shocking', '316.4375'),
(176, 'fdsf', 'Active', 1, '2022-08-29 20:05:00', 15, 0, 6, 'his was because ', '316.4375'),
(177, 'sdfsd', 'Active', 1, '2022-08-29 20:05:06', 15, 0, 6, 'fter the ', '438.8374938964844'),
(178, 'sfsdf', 'Active', 1, '2022-08-29 20:05:11', 15, 0, 6, 'Colombian', '438.8374938964844'),
(179, 'dffd', 'Active', 1, '2022-08-29 20:05:17', 15, 0, 6, 'ed him and his', '438.8374938964844'),
(180, 'dfsdf', 'Active', 1, '2022-08-29 20:05:54', 2, 0, 5, 'engineer? ', '515.7999877929688'),
(181, 'dsfds', 'Active', 1, '2022-08-29 20:05:59', 2, 0, 5, 'came across', '515.8000030517578'),
(182, 'cxzv', 'Active', 1, '2022-08-29 20:09:07', 2, 0, 5, 'I hope to run ', '697.6333160400391'),
(183, 'cxvv', 'Active', 1, '2022-08-29 20:09:16', 2, 0, 5, 'fashion accessories', '697.6333160400391'),
(184, 'dsfsd', 'Active', 1, '2022-08-29 20:09:23', 2, 0, 5, 'someday. I', '697.6333312988281'),
(185, 'adasd dsfd', 'Active', 1, '2022-09-05 14:17:12', 20, 0, 6, 'My dad comes', '394.6999969482422'),
(186, 'ghgf fdbfg fdb', 'Active', 1, '2022-09-05 14:17:25', 20, 0, 6, 'school of thought', '394.6999969482422'),
(187, 'dds fdbd', 'Active', 1, '2022-09-05 14:17:36', 20, 0, 6, 'activity that does', '394.6999969482422'),
(188, 'fhfgh fdbdf dfbfd', 'Active', 1, '2022-09-05 14:17:48', 20, 0, 6, 'book, a pen', '394.6999969482422'),
(189, 'ghfg', 'Active', 1, '2022-09-05 14:18:01', 20, 0, 6, 'lashing out session,', '485.4333190917969'),
(190, 'hjgh fgn', 'Active', 1, '2022-09-05 14:18:16', 20, 0, 6, 'and looked at Dad’s face', '485.4333190917969'),
(191, 'hfh', 'Active', 1, '2022-09-05 14:18:31', 20, 0, 6, 'about not wasting your time this year', '576.1666564941406'),
(192, 'fbfdbd', 'Active', 1, '2022-09-05 14:18:45', 20, 0, 6, 'is year determine which', '576.1666412353516'),
(193, 'fgd', 'Active', 631, '2022-09-08 02:06:17', 1, 0, 5, 'fashionista, gives', ''),
(197, 'hhh', 'Active', 1, '2022-09-09 01:53:13', 4, 78, 5, 'Foundation', '224.09999084472656'),
(198, 'cvfd', 'Active', 1, '2022-09-09 01:56:05', 3, 0, 5, 'twice about wanting', '722.3666687011719'),
(199, 'test', 'Active', 1, '2022-09-09 02:02:07', 1, 0, 5, 'Choose the correct size for your body', '824.2332916259766');

-- --------------------------------------------------------

--
-- Table structure for table `edu_annotation_sticky`
--

CREATE TABLE `edu_annotation_sticky` (
  `id` int(11) NOT NULL,
  `sticky` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `anno_by` int(11) DEFAULT NULL,
  `published_date` datetime DEFAULT NULL,
  `art_id` int(11) DEFAULT NULL,
  `act_id` int(11) DEFAULT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `sticky_color` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_annotation_sticky`
--

INSERT INTO `edu_annotation_sticky` (`id`, `sticky`, `status`, `anno_by`, `published_date`, `art_id`, `act_id`, `mag_id`, `sticky_color`) VALUES
(48, 'vvn', 'Active', 1, '2022-09-09 01:53:29', 4, 78, 5, '#fec470'),
(49, 'testing', 'Active', 1, '2022-09-09 02:03:02', 1, 0, 5, '#ffafa4');

-- --------------------------------------------------------

--
-- Table structure for table `edu_annotation_text_highlight`
--

CREATE TABLE `edu_annotation_text_highlight` (
  `id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `anno_by` int(11) DEFAULT NULL,
  `published_date` datetime DEFAULT NULL,
  `art_id` int(11) DEFAULT NULL,
  `act_id` int(11) DEFAULT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `highlighted_text` text DEFAULT NULL,
  `highlight_color` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_annotation_text_highlight`
--

INSERT INTO `edu_annotation_text_highlight` (`id`, `status`, `anno_by`, `published_date`, `art_id`, `act_id`, `mag_id`, `highlighted_text`, `highlight_color`) VALUES
(73, 'Active', 632, '2022-08-29 01:25:51', 4, 66, 5, 'ikimedia Foundation.Wikipedia is a free online encyclopedia, created and edited by ', '#86e0a3'),
(74, 'Active', 631, '2022-09-08 02:07:20', 1, 0, 5, 't uncomfortable, it make', NULL),
(75, 'Active', 631, '2022-09-08 02:12:05', 1, 0, 5, 'ou appear bi', '#fec470'),
(91, 'Active', 1, '2022-09-09 01:59:36', 1, 0, 5, 'Not only is it uncomfortable', '#75d7f0'),
(92, 'Active', 1, '2022-09-09 02:00:35', 1, 0, 5, 'but does that outfit ', '#75d7f0'),
(93, 'Active', 1, '2022-09-09 02:00:49', 1, 0, 5, 'Clothing should', '#fec470'),
(94, 'Active', 1, '2022-09-09 02:03:15', 1, 0, 5, 'fashionista, gives you some', '#ffd866');

-- --------------------------------------------------------

--
-- Table structure for table `edu_article`
--

CREATE TABLE `edu_article` (
  `article_id` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_published_date` datetime NOT NULL,
  `mag_id` int(11) NOT NULL,
  `article_status` varchar(55) NOT NULL,
  `essay_type_id` int(11) NOT NULL,
  `article_path` varchar(255) DEFAULT NULL,
  `article_image` varchar(255) DEFAULT NULL,
  `article_content` text DEFAULT NULL,
  `article_style` text DEFAULT NULL,
  `audio_path` varchar(255) DEFAULT NULL,
  `art_year` datetime DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `topic_words` varchar(255) DEFAULT NULL,
  `audio_support` varchar(255) DEFAULT NULL,
  `fiction` varchar(255) DEFAULT NULL,
  `difficulty_level` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `word_count` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `test` datetime DEFAULT NULL,
  `reflection_ques` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_article`
--

INSERT INTO `edu_article` (`article_id`, `article_title`, `article_published_date`, `mag_id`, `article_status`, `essay_type_id`, `article_path`, `article_image`, `article_content`, `article_style`, `audio_path`, `art_year`, `theme`, `genre`, `topic_words`, `audio_support`, `fiction`, `difficulty_level`, `description`, `word_count`, `author`, `last_modified`, `test`, `reflection_ques`) VALUES
(1, 'Fit and Flair ', '2022-07-21 12:22:38', 5, 'Active', 17, '', 'magazine/iThink/1/1_Page_04.jpg', '<div style=\"line-height:30px\">\r\n<p style=\"text-align:justify\"><img alt=\"\" src=\"ckeditor/../uploads/fit n flair.jpg\" style=\"height:100%; width:100%\" /></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">You may love that outfit, but does that outfit love you? Do not be a slave to trends and fads. Clothing should suit your lifestyle needs as well as flatter your body shape. </span></span><br /><br /><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">JEREMY AU-YONG, our in-house fashionista, gives you some tips on how to sidestep the fashion faux pas. </span></span><br /><br /><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">1. Avoid clothing that is too tight. Not only is it uncomfortable, it makes you look like you are about to burst a seam. Not attractive! </span></span></span><br /><br /><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">2. Avoid clothing that is too loose. Contrary to popular belief, baggy clothes do not hide those extra pounds. Over-sized clothing tends to amplify the silhouette, making you appear bigger than you really are. </span></span></span><br /><br /><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">3. Choose the correct size for your body. When in the fitting room, check if the garment will allow a reasonable range of movement comfortably without feeling overly restrictive or riding up too much. You will look better and feel better in clothing that sits properly on your frame. </span></span></span><br /><br /><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">4. In general, give pieces that are too revealing a miss. They really do nothing for your look and you will not feel comfortable wearing them. </span></span></span><br /><br /><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">5. Be confident! Clothes should fit your body and flaunt your personality. Experiment with different styles, cuts and colours.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n</div>\r\n', '', '', '2014-02-01 00:00:00', 'Identity', NULL, 'Fashion', 'No', 'Non-Fiction', 'Lower Advanced', 'You may love that outfit, but does that outfit love you? Do not be a slave to trends and fads. Clothing should suit your lifestyle needs as well as flatter your body shape.', 207, 'Jeremy Au-Yong1', '2022-07-21 12:22:38', NULL, NULL),
(2, 'Of Ambitions and Aspirations', '2022-07-07 16:04:02', 5, 'Active', 3, '', 'magazine/iThink/1/1_Page_05.jpg', '<div style=\"line-height:30px\">\r\n<div style=\"height:30px\">\r\n<div style=\"line-height:30px\">\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\"><img alt=\"\" src=\"ckeditor/../uploads/of ambitions n aspirations.jpeg\" style=\"height:100%; width:100%\" /></span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">Five teenagers were asked about their hopes and aspirations and here is what they have to say to our reporter, Tis Saleha.</span></span></span><br />\r\n<br />\r\n<strong><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">ISABELLA, AGE 14 </span></span></strong><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Last year, during the school holidays, my mother took me with her on her voluntary work mission in Bintan. We helped the villagers build a school from scratch. It was hard work, but the satisfaction of having brought joy and hope to the villagers was unforgettable. I grew to appreciate more what I have in life. I hope to continue volunteering my help to the needy even when I have my own career.</span></span><br />\r\n<br />\r\n<strong><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">HONG SENG, AGE 16 </span></span></strong><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">I come from a family of teachers. So, no prizes for guessing my dream profession! Someone asked me &ndash; why not a doctor or engineer? Here&rsquo;s what I came across on the Internet while doing some research one day: A doctor&rsquo;s mistake can lead to the death of one patient, but a teacher&rsquo;s mistake can affect a whole generation&rsquo;s way of thinking. It&rsquo;s a great responsibility indeed, but all professions have their own hazards. I see challenges as motivations, so I will stick to living up to my dream!</span></span><br />\r\n<br />\r\n<strong><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">SALIMAH, AGE 17 </span></span></strong><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">I hope to run my own fashion accessories boutique online someday. I love making mobile phone accessories, squishies, and clay charms, and I thought, if many people can make money selling their creations, I want to pursue this line too. I&rsquo;ve watched how my cousin runs her online cake business from home and how it has given her confidence in her interactions with people. I learnt there will be setbacks, but that shouldn&rsquo;t upset you. Instead, you should see them as motivations to better your efforts.</span></span><br />\r\n<br />\r\n<strong><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">INDUPRIYA, AGE 19 </span></span></strong><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">My father supports my family by holding two jobs since he has little formal education. As such, my dream is to get a degree and a job that pays well so that I will lead a financially secure future. My parents&rsquo; sacrifices motivate me to pursue this dream. I believe, too, that if we face any setbacks, we shouldn&rsquo;t give up, but try, try again, until we achieve success. I hope to support my parents then, in their old age.</span></span><br />\r\n<br />\r\n<strong><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">HUGO RODRIGUES, AGE 13 </span></span></strong><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">My dream is to be a rap music artiste whose music is loved world&shy;wide. Sounds overly-ambitious? Let me share what famous billion&shy;aire Richard Branson once said: &ldquo;Believe in Yourself&rdquo;, &ldquo;Be Bold&rdquo; and &ldquo;Prepare Well&rdquo;. I watch how the popular rappers perform on the internet; I watch their concerts on DVD for tips on crafting the lyrics and delivering them. In the end, if it&rsquo;s successful, then it&rsquo;s successful. If not, then, at least, I would have followed my passion and seen it through.</span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n</div>\r\n</div>\r\n</div>\r\n', '', '', '2014-02-01 00:00:00', 'Identity', NULL, 'Aspirations', 'Yes', 'Non-Fiction', 'Lower Advanced', 'Five teenagers were asked about their hopes and aspirations and here is what they have to say to our reporter, Tis Saleha.\r\nFive teenagers were asked about their hopes and aspirations and here is what they have to say to our reporter, Tis Saleha.', 503, 'Tis Saleha', '2022-07-07 16:04:02', NULL, NULL),
(3, 'Pierce Me Not', '2022-07-08 12:56:56', 5, 'Active', 20, '', 'magazine/iThink/1/1_Page_08.jpg', '<div style=\"line-height:30px\">\r\n<div style=\"line-height:30px\">\r\n<p><strong><span style=\"font-size:16px\"><span style=\"font-family:Cambria,serif\"><img alt=\"\" src=\"ckeditor/../uploads/pierce me not.jpg\" style=\"height:100%; width:100%\" /></span></span></strong></p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"\" src=\"ckeditor/../uploads/They did it as rebellion.png\" style=\"float:left; height:40%; margin:10px; width:40%\" /></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><strong>INTERVIEWER</strong>: Have you considered body piercing, Joseph?</span></span><br />\r\n<br />\r\n<span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><strong>JOSEPH</strong>: Well, personally, I think it&rsquo;s a risky business. Sure, some may say it&rsquo;s a form of art, but they don&rsquo;t think of the dangers involved. I mean, what if something goes wrong and you are permanently deformed? Who is to be blamed then? I have a neighbour who tried tongue piercing and lost a lot of blood as a result. Luckily, he&rsquo;s not handicapped for life. Imagine, having your tongue mutilated because you were trying to impress your girlfriend! His parents were furious with him. They said it&rsquo;s an act of stupidity, not creativity, and I agree with them.</span></span><br />\r\n<br />\r\n<span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><strong>INTERVIEWER</strong>: So, would you still go for it if there were no risks at all?&nbsp;</span></span>&nbsp;<br />\r\n<br />\r\n<span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><strong>JOSEPH</strong>: No, I still wouldn&rsquo;t! You can call me boring or unfashionable, but it all boils down to how happy you are with yourself. I watched on YouTube once how body-piercing enthusiasts came about. They did it as a kind of rebellion against society and the authorities because they were unhappy with their way of life. But I don&rsquo;t think our people here get their lips or nipples pierced because they are rebelling against our government! [laughs with Interviewer]</span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><strong>INTERVIEWER</strong>: For sure, they&#39;ll think twice about wanting to be seen as political rebels! Thank you. Joseph, for sharing your thoughts.<br />\r\n&nbsp;</span></span><img alt=\"\" src=\"ckeditor/../uploads/Ugly Gaps.png\" style=\"float:right; height:30%; margin:10px; width:30%\" /><br />\r\n<span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><strong>JOSEPH</strong>: You&rsquo;re welcome.</span></span><br />\r\n<br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Do you think&nbsp;body piercing is a manifestation of teenage rebellion or simply an innocuous act of curiosity?</strong></span></span></p>\r\n</div>\r\n</div>\r\n', '', '', '2014-02-01 00:00:00', 'Identity', NULL, 'Body Piercing ', 'No', 'Non-Fiction', 'Lower Advanced', 'Here is an excerpt of Tis SalehaÃ¢â‚¬â„¢s interview with 18-year-old Joseph Lim, a polytechnic student, on the subject of why he refused to get body piercings done on him...', 363, 'Tis Saleha', '2022-07-08 12:56:56', NULL, 'Why you be keen to join a reality show on survival? why, or why not?'),
(4, 'Ink to Flesh', '2022-09-06 18:45:30', 5, 'Active', 3, '', 'magazine/iThink/1/1_Page_10.jpg', '<div style=\"line-height:30px\">\r\n<div style=\"line-height:30px\">\r\n<p style=\"text-align:justify\"><img alt=\"\" src=\"ckeditor/../uploads/2222 (1).jpeg\" style=\"height:100%; width:100%\" /><br />&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">There are many reasons for tattooing, and tattoos are viewed with as much pride as distaste. In the Asian world, however, the dark images of tattooed people are still conjured up, with some parents relentlessly shielding their children from the &lsquo;tattooed man&rsquo;.<br /><br />Tattoos are permanent ink markings on the skin and are one of the types of body modifications done. There are many reasons for tattooing, and tattoos are viewed with as much pride as distaste.<br /><br />Tattoos are believed to have been around as early as the Stone Age era, with the discovery of Oritz the Iceman in the Alps with 57 black markings on his frozen body. In the ancient years, tattooing was widespread amongst tribes across North America before it was rediscovered in the modern western world. Early European explorers and sailors who came into contact with the tribes while on their expeditions, returned home with the tattoos <a href=\"#inscribed\">inscribed</a> on their body parts. The word &lsquo;tattoo&rsquo;, however, was first introduced in Europe by 18th-century explorer, James Cook, when he returned from his Tahiti voyage. It comes from the Polynesian word &lsquo;ta&rsquo; which means &lsquo;striking something&rsquo; and the Tahitian word &lsquo;tatau&rsquo; which means &lsquo;to mark something&rsquo;.</span></span><br /><br /><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">Over the years, tattooing has gone through different waves of perception. In ancient times, the meaning and purpose of tattoos held a more symbolic value. They served as <a href=\"#talisman\">talismans</a> to ward off evil spirits and indications of ranks and royalty in a community. Tattoos were also a symbol of a warrior&rsquo;s status of weaponry skills within a tribe, and for some other soldiers, they were medals of courage. African tribes used tattoos to mark their ethnic or religious heritage, while Egyptians used tattoos as a way to mark the slaves and peasants. In contrast, there was a period of time when tattoos received a bad reputation. In the 1900s, tattooing was viewed as a rebellious and anti-social activity and was often associated with convicts and street gangsters. However, this stigma was considerably removed in the Western world by 1990 and came to be viewed as a harmless fashion statement or a decorative piece of art, thanks to tattoos sported by famous musicians and sports figures such as Cher and Dennis Rodman. In the Asian world, however, the dark images of tattooed people are still conjured up, with some parents <a href=\"#relentlessly\">relentlessly</a> shielding their children from the &lsquo;tattooed man&rsquo;.<br /><br />With the invention of tattoo machines, there is a greater variety of tattoo designs people can choose from these days. For example, tribal patterns are popular for their <a href=\"#savage\">savage</a>, rugged and intricate look which adds charm to the modern-day appearance. Black and dense Celtic crosses, though generally favoured by religious people who wish to display the commitment to their faith, are also adorned by the general mass. Star signs are famous for their simplicity and <a href=\"#versatility\">versatility</a> as they suit all occasions. They range from symmetrical and <a href=\"#sublime\">sublime</a> in designs to glossy and dark outlines in colours. Engraving names of loved ones in cursive, embroidered or fanciful fonts are also very common in an attempt to declare the depth of one&rsquo;s love. Tattoos of delicate and dainty angels and <a href=\"#wispy\">wispy</a> and enchanting butterflies are popular among females. The former represents positive emotions associated with purity and <a href=\"#serenity\">serenity</a> while the latter represents elements of beauty, freedom and joy. Unsurprisingly, tattoos of majestic and maned lions which symbolise immense strength and a sense of masculinity are popular among males.<br /><br />Regardless of any controversies surrounding tattoos, youths today are beginning to see tattoos as adding <a href=\"#zing\">zing</a> to their lives, even if it means going against societal expectations. It appears that tattoos will soon <a href=\"#come full circle\">come full circle</a>.<br /><br /><strong>WORD BANK</strong> </span></span></p>\r\n</div>\r\n</div>\r\n\r\n<div style=\"line-height:30px\">\r\n<div style=\"line-height:30px\">\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">1. <a id=\"inscribed\" name=\"inscribed\">Inscribed</a>: write or carve on something as a permanent marking. </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">2. <a id=\"talisman\" name=\"talisman\">Talisman</a>: an object which is believed to possess some magical qualities and provide good luck and protection from evil, for the wearer. </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">3. <a id=\"relentlessly\" name=\"relentlessly\">Relentlessly</a>: in a steady and persistent manner </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">4. <a id=\"savage\" name=\"savage\">Savage</a>: not civilized </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">5. <a id=\"versatility\" name=\"versatility\">Versatility</a>: serving different uses/functions </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">6. <a id=\"sublime\" name=\"sublime\">Sublime</a>: majestic </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">7. <a id=\"wispy\" name=\"wispy\">Wispy</a>: a thin or faint streak </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">8. <a id=\"serenity\" name=\"serenity\">Serenity</a>: calmness </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">9. <a id=\"zing\" name=\"zing\">Zing</a>: to be lively (informal use) </span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">10. <a id=\"come full circle\" name=\"come full circle\">Come full circle</a>: to complete a cycle of transition</span></span><br /><br /><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><strong>Do you think body piercing is a manifestation of teenage rebellion or simply an innocuous act of curiosity?</strong></span></span></p>\r\n</div>\r\n</div>\r\n', '', '', '2014-02-01 00:00:00', 'Identity', 'test', 'Tattoo', 'No', 'Non-Fiction', 'Select Level of Difficulty', 'There are many reasons for tattooing, and tattoos are viewed with as much pride as distaste. In the Asian world, however, the dark images of tattooed people are still conjured up, with some parents relentlessly shielding their children from the Ã¢â‚¬Ëœtat', 723, 'Shanas Krishnan', '2022-09-06 18:45:30', NULL, NULL),
(12, 'Wardrobe Staples', '2022-07-18 15:13:33', 6, 'Active', 17, '', 'magazine/iThink/2/ithink2_Page_07.jpg', '<div style=\"line-height:30px\">\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong><img alt=\"\" src=\"ckeditor/../uploads/wardrobe staples.jpg\" style=\"height:100%; width:100%\" /><br />\r\n<br />\r\nWardrobe Staples &ndash; The five wardrobe must-haves for any self-respecting tween! </strong></span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Our in-house fashion guru, </span></span><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">JEREMY AU-YONG suggests some must-haves for you.</span></span><br />\r\n<br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\"><strong>Boys:</strong></span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">DENIM JEANS</span></span><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"> </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">A rugged blue slim, straight leg is classic and never goes out of style!</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">T-SHIRT</span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">You can show your sense of adventure with your choice of colour and print. Plain or stripey tees look casual yet smart. Pique polos are a good alternative when you want to look more pulled together.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">SHIRT </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Oxford button-downs and plaid checks are always safe bets and perfect for any occasion.&nbsp; </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">BERMUDAS </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Indispensable in the warm weather, bermudas with tailored details such as jetted pockets and fly fronts look more presentable than board shorts.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">CHINOS </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">You can never go wrong with easy neutrals such as khaki beige, navy blue, battleship grey or army green!</span></span><br />\r\n<br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Girls:</strong></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">DENIM JEANS </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Dark blue, black or grey denim with a bit of stretch is always a sensible choice. Choose a slim, tapered cut that fits and flatters.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">TOP </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Build a collection of basic tops in various cuts and colours that are easy to mix and match.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">CARDIGAN </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Cardigans help you to either dress up with a formal skirt, dress down with jeans, or use as a cover up over a little black dress. They come in various colours so have your pick!</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">SKIRT </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Flared or pencil cut, just above the knee is always a safe length. Avoid mid-calf hem lengths as they truncate the leg and widen the calves.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">DRESS </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">The ultimate girly statement! Have at least two. Great for dressier occasions too.</span></span><br />\r\n<br />\r\n<strong><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:18px\">&ldquo;Fashions fade, style is eternal&rdquo; - Yves Saint Laurent</span></span></strong><br />\r\n<br />\r\n<span style=\"font-size:12.0pt\"><strong><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:18px\">How important is it to keep up with ever-changing fashion trends?</span></span></strong> </span></p>\r\n</div>\r\n', '', '', '2014-04-01 00:00:00', 'Sports & Games', NULL, 'Fashion', 'No', 'Fiction', 'Lower Advanced', 'Our in-house fashion guru, Jeremy Au-Yong suggests some wardrobe must-haves for you', 257, 'Jeremy Au-Yong', NULL, NULL, NULL),
(13, 'Roughing it Outdoors', '2022-07-18 15:22:09', 6, 'Active', 38, '', 'magazine/iThink/2/ithink2_Page_08.jpg', '<div style=\"line-height:30px\">\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong><img alt=\"\" src=\"ckeditor/../uploads/roughing it outdoors.jpg\" style=\"height:100%; width:100%\" /><br />\r\n<br />\r\nLOVE FOR THE OUTDOORS - </strong></span></span><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">You will hear Tis Saleha&rsquo;s interview with 20-year-old Marina Yusoff, on her love for outdoor adventure activities.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>M</strong>: I have always liked being outdoors since I was a child of five or six because my dad used to take me on his trekking expeditions. So, at an early age, I learnt to conquer the fear of great heights and explore dark caves, among other things.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>I: </strong>So, you might say that such experiences have toughened you up.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>M</strong>: Yes, they have. I also learned to be alert and disciplined because that is important if you want to stay alive and in one piece.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>I: </strong>Right. And Which is your favourite outdoor adventure activity?</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>M</strong>: Oh, I have many but I like surfing best, when I go to Bali or Australia, and skiing.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>I</strong>: Speaking of surfing and skiing, what are your views about engaging in extreme sports? Do our youths have a passion for such action sports?</span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"ckeditor/../uploads/Screenshot 2022-07-08 at 14.png\" style=\"float:left; height:60%; margin:10px; width:60%\" /></span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>M</strong>: Well, extreme sports, also known as action sports, involve a high level of physical exertion. Unlike traditional sports, activities like bungee jumping or hang gliding involve a great level of danger. That&rsquo;s because these activities are controlled by environmental elements which are also beyond our control. That means, the outcome of the sport or activity is affected by the weather or the terrain. For example, changing snow conditions will affect the performance of the skiers, just like the height and shape of the wave affect the surfer&rsquo;s performance.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>I:</strong> So, you never know what to expect when you play with uncontrollable elements like the weather.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>M</strong>: Yes, some have lost their limbs and some their lives for the sake of such high-risk sports. I just read an article recently about an experienced rock-climbing guide falling to his death while on duty. I do not know if many of our youths pursue extreme sports involving snow conditions or free-flying, but there are many taking up rock climbing and mountain biking. What is important is that they are aware of the risks they face every time they engage in that sport, and they know how and where to get help. You see, most of these sports are solitary, unlike traditional sports, which are played in teams.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>I: </strong>I see. Well, thank you, Marina, for sharing your views on extreme sports.</span></span></p>\r\n\r\n<p><strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Should extreme sports such as&nbsp;skydiving and freefall be banned&nbsp;because of their dangerous nature? &nbsp;</span></span></strong></p>\r\n\r\n<p><strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"ckeditor/../uploads/img1457-ski.jpg\" style=\"height:100%; width:100%\" /></span></span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n', '', '', '2014-04-01 00:00:00', 'Sports & Games', NULL, 'Outdoor sports, Adventure', 'Yes', 'Non-Fiction', 'Lower Advanced', 'Tis Saleha\'s interview with 20-year-old Marina Yusoff, on her love for outdoor adventure activities.', 395, 'Tis Saleha', NULL, NULL, NULL),
(15, 'Five Kicking Facts about Soccer', '2022-07-18 17:30:44', 6, 'Active', 17, '', 'magazine/iThink/2/ithink2_Page_11.jpg', '<div style=\"line-height:30px\">\r\n<p><img alt=\"\" src=\"ckeditor/../uploads/img1614.jpg\" style=\"height:100%; width:100%\" /></p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">1. Brazilian soccer star Ronaldinho scored every goal in a 23-0 game at age 13.</span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">2. A bolt of lightning killed an entire 11-man soccer team from the Democratic Republic of Congo in 1998, leaving the opposing team unharmed. People say it was a curse.</span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">3. The highest score in a soccer game in history is 149-0! A shocking score indeed, but this was because it was a form of protest by one of the teams for being robbed of a title in their previous game because of a penalty. Interestingly, all 149 goals were scored by that team kicking the ball into their own net!</span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">4. After the funeral wake of a Colombian soccer fan, a group of friends carried him and his coffin to the local soccer stadium to catch one final match! Apparently, passion knows no death.<br />\r\n<br />\r\n5. A soccer player can run as much as 10km during a soccer game. That&rsquo;s the equivalent of running around 350 basketball courts!</span></span></span><br />\r\n<br />\r\n<strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Can professional athletes be our role models? Why?&nbsp;</span></span></strong></p>\r\n</div>\r\n', '', '', '2014-04-01 00:00:00', 'Sports & Games', NULL, 'Soccer, Athletes', 'No', 'Non-Fiction', 'Lower Advanced', 'Five kicking facts about soccer', 168, '', NULL, NULL, NULL),
(16, 'Drugged ... By Online Games', '2022-07-18 17:41:56', 6, 'Active', 4, '', 'magazine/iThink/2/ithink2_Page_12.jpg', '<div style=\"line-height:30px\">\r\n<div style=\"line-height:30px\">\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\"><img alt=\"\" src=\"ckeditor/../uploads/druged by online games.jpg\" style=\"height:100%; width:100%\" /><br />\r\n<br />\r\nWhat most people typically understand of addiction is that it constitutes <a href=\"#compulsive\">compulsive</a> behaviour, a reliance on a substance or activity despite the adverse consequences. In this respect, there are obvious forms of addiction such as drug addiction or gambling addiction that have consequences that are far worse than online gaming addiction. Still, in recent years, with the proliferation of massive role-playing online games, the number of people gaming excessively has increased, leading to serious <a href=\"#repercussions\">repercussions</a> in some cases. Studies have shown that there are those who play up to 90 hours at a stretch, to the detriment of their physical and emotional well-being. It is disturbing to see how easily people today can slide down the slippery slope of addiction to online games.</span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">A combination of factors has made online gaming incredibly appealing, and consequently also easily addictive. It is easy to see the appeal of online games like the World of Warcraft or Starcraft: with sophisticated gaming plots and characters as well as superior visuals and sounds, players are <a href=\"#lulled\">lulled</a> into a fantasy world where they are able to take on necromancers and wizards to become conquerors. Players feel empowered, and the thrill of beating opponents is addictive as they get better in their game. What is more, the possibility of playing at odd hours, or at all hours of the day with millions of players worldwide logged on ensures that there is always a quest or mission. The <a href=\"#ubiquity\">ubiquity</a> of the home personal computer has also given players easy access with few prohibitive barriers. Moreover, online games are relatively inexpensive, and so, with this combination of factors, people get easily addicted to them.</span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">Teenagers and children are especially vulnerable to gaming addiction precisely because there are few restrictions imposed by the state. If parental supervision is lacking, it is easy for them to game for hours on end. South Korea, known as the most wired nation in the world, is now grappling with an addiction epidemic amongst its young people. There are thousands of cyber gaming cafes around Seoul, open 24 hours a day, and young people are known to stay for hours, or even days, just gaming. In China, there are rehabilitation camps that desperate parents take their children to as a last resort to break their addiction to gaming. News reports cite how these children typically start to lose interest in school and eventually refuse to do much else other than being <a href=\"#cloistered\">cloistered</a> in the room in front of their computers, gaming. In one of the most extreme cases, a 17-year-old South Korean teenager stabbed his mother 17 times to death after she took away his keyboard in an attempt to break his addiction. Even adults are susceptible to gaming addiction. One of the most famous and bizarre cases of gaming addiction was in 2010 when a Korean couple was jailed for starving their own baby as they spent days in an Internet caf&eacute;, &lsquo;raising&rsquo; their online baby. Surely such is proof that people can be easily addicted to online gaming, and rather subconsciously too.</span></span></span></p>\r\n\r\n<p><br />\r\n<img alt=\"\" src=\"ckeditor/../uploads/img11804.jpg\" style=\"float:left; height:30%; margin:10px; width:30%\" /><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">The gaming industry has long claimed that there are safeguards put in place to ensure that games can be enjoyed safely and sensibly. There are warning messages that gamers should take regular breaks and that gaming time should not exceed reasonable hours. However, we have to remember that the gaming industry is a multi-billion dollar one, with companies like Blizzard Entertainment making lucrative profits from a worldwide community of gaming fans. Thus, these companies are unlikely to sincerely commit to preventing addictive behaviour.</span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">Of course, as with any other hobby, some people may play online games excessively but not to the extent of a <a href=\"#pathological\">pathological</a> addiction where daily life becomes impossible. Professional gamers make a career out of gaming and game obsessively to hone their skills, just as Olympian athletes train <a href=\"#relentlessly\">relentlessly</a> to perfect their sport. Nevertheless, there is only a fine line between obsession and addiction, and there is no saying when and how this line is crossed, and as many instances have shown, it is definitely harder not to cross it than otherwise.</span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">Although online gaming addiction has yet to become a widespread <a href=\"#scourge\">scourge</a>, there should be greater public awareness about it so that people would be more able to recognise the addiction symptoms and take precautionary measures against it. Parents especially need to be alert so as to prevent their children from developing an unhealthy addiction to online games. It is, after all, just too easy to slip down that slope.</span></span></span><br />\r\n<br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\"><strong>WORD BANK</strong></span></span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>1. <a id=\"compulsive\" name=\"compulsive\">compulsive</a></strong>: having an irresistible impulse to act&nbsp;</span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>2. <a id=\"repercussions\" name=\"repercussions\">repercussions</a></strong>: indirect effects that are produced by an event or action. </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>3. <a id=\"lulled\" name=\"lulled\">lulled</a></strong>: to be deceived </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>4. <a id=\"ubiquity\" name=\"ubiquity\">ubiquity</a></strong>: present everywhere </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>5. <a id=\"cloistered\" name=\"cloistered\">cloistered</a></strong>: secluded </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>6. <a id=\"pathological\" name=\"pathological\">pathological</a></strong>: of, relating to, or manifesting behavior that is habitual and compulsive </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>7. <a id=\"relentlessly\" name=\"relentlessly\">relentlessly</a></strong>: in a steady and persistent way </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\"><strong>8. <a id=\"scourge\" name=\"scourge\">scourge</a></strong>: a source of widespread dreadful devastation</span></span></span><br />\r\n<br />\r\n<span style=\"font-size:18px\"><strong><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:black\">People nowadays are easily addicted to online games. Do you agree? </span></span></strong></span></p>\r\n</div>\r\n</div>\r\n', '', '', '2014-04-01 00:00:00', 'Sports & Games', NULL, 'Gaming, Addiction', 'No', 'Non-Fiction', 'Lower Advanced', 'Learn more about how online gaming can be extremely addictive', 810, 'Evelyn See', NULL, NULL, NULL),
(18, 'Childhood Toys ', '2022-07-18 17:48:03', 6, 'Active', 1, '', 'magazine/iThink/2/ithink2_Page_16.jpg', '<div style=\"line-height:30px\">\r\n<p><strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"ckeditor/../uploads/childhood toys.jpg\" style=\"height:100%; width:100%\" /><br />\r\n<br />\r\nEveryone has a few toys that define their childhood. What are yours? </span></span></strong><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Toys are an important and memorable part of everyone&rsquo;s childhood. We all have a few toys to remember. While technology has changed the toys of the present generation, I was born in an era when the advent of the Internet and electronic devices had not yet dominated people&rsquo;s daily lives. The toys I favoured in my growing years were unsophisticated, yet they stimulated my creativity and enhanced my psychomotor skills, fostering my emotional and mental growth.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">My first fond memory of amusing myself for hours on end was riding a light-violet and sea-foam-green, three-wheeled tricycle that was powered by rubbery pedals on the front wheels. It was a birthday gift from my beloved uncle when I turned three. My mum recalls my initial moments of frustration when I was unable to reach the hardy pedals with my feet and propel myself forward. I had <a href=\"#vehemently\">vehemently</a> declined the help of being pushed from behind by an adult. Instead I had opted for holding onto the sleek, shiny handle bars and pushing it around the basketball court, one foot on the step in the rear and the other pushing off the hard, cemented ground.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">One month before I celebrated my fourth birthday, my dad had captured the moment of triumph the day I discovered my legs could reach the pedals and I could whizz off on my own. The trike became my prized possession for the next two years. It was the plaything that marked the start of my fighting spirit and determination as I ventured into tricycle battles with my friends in my neighbourhood. We would ride our trikes up a grassy hill in the park and race down the slope as it dipped and levelled out. It was not an easy task initially as I would keep rolling backwards while going up the slope, and consequently slowing myself down. My <a href=\"#gloating\">gloating</a> competitors, older by a year or two, would be waiting with victorious smirks at the end of the levelled path as they watched me pedal furiously towards the finish line. I refused to believe that age was a barrier to winning the race. Unrelenting, I sought the help of my sixteen-year-old cousin to coach me secretly, spending hours hoisting myself up the slope in my three-wheeler. My heart swelled with pride the day I beat my friends and finished the race first. The astounded expressions on their <a href=\"#puckered\">puckered</a> faces at being defeated by a puny kid sweetened my victory all the more and till today, remain etched in my mind.</span></span></p>\r\n\r\n<p><br />\r\n<img alt=\"\" src=\"ckeditor/../uploads/img11841.jpg\" style=\"height:100%; width:100%\" /><br />\r\n&nbsp;</p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">As I entered formal schooling at seven, a different toy that got me engrossed and made me lose track of hours, to my mother&rsquo;s dismay, was the Lego toy. This construction toy has withstood the test of time and is loved by almost everyone because of its unlimited open-ended possibilities. The classic, brightly coloured, plastic blocks with bumps and holes and easy interlocking combinations never failed to thrill me each time my fingers sought them. The glossy Lego pieces would be strewn on the carpet in my living room as I absent-mindedly reached for a piece, my eyes intently fixed on the structure taking shape in front of me. It was the toy that provided me with hours of patterning practice and fine motor development, allowing for an astonishing range of creative play; and looking for just the right piece to avoid wastage of space strengthened my sorting skills, skills that became characteristic of my adulthood where I attempt to organise every item with minimal wastage of space. My eyes widened with glee the few times I had received Lego sets as gifts from my relatives and my interest in them lasted through my primary school years.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Last but not least, another play invention that is marked on the chart of my favourite childhood toys is the spool-like toy, yo-yo. Consisting of an axle connected to two wooden or plastic discs, and a length of white twine looped around, it is spun out and reeled in by the attached string that loops around the player&rsquo;s finger. This hand-acrobatic object <a href=\"#piqued\">piqued</a> my curiosity when I spotted my primary three classmate skillfully allowing the gleaming palm-sized disc to wind itself back to her grip after every downward throw. I was grossly wrong when I assumed that I could achieve that on my first try. To my utter dismay, the yo-yo had remained dangling, suspended by the string. It did not snap back to my expectant palm. The simple-looking toy was indeed deceptive; it tested and taught patience. It was a challenge to figure out the right amount of force to exert when tugging on the string a little to rewind it. After many futile efforts, my yo-yo could <a href=\"#bob\">bob</a> up and down but not without it &lsquo;sleeping&rsquo; a few times before each successful attempt. Today, yo-yos have certainly evolved with technology. From plain plastic or wooden spools, they now light up with motion-activated LEDs!</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Research has proven that a child learns best through play - and what else is a toy for but play. The toys that I loved dearly during my growing years had not only brought me endless hours of entertainment and joy but also impacted my cognitive and social development in more ways than I could possibly know.</span></span><br />\r\n&nbsp;</p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>WORD BANK</strong></span></span></p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>1. <a id=\"vehemently\" name=\"vehemently\">vehemently</a></strong>: strongly </span></span></p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>2. <a id=\"gloating\" name=\"gloating\">gloating</a></strong>: to feel or express great malicious (spiteful) pleasure </span></span></p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>3. <a id=\"puckered\" name=\"puckered\">puckered</a></strong>: gathered into small wrinkles or folds </span></span></p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>4. <a id=\"piqued\" name=\"piqued\">piqued</a></strong>: aroused </span></span></p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>5. <a id=\"bob\" name=\"bob\">bob</a></strong>: to move up and down</span></span><br />\r\n<br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Everyone has a few toys that define their childhood. What are yours?</strong></span></span></p>\r\n</div>\r\n', '', '', '2014-04-01 00:00:00', 'Sports & Games', NULL, 'Childhood, Toys, Play', 'No', 'Non-Fiction', 'Lower Advanced', 'The author shares about the impact of toys on one\'s childhood', 956, 'Shanas Krishnan', NULL, NULL, NULL);
INSERT INTO `edu_article` (`article_id`, `article_title`, `article_published_date`, `mag_id`, `article_status`, `essay_type_id`, `article_path`, `article_image`, `article_content`, `article_style`, `audio_path`, `art_year`, `theme`, `genre`, `topic_words`, `audio_support`, `fiction`, `difficulty_level`, `description`, `word_count`, `author`, `last_modified`, `test`, `reflection_ques`) VALUES
(19, 'Of Tops, Marbles and Zero-point', '2022-07-18 18:05:41', 6, 'Active', 3, '', 'magazine/iThink/2/ithink2_Page_20.jpg', '<div style=\"line-height:30px\">\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"ckeditor/../uploads/of tops, marbles n zero-point.jpg\" style=\"height:100%; width:100%\" /><br />\r\n<br />\r\nTraditional games form a highly significant part of the diverse multicultural heritage of Singapore. Not only do they showcase the creativity and initiative of our forefathers in making use of inexpensive resources to create original and innovative games, they also serve to document some of the unique ways in which leisure and play were enjoyed in a bygone era. Sadly, the advent of modernity has deprived us of major aspects of this socio-cultural heritage. <a href=\"#myriad\">Myriad</a> infrastructural and lifestyle changes have been brought about by socio-economic and physical changes in Singapore. As such, kampongs, or villages with neighbours living in close proximity, have had to make way for public housing estates. In addition, with the transformation of the physical landscape, some traditional games gradually disappeared, the inevitable <a href=\"#casualties\">casualties</a> of this push towards modernisation.<br />\r\n<br />\r\nOne of the traditional games worthy of mention is the game of &lsquo;gasing&rsquo; or wooden top. This game has its origins as a Malay cultural game, with the object of the game being for the player to use a string to spin his top for as long as he possibly can. Eventually, the last player standing would be the one with the last top left spinning, and he would win the game. However, nowadays, the modern equivalent found in some toy shops is made of plastic or other materials, such that the feel of spinning a top is not quite the same. Unsurprisingly in the spanking new, modern housing estates of 21st century Singapore, children are seldom spotted playing with spinning tops in the recreational areas beneath blocks of flats, commonly known as void decks.</span></span><br />\r\n&nbsp;</p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"ckeditor/../uploads/img12038.jpg\" style=\"height:50%; width:50%\" /><br />\r\nAnother much-enjoyed traditional game is &lsquo;goli&rsquo;, a game using marbles. Facing off against one another in playgrounds and open sandy spaces in the competitive game of marbles was what children once engaged in, particularly boys. Amidst this once-popular <a href=\"#spirited\">spirited</a> backdrop, boys would hone their skills and finesse to challenge one another. The aim of the game is to knock the opponents&rsquo; marbles out of a circle drawn on the ground. Such a game requires precision of aim, dexterity of wrist and hand, and the resilience to withstand the tensions that would run high in each game. It thus remains to be seen whether the universal qualities of goli would result one day in a <a href=\"#resurgence\">resurgence</a> of the great goli playoffs of the past.</span></span><br />\r\n&nbsp;</p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Besides the joy, it is undeniable that traditional games could have fostered some desirable or even undesirable qualities among children. One of the possible negative effects is that of an unhealthy competitive appetite, as the aim of most games is to defeat the other in order to be crowned the winner. Traditional games have even been cited by critics as being precursors or stepping stones to adult games involving gambling, such as pool and betting on outcomes of sports matches, which use the same kinds of dynamics. While this may be the case, the fact remains that these games have also inculcated positive values such as teamwork and <a href=\"#rooting\">rooting</a> for one&rsquo;s friends to do well. For example, in the traditional game of &lsquo;zero-point&rsquo;, teams were formed to jump across a &lsquo;zero-point&rsquo; &lsquo;rope&rsquo; <a href=\"#fashioned\">fashioned</a> from elastic or rubber bands. Team members had to work in tandem, while supporting one another with cheers and words of encouragement, and there would even be some strategising taking place as well. Due to the bonding nature of this game, many adults in Singapore still recall playing this game with great fondness and cite this as one of the unforgettable memories of their childhood.<br />\r\n<br />\r\n<img alt=\"\" src=\"ckeditor/../uploads/img12057.jpg\" style=\"float:left; height:242px; margin:10px; width:184px\" />Unfortunately, although the traditional games of the past may evoke a keen sense of nostalgia in older Singaporeans, they do not hold the same allure for today&rsquo;s youngsters. These games may have marked a rite of passage in the lives of the young people of yesteryear; for this present older generation who had grown up surrounded by those games, their disappearance would be akin to marking the passing of an era. However, the young of today with the requisite computer games that they play with <a href=\"#religiously\">religiously</a>, not to mention handheld portable electronic devices, would scarcely be interested in these well-loved games from their parents&rsquo; and grandparents&rsquo; childhood. Playing &lsquo;five stones&rsquo; from the good old kampong days by tossing into the air little pyramidal bean bags that would fit a six-year-old boy&rsquo;s clenched fist? The games console would do just as well for the fine-tuning of motor skills and hand-eye coordination! Keeping a feathered shuttlecock airborne using just the heel of your foot, to hone your sense of rhythm, focus and balance? Well, who needs &lsquo;capteh&rsquo; when there are arcades with para-para dancing stations to help you hone those very skills?<br />\r\n<br />\r\nAll things considered, traditional games have left their <a href=\"#indelible\">indelible</a> stamp in the <a href=\"#annals\">annals</a> of history, and will continue to abide in the memories of many an adult in Singapore when they should chance to reminisce about the good old days. Even though they may have had to make way for the new games that are played by this era&rsquo;s young generation, there is one <a href=\"#salient\">salient</a> thread that binds the games played by young people, whether from the past or in the present. That would be the fact that childhood games play a significant role in creating happy memories and bringing youngsters out of the uncertainties of childhood, to eventually become young men and women of character and stature. That alone justifies their existence even if they may in time disappear into the mists of history.</span></span><br />\r\n&nbsp;</p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>WORD BANK</strong></span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>1. <a id=\"myriad\" name=\"myriad\">myriad</a></strong>: a vast number<br />\r\n<strong>2. <a id=\"casualties\" name=\"casualties\">casualties</a></strong>: those which are eliminated due to an action<br />\r\n<strong>3. <a id=\"spirited\" name=\"spirited\">spirited</a></strong>: full of animation or liveliness<br />\r\n<strong>4. <a id=\"resurgence\" name=\"resurgence\">resurgence</a></strong>: restoration or renewal<br />\r\n<strong>5. <a id=\"rooting\" name=\"rooting\">rooting</a></strong>: lending support to someone or something<br />\r\n<strong>6. <a id=\"fashioned\" name=\"fashioned\">fashioned</a></strong>: given shape or form<br />\r\n<strong>7. <a id=\"religiously\" name=\"religiously\">religiously</a></strong>: strictly<br />\r\n<strong>8. <a id=\"indelible\" name=\"indelible\">indelible</a></strong>: permanent<br />\r\n<strong>9. <a id=\"annals\" name=\"annals\">annals</a></strong>: recorded events of years<br />\r\n<strong>10. <a id=\"salient\" name=\"salient\">salient</a></strong>: prominent</span></span><br />\r\n<br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>With the rise of technology, traditional games and forms of entertainment are being forgotten. Do you agree?</strong></span> </span></p>\r\n</div>\r\n', '', '', '2014-04-01 00:00:00', 'Sports & Games', NULL, 'Traditional Games, Heritage', 'No', 'Fiction', 'Lower Advanced', 'Learn more about the traditional games in Singapore and their significance', 931, 'Maximilian Yap  ', NULL, NULL, NULL),
(20, 'Hockey Champ ', '2022-07-18 18:06:11', 6, 'Active', 2, '', 'magazine/iThink/2/ithink2_Page_22.jpg', '<div style=\"line-height:30px\">\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"ckeditor/../uploads/hockey champ.jpg\" style=\"height:100%; width:100%\" /><br />\r\n<br />\r\n&ldquo;What do you mean she will be taking part in a hockey match?&rdquo; my dad&rsquo;s voice bellowed from the kitchen. </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Well, I guess my mum had THE TALK with my dad while cooking yet another uneventful dinner. With much <a href=\"#trepidation\">trepidation</a> I entered the kitchen, only to see smoke rising from the top of my dad&rsquo;s light-reflecting head. Okay, so it was the vapour from the pot of curry stewing on the stove behind my dad but it basically summed up my dad&rsquo;s emotion. </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">My dad comes from the school of thought that any activity that does NOT involve a book, a pen and grades, is not worth his daughter&rsquo;s time and must be avoided at all costs.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Bracing myself for another lashing out session, I squared my shoulders and looked at Dad&rsquo;s face which was seething with anger. </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&ldquo;What did I tell you about not wasting your time this year? Your grades this year determine which stream you get into next year! What is this about you wasting your time on hockey practices and matches?&rdquo; my dad thundered. &ldquo;All those weeks you were coming back late from school were due to these practices?&rdquo;</span></span><br />\r\n&nbsp;</p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">While it was true that I did not lie to my parents about staying late at school for remedial lessons, I did not correct them when they assumed that was why I was returning home late. </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&ldquo;But Dad, you allow Sam to be part of his school&rsquo;s tennis team as well as be the captain of the track-and-field club. Why the <a href=\"#disparity\">disparity</a>?&rdquo; I mumbled. </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&ldquo;Sam scores A&rsquo;s in his subjects, does not need reminders to do his homework and has good time-management skills,&rdquo; my dad said pointedly of his blue-eyed boy. &ldquo;Moreover, do you know ankle injuries comprise 15% of all hockey injuries? Or what if you end up with facial fractures, eye injuries or even broken teeth?&rdquo;</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&ldquo;Nothing like that will happen! Please let me just play in next week&rsquo;s inter-school hockey match, Dad! I promise, I will not ask for anything else.&rdquo; I pleaded. </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">My parents exchanged looks and Dad manoeuvred out of the kitchen. </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Later that evening, we had our dinner in silence. And for the rest of the week, we never spoke about the upcoming hockey game, Mum&rsquo;s new salt-free diet for the family or my late returns from school. </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Finally, THE day arrived! The stadium was filled with the <a href=\"#cacophony\">cacophony</a> of visitors - excited supporters from various schools, coaches, players, parents and just about anybody who wanted to be there on that day.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">From the moment the whistle was first blown, my mind shut out the sounds from outside the field, my heart was racing and I was flooded with adrenaline. Having my hands wrapped around the stick gave me renewed confidence and I knew, my team had to win this game. The stadium was soon filled with cheers and roars, especially when exemplary moves were made. At the end of 70 minutes of running around receiving passes, tackling our opponents and having received one green card for our team, we tasted sweet victory : 2-1.</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Walking triumphantly towards the car park to board the school bus back to school, I spotted my dad and coach Roy talking <a href=\"#animatedly\">animatedly</a>. I did a double take. I did not expect my dad to be at the stadium &ndash; much less be talking to my coach. My dad waved at me to come over. After a round of congratulatory words, coach Roy said he would see me in school the following week and left us, my dad and I, to ourselves. </span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">It was pin-drop silence as Dad and I headed home together. Suddenly, Dad suggested stopping for dinner. At the restaurant we picked for our dinner, he looked at me with a mixture of pride and sadness, and started, &ldquo;Once upon a time, I represented Singapore in hockey. I started off at the school level, the division, then at the national level. Hockey was my life. Your grandmother was my <a href=\"#ardent\">ardent</a> fan. For 12 years, she was at every single game of mine. My last game was her last too. A friendly match between Singapore and Vietnam caused the death of my hockey career. One of my opponents tackled me with his hockey stick. The impact of his swing went right into my spinal cord and I broke my T9-10 vertebrae. Ten months and four surgeries later, I left the hospital in a wheelchair. Two decades later, I am still in one.&rdquo;</span></span><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">A teardrop slid down my cheek. I finally understood why my father had refused to let me play hockey. I finally understood how much he cared. I looked at my father, my loving father, who is, and will always be my hockey champ.</span></span><br />\r\n<br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>WORD BANK</strong></span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>1. <a id=\"trepidation\" name=\"trepidation\">trepidation</a>: </strong>apprehension </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>2. <a id=\"disparity\" name=\"disparity\">disparity</a>: </strong>inequality </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>3. <a id=\"cacophony\" name=\"cacophony\">cacophony</a>: </strong>harsh, jarring sounds </span></span><br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>4. <a id=\"animatedly\" name=\"animatedly\">animatedly</a>: </strong>in a lively manner<br />\r\n<strong>5. a<a id=\"ardent\" name=\"ardent\"></a>: </strong>devoted</span></span><br />\r\n<br />\r\n<strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">To what extent do the benefits of playing sports outweigh the potential dangers and sacrifices that players have to make?</span></span></strong></p>\r\n</div>\r\n', '', '', '1970-01-01 00:00:00', 'Sports & Games', NULL, 'Hockey, Sports', 'No', 'Fiction', 'Lower Advanced', 'A school girl recounts her experience in a hockey match', 891, 'Sudha G', NULL, NULL, NULL),
(21, 'Game Creation Challenge', '2022-07-18 18:18:37', 68, 'Active', 26, '', 'magazine/iThink/2/ithink2_Page_24.jpg', '<div style=\"line-height:30px\">\r\n<p><img alt=\"\" src=\"ckeditor/../uploads/4th-game-creation-challenge.jpg\" style=\"height:100%; width:100%\" /><br />\r\n<br />\r\n<span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Here is an email by a secondary school student, Zi Qi, to his friend of the same age who is studying overseas, persuading him to join him in the game competition, &lsquo;The 4th Game Creation Challenge&rsquo; organised by Dellray Computers.<br />\r\n<br />\r\nFrom: <a href=\"mailto:yeziqi@live.com\" style=\"color:#0563c1; text-decoration:underline\">yeziqi@live.com</a><br />\r\nTo: <a href=\"mailto:terencelow257@gmail.com\" style=\"color:#0563c1; text-decoration:underline\">terencelow257@gmail.com</a><br />\r\nSubject: Game Creation Challenge<br />\r\n<br />\r\nHello Terence!<br />\r\n<br />\r\nHow have you been, friend? It has been some time since I&rsquo;ve heard from you. Besides, I&rsquo;ve not seen you on Facebook or Twitter lately, so I guess you must be busy preparing for your final examinations. You&rsquo;d mentioned that you were going to get your braces removed in your email last month. I hope that is done and you&rsquo;re looking dashing now!<br />\r\n<br />\r\nI&rsquo;m writing to tell you about a very exciting competition I&rsquo;ve just come across in an online advertisement posted on the website of Dellray Corporation, that fast-growing computer manufacturing company. Attached is a copy of the advertisement that I&rsquo;ve managed to download so that you can take a look at it as well. Essentially, it is about a Game Creation Challenge sponsored by Dellray, which requires participants to create a computer-based game for children between the ages of 7 and 12. From the wording of the advertisement, it appears as though this game could even be marketed to gamers out there. Can you imagine what this means? We could make it rich &ndash; just by taking part in this competition and winning it!<br />\r\n<br />\r\nHere are more details. The competition requires teams of two to be formed, and we meet the eligibility criterion of age, as we&rsquo;re both past our 14th birthdays! Since we are both adept in programming languages and have even created a few simple games, such as my Mousetrap and your King&rsquo;s Ransom, I figure that we will have a high chance of getting far in this competition, if we were to take part. There&rsquo;s a catch though &ndash; it seems we have to work along the lines of a theme, &ldquo;Bull&rsquo;s Eye&rdquo;. However, I feel that this does not serve as a deterrent; rather, it serves as yet another challenge for us, to test ourselves as to how far we can go in our quest to be top game programmers in Singapore.<br />\r\n<br />\r\nAll right, before I get carried away, let&rsquo;s get down to the logistics of it. Since you&rsquo;ve indicated that you will be coming back from London to take a holiday in Singapore around mid-September, and would be here until Christmas, I think that this will be a golden opportunity for us to work together on creating the game since the game needs to be ready only by January next year. We could showcase our programming expertise, and win some money at the same time. The first prize is a cool one thousand bucks! That&rsquo;s certainly extra pocket money that we could use, don&rsquo;t you agree?<br />\r\n<br />\r\nWell, what do you say, my friend? Shall I sign us both up? There&rsquo;s a deadline for registration, which is 30th September, but I don&rsquo;t think we should wait until the last minute to sign up.<br />\r\n<br />\r\nLooking forward to our collaboration, old buddy! It will be just like old times at Pei Ching Primary School when we were both in the Computer Club. Let me know your response soon!<br />\r\n<br />\r\nEnthusiastically,&nbsp;<br />\r\n<strong>Zi Qi</strong></span></span><br />\r\n<br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Can you make money out of your hobby?</strong></span></span></p>\r\n</div>\r\n', '', '', '2014-04-01 00:00:00', 'Sports & Games', NULL, 'Game Challenge, Email-writing', 'No', 'Fiction', 'Lower Advanced', 'an email by a secondary school student, Zi Qi, to his friend of the same age, persuading him to join him in a game competition', 548, 'Maximilian Yap   ', NULL, NULL, NULL),
(22, 'No Child\'s Play', '2022-07-18 18:35:15', 68, 'Active', 17, '', 'magazine/iThink/2/ithink2_Page_26.jpg', '<br /><br /><div class=\"row\"><div class=\"col-lg-12\"><textarea id=\"situationalWrite\" name=\"situationalWrite\" rows=\"50\"   placeholder=\"Situational Writing.\" class=\"form-control\"></textarea></div></div>', '', '', '2014-04-01 00:00:00', 'Sports & Games', NULL, 'Childhood, Toys', 'No', 'Non-Fiction', 'Lower Advanced', 'How do our childhood toys impact our personality, self-concept, or even intelligence?', 846, 'Shoba Nair', NULL, NULL, NULL),
(25, 'kkfd', '2022-08-12 13:33:47', 22, 'Active', 78, '', 'magazine/iThink/19/1_Page_04.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;<img alt=\"\" src=\"ckeditor/../uploads/new11.jpg\" style=\"height:100%; width:100%\" /><br />dfgfd</span>', '', '', '2022-07-29 00:00:00', 'dfg', NULL, 'dfg', 'Yes', 'Fiction', 'Select Level of Difficulty', 'fdh', 54, 'fdh', '2022-08-12 13:33:47', NULL, NULL),
(27, 'Pop Divaâ€™s Star Quality', '2022-08-12 14:19:26', 17, 'Active', 5, '', 'magazine/iThink/13/1_Page_05.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;</span>\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"ckeditor/../uploads/new11.jpg\" style=\"height:100%; width:100%\" /><br />&ldquo;HOW MANY TIMES DO I HAVE TO TELL YOU?&rdquo;&nbsp;&nbsp;<br /><br />I love rhetorical questions. They add star quality to even the most mundane rants, do you not think? The look of stunned dread on the mousy little intern&rsquo;s face would make a perfect Internet meme. I really ought to Instagram it. The fans would just love that&hellip;&nbsp;<br /><br />&ldquo;NO&hellip;&rdquo;&nbsp;<br /><br />He looks as if he is going to tear up. I wonder, can I make him cry at last? If I manage to get the waterworks flowing today, I will definitely Instagram him. His crybaby face spewing helpless little mouse tears would be the laughing stock of a legion (thirty-seven million and counting) of Instagram followers. Why, I would be fulfilling Warhol&rsquo;s prophecy by giving even a nobody like him his fifteen minutes of fame!&nbsp;<br /><br />&ldquo;WIRE&hellip;&rdquo;&nbsp;<br /><br />Tears are definitely threatening to escape the <a href=\"#confines\">confines</a> of his little beady eyes. I insert a dramatic pause before I crescendo towards my climax.&nbsp;&nbsp;<br /><br />&ldquo;HANGERS!&rdquo;&nbsp;<br /><br />Cowering but disappointingly dry-eyed nonetheless, my little almost-famous mouse scurries off to ferret out a more suitable replacement for the offending item. Unbelievable! Wire hangers indeed. Wire hangers are ever so <a href=\"#plebeian\">plebeian</a>. Totally not the quality of hanger a star deserves. At any rate, why would anyone hang a $400000 designer dress on a cheap, lowly wire hanger? It is <a href=\"#couture\">couture</a>, for heaven&rsquo;s sake.&nbsp;<br /><br />And what a very pretty piece of couture it is, too. I do not resist the urge to hold the designer evening gown (imported from Paris) up before me and <a href=\"#preen\">preen</a> with a flourish in front of the full-length mirror. This dress is fit for a princess. Better than a princess, in fact, this dress is fit for a pop princess. The gorgeous neckline, the slinky silhouette, the languorous silken drape&hellip; now this is a quality dress, fit for a star!&nbsp;<br /><br />I give the dress a dainty little twirl, careful not to catch the flowing train of its hem on my sharp stiletto heel. The reflection and I exchange approving glances of mutual admiration. The soft <a href=\"#gossamer\">gossamer</a> sheen-pastel pink silk, hand-loomed in a Swiss fabric mill - really sets off my complexion. The shimmering sequins (each and every little shiny disc painstakingly hand-sewn by French seamstresses) would look absolutely <a href=\"#alluring\">alluring</a> under the stage lights later. It is a pity that it would only be worn once for this performance. After all, a pop princess with star quality does not let herself be seen in the same dress twice.&nbsp;<br /><br />Returning the dress to the rack, I survey my territory. Everything in the vicinity has to be perfect. Like a hawk scanning the savannah, I cast my eye over the dressing room. Have all the requirements been fulfilled by the organiser? If any detail, no matter how miniscule, should fall short of star quality, there will be much to pay. I would personally make sure of that. It was one of the perks of the job, after all!&nbsp;<br /><br />One dozen long-stemmed roses (pink) in a crystal (not glass) vase (cylindrical, not rectangular) &ndash; check. One leather-upholstered sofa (three-seater, pink) &ndash; check. Six throw cushions (satin covers, pink, no piping) for the sofa &ndash; check. Eighteen large bottles (glass, not plastic) of Evian mineral water (nine chilled, nine room-temperature) &ndash; check. Fresh fruit (sliced but not peeled) platter (bone china, not plastic) &ndash; check. Scented (floral, not citrus, fragrance) candles (tapers, not tealights) in a five-branch candelabrum (sterling silver) &ndash; check.&nbsp;<br /><br />Why, there must be something amiss! This dressing room seems perfect! In fact, it is too perfect for my liking. I cast my critical eye over it again. Could my radar have missed some important target? There must be a <a href=\"#shortcoming\">shortcoming</a> somewhere. I am determined to find it. Perhaps I ought to make that intern iron the carpet (pink) again just for the sake of it.&nbsp;<br /><br />Oh well, it is too late to bother about the carpet now. The camera crew has arrived to set up the props and lights for the televised backstage interview. That little intern is the luckiest man alive, and he does not even realise it.&nbsp;<br /><br />&ldquo;EXCUSE ME! EXACTLY WHAT DO YOU THINK YOU ARE DOING?&rdquo;&nbsp;&nbsp;<br /><br />I begin my <a href=\"#tirade\">tirade</a> on the hapless cameraman. Unlike the intern, he is a big burly chap. Nevertheless, he has that same cowering, sheepish look I do so enjoy seeing on a grown man&rsquo;s face. Have I mentioned before how much I adore rhetorical questions?&nbsp;<br /><br />&ldquo;THAT&rsquo;S NOT HER GOOD SIDE! REPOSITION THAT CAMERA IMMEDIATELY! DON&rsquo;T YOU KNOW YOU SHOULD ONLY FILM HER FROM THE LEFT?&rdquo;&nbsp;&nbsp;<br /><br />Honestly, what would she ever do without me to ensure that everything in her life is of star quality? Every diva ought to have a personal assistant as capable as I. The reflection in the mirror smirks back at me in agreement.&nbsp;<br /><br />My little mouse (still dry-eyed, despite my best efforts) nervously returns with the correct satin-upholstered (pink, of course, to match) hanger.&nbsp;</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:18px\"><strong><span style=\"font-family:Arial,Helvetica,sans-serif\">Pop Divas and their Demands in the Dressing Room&nbsp;</span></strong></span></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>RIHANNA&nbsp;</strong><br />This singer is big on aesthetics &ndash; done her way, of course. She demands blue or black drapes in her dressing room, layered with icy-blue chiffon. She also needs a throw rug. Not just any rug, but one with an animal-print &ndash; cheetah or leopard. And she chooses a specific candle to grace her room &ndash; Archipelago Black Forest. Flowers? Yes, but white tulips please, and definitely no foliage.&nbsp;</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>KATY PERRY&nbsp;</strong><br />Katy Perry would probably scream if you put carnations in her dressing room. She has very specific flower rules. They have to be pink fresh flowers, white and purple hydrangeas or pink and white roses and peonies. Never carnations. As for her other must-haves backstage, she demands baked tortilla chips, freeze-dried strawberries, a jar of quality honey and a bowl of whole fresh organically grown fruits (apples, bananas, oranges and grapes), among others.&nbsp;</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>KANYE WEST&nbsp;</strong><br />This man diva just hates it when his carpet is bumpy. That is why he once demanded that his assistant iron the carpet in his dressing room! As for his long list of must-haves, it includes a barber&rsquo;s chair, two packs of Extra Chewing Gum, a bottle of hot sauce and a box of toothpicks.&nbsp;</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:18px\"><strong><span style=\"font-family:Arial,Helvetica,sans-serif\">WORD BANK</span></strong></span></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\">1. <a id=\"confines\" name=\"confines\"><strong>confines</strong></a>: the borders or boundaries of a place, especially with&nbsp;regard to their restricting freedom of movement&nbsp;</span></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\">2. <a id=\"plebeian\" name=\"plebeian\"><strong>plebeian</strong></a>: lacking in refinement&nbsp;</span></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\">3. <a id=\"couture\" name=\"couture\"><strong>couture</strong></a>: fashionable made-to-measure clothes&nbsp;</span></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\">4. <a id=\"preen\" name=\"preen\"><strong>preen</strong></a>: to admire one&rsquo;s appearance&nbsp;</span></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\">5. <a id=\"gossamer\" name=\"gossamer\"><strong>gossamer</strong></a>: a light, thin, and insubstantial or delicate material or&nbsp;substance&nbsp;</span></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\">6. <a id=\"alluring\" name=\"alluring\"><strong>alluring</strong></a>: powerfully and mysteriously attractive or fascinating;&nbsp;seductive&nbsp;</span></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\">7. <a id=\"shortcoming\" name=\"shortcoming\"><strong>shortcoming</strong></a>: a fault or failure to meet a certain standard, typically&nbsp;in a person&rsquo;s character, a plan, or a system&nbsp;</span></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\">8. <a id=\"tirade\" name=\"tirade\"><strong>tirade</strong></a>: a long, angry speech of criticism or accusation&nbsp;</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:18px\"><strong><span style=\"font-family:Arial,Helvetica,sans-serif\">The people who work behind the scenes like stylists and managers are just as important as the idol stars themselves. Do you agree?&nbsp;&nbsp;</span></strong></span></p>\r\n', '', '', '2022-08-01 00:00:00', 'Music', NULL, 'Celebrities, Idols, Behind The Scenes', 'Select', 'Fiction', 'Upper Advanced', 'Some people just enjoy making life difficult for people around them. Here is a recount by one such person, a diva wannabe. ', 1065, 'Jeremy Au Yong ', '2022-08-12 14:19:26', NULL, NULL),
(28, 'test\'s', '2022-08-12 14:26:01', 71, 'Active', 66, '', 'magazine/iThink/1/1_Page_05.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;<img alt=\"\" src=\"ckeditor/../uploads/new11.jpg\" style=\"height:100%; width:100%\" /><br />sa</span>', '', '', '2022-08-13 00:00:00', 'sd', NULL, 'sdf', 'No', 'Fiction', 'Upper Advanced', 'sdf', 0, 'sd', '2022-08-12 14:26:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edu_article_audio`
--

CREATE TABLE `edu_article_audio` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_article_audio`
--

INSERT INTO `edu_article_audio` (`id`, `path`, `article_id`) VALUES
(10, 'magazine/iThink/5/12.mp3', 2),
(11, 'magazine/Inspire/1/11.mp3', 3),
(13, 'magazine/iThink/19/abc.mp3', 6),
(14, 'magazine/iThink/19/art2.mp3', 6),
(15, 'magazine/iThink/1/11.mp3', 7),
(16, 'magazine/iThink/1/12.mp3', 7),
(17, 'magazine/iThink/1/abc.mp3', 5),
(18, 'magazine/iThink/1/art2.mp3', 5),
(19, 'magazine/iThink/4/abc.mp3', 8),
(20, 'magazine/iThink/4/art2.mp3', 8),
(25, 'magazine/iThink/31/art2.mp3', 9),
(26, 'magazine/iThink/19/art2.mp3', 25),
(27, 'magazine/iThink/19/art-where_do_i_belong.mp3', 25);

-- --------------------------------------------------------

--
-- Table structure for table `edu_article_audio_dummy`
--

CREATE TABLE `edu_article_audio_dummy` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_article_audio_dummy`
--

INSERT INTO `edu_article_audio_dummy` (`id`, `path`, `article_id`) VALUES
(21, 'magazine/iThink/7/12.mp3', 3),
(22, 'magazine/Inspire/1/11.mp3', 4),
(23, 'magazine/Inspire/1/12.mp3', 4),
(27, 'magazine/iThink/4/12.mp3', 7),
(30, 'magazine/iThink/4/abc.mp3', 10),
(31, 'magazine/iThink/4/art2.mp3', 10),
(38, 'magazine/iThink/4/11.mp3', 29),
(39, 'magazine/iThink/4/12.mp3', 29),
(42, 'magazine/iThink/19/11.mp3', 32),
(43, 'magazine/iThink/19/12.mp3', 32),
(44, 'magazine/iThink/1/11.mp3', 34),
(45, 'magazine/iThink/1/12.mp3', 34);

-- --------------------------------------------------------

--
-- Table structure for table `edu_article_dummy`
--

CREATE TABLE `edu_article_dummy` (
  `article_id` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_published_date` datetime NOT NULL,
  `mag_id` int(11) NOT NULL,
  `article_status` varchar(55) NOT NULL,
  `essay_type_id` int(11) NOT NULL,
  `article_path` varchar(255) DEFAULT NULL,
  `article_image` varchar(255) DEFAULT NULL,
  `article_content` text DEFAULT NULL,
  `article_style` text DEFAULT NULL,
  `audio_path` varchar(255) DEFAULT NULL,
  `art_year` datetime DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `topic_words` varchar(255) DEFAULT NULL,
  `audio_support` varchar(255) DEFAULT NULL,
  `fiction` varchar(255) DEFAULT NULL,
  `difficulty_level` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `word_count` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `issue_no` varchar(55) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_article_dummy`
--

INSERT INTO `edu_article_dummy` (`article_id`, `article_title`, `article_published_date`, `mag_id`, `article_status`, `essay_type_id`, `article_path`, `article_image`, `article_content`, `article_style`, `audio_path`, `art_year`, `theme`, `genre`, `topic_words`, `audio_support`, `fiction`, `difficulty_level`, `description`, `word_count`, `author`, `issue_no`, `last_modified`) VALUES
(3, 'fsd1112', '2022-07-21 12:28:15', 11, 'Active', 9, '', 'magazine/iThink/7/22-42658.p5TDeFd9.jpg', '<p>dsf11</p>\r\n', '', '', '2022-07-23 00:00:00', 'sdf', NULL, 'dsf', 'Yes', 'Fiction', 'Select Level of Difficulty', 'fd', 546, 'ds1', 'iThink 7', '2022-07-21 12:28:15'),
(4, 'Life on the Moon ', '2022-07-04 11:42:33', 48, 'Active', 5, '', 'magazine/Inspire/1/p.jpeg', '<p><img alt=\"\" src=\"ckeditor/../uploads/2222 (1).jpeg\" style=\"height:100%; width:100%\" /></p>\r\n\r\n<div style=\"line-height:40px\">\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">SPACE&hellip;the final frontier. The idea of space colonisation evokes images of peculiar white buildings scattered along a [1]bleak, rocky landscape, the Sun glaring brilliantly at an angle, casting [2]ominous shadows along the rough terrain; the vastness of space all around you, waiting to be conquered.</span></span></span></p>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"line-height:30px\">\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">I have always been curious about what it would be like to experience life on another planet, particularly on the moon. I imagine we would live in [3]sprawling space bases, hulking masses of futuristic architecture; domes interspersed with towers and long corridors and stunning vistas everywhere you look out of the window. Earth would forever remain in the exact same position in the sky, and you would be able to stare into the infinite [4]abyss of space, with countless stars winking at you out of the corner of your eyes. Time would feel different on the moon, where a full day and night cycle actually takes almost a month to occur. It would be a rather [5]surreal experience, to live in extended periods of sunlight and darkness. </span></span></span></p>\r\n</div>\r\n\r\n<p><img alt=\"\" src=\"ckeditor/../uploads/new11.jpg\" style=\"height:100%; width:100%\" /></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">We would have to spend practically all our time indoors, of course, safely insulated from the extreme conditions of space. The surface of the moon [6]fluctuates from a sweltering 100 degrees Celsius in the day, to a frigid -233 Celsius at night. One step outside and your blood would boil or you would freeze to death in an instant. Well, I do not suppose we would have much reason to take walks outside anyway, as there will not be much to</span> <span style=\"font-family:&quot;Arial&quot;,sans-serif\">see on the ground other than moon-rocks and space-dust aplenty. </span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">One of the more fun aspects about moon life would be the reduced gravity. At a sixth of Earth&rsquo;s strength, no longer would we have to walk around in the boring, conventional way, and lifting heavy objects would be [7]a piece of cake. We could bounce ourselves across rooms and our legs would not get tired at all. Our traditional Earth sports would evolve into a bizarre moon version. Imagine playing basketball with hoops six times higher than usual! </span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Of course, it would not be all fun and games. We would have serious work to do on the Moon as well. Many of our jobs would be centred around the colony&rsquo;s sustainability. We would have to generate our own food, maintain our oxygen levels and water supply, recycle our waste, and ensure that the colony continues to function as a self-supported community. After all, the nearest supermarket is almost 385 000 kilometres away! We would need scientists and engineers to operate the sophisticated machinery keeping our environment [8]habitable, agriculturalists to grow our own food in hydroponic greenhouses and researchers to study and monitor our Moon&rsquo;s natural resources.</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">I imagine that by the time space colonisation becomes a reality, we would be eating proper food just like on Earth, with slight differences in our methods of consumption. No longer would we be squeezing &ldquo;baby food&rdquo; out of toothpaste tubes like what astronauts in [9]days of yore had to do. Freeze-dried food from Earth can be rehydrated and served piping hot in thick, compartmentalised, metallic trays that come with magnetic utensils. Thankfully, the presence of gravity on the moon, no matter how minimal, means that meals would be a less messy affair than in the weightlessness of zero gravity. </span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">As we move forward from the 21st century, I hope space travel will become as commonplace as air travel is today. As the idea of space-tourism looms on the horizon, commercial rocket travel and bustling space-stations will no longer remain a [10]figment of our imagination, or a scene out of a science-fiction movie.</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">WORD BANK </span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">1. bleak :</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> (of an area of land) lacking vegetation and exposed to the elements </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">2. ominous</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> : giving the worrying impression that something bad is going to happen in a way designed to make a profit </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">3. sprawling :</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> a group or mass of something that has spread out in an untidy or irregular way </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">4. abyss :</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> a deep or seemingly bottomless chasm </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">5. surreal :</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> something strange that does not seem real </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">6. fluctuates :</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> rises and falls irregularly in number or amount </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">7. a piece of cake :</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> something easily achieved </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">8. habitable</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> : suitable or good enough to live in </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">9. days of yore :</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> of long ago or former times (used in nostalgic or mock-nostalgic recollection) </span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">10. figment of our imagination :</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\"> a thing that some people believe to be real but that exists only in their imagination</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Cambria&quot;,serif\"><strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">bleak, ominous</span></strong><span style=\"font-family:&quot;Arial&quot;,sans-serif\">, <strong>sprawling, abyss, surreal, fluctuates, a piece of cake, habitable</strong>, <strong>days of yore, figment of our imagination</strong></span></span></span></p>\r\n', '', '', '2022-07-28 00:00:00', 'test', 'test', 'test', 'Yes', 'Fiction', 'test', 'test', 777, 'test', 'Inspire 1', '2022-07-04 11:42:33'),
(7, 'test', '2022-07-12 12:39:40', 8, 'Active', 2, '', 'magazine/iThink/4/22-42658.p5TDeFd9.jpg', '<p>erfew</p>\r\n', '', '', '2022-07-14 00:00:00', 'test', NULL, 'test', 'Yes', 'Non-Fiction', 'Select Level of Difficulty', 'sf', 34, 'test', 'iThink 4', '2022-07-12 12:39:40'),
(10, 'ggg', '2022-07-12 13:51:34', 8, 'Active', 1, '', 'magazine/iThink/4/22-42658(1).png', '<p>sd</p>\r\n', '', '', '2022-07-14 00:00:00', 'dsf', NULL, 'dg', 'Yes', 'Fiction', 'Lower Advanced', 'ds', 43, 'dsg', 'iThink 4', '2022-07-12 13:51:34'),
(12, 'dddddd', '2022-07-25 14:49:49', 8, 'Active', 64, '', 'magazine/iThink/4/22-42658(1).png', 'sad', '', '', '2022-07-29 00:00:00', 'test', NULL, 'test', 'No', 'Fiction', 'Upper Advanced', 'sad', 34, 'sda', 'iThink 4', '2022-07-25 14:49:49'),
(13, 'dsfdg', '2022-07-25 16:47:04', 5, 'Active', 15, '', 'magazine/iThink/1/art-camping_equipment.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;dsf</span>', '', '', '2022-07-28 00:00:00', 'test', NULL, 'sdf', 'No', 'Fiction', 'Select Level of Difficulty', 'sdf', 453, 'dsf', 'iThink 1', '2022-07-25 16:47:04'),
(14, 'g', '2022-07-25 16:49:30', 22, 'Active', 65, '', 'magazine/iThink/19/1_Page_04.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;fdg</span>', '', '', '2022-07-29 00:00:00', 'dfg', NULL, 'dfg', 'No', 'Fiction', 'Select Level of Difficulty', 'dg', 345, 'dfg', 'iThink 19', '2022-07-25 16:49:30'),
(15, 'sc', '2022-07-25 16:51:04', 5, 'Active', 66, '', 'magazine/iThink/1/22-42658(1).png', '<span style=\"font-family:Arial; font-size:12px\">&shy;sdf</span>', '', '', '2022-07-27 00:00:00', 'sad', NULL, 'wer', 'No', 'Fiction', 'Select Level of Difficulty', 'dsf', 345, 'sf', 'iThink 1', '2022-07-25 16:51:04'),
(16, 'rgre', '2022-07-25 16:56:01', 5, 'Active', 67, '', 'magazine/iThink/1/20332.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;er</span>', '', '', '2022-07-14 00:00:00', 'ewr', 'test', 'wqe', 'No', 'Fiction', 'Select Level of Difficulty', 'wr', 345, 'er', 'iThink 1', '2022-07-25 16:56:01'),
(17, 'dfg', '2022-07-25 17:01:50', 5, 'Active', 68, '', 'magazine/iThink/1/22-42658.p5TDeFd9.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;dg</span>', '', '', '2022-07-14 00:00:00', 'dg', 'test', 'dg', 'No', 'Fiction', 'Select Level of Difficulty', 'dsg', 4, 'dsg', 'iThink 1', '2022-07-25 17:01:50'),
(18, 'hhf', '2022-07-25 17:02:27', 5, 'Active', 69, '', 'magazine/iThink/1/20332.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;dgsdf</span>', '', '', '2022-07-30 00:00:00', 'dsf', 'test', 'sd', 'Yes', 'Fiction', 'Select Level of Difficulty', 'ds', 435, 'sf', 'iThink 1', '2022-07-25 17:02:27'),
(20, 'fdsf', '2022-07-25 17:03:43', 5, 'Active', 70, '', 'magazine/iThink/1/20332.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;sdf</span>', '', '', '2022-07-28 00:00:00', 'sdf', 'test', 'dg', 'Yes', 'Fiction', 'Select Level of Difficulty', 'dg', 435, 'dg', 'iThink 1', '2022-07-25 17:03:43'),
(21, 'yyyyyyyy', '2022-07-25 17:06:06', 5, 'Active', 68, '', 'magazine/iThink/1/20404.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;df</span>', '', '', '2022-07-20 00:00:00', 'dg', 'test', 'df', 'Yes', 'Fiction', 'Select Level of Difficulty', 'dg', 546, 'd', 'iThink 1', '2022-07-25 17:06:06'),
(22, 'bbbbb', '2022-07-25 17:11:01', 5, 'Active', 71, '', 'magazine/iThink/1/22-42658(1).png', '<span style=\"font-family:Arial; font-size:12px\">&shy;fgd</span>', '', '', '2022-07-28 00:00:00', 'fggg', 'test', 'fg', 'Yes', 'Fiction', 'Select Level of Difficulty', 'fg', 43, 'fg', 'iThink 1', '2022-07-25 17:11:01'),
(23, 'dg', '2022-07-25 17:26:53', 5, 'Active', 72, '', 'magazine/iThink/1/20332.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;df</span>', '', '', '2022-07-29 00:00:00', 'test', 'test', 'gd', 'No', 'Fiction', 'Select Level of Difficulty', 'fd', 456, 'fd', 'iThink 1', '2022-07-25 17:26:53'),
(24, 'bbb', '2022-07-25 17:43:06', 22, 'Active', 73, '', 'magazine/iThink/19/22-42658(1).png', '<span style=\"font-family:Arial; font-size:12px\">&shy;saf</span>', '', '', '2022-07-15 00:00:00', 'saf', 'test', 'sdfa', 'No', 'Fiction', 'Select Level of Difficulty', 'sdaf', 3, 'sa', 'iThink 19', '2022-07-25 17:43:06'),
(26, 'gfdh', '2022-07-25 17:56:43', 22, 'Active', 63, '', 'magazine/iThink/19/20332.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;fd</span>', '', '', '2022-07-30 00:00:00', 'fdg', 'test', 'df', 'No', 'Fiction', 'Select Level of Difficulty', 'fd', 456, 'df', 'iThink 19', '2022-07-25 17:56:43'),
(27, 'lll', '2022-07-25 17:59:34', 22, 'Active', 71, '', 'magazine/iThink/19/22-42658.p5TDeFd9.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;hkhjk</span>', '', '', '2022-07-26 00:00:00', 'bvn', 'test', 'gf', 'No', 'Fiction', 'Select Level of Difficulty', 'fg', 658, 'gf', 'iThink 19', '2022-07-25 17:59:34'),
(28, 'jjk', '2022-07-25 18:01:08', 5, 'Active', 74, '', 'magazine/iThink/1/22-42658(1).png', '<span style=\"font-family:Arial; font-size:12px\">&shy;hjg</span>', '', '', '2022-07-23 00:00:00', 'fgjh', 'test', 'gf', 'No', 'Fiction', 'Select Level of Difficulty', 'gfh', 57657, 'fg', 'iThink 1', '2022-07-25 18:01:08'),
(29, 'Test116', '2022-07-25 18:09:16', 8, 'Active', 75, '', 'magazine/iThink/4/22-42658(1).png', '<span style=\"font-family:Arial; font-size:12px\">&shy;hjgbv</span>', '', '', '2022-07-14 00:00:00', 'bnvm', 'test', 'bnv', 'Yes', 'Fiction', 'Select Level of Difficulty', 'hgj', 547, 'jgh', 'iThink 4', '2022-07-25 18:09:16'),
(31, 'jhgj', '2022-07-25 18:25:57', 5, 'Active', 71, '', 'magazine/iThink/1/22-42658(1).png', '<span style=\"font-family:Arial; font-size:12px\">&shy;fg</span>', '', '', '2022-07-20 00:00:00', 'fgh', 'test', 'fh', 'No', 'Fiction', 'Select Level of Difficulty', 'fdh', 546, 'fhd', 'iThink 1', '2022-07-25 18:25:57'),
(32, 'hgj', '2022-07-25 18:28:03', 22, 'Active', 63, '', 'magazine/iThink/19/22-42658(1).png', '<span style=\"font-family:Arial; font-size:12px\">&shy;fgdh</span>', '', '', '2022-07-21 00:00:00', 'fgh', 'test', 'fdh', 'Yes', 'Fiction', 'Select Level of Difficulty', 'fdh', 0, 'f', 'iThink 19', '2022-07-25 18:28:03'),
(33, 'vvv', '2022-07-25 18:36:16', 69, 'Active', 69, '', 'magazine/iThink/38/art-camping_equipment.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;sdfgdsf</span>', '', '', '2022-07-27 00:00:00', 'sdf', 'test', 'sdf', 'No', 'Fiction', 'Select Level of Difficulty', 'sdf', 46, 'sdf', 'iThink 38', '2022-07-25 18:36:16'),
(34, 'hhfg', '2022-07-25 18:37:05', 5, 'Active', 76, '', 'magazine/iThink/1/22-42658(1).png', '<span style=\"font-family:Arial; font-size:12px\">&shy;ghj</span>', '', '', '2022-07-28 00:00:00', 'cgb', 'test', 'fgh', 'Yes', 'Fiction', 'Select Level of Difficulty', 'vbn', 567, 'fgh', 'iThink 1', '2022-07-25 18:37:05'),
(35, 'fdghsf', '2022-07-25 18:40:12', 22, 'Active', 77, '', 'magazine/iThink/19/22-42658(1).png', '<span style=\"font-family:Arial; font-size:12px\">&shy;sedf</span>', '', '', '2022-07-28 00:00:00', 'dsf', 'test', 'sdf', 'No', 'Fiction', 'Select Level of Difficulty', 'sdf', 456, 'dsf', 'iThink 19', '2022-07-25 18:40:12'),
(36, 'bfdhb', '2022-07-25 18:50:44', 5, 'Active', 71, '', 'magazine/iThink/1/20332.jpg', '<span style=\"font-family:Arial; font-size:12px\">&shy;fgh</span>', '', '', '2022-07-13 00:00:00', 'fgh', 'test', 'fg', 'No', 'Fiction', 'Select Level of Difficulty', 'fg', 436, 'fg', 'iThink 1', '2022-07-25 18:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `edu_bookmarkfolder`
--

CREATE TABLE `edu_bookmarkfolder` (
  `id` int(11) NOT NULL,
  `foldnameid` int(11) NOT NULL,
  `folder_color` varchar(255) NOT NULL,
  `status` varchar(55) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_bookmarkfolder`
--

INSERT INTO `edu_bookmarkfolder` (`id`, `foldnameid`, `folder_color`, `status`, `created_by`, `created_date`) VALUES
(45, 17, '#ffafa4', 'Active', 1, '2022-08-10 21:53:44'),
(46, 18, '#fec470', 'Active', 626, '2022-08-10 21:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `edu_bookmark_type`
--

CREATE TABLE `edu_bookmark_type` (
  `id` int(11) NOT NULL,
  `bookmark_type` varchar(255) NOT NULL,
  `status` varchar(55) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_bookmark_type`
--

INSERT INTO `edu_bookmark_type` (`id`, `bookmark_type`, `status`, `created_by`, `created_date`) VALUES
(17, 'test', 'Active', 1, '2022-08-10 21:53:44'),
(18, 'gen', 'Active', 626, '2022-08-10 21:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `edu_chat_message`
--

CREATE TABLE `edu_chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `edu_class`
--

CREATE TABLE `edu_class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `school_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `class_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_class`
--

INSERT INTO `edu_class` (`class_id`, `class_name`, `school_id`, `level_id`, `class_status`) VALUES
(67, '2D', 45, 53, 'Active'),
(68, '2E', 45, 53, 'Active'),
(69, '3A', 45, 54, 'Active'),
(72, '3F', 46, 55, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `edu_comments`
--

CREATE TABLE `edu_comments` (
  `comment_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `comments_published_date` datetime NOT NULL,
  `comment_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_comment_replies`
--

CREATE TABLE `edu_comment_replies` (
  `comment_replies_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `comment_replies` text NOT NULL,
  `comment_replies_published_date` datetime NOT NULL,
  `comment_replies_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_content_tracking`
--

CREATE TABLE `edu_content_tracking` (
  `content_track_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `content_progress_status` varchar(55) NOT NULL,
  `content_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_country`
--

CREATE TABLE `edu_country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_country`
--

INSERT INTO `edu_country` (`country_id`, `country_name`, `country_status`) VALUES
(1, 'Afghanistan', 'Active'),
(2, 'Aland Islands', 'Active'),
(3, 'Albania', 'Active'),
(4, 'Algeria', 'Active'),
(5, 'American Samoa', 'Active'),
(6, 'Andorra', 'Active'),
(7, 'Angola', 'Active'),
(8, 'Anguilla', 'Active'),
(9, 'Antarctica', 'Active'),
(10, 'Antigua and Barbuda', 'Active'),
(11, 'Argentina', 'Active'),
(12, 'Armenia', 'Active'),
(13, 'Aruba', 'Active'),
(14, 'Australia', 'Active'),
(15, 'Austria', 'Active'),
(16, 'Azerbaijan', 'Active'),
(17, 'Bahamas', 'Active'),
(18, 'Bahrain', 'Active'),
(19, 'Bangladesh', 'Active'),
(20, 'Barbados', 'Active'),
(21, 'Belarus', 'Active'),
(22, 'Belgium', 'Active'),
(23, 'Belize', 'Active'),
(24, 'Benin', 'Active'),
(25, 'Bermuda', 'Active'),
(26, 'Bhutan', 'Active'),
(27, 'Bolivia', 'Active'),
(28, 'Bonaire, Sint Eustatius and Saba', 'Active'),
(29, 'Bosnia and Herzegovina', 'Active'),
(30, 'Botswana', 'Active'),
(31, 'Bouvet Island', 'Active'),
(32, 'Brazil', 'Active'),
(33, 'British Indian Ocean Territory', 'Active'),
(34, 'Brunei Darussalam', 'Active'),
(35, 'Bulgaria', 'Active'),
(36, 'Burkina Faso', 'Active'),
(37, 'Burundi', 'Active'),
(38, 'Cambodia', 'Active'),
(39, 'Cameroon', 'Active'),
(40, 'Canada', 'Active'),
(41, 'Cape Verde', 'Active'),
(42, 'Cayman Islands', 'Active'),
(43, 'Central African Republic', 'Active'),
(44, 'Chad', 'Active'),
(45, 'Chile', 'Active'),
(46, 'China', 'Active'),
(47, 'Christmas Island', 'Active'),
(48, 'Cocos (Keeling) Islands', 'Active'),
(49, 'Colombia', 'Active'),
(50, 'Comoros', 'Active'),
(51, 'Congo', 'Active'),
(52, 'Congo, Democratic Republic of the Congo', 'Active'),
(53, 'Cook Islands', 'Active'),
(54, 'Costa Rica', 'Active'),
(55, 'Cote D\'Ivoire', 'Active'),
(56, 'Croatia', 'Active'),
(57, 'Cuba', 'Active'),
(58, 'Curacao', 'Active'),
(59, 'Cyprus', 'Active'),
(60, 'Czech Republic', 'Active'),
(61, 'Denmark', 'Active'),
(62, 'Djibouti', 'Active'),
(63, 'Dominica', 'Active'),
(64, 'Dominican Republic', 'Active'),
(65, 'Ecuador', 'Active'),
(66, 'Egypt', 'Active'),
(67, 'El Salvador', 'Active'),
(68, 'Equatorial Guinea', 'Active'),
(69, 'Eritrea', 'Active'),
(70, 'Estonia', 'Active'),
(71, 'Ethiopia', 'Active'),
(72, 'Falkland Islands (Malvinas)', 'Active'),
(73, 'Faroe Islands', 'Active'),
(74, 'Fiji', 'Active'),
(75, 'Finland', 'Active'),
(76, 'France', 'Active'),
(77, 'French Guiana', 'Active'),
(78, 'French Polynesia', 'Active'),
(79, 'French Southern Territories', 'Active'),
(80, 'Gabon', 'Active'),
(81, 'Gambia', 'Active'),
(82, 'Georgia', 'Active'),
(83, 'Germany', 'Active'),
(84, 'Ghana', 'Active'),
(85, 'Gibraltar', 'Active'),
(86, 'Greece', 'Active'),
(87, 'Greenland', 'Active'),
(88, 'Grenada', 'Active'),
(89, 'Guadeloupe', 'Active'),
(90, 'Guam', 'Active'),
(91, 'Guatemala', 'Active'),
(92, 'Guernsey', 'Active'),
(93, 'Guinea', 'Active'),
(94, 'Guinea-Bissau', 'Active'),
(95, 'Guyana', 'Active'),
(96, 'Haiti', 'Active'),
(97, 'Heard Island and Mcdonald Islands', 'Active'),
(98, 'Holy See (Vatican City State)', 'Active'),
(99, 'Honduras', 'Active'),
(100, 'Hong Kong', 'Active'),
(101, 'Hungary', 'Active'),
(102, 'Iceland', 'Active'),
(103, 'India', 'Active'),
(104, 'Indonesia', 'Active'),
(105, 'Iran, Islamic Republic of', 'Active'),
(106, 'Iraq', 'Active'),
(107, 'Ireland', 'Active'),
(108, 'Isle of Man', 'Active'),
(109, 'Israel', 'Active'),
(110, 'Italy', 'Active'),
(111, 'Jamaica', 'Active'),
(112, 'Japan', 'Active'),
(113, 'Jersey', 'Active'),
(114, 'Jordan', 'Active'),
(115, 'Kazakhstan', 'Active'),
(116, 'Kenya', 'Active'),
(117, 'Kiribati', 'Active'),
(118, 'Korea, Democratic People\'s Republic of', 'Active'),
(119, 'Korea, Republic of', 'Active'),
(120, 'Kosovo', 'Active'),
(121, 'Kuwait', 'Active'),
(122, 'Kyrgyzstan', 'Active'),
(123, 'Lao People\'s Democratic Republic', 'Active'),
(124, 'Latvia', 'Active'),
(125, 'Lebanon', 'Active'),
(126, 'Lesotho', 'Active'),
(127, 'Liberia', 'Active'),
(128, 'Libyan Arab Jamahiriya', 'Active'),
(129, 'Liechtenstein', 'Active'),
(130, 'Lithuania', 'Active'),
(131, 'Luxembourg', 'Active'),
(132, 'Macao', 'Active'),
(133, 'Macedonia, the Former Yugoslav Republic of', 'Active'),
(134, 'Madagascar', 'Active'),
(135, 'Malawi', 'Active'),
(136, 'Malaysia', 'Active'),
(137, 'Maldives', 'Active'),
(138, 'Mali', 'Active'),
(139, 'Malta', 'Active'),
(140, 'Marshall Islands', 'Active'),
(141, 'Martinique', 'Active'),
(142, 'Mauritania', 'Active'),
(143, 'Mauritius', 'Active'),
(144, 'Mayotte', 'Active'),
(145, 'Mexico', 'Active'),
(146, 'Micronesia, Federated States of', 'Active'),
(147, 'Moldova, Republic of', 'Active'),
(148, 'Monaco', 'Active'),
(149, 'Mongolia', 'Active'),
(150, 'Montenegro', 'Active'),
(151, 'Montserrat', 'Active'),
(152, 'Morocco', 'Active'),
(153, 'Mozambique', 'Active'),
(154, 'Myanmar', 'Active'),
(155, 'Namibia', 'Active'),
(156, 'Nauru', 'Active'),
(157, 'Nepal', 'Active'),
(158, 'Netherlands', 'Active'),
(159, 'Netherlands Antilles', 'Active'),
(160, 'New Caledonia', 'Active'),
(161, 'New Zealand', 'Active'),
(162, 'Nicaragua', 'Active'),
(163, 'Niger', 'Active'),
(164, 'Nigeria', 'Active'),
(165, 'Niue', 'Active'),
(166, 'Norfolk Island', 'Active'),
(167, 'Northern Mariana Islands', 'Active'),
(168, 'Norway', 'Active'),
(169, 'Oman', 'Active'),
(170, 'Pakistan', 'Active'),
(171, 'Palau', 'Active'),
(172, 'Palestinian Territory, Occupied', 'Active'),
(173, 'Panama', 'Active'),
(174, 'Papua New Guinea', 'Active'),
(175, 'Paraguay', 'Active'),
(176, 'Peru', 'Active'),
(177, 'Philippines', 'Active'),
(178, 'Pitcairn', 'Active'),
(179, 'Poland', 'Active'),
(180, 'Portugal', 'Active'),
(181, 'Puerto Rico', 'Active'),
(182, 'Qatar', 'Active'),
(183, 'Reunion', 'Active'),
(184, 'Romania', 'Active'),
(185, 'Russian Federation', 'Active'),
(186, 'Rwanda', 'Active'),
(187, 'Saint Barthelemy', 'Active'),
(188, 'Saint Helena', 'Active'),
(189, 'Saint Kitts and Nevis', 'Active'),
(190, 'Saint Lucia', 'Active'),
(191, 'Saint Martin', 'Active'),
(192, 'Saint Pierre and Miquelon', 'Active'),
(193, 'Saint Vincent and the Grenadines', 'Active'),
(194, 'Samoa', 'Active'),
(195, 'San Marino', 'Active'),
(196, 'Sao Tome and Principe', 'Active'),
(197, 'Saudi Arabia', 'Active'),
(198, 'Senegal', 'Active'),
(199, 'Serbia', 'Active'),
(200, 'Serbia and Montenegro', 'Active'),
(201, 'Seychelles', 'Active'),
(202, 'Sierra Leone', 'Active'),
(203, 'Singapore', 'Active'),
(204, 'Sint Maarten', 'Active'),
(205, 'Slovakia', 'Active'),
(206, 'Slovenia', 'Active'),
(207, 'Solomon Islands', 'Active'),
(208, 'Somalia', 'Active'),
(209, 'South Africa', 'Active'),
(210, 'South Georgia and the South Sandwich Islands', 'Active'),
(211, 'South Sudan', 'Active'),
(212, 'Spain', 'Active'),
(213, 'Sri Lanka', 'Active'),
(214, 'Sudan', 'Active'),
(215, 'Suriname', 'Active'),
(216, 'Svalbard and Jan Mayen', 'Active'),
(217, 'Swaziland', 'Active'),
(218, 'Sweden', 'Active'),
(219, 'Switzerland', 'Active'),
(220, 'Syrian Arab Republic', 'Active'),
(221, 'Taiwan, Province of China', 'Active'),
(222, 'Tajikistan', 'Active'),
(223, 'Tanzania, United Republic of', 'Active'),
(224, 'Thailand', 'Active'),
(225, 'Timor-Leste', 'Active'),
(226, 'Togo', 'Active'),
(227, 'Tokelau', 'Active'),
(228, 'Tonga', 'Active'),
(229, 'Trinidad and Tobago', 'Active'),
(230, 'Tunisia', 'Active'),
(231, 'Turkey', 'Active'),
(232, 'Turkmenistan', 'Active'),
(233, 'Turks and Caicos Islands', 'Active'),
(234, 'Tuvalu', 'Active'),
(235, 'Uganda', 'Active'),
(236, 'Ukraine', 'Active'),
(237, 'United Arab Emirates', 'Active'),
(238, 'United Kingdom', 'Active'),
(239, 'United States', 'Active'),
(240, 'United States Minor Outlying Islands', 'Active'),
(241, 'Uruguay', 'Active'),
(242, 'Uzbekistan', 'Active'),
(243, 'Vanuatu', 'Active'),
(244, 'Venezuela', 'Active'),
(245, 'Viet Nam', 'Active'),
(246, 'Virgin Islands, British', 'Active'),
(247, 'Virgin Islands, U.s.', 'Active'),
(248, 'Wallis and Futuna', 'Active'),
(249, 'Western Sahara', 'Active'),
(250, 'Yemen', 'Active'),
(251, 'Zambia', 'Active'),
(252, 'Zimbabwe', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `edu_essay_type`
--

CREATE TABLE `edu_essay_type` (
  `essay_type_id` int(11) NOT NULL,
  `essay_type` varchar(255) NOT NULL,
  `essay_type_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_essay_type`
--

INSERT INTO `edu_essay_type` (`essay_type_id`, `essay_type`, `essay_type_status`) VALUES
(1, 'Descriptive', 'Active'),
(2, 'Narrative', 'Active'),
(3, 'Expository', 'Active'),
(4, 'Argumentative', 'Active'),
(5, 'Personal Recount', 'Active'),
(6, 'Hybrid', 'Active'),
(7, 'Reflective / Personal Response', 'Active'),
(8, 'Model Me', 'Active'),
(9, 'Tweak Me', 'Active'),
(10, 'FollowMe', 'Active'),
(11, 'HeyListen', 'Active'),
(12, 'Intermediate', 'Active'),
(13, 'Advanced', 'Active'),
(14, 'Discursive', 'Active'),
(15, 'Narrative Essay', 'Active'),
(16, 'Expository (Discursive)', 'Active'),
(17, 'Informative', 'Active'),
(18, 'Informative Text', 'Active'),
(19, 'Informal Interview/ Personal Recount', 'Active'),
(20, 'Informal Interview/ Personal Opinion', 'Active'),
(21, 'Informative (poster)/ Situational (Proposal)', 'Active'),
(22, 'Situational Writing', 'Active'),
(23, 'Non-narrative/ factual - expository', 'Active'),
(24, 'Hybrid (Argumentative - Narrative)', 'Active'),
(25, 'Hybrid (discursive - descriptive)', 'Active'),
(26, 'Others', 'Active'),
(27, 'Other (Fiction Text A)', 'Active'),
(28, 'Other (Fiction Text B)', 'Active'),
(29, 'Other (Non-Fiction Text A)', 'Active'),
(30, 'Other (Non-Fiction Text B)', 'Active'),
(31, 'Other (LangWorld', 'Active'),
(32, 'Other (Picture It)', 'Active'),
(33, 'Other (Follow Me/Fiction Text)', 'Active'),
(34, 'Other (Follow Me/Non-Fiction Text)', 'Active'),
(35, 'Other (Hey Listen/Listening)', 'Active'),
(36, 'Other (Speak Up/Oral)', 'Active'),
(37, 'Other (Wanderlust)', 'Active'),
(38, 'Others (informative interview)', 'Active'),
(39, 'Others (speech)', 'Active'),
(40, 'Others (conversation)', 'Active'),
(41, 'Others (exercise)', 'Active'),
(42, 'Others (Fiction)', 'Active'),
(43, 'Others (travel)', 'Active'),
(44, 'Others (Newsletter Article)', 'Active'),
(45, 'Others (formal letter)', 'Active'),
(46, 'Others (Grammar)', 'Active'),
(47, 'Others (Situational Writing)', 'Active'),
(48, 'Others (Language)', 'Active'),
(49, 'Others (listening)', 'Active'),
(62, 'test demo', 'Active'),
(63, 'fd', 'Active'),
(64, 'sad', 'Active'),
(65, 'd', 'Active'),
(66, 'df', 'Active'),
(67, 'weq', 'Active'),
(68, 'dg', 'Active'),
(69, 'sdf', 'Active'),
(70, 'dgf', 'Active'),
(71, 'fg', 'Active'),
(72, 'fdg', 'Active'),
(73, 'saf', 'Active'),
(74, 'gf', 'Active'),
(75, 'bvn', 'Active'),
(76, 'fgh', 'Active'),
(77, 'dsf', 'Active'),
(78, 'dfg', 'Active'),
(79, 'fh', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `edu_faq`
--

CREATE TABLE `edu_faq` (
  `faq_id` int(11) NOT NULL,
  `faq_type` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_faq`
--

INSERT INTO `edu_faq` (`faq_id`, `faq_type`, `title`, `content`, `status`) VALUES
(1, 1, 'What do the colors mean?', 'These colors are used across Edutique, so you should be familiar with them as time goes by!Generally here are the colors seen in the platform,used to indicate\r\n the completion of activities.\r\n Orange:Overdue(applies to readings/activities that have been assigned by your teacher)\r\n Yellow:Incomplete\r\n Green:Completed\r\n Gray:Unopened\r\n A Dark Purple is also used inthe calendar to represent events.', 'Active'),
(2, 2, 'What do the colors mean?', 'These colors are used across Edutique, so you should be familiar with them as time goes by!Generally here are the colors seen in the platform,used to indicate\r\n the completion of activities.\r\n Orange:Overdue(applies to readings/activities that have been assigned by your teacher)\r\n Yellow:Incomplete\r\n Green:Completed\r\n Gray:Unopened\r\n A Dark Purple is also used inthe calendar to represent events.', 'Active'),
(3, 1, 'How do I access answers for activities', 'The suggested answers will be rewarded along with detailed explanation once you have completed an activity, However if you have suscribed through Edutique to your school and your\r\n teacher has chosen to hide the suggested answers, you will only be able to view them once your teacher has granted access to them\r\n', 'Active'),
(4, 1, 'I need help with my work.Who can I ask?', 'You can click on the \"Ask Question\" button when attempting an activity or reading an article to send a question.Alternatively you cann access the Question Portal\r\ndireclty from the dashbaord.Your questions will be sent to your teacher(if you subscribed to Edutique through your school)or our team (consisting of our ex-English \r\nlanguage HODs and masster teachers), and they will answer your questions as soon as possible!', 'Active'),
(5, 1, 'What can I download?', 'Activity worksheets and your progress reports can be downloaded at  any time. Content such as articles,complete magazine issues and language games cannot be \r\ndownloaded.', 'Active'),
(6, 2, 'How do I access answers for activities', 'The suggested answers will be rewarded along with detailed explanation once you have completed an activity, However if you have suscribed through Edutique to your school and your\r\n teacher has chosen to hide the suggested answers, you will only be able to view them once your teacher has granted access to them', 'Active'),
(7, 2, 'I need help with my work.Who can I ask?', 'You can click on the \"Ask Question\" button when attempting an activity or reading an article to send a question.Alternatively you cann access the Question Portal\r\ndireclty from the dashbaord.Your questions will be sent to your teacher(if you subscribed to Edutique through your school)or our team (consisting of our ex-English \r\nlanguage HODs and masster teachers), and they will answer your questions as soon as possible!', 'Active'),
(8, 2, 'What can I download?', 'Activity worksheets and your progress reports can be downloaded at  any time. Content such as articles,complete magazine issues and language games cannot be \r\ndownloaded.', 'Active'),
(9, 3, 'Can I add or remove students from my class?', 'Yes, you can add,remove and suspend students from your class (es). This ensures that if you need to make changes to your class(es) when students transfer in or out, the process is seamless.', 'Active'),
(10, 3, 'Can I assign activities to my students based on their abilities?', 'Yes, Edutique allows for customization of your lessons plan to suit students of different ability levels. You can assign readings and activities to individual students if needed,\r\nmultiple students, or even to your entire class.', 'Active'),
(11, 3, 'How are activities marked?', 'Auto marking will be available for listening comprehension  and editing activities. As commercial language AI  has not reached a level that can evaluate the English \r\nlanguage as of yet, suggested answers will be provided for open ended questions(such as essays and reading comprehension) instead, along with detailed \r\nexplanation. Educators such as yourself can also choose to mark questions.', 'Active'),
(12, 3, 'What is the question portal for? Who can reach out to me via the Question Portal?', 'The question portal is a platform that your students can use to send questions to you if they encounter difficulties while reading the articles or attempting the activities.\r\n You can then reply to their questions via the Question Portal. Questions submitted my students in your classes will be sent to you via the Question Portal. If you prefer not to\r\n recieve such questions, you can disable this feature by turning off the \'Reciever Questions\' option whenever assigning the task and your students questions will be subsequently \r\n be directed to our team, which consists of ex- English language HOD\'s and master classes.', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `edu_faq_type`
--

CREATE TABLE `edu_faq_type` (
  `id` int(11) NOT NULL,
  `faq_type` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_faq_type`
--

INSERT INTO `edu_faq_type` (`id`, `faq_type`, `status`) VALUES
(1, 'Students', 'Active'),
(2, 'Parents', 'Active'),
(3, 'Educators', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `edu_feedback`
--

CREATE TABLE `edu_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `feed_status` varchar(55) NOT NULL,
  `feedback_published_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `emotions` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_feedback`
--

INSERT INTO `edu_feedback` (`feedback_id`, `feedback`, `feed_status`, `feedback_published_date`, `user_id`, `mag_id`, `article_id`, `activity_id`, `emotions`) VALUES
(41, 'Tough to answer', 'Active', '2022-07-05 15:59:09', 208, 5, 4, 1, 'neutral'),
(42, 'good', 'Active', '2022-08-29 18:16:14', 632, 5, 4, 68, 'neutral'),
(43, 'very easy', 'Active', '2022-09-03 00:28:33', 632, 5, 4, 72, 'easy'),
(44, 'very easy', 'Active', '2022-09-03 02:07:24', 632, 5, 4, 73, 'easy'),
(45, 'easy', 'Active', '2022-09-03 02:14:02', 632, 5, 4, 75, 'easy'),
(46, 'easy', 'Active', '2022-09-03 02:19:17', 632, 5, 4, 76, 'easy'),
(47, 'easy', 'Active', '2022-09-03 02:23:51', 632, 5, 4, 77, 'easy'),
(48, 'easy', 'Active', '2022-09-03 02:32:49', 632, 5, 4, 78, 'easy'),
(49, 'easy', 'Active', '2022-09-10 18:14:53', 632, 5, 4, 78, 'easy'),
(50, 'ddddddddddd', 'Active', '2022-09-12 14:39:16', 632, 5, 4, 78, 'neutral'),
(51, 'easy', 'Active', '2022-09-15 19:15:12', 664, 5, 0, 106, 'easy');

-- --------------------------------------------------------

--
-- Table structure for table `edu_levels`
--

CREATE TABLE `edu_levels` (
  `level_id` int(11) NOT NULL,
  `level` varchar(55) NOT NULL,
  `level_status` varchar(55) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_levels`
--

INSERT INTO `edu_levels` (`level_id`, `level`, `level_status`, `school_id`) VALUES
(53, 'Secondary 2', 'Active', 45),
(54, 'Secondary 3', 'Active', 45),
(55, 'Secondary 3', 'Active', 46);

-- --------------------------------------------------------

--
-- Table structure for table `edu_level_class_temp`
--

CREATE TABLE `edu_level_class_temp` (
  `id` int(11) NOT NULL,
  `levelname` varchar(255) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `level_id` int(11) NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `school_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_level_class_temp`
--

INSERT INTO `edu_level_class_temp` (`id`, `levelname`, `class_name`, `level_id`, `class_id`, `school_id`, `user_id`) VALUES
(1230, 'Secondary 1', '1A', 42, '56', 38, 207),
(1231, 'Secondary 1', '1A', 42, '56', 38, 207),
(1232, 'Secondary 1', '1A', 42, '56', 38, 207),
(1233, 'Secondary 1', '1A', 45, '61', 44, 626),
(1234, 'Secondary 1', '1A', 45, '61', 44, 626),
(1235, 'Secondary 1', '1A', 45, '61', 44, 626),
(1236, 'Secondary 1', '1A', 45, '61', 44, 626),
(1237, 'Secondary 1', '1A', 45, '61', 44, 626),
(1238, 'Secondary 1', '1A', 45, '61', 44, 626),
(1239, 'Secondary 1', '1A', 45, '61', 44, 626),
(1240, 'Secondary 1', '1A', 45, '61', 44, 626),
(1241, 'Secondary 1', '1A', 45, '61', 44, 626),
(1242, 'Secondary 1', '1A', 45, '61', 44, 626),
(1243, 'Secondary 1', '1A', 45, '61', 44, 626),
(1244, 'Secondary 2', '2A', 50, '63', 44, 626),
(1245, 'Secondary 2', '2A', 43, '59', 42, 631),
(1246, 'Secondary 2', '2A', 43, '59', 42, 631),
(1247, 'Secondary 2', '2A', 43, '59', 42, 631),
(1248, 'Secondary 2', '2A', 43, '59', 42, 631),
(1249, 'Secondary 2', '2A', 43, '59', 42, 631),
(1250, 'Secondary 2', '2A', 43, '59', 42, 631),
(1251, 'Secondary 2', '2A', 43, '59', 42, 631),
(1252, 'Secondary 2', '2A', 43, '59', 42, 631),
(1253, 'Secondary 2', '2A', 43, '59', 42, 631),
(1254, 'Secondary 2', '2A', 43, '59', 42, 631),
(1255, 'Secondary 2', '2A', 43, '59', 42, 631),
(1256, 'Secondary 2', '2A', 43, '59', 42, 631),
(1257, 'Secondary 2', '2A', 43, '59', 42, 631),
(1258, 'Secondary 2', '2A', 43, '59', 42, 631),
(1259, 'Secondary 2', '2A', 43, '59', 42, 631),
(1260, 'Secondary 2', '2A', 43, '59', 42, 631),
(1261, 'Secondary 2', '2A', 43, '59', 42, 631),
(1262, 'Secondary 2', '2A', 43, '59', 42, 631),
(1263, 'Secondary 2', '2A', 43, '59', 42, 631),
(1264, 'Secondary 2', '2A', 43, '59', 42, 631),
(1265, 'Secondary 2', '2A', 43, '59', 42, 631),
(1266, 'Secondary 2', '2A', 43, '59', 42, 631);

-- --------------------------------------------------------

--
-- Table structure for table `edu_log`
--

CREATE TABLE `edu_log` (
  `log_id` int(11) NOT NULL,
  `log_entry` text NOT NULL,
  `log_entry_date` datetime NOT NULL,
  `log_entry_status` varchar(55) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_log`
--

INSERT INTO `edu_log` (`log_id`, `log_entry`, `log_entry_date`, `log_entry_status`, `user_id`) VALUES
(495, 'Logged in to the Edutique System', '2022-06-26 17:23:12', 'Active', 1),
(496, 'Logged in to the Edutique System', '2022-06-27 17:06:01', 'Active', 1),
(497, 'Logged in to the Edutique System', '2022-06-28 20:34:51', 'Active', 1),
(498, 'Logged in to the Edutique System', '2022-06-29 14:09:06', 'Active', 1),
(499, 'Logged in to the Edutique System', '2022-06-29 22:57:30', 'Active', 1),
(500, 'Logged in to the Edutique System', '2022-06-30 19:39:51', 'Active', 1),
(501, 'Logged in to the Edutique System', '2022-07-01 08:46:22', 'Active', 1),
(502, 'Logged in to the Edutique System', '2022-07-01 17:44:56', 'Active', 1),
(503, 'Logged in to the Edutique System', '2022-07-02 14:16:08', 'Active', 3),
(504, 'Logged in to the Edutique System', '2022-07-03 19:39:19', 'Active', 1),
(505, 'Logged in to the Edutique System', '2022-07-03 23:32:04', 'Active', 1),
(506, 'Logged in to the Edutique System', '2022-07-04 11:35:19', 'Active', 1),
(507, 'Logged in to the Edutique System', '2022-07-04 13:15:29', 'Active', 1),
(508, 'Logged in to the Edutique System', '2022-07-04 14:37:44', 'Active', 3),
(509, 'Logged in to the Edutique System', '2022-07-04 14:57:48', 'Active', 1),
(510, 'Logged in to the Edutique System', '2022-07-04 15:02:16', 'Active', 204),
(511, 'Password updated', '2022-07-04 15:02:34', 'Active', 204),
(512, 'Logged in to the Edutique System', '2022-07-04 15:03:40', 'Active', 203),
(513, 'Password updated', '2022-07-04 15:03:56', 'Active', 203),
(514, 'Logged in to the Edutique System', '2022-07-05 14:34:29', 'Active', 1),
(515, 'Logged in to the Edutique System', '2022-07-05 15:34:36', 'Active', 1),
(516, 'Logged in to the Edutique System', '2022-07-05 15:39:49', 'Active', 207),
(517, 'Password updated', '2022-07-05 15:40:30', 'Active', 207),
(518, 'Logged in to the Edutique System', '2022-07-05 15:51:48', 'Active', 208),
(519, 'Password updated', '2022-07-05 15:52:02', 'Active', 208),
(520, 'Logged in to the Edutique System', '2022-07-05 15:55:07', 'Active', 1),
(521, 'Logged in to the Edutique System', '2022-07-05 15:57:08', 'Active', 208),
(522, 'Logged in to the Edutique System', '2022-07-05 18:35:50', 'Active', 1),
(523, 'Logged in to the Edutique System', '2022-07-06 13:12:16', 'Active', 1),
(524, 'Logged in to the Edutique System', '2022-07-06 19:14:30', 'Active', 1),
(525, 'Logged in to the Edutique System', '2022-07-06 23:14:45', 'Active', 208),
(526, 'Logged in to the Edutique System', '2022-07-07 03:10:33', 'Active', 208),
(527, 'Logged in to the Edutique System', '2022-07-07 03:22:35', 'Active', 208),
(528, 'Logged in to the Edutique System', '2022-07-07 03:23:19', 'Active', 1),
(529, 'Logged in to the Edutique System', '2022-07-07 03:24:31', 'Active', 208),
(530, 'Logged in to the Edutique System', '2022-07-07 14:29:44', 'Active', 1),
(531, 'Logged in to the Edutique System', '2022-07-07 20:04:34', 'Active', 1),
(532, 'Logged in to the Edutique System', '2022-07-08 12:34:42', 'Active', 1),
(533, 'Logged in to the Edutique System', '2022-07-08 14:42:48', 'Active', 208),
(534, 'Logged in to the Edutique System', '2022-07-08 14:50:36', 'Active', 1),
(535, 'Logged in to the Edutique System', '2022-07-08 19:40:08', 'Active', 1),
(536, 'Logged in to the Edutique System', '2022-07-09 14:10:13', 'Active', 1),
(537, 'Logged in to the Edutique System', '2022-07-09 17:54:40', 'Active', 1),
(538, 'Logged in to the Edutique System', '2022-07-09 18:26:18', 'Active', 208),
(539, 'Logged in to the Edutique System', '2022-07-09 18:48:11', 'Active', 1),
(540, 'Logged in to the Edutique System', '2022-07-11 12:43:23', 'Active', 1),
(541, 'Logged in to the Edutique System', '2022-07-12 12:37:21', 'Active', 1),
(542, 'Logged in to the Edutique System', '2022-07-12 15:10:10', 'Active', 1),
(543, 'Logged in to the Edutique System', '2022-07-12 15:32:57', 'Active', 208),
(544, 'Logged in to the Edutique System', '2022-07-12 15:33:32', 'Active', 1),
(545, 'Logged in to the Edutique System', '2022-07-12 19:04:09', 'Active', 214),
(546, 'Logged in to the Edutique System', '2022-07-13 12:41:57', 'Active', 1),
(547, 'Logged in to the Edutique System', '2022-07-14 12:51:12', 'Active', 207),
(548, 'Logged in to the Edutique System', '2022-07-14 14:29:02', 'Active', 1),
(549, 'Logged in to the Edutique System', '2022-07-14 17:11:31', 'Active', 1),
(550, 'Logged in to the Edutique System', '2022-07-14 19:07:10', 'Active', 207),
(551, 'Logged in to the Edutique System', '2022-07-15 13:12:45', 'Active', 1),
(552, 'Logged in to the Edutique System', '2022-07-15 16:00:23', 'Active', 207),
(553, 'Logged in to the Edutique System', '2022-07-15 18:32:03', 'Active', 208),
(554, 'Logged in to the Edutique System', '2022-07-15 19:09:26', 'Active', 1),
(555, 'Logged in to the Edutique System', '2022-07-15 19:10:53', 'Active', 207),
(556, 'Logged in to the Edutique System', '2022-07-15 19:29:20', 'Active', 1),
(557, 'Logged in to the Edutique System', '2022-07-15 19:51:43', 'Active', 208),
(558, 'Logged in to the Edutique System', '2022-07-15 19:52:12', 'Active', 1),
(559, 'Logged in to the Edutique System', '2022-07-16 12:51:49', 'Active', 1),
(560, 'Logged in to the Edutique System', '2022-07-18 13:22:45', 'Active', 1),
(561, 'Logged in to the Edutique System', '2022-07-18 18:05:45', 'Active', 1),
(562, 'Logged in to the Edutique System', '2022-07-19 13:36:17', 'Active', 1),
(563, 'Logged in to the Edutique System', '2022-07-19 15:26:37', 'Active', 1),
(564, 'Logged in to the Edutique System', '2022-07-19 19:42:48', 'Active', 1),
(565, 'Logged in to the Edutique System', '2022-07-19 20:28:54', 'Active', 1),
(566, 'Logged in to the Edutique System', '2022-07-20 00:57:53', 'Active', 1),
(567, 'Logged in to the Edutique System', '2022-07-20 01:17:14', 'Active', 561),
(568, 'Password updated', '2022-07-20 01:17:36', 'Active', 561),
(569, 'Logged in to the Edutique System', '2022-07-20 02:01:53', 'Active', 1),
(570, 'Logged in to the Edutique System', '2022-07-20 02:14:50', 'Active', 561),
(571, 'Logged in to the Edutique System', '2022-07-20 02:18:58', 'Active', 1),
(572, 'Logged in to the Edutique System', '2022-07-20 14:49:45', 'Active', 1),
(573, 'Logged in to the Edutique System', '2022-07-20 19:28:03', 'Active', 561),
(574, 'Logged in to the Edutique System', '2022-07-20 19:35:07', 'Active', 1),
(575, 'Logged in to the Edutique System', '2022-07-20 19:41:48', 'Active', 561),
(576, 'Logged in to the Edutique System', '2022-07-20 19:49:39', 'Active', 560),
(577, 'Logged in to the Edutique System', '2022-07-21 11:33:12', 'Active', 1),
(578, 'Logged in to the Edutique System', '2022-07-21 18:22:27', 'Active', 1),
(579, 'Logged in to the Edutique System', '2022-07-22 00:58:42', 'Active', 561),
(580, 'Logged in to the Edutique System', '2022-07-22 01:04:15', 'Active', 560),
(581, 'Logged in to the Edutique System', '2022-07-22 01:05:16', 'Active', 1),
(582, 'Logged in to the Edutique System', '2022-07-22 14:52:32', 'Active', 1),
(583, 'Logged in to the Edutique System', '2022-07-22 16:49:12', 'Active', 1),
(584, 'Logged in to the Edutique System', '2022-07-22 21:39:27', 'Active', 561),
(585, 'Logged in to the Edutique System', '2022-07-23 12:36:31', 'Active', 1),
(586, 'Logged in to the Edutique System', '2022-07-23 17:18:58', 'Active', 561),
(587, 'Logged in to the Edutique System', '2022-07-23 17:23:20', 'Active', 1),
(588, 'Logged in to the Edutique System', '2022-07-23 21:22:52', 'Active', 560),
(589, 'Logged in to the Edutique System', '2022-07-24 23:02:47', 'Active', 1),
(590, 'Logged in to the Edutique System', '2022-07-24 23:13:59', 'Active', 561),
(591, 'Logged in to the Edutique System', '2022-07-24 23:14:45', 'Active', 1),
(592, 'Logged in to the Edutique System', '2022-07-24 23:19:56', 'Active', 561),
(593, 'Logged in to the Edutique System', '2022-07-24 23:34:58', 'Active', 1),
(594, 'Logged in to the Edutique System', '2022-07-25 14:49:33', 'Active', 1),
(595, 'Logged in to the Edutique System', '2022-07-26 18:24:19', 'Active', 1),
(596, 'Logged in to the Edutique System', '2022-07-27 13:26:25', 'Active', 1),
(597, 'Logged in to the Edutique System', '2022-07-27 19:03:14', 'Active', 623),
(598, 'Logged in to the Edutique System', '2022-07-27 19:21:23', 'Active', 626),
(599, 'Logged in to the Edutique System', '2022-07-27 19:40:56', 'Active', 1),
(600, 'Logged in to the Edutique System', '2022-07-28 13:29:36', 'Active', 1),
(601, 'Logged in to the Edutique System', '2022-07-28 19:50:00', 'Active', 1),
(602, 'Logged in to the Edutique System', '2022-07-29 12:01:53', 'Active', 1),
(603, 'Logged in to the Edutique System', '2022-07-29 15:23:21', 'Active', 1),
(604, 'Logged in to the Edutique System', '2022-07-30 18:36:38', 'Active', 1),
(605, 'Logged in to the Edutique System', '2022-08-01 11:41:22', 'Active', 1),
(606, 'Logged in to the Edutique System', '2022-08-01 19:47:22', 'Active', 1),
(607, 'Logged in to the Edutique System', '2022-08-02 13:44:05', 'Active', 1),
(608, 'Logged in to the Edutique System', '2022-08-03 13:11:04', 'Active', 1),
(609, 'Logged in to the Edutique System', '2022-08-04 13:29:03', 'Active', 1),
(610, 'Logged in to the Edutique System', '2022-08-04 17:24:57', 'Active', 1),
(611, 'Logged in to the Edutique System', '2022-08-05 14:04:59', 'Active', 1),
(612, 'Logged in to the Edutique System', '2022-08-05 18:14:47', 'Active', 1),
(613, 'Logged in to the Edutique System', '2022-08-06 02:55:26', 'Active', 1),
(614, 'Logged in to the Edutique System', '2022-08-07 18:13:34', 'Active', 1),
(615, 'Logged in to the Edutique System', '2022-08-07 21:37:41', 'Active', 626),
(616, 'Logged in to the Edutique System', '2022-08-09 01:21:17', 'Active', 1),
(617, 'Logged in to the Edutique System', '2022-08-09 01:46:47', 'Active', 626),
(618, 'Logged in to the Edutique System', '2022-08-09 15:17:04', 'Active', 1),
(619, 'Logged in to the Edutique System', '2022-08-09 21:19:25', 'Active', 626),
(620, 'Logged in to the Edutique System', '2022-08-10 12:05:15', 'Active', 1),
(621, 'Logged in to the Edutique System', '2022-08-10 17:57:07', 'Active', 1),
(622, 'Logged in to the Edutique System', '2022-08-10 21:16:26', 'Active', 626),
(623, 'Logged in to the Edutique System', '2022-08-11 01:19:45', 'Active', 626),
(624, 'Logged in to the Edutique System', '2022-08-11 02:06:03', 'Active', 623),
(625, 'Logged in to the Edutique System', '2022-08-11 13:35:02', 'Active', 1),
(626, 'Logged in to the Edutique System', '2022-08-11 16:28:38', 'Active', 626),
(627, 'Logged in to the Edutique System', '2022-08-11 18:56:20', 'Active', 1),
(628, 'Logged in to the Edutique System', '2022-08-12 13:32:54', 'Active', 1),
(629, 'Logged in to the Edutique System', '2022-08-12 14:12:47', 'Active', 1),
(630, 'Logged in to the Edutique System', '2022-08-12 16:18:53', 'Active', 1),
(631, 'Logged in to the Edutique System', '2022-08-12 23:39:37', 'Active', 1),
(632, 'Logged in to the Edutique System', '2022-08-13 15:33:47', 'Active', 1),
(633, 'Logged in to the Edutique System', '2022-08-16 13:48:01', 'Active', 1),
(634, 'Logged in to the Edutique System', '2022-08-16 17:19:36', 'Active', 1),
(635, 'Logged in to the Edutique System', '2022-08-16 17:21:41', 'Active', 626),
(636, 'Logged in to the Edutique System', '2022-08-16 17:26:02', 'Active', 1),
(637, 'Logged in to the Edutique System', '2022-08-16 17:43:09', 'Active', 631),
(638, 'Logged in to the Edutique System', '2022-08-16 17:46:51', 'Active', 1),
(639, 'Logged in to the Edutique System', '2022-08-16 17:47:32', 'Active', 631),
(640, 'Logged in to the Edutique System', '2022-08-16 17:52:16', 'Active', 1),
(641, 'Logged in to the Edutique System', '2022-08-16 19:11:00', 'Active', 631),
(642, 'Logged in to the Edutique System', '2022-08-16 19:17:41', 'Active', 1),
(643, 'Logged in to the Edutique System', '2022-08-19 16:07:58', 'Active', 1),
(644, 'Logged in to the Edutique System', '2022-08-19 16:09:05', 'Active', 1),
(645, 'Logged in to the Edutique System', '2022-08-22 17:51:39', 'Active', 1),
(646, 'Logged in to the Edutique System', '2022-08-23 13:55:20', 'Active', 1),
(647, 'Logged in to the Edutique System', '2022-08-24 14:03:57', 'Active', 1),
(648, 'Logged in to the Edutique System', '2022-08-24 19:06:26', 'Active', 1),
(649, 'Logged in to the Edutique System', '2022-08-25 13:51:19', 'Active', 1),
(650, 'Logged in to the Edutique System', '2022-08-25 18:09:33', 'Active', 1),
(651, 'Logged in to the Edutique System', '2022-08-26 01:24:59', 'Active', 1),
(652, 'Logged in to the Edutique System', '2022-08-26 14:52:34', 'Active', 1),
(653, 'Logged in to the Edutique System', '2022-08-26 21:00:23', 'Active', 1),
(654, 'Logged in to the Edutique System', '2022-08-27 17:44:21', 'Active', 1),
(655, 'Logged in to the Edutique System', '2022-08-27 23:43:20', 'Active', 631),
(656, 'Logged in to the Edutique System', '2022-08-28 18:12:18', 'Active', 1),
(657, 'Logged in to the Edutique System', '2022-08-28 18:32:01', 'Active', 631),
(658, 'Logged in to the Edutique System', '2022-08-28 18:35:55', 'Active', 632),
(659, 'Logged in to the Edutique System', '2022-08-28 19:14:26', 'Active', 632),
(660, 'Logged in to the Edutique System', '2022-08-28 19:25:15', 'Active', 1),
(661, 'Logged in to the Edutique System', '2022-08-29 01:30:17', 'Active', 1),
(662, 'Logged in to the Edutique System', '2022-08-29 13:19:27', 'Active', 632),
(663, 'Logged in to the Edutique System', '2022-08-29 13:31:07', 'Active', 1),
(664, 'Logged in to the Edutique System', '2022-08-29 19:57:34', 'Active', 1),
(665, 'Logged in to the Edutique System', '2022-08-29 19:58:19', 'Active', 1),
(666, 'Logged in to the Edutique System', '2022-09-01 01:46:00', 'Active', 632),
(667, 'Logged in to the Edutique System', '2022-09-01 02:40:06', 'Active', 631),
(668, 'Logged in to the Edutique System', '2022-09-01 13:27:14', 'Active', 631),
(669, 'Logged in to the Edutique System', '2022-09-01 14:11:28', 'Active', 632),
(670, 'Logged in to the Edutique System', '2022-09-02 01:33:12', 'Active', 1),
(671, 'Logged in to the Edutique System', '2022-09-02 22:48:50', 'Active', 631),
(672, 'Logged in to the Edutique System', '2022-09-03 00:04:11', 'Active', 1),
(673, 'Logged in to the Edutique System', '2022-09-03 00:19:38', 'Active', 632),
(674, 'Logged in to the Edutique System', '2022-09-03 00:29:29', 'Active', 631),
(675, 'Logged in to the Edutique System', '2022-09-03 02:03:34', 'Active', 1),
(676, 'Logged in to the Edutique System', '2022-09-03 02:07:49', 'Active', 631),
(677, 'Logged in to the Edutique System', '2022-09-03 02:08:39', 'Active', 1),
(678, 'Logged in to the Edutique System', '2022-09-03 02:11:02', 'Active', 1),
(679, 'Logged in to the Edutique System', '2022-09-03 02:14:37', 'Active', 631),
(680, 'Logged in to the Edutique System', '2022-09-03 02:16:06', 'Active', 1),
(681, 'Logged in to the Edutique System', '2022-09-03 02:19:43', 'Active', 631),
(682, 'Logged in to the Edutique System', '2022-09-03 02:21:53', 'Active', 1),
(683, 'Logged in to the Edutique System', '2022-09-03 02:24:14', 'Active', 631),
(684, 'Logged in to the Edutique System', '2022-09-03 02:24:56', 'Active', 1),
(685, 'Logged in to the Edutique System', '2022-09-03 02:26:38', 'Active', 631),
(686, 'Logged in to the Edutique System', '2022-09-03 02:30:00', 'Active', 1),
(687, 'Logged in to the Edutique System', '2022-09-03 02:33:12', 'Active', 631),
(688, 'Logged in to the Edutique System', '2022-09-03 02:33:51', 'Active', 1),
(689, 'Logged in to the Edutique System', '2022-09-05 14:16:18', 'Active', 1),
(690, 'Logged in to the Edutique System', '2022-09-06 13:34:50', 'Active', 1),
(691, 'Logged in to the Edutique System', '2022-09-06 17:57:18', 'Active', 1),
(692, 'Logged in to the Edutique System', '2022-09-06 20:22:26', 'Active', 632),
(693, 'Logged in to the Edutique System', '2022-09-06 21:06:11', 'Active', 1),
(694, 'Logged in to the Edutique System', '2022-09-07 17:37:47', 'Active', 632),
(695, 'Logged in to the Edutique System', '2022-09-07 17:41:35', 'Active', 1),
(696, 'Logged in to the Edutique System', '2022-09-07 19:51:03', 'Active', 632),
(697, 'Logged in to the Edutique System', '2022-09-07 19:54:11', 'Active', 631),
(698, 'Logged in to the Edutique System', '2022-09-07 20:09:53', 'Active', 633),
(699, 'Logged in to the Edutique System', '2022-09-07 20:11:02', 'Active', 631),
(700, 'Logged in to the Edutique System', '2022-09-07 20:39:08', 'Active', 1),
(701, 'Logged in to the Edutique System', '2022-09-07 21:21:51', 'Active', 632),
(702, 'Logged in to the Edutique System', '2022-09-07 21:23:34', 'Active', 631),
(703, 'Logged in to the Edutique System', '2022-09-07 21:57:04', 'Active', 1),
(704, 'Logged in to the Edutique System', '2022-09-08 00:47:37', 'Active', 631),
(705, 'Logged in to the Edutique System', '2022-09-08 12:26:36', 'Active', 1),
(706, 'Logged in to the Edutique System', '2022-09-08 23:12:26', 'Active', 1),
(707, 'Logged in to the Edutique System', '2022-09-09 01:59:06', 'Active', 1),
(708, 'Logged in to the Edutique System', '2022-09-09 13:57:39', 'Active', 1),
(709, 'Logged in to the Edutique System', '2022-09-10 15:23:23', 'Active', 1),
(710, 'Logged in to the Edutique System', '2022-09-10 15:37:18', 'Active', 637),
(711, 'Password updated', '2022-09-10 15:38:05', 'Active', 637),
(712, 'Password updated', '2022-09-10 15:40:45', 'Active', 637),
(713, 'Logged in to the Edutique System', '2022-09-10 17:43:39', 'Active', 1),
(714, 'Logged in to the Edutique System', '2022-09-10 18:13:52', 'Active', 632),
(715, 'Logged in to the Edutique System', '2022-09-10 18:15:08', 'Active', 631),
(716, 'Logged in to the Edutique System', '2022-09-11 01:46:54', 'Active', 632),
(717, 'Logged in to the Edutique System', '2022-09-11 01:58:27', 'Active', 637),
(718, 'Logged in to the Edutique System', '2022-09-11 02:01:39', 'Active', 1),
(719, 'Logged in to the Edutique System', '2022-09-12 01:26:41', 'Active', 1),
(720, 'Logged in to the Edutique System', '2022-09-12 02:23:20', 'Active', 632),
(721, 'Logged in to the Edutique System', '2022-09-12 02:31:38', 'Active', 631),
(722, 'Logged in to the Edutique System', '2022-09-12 13:46:00', 'Active', 1),
(723, 'Logged in to the Edutique System', '2022-09-12 14:08:08', 'Active', 631),
(724, 'Logged in to the Edutique System', '2022-09-12 14:13:46', 'Active', 1),
(725, 'Logged in to the Edutique System', '2022-09-12 14:20:10', 'Active', 631),
(726, 'Logged in to the Edutique System', '2022-09-12 14:23:51', 'Active', 632),
(727, 'Logged in to the Edutique System', '2022-09-12 18:27:17', 'Active', 1),
(728, 'Logged in to the Edutique System', '2022-09-12 22:45:27', 'Active', 1),
(729, 'Logged in to the Edutique System', '2022-09-12 23:10:09', 'Active', 1),
(730, 'Logged in to the Edutique System', '2022-09-13 13:39:28', 'Active', 1),
(731, 'Logged in to the Edutique System', '2022-09-14 14:14:05', 'Active', 1),
(732, 'Logged in to the Edutique System', '2022-09-14 18:22:06', 'Active', 1),
(733, 'Logged in to the Edutique System', '2022-09-14 19:21:20', 'Active', 1),
(734, 'Logged in to the Edutique System', '2022-09-14 19:35:38', 'Active', 1),
(735, 'Logged in to the Edutique System', '2022-09-14 21:01:24', 'Active', 1),
(736, 'Logged in to the Edutique System', '2022-09-14 23:50:02', 'Active', 1),
(737, 'Logged in to the Edutique System', '2022-09-15 16:37:57', 'Active', 1),
(738, 'Logged in to the Edutique System', '2022-09-15 19:04:04', 'Active', 664),
(739, 'Password updated', '2022-09-15 19:04:21', 'Active', 664),
(740, 'Logged in to the Edutique System', '2022-09-15 19:04:49', 'Active', 1),
(741, 'Logged in to the Edutique System', '2022-09-15 19:09:37', 'Active', 672),
(742, 'Password updated', '2022-09-15 19:09:54', 'Active', 672),
(743, 'Logged in to the Edutique System', '2022-09-15 19:13:14', 'Active', 664),
(744, 'Logged in to the Edutique System', '2022-09-15 19:16:42', 'Active', 663),
(745, 'Password updated', '2022-09-15 19:17:02', 'Active', 663);

-- --------------------------------------------------------

--
-- Table structure for table `edu_login_details`
--

CREATE TABLE `edu_login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edu_login_details`
--

INSERT INTO `edu_login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(347, 1, '2022-06-26 09:23:12', 'no'),
(348, 1, '2022-06-27 09:06:01', 'no'),
(349, 1, '2022-06-28 12:34:51', 'no'),
(350, 1, '2022-06-29 06:09:06', 'no'),
(351, 1, '2022-06-29 14:57:31', 'no'),
(352, 1, '2022-06-30 11:39:52', 'no'),
(353, 1, '2022-07-01 00:46:23', 'no'),
(354, 1, '2022-07-01 09:44:56', 'no'),
(355, 3, '2022-07-02 06:16:08', 'no'),
(356, 1, '2022-07-03 11:39:19', 'no'),
(357, 1, '2022-07-03 15:32:04', 'no'),
(358, 1, '2022-07-04 03:35:20', 'no'),
(359, 1, '2022-07-04 05:15:30', 'no'),
(360, 3, '2022-07-04 06:37:44', 'no'),
(361, 1, '2022-07-04 06:57:48', 'no'),
(362, 204, '2022-07-04 07:02:17', 'no'),
(363, 203, '2022-07-04 07:03:40', 'no'),
(364, 1, '2022-07-05 06:34:30', 'no'),
(365, 1, '2022-07-05 07:34:36', 'no'),
(366, 207, '2022-07-05 07:39:49', 'no'),
(367, 208, '2022-07-05 07:51:48', 'no'),
(368, 1, '2022-07-05 07:55:07', 'no'),
(369, 208, '2022-07-05 07:57:08', 'no'),
(370, 1, '2022-07-05 10:35:50', 'no'),
(371, 1, '2022-07-06 05:12:17', 'no'),
(372, 1, '2022-07-06 11:14:30', 'no'),
(373, 208, '2022-07-06 15:14:45', 'no'),
(374, 208, '2022-07-06 19:10:33', 'no'),
(375, 208, '2022-07-06 19:22:35', 'no'),
(376, 1, '2022-07-06 19:23:19', 'no'),
(377, 208, '2022-07-06 19:24:31', 'no'),
(378, 1, '2022-07-07 06:29:44', 'no'),
(379, 1, '2022-07-07 12:04:34', 'no'),
(380, 1, '2022-07-08 04:34:42', 'no'),
(381, 208, '2022-07-08 06:42:48', 'no'),
(382, 1, '2022-07-08 06:50:36', 'no'),
(383, 1, '2022-07-08 11:40:08', 'no'),
(384, 1, '2022-07-09 06:10:13', 'no'),
(385, 1, '2022-07-09 09:54:41', 'no'),
(386, 208, '2022-07-09 10:26:18', 'no'),
(387, 1, '2022-07-09 10:48:11', 'no'),
(388, 1, '2022-07-11 04:43:23', 'no'),
(389, 1, '2022-07-12 04:37:21', 'no'),
(390, 1, '2022-07-12 07:10:10', 'no'),
(391, 208, '2022-07-12 07:32:57', 'no'),
(392, 1, '2022-07-12 07:33:32', 'no'),
(393, 214, '2022-07-12 11:04:09', 'no'),
(394, 1, '2022-07-13 04:41:57', 'no'),
(395, 207, '2022-07-14 04:51:12', 'no'),
(396, 1, '2022-07-14 06:29:02', 'no'),
(397, 1, '2022-07-14 09:11:31', 'no'),
(398, 207, '2022-07-14 11:07:10', 'no'),
(399, 1, '2022-07-15 05:12:45', 'no'),
(400, 207, '2022-07-15 08:00:23', 'no'),
(401, 208, '2022-07-15 10:32:04', 'no'),
(402, 1, '2022-07-15 11:09:26', 'no'),
(403, 207, '2022-07-15 11:10:53', 'no'),
(404, 1, '2022-07-15 11:29:20', 'no'),
(405, 208, '2022-07-15 11:51:43', 'no'),
(406, 1, '2022-07-15 11:52:12', 'no'),
(407, 1, '2022-07-16 04:51:50', 'no'),
(408, 1, '2022-07-18 05:22:45', 'no'),
(409, 1, '2022-07-18 10:05:45', 'no'),
(410, 1, '2022-07-19 05:36:18', 'no'),
(411, 1, '2022-07-19 07:26:37', 'no'),
(412, 1, '2022-07-19 11:42:48', 'no'),
(413, 1, '2022-07-19 12:28:54', 'no'),
(414, 1, '2022-07-19 16:57:54', 'no'),
(415, 561, '2022-07-19 17:17:14', 'no'),
(416, 1, '2022-07-19 18:01:53', 'no'),
(417, 561, '2022-07-19 18:14:51', 'no'),
(418, 1, '2022-07-19 18:18:58', 'no'),
(419, 1, '2022-07-20 06:49:45', 'no'),
(420, 561, '2022-07-20 11:28:03', 'no'),
(421, 1, '2022-07-20 11:35:07', 'no'),
(422, 561, '2022-07-20 11:41:49', 'no'),
(423, 560, '2022-07-20 11:49:39', 'no'),
(424, 1, '2022-07-21 03:33:13', 'no'),
(425, 1, '2022-07-21 10:22:28', 'no'),
(426, 561, '2022-07-21 16:58:42', 'no'),
(427, 560, '2022-07-21 17:04:15', 'no'),
(428, 1, '2022-07-21 17:05:16', 'no'),
(429, 1, '2022-07-22 06:52:32', 'no'),
(430, 1, '2022-07-22 08:49:12', 'no'),
(431, 561, '2022-07-22 13:39:27', 'no'),
(432, 1, '2022-07-23 04:36:32', 'no'),
(433, 561, '2022-07-23 09:18:58', 'no'),
(434, 1, '2022-07-23 09:23:20', 'no'),
(435, 560, '2022-07-23 13:22:53', 'no'),
(436, 1, '2022-07-24 15:02:48', 'no'),
(437, 561, '2022-07-24 15:13:59', 'no'),
(438, 1, '2022-07-24 15:14:45', 'no'),
(439, 561, '2022-07-24 15:19:56', 'no'),
(440, 1, '2022-07-24 15:34:59', 'no'),
(441, 1, '2022-07-25 06:49:33', 'no'),
(442, 1, '2022-07-26 10:24:20', 'no'),
(443, 1, '2022-07-27 05:26:26', 'no'),
(444, 623, '2022-07-27 11:03:14', 'no'),
(445, 626, '2022-07-27 11:21:23', 'no'),
(446, 1, '2022-07-27 11:40:56', 'no'),
(447, 1, '2022-07-28 05:29:36', 'no'),
(448, 1, '2022-07-28 11:50:00', 'no'),
(449, 1, '2022-07-29 04:01:53', 'no'),
(450, 1, '2022-07-29 07:23:21', 'no'),
(451, 1, '2022-07-30 10:36:38', 'no'),
(452, 1, '2022-08-01 03:41:22', 'no'),
(453, 1, '2022-08-01 11:47:23', 'no'),
(454, 1, '2022-08-02 05:44:05', 'no'),
(455, 1, '2022-08-03 05:11:04', 'no'),
(456, 1, '2022-08-04 05:29:04', 'no'),
(457, 1, '2022-08-04 09:24:58', 'no'),
(458, 1, '2022-08-05 06:04:59', 'no'),
(459, 1, '2022-08-05 10:14:48', 'no'),
(460, 1, '2022-08-05 18:55:27', 'no'),
(461, 1, '2022-08-07 10:13:35', 'no'),
(462, 626, '2022-08-07 13:37:41', 'no'),
(463, 1, '2022-08-08 17:21:21', 'no'),
(464, 626, '2022-08-08 17:46:47', 'no'),
(465, 1, '2022-08-09 07:17:05', 'no'),
(466, 626, '2022-08-09 13:19:25', 'no'),
(467, 1, '2022-08-10 04:05:15', 'no'),
(468, 1, '2022-08-10 09:57:08', 'no'),
(469, 626, '2022-08-10 13:16:27', 'no'),
(470, 626, '2022-08-10 17:19:45', 'no'),
(471, 623, '2022-08-10 18:06:03', 'no'),
(472, 1, '2022-08-11 05:35:03', 'no'),
(473, 626, '2022-08-11 08:28:38', 'no'),
(474, 1, '2022-08-11 10:56:20', 'no'),
(475, 1, '2022-08-12 05:32:54', 'no'),
(476, 1, '2022-08-12 06:12:47', 'no'),
(477, 1, '2022-08-12 08:18:54', 'no'),
(478, 1, '2022-08-12 15:39:37', 'no'),
(479, 1, '2022-08-13 07:33:49', 'no'),
(480, 1, '2022-08-16 05:48:02', 'no'),
(481, 1, '2022-08-16 09:19:36', 'no'),
(482, 626, '2022-08-16 09:21:41', 'no'),
(483, 1, '2022-08-16 09:26:02', 'no'),
(484, 631, '2022-08-16 09:43:09', 'no'),
(485, 1, '2022-08-16 09:46:51', 'no'),
(486, 631, '2022-08-16 09:47:32', 'no'),
(487, 1, '2022-08-16 09:52:16', 'no'),
(488, 631, '2022-08-16 11:11:00', 'no'),
(489, 1, '2022-08-16 11:17:41', 'no'),
(490, 1, '2022-08-19 08:07:58', 'no'),
(491, 1, '2022-08-19 08:09:06', 'no'),
(492, 1, '2022-08-22 09:51:39', 'no'),
(493, 1, '2022-08-23 05:55:20', 'no'),
(494, 1, '2022-08-24 06:03:57', 'no'),
(495, 1, '2022-08-24 11:06:26', 'no'),
(496, 1, '2022-08-25 05:51:19', 'no'),
(497, 1, '2022-08-25 10:09:33', 'no'),
(498, 1, '2022-08-25 17:24:59', 'no'),
(499, 1, '2022-08-26 06:52:34', 'no'),
(500, 1, '2022-08-26 13:00:23', 'no'),
(501, 1, '2022-08-27 09:44:21', 'no'),
(502, 631, '2022-08-27 15:43:20', 'no'),
(503, 1, '2022-08-28 10:12:18', 'no'),
(504, 631, '2022-08-28 10:32:01', 'no'),
(505, 632, '2022-08-28 10:35:55', 'no'),
(506, 632, '2022-08-28 11:14:26', 'no'),
(507, 1, '2022-08-28 11:25:15', 'no'),
(508, 1, '2022-08-28 17:30:18', 'no'),
(509, 632, '2022-08-29 05:19:27', 'no'),
(510, 1, '2022-08-29 05:31:07', 'no'),
(511, 1, '2022-08-29 11:57:34', 'no'),
(512, 1, '2022-08-29 11:58:19', 'no'),
(513, 632, '2022-08-31 17:46:00', 'no'),
(514, 631, '2022-08-31 18:40:06', 'no'),
(515, 631, '2022-09-01 05:27:14', 'no'),
(516, 632, '2022-09-01 06:11:28', 'no'),
(517, 1, '2022-09-01 17:33:12', 'no'),
(518, 631, '2022-09-02 14:48:51', 'no'),
(519, 1, '2022-09-02 16:04:11', 'no'),
(520, 632, '2022-09-02 16:19:38', 'no'),
(521, 631, '2022-09-02 16:29:29', 'no'),
(522, 1, '2022-09-02 18:03:34', 'no'),
(523, 631, '2022-09-02 18:07:49', 'no'),
(524, 1, '2022-09-02 18:08:39', 'no'),
(525, 1, '2022-09-02 18:11:02', 'no'),
(526, 631, '2022-09-02 18:14:37', 'no'),
(527, 1, '2022-09-02 18:16:07', 'no'),
(528, 631, '2022-09-02 18:19:43', 'no'),
(529, 1, '2022-09-02 18:21:53', 'no'),
(530, 631, '2022-09-02 18:24:14', 'no'),
(531, 1, '2022-09-02 18:24:56', 'no'),
(532, 631, '2022-09-02 18:26:38', 'no'),
(533, 1, '2022-09-02 18:30:00', 'no'),
(534, 631, '2022-09-02 18:33:12', 'no'),
(535, 1, '2022-09-02 18:33:51', 'no'),
(536, 1, '2022-09-05 06:16:18', 'no'),
(537, 1, '2022-09-06 05:34:51', 'no'),
(538, 1, '2022-09-06 09:57:18', 'no'),
(539, 632, '2022-09-06 12:22:26', 'no'),
(540, 1, '2022-09-06 13:06:11', 'no'),
(541, 632, '2022-09-07 09:37:47', 'no'),
(542, 1, '2022-09-07 09:41:35', 'no'),
(543, 632, '2022-09-07 11:51:03', 'no'),
(544, 631, '2022-09-07 11:54:11', 'no'),
(545, 633, '2022-09-07 12:09:53', 'no'),
(546, 631, '2022-09-07 12:11:02', 'no'),
(547, 1, '2022-09-07 12:39:08', 'no'),
(548, 632, '2022-09-07 13:21:51', 'no'),
(549, 631, '2022-09-07 13:23:34', 'no'),
(550, 1, '2022-09-07 13:57:04', 'no'),
(551, 631, '2022-09-07 16:47:38', 'no'),
(552, 1, '2022-09-08 04:26:37', 'no'),
(553, 1, '2022-09-08 15:12:26', 'no'),
(554, 1, '2022-09-08 17:59:06', 'no'),
(555, 1, '2022-09-09 05:57:39', 'no'),
(556, 1, '2022-09-10 07:23:24', 'no'),
(557, 637, '2022-09-10 07:37:18', 'no'),
(558, 1, '2022-09-10 09:43:39', 'no'),
(559, 632, '2022-09-10 10:13:52', 'no'),
(560, 631, '2022-09-10 10:15:08', 'no'),
(561, 632, '2022-09-10 17:46:54', 'no'),
(562, 637, '2022-09-10 17:58:27', 'no'),
(563, 1, '2022-09-10 18:01:39', 'no'),
(564, 1, '2022-09-11 17:26:41', 'no'),
(565, 632, '2022-09-11 18:23:20', 'no'),
(566, 631, '2022-09-11 18:31:38', 'no'),
(567, 1, '2022-09-12 05:46:00', 'no'),
(568, 631, '2022-09-12 06:08:08', 'no'),
(569, 1, '2022-09-12 06:13:46', 'no'),
(570, 631, '2022-09-12 06:20:10', 'no'),
(571, 632, '2022-09-12 06:23:51', 'no'),
(572, 1, '2022-09-12 10:27:17', 'no'),
(573, 1, '2022-09-12 14:45:27', 'no'),
(574, 1, '2022-09-12 15:10:09', 'no'),
(575, 1, '2022-09-13 05:39:28', 'no'),
(576, 1, '2022-09-14 06:14:05', 'no'),
(577, 1, '2022-09-14 10:22:07', 'no'),
(578, 1, '2022-09-14 11:21:20', 'no'),
(579, 1, '2022-09-14 11:35:38', 'no'),
(580, 1, '2022-09-14 13:01:24', 'no'),
(581, 1, '2022-09-14 15:50:02', 'no'),
(582, 1, '2022-09-15 08:37:57', 'no'),
(583, 664, '2022-09-15 11:04:04', 'no'),
(584, 1, '2022-09-15 11:04:49', 'no'),
(585, 672, '2022-09-15 11:09:37', 'no'),
(586, 664, '2022-09-15 11:13:14', 'no'),
(587, 663, '2022-09-15 11:16:42', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `edu_magazine`
--

CREATE TABLE `edu_magazine` (
  `mag_id` int(11) NOT NULL,
  `mag_title` varchar(255) NOT NULL,
  `mag_issue` varchar(55) NOT NULL,
  `mag_published_date` datetime NOT NULL,
  `mag_status` varchar(55) NOT NULL,
  `mag_type_id` int(11) NOT NULL,
  `mag_image_path` varchar(255) NOT NULL,
  `tc_image` varchar(255) DEFAULT NULL,
  `editors_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_magazine`
--

INSERT INTO `edu_magazine` (`mag_id`, `mag_title`, `mag_issue`, `mag_published_date`, `mag_status`, `mag_type_id`, `mag_image_path`, `tc_image`, `editors_note`) VALUES
(5, 'Identity (self)', '1', '2022-06-01 00:00:00', 'Active', 2, 'magazine/iThink/1/identity.jpg', 'magazine/iThink/1/WhatsApp Image 2022-08-23 at 3.56.38 PM.jpeg', '<span style=\"font-family:Arial; font-size:12px\">&shy;</span>\r\n<ol>\r\n	<li>open firebug and look up the particular ajax request from console. Then, see the parameter, header, and URL request. Examine each data to see what goes wrong. If it all seems OK</li>\r\n	<li>I will look at my server log (httpd-error.log on Apache) and check any particular error that came from that request.</li>\r\n	<li>Fix what is wrong based on all there checking.</li>\r\n</ol>\r\n'),
(6, 'Sports & Games', '2', '2022-06-01 09:21:39', 'Active', 2, '', NULL, NULL),
(7, 'Idols & Heroes', '3', '2022-06-01 09:24:17', 'Active', 2, '', NULL, NULL),
(8, 'Food', '4', '2022-06-01 09:24:17', 'Active', 2, '', NULL, NULL),
(9, 'Technology', '5', '2022-06-01 09:25:03', 'Active', 2, '', NULL, NULL),
(10, 'Festival', '6', '2022-06-01 09:25:03', 'Active', 2, '', NULL, NULL),
(11, 'Language & Literature', '7', '2022-06-01 09:25:36', 'Active', 2, '', NULL, NULL),
(12, 'History', '8', '2022-06-01 09:25:36', 'Active', 2, '', NULL, NULL),
(13, 'Space', '9', '2022-06-25 19:30:25', 'Active', 2, '', NULL, NULL),
(14, 'Conflict', '10', '2022-06-25 19:32:10', 'Active', 2, '', NULL, NULL),
(15, 'Discrimination', '11', '2022-06-25 19:32:10', 'Active', 2, '', NULL, NULL),
(16, 'Environment                                                   ', '12', '2022-06-25 19:32:51', 'Active', 2, '', NULL, NULL),
(17, 'DIY', '13', '2022-06-25 19:32:51', 'Active', 2, '', NULL, NULL),
(18, 'Music', '14', '2022-06-25 19:33:27', 'Active', 2, '', NULL, NULL),
(19, 'Fashion ', '15', '2022-06-25 19:33:27', 'Active', 2, '', NULL, NULL),
(20, 'Write (Exam Issue)', '16-17', '2022-06-25 19:33:58', 'Active', 2, '', NULL, NULL),
(21, 'Disrupted - Technology', '18', '2022-06-25 19:33:58', 'Active', 2, '', NULL, NULL),
(22, 'Diverse ', '19', '2022-06-25 19:34:50', 'Active', 2, '', NULL, NULL),
(23, 'The Write Issue (Exam)', '20-21', '2022-06-25 19:34:50', 'Active', 2, '', NULL, NULL),
(24, 'Unity', '22', '2022-06-25 19:35:23', 'Active', 2, '', NULL, NULL),
(25, 'Migration', '23', '2022-06-25 19:35:23', 'Active', 2, '', NULL, NULL),
(26, 'Technology, humans & robots ', '24', '2022-06-25 19:35:59', 'Active', 2, '', NULL, NULL),
(27, 'Technology, e-learning', '25-26', '2022-06-25 19:35:59', 'Active', 2, '', NULL, NULL),
(28, 'Entertainment/education', '27', '2022-06-25 19:37:00', 'Active', 2, '', NULL, NULL),
(29, 'Environmental conservation', '28', '2022-06-25 19:37:00', 'Active', 2, '', NULL, NULL),
(30, 'Transport/ Environment ', '29', '2022-06-25 19:37:39', 'Active', 2, '', NULL, NULL),
(31, 'Fair treatment', '30-31', '2022-06-25 19:37:39', 'Active', 2, '', NULL, NULL),
(32, 'Human rights', '32', '2022-06-25 19:38:56', 'Active', 2, '', NULL, NULL),
(33, 'Cloud', '33', '2022-06-25 19:38:56', 'Active', 2, '', NULL, NULL),
(34, 'Apart', '34', '2022-06-25 19:39:31', 'Active', 2, '', NULL, NULL),
(35, 'School', '35-36', '2022-06-25 19:39:31', 'Active', 2, '', NULL, NULL),
(36, 'Delivery ', '37', '2022-06-25 19:40:11', 'Active', 2, '', NULL, NULL),
(68, 'test12', '39', '2022-07-30 00:00:00', 'Active', 1, 'magazine/test/39/ggg.jpg', NULL, NULL),
(69, 'sdf', '38', '2022-07-25 18:36:16', 'Active', 2, '', NULL, NULL),
(70, 'fg', '1', '2022-07-27 14:31:15', 'Active', 2, '', NULL, NULL),
(71, 'test', '1', '2022-08-24 00:00:00', 'Active', 3, 'magazine/testnew/1/1_Page_04.jpg', NULL, NULL),
(72, 'test', '31', '2022-08-01 17:19:58', 'Active', 2, '', NULL, NULL),
(73, 'test', '1', '2022-09-14 00:00:00', 'Active', 10, 'magazine/eee/1/1_Page_04.jpg', NULL, NULL),
(74, 'test', '1', '2022-09-14 00:00:00', 'Active', 11, 'magazine/rrrr/1/art-camping_equipment.jpg', 'magazine/rrrr/1/fit n flair.jpg', NULL),
(75, 'test12', '1', '2022-09-14 00:00:00', 'Active', 12, 'magazine/tttt/1/ggg.jpg', 'magazine/tttt/1/2222 (2).jpeg', '<span style=\"font-family:Arial; font-size:12px\">&shy;sfsd sdgv124</span>'),
(76, 'test', '1', '2022-09-14 00:00:00', 'Active', 13, 'magazine/test12/1/art-camping_equipment.jpg', 'magazine/test12/1/WhatsApp Image 2022-08-23 at 3.56.38 PM.jpeg', '<span style=\"font-family:Arial; font-size:12px\">&shy;</span>The user uploads an Excel/CSV file through a webform and is parsed via AJAX. This particular example has 775 records with 13 fields/elements each. Adding additional fields being submitted and there are less than 11,000 elements in the dataset. From the research I&#39;ve done on the subject, 32-bit browsers (i.e. Firefox, Chrome, etc.) should be able to handle 4.29 billion elements, so I don&#39;t see the data size as an issue, especially as the response from the file upload contains all the elements.');

-- --------------------------------------------------------

--
-- Table structure for table `edu_mag_dum`
--

CREATE TABLE `edu_mag_dum` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `mag_id` int(11) NOT NULL,
  `published_date` datetime NOT NULL,
  `article_id` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `style` text DEFAULT NULL,
  `audio_path` varchar(255) DEFAULT NULL,
  `quick_tips` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_mag_type`
--

CREATE TABLE `edu_mag_type` (
  `mag_type_id` int(11) NOT NULL,
  `mag_type` varchar(55) NOT NULL,
  `mag_type_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_mag_type`
--

INSERT INTO `edu_mag_type` (`mag_type_id`, `mag_type`, `mag_type_status`) VALUES
(1, 'Inspire', 'Active'),
(2, 'iThink', 'Active'),
(3, 'i', 'Active'),
(7, 'test', 'Active'),
(8, 'test1', 'Active'),
(9, 'testnew', 'Active'),
(10, 'eee', 'Active'),
(11, 'rrrr', 'Active'),
(12, 'tttt', 'Active'),
(13, 'test12', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `edu_manual_user_temp`
--

CREATE TABLE `edu_manual_user_temp` (
  `name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `issue_id` int(11) DEFAULT NULL,
  `issue_no` varchar(55) DEFAULT NULL,
  `article_type_id` int(11) DEFAULT NULL,
  `article_no` varchar(255) DEFAULT NULL,
  `activity_type_id` int(11) DEFAULT NULL,
  `activity_no` varchar(55) DEFAULT NULL,
  `class_teacher` varchar(255) DEFAULT NULL,
  `cl_email` varchar(255) DEFAULT NULL,
  `program_incharge` varchar(255) DEFAULT NULL,
  `pi_email` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_messages`
--

CREATE TABLE `edu_messages` (
  `id` int(11) NOT NULL,
  `message_title` varchar(255) NOT NULL,
  `message_content` text NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `parent_msg_id` int(11) NOT NULL,
  `status` varchar(55) NOT NULL,
  `publish_date` datetime NOT NULL,
  `message_type` varchar(55) NOT NULL,
  `message_status` varchar(55) NOT NULL,
  `date_resolved` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_notes`
--

CREATE TABLE `edu_notes` (
  `notes_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `user_notes_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_noti`
--

CREATE TABLE `edu_noti` (
  `noti_id` int(11) NOT NULL,
  `noti_title` varchar(255) NOT NULL,
  `noti_content` text DEFAULT NULL,
  `noti_published_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `noti_status` varchar(55) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `mag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_noti`
--

INSERT INTO `edu_noti` (`noti_id`, `noti_title`, `noti_content`, `noti_published_date`, `user_id`, `noti_status`, `start_date`, `end_date`, `added_by`, `activity_id`, `article_id`, `mag_id`) VALUES
(103, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-03 02:32:39', 630, 'Active', NULL, NULL, 632, 78, 4, 5),
(104, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-03 02:32:39', 631, 'Active', NULL, NULL, 632, 78, 4, 5),
(105, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-10 18:14:45', 630, 'Active', NULL, NULL, 632, 78, 4, 5),
(106, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-10 18:14:45', 631, 'Active', NULL, NULL, 632, 78, 4, 5),
(107, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:35:57', 630, 'Active', NULL, NULL, 632, 78, 4, 5),
(108, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:35:57', 631, 'Active', NULL, NULL, 632, 78, 4, 5),
(109, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:38:25', 630, 'Active', NULL, NULL, 632, 78, 4, 5),
(110, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:38:25', 631, 'Active', NULL, NULL, 632, 78, 4, 5),
(111, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:39:09', 630, 'Active', NULL, NULL, 632, 78, 4, 5),
(112, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:39:09', 631, 'Active', NULL, NULL, 632, 78, 4, 5),
(113, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:41:50', 630, 'Active', NULL, NULL, 632, 78, 4, 5),
(114, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:41:50', 631, 'Active', NULL, NULL, 632, 78, 4, 5),
(115, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:48:17', 630, 'Active', NULL, NULL, 632, 78, 4, 5),
(116, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:48:17', 631, 'Active', NULL, NULL, 632, 78, 4, 5),
(117, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:50:23', 630, 'Active', NULL, NULL, 632, 78, 4, 5),
(118, 'Activity Submitted by Xinrui 1 Chai1', NULL, '2022-09-12 14:50:23', 631, 'Active', NULL, NULL, 632, 78, 4, 5),
(119, 'Activity Submitted by Michael1p2 Teoh', NULL, '2022-09-15 19:14:58', 662, 'Active', NULL, NULL, 664, 106, 0, 5),
(120, 'Activity Submitted by Michael1p2 Teoh', NULL, '2022-09-15 19:14:58', 663, 'Active', NULL, NULL, 664, 106, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `edu_onoff`
--

CREATE TABLE `edu_onoff` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `end_date` datetime NOT NULL DEFAULT current_timestamp(),
  `lock_enable` int(11) NOT NULL DEFAULT 1,
  `content_aid` int(11) NOT NULL DEFAULT 1,
  `receive_questions` int(11) NOT NULL DEFAULT 1,
  `unlimited_attempts` int(11) NOT NULL DEFAULT 1,
  `hide_suggested_answers` int(11) NOT NULL DEFAULT 1,
  `peer_review` int(11) NOT NULL DEFAULT 1,
  `attempts` int(11) NOT NULL DEFAULT 0,
  `remarks1` text DEFAULT NULL,
  `remarks2` text DEFAULT NULL,
  `remarks3` text DEFAULT NULL,
  `remarks4` text DEFAULT NULL,
  `remarks5` text DEFAULT NULL,
  `remarks6` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_onoff`
--

INSERT INTO `edu_onoff` (`id`, `school_id`, `start_date`, `end_date`, `lock_enable`, `content_aid`, `receive_questions`, `unlimited_attempts`, `hide_suggested_answers`, `peer_review`, `attempts`, `remarks1`, `remarks2`, `remarks3`, `remarks4`, `remarks5`, `remarks6`) VALUES
(5, 45, '2022-07-20 00:00:00', '2022-08-06 00:00:00', 1, 0, 1, 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edu_onoff_bulk`
--

CREATE TABLE `edu_onoff_bulk` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `end_date` datetime NOT NULL DEFAULT current_timestamp(),
  `dashboard` int(11) NOT NULL DEFAULT 1,
  `todolist` int(11) NOT NULL DEFAULT 1,
  `calendar` int(11) NOT NULL DEFAULT 1,
  `bookmarks` int(11) NOT NULL DEFAULT 1,
  `wordbank` int(11) NOT NULL DEFAULT 1,
  `resources` int(11) NOT NULL DEFAULT 1,
  `progress` int(11) NOT NULL DEFAULT 1,
  `logs` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_onoff_bulk`
--

INSERT INTO `edu_onoff_bulk` (`id`, `school_id`, `start_date`, `end_date`, `dashboard`, `todolist`, `calendar`, `bookmarks`, `wordbank`, `resources`, `progress`, `logs`) VALUES
(5, 45, '2022-07-27 00:00:00', '2022-07-30 00:00:00', 1, 1, 1, 1, 1, 1, 1, 1),
(6, 42, '2022-08-14 00:00:00', '2022-10-09 00:00:00', 1, 1, 1, 1, 1, 1, 1, 1),
(7, 43, '2022-08-14 00:00:00', '2022-10-09 00:00:00', 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `edu_password_reset_temp`
--

CREATE TABLE `edu_password_reset_temp` (
  `email` varchar(255) NOT NULL,
  `keytoken` varchar(255) NOT NULL,
  `expdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_question_portal`
--

CREATE TABLE `edu_question_portal` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(55) NOT NULL,
  `qp_to` int(11) NOT NULL,
  `qp_by` int(11) NOT NULL,
  `publish_date` datetime NOT NULL,
  `parent_qp_id` int(11) NOT NULL,
  `art_id` int(11) DEFAULT NULL,
  `act_id` int(11) DEFAULT NULL,
  `qp_answered` int(11) DEFAULT NULL,
  `mag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_reflection`
--

CREATE TABLE `edu_reflection` (
  `id` int(11) NOT NULL,
  `ques` text NOT NULL,
  `response` text NOT NULL,
  `mag_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `teach_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `submitted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_reflection`
--

INSERT INTO `edu_reflection` (`id`, `ques`, `response`, `mag_id`, `art_id`, `act_id`, `stud_id`, `teach_id`, `school_id`, `level_id`, `class_id`, `submitted_on`) VALUES
(8, 'Why you be keen to join a reality show on survival? why, or why not?', 'this is my new response', 5, 3, 0, 633, 631, 42, 43, 59, '2022-09-07 20:10:18'),
(9, 'Why you be keen to join a reality show on survival? why, or why not?', 'this is my 1st response for the above question', 5, 3, 0, 632, 631, 42, 43, 59, '2022-09-07 21:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `edu_review`
--

CREATE TABLE `edu_review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  `mag_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edu_review`
--

INSERT INTO `edu_review` (`review_id`, `user_id`, `user_rating`, `user_review`, `datetime`, `mag_id`, `art_id`, `act_id`, `user_type_id`, `status`) VALUES
(31, 1, 2, 'ggg', '2022-07-13 18:39:07', 5, 4, 0, 5, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `edu_school`
--

CREATE TABLE `edu_school` (
  `school_id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `school_address` text DEFAULT NULL,
  `school_created_date` datetime DEFAULT NULL,
  `school_created_by` varchar(255) DEFAULT NULL,
  `school_status` varchar(55) NOT NULL,
  `postal_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_school`
--

INSERT INTO `edu_school` (`school_id`, `school_name`, `country_id`, `school_address`, `school_created_date`, `school_created_by`, `school_status`, `postal_code`) VALUES
(45, 'Patrick High School', 203, 'Bedok', '2022-09-13 14:44:11', 'Admin', 'Active', '436895'),
(46, 'test3 school', 203, 'Bedok', '2022-09-15 18:19:43', 'Admin', 'Active', '436895');

-- --------------------------------------------------------

--
-- Table structure for table `edu_school_subscription`
--

CREATE TABLE `edu_school_subscription` (
  `school_subscription_id` int(11) NOT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `school_subscription_status` varchar(55) NOT NULL,
  `subscription_start_date` datetime DEFAULT NULL,
  `subscription_end_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `u_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_school_subscription`
--

INSERT INTO `edu_school_subscription` (`school_subscription_id`, `mag_id`, `article_id`, `activity_id`, `school_id`, `school_subscription_status`, `subscription_start_date`, `subscription_end_date`, `user_id`, `class_id`, `level_id`, `u_type_id`) VALUES
(3726, 5, 0, 102, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 692, 72, 55, 10),
(3727, 5, 2, 103, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 692, 72, 55, 10),
(3728, 5, 3, 104, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 692, 72, 55, 10),
(3729, 5, 1, 105, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 692, 72, 55, 10),
(3730, 5, 1, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 692, 72, 55, 10),
(3731, 5, 2, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 692, 72, 55, 10),
(3732, 5, 3, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 692, 72, 55, 10),
(3733, 5, 4, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 692, 72, 55, 10),
(3734, 5, 0, 102, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 693, 72, 55, 2),
(3735, 5, 2, 103, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 693, 72, 55, 2),
(3736, 5, 3, 104, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 693, 72, 55, 2),
(3737, 5, 1, 105, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 693, 72, 55, 2),
(3738, 5, 1, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 693, 72, 55, 2),
(3739, 5, 2, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 693, 72, 55, 2),
(3740, 5, 3, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 693, 72, 55, 2),
(3741, 5, 4, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 693, 72, 55, 2),
(3742, 5, 0, 102, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 694, 72, 55, 3),
(3743, 5, 2, 103, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 694, 72, 55, 3),
(3744, 5, 3, 104, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 694, 72, 55, 3),
(3745, 5, 1, 105, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 694, 72, 55, 3),
(3746, 5, 1, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 694, 72, 55, 3),
(3747, 5, 2, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 694, 72, 55, 3),
(3748, 5, 3, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 694, 72, 55, 3),
(3749, 5, 4, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 694, 72, 55, 3),
(3750, 5, 0, 102, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 695, 72, 55, 3),
(3751, 5, 2, 103, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 695, 72, 55, 3),
(3752, 5, 3, 104, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 695, 72, 55, 3),
(3753, 5, 1, 105, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 695, 72, 55, 3),
(3754, 5, 1, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 695, 72, 55, 3),
(3755, 5, 2, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 695, 72, 55, 3),
(3756, 5, 3, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 695, 72, 55, 3),
(3757, 5, 4, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 695, 72, 55, 3),
(3758, 5, 0, 102, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 696, 72, 55, 10),
(3759, 5, 2, 103, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 696, 72, 55, 10),
(3760, 5, 3, 104, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 696, 72, 55, 10),
(3761, 5, 1, 105, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 696, 72, 55, 10),
(3762, 5, 1, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 696, 72, 55, 10),
(3763, 5, 2, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 696, 72, 55, 10),
(3764, 5, 3, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 696, 72, 55, 10),
(3765, 5, 4, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 696, 72, 55, 10),
(3766, 5, 0, 102, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 697, 72, 55, 2),
(3767, 5, 2, 103, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 697, 72, 55, 2),
(3768, 5, 3, 104, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 697, 72, 55, 2),
(3769, 5, 1, 105, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 697, 72, 55, 2),
(3770, 5, 1, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 697, 72, 55, 2),
(3771, 5, 2, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 697, 72, 55, 2),
(3772, 5, 3, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 697, 72, 55, 2),
(3773, 5, 4, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 697, 72, 55, 2),
(3774, 5, 0, 102, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 698, 72, 55, 3),
(3775, 5, 2, 103, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 698, 72, 55, 3),
(3776, 5, 3, 104, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 698, 72, 55, 3),
(3777, 5, 1, 105, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 698, 72, 55, 3),
(3778, 5, 1, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 698, 72, 55, 3),
(3779, 5, 2, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 698, 72, 55, 3),
(3780, 5, 3, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 698, 72, 55, 3),
(3781, 5, 4, 0, 46, 'Active', '2022-09-15 00:00:00', '2022-10-08 00:00:00', 698, 72, 55, 3),
(3782, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 662, 67, 53, 10),
(3783, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 662, 67, 53, 10),
(3784, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 662, 67, 53, 10),
(3785, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 662, 67, 53, 10),
(3786, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 662, 67, 53, 10),
(3787, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 662, 67, 53, 10),
(3788, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 662, 67, 53, 10),
(3789, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 662, 67, 53, 10),
(3790, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 662, 67, 53, 10),
(3791, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 663, 67, 53, 2),
(3792, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 663, 67, 53, 2),
(3793, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 663, 67, 53, 2),
(3794, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 663, 67, 53, 2),
(3795, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 663, 67, 53, 2),
(3796, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 663, 67, 53, 2),
(3797, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 663, 67, 53, 2),
(3798, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 663, 67, 53, 2),
(3799, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 663, 67, 53, 2),
(3800, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 664, 67, 53, 3),
(3801, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 664, 67, 53, 3),
(3802, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 664, 67, 53, 3),
(3803, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 664, 67, 53, 3),
(3804, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 664, 67, 53, 3),
(3805, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 664, 67, 53, 3),
(3806, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 664, 67, 53, 3),
(3807, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 664, 67, 53, 3),
(3808, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 664, 67, 53, 3),
(3809, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 665, 67, 53, 3),
(3810, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 665, 67, 53, 3),
(3811, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 665, 67, 53, 3),
(3812, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 665, 67, 53, 3),
(3813, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 665, 67, 53, 3),
(3814, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 665, 67, 53, 3),
(3815, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 665, 67, 53, 3),
(3816, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 665, 67, 53, 3),
(3817, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 665, 67, 53, 3),
(3818, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 666, 67, 53, 3),
(3819, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 666, 67, 53, 3),
(3820, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 666, 67, 53, 3),
(3821, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 666, 67, 53, 3),
(3822, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 666, 67, 53, 3),
(3823, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 666, 67, 53, 3),
(3824, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 666, 67, 53, 3),
(3825, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 666, 67, 53, 3),
(3826, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 666, 67, 53, 3),
(3827, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 668, 68, 53, 10),
(3828, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 668, 68, 53, 10),
(3829, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 668, 68, 53, 10),
(3830, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 668, 68, 53, 10),
(3831, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 668, 68, 53, 10),
(3832, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 668, 68, 53, 10),
(3833, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 668, 68, 53, 10),
(3834, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 668, 68, 53, 10),
(3835, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 668, 68, 53, 10),
(3836, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 669, 68, 53, 2),
(3837, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 669, 68, 53, 2),
(3838, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 669, 68, 53, 2),
(3839, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 669, 68, 53, 2),
(3840, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 669, 68, 53, 2),
(3841, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 669, 68, 53, 2),
(3842, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 669, 68, 53, 2),
(3843, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 669, 68, 53, 2),
(3844, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 669, 68, 53, 2),
(3845, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 670, 68, 53, 3),
(3846, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 670, 68, 53, 3),
(3847, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 670, 68, 53, 3),
(3848, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 670, 68, 53, 3),
(3849, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 670, 68, 53, 3),
(3850, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 670, 68, 53, 3),
(3851, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 670, 68, 53, 3),
(3852, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 670, 68, 53, 3),
(3853, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 670, 68, 53, 3),
(3854, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 671, 68, 53, 3),
(3855, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 671, 68, 53, 3),
(3856, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 671, 68, 53, 3),
(3857, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 671, 68, 53, 3),
(3858, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 671, 68, 53, 3),
(3859, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 671, 68, 53, 3),
(3860, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 671, 68, 53, 3),
(3861, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 671, 68, 53, 3),
(3862, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 671, 68, 53, 3),
(3863, 5, 0, 102, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 672, 68, 53, 3),
(3864, 5, 2, 103, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 672, 68, 53, 3),
(3865, 5, 3, 104, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 672, 68, 53, 3),
(3866, 5, 1, 105, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 672, 68, 53, 3),
(3867, 5, 0, 106, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 672, 68, 53, 3),
(3868, 5, 1, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 672, 68, 53, 3),
(3869, 5, 2, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 672, 68, 53, 3),
(3870, 5, 3, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 672, 68, 53, 3),
(3871, 5, 4, 0, 45, 'Active', '2022-09-15 00:00:00', '2022-10-09 00:00:00', 672, 68, 53, 3);

-- --------------------------------------------------------

--
-- Table structure for table `edu_subscription_info`
--

CREATE TABLE `edu_subscription_info` (
  `subscription_info_id` int(11) NOT NULL,
  `user_school_lvl_class_id` int(11) NOT NULL,
  `school_subscription_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_task`
--

CREATE TABLE `edu_task` (
  `task_id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `mag_id` int(11) DEFAULT NULL,
  `published_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `task_status` varchar(55) NOT NULL,
  `peer_id` int(11) DEFAULT NULL,
  `lockitem` int(11) NOT NULL,
  `contentaid` int(11) NOT NULL,
  `receivequestions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_task`
--

INSERT INTO `edu_task` (`task_id`, `article_id`, `activity_id`, `mag_id`, `published_date`, `due_date`, `assigned_by`, `school_id`, `level_id`, `class_id`, `task_status`, `peer_id`, `lockitem`, `contentaid`, `receivequestions`) VALUES
(325, 4, 0, 5, '2022-09-12 02:35:39', '2022-09-30 00:00:00', 631, 42, 43, 59, 'Active', 0, 0, 0, 0),
(327, 4, 78, 5, '2022-09-12 02:21:19', '2022-10-08 00:00:00', 631, 42, 43, 59, 'Active', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `edu_users`
--

CREATE TABLE `edu_users` (
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_status` varchar(55) NOT NULL,
  `user_created_date` datetime NOT NULL,
  `user_created_by` varchar(255) NOT NULL,
  `user_image_path` varchar(255) DEFAULT NULL,
  `user_modified_by` varchar(255) DEFAULT NULL,
  `user_modified_date` datetime DEFAULT NULL,
  `first_time_password_change` int(11) NOT NULL,
  `tooltip` int(11) NOT NULL,
  `assigned_article_notify` int(11) DEFAULT NULL,
  `assigned_activity_notify` int(11) DEFAULT NULL,
  `assigned_activity_review_notify` int(11) DEFAULT NULL,
  `suspended` int(11) DEFAULT NULL,
  `removed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_users`
--

INSERT INTO `edu_users` (`user_id`, `user_type_id`, `username`, `user_email`, `user_password`, `first_name`, `last_name`, `user_status`, `user_created_date`, `user_created_by`, `user_image_path`, `user_modified_by`, `user_modified_date`, `first_time_password_change`, `tooltip`, `assigned_article_notify`, `assigned_activity_notify`, `assigned_activity_review_notify`, `suspended`, `removed`) VALUES
(1, 1, 'admin', 'admin@edutique.com.sg', '$2y$10$R9s9paVWg6R4.yvnNBZZwOV04OEl7asToVDxdzWzWUrmrFDw6BUGu', 'Admin', 'ILR', 'Active', '2021-09-30 15:15:50', 'admin', '3701.png', NULL, NULL, 1, 1, NULL, NULL, NULL, 0, 0),
(662, 10, 'tai89alex1p2', 'jen_tan11p2@moe.edu.sg', '$2y$10$kjKML.NUZNwjbp/jMZ05iOcm.j8U3Zg472BZN3YUxB2TiPAxVsiCC', 'Alex1p2', 'Tai1', 'Active', '2022-09-13 14:44:11', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(663, 2, 'ching131p2', 'alex_lim101p2@test.com', '$2y$10$5fObMrI8SklyRdD.LS4LZeBQvF.1dNdWZhv7U8rn4XpFnV7wll1qa', 'Sean1p2', 'Ching', 'Active', '2022-09-13 14:44:11', 'Admin', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(664, 3, 'teoh651p2', 'micheal021p2@dunmanhigh.com.sg', '$2y$10$.zwJI2Jzb./QMKzswRV7l.KzQlRwBBl.k1c2FI18mghy5alfiB7TG', 'Michael1p2', 'Teoh', 'Active', '2022-09-13 14:44:11', 'Admin', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(665, 3, 'woon6541p2', 'milton81p2@dunmanhigh.com.sg', '$2y$10$e0MpZ/xzjC36Fpog6Qv/oezlhgHEcOONqe8vPBQijqzjxvlgEGdK2', 'Milton1p2', 'Woon', 'Active', '2022-09-13 14:44:11', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(666, 3, 'josghong121p2', 'jos_goh1p2@test.com', '$2y$10$R5ikcmEBf7OEIh8mA5nn6OyOz3GwF4heS0L.MAGMJUWpVL82Wl8gm', 'Joseph1p2', 'Goh', 'Active', '2022-09-13 14:44:11', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(668, 10, 'tai89alex1p2e', 'jen_tan11p2e@moe.edu.sg', '$2y$10$PAhFtDNLyqkS8Y0585liKOpEiybqJ/lCYW0pimT6mfvmDsidJO/mK', 'Alex1p2e', 'Tai1', 'Active', '2022-09-13 15:59:10', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(669, 2, 'ching131p2e', 'alex_lim101p2e@test.com', '$2y$10$sWKdEeuNJQz6jcQ2xaCrmeGZPZCOBJ2NDUtrGDneFzCR43.SiqOrK', 'Sean1p2e', 'Ching', 'Active', '2022-09-13 15:59:10', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(670, 3, 'teoh651p2e', 'micheal021p2e@dunmanhigh.com.sg', '$2y$10$IlbhSf.Mj8qiYkcZZ6aK6O33FUOwV8VRxB3IrMOiRszPRfD2mQEPm', 'Michael1p2e', 'Teoh', 'Active', '2022-09-13 15:59:10', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(671, 3, 'woon6541p2e', 'milton81p2e@dunmanhigh.com.sg', '$2y$10$J4jxKoe4/dYQssvJcWmvL.u.nmExpmQ7Fh1BLsr30w9saA3q9a1Rm', 'Milton1p2e', 'Woon', 'Active', '2022-09-13 15:59:10', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(672, 3, 'josghong121p2e', 'jos_goh1p2e@test.com', '$2y$10$lTD9vBQ/gK33gxgepzNf/O21CeEBeAag4yzxT44vzx1GTpi06DWuK', 'Joseph1p2e', 'Goh', 'Active', '2022-09-13 15:59:10', 'Admin', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL),
(674, 10, 'tai89alex1p2e3', 'jen_tan11p2e3@moe.edu.sg', '$2y$10$64M/s7hJeFxino3ARPRndORJMAMwvKkjzeQ2zLzld8/uO9ifnaaLm', 'Alex1p2e3', 'Tai1', 'Active', '2022-09-13 16:07:57', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(675, 2, 'ching131p2e3', 'alex_lim101p2e3@test.com', '$2y$10$2XTPPPZTGMU1uHEBliAUL.UH.hdHR1v29d8aRpndxL7/IS4ttBWxu', 'Sean1p2e3', 'Ching', 'Active', '2022-09-13 16:07:57', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(676, 3, 'teoh651p2e3', 'micheal021p2e3@dunmanhigh.com.sg', '$2y$10$mD2UWKJv31IQdGaxImCPgum88BGqrwpTZQP5lncgK9FxlaNsJ4R0q', 'Michael1p2e3', 'Teoh', 'Active', '2022-09-13 16:07:57', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(677, 3, 'woon6541p2e3', 'milton81p2e3@dunmanhigh.com.sg', '$2y$10$amQBVgTw0WFk6tUuEwNH5.jPSt00pbZWMgyRWE.aww87vLtH2aSYO', 'Milton1p2e3', 'Woon', 'Active', '2022-09-13 16:07:57', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(678, 3, 'josghong121p2e3', 'jos_goh1p2e3@test.com', '$2y$10$/C5byrxarkeruxkIHvznhusmOvNAsxzwzN82u3/5RuBrT3.IomL32', 'Joseph1p2e3', 'Goh', 'Active', '2022-09-13 16:07:57', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(692, 10, 'tai89alex1ts', 'jen_tan11ts@moe.edu.sg', '$2y$10$q2qS4QHrS31b6sctHTCbMe6Z49e6ZEC6PBfmmEc6DHx8a.lCQtwc6', 'Alex1ts', 'Tai1', 'Active', '2022-09-15 18:19:43', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(693, 2, 'ching131ts', 'alex_lim101ts@test.com', '$2y$10$aDndE1OwcMe4sFeoHtFQ0.nQIv.BW2JKUna9Hl7No86GiDRS0eqvG', 'Sean1', 'Ching', 'Active', '2022-09-15 18:19:43', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(694, 3, 'teoh651ts', 'micheal021ts@dunmanhigh.com.sg', '$2y$10$6ygPXzhMMmUE2ki0t027E.inNC5F2ZVsZphyHt6DLAOdex5tbGLdS', 'Michael1', 'Teoh', 'Active', '2022-09-15 18:19:43', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(695, 3, 'woon6541ts', 'milton81ts@dunmanhigh.com.sg', '$2y$10$rLralPKuPvzGN2NJzJRZSuBVknT3mkThpCFSun2b24fm2w9HrG0M6', 'Milton1', 'Woon', 'Active', '2022-09-15 18:19:43', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(696, 10, '100lee1ts', 'jisb051ts@moe.edu.sg', '$2y$10$vu62xYsHlTq/YVSijNW8nuArJrh/SE601G9fZoCNeFJgQyQ/3g0OS', 'Jiasheng1', 'Lee', 'Active', '2022-09-15 18:19:43', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(697, 2, 'wong111ts', 'chua881ts@test.com', '$2y$10$0OQlwi9JwvEyvoc4GOvwp.H9JglRqvE9YRp0JrMVmxQ02FZI3W/x6', 'Chua1', 'Wong', 'Active', '2022-09-15 18:19:43', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(698, 3, 'josghong121ts', 'jos_goh1ts@test.com', '$2y$10$6KNPix/1EEsWgEA1ZH1UHuAxlLqATzrC251JV75L85iUOqjrHGgzq', 'Joseph1', 'Goh', 'Active', '2022-09-15 18:19:43', 'Admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edu_users_temp`
--

CREATE TABLE `edu_users_temp` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `edu_user_school_level_class`
--

CREATE TABLE `edu_user_school_level_class` (
  `user_school_lvl_class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_user_school_level_class`
--

INSERT INTO `edu_user_school_level_class` (`user_school_lvl_class_id`, `user_id`, `school_id`, `class_id`, `level_id`) VALUES
(1016, 662, 45, 67, 53),
(1017, 663, 45, 67, 53),
(1018, 664, 45, 67, 53),
(1019, 665, 45, 67, 53),
(1020, 666, 45, 67, 53),
(1023, 668, 45, 68, 53),
(1024, 669, 45, 68, 53),
(1025, 670, 45, 68, 53),
(1026, 671, 45, 68, 53),
(1027, 672, 45, 68, 53),
(1030, 674, 45, 69, 54),
(1031, 675, 45, 69, 54),
(1032, 676, 45, 69, 54),
(1033, 677, 45, 69, 54),
(1034, 678, 45, 69, 54),
(1049, 692, 46, 72, 55),
(1050, 693, 46, 72, 55),
(1051, 694, 46, 72, 55),
(1052, 695, 46, 72, 55),
(1053, 696, 46, 72, 55),
(1054, 697, 46, 72, 55),
(1055, 698, 46, 72, 55);

-- --------------------------------------------------------

--
-- Table structure for table `edu_user_task`
--

CREATE TABLE `edu_user_task` (
  `id` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `task_stages` varchar(55) NOT NULL,
  `task_id` int(11) NOT NULL,
  `completed_date` datetime DEFAULT NULL,
  `article_ids` int(11) DEFAULT NULL,
  `activity_ids` int(11) DEFAULT NULL,
  `class_ids` int(11) DEFAULT NULL,
  `level_ids` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_user_task`
--

INSERT INTO `edu_user_task` (`id`, `assigned_to`, `task_stages`, `task_id`, `completed_date`, `article_ids`, `activity_ids`, `class_ids`, `level_ids`) VALUES
(389, 632, 'Unopened', 321, NULL, 1, 61, 59, NULL),
(390, 633, 'Completed', 321, NULL, 1, 61, 59, NULL),
(391, 632, 'Incomplete', 322, NULL, 2, 62, 59, NULL),
(392, 633, 'Completed', 322, NULL, 2, 62, 59, NULL),
(395, 632, 'Unopened', 325, NULL, 4, 0, 59, NULL),
(396, 633, 'Unopened', 325, NULL, 4, 0, 59, NULL),
(397, 632, 'Completed', 327, '2022-09-12 14:50:23', 4, 78, 59, NULL),
(398, 633, 'Unopened', 327, NULL, 4, 78, 59, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edu_utype`
--

CREATE TABLE `edu_utype` (
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(55) NOT NULL,
  `user_type_status` varchar(55) NOT NULL,
  `utype_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_utype`
--

INSERT INTO `edu_utype` (`user_type_id`, `user_type`, `user_type_status`, `utype_id`) VALUES
(1, 'Admin', 'Active', 5),
(2, 'Class Teacher', 'Active', 2),
(3, 'Student', 'Active', 3),
(10, 'Teacher Incharge of the Programme', 'Active', 4),
(11, 'Individual Subscriber', 'Active', 6),
(12, 'Super Admin', 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `edu_wordbank`
--

CREATE TABLE `edu_wordbank` (
  `id` int(11) NOT NULL,
  `wname` varchar(255) NOT NULL,
  `wdescription` text NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `wstatus` varchar(55) NOT NULL,
  `foldnameid` int(11) NOT NULL,
  `wordbank_typeid` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `mag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_wordbank`
--

INSERT INTO `edu_wordbank` (`id`, `wname`, `wdescription`, `added_date`, `added_by`, `wstatus`, `foldnameid`, `wordbank_typeid`, `art_id`, `act_id`, `mag_id`) VALUES
(61, 'fashionista', 'Test1', '2022-07-11 12:56:52', 1, 'Active', 54, 28, 4, 0, 5),
(62, 'comfortably', 'Test2', '2022-07-11 12:57:21', 1, 'Active', 55, 28, 4, 0, 5),
(64, 'movement comfortably', 'fgd', '2022-09-09 00:44:37', 1, 'Active', 55, 28, 1, 0, 5),
(65, 'corporation', 'kkkkk', '2022-09-09 01:52:44', 1, 'Active', 54, 28, 4, 78, 5),
(66, 'comfortable wearing', 'test', '2022-09-09 02:02:30', 1, 'Active', 55, 28, 1, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `edu_wordbank_type`
--

CREATE TABLE `edu_wordbank_type` (
  `id` int(11) NOT NULL,
  `wordbank_type` varchar(255) NOT NULL,
  `status` varchar(55) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_wordbank_type`
--

INSERT INTO `edu_wordbank_type` (`id`, `wordbank_type`, `status`, `created_by`, `created_date`) VALUES
(28, 'General', 'Active', 1, '2022-07-01 10:00:47'),
(29, 'General', 'Active', 208, '2022-07-12 15:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `edu_wordfolder`
--

CREATE TABLE `edu_wordfolder` (
  `id` int(11) NOT NULL,
  `foldnameid` int(11) NOT NULL,
  `status` varchar(55) NOT NULL,
  `folder_color` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `edu_wordfolder`
--

INSERT INTO `edu_wordfolder` (`id`, `foldnameid`, `status`, `folder_color`, `created_date`, `created_by`) VALUES
(54, 28, 'Active', '#ffbdf2', '2022-07-01 10:00:47', 1),
(55, 28, 'Active', '#81caff', '2022-07-11 12:57:14', 1),
(56, 29, 'Active', '#ffafa4', '2022-07-12 15:33:06', 208);

-- --------------------------------------------------------

--
-- Table structure for table `mag_act_ans`
--

CREATE TABLE `mag_act_ans` (
  `id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `mag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mag_act_ans`
--

INSERT INTO `mag_act_ans` (`id`, `art_id`, `act_id`, `mag_id`) VALUES
(1, 1, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mag_act_ans_detail`
--

CREATE TABLE `mag_act_ans_detail` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `qans1` text NOT NULL,
  `qans2` text NOT NULL,
  `suggested_ans` text NOT NULL,
  `mag_act_ans_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mag_act_ans_detail`
--

INSERT INTO `mag_act_ans_detail` (`id`, `question`, `qans1`, `qans2`, `suggested_ans`, `mag_act_ans_id`, `mark`) VALUES
(1, '“Adoption are complicated, but it is also rich with narratives of strenght.” — Jillian Lauren', 'is', 'strength', 'test', 1, 1),
(2, '“God new that it doesn’t matter how your children get to your family. It just matter that they got there.” — Kira Mortenson', 'knew', 'matters', 'test', 1, 1),
(3, '“What makes you a man is not the ability to make a child, it’s the courage to raise one.” — Barack Obama', 'Smiley', 'Smiley', 'test', 1, 1),
(4, '“I am a liveing testament you can be adopted and sucessfull.” — Daunte Culpepper', 'living', 'successful', 'test', 1, 1),
(5, '“We always wanted to adopt, and when the opportunity open up, we did it to help change a children’s life.” — Willie Robertson', 'opened', 'child\'s', 'test', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stu_act_performed`
--

CREATE TABLE `stu_act_performed` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `act_comp_status` varchar(55) DEFAULT NULL,
  `marks_obtained` int(55) DEFAULT NULL,
  `art_id` int(11) NOT NULL,
  `mag_id` int(11) NOT NULL,
  `submitted_on` datetime NOT NULL,
  `attempt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stu_act_performed`
--

INSERT INTO `stu_act_performed` (`id`, `user_id`, `act_id`, `act_comp_status`, `marks_obtained`, `art_id`, `mag_id`, `submitted_on`, `attempt`) VALUES
(49, 3, 3, 'Completed', 1, 1, 3, '2022-06-13 00:02:33', 1),
(50, 208, 1, 'Completed', 1, 4, 5, '2022-07-05 15:58:41', 1),
(51, 561, 9, 'Completed', 1, 10, 5, '2022-07-23 17:35:14', 1),
(52, 561, 11, 'Completed', 1, 8, 5, '2022-07-23 17:36:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stu_act_performed_detail`
--

CREATE TABLE `stu_act_performed_detail` (
  `id` int(11) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `qans1` text NOT NULL,
  `qans2` text NOT NULL,
  `stu_act_performed_id` int(11) NOT NULL,
  `is_true` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stu_act_performed_detail`
--

INSERT INTO `stu_act_performed_detail` (`id`, `ques_id`, `qans1`, `qans2`, `stu_act_performed_id`, `is_true`) VALUES
(154, 1, 'is', 'strength', 49, 1),
(155, 2, 'test', 'test', 49, 0),
(156, 3, 'Smiley', 'Smiley', 49, 1),
(157, 4, 'living', 'successful', 49, 1),
(158, 5, 'test', 'test', 49, 0),
(159, 0, 'is', 'strength', 50, 0),
(160, 1, 'dd', 'dd', 50, 0),
(161, 2, 'f', 'f', 50, 0),
(162, 3, 'living', 'successful', 50, 0),
(163, 4, 'dx', 'd', 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `user_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_status` varchar(55) DEFAULT NULL,
  `user_created_date` datetime DEFAULT NULL,
  `user_created_by` varchar(255) DEFAULT NULL,
  `user_image_path` varchar(255) DEFAULT NULL,
  `user_modified_by` varchar(255) DEFAULT NULL,
  `user_modified_date` datetime DEFAULT NULL,
  `first_time_password_change` int(11) DEFAULT NULL,
  `tooltip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `edu_activity`
--
ALTER TABLE `edu_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `edu_activity_audio`
--
ALTER TABLE `edu_activity_audio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_activity_audio_dummy`
--
ALTER TABLE `edu_activity_audio_dummy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_activity_dummy`
--
ALTER TABLE `edu_activity_dummy`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `edu_activity_result`
--
ALTER TABLE `edu_activity_result`
  ADD PRIMARY KEY (`activity_result_id`);

--
-- Indexes for table `edu_activity_type`
--
ALTER TABLE `edu_activity_type`
  ADD PRIMARY KEY (`activity_type_id`);

--
-- Indexes for table `edu_aid`
--
ALTER TABLE `edu_aid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_annotation_bookmark`
--
ALTER TABLE `edu_annotation_bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_annotation_comments`
--
ALTER TABLE `edu_annotation_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_annotation_sticky`
--
ALTER TABLE `edu_annotation_sticky`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_annotation_text_highlight`
--
ALTER TABLE `edu_annotation_text_highlight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_article`
--
ALTER TABLE `edu_article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `edu_article_audio`
--
ALTER TABLE `edu_article_audio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_article_audio_dummy`
--
ALTER TABLE `edu_article_audio_dummy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_article_dummy`
--
ALTER TABLE `edu_article_dummy`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `edu_bookmarkfolder`
--
ALTER TABLE `edu_bookmarkfolder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_bookmark_type`
--
ALTER TABLE `edu_bookmark_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_chat_message`
--
ALTER TABLE `edu_chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `edu_class`
--
ALTER TABLE `edu_class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `edu_comments`
--
ALTER TABLE `edu_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `edu_comment_replies`
--
ALTER TABLE `edu_comment_replies`
  ADD PRIMARY KEY (`comment_replies_id`);

--
-- Indexes for table `edu_content_tracking`
--
ALTER TABLE `edu_content_tracking`
  ADD PRIMARY KEY (`content_track_id`);

--
-- Indexes for table `edu_country`
--
ALTER TABLE `edu_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `edu_essay_type`
--
ALTER TABLE `edu_essay_type`
  ADD PRIMARY KEY (`essay_type_id`);

--
-- Indexes for table `edu_faq`
--
ALTER TABLE `edu_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `edu_faq_type`
--
ALTER TABLE `edu_faq_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_feedback`
--
ALTER TABLE `edu_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `edu_levels`
--
ALTER TABLE `edu_levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `edu_level_class_temp`
--
ALTER TABLE `edu_level_class_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_log`
--
ALTER TABLE `edu_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `edu_login_details`
--
ALTER TABLE `edu_login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `edu_magazine`
--
ALTER TABLE `edu_magazine`
  ADD PRIMARY KEY (`mag_id`);

--
-- Indexes for table `edu_mag_dum`
--
ALTER TABLE `edu_mag_dum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_mag_type`
--
ALTER TABLE `edu_mag_type`
  ADD PRIMARY KEY (`mag_type_id`);

--
-- Indexes for table `edu_messages`
--
ALTER TABLE `edu_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_notes`
--
ALTER TABLE `edu_notes`
  ADD PRIMARY KEY (`notes_id`);

--
-- Indexes for table `edu_noti`
--
ALTER TABLE `edu_noti`
  ADD PRIMARY KEY (`noti_id`);

--
-- Indexes for table `edu_onoff`
--
ALTER TABLE `edu_onoff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_onoff_bulk`
--
ALTER TABLE `edu_onoff_bulk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_question_portal`
--
ALTER TABLE `edu_question_portal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_reflection`
--
ALTER TABLE `edu_reflection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_review`
--
ALTER TABLE `edu_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `edu_school`
--
ALTER TABLE `edu_school`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `edu_school_subscription`
--
ALTER TABLE `edu_school_subscription`
  ADD PRIMARY KEY (`school_subscription_id`);

--
-- Indexes for table `edu_subscription_info`
--
ALTER TABLE `edu_subscription_info`
  ADD PRIMARY KEY (`subscription_info_id`);

--
-- Indexes for table `edu_task`
--
ALTER TABLE `edu_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `edu_users`
--
ALTER TABLE `edu_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `edu_users_temp`
--
ALTER TABLE `edu_users_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_user_school_level_class`
--
ALTER TABLE `edu_user_school_level_class`
  ADD PRIMARY KEY (`user_school_lvl_class_id`);

--
-- Indexes for table `edu_user_task`
--
ALTER TABLE `edu_user_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_utype`
--
ALTER TABLE `edu_utype`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `edu_wordbank`
--
ALTER TABLE `edu_wordbank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_wordbank_type`
--
ALTER TABLE `edu_wordbank_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_wordfolder`
--
ALTER TABLE `edu_wordfolder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mag_act_ans`
--
ALTER TABLE `mag_act_ans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mag_act_ans_detail`
--
ALTER TABLE `mag_act_ans_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stu_act_performed`
--
ALTER TABLE `stu_act_performed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stu_act_performed_detail`
--
ALTER TABLE `stu_act_performed_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `edu_activity`
--
ALTER TABLE `edu_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `edu_activity_audio`
--
ALTER TABLE `edu_activity_audio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `edu_activity_audio_dummy`
--
ALTER TABLE `edu_activity_audio_dummy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `edu_activity_dummy`
--
ALTER TABLE `edu_activity_dummy`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `edu_activity_result`
--
ALTER TABLE `edu_activity_result`
  MODIFY `activity_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `edu_activity_type`
--
ALTER TABLE `edu_activity_type`
  MODIFY `activity_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `edu_aid`
--
ALTER TABLE `edu_aid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `edu_annotation_bookmark`
--
ALTER TABLE `edu_annotation_bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `edu_annotation_comments`
--
ALTER TABLE `edu_annotation_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `edu_annotation_sticky`
--
ALTER TABLE `edu_annotation_sticky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `edu_annotation_text_highlight`
--
ALTER TABLE `edu_annotation_text_highlight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `edu_article`
--
ALTER TABLE `edu_article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `edu_article_audio`
--
ALTER TABLE `edu_article_audio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `edu_article_audio_dummy`
--
ALTER TABLE `edu_article_audio_dummy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `edu_article_dummy`
--
ALTER TABLE `edu_article_dummy`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `edu_bookmarkfolder`
--
ALTER TABLE `edu_bookmarkfolder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `edu_bookmark_type`
--
ALTER TABLE `edu_bookmark_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `edu_chat_message`
--
ALTER TABLE `edu_chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `edu_class`
--
ALTER TABLE `edu_class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `edu_comments`
--
ALTER TABLE `edu_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edu_comment_replies`
--
ALTER TABLE `edu_comment_replies`
  MODIFY `comment_replies_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edu_content_tracking`
--
ALTER TABLE `edu_content_tracking`
  MODIFY `content_track_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edu_country`
--
ALTER TABLE `edu_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `edu_essay_type`
--
ALTER TABLE `edu_essay_type`
  MODIFY `essay_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `edu_faq`
--
ALTER TABLE `edu_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `edu_faq_type`
--
ALTER TABLE `edu_faq_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `edu_feedback`
--
ALTER TABLE `edu_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `edu_levels`
--
ALTER TABLE `edu_levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `edu_level_class_temp`
--
ALTER TABLE `edu_level_class_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1267;

--
-- AUTO_INCREMENT for table `edu_log`
--
ALTER TABLE `edu_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=746;

--
-- AUTO_INCREMENT for table `edu_login_details`
--
ALTER TABLE `edu_login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=588;

--
-- AUTO_INCREMENT for table `edu_magazine`
--
ALTER TABLE `edu_magazine`
  MODIFY `mag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `edu_mag_dum`
--
ALTER TABLE `edu_mag_dum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `edu_mag_type`
--
ALTER TABLE `edu_mag_type`
  MODIFY `mag_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `edu_messages`
--
ALTER TABLE `edu_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `edu_notes`
--
ALTER TABLE `edu_notes`
  MODIFY `notes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edu_noti`
--
ALTER TABLE `edu_noti`
  MODIFY `noti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `edu_onoff`
--
ALTER TABLE `edu_onoff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `edu_onoff_bulk`
--
ALTER TABLE `edu_onoff_bulk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `edu_question_portal`
--
ALTER TABLE `edu_question_portal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `edu_reflection`
--
ALTER TABLE `edu_reflection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `edu_review`
--
ALTER TABLE `edu_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `edu_school`
--
ALTER TABLE `edu_school`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `edu_school_subscription`
--
ALTER TABLE `edu_school_subscription`
  MODIFY `school_subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3872;

--
-- AUTO_INCREMENT for table `edu_subscription_info`
--
ALTER TABLE `edu_subscription_info`
  MODIFY `subscription_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `edu_task`
--
ALTER TABLE `edu_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT for table `edu_users`
--
ALTER TABLE `edu_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=699;

--
-- AUTO_INCREMENT for table `edu_users_temp`
--
ALTER TABLE `edu_users_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `edu_user_school_level_class`
--
ALTER TABLE `edu_user_school_level_class`
  MODIFY `user_school_lvl_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1056;

--
-- AUTO_INCREMENT for table `edu_user_task`
--
ALTER TABLE `edu_user_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=399;

--
-- AUTO_INCREMENT for table `edu_utype`
--
ALTER TABLE `edu_utype`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `edu_wordbank`
--
ALTER TABLE `edu_wordbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `edu_wordbank_type`
--
ALTER TABLE `edu_wordbank_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `edu_wordfolder`
--
ALTER TABLE `edu_wordfolder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `mag_act_ans`
--
ALTER TABLE `mag_act_ans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mag_act_ans_detail`
--
ALTER TABLE `mag_act_ans_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stu_act_performed`
--
ALTER TABLE `stu_act_performed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `stu_act_performed_detail`
--
ALTER TABLE `stu_act_performed_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
