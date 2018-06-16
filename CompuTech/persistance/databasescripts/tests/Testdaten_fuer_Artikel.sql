insert into address (Street, PostalCode, City, Country) values ('Teststraße 5', 1200, 'Wien', 'Austria');
insert into address (Street, PostalCode, City, Country) values ('Wagramer Str. 195', 1220, 'Wien', 'Austria');

insert into supplier (Name, AddressID, VATNumber) values ('Testlieferant 1', 1, 55453);
insert into supplier (Name, AddressID, VATNumber) values ('Hauptlieferant 2', 1, 88776);
insert into supplier (Name, AddressID, VATNumber) values ('FH Technikum', 1, 00876);
insert into supplier (Name, AddressID, VATNumber) values ('Cyberport', 2, 'ATU62839977');


insert into articlegroup (Name, Description) values ('Kopfhörer', 'Alltagstauglicher Kopfhöher ohne Blue Tooth');
insert into articlegroup (Name, Description) values ('Bluetooth-Kopfhörer', 'Alltagstauglicher Kopfhörer mit Bluetooth');
insert into articlegroup (Name, Description) values ('Gaming-Kopfhörer', 'Kopfhörer für Verwendung im High-End-Gaming-Bereich');
insert into articlegroup (Name, Description) values ('Bluetooth-Maus', 'Maus mit Bluetooth Möglichkeit');
insert into articlegroup (Name, Description) values ('Maus', 'Maus ohne Bluetooth Möglichkeit');
insert into articlegroup (Name, Description) values ('Gaming Maus', 'Maus für Verwendung im High-End-Gaming-Bereich');
insert into articlegroup (Name, Description) values ('Grafikkarte über 500 EUR', 'Grafikkarten im höhren Preissegment');
insert into articlegroup (Name, Description) values ('Grafikkarte unter 500 EUR', 'Grafikkarten im unteren Preissegment');

insert into warehouselocation (Rack, Position) values ('Rack 1', 'Position 1');
insert into warehouselocation (Rack, Position) values ('Rack 1', 'Position 2');
insert into warehouselocation (Rack, Position) values ('Rack 1', 'Position 3');
insert into warehouselocation (Rack, Position) values ('Rack 1', 'Position 4');
insert into warehouselocation (Rack, Position) values ('Rack 1', 'Position 5');

insert into article (Number, Name, DefaulWarehouseLocationID, MinimalStorage, PurchasePrice, SupplierID,Surcharge, ArticleGroupID, Unit, PackingType, PackingQuantity) values( '10001', 'Asus GeForce GT 710-SL', 1, 400, 52.90, 4, 15, 8, 'PCE', 'PAK', 40);
insert into article ( Number, Name, DefaulWarehouseLocationID, MinimalStorage, PurchasePrice, SupplierID,Surcharge, ArticleGroupID, Unit) values('10002', 'MSI GeForce GTX', 2, 10, 908, 4, 15, 7, 'PCE');
insert into article (Number, Name, DefaulWarehouseLocationID, MinimalStorage, PurchasePrice, SupplierID,Surcharge, ArticleGroupID, Unit) values( '10003', 'Gainward GeForce GTX 1070', 3, 20, 511, 4, 15, 7, 'PCE');
insert into article (Number, Name, DefaulWarehouseLocationID, MinimalStorage, PurchasePrice, SupplierID,Surcharge, ArticleGroupID, Unit) values( '10004', 'Jabra Motion Office UC', 4, 400, 217, 4, 15, 2, 'PCE');
insert into article (Number, Name, DefaulWarehouseLocationID, MinimalStorage, PurchasePrice, SupplierID,Surcharge, ArticleGroupID, Unit, PackingType, PackingQuantity) values( '10005', 'Plantronics Headset Blackwire', 5, 70, 111, 4, 15, 1, 'PCE', 'PAK', 20);

