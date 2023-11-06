use storage;

-- Query to obtain workers + their salary converted to their country's currency 
select employees.employeeName, 
    roles.roleName, roles.salary as 'Salary in USD' , 
    currencies.exchangeRate,  
    roles.salary * currencies.exchangeRate as 'Salary Converted', 
    currencies.currencyName 
from employees
    JOIN roles on employees.roleId = roles.id
    JOIN warehouses on employees.warehouseId = warehouses.id
    JOIN addresses on warehouses.addressId = addresses.id
    JOIN countries on addresses.countryId = countries.id
    JOIN currencies on countries.currencyId = currencies.id

-- Inserts for testing 
INSERT INTO currencies (currencyName, exchangeRate)
VALUES ('USD', 1.00), ('GBP', 1.30), ('EUR', 1.20), ('CAD', 0.80), ('AUD', 0.75);

INSERT INTO countries (countryName, currencyId)
VALUES ('United States', 1), ('United Kingdom', 2), ('Germany', 3), ('France', 4), ('Canada', 1);

INSERT INTO addresses (street, postalCode, countryId)
VALUES ('123 Main St', '12345', 1), ('456 Oak Ave', '67890', 2), ('789 Elm St', '13579', 3), ('101 Pine St', '24680', 4), ('202 Maple Ave', '97531', 1);

INSERT INTO warehouses (warehouseName, addressId)
VALUES ('Warehouse USA', 1), ('Warehouse UK', 2), ('Warehouse GER', 3), ('Warehouse FRA', 4), ('Warehouse CAN', 5);

INSERT INTO roles (roleName, salary)
VALUES ('Manager', 50000.00), ('Supervisor', 40000.00), ('Salesperson', 30000.00), ('Clerk', 25000.00), ('Driver', 28000.00);

INSERT INTO employees (employeeName, warehouseId, roleId)
VALUES ('John Doe', 1, 1), ('Alice Smith', 2, 2), ('Bob Johnson', 3, 3), ('Eva Brown', 4, 4), ('Mike Davis', 5, 5);

INSERT INTO productTypes (productTypeName)
VALUES ('Electronics'), ('Clothing'), ('Furniture'), ('Appliances'), ('Books');

INSERT INTO products (productName, productTypeId, warehouseId, location, stock)
VALUES ('Laptop', 1, 1, NULL, 100), ('T-shirt', 2, 2, NULL, 500), ('Sofa', 3, 3, NULL, 50), ('Refrigerator', 4, 4, NULL, 30), ('Book', 5, 5, NULL, 200);

INSERT INTO affinities (productTypeId1, productTypeId2, description)
VALUES (1, 2, 'Electronics and Clothing'), (3, 4, 'Furniture and Appliances'), (2, 5, 'Clothing and Books'), (1, 3, 'Electronics and Furniture'), (4, 5, 'Appliances and Books');
