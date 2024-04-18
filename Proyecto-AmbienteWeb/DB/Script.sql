set serveroutput on;
--SECUENCIAS 
------------------------------------------------------------------------------
CREATE SEQUENCE SEQ_Productos
START WITH 1
INCREMENT BY 1
NOCYCLE;

CREATE SEQUENCE SEQ_Usuarios
START WITH 1
INCREMENT BY 1
NOCYCLE;

CREATE SEQUENCE SEQ_Facturas
START WITH 1
INCREMENT BY 1
NOCYCLE;
-------------------------------------------------------------------------------


--CREACION DE PAQUETE
CREATE OR REPLACE PACKAGE PROYECTO_L AS

/*ELIMINAR PRODUCTO*/ PROCEDURE eliminar_producto(p_idProducto IN NUMBER);
/*INSERTAR PRODUCTO*/ PROCEDURE insertar_producto(p_nombre IN VARCHAR2, p_descripcion IN CLOB, p_imagen IN VARCHAR2, p_precio IN NUMBER);
/*CALCULAR PRECIO CON DESCUENTO*/ PROCEDURE calcular_precio_con_descuento(p_idFactura IN NUMBER, p_idCliente NUMBER, p_idProducto IN NUMBER, p_cantidad IN NUMBER, p_fechaFactura IN DATE);
/*INSERTAR FACTURA*/ PROCEDURE insertar_factura(p_idFactura IN NUMBER, p_idCliente NUMBER, p_idProducto IN NUMBER, p_cantidad IN NUMBER, p_fechaFactura IN DATE);
/*INSERTAR USUARIO*/ PROCEDURE insertar_usuario(p_nombre IN VARCHAR2, p_correo IN VARCHAR2, p_direccion IN VARCHAR2, p_password IN VARCHAR2, p_telefono IN VARCHAR2);
-------------------------------------------------------------------------------


--PACKAGE BODY-----AL FINALIZAR TODOS LAS SENTENCIAS

--PROCEDIMIENTOS
-------------------------------------------------------------------------------

--ELIMINAR PRODUCTO
CREATE OR REPLACE PROCEDURE eliminar_producto(p_idProducto IN NUMBER)
IS
BEGIN
    DELETE FROM productos
    WHERE idProducto = p_idProducto;

    DBMS_OUTPUT.PUT_LINE('Producto eliminado correctamente.');
EXCEPTION
    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('No se encontró un producto con ese ID.');
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Ocurrio un error al intentar eliminar el producto.');
END eliminar_producto;


--INSERTAR PRODUCTO
CREATE OR REPLACE PROCEDURE insertar_producto(p_nombre IN VARCHAR2, p_descripcion IN CLOB,
    p_imagen IN VARCHAR2, p_precio IN NUMBER)
IS
BEGIN
    INSERT INTO productos (idProducto, nombre, descripcion, imagen, precio) 
    VALUES (SEQ_Productos.NEXTVAL, p_nombre, p_descripcion, p_imagen, p_precio);
    DBMS_OUTPUT.PUT_LINE('Producto insertado correctamente.');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar el producto.');
END insertar_producto;


--CALCULAR PRECIO CON DESCUENTO
CREATE OR REPLACE PROCEDURE calcular_precio_con_descuento(p_idFactura IN NUMBER,
   p_idCliente NUMBER, p_idProducto IN NUMBER, p_cantidad IN NUMBER, p_fechaFactura IN DATE)
IS
    v_precioProducto NUMBER;
    v_porcentajeDescuento NUMBER;
    v_precioConDescuento NUMBER;
