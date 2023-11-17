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
VALUES ('Equipment'), ('Chemicals'), ('Consumables'), ('Bundles'), ('Books');

INSERT [dbo].[products] ([id], [productName], [productTypeId], [warehouseId], [location], [stock], [price], [image], [description]) VALUES (1, N'Bunsen Burner', 1, 3, 0x00000000010C00000000000024400000000000003440, 10, CAST(500.00 AS Decimal(10, 2)), N'c5f1669d47fb4a4e736bcd75b0faef56.jpg', N'The Bunsen burner is a versatile gas burner designed for precision and efficiency in laboratory settings. Comprising a vertical metal tube connected to a gas source, it features an adjustable air intake mechanism and a heat-resistant base.'); 
INSERT [dbo].[products] ([id], [productName], [productTypeId], [warehouseId], [location], [stock], [price], [image], [description]) VALUES (2, N'Sulfuric Acid', 2, 1, 0x00000000010C00000000000024400000000000003440, 15, CAST(100.00 AS Decimal(10, 2)), N'8953e3ea9f6c93d9a3ce9b51ed42abfe.jpg', N'Dangerous Acid'); 
INSERT [dbo].[products] ([id], [productName], [productTypeId], [warehouseId], [location], [stock], [price], [image], [description]) VALUES (3, N'Ammonia', 2, 2, 0x00000000010C00000000000024400000000000003440, 20, CAST(150.00 AS Decimal(10, 2)), N'd63cb1c7b91cfd48ac4172d151f875e9.jpg', N'Chemical');
INSERT [dbo].[products] ([id], [productName], [productTypeId], [warehouseId], [location], [stock], [price], [image], [description]) VALUES (4, N'Erlenmeyer', 1, 2, 0x00000000010C00000000000024400000000000003440, 10, CAST(100.00 AS Decimal(10, 2)), N'f8b3fa34b1437f709d1745026f00f834.jpg', N'Erlenmeyer');
INSERT [dbo].[products] ([id], [productName], [productTypeId], [warehouseId], [location], [stock], [price], [image], [description]) VALUES (5, N'Ethanol', 2, 3, 0x00000000010C00000000000024400000000000003440, 50, CAST(75.00 AS Decimal(10, 2)), N'86a35a7eb40b62910b1e1eaf18449bb5.jpg', N'Ethanol');
INSERT [dbo].[products] ([id], [productName], [productTypeId], [warehouseId], [location], [stock], [price], [image], [description]) VALUES (6, N'Glasses', 1, 1, 0x00000000010C00000000000024400000000000003440, 15, CAST(15.00 AS Decimal(10, 2)), N'beaba524a5c1921e39151897f2ac1690.jpg', N'Glasses');


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