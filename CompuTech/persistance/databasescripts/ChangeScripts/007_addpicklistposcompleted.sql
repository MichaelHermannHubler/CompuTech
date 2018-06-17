ALTER TABLE `computecherp`.`picklistarticle` 
ADD COLUMN `completed` TINYINT NULL AFTER `quantity`;

ALTER TABLE `picklist` ADD `Completed` BIT(1) NULL AFTER `Number`;