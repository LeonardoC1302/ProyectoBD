USE
    [master] GO
    /****** Object:  Database [storage]    Script Date: 16/11/2023 21:26:45 ******/
CREATE DATABASE
    [storage] CONTAINMENT = NONE ON PRIMARY (
        NAME = N 'storage',
        FILENAME = N 'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLSERVER\MSSQL\DATA\storage.mdf',
        SIZE = 8192 KB,
        MAXSIZE = UNLIMITED,
        FILEGROWTH = 65536 KB
    ) LOG ON (
        NAME = N 'storage_log',
        FILENAME = N 'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLSERVER\MSSQL\DATA\storage_log.ldf',
        SIZE = 8192 KB,
        MAXSIZE = 2048 GB,
        FILEGROWTH = 65536 KB
    )
WITH
    CATALOG_COLLATION = DATABASE_DEFAULT,
    LEDGER = OFF GO
ALTER DATABASE [storage]
SET
    COMPATIBILITY_LEVEL = 160 GO IF (
        1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled')
    ) begin EXEC [storage].[dbo].[sp_fulltext_database] @action = 'enable'
end GO
ALTER DATABASE [storage]
SET ANSI_NULL_DEFAULT OFF GO
ALTER DATABASE [storage]
SET ANSI_NULLS OFF GO
ALTER DATABASE [storage]
SET ANSI_PADDING OFF GO
ALTER DATABASE [storage]
SET ANSI_WARNINGS OFF GO
ALTER DATABASE [storage]
SET ARITHABORT OFF GO
ALTER DATABASE [storage]
SET AUTO_CLOSE OFF GO
ALTER DATABASE [storage]
SET AUTO_SHRINK OFF GO
ALTER DATABASE [storage]
SET
    AUTO_UPDATE_STATISTICS ON GO
ALTER DATABASE [storage]
SET
    CURSOR_CLOSE_ON_COMMIT OFF GO
ALTER DATABASE [storage]
SET CURSOR_DEFAULT GLOBAL GO
ALTER DATABASE [storage]
SET
    CONCAT_NULL_YIELDS_NULL OFF GO
ALTER DATABASE [storage]
SET NUMERIC_ROUNDABORT OFF GO
ALTER DATABASE [storage]
SET QUOTED_IDENTIFIER OFF GO
ALTER DATABASE [storage]
SET RECURSIVE_TRIGGERS OFF GO
ALTER DATABASE [storage]
SET DISABLE_BROKER GO
ALTER DATABASE [storage]
SET
    AUTO_UPDATE_STATISTICS_ASYNC OFF GO
ALTER DATABASE [storage]
SET
    DATE_CORRELATION_OPTIMIZATION OFF GO
ALTER DATABASE [storage]
SET TRUSTWORTHY OFF GO
ALTER DATABASE [storage]
SET
    ALLOW_SNAPSHOT_ISOLATION OFF GO
ALTER DATABASE [storage]
SET PARAMETERIZATION SIMPLE GO
ALTER DATABASE [storage]
SET
    READ_COMMITTED_SNAPSHOT OFF GO
ALTER DATABASE [storage]
SET
    HONOR_BROKER_PRIORITY OFF GO
ALTER DATABASE [storage]
SET RECOVERY FULL GO
ALTER DATABASE [storage]
SET MULTI_USER GO
ALTER DATABASE [storage]
SET PAGE_VERIFY CHECKSUM GO
ALTER DATABASE [storage]
SET DB_CHAINING OFF GO
ALTER DATABASE [storage]
SET
    FILESTREAM(NON_TRANSACTED_ACCESS = OFF) GO
ALTER DATABASE [storage]
SET
    TARGET_RECOVERY_TIME = 60 SECONDS GO
ALTER DATABASE [storage]
SET
    DELAYED_DURABILITY = DISABLED GO
ALTER DATABASE [storage]
SET
    ACCELERATED_DATABASE_RECOVERY = OFF GO EXEC sys.sp_db_vardecimal_storage_format N 'storage',
    N 'ON' GO
ALTER DATABASE [storage]
SET QUERY_STORE = ON GO
ALTER DATABASE [storage]
SET
    QUERY_STORE (
        OPERATION_MODE = READ_WRITE,
        CLEANUP_POLICY = (
            STALE_QUERY_THRESHOLD_DAYS = 30
        ),
        DATA_FLUSH_INTERVAL_SECONDS = 900,
        INTERVAL_LENGTH_MINUTES = 60,
        MAX_STORAGE_SIZE_MB = 1000,
        QUERY_CAPTURE_MODE = AUTO,
        SIZE_BASED_CLEANUP_MODE = AUTO,
        MAX_PLANS_PER_QUERY = 200,
        WAIT_STATS_CAPTURE_MODE = ON
    ) GO
