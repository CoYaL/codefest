-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema codefest
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema codefest
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `codefest` DEFAULT CHARACTER SET utf8 ;
USE `codefest` ;

-- -----------------------------------------------------
-- Table `codefest`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`roles` ;

CREATE TABLE IF NOT EXISTS `codefest`.`roles` (
  `role_id` INT(11) NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(45) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role`) VALUES
  ('admin'),
  ('systeem'),
  ('medewerker'),
  ('administratiemedewerker'),
  ('manager');


-- -----------------------------------------------------
-- Table `codefest`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`users` ;

CREATE TABLE IF NOT EXISTS `codefest`.`users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `role_id` INT(11) NOT NULL DEFAULT '1',
  `username` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  `password` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  `firstname` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `middlename` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `lastname` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `date_of_birth` DATE NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `login_UNIQUE` (`username` ASC),
  INDEX `fk_role_id_idx` (`role_id` ASC),
  CONSTRAINT `fk_role_id`
    FOREIGN KEY (`role_id`)
    REFERENCES `codefest`.`roles` (`role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `codefest`.`employees`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`employees` ;

CREATE TABLE IF NOT EXISTS `codefest`.`employees` (
  `employee_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `leave_id` INT(11) NULL DEFAULT NULL,
  `factor` FLOAT(3,2) NOT NULL DEFAULT '1.00',
  `department` ENUM('helpdesk', 'commercieel', 'administratiefmedewerker', 'management') CHARACTER SET 'utf8' NOT NULL,
  `state` ENUM('actief', 'ziek', 'vakantie', 'inactief') CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`employee_id`),
  INDEX `fk_user_id_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `codefest`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `codefest`.`projects`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`projects` ;

CREATE TABLE IF NOT EXISTS `codefest`.`projects` (
  `project_id` INT(11) NOT NULL AUTO_INCREMENT,
  `start_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`project_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `codefest`.`employee_project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`employee_project` ;

CREATE TABLE IF NOT EXISTS `codefest`.`employee_project` (
  `employee_project_id` INT(11) NOT NULL AUTO_INCREMENT,
  `employee_id` INT(11) NOT NULL,
  `project_id` INT(11) NOT NULL,
  `worktime` INT(11) NULL DEFAULT NULL,
  `overtime` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`employee_project_id`),
  INDEX `fk_employee_id_idx` (`employee_id` ASC),
  INDEX `fk_project_id_idx` (`project_id` ASC),
  CONSTRAINT `fk_employee_id`
    FOREIGN KEY (`employee_id`)
    REFERENCES `codefest`.`employees` (`employee_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_id`
    FOREIGN KEY (`project_id`)
    REFERENCES `codefest`.`projects` (`project_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `codefest`.`global_settings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`global_settings` ;

CREATE TABLE IF NOT EXISTS `codefest`.`global_settings` (
  `global_setting_id` INT(11) NOT NULL AUTO_INCREMENT,
  `fulltime_hours` INT(11) NOT NULL,
  `year` YEAR NOT NULL,
  `vacation_days` FLOAT(3,2) NOT NULL,
  `vacation_threshold` FLOAT(3,2) NOT NULL,
  PRIMARY KEY (`global_setting_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `codefest`.`holidays`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`holidays` ;

CREATE TABLE IF NOT EXISTS `codefest`.`holidays` (
  `holiday_id` INT(11) NOT NULL AUTO_INCREMENT,
  `start_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` TIMESTAMP NULL DEFAULT NULL,
  `description` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `payment_multiplier` FLOAT(3,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`holiday_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `codefest`.`leave`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`leave` ;

CREATE TABLE IF NOT EXISTS `codefest`.`leave` (
  `leave_id` INT(11) NOT NULL AUTO_INCREMENT,
  `employee_id` INT(11) NOT NULL,
  `start_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` TIMESTAMP NULL DEFAULT NULL,
  `reason` ENUM('sick', 'vacation', 'other') CHARACTER SET 'utf8' NOT NULL DEFAULT 'other',
  `state` ENUM('accepted', 'denied', 'in review') CHARACTER SET 'utf8' NOT NULL DEFAULT 'in review',
  PRIMARY KEY (`leave_id`),
  INDEX `fk_employee_id_idx` (`employee_id` ASC),
  CONSTRAINT `fk_employee_id2`
    FOREIGN KEY (`employee_id`)
    REFERENCES `codefest`.`employees` (`employee_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `codefest`.`project_occupation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`project_occupation` ;

CREATE TABLE IF NOT EXISTS `codefest`.`project_occupation` (
  `project_id` INT(11) NOT NULL AUTO_INCREMENT,
  `helpdesk` INT(11) NOT NULL DEFAULT '0',
  `commercial` INT(11) NOT NULL DEFAULT '0',
  `administration` INT(11) NOT NULL DEFAULT '0',
  `management` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`project_id`),
  INDEX `fk_project_occupation_projects1_idx` (`project_id` ASC),
  CONSTRAINT `fk_project_id2`
    FOREIGN KEY (`project_id`)
    REFERENCES `codefest`.`projects` (`project_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `codefest`.`vacation_days`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codefest`.`vacation_days` ;

CREATE TABLE IF NOT EXISTS `codefest`.`vacation_days` (
  `vacation_day_id` INT(11) NOT NULL AUTO_INCREMENT,
  `employee_id` INT(11) NOT NULL,
  `year` YEAR NOT NULL,
  `days_used` FLOAT(3,2) NOT NULL,
  `days_left` FLOAT(3,2) NOT NULL,
  `days_total` FLOAT(3,2) NOT NULL,
  PRIMARY KEY (`vacation_day_id`),
  INDEX `fk_employee_id_idx` (`employee_id` ASC),
  CONSTRAINT `fk_employee_id3`
    FOREIGN KEY (`employee_id`)
    REFERENCES `codefest`.`employees` (`employee_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
