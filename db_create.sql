-- -----------------------------------------------------
-- Table `conference_db`.`USERS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `conference_db`.`USERS` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `nick` VARCHAR(20) NULL,
  `name` VARCHAR(45) NULL,
  `surname` VARCHAR(45) NULL,
  `email` VARCHAR(50) NULL,
  `password` VARCHAR(45) NULL,
  `logged_in` TINYINT NULL,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `conference_db`.`REVIEWS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `conference_db`.`REVIEWS` (
  `id_review` INT NOT NULL AUTO_INCREMENT,
  `review_author` INT NULL,
  `points` FLOAT NULL,
  `text` VARCHAR(500) NULL,
  PRIMARY KEY (`id_review`),
  CONSTRAINT `review_author`
    FOREIGN KEY (`review_author`)
    REFERENCES `conference_db`.`USERS` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `conference_db`.`ARTICLES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `conference_db`.`ARTICLES` (
  `id_article` INT NOT NULL AUTO_INCREMENT,
  `approved` TINYINT NULL,
  `text` VARCHAR(2000) NULL,
  `title` VARCHAR(50) NULL,
  `images` VARCHAR(250) NULL,
  `article_author` INT NULL,
  `review1` INT NULL,
  `review2` INT NULL,
  `review3` INT NULL,
  `introduction_image` VARCHAR(60),
  PRIMARY KEY (`id_article`),
  CONSTRAINT `article_author`
    FOREIGN KEY (`article_author`)
    REFERENCES `conference_db`.`USERS` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `review1`
    FOREIGN KEY (`review1`)
    REFERENCES `conference_db`.`REVIEWS` (`id_review`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `review2`
    FOREIGN KEY (`review2`)
    REFERENCES `conference_db`.`REVIEWS` (`id_review`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `review3`
    FOREIGN KEY (`review3`)
    REFERENCES `conference_db`.`REVIEWS` (`id_review`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
