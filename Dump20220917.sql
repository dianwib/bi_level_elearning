-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: adaptive_db
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_count`
--

DROP TABLE IF EXISTS `activity_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_count` (
  `activity_id` int unsigned NOT NULL AUTO_INCREMENT,
  `usr_id` int NOT NULL,
  `crs_id` int NOT NULL,
  `view_content` int DEFAULT '0',
  `done_assessment` int DEFAULT '0',
  `uploaded` int DEFAULT '0',
  `create_thread` int DEFAULT '0',
  `create_reply` int DEFAULT '0',
  `view_thread` int DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `at_risk`
--

DROP TABLE IF EXISTS `at_risk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `at_risk` (
  `ar_id` int NOT NULL AUTO_INCREMENT,
  `usr_id` int unsigned DEFAULT NULL,
  `ass_id` int unsigned DEFAULT NULL,
  `crs_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`ar_id`),
  KEY `usr_id` (`usr_id`),
  KEY `crs_id` (`crs_id`),
  KEY `ass_id` (`ass_id`),
  CONSTRAINT `at_risk_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `at_risk_ibfk_3` FOREIGN KEY (`crs_id`) REFERENCES `course` (`crs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `at_risk_ibfk_4` FOREIGN KEY (`ass_id`) REFERENCES `course_assesment` (`ass_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course` (
  `crs_id` int unsigned NOT NULL AUTO_INCREMENT,
  `crs_code` varchar(10) NOT NULL,
  `crs_name` varchar(50) NOT NULL,
  `crs_summary` longtext,
  `crs_univ` varchar(50) DEFAULT NULL,
  `crs_timecreated` timestamp NULL DEFAULT NULL,
  `crs_timemodified` timestamp NULL DEFAULT NULL,
  `cat_id` int unsigned NOT NULL,
  `usr_id` int unsigned NOT NULL,
  PRIMARY KEY (`crs_id`),
  UNIQUE KEY `crs_code` (`crs_code`),
  KEY `course_category_course_foreign` (`cat_id`),
  KEY `course_user_foreign` (`usr_id`),
  CONSTRAINT `course_category_course_foreign` FOREIGN KEY (`cat_id`) REFERENCES `course_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `course_user_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_assesment`
--

DROP TABLE IF EXISTS `course_assesment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_assesment` (
  `ass_id` int unsigned NOT NULL AUTO_INCREMENT,
  `ass_tipe` varchar(20) NOT NULL,
  `ass_name` varchar(50) NOT NULL,
  `ass_desc` varchar(150) NOT NULL,
  `ass_timeopen` timestamp NULL DEFAULT NULL,
  `ass_timeclose` timestamp NULL DEFAULT NULL,
  `ass_shufflequestions` varchar(10) DEFAULT NULL,
  `ass_timelimit` int DEFAULT NULL,
  `ass_timecreated` timestamp NULL DEFAULT NULL,
  `ass_timemodified` timestamp NULL DEFAULT NULL,
  `crs_id` int unsigned NOT NULL,
  PRIMARY KEY (`ass_id`),
  KEY `course_assesment_foreign` (`crs_id`),
  CONSTRAINT `course_assesment_foreign` FOREIGN KEY (`crs_id`) REFERENCES `course` (`crs_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_assesment_question`
--

DROP TABLE IF EXISTS `course_assesment_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_assesment_question` (
  `qst_id` int unsigned NOT NULL AUTO_INCREMENT,
  `qst_text` varchar(500) NOT NULL,
  `qst_shuffleanswers` varchar(10) DEFAULT NULL,
  `qst_timecreated` timestamp NULL DEFAULT NULL,
  `qst_timemodified` timestamp NULL DEFAULT NULL,
  `ass_id` int unsigned NOT NULL,
  `loc_id` int unsigned NOT NULL,
  `lsn_id` int DEFAULT NULL,
  PRIMARY KEY (`qst_id`),
  KEY `assesment_questions_foreign` (`ass_id`),
  CONSTRAINT `assesment_questions_foreign` FOREIGN KEY (`ass_id`) REFERENCES `course_assesment` (`ass_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_assesment_questions_answer`
--

DROP TABLE IF EXISTS `course_assesment_questions_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_assesment_questions_answer` (
  `ans_id` int unsigned NOT NULL AUTO_INCREMENT,
  `ans_text` varchar(500) NOT NULL,
  `ans_point` decimal(12,7) DEFAULT NULL,
  `qst_id` int unsigned NOT NULL,
  PRIMARY KEY (`ans_id`),
  KEY `questions_answers_foreign` (`qst_id`),
  CONSTRAINT `questions_answers_foreign` FOREIGN KEY (`qst_id`) REFERENCES `course_assesment_question` (`qst_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_assesment_questions_answer_of_student`
--

DROP TABLE IF EXISTS `course_assesment_questions_answer_of_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_assesment_questions_answer_of_student` (
  `ast_id` int unsigned NOT NULL AUTO_INCREMENT,
  `ast_point` decimal(12,7) DEFAULT NULL,
  `ass_id` int unsigned NOT NULL,
  `ans_id` int unsigned NOT NULL,
  `usr_id` int unsigned NOT NULL,
  PRIMARY KEY (`ast_id`),
  KEY `assesment_answerstudent_foreign` (`ass_id`),
  KEY `question_answerstudent_foreign` (`ans_id`),
  KEY `users_answerstudent_foreign` (`usr_id`),
  CONSTRAINT `answer_answerstudent_foreign` FOREIGN KEY (`ans_id`) REFERENCES `course_assesment_questions_answer` (`ans_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assesment_answerstudent_foreign` FOREIGN KEY (`ass_id`) REFERENCES `course_assesment` (`ass_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_answerstudent_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_assesment_result`
--

DROP TABLE IF EXISTS `course_assesment_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_assesment_result` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ass_id` int unsigned NOT NULL,
  `ass_result` float DEFAULT NULL,
  `usr_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assesment_foreign` (`ass_id`),
  KEY `user_foreign` (`usr_id`),
  CONSTRAINT `assesment_foreign` FOREIGN KEY (`ass_id`) REFERENCES `course_assesment` (`ass_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_assignment`
--

DROP TABLE IF EXISTS `course_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_assignment` (
  `asg_id` int unsigned NOT NULL AUTO_INCREMENT,
  `asg_name` varchar(50) NOT NULL,
  `asg_text` varchar(500) NOT NULL,
  `asg_attachment` varchar(500) DEFAULT NULL,
  `asg_duedate` datetime DEFAULT NULL,
  `asg_timecreated` timestamp NULL DEFAULT NULL,
  `asg_timemodified` timestamp NULL DEFAULT NULL,
  `crs_id` int unsigned NOT NULL,
  PRIMARY KEY (`asg_id`),
  KEY `course_assignment_foreign` (`crs_id`),
  CONSTRAINT `course_assignment_foreign` FOREIGN KEY (`crs_id`) REFERENCES `course` (`crs_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_assignment_loc`
--

DROP TABLE IF EXISTS `course_assignment_loc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_assignment_loc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `asg_id` int unsigned NOT NULL,
  `loc_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `asg_foreign` (`asg_id`),
  KEY `loc_foreign` (`loc_id`),
  CONSTRAINT `asg_foreign` FOREIGN KEY (`asg_id`) REFERENCES `course_assignment` (`asg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `loc_foreign` FOREIGN KEY (`loc_id`) REFERENCES `course_learning_outcomes` (`loc_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_assignment_submission`
--

DROP TABLE IF EXISTS `course_assignment_submission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_assignment_submission` (
  `sub_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sub_attachment` varchar(500) DEFAULT NULL,
  `sub_comment` varchar(500) NOT NULL,
  `sub_due_status` varchar(30) DEFAULT NULL,
  `sub_timecreated` timestamp NULL DEFAULT NULL,
  `sub_timemodified` timestamp NULL DEFAULT NULL,
  `usr_id` int unsigned NOT NULL,
  `asg_id` int unsigned NOT NULL,
  PRIMARY KEY (`sub_id`),
  KEY `assignment_submission_foreign` (`asg_id`),
  KEY `user_submission_foreign` (`usr_id`),
  CONSTRAINT `assignment_submission_foreign` FOREIGN KEY (`asg_id`) REFERENCES `course_assignment` (`asg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_submission_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_category`
--

DROP TABLE IF EXISTS `course_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_category` (
  `cat_id` int unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  `cat_timecreated` timestamp NULL DEFAULT NULL,
  `cat_timemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_content`
--

DROP TABLE IF EXISTS `course_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_content` (
  `cnt_id` int unsigned NOT NULL AUTO_INCREMENT,
  `cnt_name` varchar(50) NOT NULL,
  `cnt_desc` varchar(500) DEFAULT NULL,
  `cnt_comment` varchar(250) DEFAULT NULL,
  `cnt_type` varchar(10) DEFAULT NULL,
  `cnt_source` varchar(500) DEFAULT NULL,
  `cnt_timecreated` timestamp NULL DEFAULT NULL,
  `cnt_timemodified` timestamp NULL DEFAULT NULL,
  `lsn_id` int unsigned NOT NULL,
  `loc_id` int unsigned NOT NULL,
  PRIMARY KEY (`cnt_id`),
  KEY `content_lesson_foreign` (`lsn_id`),
  KEY `content_learningoutcomes_foreign` (`loc_id`),
  CONSTRAINT `content_learningoutcomes_foreign` FOREIGN KEY (`loc_id`) REFERENCES `course_learning_outcomes` (`loc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `content_lesson_foreign` FOREIGN KEY (`lsn_id`) REFERENCES `course_lesson` (`lsn_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_enrol`
--

DROP TABLE IF EXISTS `course_enrol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_enrol` (
  `enr_id` int unsigned NOT NULL AUTO_INCREMENT,
  `enr_status` varchar(500) DEFAULT NULL,
  `enr_timecreated` timestamp NULL DEFAULT NULL,
  `enr_timemodified` timestamp NULL DEFAULT NULL,
  `usr_id` int unsigned NOT NULL,
  `crs_id` int unsigned NOT NULL,
  PRIMARY KEY (`enr_id`),
  KEY `course_enrol_foreign` (`crs_id`),
  KEY `user_enrol_foreign` (`usr_id`),
  CONSTRAINT `course_enrol_foreign` FOREIGN KEY (`crs_id`) REFERENCES `course` (`crs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_enrol_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_forum`
--

DROP TABLE IF EXISTS `course_forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_forum` (
  `cfr_id` int unsigned NOT NULL AUTO_INCREMENT,
  `cfr_desc` varchar(150) NOT NULL,
  `usr_id` int unsigned NOT NULL,
  `lsn_id` int unsigned NOT NULL,
  `cfr_timecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cfr_timemodified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cfr_id`),
  KEY `user_forum_foreign` (`usr_id`),
  KEY `course_forum_foreign` (`lsn_id`),
  CONSTRAINT `course_forum_foreign` FOREIGN KEY (`lsn_id`) REFERENCES `course_lesson` (`lsn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_forum_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_forum_thread`
--

DROP TABLE IF EXISTS `course_forum_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_forum_thread` (
  `cft_id` int unsigned NOT NULL AUTO_INCREMENT,
  `cft_title` varchar(50) NOT NULL,
  `cft_content` longtext,
  `cft_rated` int DEFAULT NULL,
  `cft_timecreated` timestamp NULL DEFAULT NULL,
  `cft_timemodified` timestamp NULL DEFAULT NULL,
  `cfr_id` int unsigned NOT NULL,
  `usr_id` int unsigned NOT NULL,
  PRIMARY KEY (`cft_id`),
  KEY `course_thread_foreign` (`cfr_id`),
  CONSTRAINT `forum_thread_foreign` FOREIGN KEY (`cfr_id`) REFERENCES `course_forum` (`cfr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_forum_thread_reply`
--

DROP TABLE IF EXISTS `course_forum_thread_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_forum_thread_reply` (
  `ftr_id` int unsigned NOT NULL AUTO_INCREMENT,
  `ftr_content` longtext,
  `ftr_timecreated` timestamp NULL DEFAULT NULL,
  `ftr_timemodified` timestamp NULL DEFAULT NULL,
  `cft_id` int unsigned NOT NULL,
  `usr_id` int unsigned NOT NULL,
  `ftr_ratingsum` int DEFAULT '0',
  `ftr_ratingcount` int DEFAULT '0',
  PRIMARY KEY (`ftr_id`),
  KEY `cft_ftr_foreign` (`cft_id`),
  KEY `users_ftr_foreign` (`usr_id`),
  CONSTRAINT `cft_ftr_foreign` FOREIGN KEY (`cft_id`) REFERENCES `course_forum_thread` (`cft_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_ftr_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_forum_thread_reply_reply`
--

DROP TABLE IF EXISTS `course_forum_thread_reply_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_forum_thread_reply_reply` (
  `trr_id` int unsigned NOT NULL AUTO_INCREMENT,
  `trr_content` longtext,
  `trr_timecreated` timestamp NULL DEFAULT NULL,
  `trr_timemodified` timestamp NULL DEFAULT NULL,
  `ftr_id` int unsigned NOT NULL,
  `usr_id` int unsigned NOT NULL,
  `trr_ratingsum` int DEFAULT '0',
  `trr_ratingcount` int DEFAULT '0',
  PRIMARY KEY (`trr_id`),
  KEY `threads_posts_foreign` (`ftr_id`),
  KEY `users_posts_foreign` (`usr_id`),
  CONSTRAINT `threads_posts_foreign` FOREIGN KEY (`ftr_id`) REFERENCES `course_forum_thread_reply` (`ftr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_posts_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_forum_thread_reply_reply_reply`
--

DROP TABLE IF EXISTS `course_forum_thread_reply_reply_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_forum_thread_reply_reply_reply` (
  `rrr_id` int NOT NULL AUTO_INCREMENT,
  `rrr_content` longtext,
  `rrr_timecreated` timestamp NULL DEFAULT NULL,
  `rrr_timemodified` timestamp NULL DEFAULT NULL,
  `trr_id` int unsigned NOT NULL,
  `usr_id` int unsigned NOT NULL,
  `rrr_ratingsum` int DEFAULT '0',
  `rrr_ratingcount` int DEFAULT '0',
  PRIMARY KEY (`rrr_id`),
  KEY `reply_reply_foreign` (`trr_id`),
  KEY `user_reply_foreign` (`usr_id`),
  CONSTRAINT `reply_reply_foreign` FOREIGN KEY (`trr_id`) REFERENCES `course_forum_thread_reply_reply` (`trr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_reply_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_forum_user`
--

DROP TABLE IF EXISTS `course_forum_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_forum_user` (
  `cfu_id` int unsigned NOT NULL AUTO_INCREMENT,
  `cfr_id` int unsigned NOT NULL,
  `usr_id` int unsigned NOT NULL,
  `cfu_ratingsum` int DEFAULT '0',
  `cfu_ratingcount` int DEFAULT '0',
  `cfu_summsg` int DEFAULT '0',
  `cfu_msgin` int DEFAULT '0',
  `cfu_msgout` int DEFAULT '0',
  `cfu_sumword` int DEFAULT '0',
  `cfu_avgscrmsg` int DEFAULT '0',
  `cfu_centrality` int DEFAULT '0',
  `cfu_prestige` int DEFAULT '0',
  `cfu_timecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cfu_timemodified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cfu_id`),
  KEY `cfu_user` (`usr_id`),
  KEY `cfu_forum` (`cfr_id`),
  CONSTRAINT `cfu_forum` FOREIGN KEY (`cfr_id`) REFERENCES `course_forum` (`cfr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cfu_user` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_learning_outcomes`
--

DROP TABLE IF EXISTS `course_learning_outcomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_learning_outcomes` (
  `loc_id` int unsigned NOT NULL AUTO_INCREMENT,
  `loc_desc` text NOT NULL,
  `loc_timecreated` timestamp NULL DEFAULT NULL,
  `loc_timemodified` timestamp NULL DEFAULT NULL,
  `crs_id` int unsigned NOT NULL,
  PRIMARY KEY (`loc_id`),
  KEY `course_loc_foreign` (`crs_id`),
  CONSTRAINT `course_loc_foreign` FOREIGN KEY (`crs_id`) REFERENCES `course` (`crs_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `course_lesson`
--

DROP TABLE IF EXISTS `course_lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_lesson` (
  `lsn_id` int unsigned NOT NULL AUTO_INCREMENT,
  `lsn_name` varchar(50) NOT NULL,
  `lsn_intro` varchar(150) DEFAULT NULL,
  `lsn_timecreated` timestamp NULL DEFAULT NULL,
  `lsn_timemodified` timestamp NULL DEFAULT NULL,
  `crs_id` int unsigned NOT NULL,
  PRIMARY KEY (`lsn_id`),
  KEY `course_lesson_foreign` (`crs_id`),
  CONSTRAINT `course_lesson_foreign` FOREIGN KEY (`crs_id`) REFERENCES `course` (`crs_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hasil_kuesioner`
--

DROP TABLE IF EXISTS `hasil_kuesioner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hasil_kuesioner` (
  `hk_id` int NOT NULL AUTO_INCREMENT,
  `usr_id` int NOT NULL,
  `Active` int NOT NULL,
  `Reflective` int NOT NULL,
  `Sensing` int NOT NULL,
  `Intuitive` int NOT NULL,
  `Visual` int NOT NULL,
  `Verbal` int NOT NULL,
  `Sequential` int NOT NULL,
  `Global` int NOT NULL,
  `hk_timecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`hk_id`),
  UNIQUE KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hasil_kuesioner2`
--

DROP TABLE IF EXISTS `hasil_kuesioner2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hasil_kuesioner2` (
  `hk2_id` int NOT NULL AUTO_INCREMENT,
  `usr_id` int NOT NULL,
  `hasil` varchar(35) NOT NULL,
  `minat` varchar(100) NOT NULL,
  `hk2_timecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`hk2_id`),
  UNIQUE KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `learning_goals`
--

DROP TABLE IF EXISTS `learning_goals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `learning_goals` (
  `lg_id` int unsigned NOT NULL AUTO_INCREMENT,
  `usr_id` int unsigned NOT NULL,
  `loc_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`lg_id`),
  UNIQUE KEY `usr_id` (`usr_id`),
  KEY `loc_lg` (`loc_id`),
  CONSTRAINT `loc_lg` FOREIGN KEY (`loc_id`) REFERENCES `course_learning_outcomes` (`loc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usr_lg` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `learning_style`
--

DROP TABLE IF EXISTS `learning_style`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `learning_style` (
  `ls_id` int unsigned NOT NULL AUTO_INCREMENT,
  `ls_content_visit` int NOT NULL DEFAULT '0',
  `ls_content_visit_video` int NOT NULL DEFAULT '0',
  `ls_content_visit_text` int NOT NULL DEFAULT '0',
  `ls_content_stay` int NOT NULL DEFAULT '0',
  `ls_content_stay_video` int NOT NULL DEFAULT '0',
  `ls_content_stay_text` int NOT NULL DEFAULT '0',
  `ls_outline_visit` int NOT NULL DEFAULT '0',
  `ls_outline_stay` int NOT NULL DEFAULT '0',
  `ls_example_visit` int NOT NULL DEFAULT '0',
  `ls_example_stay` int NOT NULL DEFAULT '0',
  `ls_selfass_visit` int NOT NULL DEFAULT '0',
  `ls_selfass_stay` int NOT NULL DEFAULT '0',
  `ls_exercise_visit` int NOT NULL DEFAULT '0',
  `ls_exercise_stay` int NOT NULL DEFAULT '0',
  `ls_ques_detail` int NOT NULL DEFAULT '0',
  `ls_ques_overview` int DEFAULT '0',
  `ls_ques_facts` int NOT NULL DEFAULT '0',
  `ls_ques_concepts` int NOT NULL DEFAULT '0',
  `ls_ques_graphics` int NOT NULL DEFAULT '0',
  `ls_ques_text` int NOT NULL DEFAULT '0',
  `ls_ques_interpret` int NOT NULL DEFAULT '0',
  `ls_ques_develop` int NOT NULL DEFAULT '0',
  `ls_forum_visit` int NOT NULL DEFAULT '0',
  `ls_forum_stay` int NOT NULL DEFAULT '0',
  `ls_forum_post` int NOT NULL DEFAULT '0',
  `ls_nav_overview_visit` int NOT NULL DEFAULT '0',
  `ls_nav_skip` int NOT NULL DEFAULT '0',
  `ls_quiz_stay_result` int NOT NULL DEFAULT '0',
  `ls_selfass_twice_wrong` int NOT NULL DEFAULT '0',
  `ls_quiz_revisions` int NOT NULL DEFAULT '0',
  `usr_id` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ls_id`),
  UNIQUE KEY `usr_id` (`usr_id`),
  CONSTRAINT `usr_ls` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lesson_access_log`
--

DROP TABLE IF EXISTS `lesson_access_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lesson_access_log` (
  `lal_id` int NOT NULL AUTO_INCREMENT,
  `usr_id` int NOT NULL,
  `lsn_id` int NOT NULL,
  PRIMARY KEY (`lal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `ntf_id` int NOT NULL AUTO_INCREMENT,
  `ntf_type` varchar(10) DEFAULT NULL,
  `ntf_instructor` varchar(50) NOT NULL,
  `ntf_message` tinytext,
  `ntf_read` varchar(1) NOT NULL DEFAULT 'N',
  `ntf_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `usr_id` int unsigned NOT NULL,
  `ass_id` int unsigned DEFAULT NULL,
  `lsn_id` int unsigned DEFAULT NULL,
  `asg_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`ntf_id`),
  KEY `usr_foreign_key` (`usr_id`),
  KEY `lsn_foreign_key` (`lsn_id`),
  KEY `ass_foreign_key` (`ass_id`),
  KEY `asg_foreign_key` (`asg_id`),
  CONSTRAINT `asg_foreign_key` FOREIGN KEY (`asg_id`) REFERENCES `course_assignment` (`asg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ass_foreign_key` FOREIGN KEY (`ass_id`) REFERENCES `course_assesment` (`ass_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lsn_foreign_key` FOREIGN KEY (`lsn_id`) REFERENCES `course_lesson` (`lsn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usr_foreign_key` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rating_reply`
--

DROP TABLE IF EXISTS `rating_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating_reply` (
  `rry_id` int NOT NULL AUTO_INCREMENT,
  `ftr_id` int unsigned NOT NULL,
  `usr_id` int unsigned DEFAULT NULL,
  `rry_rated` int DEFAULT NULL,
  `rry_timecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rry_timemodified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rry_id`),
  KEY `ftr_foreign` (`ftr_id`),
  KEY `usr_foreign` (`usr_id`),
  CONSTRAINT `ftr_foreign` FOREIGN KEY (`ftr_id`) REFERENCES `course_forum_thread_reply` (`ftr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usr_foreign` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rating_reply_reply`
--

DROP TABLE IF EXISTS `rating_reply_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating_reply_reply` (
  `rrp_id` int NOT NULL AUTO_INCREMENT,
  `trr_id` int unsigned NOT NULL,
  `usr_id` int unsigned DEFAULT NULL,
  `rrp_rated` int DEFAULT NULL,
  `rrp_timecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rrp_timemodified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rrp_id`),
  KEY `reply_rating` (`trr_id`),
  KEY `user_rating` (`usr_id`),
  CONSTRAINT `reply_rating` FOREIGN KEY (`trr_id`) REFERENCES `course_forum_thread_reply_reply` (`trr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_rating` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rating_reply_reply_reply`
--

DROP TABLE IF EXISTS `rating_reply_reply_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating_reply_reply_reply` (
  `rrl_id` int NOT NULL AUTO_INCREMENT,
  `rrr_id` int NOT NULL,
  `usr_id` int unsigned DEFAULT NULL,
  `rrl_rated` int DEFAULT NULL,
  `rrl_timecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rrl_timemodified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rrl_id`),
  KEY `userr_rating` (`usr_id`),
  KEY `injek_rating` (`rrr_id`),
  CONSTRAINT `injek_rating` FOREIGN KEY (`rrr_id`) REFERENCES `course_forum_thread_reply_reply_reply` (`rrr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userr_rating` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rating_thread`
--

DROP TABLE IF EXISTS `rating_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating_thread` (
  `rtd_id` int NOT NULL AUTO_INCREMENT,
  `cft_id` int unsigned NOT NULL,
  `usr_id` int unsigned NOT NULL,
  `rtd_rated` int DEFAULT NULL,
  `rtd_timecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rtd_id`),
  KEY `rating_user` (`usr_id`),
  KEY `rating_thread` (`cft_id`),
  CONSTRAINT `rating_thread` FOREIGN KEY (`cft_id`) REFERENCES `course_forum_thread` (`cft_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rating_user` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `rol_id` int unsigned NOT NULL AUTO_INCREMENT,
  `rol_name` varchar(50) NOT NULL,
  `rol_timecreated` timestamp NULL DEFAULT NULL,
  `rol_timemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `university` (
  `unv_id` int unsigned NOT NULL AUTO_INCREMENT,
  `unv_name` varchar(50) NOT NULL,
  `unv_latlong` varchar(50) DEFAULT NULL,
  `unv_address` varchar(200) DEFAULT NULL,
  `unv_contact` varchar(50) DEFAULT NULL,
  `unv_email` varchar(50) DEFAULT NULL,
  `unv_website` varchar(50) DEFAULT NULL,
  `unv_stats` varchar(50) DEFAULT NULL,
  `unv_timecreated` timestamp NULL DEFAULT NULL,
  `unv_timemodified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`unv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_logs`
--

DROP TABLE IF EXISTS `user_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_logs` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usr_id` int unsigned NOT NULL,
  `log_event_context` varchar(100) NOT NULL,
  `log_referrer` varchar(100) DEFAULT NULL,
  `log_name` varchar(100) NOT NULL,
  `log_origin` longtext NOT NULL,
  `log_ip` varchar(50) NOT NULL,
  `log_desc` longtext NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_log_foreign` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2403 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `usr_id` int unsigned NOT NULL AUTO_INCREMENT,
  `usr_kode` varchar(3) DEFAULT NULL,
  `usr_nim` varchar(10) DEFAULT NULL,
  `usr_username` varchar(50) NOT NULL,
  `usr_firstname` varchar(50) NOT NULL,
  `usr_lastname` varchar(50) NOT NULL,
  `usr_password` varchar(50) NOT NULL,
  `usr_email` varchar(50) DEFAULT NULL,
  `usr_picture` varchar(150) DEFAULT NULL,
  `usr_gpa` decimal(3,2) DEFAULT NULL,
  `usr_timecreated` timestamp NULL DEFAULT NULL,
  `usr_timemodified` timestamp NULL DEFAULT NULL,
  `usr_level` varchar(50) NOT NULL,
  `usr_jk` varchar(10) DEFAULT NULL,
  `usr_tgllahir` date DEFAULT NULL,
  `usr_post_count` int DEFAULT '0',
  `usr_thread_count` int DEFAULT '0',
  `usr_reply_count` int DEFAULT '0',
  `usr_tmpasal` varchar(35) NOT NULL,
  `usr_kelas` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_kode` (`usr_kode`),
  UNIQUE KEY `usr_nim` (`usr_nim`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-17  8:55:27
