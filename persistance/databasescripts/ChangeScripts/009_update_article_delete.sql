use computecherp;
ALTER TABLE `article` CHANGE `deleted` `deleted` BIT(1) NOT NULL;
ALTER TABLE `article` CHANGE `deleted` `deleted` INT(1) NOT NULL;
update article set deleted = 1;
