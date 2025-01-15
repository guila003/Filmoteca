-- Adminer 4.8.1 MySQL 8.0.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `filmoteca`;

DROP TABLE IF EXISTS `film`;
CREATE TABLE `film` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `year` year DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `synopsis` text,
  `director` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `film` (`id`, `title`, `year`, `type`, `synopsis`, `director`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'The Shawshank Redemption',	'1994',	'Drama',	'Two imprisoned men bond over a number of years.',	'Frank Darabont',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(2,	'The Godfather',	'1972',	'Crime',	'The aging patriarch of an organized crime dynasty transfers control to his reluctant son.',	'Francis Ford Coppola',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(3,	'The Dark Knight',	'2008',	'Action',	'When the menace known as the Joker emerges, Batman must accept his greatest test.',	'Christopher Nolan',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(4,	'Pulp Fiction',	'1994',	'Crime',	'The lives of two mob hitmen, a boxer, and others intertwine in four tales.',	'Quentin Tarantino',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(5,	'Forrest Gump',	'1994',	'Drama',	'The story of a man with low IQ achieving incredible things.',	'Robert Zemeckis',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(6,	'Inception',	'2010',	'Sci-Fi',	'A thief who steals secrets through dream-sharing technology.',	'Christopher Nolan',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(7,	'Fight Club',	'1999',	'Drama',	'An insomniac office worker forms an underground fight club.',	'David Fincher',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(8,	'The Matrix',	'1999',	'Sci-Fi',	'A hacker discovers the shocking truth about his reality.',	'Lana Wachowski',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(9,	'Interstellar',	'2014',	'Sci-Fi',	'A team of explorers travels through a wormhole in space.',	'Christopher Nolan',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(10,	'The Lord of the Rings: The Return of the King',	'2003',	'Fantasy',	'The final battle for Middle-earth.',	'Peter Jackson',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(11,	'Gladiator',	'2000',	'Action',	'A betrayed Roman general seeks revenge.',	'Ridley Scott',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(12,	'Schindler\'s List',	'1993',	'Biography',	'In Nazi-occupied Poland, a businessman saves Jewish refugees.',	'Steven Spielberg',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(13,	'The Lion King',	'1994',	'Animation',	'A young lion prince flees his kingdom.',	'Roger Allers',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(14,	'Titanic',	'1997',	'Romance',	'A young couple falls in love aboard the ill-fated ship.',	'James Cameron',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(15,	'The Departed',	'2006',	'Crime',	'An undercover cop and a mole try to identify each other.',	'Martin Scorsese',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(16,	'Saving Private Ryan',	'1998',	'War',	'A group of soldiers searches for a missing paratrooper.',	'Steven Spielberg',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(17,	'The Green Mile',	'1999',	'Drama',	'A death row guard develops a relationship with a miraculous inmate.',	'Frank Darabont',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(18,	'The Silence of the Lambs',	'1991',	'Thriller',	'A young FBI trainee consults with a brilliant, imprisoned cannibal.',	'Jonathan Demme',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(19,	'Se7en',	'1995',	'Crime',	'Two detectives hunt a serial killer inspired by the seven deadly sins.',	'David Fincher',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(20,	'Parasite',	'2019',	'Drama',	'A poor family schemes to become employed by a wealthy household.',	'Bong Joon-ho',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(21,	'Avengers: Endgame',	'2019',	'Action',	'The Avengers assemble to undo Thanos\' actions.',	'Anthony Russo',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(22,	'Whiplash',	'2014',	'Drama',	'A young drummer is pushed to his limits by his instructor.',	'Damien Chazelle',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(23,	'The Prestige',	'2006',	'Drama',	'Two magicians engage in a rivalry to create the ultimate illusion.',	'Christopher Nolan',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(24,	'Django Unchained',	'2012',	'Western',	'A freed slave sets out to rescue his wife from a plantation owner.',	'Quentin Tarantino',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(25,	'The Wolf of Wall Street',	'2013',	'Biography',	'The rise and fall of a wealthy stockbroker.',	'Martin Scorsese',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(26,	'The Social Network',	'2010',	'Biography',	'The story of Facebook\'s creation and the legal battles that followed.',	'David Fincher',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(27,	'Toy Story',	'1995',	'Animation',	'A cowboy doll is threatened by a new action figure.',	'John Lasseter',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(28,	'Joker',	'2019',	'Drama',	'The origin story of the infamous DC villain.',	'Todd Phillips',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(29,	'The Shining',	'1980',	'Horror',	'A family is terrorized in an isolated hotel.',	'Stanley Kubrick',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(30,	'Goodfellas',	'1990',	'Crime',	'The life of a mob associate and his rise in the mafia.',	'Martin Scorsese',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(31,	'Mad Max: Fury Road',	'2015',	'Action',	'A post-apocalyptic road warrior fights for survival.',	'George Miller',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(32,	'The Big Lebowski',	'1998',	'Comedy',	'A slacker becomes embroiled in a complicated kidnapping plot.',	'Joel Coen',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(33,	'A Beautiful Mind',	'2001',	'Biography',	'The story of a mathematical genius battling schizophrenia.',	'Ron Howard',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(34,	'Braveheart',	'1995',	'History',	'A Scottish warrior leads a rebellion against England.',	'Mel Gibson',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(35,	'The Grand Budapest Hotel',	'2014',	'Comedy',	'The adventures of a legendary concierge.',	'Wes Anderson',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(36,	'The Incredibles',	'2004',	'Animation',	'A family of superheroes comes out of retirement.',	'Brad Bird',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(37,	'Shrek',	'2001',	'Animation',	'An ogre and a donkey go on a quest to rescue a princess.',	'Andrew Adamson',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(38,	'The Truman Show',	'1998',	'Drama',	'A man discovers his life is a reality TV show.',	'Peter Weir',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(39,	'The Usual Suspects',	'1995',	'Crime',	'A crime mystery unravels with an unreliable narrator.',	'Bryan Singer',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(40,	'The Pianist',	'2002',	'Biography',	'A Jewish musician survives the Holocaust in Warsaw.',	'Roman Polanski',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(41,	'Spirited Away',	'2001',	'Animation',	'A young girl enters a magical world ruled by spirits.',	'Hayao Miyazaki',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(42,	'Finding Nemo',	'2003',	'Animation',	'A clownfish searches for his lost son.',	'Andrew Stanton',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(43,	'The Hunt',	'2012',	'Drama',	'A teacher\'s life is ruined by a false accusation.',	'Thomas Vinterberg',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(44,	'No Country for Old Men',	'2007',	'Crime',	'A hunter stumbles upon a drug deal gone wrong.',	'Ethan Coen',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(45,	'The Revenant',	'2015',	'Adventure',	'A frontiersman fights for survival after being left for dead.',	'Alejandro González Iñárritu',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(46,	'La La Land',	'2016',	'Musical',	'An aspiring actress and a jazz musician navigate their dreams.',	'Damien Chazelle',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52'),
(47,	'Blade Runner 2049',	'2017',	'Sci-Fi',	'A young blade runner discovers secrets that affect humanity.',	'Denis Villeneuve',	NULL,	'2024-11-20 10:03:52',	'2024-11-20 10:03:52');

-- 2024-11-20 10:05:22
