set names utf8;
drop database  if exists app;
create database app charset=utf8;
use app;
create table user(
    uid int primary key auto_increment,
    uname varchar(30),
    upwd varchar(32),
    status int,
    time  int
);
create table applist(
   id int primary key auto_increment,
   appName varchar(30),
   url varchar(100),
   url_short varchar(100),
   appPic text,
   file varchar(100),  
   userId int,
   xmlPath varchar(100),
   code varchar(200),
   uuid varchar(60),
   time int
)