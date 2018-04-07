CREATE TABLE IF NOT EXISTS `admin_users` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `players` (
  `player_id` int(11) NOT NULL,
  `first_name` varchar(11) NOT NULL,
  `last_name` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `player_stats` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `assists` int(11) NOT NULL,
  `rebounds` int(11) NOT NULL,
  `blocks` int(11) NOT NULL,
  `turn_overs` int(11) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `schedule` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  `team1_id` varchar(50) NOT NULL,
  `team2_id` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `game_start` varchar(50) NOT NULL DEFAULT 'TBD',
  `location` varchar(50) NOT NULL DEFAULT 'TBD',
  `team1_result` varchar(50) NOT NULL DEFAULT 'TBD',
  `team2_result` varchar(50) NOT NULL DEFAULT 'TBD',
  `winner_id` varchar(100) DEFAULT 'TBD',
  `played` varchar(1) DEFAULT 'N',
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `team_player` (
  `connection_id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_number` int(11) NOT NULL,
  PRIMARY KEY (`connection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `team_player` (
  `connection_id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_number` int(11) NOT NULL,
  PRIMARY KEY (`connection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(20) NOT NULL,
  `team_image` varchar(100) NOT NULL DEFAULT 'http://anklebreaker.ca/img/teams/default.png',
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1