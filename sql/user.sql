CREATE TABLE `user` 
(
	`user_id` int(10) NOT NULL AUTO_INCREMENT,
	`user_name` varchar(25) NOT NULL,
	`user_pass` varchar(60) NOT NULL,
	`user_email` varchar(30) NOT NULL,
	`user_country` text NOT NULL,
	`user_gender` text NOT NULL,
	`user_dob` varchar(15) NOT NULL,
	`user_image` varchar(50) NOT NULL,
	`user_reg_date` varchar(10) NOT NULL,
	`user_last_login` varchar(15) NOT NULL,
	`user_status` text NOT NULL,
	`user_ver_code` int(10) NOT NULL,
	`user_posts` varchar(255) NOT NULL,
	PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1


----------------------------------------------------------------------------


ALTER TABLE user AUTO_INCREMENT=1;