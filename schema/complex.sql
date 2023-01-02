CREATE DATABASE `complex` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE `complex`.`order` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `order_member_id` INT UNSIGNED NOT NULL ,
    `order_at` TIMESTAMP NOT NULL ,
    `order_amount` INT UNSIGNED NOT NULL ,
    `order_confirmed_supervisor` VARCHAR(255) NULL ,
    `order_confirmed_at` TIMESTAMP NULL ,
    `amount_billed` INT UNSIGNED NULL ,
    `billing_at` TIMESTAMP NULL ,
    `deposit_scheduled_date` DATE NULL ,
    `deposit_amount` INT UNSIGNED NULL ,
    `deposited_at` TIMESTAMP NULL ,
    `depositor` VARCHAR(255) NULL ,
    `registered_at` TIMESTAMP NOT NULL ,
    `updated_at` TIMESTAMP NULL ,
    `canceled_at` TIMESTAMP NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
