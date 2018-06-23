CREATE TABLE `computecherp`.`purchaseorderarticle` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `ArticleID` INT(11) NOT NULL,
  `OrderID` INT(11) NOT NULL,
  `QuantityOrdered` INT NOT NULL,
  `QuantityDelivered` INT NULL,
  `Price` DECIMAL(18,2) NOT NULL,
  `Defective` INT(1) NULL,
  PRIMARY KEY (`ID`));

ALTER TABLE `computecherp`.`purchaseorderarticle` 
  ADD INDEX `purchaseorderarticle_article_idx` (`ArticleID` ASC),
  ADD INDEX `purchaseorderarticle_order_idx` (`OrderID` ASC),
  ADD CONSTRAINT `purchaseorderarticle_article`
    FOREIGN KEY (`ArticleID`)
    REFERENCES `computecherp`.`article` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchaseorderarticle_purchaseorder`
    FOREIGN KEY (`OrderID`)
    REFERENCES `computecherp`.`purchaseorder` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;
