CREATE TABLE `booking`
(
    `id`     int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `cid`    int(11)             NOT NULL,
    `status` varchar(100) DEFAULT 'pending', ## use enum here?
    `notes`  varchar(500) DEFAULT NULL
);

CREATE TABLE `customer`
(
    `cid`      int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `fullname` varchar(100)        NOT NULL,
    `email`    varchar(50)         NOT NULL,
    `password` varchar(150)        NOT NULL,
    `phone`    varchar(25)         DEFAULT NULL
);

CREATE TABLE administrator
(
    adminId  INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    fullname VARCHAR(100)    DEFAULT NULL,
    password VARCHAR(100)    NOT NULL,
    email    VARCHAR(30)     NOT NULL,
    phone    VARCHAR(25)     DEFAULT NULL
);

CREATE TABLE `reservation`
(
    `id`          int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `start`       varchar(30)         NOT NULL,
    `end`         varchar(30)         NOT NULL,
    `type`        varchar(100)        NOT NULL,
    `requirement` varchar(100)                 DEFAULT 'no preference', ## use enum here?
    `adults`      int(2)              NOT NULL,
    `children`    int(2)                       DEFAULT '0',
    `requests`    varchar(500)                 DEFAULT NULL,
    `timestamp`   timestamp           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `hash`        varchar(100)                 DEFAULT NULL
);
