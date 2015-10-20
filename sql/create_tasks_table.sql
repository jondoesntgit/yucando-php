CREATE TABLE tasks
(
id int not null auto_increment,
title varchar(15),
due datetime,
created datetime,
completed_at datetime,
deferred_until datetime,
notes text,
owner_id int,
foreign key (owner_id) references users(id),
primary key(id)
);
