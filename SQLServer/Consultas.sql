INSERT INTO
    currencies (currencyName, exchangeRate)
VALUES ('USD', 1.00), ('COP', 4038.87), ('JMD', 155.91), ('CAD', 0.80), ('AUD', 0.75);

INSERT INTO
    countries (countryName, currencyId)
VALUES ('United States', 1), ('Colombia ', 2), ('Jamaica', 3), ('France', 4), ('Canada', 1);

INSERT INTO
    addresses (street, postalCode, countryId)
VALUES ('123 Main St', '12345', 1), ('456 Oak Ave', '67890', 2), ('789 Elm St', '13579', 3), ('101 Pine St', '24680', 4), ('202 Maple Ave', '97531', 1);

INSERT INTO
    warehouses (warehouseName, addressId)
VALUES ('North America', 1), ('South America', 2), ('Caribian Islands', 3);

INSERT INTO
    roles (roleName, salary)
VALUES ('Manager', 50000.00), ('Supervisor', 40000.00), ('Salesperson', 30000.00), ('Clerk', 25000.00), ('Driver', 28000.00);

INSERT INTO
    employees (
        employeeName,
        warehouseId,
        roleId
    )
VALUES ('John Doe', 1, 1), ('Alice Smith', 2, 2), ('Bob Johnson', 3, 3), ('Eva Brown', 1, 4), ('Mike Davis', 2, 5);

INSERT INTO
    productTypes (productTypeName)
VALUES ('Electronics'), ('Clothing'), ('Furniture'), ('Appliances'), ('Books');

INSERT INTO
    products (
        productName,
        productTypeId,
        warehouseId,
        location,
        stock,
        price,
        image,
        description
    )
VALUES (
        'Laptop',
        1,
        1,
        NULL,
        100,
        999.99,
        'laptop_image.jpg',
        'High-performance laptop with advanced features.'
    ), (
        'T-shirt',
        2,
        2,
        NULL,
        500,
        19.99,
        'tshirt_image.jpg',
        'Comfortable cotton t-shirt in various colors.'
    ), (
        'Sofa',
        3,
        3,
        NULL,
        50,
        599.99,
        'sofa_image.jpg',
        'Stylish and comfortable sofa for your living room.'
    ), (
        'Refrigerator',
        4,
        1,
        NULL,
        30,
        799.99,
        'fridge_image.jpg',
        'Energy-efficient refrigerator with spacious compartments.'
    ), (
        'Book',
        5,
        2,
        NULL,
        200,
        9.99,
        'book_image.jpg',
        'Best-selling novel by a renowned author.'
    );

INSERT INTO
    affinities (
        productTypeId1,
        productTypeId2,
        description
    )
VALUES (
        1,
        2,
        'Electronics and Clothing'
    ), (
        3,
        4,
        'Furniture and Appliances'
    ), (2, 5, 'Clothing and Books'), (
        1,
        3,
        'Electronics and Furniture'
    ), (4, 5, 'Appliances and Books');