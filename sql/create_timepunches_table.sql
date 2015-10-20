CREATE TABLE timepunches
(
id int not null auto_increment,
task_id int,
punch_in datetime,
punch_out datetime,
foreign key (task_id) references tasks(id),
primary key(id)
);
