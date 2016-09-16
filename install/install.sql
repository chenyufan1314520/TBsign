-- 表;
create table `%PREFIX%users`(
    `uid` int primary key auto_increment,
    `name` char(255) not null,
    `email` char(255) not null,
    `password` char(32) not null,
    `time` int not null,
    `gid` int not null,
    `avatar` char(255),
    unique(`name`),
    unique(`email`)
) default charset utf8;
create table `%PREFIX%groups`(
    `gid` int primary key auto_increment,
    `name` char(255) not null,
    unique(`name`)
) default charset utf8;
create table `%PREFIX%options`(
    `name` char(255) primary key,
    `value` char(255),
    `uid` int
) default charset utf8;
create table `%PREFIX%plugins`(
    `pcn` char(255) primary key,
    `class` char(255) not null,
    `isactivate` int(1) not null,
	unique(`pcn`),
    unique(`class`)
) default charset utf8;
create table `%PREFIX%online`(
    `uid` int primary key,
    `uss` char(32) not null,
    `time` int not null,
    `ip` char(15) not null,
    unique(`uss`)
) default charset utf8;
create table `%PREFIX%cron`(
    `cid` int primary key auto_increment,
    `name` char(255) not null,
    `url` char(255) not null,
    `lasttime` int,
    `protect` int(1) default 0,
    unique(`name`)
) default charset utf8;
create table `%PREFIX%baiduid`(
    `bid` int primary key auto_increment,
    `uid` int not null,
    `bduss` char(255) not null,
    `name` char(255) not null,
    `avatar` char(255) not null
) default charset utf8;
create table `%PREFIX%tieba`(
    `kid` int primary key auto_increment,
    `bid` int not null,
    `uid` int not null,
    `kw` char(255) not null,
    `fid` int not null,
    `lasttime` int not null,
    `state` int not null
) default charset utf8;
