CREATE DATABASE spill_butikk;

Users:
CREATE TABLE `brukere` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `password` varchar(255) NOT NULL,
 `email` varchar(50) NOT NULL,
 `phone` varchar(8) DEFAULT NULL,
 `created_at` timestamp NULL DEFAULT current_timestamp(),
 `role` enum('user','admin') DEFAULT 'user',
 `friend_code` bigint(20) DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `username` (`username`),
 UNIQUE KEY `email` (`email`),
 UNIQUE KEY `friend_code` (`friend_code`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

friends:
CREATE TABLE `friend` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `friend_id` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `friend_ibfk_1` (`user_id`),
 KEY `friends_ibfk_1` (`friend_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

friend requests:
CREATE TABLE `friend_requests` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `requesting_id` int(11) NOT NULL,
 `requested_id` int(11) NOT NULL,
 `created_at` timestamp NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `requesting_id` (`requesting_id`),
 KEY `requested_id` (`requested_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

games:
CREATE TABLE `games` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `title` varchar(255) NOT NULL,
 `description` text DEFAULT NULL,
 `price` decimal(10,2) NOT NULL,
 `image` varchar(255) DEFAULT NULL,
 `release_date` varchar(50) DEFAULT NULL,
 `game_url` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

game requests:
CREATE TABLE `game_request` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `from_id` int(11) NOT NULL,
 `to_id` int(11) NOT NULL,
 `game` varchar(50) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

owned games:
CREATE TABLE `owned_games` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `game` varchar(50) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

transactions:
CREATE TABLE `transactions` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `type` varchar(50) NOT NULL,
 `belop` decimal(15,2) NOT NULL,
 `referance` varchar(255) DEFAULT NULL,
 `created_at` timestamp NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci