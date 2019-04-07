set names utf8;
drop database  if exists app;
create database app charset=utf8;
use app;
create table user(
    uid int primary key auto_increment,
    uname varchar(30),
    upwd varchar(32),
    status int
);
create table appList(
   id int primary key auto_increment,
   appName varchar(30),
   short_url varchar(100),
   userId int
)