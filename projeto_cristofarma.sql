-- MySQL Script generated by MySQL Workbench
-- Wed Nov 24 19:47:22 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projeto_cristofarma
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projeto_cristofarma
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projeto_cristofarma` DEFAULT CHARACTER SET utf8 ;
USE `projeto_cristofarma` ;

-- -----------------------------------------------------
-- Table `projeto_cristofarma`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_cristofarma`.`pessoa` (
  `id_pessoa` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf_cnpj` VARCHAR(20) NULL,
  `tipo_pessoa` ENUM('cliente', 'funcionario', 'fornecedor') NOT NULL,
  `email` VARCHAR(45) NULL,
  `telefone_fixo` VARCHAR(11) NULL,
  `telefone_celular` VARCHAR(11) NULL,
  `matricula` VARCHAR(11) NULL,
  `senha` VARCHAR(45) NULL,
  `funcao` ENUM('gerente', 'vendedor', 'operador de caixa') NULL,
  `endereco` VARCHAR(60) NULL,
  PRIMARY KEY (`id_pessoa`),
  UNIQUE INDEX `cpf_cnpj_UNIQUE` (`cpf_cnpj` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_cristofarma`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_cristofarma`.`produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `nome_produto` VARCHAR(60) NOT NULL,
  `preco_custo` DECIMAL(10,2) NULL,
  `preco_venda` DECIMAL(10,2) NULL,
  `codigo_barras` VARCHAR(45) NULL,
  `pessoa_id_pessoa` INT NOT NULL,
  PRIMARY KEY (`id_produto`),
  INDEX `fk_produto_pessoa1_idx` (`pessoa_id_pessoa` ASC) ,
  CONSTRAINT `fk_produto_pessoa1`
    FOREIGN KEY (`pessoa_id_pessoa`)
    REFERENCES `projeto_cristofarma`.`pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_cristofarma`.`estoque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_cristofarma`.`estoque` (
  `id_estoque` INT NOT NULL AUTO_INCREMENT,
  `quantidade_estoque` INT NOT NULL,
  `produto_id_produto` INT NOT NULL,
  PRIMARY KEY (`id_estoque`),
  INDEX `fk_estoque_produto1_idx` (`produto_id_produto` ASC) ,
  CONSTRAINT `fk_estoque_produto1`
    FOREIGN KEY (`produto_id_produto`)
    REFERENCES `projeto_cristofarma`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_cristofarma`.`venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_cristofarma`.`venda` (
  `id_venda` INT NOT NULL AUTO_INCREMENT,
  `codigo_venda` INT(15) NOT NULL,
  `pessoa_id_pessoa_vendedor` INT NULL,
  `pessoa_id_pessoa_cliente` INT NULL,
  `data_venda` VARCHAR(11) NULL,
  `tipo_pagamento` ENUM('a vista', 'debito', 'credito') NULL,
  `status_venda` ENUM('aberto', 'fechado', 'cancelado') NULL,
  `valor_venda_sem_desconto` DECIMAL(10,2) NULL,
  `desconto` DECIMAL(10,2) NULL,
  `valor_venda_com_desconto` DECIMAL(10,2) NULL,
  `total_item_venda` INT NULL,
  INDEX `fk_venda_pessoa1_idx` (`pessoa_id_pessoa_vendedor` ASC) ,
  INDEX `fk_venda_pessoa2_idx` (`pessoa_id_pessoa_cliente` ASC) ,
  UNIQUE INDEX `id_venda_UNIQUE` (`id_venda` ASC) ,
  PRIMARY KEY (`id_venda`),
  CONSTRAINT `fk_venda_pessoa1`
    FOREIGN KEY (`pessoa_id_pessoa_vendedor`)
    REFERENCES `projeto_cristofarma`.`pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venda_pessoa2`
    FOREIGN KEY (`pessoa_id_pessoa_cliente`)
    REFERENCES `projeto_cristofarma`.`pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_cristofarma`.`cupom_fiscal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_cristofarma`.`cupom_fiscal` (
  `id_cupom` INT NOT NULL AUTO_INCREMENT,
  `venda_id_venda` INT NOT NULL,
  `valor_venda` DECIMAL(10,2) NOT NULL,
  `valor_recebido` DECIMAL(10,2) NOT NULL,
  `troco` DECIMAL(10,2) NOT NULL,
  `cliente` VARCHAR(45) NULL,
  PRIMARY KEY (`id_cupom`),
  INDEX `fk_cupom_fiscal_venda1_idx` (`venda_id_venda` ASC) ,
  CONSTRAINT `fk_cupom_fiscal_venda1`
    FOREIGN KEY (`venda_id_venda`)
    REFERENCES `projeto_cristofarma`.`venda` (`id_venda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_cristofarma`.`item_compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_cristofarma`.`item_compra` (
  `id_compra` INT NOT NULL AUTO_INCREMENT,
  `data_compra` VARCHAR(11) NOT NULL,
  `numero_nota` INT NOT NULL,
  `quantidade_compra` INT NOT NULL,
  `produto_id_produto` INT NOT NULL,
  PRIMARY KEY (`id_compra`),
  INDEX `fk_produto_compra_produto1_idx` (`produto_id_produto` ASC) ,
  CONSTRAINT `fk_produto_compra_produto1`
    FOREIGN KEY (`produto_id_produto`)
    REFERENCES `projeto_cristofarma`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_cristofarma`.`item_Venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_cristofarma`.`item_Venda` (
  `id_item_venda` INT NOT NULL AUTO_INCREMENT,
  `venda_id_venda` INT NOT NULL,
  `produto_id_produto` INT NOT NULL,
  `quantidade_item` INT NULL,
  `valor_total_item` DECIMAL(10,2) NULL,
  PRIMARY KEY (`id_item_venda`),
  INDEX `fk_Item_Venda_venda1_idx` (`venda_id_venda` ASC) ,
  INDEX `fk_Item_Venda_produto1_idx` (`produto_id_produto` ASC) ,
  CONSTRAINT `fk_Item_Venda_venda1`
    FOREIGN KEY (`venda_id_venda`)
    REFERENCES `projeto_cristofarma`.`venda` (`id_venda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Item_Venda_produto1`
    FOREIGN KEY (`produto_id_produto`)
    REFERENCES `projeto_cristofarma`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
