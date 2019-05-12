
CREATE TABLE IF NOT EXISTS `user`(
    `id` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255),
    `email` VARCHAR(255),
    `userType` VARCHAR(255),
    `password` VARCHAR(255)
);

INSERT INTO `user` VALUES 
(1,"Child","childname@mail.com","Student","Child"),
(2,"Parent","parentname@mail.com","Parent","Parent")
;

CREATE TABLE IF NOT EXISTS `student`(
    `id` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255),
    `email` VARCHAR(255),
    `userType` VARCHAR(255),
    `password` VARCHAR(255)
);

INSERT INTO `student` VALUES 
(1,"Child","childname@mail.com","Student","Child")
;

CREATE TABLE IF NOT EXISTS `parent`(
    `id` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255),
    `email` VARCHAR(255),
    `userType` VARCHAR(255),
    `password` VARCHAR(255),
    `childUsername` VARCHAR(255)
);

INSERT INTO `parent` VALUES 
(1,"Parent","parentname@mail.com","Parent","Parent","Child")
;

CREATE TABLE IF NOT EXISTS `todo_payment`(
    `id_payment` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `task_payment` VARCHAR(255),
    `username` VARCHAR(255),
    `reminder_payment` INT(1)
);

INSERT INTO `todo_payment` VALUES 
(1,"Pay hostel fee","Child",1),
(2,"Pay phone bill","Child",1),
(3,"Pay car installment","Child",0)
;

CREATE TABLE IF NOT EXISTS `completed_payment`(
    `id_payment` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `task_payment` VARCHAR(255),
    `username` VARCHAR(255)
);

INSERT INTO `completed_payment` VALUES 
(1,"Settle camera rental","Child")
;

CREATE TABLE IF NOT EXISTS `todo_grocery`(
    `id_grocery` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `task_grocery` VARCHAR(255),
    `username` VARCHAR(255),
    `reminder_grocery` INT(1)
);

INSERT INTO `todo_grocery` VALUES 
(1,"Buy 2 cartons of milk","Child",0),
(2,"Buy carrots","Child",0),
(3,"Buy dog shampoo","Child",0),
(4,"Buy instant noodles","Child",0)
;

CREATE TABLE IF NOT EXISTS `completed_grocery`(
    `id_grocery` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `task_grocery` VARCHAR(255),
    `username` VARCHAR(255)
);

INSERT INTO `completed_grocery` VALUES 
(1,"Buy green tea","Child")
;

CREATE TABLE IF NOT EXISTS `todo_fitness`(
    `id_fitness` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `task_fitness` VARCHAR(255),
    `username` VARCHAR(255),
    `reminder_fitness` INT(1) 
);

INSERT INTO `todo_fitness` VALUES 
(1,"10 reps bicycle crunch","Child",0),
(2,"Go jogging for 10 laps","Child",1)
;

CREATE TABLE IF NOT EXISTS `completed_fitness`(
    `id_fitness` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `task_fitness` VARCHAR(255),
    `username` VARCHAR(255)
);

INSERT INTO `completed_fitness` VALUES 
(1,"10min cardio","Child"),
(2,"30s planks","Child")
;


CREATE TABLE IF NOT EXISTS `todo_chore`(
    `id_chore` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `task_chore` VARCHAR(255),
    `username` VARCHAR(255),
    `reminder_chore` INT(1) 
);

INSERT INTO `todo_chore` VALUES 
(1,"Revise calculus","Child",1),
;

CREATE TABLE IF NOT EXISTS `completed_chore`(
    `id_chore` INT(10) PRIMARY KEY AUTO_INCREMENT,
    `task_chore` VARCHAR(255),
    `username` VARCHAR(255)
);

INSERT INTO `completed_chore` VALUES 
(1,"Do gardening","Child"),
(2,"Wash toilet","Child"),
(3,"Revise computer security","Child")
;
	
