INSERT INTO `order`(`ID`, `Number`) VALUES ('1', '100');
INSERT INTO `order`(`ID`, `Number`) VALUES ('2', '101');
INSERT INTO `order`(`ID`, `Number`) VALUES ('3', '102');

INSERT INTO `orderarticle`(`ID`, `ArticleID`, `OrderID`, `QuantityOrdered`, `QuantityDelivered`, `Price`, `Defective`) VALUES ('1', '1', '1', 10, 10, 30, 0);
INSERT INTO `orderarticle`(`ID`, `ArticleID`, `OrderID`, `QuantityOrdered`, `QuantityDelivered`, `Price`, `Defective`) VALUES ('2', '2', '2', 40, 40, 5, 0);
INSERT INTO `orderarticle`(`ID`, `ArticleID`, `OrderID`, `QuantityOrdered`, `QuantityDelivered`, `Price`, `Defective`) VALUES ('3', '3', '3', 20, 20, 20, 0);

INSERT INTO `salesorder`(`ID`, `CustomerID`, `DeliveryAddressID`, `InvoiceAddressID`, `SysDateCreated`, `OrderID`, `paid`) VALUES ('1', '11', '1', '1', '2018-06-01', '1', 0);
INSERT INTO `salesorder`(`ID`, `CustomerID`, `DeliveryAddressID`, `InvoiceAddressID`, `SysDateCreated`, `OrderID`, `paid`) VALUES ('2', '4', '1', '1', '2018-06-20', '2', 0);
INSERT INTO `salesorder`(`ID`, `CustomerID`, `DeliveryAddressID`, `InvoiceAddressID`, `SysDateCreated`, `OrderID`, `paid`) VALUES ('3', '8', '1', '1', '2018-06-12', '3', 0);
