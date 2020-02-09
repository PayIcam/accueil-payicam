DROP TABLE IF EXISTS `item` ;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NULL,
  `quantity` INT NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `visibility` VARCHAR(1) NOT NULL NOT NULL,
  PRIMARY KEY (`item_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`reservation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reservation` ;
CREATE TABLE IF NOT EXISTS `reservation` (
  `reservation_id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `quantity` INT NOT NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `status` VARCHAR(1) NOT NULL COMMENT "W = waiting / V = validated / A = aborted / F = finished / I = in_progress",
  `item_id` INT NOT NULL,
  PRIMARY KEY (`reservation_id`),
  INDEX `fk_reservation_item_idx` (`item_id` ASC),
  CONSTRAINT `fk_reservation_item`
    FOREIGN KEY (`item_id`)
    REFERENCES `item` (`item_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;