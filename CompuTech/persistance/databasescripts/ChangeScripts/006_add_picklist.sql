CREATE TABLE `computecherp`.`picklist` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Number` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID`));

  CREATE TABLE `computecherp`.`picklistarticle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `picklistID` INT NOT NULL,
  `articleID` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`id`));

  ALTER TABLE `computecherp`.`picklistarticle` 
ADD INDEX `picklistarticle_article_idx` (`articleID` ASC),
ADD INDEX `picklistarticle_picklist_idx` (`picklistID` ASC);
ALTER TABLE `computecherp`.`picklistarticle` 
ADD CONSTRAINT `picklistarticle_article`
  FOREIGN KEY (`articleID`)
  REFERENCES `computecherp`.`article` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `picklistarticle_picklist`
  FOREIGN KEY (`picklistID`)
  REFERENCES `computecherp`.`picklist` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
