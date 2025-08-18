-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema intercurso
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema intercurso
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `intercurso` DEFAULT CHARACTER SET utf8 ;
USE `intercurso` ;

-- -----------------------------------------------------
-- Table `intercurso`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `intercurso`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `email` VARCHAR(250) NULL,
  `tipo` VARCHAR(250) NULL,
  `senha` VARCHAR(250) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intercurso`.`Modalidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `intercurso`.`Modalidade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `regras` TEXT NULL,
  `numero_atletas` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intercurso`.`Time`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `intercurso`.`Time` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `id_gestor` INT NOT NULL,
  `id_modalidade` INT NOT NULL,
  PRIMARY KEY (`id`, `id_modalidade`),
  INDEX `fk_Time_Usuario_idx` (`id_gestor` ASC) VISIBLE,
  INDEX `fk_Time_Modalidade1_idx` (`id_modalidade` ASC) VISIBLE,
  CONSTRAINT `fk_Time_Usuario`
    FOREIGN KEY (`id_gestor`)
    REFERENCES `intercurso`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Time_Modalidade1`
    FOREIGN KEY (`id_modalidade`)
    REFERENCES `intercurso`.`Modalidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intercurso`.`Etapa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `intercurso`.`Etapa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(250) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intercurso`.`Jogo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `intercurso`.`Jogo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `local` TEXT NULL,
  `data` DATE NULL,
  `vencedor` VARCHAR(250) NULL,
  `status` VARCHAR(250) NULL,
  `time1` INT NULL,
  `time2` INT NULL,
  `id_modalidade` INT NOT NULL,
  `horario` TIME NULL,
  `id_proximo_jogo` INT NULL,
  `id_etapa` INT NOT NULL,
  PRIMARY KEY (`id`, `id_etapa`),
  INDEX `fk_Jogo_Time1_idx` (`time1` ASC) VISIBLE,
  INDEX `fk_Jogo_Time2_idx` (`time2` ASC) VISIBLE,
  INDEX `fk_Jogo_Modalidade1_idx` (`id_modalidade` ASC) VISIBLE,
  INDEX `fk_Jogo_Jogo1_idx` (`id_proximo_jogo` ASC) VISIBLE,
  INDEX `fk_Jogo_Etapa1_idx` (`id_etapa` ASC) VISIBLE,
  CONSTRAINT `fk_Jogo_Time1`
    FOREIGN KEY (`time1`)
    REFERENCES `intercurso`.`Time` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Jogo_Time2`
    FOREIGN KEY (`time2`)
    REFERENCES `intercurso`.`Time` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Jogo_Modalidade1`
    FOREIGN KEY (`id_modalidade`)
    REFERENCES `intercurso`.`Modalidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Jogo_Jogo1`
    FOREIGN KEY (`id_proximo_jogo`)
    REFERENCES `intercurso`.`Jogo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Jogo_Etapa1`
    FOREIGN KEY (`id_etapa`)
    REFERENCES `intercurso`.`Etapa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intercurso`.`Usuario_and_time`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `intercurso`.`Usuario_and_time` (
  `id_atleta` INT NOT NULL,
  `id_time` INT NOT NULL,
  `status` TINYINT NULL,
  PRIMARY KEY (`id_atleta`, `id_time`),
  INDEX `fk_Usuario_has_Time_Time1_idx` (`id_time` ASC) VISIBLE,
  INDEX `fk_Usuario_has_Time_Usuario1_idx` (`id_atleta` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_has_Time_Usuario1`
    FOREIGN KEY (`id_atleta`)
    REFERENCES `intercurso`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Time_Time1`
    FOREIGN KEY (`id_time`)
    REFERENCES `intercurso`.`Time` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
