-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema cards
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cards
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cards` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `cards` ;

-- -----------------------------------------------------
-- Table `cards`.`card`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cards`.`card` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `price` FLOAT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `cards`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cards`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `modified_date` DATE NULL DEFAULT NULL,
  `modified_user` INT NULL DEFAULT NULL,
  `archive` TINYINT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  INDEX `user_modified_user_idx` (`modified_user` ASC) VISIBLE,
  CONSTRAINT `user_modified_user`
    FOREIGN KEY (`modified_user`)
    REFERENCES `cards`.`user` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `cards`.`user_card`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cards`.`user_card` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `card_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `date_added` DATE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `user_user_card_idx` (`user_id` ASC) VISIBLE,
  INDEX `user_card_card_idx` (`card_id` ASC) VISIBLE,
  CONSTRAINT `user_card_card`
    FOREIGN KEY (`card_id`)
    REFERENCES `cards`.`card` (`id`),
  CONSTRAINT `user_user_card`
    FOREIGN KEY (`user_id`)
    REFERENCES `cards`.`user` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 25
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `cards`.`deck`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cards`.`deck` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `favorite` TINYINT NULL DEFAULT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `deck_user_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `deck_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `cards`.`user` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 29
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `cards`.`card_in_deck`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cards`.`card_in_deck` (
  `card_id` INT NOT NULL,
  `deck_id` INT NOT NULL,
  INDEX `card_in_deck_deck_idx` (`deck_id` ASC) VISIBLE,
  INDEX `card_in_deck_card_idx` (`card_id` ASC) VISIBLE,
  CONSTRAINT `card_in_deck_card`
    FOREIGN KEY (`card_id`)
    REFERENCES `cards`.`user_card` (`id`),
  CONSTRAINT `card_in_deck_deck`
    FOREIGN KEY (`deck_id`)
    REFERENCES `cards`.`deck` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `cards`.`premium_code`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cards`.`premium_code` (
  `code` VARCHAR(16) NOT NULL,
  `test_code` TINYINT NOT NULL,
  `user_id` INT NULL DEFAULT NULL,
  `used_date` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`code`),
  INDEX `code_user_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `code_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `cards`.`user` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `cards`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cards`.`role` (
  `role_idn` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`role_idn`),
  UNIQUE INDEX `role_idn_UNIQUE` (`role_idn` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `cards`.`user_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cards`.`user_role` (
  `user_id` INT NOT NULL,
  `role_idn` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`user_id`, `role_idn`),
  INDEX `user_role_role_idx` (`role_idn` ASC) VISIBLE,
  CONSTRAINT `user_role_role`
    FOREIGN KEY (`role_idn`)
    REFERENCES `cards`.`role` (`role_idn`),
  CONSTRAINT `user_role_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `cards`.`user` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

INSERT INTO `cards`.`role` VALUES ('user');
INSERT INTO `cards`.`role` VALUES ('admin');
INSERT INTO `cards`.`role` VALUES ('premium');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
