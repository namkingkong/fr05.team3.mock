SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema fr05_mock_team3
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `fr05_mock_team3` ;
CREATE SCHEMA IF NOT EXISTS `fr05_mock_team3` DEFAULT CHARACTER SET latin1 ;
USE `fr05_mock_team3` ;

-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`brand`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`brand` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`brand` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) CHARACTER SET 'latin1' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 40
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`product` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`product` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `brand_id` INT(11) NULL DEFAULT NULL,
  `name` VARCHAR(256) CHARACTER SET 'latin1' NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `country` VARCHAR(128) NULL DEFAULT NULL,
  `list_price` DOUBLE NULL DEFAULT NULL,
  `sales_price` DOUBLE NULL DEFAULT NULL,
  `quantity` INT(11) NULL DEFAULT '0',
  `index` INT(11) NULL DEFAULT NULL,
  `deleted_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_brand1_idx` (`brand_id` ASC),
  CONSTRAINT `fk_product_brand1`
    FOREIGN KEY (`brand_id`)
    REFERENCES `fr05_mock_team3`.`brand` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`banner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`banner` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`banner` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `index` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_banner_product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_banner_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `fr05_mock_team3`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`category` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`category` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(256) CHARACTER SET 'latin1' NOT NULL,
  `index` INT(11) NULL DEFAULT NULL,
  `level` INT(11) NULL DEFAULT NULL,
  `parent_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `fk_category_category1_idx` (`parent_id` ASC),
  CONSTRAINT `fk_category_category1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `fr05_mock_team3`.`category` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 34
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`user` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(256) CHARACTER SET 'latin1' NOT NULL,
  `password` VARCHAR(256) CHARACTER SET 'latin1' NOT NULL,
  `email` VARCHAR(256) CHARACTER SET 'latin1' NULL,
  `authorization` INT(1) NULL DEFAULT 2,
  `name` VARCHAR(255) NULL,
  `address` VARCHAR(255) NULL,
  `phone` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`comment` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`comment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `content` TEXT NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `product_id` INT(11) NOT NULL,
  `guestEmail` VARCHAR(128) NULL DEFAULT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comment_product1_idx` (`product_id` ASC),
  INDEX `fk_comment_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_comment_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `fr05_mock_team3`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `fr05_mock_team3`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`image` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`image` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(256) CHARACTER SET 'latin1' NOT NULL,
  `isMainImage` INT(1) NOT NULL,
  `product_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_image_product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_image_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `fr05_mock_team3`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`link`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`link` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`link` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `object_id` INT(11) NOT NULL,
  `table` VARCHAR(256) CHARACTER SET 'latin1' NOT NULL,
  `uri` VARCHAR(256) CHARACTER SET 'latin1' NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `unq_link_object_id_table` (`object_id` ASC, `table` ASC),
  UNIQUE INDEX `unq_link_uri` (`uri` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`order` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`order` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `time` DATETIME NOT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  `customer_email` VARCHAR(255) NOT NULL,
  `customer_name` VARCHAR(255) NOT NULL,
  `customer_phone` VARCHAR(255) NOT NULL,
  `customer_address` VARCHAR(255) NOT NULL,
  `isPaid` INT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `fk_order_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_order_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `fr05_mock_team3`.`user` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`order_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`order_detail` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`order_detail` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `order_id` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  `price` DOUBLE NOT NULL,
  `quantity` INT(11) NOT NULL,
  `product_name` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_order_has_product_order1_idx` (`order_id` ASC),
  INDEX `fk_order_detail_product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_order_detail_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `fr05_mock_team3`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_order_detail_order_id`
    FOREIGN KEY (`order_id`)
    REFERENCES `fr05_mock_team3`.`order` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`product_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`product_category` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`product_category` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_category_has_product_product1_idx` (`product_id` ASC),
  INDEX `fk_category_has_product_category_idx` (`category_id` ASC),
  INDEX `unq_category_id_product_id` (`category_id` ASC, `product_id` ASC),
  CONSTRAINT `fk_category_has_product_category`
    FOREIGN KEY (`category_id`)
    REFERENCES `fr05_mock_team3`.`category` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_category_has_product_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `fr05_mock_team3`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`review`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`review` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`review` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `rating` FLOAT NOT NULL,
  `review` TEXT CHARACTER SET 'latin1' NOT NULL,
  `isApproved` INT(1) NOT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `product_id` INT(11) NOT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  `email` VARCHAR(128) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_review_product1_idx` (`product_id` ASC),
  INDEX `fk_review_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_review_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `fr05_mock_team3`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_review_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `fr05_mock_team3`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `fr05_mock_team3`.`category_1`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fr05_mock_team3`.`category_1` ;

CREATE TABLE IF NOT EXISTS `fr05_mock_team3`.`category_1` (
  `category_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`category_id`));


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
