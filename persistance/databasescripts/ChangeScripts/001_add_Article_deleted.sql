use computecherp;

alter table article
add deleted bit not null default 0;
