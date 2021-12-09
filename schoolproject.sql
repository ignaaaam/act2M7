-- MySQL Script generated by MySQL Workbench
-- Thu Dec  2 18:46:47 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema schoolproject
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema schoolproject
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `schoolproject` DEFAULT CHARACTER SET utf8 ;
USE `schoolproject` ;

-- -----------------------------------------------------
-- Table `schoolproject`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schoolproject`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO roles VALUES ( 1,"profesor"), ( 2,"alumne"), (3,"admin");


-- -----------------------------------------------------
-- Table `schoolproject`.`cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schoolproject`.`cursos` (
  `id` INT NULL AUTO_INCREMENT,
  `nombre_curso` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO cursos  VALUES ( 1,"DAW"), ( 2,"DAM"), (3,"SMIX");

-- -----------------------------------------------------
-- Table `schoolproject`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schoolproject`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(25) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `roles_id` INT NOT NULL,
  `curso_id` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`roles_id`)
    REFERENCES `schoolproject`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_Curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `schoolproject`.`cursos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `username_UNIQUE` ON `schoolproject`.`users` (`username` ASC);

CREATE UNIQUE INDEX `email_UNIQUE` ON `schoolproject`.`users` (`email` ASC);

CREATE INDEX `fk_users_roles_idx` ON `schoolproject`.`users` (`roles_id` ASC);

CREATE INDEX `fk_users_Curso1_idx` ON `schoolproject`.`users` (`curso_id` ASC);


-- -----------------------------------------------------
-- Table `schoolproject`.`Materias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schoolproject`.`materias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom_materia` VARCHAR(45) NOT NULL,
  `curso_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_materias_Curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `schoolproject`.`cursos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO materias  VALUES ( 1,"M2", 1), ( 2,"M3", 1), (3,"M4", 2), ( 4,"M5", 3), ( 5,"M6", 1), (6,"M7", 2), ( 7,"M7", 1), ( 8,"M8", 2), (9,"M9", 3), (10, "M10", 3), (11, "M11", 3), (12, "M12", 2);

CREATE INDEX `fk_materias_Curso1_idx` ON `schoolproject`.`materias` (`curso_id` ASC);


-- -----------------------------------------------------
-- Table `schoolproject`.`lists`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schoolproject`.`lists` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `list_name` VARCHAR(45) NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Lists_Users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `schoolproject`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_listas_Users1_idx` ON `schoolproject`.`lists` (`user_id` ASC);


-- -----------------------------------------------------
-- Table `schoolproject`.`tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schoolproject`.`tasks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(155) NOT NULL,
  `completed` TINYINT NOT NULL,
  `list_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Tasks_Lists1`
    FOREIGN KEY (`list_id`)
    REFERENCES `schoolproject`.`lists` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tasks_Lists1_idx` ON `schoolproject`.`tasks` (`list_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;