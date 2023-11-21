use recursos_humanos;

select * from users;
select * from employee;
select* from rol;
select * from department;
select * from country;
select * from salarylog;

INSERT INTO department (name) 
VALUES
('Recursos Humanos'),
('Ventas');

INSERT INTO rol (rol, description, salary, departmentId) 
VALUES
('Jefe', 'Supervisa a todos lo trabajadores, responsable de recibir correo ejecutivos', 1000000.0, 1),
('Contabilidad', 'Se encarga de manejar ingresos y gastos', 550000.0, 1),
('Financiero', 'Se encarga de manejar salarios', 500000.0, 2);


INSERT INTO country (name, socialcharge) 
VALUES
('Costa Rica', 0.02),
('Guatemala', 0.12);

INSERT INTO employee (name, surname, email, phone, hours, pay, lastPay, rolId, countryId)
VALUES 
('Kevin', 'Chang', 'Kevin2@gamail.com', '88888287', 110, 1, '2023-11-11', 2, 2),
('Juanito', 'Alcachofa', 'Juan@gamail.com', '88888888', 17, 0, '2023-10-01', 1, 1),
('Kevin', 'Chang', 'Kevin@gamail.com', '88888887', 112, 0, '2023-10-11', 3, 1),
('Mauricio', 'Chaves', 'Kevin3@gamail.com', '88388287', 15, 1, '2023-10-11', 2, 2);

INSERT INTO performance (report, rating, employeeId) 
VALUES
('Good Job, Hard worker, helps others', 9, 1),
('Poor Performance', 3, 2),
('Great Worker', 10, 3),
('Very efficient, could be a better teamate', 7, 4);



delete from users where id >  0;
alter table users AUTO_INCREMENT = 0;
delete from country where id > 0;
alter table country AUTO_INCREMENT = 1;
delete from employee where id > 0;
alter table employee AUTO_INCREMENT = 1;
delete from rol where id > 0;
alter table rol AUTO_INCREMENT = 1;

update employee set hours = 155 where id = 4;
update rol set salary = 7000.0 where id = 3;

update users set verified=1 where id=2;
update users set token = "" where id=2;