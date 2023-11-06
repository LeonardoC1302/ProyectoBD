USE [storage]
GO
/****** Object:  Table [dbo].[addresses]    Script Date: 6/11/2023 14:05:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[addresses](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[street] [varchar](50) NOT NULL,
	[postalCode] [varchar](50) NOT NULL,
	[countryId] [int] NOT NULL,
 CONSTRAINT [PK_addresses] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[affinities]    Script Date: 6/11/2023 14:05:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[affinities](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[productTypeId1] [int] NOT NULL,
	[productTypeId2] [int] NOT NULL,
	[description] [varchar](50) NOT NULL,
 CONSTRAINT [PK__affiniti__D16298329A1F9316] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[countries]    Script Date: 6/11/2023 14:05:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[countries](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[countryName] [varchar](50) NOT NULL,
	[currencyId] [int] NOT NULL,
 CONSTRAINT [PK__countrie__D320769C203D34D6] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[currencies]    Script Date: 6/11/2023 14:05:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[currencies](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[currencyName] [varchar](50) NOT NULL,
	[exchangeRate] [decimal](10, 2) NOT NULL,
 CONSTRAINT [PK_currencies] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[employees]    Script Date: 6/11/2023 14:05:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[employees](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[employeeName] [varchar](50) NOT NULL,
	[warehouseId] [int] NOT NULL,
	[roleId] [int] NOT NULL,
 CONSTRAINT [PK_employees] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[products]    Script Date: 6/11/2023 14:05:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[products](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[productName] [varchar](50) NOT NULL,
	[productTypeId] [int] NOT NULL,
	[warehouseId] [int] NOT NULL,
	[location] [geometry] NULL,
	[stock] [int] NULL,
 CONSTRAINT [PK__products__2D10D16AE0CDFBF8] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[productTypes]    Script Date: 6/11/2023 14:05:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[productTypes](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[productTypeName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_productTypes] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[roles]    Script Date: 6/11/2023 14:05:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[roles](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[roleName] [varchar](50) NOT NULL,
	[salary] [decimal](10, 2) NOT NULL,
 CONSTRAINT [PK_roles] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[warehouses]    Script Date: 6/11/2023 14:05:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[warehouses](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[warehouseName] [varchar](50) NOT NULL,
	[addressId] [int] NOT NULL,
 CONSTRAINT [PK__warehous__102CD5F7271F1C63] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[addresses]  WITH CHECK ADD  CONSTRAINT [FK_addresses_countries] FOREIGN KEY([countryId])
REFERENCES [dbo].[countries] ([id])
GO
ALTER TABLE [dbo].[addresses] CHECK CONSTRAINT [FK_addresses_countries]
GO
ALTER TABLE [dbo].[affinities]  WITH CHECK ADD  CONSTRAINT [FK_affinities_productTypes] FOREIGN KEY([productTypeId1])
REFERENCES [dbo].[productTypes] ([id])
GO
ALTER TABLE [dbo].[affinities] CHECK CONSTRAINT [FK_affinities_productTypes]
GO
ALTER TABLE [dbo].[affinities]  WITH CHECK ADD  CONSTRAINT [FK_affinities_productTypes1] FOREIGN KEY([productTypeId2])
REFERENCES [dbo].[productTypes] ([id])
GO
ALTER TABLE [dbo].[affinities] CHECK CONSTRAINT [FK_affinities_productTypes1]
GO
ALTER TABLE [dbo].[countries]  WITH CHECK ADD  CONSTRAINT [FK_countries_currencies] FOREIGN KEY([currencyId])
REFERENCES [dbo].[currencies] ([id])
GO
ALTER TABLE [dbo].[countries] CHECK CONSTRAINT [FK_countries_currencies]
GO
ALTER TABLE [dbo].[employees]  WITH CHECK ADD  CONSTRAINT [FK_employees_roles] FOREIGN KEY([roleId])
REFERENCES [dbo].[roles] ([id])
GO
ALTER TABLE [dbo].[employees] CHECK CONSTRAINT [FK_employees_roles]
GO
ALTER TABLE [dbo].[employees]  WITH CHECK ADD  CONSTRAINT [FK_employees_warehouses] FOREIGN KEY([warehouseId])
REFERENCES [dbo].[warehouses] ([id])
GO
ALTER TABLE [dbo].[employees] CHECK CONSTRAINT [FK_employees_warehouses]
GO
ALTER TABLE [dbo].[products]  WITH CHECK ADD  CONSTRAINT [FK_products_productTypes] FOREIGN KEY([productTypeId])
REFERENCES [dbo].[productTypes] ([id])
GO
ALTER TABLE [dbo].[products] CHECK CONSTRAINT [FK_products_productTypes]
GO
ALTER TABLE [dbo].[products]  WITH CHECK ADD  CONSTRAINT [FK_products_warehouses] FOREIGN KEY([warehouseId])
REFERENCES [dbo].[warehouses] ([id])
GO
ALTER TABLE [dbo].[products] CHECK CONSTRAINT [FK_products_warehouses]
GO
ALTER TABLE [dbo].[warehouses]  WITH CHECK ADD  CONSTRAINT [FK_warehouses_addresses] FOREIGN KEY([addressId])
REFERENCES [dbo].[addresses] ([id])
GO
ALTER TABLE [dbo].[warehouses] CHECK CONSTRAINT [FK_warehouses_addresses]
GO
