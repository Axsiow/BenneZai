
Think about changing Password for jean administrator at the end of sql script.
How to create bennezai database : 


CREATE USER 'bennezai'@'%' IDENTIFIED BY 'bennezai';
GRANT ALL PRIVILEGES ON * . * TO 'bennezai'@'%';



create database bennezai;


use bennezai
drop table user;
drop table geopoint;
drop table category;


create table username (
user_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, 
username VARCHAR(40) NOT NULL UNIQUE, 
password VARCHAR(40) NOT NULL, 
admin BOOLEAN, 
PRIMARY KEY (user_id) 
) ENGINE=INNODB;

CREATE TABLE `category` (
    `id` INT unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(40) NOT NULL UNIQUE,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `geopoint`
  (
     `id`          INT NOT NULL auto_increment,
     `longitude`   DECIMAL(10,4) NOT NULL,
     `latitude`    DECIMAL(10,4) NOT NULL,
     `username`    VARCHAR(40) NOT NULL,
     `category_name` VARCHAR(40) NOT NULL,
     PRIMARY KEY (`id`),
     FOREIGN KEY(category_name) REFERENCES category(name),
     FOREIGN KEY(username) REFERENCES username(username)
  );  
  
insert into username (username,password, admin) values ('jean', 'password', '1');
insert into category (name) values ('Ampoule');
insert into category (name) values ('Container');
insert into category (name) values ('Decheterie');
insert into category (name) values ('Piles');
insert into category (name) values ('Verre');
insert into category (name) values ('textile');






