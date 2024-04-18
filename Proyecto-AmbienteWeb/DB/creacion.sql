CREATE TABLE usuarios (
    idUsuario NUMBER NOT NULL,
    nombre VARCHAR2(50) NOT NULL,
    correo VARCHAR2(50) NOT NULL,
    direccion VARCHAR2(50) NOT NULL,
    password VARCHAR2(255) NOT NULL,
    telefono VARCHAR2(50) NOT NULL,
    CONSTRAINT pk_clientes PRIMARY KEY (idUsuario)
);


CREATE TABLE productos (
    idProducto NUMBER NOT NULL,
    nombre VARCHAR2(100) NOT NULL,
    descripcion CLOB NOT NULL,
    imagen VARCHAR2(500) NOT NULL,
    precio NUMBER(10, 2) NOT NULL, 
    CONSTRAINT pk_productos PRIMARY KEY (idProducto)
);


CREATE TABLE descuentos (
    idDescuento NUMBER NOT NULL,
    idProducto NUMBER,
    porcentajeDescuento NUMBER(5, 2),
    fechaInicio DATE,
    fechaFin DATE,
    CONSTRAINT pk_descuentos PRIMARY KEY (idDescuento),
    CONSTRAINT fk_descuentos_productos FOREIGN KEY (idProducto) REFERENCES productos(idProducto)
);


CREATE TABLE facturas (
    idFactura NUMBER NOT NULL,
    factura_idUsuario NUMBER NOT NULL,
    factura_idProducto NUMBER NOT NULL,
    fecha DATE NOT NULL,
    precioTotal NUMBER NOT NULL,
    CONSTRAINT pk_facturas PRIMARY KEY (idFactura),
    CONSTRAINT fk_facturas_usuarios FOREIGN KEY (factura_idUsuario) REFERENCES usuarios(idUsuario),
    CONSTRAINT fk_facturas_productos FOREIGN KEY (factura_idProducto) REFERENCES productos(idProducto)
);