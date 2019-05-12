CREATE TABLE `post` 
(
	`post_id` int(10) NOT NULL AUTO_INCREMENT,
	`user_id` int(10) NOT NULL,
	`post_content` varchar(2000) NOT NULL,
	`post_image` varchar(50) DEFAULT NULL,
	`post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`post_id`),
	KEY `user_id` (`user_id`),
	CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1

--------------------------------------------------------------------------

ALTER TABLE post AUTO_INCREMENT=1;