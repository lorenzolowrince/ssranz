DROP TABLE tbladmin;

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbladmin VALUES("8","Lorenzo","lorenzolowrince@gmail.com","014-6793125","lorenzo","97fc6b4ca33ff77af52b0df424da93c7");
INSERT INTO tbladmin VALUES("9","Mosses","mossesPA@gmail.com","+61 413 388 131","admin","21232f297a57a5a743894a0e4a801fc3");



DROP TABLE tblarchived;

CREATE TABLE `tblarchived` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profilePic` blob DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `ic` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `joinedSince` date NOT NULL,
  `maritalStatus` varchar(100) NOT NULL,
  `fbLink` varchar(200) DEFAULT NULL,
  `statusVISA` varchar(100) NOT NULL,
  `regNum` varchar(200) NOT NULL,
  `statusInvolvement` varchar(100) NOT NULL,
  `homelandAdd` varchar(200) DEFAULT NULL,
  `currentAdd` varchar(200) NOT NULL,
  `homelandPostcode` varchar(200) DEFAULT NULL,
  `currentPostcode` varchar(200) NOT NULL,
  `homelandCity` varchar(200) DEFAULT NULL,
  `currentCity` varchar(200) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `emergencyNumber` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;




DROP TABLE tbldiary;

CREATE TABLE `tbldiary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `label` varchar(200) DEFAULT NULL,
  `submitDate` date NOT NULL,
  `updateDate` date DEFAULT NULL,
  `note` text NOT NULL,
  `document` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbldiary VALUES("19","This is Title","This is Label","2020-04-18","2020-04-18"," This is to test the diary function and also attachment. ","50f6c1b8d00462beadd04a7310f3911f.txt");
INSERT INTO tbldiary VALUES("20","This is the Title2","This is the Label2","2020-04-18","0000-00-00"," This is the note 2","fc6a56d8a029d7b72f62dcf579030781.txt");



DROP TABLE tbllastknownbackup;

CREATE TABLE `tbllastknownbackup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbllastknownbackup VALUES("40","2020-04-18","04:16:23");



DROP TABLE tbllastknownrestore;

CREATE TABLE `tbllastknownrestore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbllastknownrestore VALUES("8","2020-04-18","04:09:40");



DROP TABLE tblregister;

CREATE TABLE `tblregister` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profilePic` blob DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `ic` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `joinedSince` date DEFAULT NULL,
  `maritalStatus` varchar(100) DEFAULT NULL,
  `fbLink` varchar(200) DEFAULT NULL,
  `statusVISA` varchar(100) DEFAULT NULL,
  `regNum` varchar(200) DEFAULT NULL,
  `statusInvolvement` varchar(100) DEFAULT NULL,
  `homelandAdd` varchar(200) DEFAULT NULL,
  `currentAdd` varchar(200) DEFAULT NULL,
  `homelandPostcode` varchar(200) DEFAULT NULL,
  `currentPostcode` varchar(200) DEFAULT NULL,
  `homelandCity` varchar(200) DEFAULT NULL,
  `currentCity` varchar(200) DEFAULT NULL,
  `phoneNumber` varchar(100) DEFAULT NULL,
  `emergencyNumber` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblregister VALUES("12","452512.jpg","Lorenzo Lowrince","123456789","lorenzolowrince@gmail.com","1990-01-01","2020-04-18","Single",""," Valid","2020040012","Active","Address 1  ","Address 2","Postal code 1","Postal code 2","City 1","City 2","60-123456789","60-123456789"," This is a note");