BEGIN
    SELECT precio INTO v_precioProducto
    FROM productos
    WHERE idProducto = p_idProducto;

    SELECT porcentajeDescuento INTO v_porcentajeDescuento
    FROM descuentos
    WHERE idProducto = p_idProducto AND p_fechaFactura BETWEEN fechaInicio AND fechaFin;
    IF v_porcentajeDescuento IS NOT NULL THEN
        v_precioConDescuento := v_precioProducto - (v_precioProducto * (v_porcentajeDescuento / 100));
    ELSE
        v_precioConDescuento := v_precioProducto;
    END IF;
    INSERT INTO facturas (idFactura,factura_idCliente, factura_idProducto, fecha, precioTotal)
    VALUES (p_idFactura, p_idCliente, p_idProducto, p_fechaFactura, v_precioConDescuento * p_cantidad);
    DBMS_OUTPUT.PUT_LINE('Factura insertada correctamente con precio total calculado.');
EXCEPTION WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('No se encontró informacion de descuento para el producto en la fecha de la factura.');
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar la factura con precio total calculado.');
END calcular_precio_con_descuento;


--INSERTAR FACTURA
CREATE OR REPLACE PROCEDURE insertar_factura(p_idFactura IN NUMBER, p_idCliente NUMBER,
p_idProducto IN NUMBER, p_cantidad IN NUMBER, p_fechaFactura IN DATE)
IS
    v_precioProducto NUMBER;
    v_porcentajeDescuento NUMBER;
BEGIN
    SELECT precio INTO v_precioProducto
    FROM productos
    WHERE idProducto = p_idProducto;

    SELECT porcentajeDescuento INTO v_porcentajeDescuento
    FROM descuentos
    WHERE idProducto = p_idProducto AND p_fechaFactura BETWEEN fechaInicio AND fechaFin;

    IF v_porcentajeDescuento IS NOT NULL THEN
        calcular_precio_con_descuento(p_idFactura, p_idCliente, p_idProducto, p_cantidad, p_fechaFactura);
    ELSE
        INSERT INTO facturas (idFactura, factura_idCliente, factura_idProducto, fecha, precioTotal)
        VALUES (p_idFactura, p_idCliente, p_idProducto, p_fechaFactura, v_precioProducto * p_cantidad);
        DBMS_OUTPUT.PUT_LINE('Factura insertada correctamente sin descuento.');
    END IF;
EXCEPTION WHEN NO_DATA_FOUND THEN
    DBMS_OUTPUT.PUT_LINE('No se encontró informacion de descuento para el producto en la fecha de la factura.');
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar la factura.');
END insertar_factura;


--INSERTAR USUARIO
CREATE OR REPLACE PROCEDURE insertar_usuario(p_nombre IN VARCHAR2, p_correo IN VARCHAR2,
    p_direccion IN VARCHAR2, p_password IN VARCHAR2, p_telefono IN VARCHAR2)
IS
BEGIN
    INSERT INTO usuarios (idUsuario, nombre, correo, direccion, password, telefono
    ) VALUES (SEQ_Usuarios.NEXTVAL, p_nombre, p_correo,p_direccion, p_password, p_telefono);
    DBMS_OUTPUT.PUT_LINE('Usuario insertado correctamente.');
EXCEPTION
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error al insertar el usuario.');
END insertar_usuario;

-----------------------------------------------------------------------------





--FUNCIONES
-----------------------------------------------------------------------------------




-----------------------------------------------------------------------------------




--INSERTS
------------------------------------------------------------------------------------
--10 productos de ejemplo

--1
BEGIN
    insertar_producto('Hamburguesa Clásica',
    'Carne de res a la parrilla, queso cheddar fundido, pan suave y esponjoso ligeramente tostado, cebolla, tomate, lechuga y una salsa especial de la casa. Acompañamiento papas.',
    'https://assets.unileversolutions.com/recipes-v2/218401.jpg',
    8500);
END;

--2
BEGIN
    insertar_producto('Hamburguesa de Pollo',
    'Pechuga de pollo marinada en una mezcla de especias y hierbas a la parrilla, pan integral tostado, lechuga, tomate fresco y una mayonesa con sabor a chipotle. Acompañamiento papas.',
    'https://img.freepik.com/fotos-premium/hamburguesa-pollo-sabroso-fresco-papas-fritas-sobre-fondo-oscuro_222237-360.jpg',
    7800);
