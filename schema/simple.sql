CREATE DATABASE `simple` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE `simple`.`order` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `member_id` INT UNSIGNED NOT NULL ,
    `amount` INT UNSIGNED NOT NULL ,
    `ordered_at` TIMESTAMP NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `simple`.`order_confirm` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `order_id` INT UNSIGNED NOT NULL ,
    `supervisor` VARCHAR(255) NOT NULL ,
    `confirmed_at` TIMESTAMP NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
ALTER TABLE `simple`.`order_confirm` ADD FOREIGN KEY (`order_id`) REFERENCES `order`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `simple`.`bill` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `order_id` INT UNSIGNED NOT NULL ,
    `amount_billed` INT UNSIGNED NOT NULL ,
    `deposit_scheduled_date` DATE NOT NULL ,
    `billed_at` TIMESTAMP NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
ALTER TABLE `simple`.`bill` ADD FOREIGN KEY (`order_id`) REFERENCES `order`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE TABLE `simple`.`deposit` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `bill_id` INT UNSIGNED NOT NULL ,
    `amount` INT UNSIGNED NOT NULL ,
    `depositor` VARCHAR(255) NOT NULL ,
    `deposited_at` TIMESTAMP NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
ALTER TABLE `simple`.`deposit` ADD FOREIGN KEY (`bill_id`) REFERENCES `bill`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE TABLE `simple`.`order_cancel` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `order_id` INT UNSIGNED NOT NULL ,
    `canceled_at` TIMESTAMP NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
ALTER TABLE `simple`.`order_cancel` ADD FOREIGN KEY (`order_id`) REFERENCES `order`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
