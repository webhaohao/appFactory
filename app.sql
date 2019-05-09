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
   status int, # 0为失效 , 1为激活状态 
   deadline int, #过期时间
   ontrialTime int, #试用时间
   delstatus int, # 1为删除 
   time int
);
create table prolist(
   id int primary key auto_increment,
   proName varchar(50), #商品名称
   price varchar(10), #商品价格
   y_price varchar(10),#商品原价
   time int  
);
insert into prolist values(null,'生成IOS app(1年续期)','119.00','149.00',null),
                          (null,'生成IOS app(永久)','149.00','179.00',null),
                          (null,'生成IOS app(1天)','1.00','5.00',null);
create table orderlist(
    id varchar(50) primary key,
    type varchar(20), #支付方式
    proName varchar(100), #商品名称
    totalPrice varchar(10), #订单总价
    time int,
    status int,   #status 0 未付款  1 已付款
    appName varchar(50), #app产品名称  
    appId  int   #appid     
);
create table admin(
    id int primary key auto_increment,
    username varchar(20),
    password varchar(100)    
);
insert into admin values(null,'appFactory','1a5e52a77e8c62a74190a5040c5ce97e');