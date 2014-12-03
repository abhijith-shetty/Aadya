--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `facebook_id` varchar(300) NOT NULL,
  `access_token` varchar(300) NOT NULL,
  `image` varchar(500) NOT NULL,
  `ios_push_id` varchar(300) NOT NULL,
  `android_push_id` varchar(300) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;//

