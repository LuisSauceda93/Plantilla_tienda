-- MySQL Script generated by MySQL Workbench
-- 03/18/16 13:37:48
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Carrito
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Carrito` ;

-- -----------------------------------------------------
-- Schema Carrito
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Carrito` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `Carrito` ;

-- -----------------------------------------------------
-- Table `Carrito`.`Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`Usuarios` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`Usuarios` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `telefono` BIGINT(14) NULL,
  `correo` VARCHAR(45) NULL,
  `contrasena` VARCHAR(45) NULL,
  `domicilio` VARCHAR(100) NULL,
  `descripcion` VARCHAR(45) NULL,
  `foto` LONGBLOB NULL,
  `fecha_alta` DATE NULL,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Carrito`.`Categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`Categorias` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`Categorias` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` TEXT NULL,
  `imagen` LONGBLOB NULL,
  PRIMARY KEY (`idCategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Carrito`.`Productos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`Productos` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`Productos` (
  `idProducto` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` TEXT NULL,
  `precio` FLOAT NULL,
  `especificaciones` TEXT NULL,
  `imagen` LONGBLOB NULL,
  `idCategoria` INT NOT NULL,
  `pdf` LONGBLOB NULL,
  PRIMARY KEY (`idProducto`),
  INDEX `fk_Productos_Categorias1_idx` (`idCategoria` ASC),
  CONSTRAINT `fk_Productos_Categorias1`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `Carrito`.`Categorias` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Carrito`.`Eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`Eventos` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`Eventos` (
  `idEventos` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `contenido` TEXT NULL,
  `fecha` DATE NULL,
  `imagen` LONGBLOB NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idEventos`),
  INDEX `fk_Eventos_Clientes1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_Eventos_Clientes1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `Carrito`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Carrito`.`Noticias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`Noticias` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`Noticias` (
  `idNoticias` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `contenido` TEXT NULL,
  `fecha` DATE NULL,
  `imagen` LONGBLOB NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idNoticias`),
  INDEX `fk_Noticias_Clientes1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_Noticias_Clientes1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `Carrito`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Carrito`.`pedidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`pedidos` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`pedidos` (
  `idpedidos` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL,
  `estatus` VARCHAR(45) NULL,
  `forma_pago` VARCHAR(45) NULL,
  `nom_banco` VARCHAR(100) NULL,
  `num_cuenta` BIGINT(16) UNSIGNED NULL,
  `num_tarjeta` BIGINT(16) NULL,
  `num_clabe` BIGINT(18) UNSIGNED NULL,
  `nom_titular` VARCHAR(100) NULL,
  `estatus_pago` VARCHAR(45) NULL,
  `forma_envio` VARCHAR(70) NULL,
  `domicilio` VARCHAR(200) NULL,
  `total` FLOAT NULL,
  `subtotal` FLOAT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idpedidos`),
  INDEX `fk_pedidos_Usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_pedidos_Usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `Carrito`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Carrito`.`det_pedidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`det_pedidos` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`det_pedidos` (
  `iddet_pedidos` INT NOT NULL AUTO_INCREMENT,
  `cantidad` FLOAT NULL,
  `idProducto` INT NOT NULL,
  `idpedidos` INT NOT NULL,
  PRIMARY KEY (`iddet_pedidos`),
  INDEX `fk_det_pedidos_Productos1_idx` (`idProducto` ASC),
  INDEX `fk_det_pedidos_pedidos1_idx` (`idpedidos` ASC),
  CONSTRAINT `fk_det_pedidos_Productos1`
    FOREIGN KEY (`idProducto`)
    REFERENCES `Carrito`.`Productos` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_det_pedidos_pedidos1`
    FOREIGN KEY (`idpedidos`)
    REFERENCES `Carrito`.`pedidos` (`idpedidos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Carrito`.`lista_de_deseos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`lista_de_deseos` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`lista_de_deseos` (
  `idlista` INT NOT NULL AUTO_INCREMENT,
  `idProducto` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idlista`),
  INDEX `fk_lista_de_deseos_Productos1_idx` (`idProducto` ASC),
  INDEX `fk_lista_de_deseos_Usuarios1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_lista_de_deseos_Productos1`
    FOREIGN KEY (`idProducto`)
    REFERENCES `Carrito`.`Productos` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_de_deseos_Usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `Carrito`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Carrito`.`Factura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`Factura` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`Factura` (
  `idFactura` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `domicilio` VARCHAR(100) NULL,
  `telefono` BIGINT(14) NULL,
  `correo` VARCHAR(45) NULL,
  `rfc` VARCHAR(45) NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idFactura`),
  INDEX `fk_factura_Usuarios1_idx` (`idUsuario` ASC),
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC),
  UNIQUE INDEX `rfc_UNIQUE` (`rfc` ASC),
  CONSTRAINT `fk_factura_Usuarios1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `Carrito`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Carrito`.`Preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Carrito`.`Preguntas` ;

CREATE TABLE IF NOT EXISTS `Carrito`.`Preguntas` (
  `idPreguntas` INT NOT NULL AUTO_INCREMENT,
  `pregunta` VARCHAR(250) NULL,
  `respuesta` TEXT NULL,
  PRIMARY KEY (`idPreguntas`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
