CREATE TABLE IF NOT EXISTS `players` (
  `player_id` int(11) NOT NULL,
  `first_name` varchar(11) NOT NULL,
  `last_name` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
	PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `teams` ( 
	`team_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`team_name` varchar(20) NOT NULL , 
	PRIMARY KEY (`team_id`)
) ENGINE = InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `team_player` ( 
	`connection_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`player_id` INT(11) NOT NULL , 
	`team_id` INT(11) NOT NULL , 
	PRIMARY KEY (`connection_id`)
) ENGINE = InnoDB DEFAULT CHARSET=latin1;