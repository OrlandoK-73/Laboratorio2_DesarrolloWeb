SHOW DATABASES;
USE lab2;  

CREATE TABLE Clientes(
    codigo      int primary key auto_increment,
    nombre      nvarchar(150) not null,
    telefono    varchar(10),
    correo      nvarchar(100)
);

CREATE TABLE Producto(
    codigo      int primary key,
    descripcion nvarchar(250) not null,
    observaciones nvarchar(255),
    precio      double not null 
);

CREATE TABLE Factura(
    codigo   int primary key auto_increment,
    cliente  int not null,
    fecha    date,
    monto    double
);

CREATE TABLE Detalle_Factura(
    id          int primary key auto_increment,
    factura     int not null,
    producto    int not null,
    cantidad    int not null,
    subtotal    double not null
);

-- Llaves foráneas
ALTER TABLE Factura ADD CONSTRAINT fk_cliente_factura 
FOREIGN KEY (cliente) REFERENCES Clientes(codigo);

ALTER TABLE Detalle_Factura ADD CONSTRAINT fk_factura_detalle_factura
FOREIGN KEY (factura) REFERENCES Factura(codigo);

ALTER TABLE Detalle_Factura ADD CONSTRAINT fk_producto_detalle_factura
FOREIGN KEY (producto) REFERENCES Producto(codigo);

-- Mostrar las tablas
SHOW TABLES;
DESC Clientes;

-- Insertar datos de ejemplo
INSERT INTO Clientes(nombre, telefono, correo) VALUES ('axel aguilar', '12345678', 'mail.123@mail.com');
SELECT * FROM Clientes;

-- Insertar productos de ejemplo
INSERT INTO Producto (codigo, descripcion, observaciones, precio) 
VALUES (1, 'Martillo de Madera', 'Martillo pequeño de Madera', 19.99);

SELECT codigo, descripcion, precio, observaciones FROM Producto;

-- Insertar una factura de ejemplo
INSERT INTO Factura (cliente, fecha, monto) VALUES (1, NOW(), 0);

-- Insertar detalles de factura
INSERT INTO Detalle_Factura (factura, producto, cantidad, subtotal)
VALUES (1, 1, 1, 19.99);

-- Consulta de detalle de factura
SELECT df.id, df.factura, df.producto, p.descripcion, df.cantidad, df.subtotal 
FROM Detalle_Factura df
INNER JOIN Producto p ON p.codigo = df.producto
WHERE df.factura = 1;

-- Consulta de la factura completa
SELECT * 
FROM Factura f
INNER JOIN Clientes c ON c.codigo = f.cliente
INNER JOIN Detalle_Factura df ON df.factura = f.codigo
INNER JOIN Producto p ON p.codigo = df.producto
WHERE f.codigo = 1;
