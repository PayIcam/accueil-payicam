-- MySQL Script generated by MySQL Workbench
-- Sun Jan  6 14:15:20 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema payicam_accueil
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `payicam_accueil` ;

-- -----------------------------------------------------
-- Schema payicam_accueil
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `payicam_accueil` DEFAULT CHARACTER SET utf8 ;
USE `payicam_accueil` ;

-- -----------------------------------------------------
-- Table `payicam_accueil`.`enigmes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payicam_accueil`.`enigmes` ;

CREATE TABLE IF NOT EXISTS `payicam_accueil`.`enigmes` (
  `enigme_id` INT(11) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `answer` TEXT NOT NULL,
  `description` TEXT NOT NULL,
  `images_url` TEXT NOT NULL,
  `promo_cible` TEXT NOT NULL,
  `site_cible` TEXT NOT NULL,
  `debut_enigme` DATETIME NOT NULL,
  `fin_enigme` DATETIME NOT NULL,
  `is_actif` TINYINT(1) NOT NULL,
  `banned_users` TEXT NOT NULL)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `payicam_accueil`.`enigme_answers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payicam_accueil`.`enigme_answers` ;

CREATE TABLE IF NOT EXISTS `payicam_accueil`.`enigme_answers` (
  `winner_id` INT(11) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `answer` TEXT NOT NULL,
  `answer_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`winner_id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `payicam_accueil`.`payicam_accueil_slide`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payicam_accueil`.`payicam_accueil_slide` ;

CREATE TABLE IF NOT EXISTS `payicam_accueil`.`payicam_accueil_slide` (
  `slide_id` INT(50) NOT NULL,
  `slide_image` VARCHAR(200) NOT NULL,
  `slide_message` VARCHAR(500) CHARACTER SET 'utf8' NOT NULL DEFAULT 'message d'accueil',
  PRIMARY KEY (`slide_id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COMMENT = 'table pour insérer un texte d\'info sur la page d\'accueil';


-- -----------------------------------------------------
-- Table `payicam_accueil`.`payicam_carte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payicam_accueil`.`payicam_carte` ;

CREATE TABLE IF NOT EXISTS `payicam_accueil`.`payicam_carte` (
  `carte_id` INT(11) NOT NULL,
  `carte_titre` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `carte_description` VARCHAR(500) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `carte_activation_bouton` TINYINT(1) NOT NULL,
  `carte_bouton` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `carte_photo` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `sites` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`carte_id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `payicam_accueil`.`vote_has_voters`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payicam_accueil`.`vote_has_voters` ;

CREATE TABLE IF NOT EXISTS `payicam_accueil`.`vote_has_voters` (
  `vote_id` INT(11) NOT NULL,
  `choice` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `promo` INT(4) NOT NULL,
  PRIMARY KEY (`vote_id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `payicam_accueil`.`vote_option`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payicam_accueil`.`vote_option` ;

CREATE TABLE IF NOT EXISTS `payicam_accueil`.`vote_option` (
  `nom_vote` VARCHAR(100) NOT NULL,
  `choix_1` VARCHAR(50) NOT NULL,
  `choix_2` VARCHAR(50) NOT NULL,
  `date_debut` DATETIME NOT NULL,
  `date_fin` DATETIME NOT NULL,
  PRIMARY KEY (`nom_vote`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
