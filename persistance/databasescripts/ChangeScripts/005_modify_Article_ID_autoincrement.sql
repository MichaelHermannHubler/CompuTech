use computecherp;
ALTER TABLE accountingrecord
DROP FOREIGN KEY AccountingRecord_Article;

ALTER TABLE offerarticle
DROP FOREIGN KEY OfferArticle_Article;

ALTER TABLE orderarticle
DROP FOREIGN KEY OrderArticle_Article;

ALTER TABLE warehouselocationarticle
DROP FOREIGN KEY WarehouseLocationArticle_Article;

ALTER TABLE accountingrecord
ADD CONSTRAINT `AccountingRecord_Article` FOREIGN KEY (`ArticleID`) REFERENCES `article` (`ID`);

ALTER TABLE offerarticle
ADD CONSTRAINT `OfferArticle_Article` FOREIGN KEY (`ArticleID`) REFERENCES `article` (`ID`);

ALTER TABLE orderarticle
ADD CONSTRAINT `OrderArticle_Article` FOREIGN KEY (`ArticleID`) REFERENCES `article` (`ID`);

ALTER TABLE warehouselocationarticle
ADD CONSTRAINT `WarehouseLocationArticle_Article` FOREIGN KEY (`ArticleID`) REFERENCES `article` (`ID`);

alter table article
modify ID int(11) not null auto_increment PRIMARY KEY;
