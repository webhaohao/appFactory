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
insert into user values(NULL,'haohao','123456',NULL,NULL);
create table appList(
   id int primary key auto_increment,
   appName varchar(30),
   url varchar(100),
   url_short varchar(100),
   appPic text,
   userId int,
   filePath varchar(100),
   time int
)