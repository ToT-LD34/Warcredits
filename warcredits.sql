-- MySQL Script generated by MySQL Workbench
-- jeu. 23 févr. 2017 14:56:57 CET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `pwd` VARCHAR(45) NULL,
  `credits` INT NULL DEFAULT 100000,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`planets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`planets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_planets_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_planets_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`warships`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`warships` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `amount` INT NULL,
  `planets_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_warships_planets1_idx` (`planets_id` ASC),
  CONSTRAINT `fk_warships_planets1`
    FOREIGN KEY (`planets_id`)
    REFERENCES `mydb`.`planets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`defenses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`defenses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `amount` INT NULL,
  `planets_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_warships_planets1_idx` (`planets_id` ASC),
  CONSTRAINT `fk_warships_planets10`
    FOREIGN KEY (`planets_id`)
    REFERENCES `mydb`.`planets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
