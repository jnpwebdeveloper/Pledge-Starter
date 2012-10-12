/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : pledgestarter

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2012-10-12 17:11:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `username` varchar(80) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of login_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('9');

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_string` varchar(255) NOT NULL,
  PRIMARY KEY (`permission_id`,`permission_string`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for `permissions_roles`
-- ----------------------------
DROP TABLE IF EXISTS `permissions_roles`;
CREATE TABLE `permissions_roles` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permissions_roles
-- ----------------------------

-- ----------------------------
-- Table structure for `projects`
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `funding_target` decimal(10,2) NOT NULL DEFAULT '0.00',
  `funding_current` decimal(10,2) NOT NULL DEFAULT '0.00',
  `country_id` int(10) NOT NULL DEFAULT '0',
  `city` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `status` enum('active','expired-notfunded','expired-funded','pending','draft') NOT NULL DEFAULT 'active',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES ('1', '1', 'Emergence: A Sci-Fi/Fantasy Roleplaying Game', 'emergence-a-sci-fi-fantasy-roleplaying-game', '20000.00', '0.00', '1', 'Brisbane', '<p>An immersive web 2.0, CSS3, HTML5 Javascript object literal syntax cancer curing device.</p>', '<p>On Kython, multiple genres intermingle to create a world that is exciting, fresh, and yet strikingly familiar. Sections of Kython are nearly indistinguishable from the world in which we live. There are cars, houses, trains, cell phones, and even the internet. This creates a comfortable starting point to begin your explorations on this foreign planet. However, within this unassuming framework exist all of the elements of science fiction and fantasy that make those genres exciting. Magic, power armor, and advanced weaponry fill the world with new possibilities around every corner.</p><p>As you venture into the world of Kython, the line quickly blurs between science fiction and fantasy. Castles, wooded fortresses, skyscrapers, and industrial complexes cover the landscape, while smartphones, cybernetics, and flying beasts are part of everyday life. The world of Kython boasts a rich diversity of settings to satisfy nearly any game style preference. Whether you prefer gunfights while blasting down the highway at 100 mph, fighting demons in a corrupted ruin, battling savage hordes to defend a village, or storming a skyscraper fortress to defeat an evil necromancer, all of these adventures and more are waiting for you. On Kython, these traditionally separate game styles come together in a way that is exciting, intuitive, and fun. The only limit is your imagination.</p>', 'active', '2012-10-12 15:19:36', '2012-11-01 15:19:42', '2012-10-12 15:19:53');

-- ----------------------------
-- Table structure for `rewards`
-- ----------------------------
DROP TABLE IF EXISTS `rewards`;
CREATE TABLE `rewards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `status` enum('active','soldout') NOT NULL DEFAULT 'active',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rewards
-- ----------------------------

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(120) NOT NULL,
  `role_display_name` varchar(160) NOT NULL,
  PRIMARY KEY (`role_id`,`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL,
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('e8925cee87536f99a19e232239e7394b', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4', '1350022700', '');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(5) unsigned NOT NULL,
  `username` varchar(80) NOT NULL,
  `nice_username` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(140) NOT NULL,
  `register_date` int(11) NOT NULL,
  `activation_key` text NOT NULL,
  `user_status` enum('active','pending','banned') NOT NULL DEFAULT 'active',
  `remember_me` text NOT NULL,
  PRIMARY KEY (`id`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for `user_meta`
-- ----------------------------
DROP TABLE IF EXISTS `user_meta`;
CREATE TABLE `user_meta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `umeta_key` varchar(255) NOT NULL,
  `umeta_value` longtext NOT NULL,
  PRIMARY KEY (`umeta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_meta
-- ----------------------------
