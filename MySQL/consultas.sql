use recursos_humanos;

select * from users;
select * from employee;
select* from rol;
select * from department;
select * from country;

INSERT INTO department (name) 
VALUES
('Recursos Humanos');

INSERT INTO rol (rol, description, salary, departmentId) 
VALUES
('Jefe', 'Supervisa a todos lo trabajadores, responsable de recibir correo ejecutivos', 1000000.0, 1),
('Contabilidad', 'Se encarga de manejar ingresos y gastos', 550000.0, 1);

INSERT INTO country (name) 
VALUES
('Costa Rica');

INSERT INTO employee (name, surname, email, phone, hours, pay, lastPay, rolId, countryId)
VALUES 
('Juanito', 'Alcachofa', 'Juan@gamail.com', '88888888', 17, 0, '2023-11-01', 1, 1),
('Kevin', 'Chang', 'Kevin@gamail.com', '88888887', 112, 0, '2023-10-11', 1, 1);

delete from country where id = 2;
alter table country AUTO_INCREMENT = 2;

update employee set lastPay = '23-10-25' where id = 4;
update department set name = 'Ventas' where id = 2;