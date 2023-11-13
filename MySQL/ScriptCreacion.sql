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
CREATE SCHEMA IF NOT EXISTS `recursos_humanos` DEFAULT CHARACTER SET utf8mb3 ;
USE `recursos_humanos` ;

-- -----------------------------------------------------
-- Table `recursos_humanos`.`country`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`country` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `socialcharge` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb3;


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
    REFERENCES `recursos_humanos`.`country` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`department` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb3;


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
    REFERENCES `recursos_humanos`.`department` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb3;


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
  PRIMARY KEY (`id`),
  INDEX `fk_empleado_department_idx` (`rolId` ASC) VISIBLE,
  INDEX `fk_employee_country1_idx` (`countryId` ASC) VISIBLE,
  CONSTRAINT `fk_empleado_department`
    FOREIGN KEY (`rolId`)
    REFERENCES `recursos_humanos`.`rol` (`id`),
  CONSTRAINT `fk_employee_country1`
    FOREIGN KEY (`countryId`)
    REFERENCES `recursos_humanos`.`country` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb3;


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
    REFERENCES `recursos_humanos`.`employee` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`salarylog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`salarylog` (
  `id` INT NOT NULL,
  `description` VARCHAR(100) NULL DEFAULT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `datePayed` DATE NOT NULL,
  `employeeId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_salaryLog_employee1_idx` (`employeeId` ASC) VISIBLE,
  CONSTRAINT `fk_salaryLog_employee1`
    FOREIGN KEY (`employeeId`)
    REFERENCES `recursos_humanos`.`employee` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `recursos_humanos`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursos_humanos`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `surname` VARCHAR(60) NOT NULL,
  `email` VARCHAR(90) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `phone` VARCHAR(10) NOT NULL,
  `admin` TINYINT NOT NULL,
  `verified` TINYINT NOT NULL,
  `token` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
