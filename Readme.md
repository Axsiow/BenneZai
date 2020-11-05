
How to create bennezai database : 


create database bennezai;
use bennezai
drop table user;
drop table geopoint;
drop table category;


create table user (
user_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, 
username VARCHAR(40) NOT NULL UNIQUE, 
password VARCHAR(40) NOT NULL, 
admin BOOLEAN, 
PRIMARY KEY (user_id) 
) ENGINE=INNODB;

CREATE TABLE `category` (
    `id` INT unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(40) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `geopoint`
  (
     `id`          INT NOT NULL auto_increment,
     `longitude`   DECIMAL NOT NULL,
     `latitude`    DECIMAL NOT NULL,
     `category_id` INT,
     PRIMARY KEY (`id`),
     FOREIGN KEY(category_id) REFERENCES category(id)
  );  