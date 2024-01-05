#1. 创建数据库
CREATE DATABASE IF NOT EXISTS `signature`;
#2. 打开数据库
use signature;
#3. 创建用户表
create table tbl_user(id int not null primary key auto_increment comment '用户id',
            username varchar(30) not null comment '用户名',
            created datetime default now() comment '创建时间');
#4. 创建签名表
create table tbl_sign(id int not null primary key auto_increment comment '签名id',
                     userid int not null comment '用户id',
                     path varchar(200) comment '签名图片路径',
                     created datetime default now() comment '签名时间');