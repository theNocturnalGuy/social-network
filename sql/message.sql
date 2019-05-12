CREATE TABLE `message` (
 `msg_id` int(10) NOT NULL AUTO_INCREMENT,
 `sender_id` int(10) NOT NULL,
 `reciever_id` int(10) NOT NULL,
 `msg_cont` varchar(255) NOT NULL,
 `msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`msg_id`),
 KEY `sender_id` (`sender_id`),
 KEY `reciever_id` (`reciever_id`),
 CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`),
 CONSTRAINT `message_ibfk_2` FOREIGN KEY (`reciever_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

--------------------------------------------------------------------------

ALTER TABLE message AUTO_INCREMENT=1;