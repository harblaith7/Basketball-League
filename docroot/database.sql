CREATE TABLE IF NOT EXISTS `players` (
  `player_id` INT(11) NOT NULL,
  `first_name` VARCHAR(11) NOT NULL,
  `last_name` VARCHAR(11) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `phone_number` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `teams` ( 
	`team_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`team_name` VARCHAR(20) NOT NULL , 
	`team_image` VARCHAR(100) NOT NULL DEFAULT `http://anklebreaker.ca/img/teams/default.png`, 
	PRIMARY KEY (`team_id`)
) ENGINE = InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `team_player` ( 
	`connection_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`player_id` INT(11) NOT NULL , 
	`team_id` INT(11) NOT NULL ,
	`paid` VARCHAR(11) NOT NULL ,
	PRIMARY KEY (`connection_id`)
) ENGINE = InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `schedule` ( 
	`game_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`team1` VARCHAR(50) NOT NULL , 
	`team2` VARCHAR(50) NOT NULL , 
	`date` VARCHAR(50) NOT NULL , 	
	`game_start` VARCHAR(50) NOT NULL DEFAULT `TBD` , 	
	`location` VARCHAR(50) NOT NULL DEFAULT `TBD` , 	
	`team1_result` VARCHAR(50) NOT NULL DEFAULT `TBD` , 	
	`team2_result` VARCHAR(50) NOT NULL DEFAULT `TBD` , 	
	PRIMARY KEY (`game_id`)
) ENGINE = InnoDB DEFAULT CHARSET=latin1;