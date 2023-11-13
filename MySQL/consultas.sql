use recursos_humanos;

select * from users;
select * from employee;
select* from rol;
select * from department;
select * from country;

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


delete from department where id > 0;
alter table department AUTO_INCREMENT = 1;
delete from country where id > 0;
alter table country AUTO_INCREMENT = 1;
delete from employee where id > 0;
alter table employee AUTO_INCREMENT = 1;
delete from rol where id > 0;
alter table rol AUTO_INCREMENT = 1;

update employee set hours = 1 where id = 3;
update rol set rol = 'Organizador' where id = 2;

SELECT
	CONCAT(e.name, ' ', e.surname) AS Name,
    d.Name AS Department,
    r.rol as Rol,
    e.hours,
    r.salary,
    c.socialcharge,
    (e.hours * r.salary * (1 - c.socialcharge)) AS CurrentSalary,
    DATE_ADD(e.lastPay, INTERVAL 15 DAY) AS NextPay
FROM
    employee e
JOIN
    rol r ON e.rolId = r.id
JOIN
    department d ON e.countryId = d.id
JOIN
    country c ON e.countryId = c.id
WHERE
    e.name = 'Kevin' AND
    e.surname = 'Chang' AND
    e.rolId = 3;
    
SELECT DATE_ADD(CURDATE(), INTERVAL 15 DAY) AS NextPay;
