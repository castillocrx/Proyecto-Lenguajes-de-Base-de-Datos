CREATE TABLE productos (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    `descripción` TEXT NOT NULL,
    `imagen` VARCHAR(255) NOT NULL,
    `precio` DOUBLE NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB;

CREATE TABLE facturas (
    `idFactura` INT NOT NULL AUTO_INCREMENT,
    `factura_idCliente` INT NOT NULL,
    `factura_idProducto` INT NOT NULL,
    `fecha` DATE NOT NULL,
    `precioTotal` INT NOT NULL,
    PRIMARY KEY (`idFactura`),
    FOREIGN KEY (`factura_idCliente`) REFERENCES clientes(`idCliente`),
    FOREIGN KEY (`factura_idProducto`) REFERENCES productos(`id`)
) ENGINE = InnoDB;

CREATE TABLE clientes (
    idCliente NUMBER GENERATED BY DEFAULT ON NULL AS IDENTITY,
    nombre VARCHAR2(50) NOT NULL,
    correo VARCHAR2(50) NOT NULL,
    direccion VARCHAR2(50) NOT NULL,
    password VARCHAR2(255) NOT NULL,
    telefono VARCHAR2(50) NOT NULL,
    CONSTRAINT pk_clientes PRIMARY KEY (idCliente)
);