END;

--3
BEGIN
    insertar_producto('Hamburguesa Vegana',
    'Mezcla de garbanzos, remolacha y avena, con una combinación de especias a la parrilla, pan integral con lechuga, tomate, pepinillos y una salsa de aguacate cremosa. Acompañamiento papas.',
    'https://i.pinimg.com/originals/56/a5/4e/56a54ee5ae99054fb2b9443c014ddc1b.jpg',
    6500);
END;

--4
BEGIN
    insertar_producto('Hamburguesa BBQ',
        'Carne de res a la parrilla y se agrega una salsa BBQ dulce y ahumada encima, panecillo de brioche tostado con aros de cebolla frita, tocino crujiente y una rebanada de queso cheddar derretido. 
Acompañamiento papas.','https://dedoslasamericas.com/wp-content/uploads/2021/04/Flame-grilled-BBQ-bacon-burger.jpg',
        8000);
END;

--5
BEGIN
    insertar_producto('Hamburguesa Mexicana',
        'Carne de res sazonada con una mezcla de especias mexicanas a la parrilla, pan de maíz tostado con guacamole fresco, jalapeños en escabeche, queso fresco y una salsa picante.
Acompañamiento papas.','https://cocinamexicana.club/wp-content/uploads/2021/08/hamburguesa-de-carne-de-res-001.jpg',
        6700);
END;

--6
BEGIN
    insertar_producto('Hamburguesa de Salmón',
        'Filetes de salmón fresco, con pan rallado, huevo y condimentos a la parrilla, pan de hamburguesa tostado con aguacate, pepino, cebolla roja y mayonesa de eneldo.
Acompañamiento papas.','https://placeralplato.com/files/2019/06/Hamburguesa-de-salmn-con-mayonesa-de-albahaca-y-lima.jpg',
        9000);
END;

--7
BEGIN
    insertar_producto('Super Promo Doble Hamburguesa Clasica',
        'Carne de res a la parrilla, queso cheddar fundido, pan suave y esponjoso ligeramente tostado, cebolla, tomate, lechuga y una salsa especial de la casa. x2!',
        'https://static.vecteezy.com/system/resources/previews/026/794/680/large_2x/double-hamburger-isolated-on-white-background-fresh-burger-fast-food-with-beef-and-cream-cheese-realistic-image-ultra-hd-high-design-very-detailed-free-photo.jpg',
        4900);
END;

--8
BEGIN
    insertar_producto('Promo 3 Mini Hamburguesas Queso',
        'Carne de res a la parrilla, queso fundido, pan suave y esponjoso ligeramente tostado y lechuga',
        'https://img.freepik.com/premium-photo/hearty-appetizing-hamburgers-cooked-fire-backyard-grill_124507-103443.jpg', 
        4860);
END;

--9
BEGIN
    insertar_producto( 'Promo 2x1 en Hamburguesa Ibérica',
        'Hamburguesa de Cerdo en pan brioche, con jamón, tomate y lechuga, queso gouda y salsa de queso azul',
        'https://www.sierradecodex.com/wp-content/uploads/2021/07/rustic-hamburger-.jpg', 
        4790);
END;

--10
BEGIN
    insertar_producto('Promo 35% de descuento en la Tex Mex Burger',
        'Hamburguesa de ternera en pan rústico, con jalapeños, tomate y aguacate, queso cheddar y salsa Jack Daniels',
        'https://www.thespruceeats.com/thmb/tdJhJ3axW6-Qhi8SOkDRcNIrSFk=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/the-taco-seasoned-burger-896375500-6a89d71a818f4adcb36fd8a909116780.jpg', 
        4560);
END;

--------------------------------------------------------------------------------------------------------