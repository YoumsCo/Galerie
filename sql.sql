drop database if exists galeriedb;
create database if not exists galeriedb charset utf8;
use galeriedb;

create table `user` (
    iduser integer not null auto_increment,
    nom varchar(30) not null,
    prenom varchar(30) not null,
    telephone varchar(15) not null,
    email varchar(45) not null,
    `password` varchar(30) not null,
    `date` timestamp default current_timestamp on update current_timestamp,
    primary key(iduser)
);

insert into user (iduser, nom, prenom, telephone, email, `password`) values(1, "Admin", "Admin", "690552385", "adminyoums@gmail.com", "Youms19C@...");

create table visitor (
    idvisitor varchar not null,
    device_info varchar(128) null,
    `date` timestamp default current_timestamp on update current_timestamp,
    primary key(idvisitor)
);