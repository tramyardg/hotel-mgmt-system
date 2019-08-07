CREATE TABLE `booking`
(
    `id`     int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `cid`    int(11)             NOT NULL,
    `status` ENUM ('PENDING', 'CONFIRMED', 'CANCELLED') DEFAULT 'PENDING',
    `notes`  varchar(500)                               DEFAULT NULL
);

CREATE TABLE `customer`
(
    `cid`      int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `fullname` varchar(100)        NOT NULL,
    `email`    varchar(50)         NOT NULL,
    `password` varchar(150)        NOT NULL,
    `phone`    varchar(25) DEFAULT NULL
);

CREATE TABLE administrator
(
    `adminId`  INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(100) DEFAULT NULL,
    `password` VARCHAR(100)    NOT NULL,
    `email`    VARCHAR(30)     NOT NULL UNIQUE,
    `phone`    VARCHAR(25)  DEFAULT NULL
);

CREATE TABLE `reservation`
(
    `id`          int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `start`       varchar(30)         NOT NULL,
    `end`         varchar(30)         NOT NULL,
    `type`        ENUM ('Single', 'Double', 'Deluxe')              DEFAULT 'Single',
    `requirement` ENUM ('No Preference', 'Non Smoking', 'Smoking') DEFAULT 'No Preference',
    `adults`      int(2)              NOT NULL,
    `children`    int(2)                                           DEFAULT '0',
    `requests`    varchar(500)                                     DEFAULT NULL,
    `timestamp`   timestamp           NOT NULL                     DEFAULT CURRENT_TIMESTAMP,
    `hash`        varchar(100)                                     DEFAULT NULL
);

# Constraints
--
ALTER TABLE `booking`
    ADD CONSTRAINT `booking_customer__fk` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
    ADD CONSTRAINT `reservation_booking__fk` FOREIGN KEY (`id`) REFERENCES `booking` (`id`) ON DELETE CASCADE;