USE
    [storage] GO
    /****** Object:  Table [dbo].[addresses]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[addresses] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [street] [varchar] (50) NOT NULL,
        [postalCode] [varchar] (50) NOT NULL,
        [countryId] [int] NOT NULL,
        CONSTRAINT [PK_addresses] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[affinities]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[affinities] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [productTypeId1] [int] NOT NULL,
        [productTypeId2] [int] NOT NULL,
        [description] [varchar] (50) NOT NULL,
        CONSTRAINT [PK__affiniti__D16298329A1F9316] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[carts]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[carts] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [userId] [int] NOT NULL,
        CONSTRAINT [PK_carts] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[countries]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[countries] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [countryName] [varchar] (50) NOT NULL,
        [currencyId] [int] NOT NULL,
        CONSTRAINT [PK__countrie__D320769C203D34D6] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[currencies]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[currencies] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [currencyName] [varchar] (50) NOT NULL,
        [exchangeRate] [decimal] (10, 2) NOT NULL,
        CONSTRAINT [PK_currencies] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[employees]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[employees] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [employeeName] [varchar] (50) NOT NULL,
        [warehouseId] [int] NOT NULL,
        [roleId] [int] NOT NULL,
        CONSTRAINT [PK_employees] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[payments]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[payments] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [CardNumber] [varchar] (16) NOT NULL,
        [ExpiryDate] [varchar] (10) NOT NULL,
        [CVC] [varchar] (5) NOT NULL,
        [email] [varchar] (90) NOT NULL,
        [country] [varchar] (10) NOT NULL,
        [address] [varchar] (90) NOT NULL,
        CONSTRAINT [PK__CardInfo__3213E83FA31E38FB] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[products]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[products] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [productName] [varchar] (50) NOT NULL,
        [productTypeId] [int] NOT NULL,
        [warehouseId] [int] NOT NULL,
        [location] [geometry] NULL,
        [stock] [int] NOT NULL,
        [price] [decimal] (10, 2) NOT NULL,
        [image] [varchar] (255) NOT NULL,
        [description] [varchar] (255) NULL,
        CONSTRAINT [PK__products__2D10D16AE0CDFBF8] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY] GO
    /****** Object:  Table [dbo].[productsXCart]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[productsXCart] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [cartId] [int] NOT NULL,
        [productId] [int] NOT NULL,
        [quantity] [int] NOT NULL,
        [price] [decimal] (10, 2) NOT NULL,
        CONSTRAINT [PK_productsXCart] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[productTypes]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[productTypes] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [productTypeName] [varchar] (50) NOT NULL,
        CONSTRAINT [PK_productTypes] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[productXsales]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[productXsales] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [saleId] [int] NOT NULL,
        [productId] [int] NOT NULL,
        [quantity] [int] NOT NULL,
        [total] [decimal] (10, 2) NOT NULL,
        CONSTRAINT [PK_productXsales] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[roles]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[roles] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [roleName] [varchar] (50) NOT NULL,
        [salary] [decimal] (10, 2) NOT NULL,
        CONSTRAINT [PK_roles] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[sales]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[sales] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [userId] [int] NOT NULL,
        [saleDate] [datetime] NOT NULL,
        [total] [decimal] (10, 2) NOT NULL,
        [paymentId] [int] NOT NULL,
        CONSTRAINT [PK_sales] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
    /****** Object:  Table [dbo].[users]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[users] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [name] [varchar] (60) NOT NULL,
        [surname] [varchar] (60) NOT NULL,
        [email] [varchar] (90) NOT NULL,
        [password] [varchar] (60) NOT NULL,
        [phone] [varchar] (10) NOT NULL,
        [admin] [tinyint] NOT NULL,
        [verified] [tinyint] NOT NULL,
        [token] [varchar] (15) NOT NULL,
        [location] [geometry] NOT NULL,
        CONSTRAINT [PK_users] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY] GO
    /****** Object:  Table [dbo].[warehouses]    Script Date: 16/11/2023 21:26:46 ******/
SET ANSI_NULLS ON GO
SET QUOTED_IDENTIFIER ON GO
CREATE TABLE
    [dbo].[warehouses] (
        [id] [int] IDENTITY(1, 1) NOT NULL,
        [warehouseName] [varchar] (50) NOT NULL,
        [addressId] [int] NOT NULL,
        CONSTRAINT [PK__warehous__102CD5F7271F1C63] PRIMARY KEY CLUSTERED ([id] ASC)
        WITH (
                PAD_INDEX = OFF,
                STATISTICS_NORECOMPUTE = OFF,
                IGNORE_DUP_KEY = OFF,
                ALLOW_ROW_LOCKS = ON,
                ALLOW_PAGE_LOCKS = ON,
                OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF
            ) ON [PRIMARY]
    ) ON [PRIMARY] GO
ALTER TABLE [dbo].[addresses]
WITH CHECK
ADD
    CONSTRAINT [FK_addresses_countries] FOREIGN KEY([countryId]) REFERENCES [dbo].[countries] ([id]) GO
ALTER TABLE
    [dbo].[addresses] CHECK CONSTRAINT [FK_addresses_countries] GO
ALTER TABLE
    [dbo].[affinities]
WITH CHECK
ADD
    CONSTRAINT [FK_affinities_productTypes] FOREIGN KEY([productTypeId1]) REFERENCES [dbo].[productTypes] ([id]) GO
