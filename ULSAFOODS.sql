# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases 13.0.1                     #
# Target DBMS:           MySQL 8                                         #
# Project file:          Project3.dez                                    #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2022-10-22 20:53                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Add tables                                                             #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# Add table "Cliente"                                                    #
# ---------------------------------------------------------------------- #



CREATE TABLE `Cliente` (
    `ID_cliente` INTEGER NOT NULL AUTO_INCREMENT,
    `Nombre_cliente` VARCHAR(30) NOT NULL,
    `Apepat_cliente` VARCHAR(30) NOT NULL,
    `Apemat_cliente` VARCHAR(30) NOT NULL,
    `Edificio` CHAR(1) NOT NULL,
    `Salon` VARCHAR(3) NOT NULL,
    `Carrera` VARCHAR(10),
    CONSTRAINT `PK_Cliente` PRIMARY KEY (`ID_cliente`)
);



# ---------------------------------------------------------------------- #
# Add table "Empleado"                                                   #
# ---------------------------------------------------------------------- #



CREATE TABLE `Empleado` (
    `ID_Empleado` INTEGER NOT NULL AUTO_INCREMENT,
    `Nombre_empleado` VARCHAR(50) NOT NULL,
    CONSTRAINT `PK_Empleado` PRIMARY KEY (`ID_Empleado`)
);



# ---------------------------------------------------------------------- #
# Add table "Venta"                                                      #
# ---------------------------------------------------------------------- #



CREATE TABLE `Venta` (
    `ID_Venta` INTEGER NOT NULL AUTO_INCREMENT,
    `Fecha` DATE NOT NULL,
    `Sucursal` VARCHAR(20) NOT NULL,
    `ID_cliente` INTEGER NOT NULL,
    `ID_Empleado` INTEGER,
    CONSTRAINT `PK_Venta` PRIMARY KEY (`ID_Venta`, `ID_cliente`)
);



# ---------------------------------------------------------------------- #
# Add table "Producto"                                                   #
# ---------------------------------------------------------------------- #



CREATE TABLE `Producto` (
    `ID_Producto` INTEGER NOT NULL AUTO_INCREMENT,
    `Nombre_Producto` VARCHAR(20) NOT NULL,
    `Precio_Producto` FLOAT NOT NULL,
    `Stock_Producto` INTEGER NOT NULL,
    CONSTRAINT `PK_Producto` PRIMARY KEY (`ID_Producto`)
);



# ---------------------------------------------------------------------- #
# Add table "Venta_Producto"                                             #
# ---------------------------------------------------------------------- #



CREATE TABLE `Venta_Producto` (
    `ID_Venta` INTEGER NOT NULL,
    `ID_Producto` INTEGER NOT NULL,
    `Monto_final` FLOAT NOT NULL,
    `Cantidad` INTEGER NOT NULL,
    `Total_producto` FLOAT NOT NULL,
    CONSTRAINT `PK_Venta_Producto` PRIMARY KEY (`ID_Venta`, `ID_Producto`)
);



# ---------------------------------------------------------------------- #
# Add foreign key constraints                                            #
# ---------------------------------------------------------------------- #

ALTER TABLE `Venta` ADD CONSTRAINT `Cliente_Venta` 
    FOREIGN KEY (`ID_cliente`) REFERENCES `Cliente` (`ID_cliente`);

ALTER TABLE `Venta` ADD CONSTRAINT `Empleado_Venta` 
    FOREIGN KEY (`ID_Empleado`) REFERENCES `Empleado` (`ID_Empleado`);

ALTER TABLE `Venta_Producto` ADD CONSTRAINT `Venta_Venta_Producto` 
    FOREIGN KEY (`ID_Venta`) REFERENCES `Venta` (`ID_Venta`);

ALTER TABLE `Venta_Producto` ADD CONSTRAINT `Producto_Venta_Producto` 
    FOREIGN KEY (`ID_Producto`) REFERENCES `Producto` (`ID_Producto`);
