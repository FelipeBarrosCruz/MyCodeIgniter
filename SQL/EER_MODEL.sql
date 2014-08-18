SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `ci_project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ci_project` ;

-- -----------------------------------------------------
-- Table `ci_project`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_project`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ci_project`.`user_informations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_project`.`user_informations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `gender` CHAR(1) NOT NULL,
  `email` VARCHAR(125) NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `users_fk_user_informations` (`user_id` ASC),
  CONSTRAINT `users_fk_user_informations`
    FOREIGN KEY (`user_id`)
    REFERENCES `ci_project`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ci_project`.`ci_sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_project`.`ci_sessions` (
  `session_id` VARCHAR(40) NOT NULL DEFAULT 0,
  `ip_address` VARCHAR(45) NOT NULL DEFAULT 0,
  `user_agent` VARCHAR(255) NOT NULL,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` TEXT NULL,
  PRIMARY KEY (`session_id`),
  INDEX `last_activity_idx` (`last_activity` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `ci_project`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `ci_project`;
INSERT INTO `ci_project`.`users` (`id`, `login`, `password`) VALUES (1, 'felipebarros', '6367c48dd193d56ea7b0baad25b19455e529f5ee');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ci_project`.`user_informations`
-- -----------------------------------------------------
START TRANSACTION;
USE `ci_project`;
INSERT INTO `ci_project`.`user_informations` (`id`, `name`, `gender`, `email`, `user_id`) VALUES (1, 'Felipe Barros', 'M', 'felipe.barros.pt@gmail.com', 1);

COMMIT;

