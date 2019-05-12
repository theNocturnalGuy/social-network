CREATE TABLE `comment` 
(
	`cmnt_id` int(10) NOT NULL AUTO_INCREMENT,
	`post_id` int(10) NOT NULL,
	`user_id` int(10) NOT NULL,
	`cmnt_auth` varchar(30) NOT NULL,
	`cmnt_cont` varchar(255) NOT NULL,
	`cmnt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`cmnt_id`),
	KEY `post_id` (`post_id`),
	KEY `user_id` (`user_id`),
	CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
	CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

--------------------------------------------------------------------

ALTER TABLE comment AUTO_INCREMENT=1;