ALTER TABLE
    [dbo].[affinities] CHECK CONSTRAINT [FK_affinities_productTypes] GO
ALTER TABLE
    [dbo].[affinities]
WITH CHECK
ADD
    CONSTRAINT [FK_affinities_productTypes1] FOREIGN KEY([productTypeId2]) REFERENCES [dbo].[productTypes] ([id]) GO
ALTER TABLE
    [dbo].[affinities] CHECK CONSTRAINT [FK_affinities_productTypes1] GO
ALTER TABLE [dbo].[carts]
WITH CHECK
ADD
    CONSTRAINT [FK_carts_users] FOREIGN KEY([userId]) REFERENCES [dbo].[users] ([id]) GO
ALTER TABLE
    [dbo].[carts] CHECK CONSTRAINT [FK_carts_users] GO
ALTER TABLE [dbo].[countries]
WITH CHECK
ADD
    CONSTRAINT [FK_countries_currencies] FOREIGN KEY([currencyId]) REFERENCES [dbo].[currencies] ([id]) GO
ALTER TABLE
    [dbo].[countries] CHECK CONSTRAINT [FK_countries_currencies] GO
ALTER TABLE [dbo].[employees]
WITH CHECK
ADD
    CONSTRAINT [FK_employees_roles] FOREIGN KEY([roleId]) REFERENCES [dbo].[roles] ([id]) GO
ALTER TABLE
    [dbo].[employees] CHECK CONSTRAINT [FK_employees_roles] GO
ALTER TABLE [dbo].[employees]
WITH CHECK
ADD
    CONSTRAINT [FK_employees_warehouses] FOREIGN KEY([warehouseId]) REFERENCES [dbo].[warehouses] ([id]) GO
ALTER TABLE
    [dbo].[employees] CHECK CONSTRAINT [FK_employees_warehouses] GO
ALTER TABLE [dbo].[products]
WITH CHECK
ADD
    CONSTRAINT [FK_products_productTypes] FOREIGN KEY([productTypeId]) REFERENCES [dbo].[productTypes] ([id]) GO
ALTER TABLE
    [dbo].[products] CHECK CONSTRAINT [FK_products_productTypes] GO
ALTER TABLE [dbo].[products]
WITH CHECK
ADD
    CONSTRAINT [FK_products_warehouses] FOREIGN KEY([warehouseId]) REFERENCES [dbo].[warehouses] ([id]) GO
ALTER TABLE
    [dbo].[products] CHECK CONSTRAINT [FK_products_warehouses] GO
ALTER TABLE
    [dbo].[productsXCart]
WITH CHECK
ADD
    CONSTRAINT [FK_productsXCart_carts] FOREIGN KEY([cartId]) REFERENCES [dbo].[carts] ([id]) GO
ALTER TABLE
    [dbo].[productsXCart] CHECK CONSTRAINT [FK_productsXCart_carts] GO
ALTER TABLE
    [dbo].[productsXCart]
WITH CHECK
ADD
    CONSTRAINT [FK_productsXCart_products] FOREIGN KEY([productId]) REFERENCES [dbo].[products] ([id]) GO
ALTER TABLE
    [dbo].[productsXCart] CHECK CONSTRAINT [FK_productsXCart_products] GO
ALTER TABLE
    [dbo].[productXsales]
WITH CHECK
ADD
    CONSTRAINT [FK_productXsales_products] FOREIGN KEY([productId]) REFERENCES [dbo].[products] ([id]) GO
ALTER TABLE
    [dbo].[productXsales] CHECK CONSTRAINT [FK_productXsales_products] GO
ALTER TABLE
    [dbo].[productXsales]
WITH CHECK
ADD
    CONSTRAINT [FK_productXsales_sales] FOREIGN KEY([saleId]) REFERENCES [dbo].[sales] ([id]) GO
ALTER TABLE
    [dbo].[productXsales] CHECK CONSTRAINT [FK_productXsales_sales] GO
ALTER TABLE [dbo].[sales]
WITH CHECK
ADD
    CONSTRAINT [FK_sales_payments] FOREIGN KEY([paymentId]) REFERENCES [dbo].[payments] ([id]) GO
ALTER TABLE
    [dbo].[sales] CHECK CONSTRAINT [FK_sales_payments] GO
ALTER TABLE [dbo].[sales]
WITH CHECK
ADD
    CONSTRAINT [FK_sales_users] FOREIGN KEY([userId]) REFERENCES [dbo].[users] ([id]) GO
ALTER TABLE
    [dbo].[sales] CHECK CONSTRAINT [FK_sales_users] GO
ALTER TABLE
    [dbo].[warehouses]
WITH CHECK
ADD
    CONSTRAINT [FK_warehouses_addresses] FOREIGN KEY([addressId]) REFERENCES [dbo].[addresses] ([id]) GO
ALTER TABLE
    [dbo].[warehouses] CHECK CONSTRAINT [FK_warehouses_addresses] GO
USE [master] GO
ALTER DATABASE [storage]
SET READ_WRITE GO