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
);

Create table orderlist(
    id varchar(50) primary key,
    type varchar(20), #支付方式
    proName varchar(100), #商品名称
    totalPrice varchar(10), #订单总价
    time int,
    status int   #status 0 未付款  1 已付款   
)