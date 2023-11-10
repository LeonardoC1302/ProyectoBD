-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema recursos_humanos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema recursos_humanos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `recursos_humanos` DEFAULT CHARACTER SET utf8 ;
USE `recursos_humanos` ;

-- -----------------------------------------------------
-- Table `recursos_humanos`.`department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`department` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(45) NOT NULL,
  `description` VARCHAR(150) NOT NULL,
  `salary` DECIMAL(10,2) NOT NULL,
  `departmentId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_rol_department1_idx` (`departmentId` ASC) VISIBLE,
  CONSTRAINT `fk_rol_department1`
    FOREIGN KEY (`departmentId`)
    REFERENCES `recursos_humanos`.`department` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`country`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`country` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `surname` VARCHAR(30) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `verified` TINYINT NOT NULL,
  `token` VARCHAR(15) NOT NULL,
  `admin` TINYINT NOT NULL,
  `phone` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`employee` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(30) NOT NULL,
  `hours` INT NOT NULL,
  `pay` TINYINT NOT NULL,
  `lastPay` DATE NOT NULL,
  `rolId` INT NOT NULL,
  `countryId` INT NOT NULL,
  `usersId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_empleado_department_idx` (`rolId` ASC) VISIBLE,
  INDEX `fk_employee_country1_idx` (`countryId` ASC) VISIBLE,
  INDEX `fk_employee_users1_idx` (`usersId` ASC) VISIBLE,
  CONSTRAINT `fk_empleado_department`
    FOREIGN KEY (`rolId`)
    REFERENCES `recursos_humanos`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_country1`
    FOREIGN KEY (`countryId`)
    REFERENCES `recursos_humanos`.`country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_users1`
    FOREIGN KEY (`usersId`)
    REFERENCES `recursos_humanos`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`city`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`city` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `countryId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_city_country1_idx` (`countryId` ASC) VISIBLE,
  CONSTRAINT `fk_city_country1`
    FOREIGN KEY (`countryId`)
    REFERENCES `recursos_humanos`.`country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`socialCharge`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`socialCharge` (
  `id` INT NOT NULL,
  `description` VARCHAR(300) NOT NULL,
  `quantity` DECIMAL(10,2) NOT NULL,
  `countryId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_socialCharge_country1_idx` (`countryId` ASC) VISIBLE,
  CONSTRAINT `fk_socialCharge_country1`
    FOREIGN KEY (`countryId`)
    REFERENCES `recursos_humanos`.`country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`performance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`performance` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `report` VARCHAR(500) NOT NULL,
  `rating` SMALLINT NOT NULL,
  `employeeId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_performance_employee1_idx` (`employeeId` ASC) VISIBLE,
  CONSTRAINT `fk_performance_employee1`
    FOREIGN KEY (`employeeId`)
    REFERENCES `recursos_humanos`.`employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`salaryLog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`salaryLog` (
  `id` INT NOT NULL,
  `description` VARCHAR(100) NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `datePayed` DATE NOT NULL,
  `employeeId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_salaryLog_employee1_idx` (`employeeId` ASC) VISIBLE,
  CONSTRAINT `fk_salaryLog_employee1`
    FOREIGN KEY (`employeeId`)
    REFERENCES `recursos_humanos`.`employee` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
