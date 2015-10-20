CREATE TABLE users
(
id int not null auto_increment,
username varchar(15),
first_name varchar(255),
last_name varchar(255),
email varchar(255),
api_key varchar(255),
password varchar(255),
salt varchar(255),
signup_date datetime,
is_active boolean,
primary key(id)
);
