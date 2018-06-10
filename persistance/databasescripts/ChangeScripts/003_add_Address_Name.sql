use computecherp;

alter table address
add name nvarchar(50) not null default 0;

alter table address
modify CountryCode nvarchar(100);

alter table address
change CountryCode Country nvarchar(100);