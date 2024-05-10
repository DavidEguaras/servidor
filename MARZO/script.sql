CREATE DATABASE IF NOT EXISTS TiendaMarzo;

USE TiendaMarzo;

CREATE TABLE IF NOT EXISTS Rol(
    Id INT AUTO_INCREMENT PRIMARY KEY,
    NombreRol VARCHAR(255),
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS Categoria (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255),
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS Producto (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255),
    Descripcion VARCHAR(255),
    Precio FLOAT,
    Categoria INT,
    RutaImg VARCHAR(255),
    CantidadStock INT,
    FOREIGN KEY (Categoria) REFERENCES Categoria(Id),
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS Usuario (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255 ),
    Contraseña VARCHAR(255),
    Email VARCHAR(255),
    FechaNacimiento DATE,
    IdRol INT,
    FOREIGN KEY (IdRol) REFERENCES Rol(Id),
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS Albaran (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Fecha DATE NOT NULL,
    IdUsuario INT NOT NULL,
    FOREIGN KEY (IdUsuario) REFERENCES Usuario(Id),
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS DetalleAlbaran (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    IdAlbaran INT,
    IdProducto INT,
    Unidades INT,
    FOREIGN KEY (IdAlbaran) REFERENCES Albaran(Id),
    FOREIGN KEY (IdProducto) REFERENCES Producto(Id),
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS Pedido (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Fecha DATE,
    Direccion VARCHAR(255),
    PagoTotal FLOAT,
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS DetallePedido (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    IdPedido INT,
    IdProducto INT,
    Cantidad INT,
    PrecioUnidad FLOAT,
    Total INT,
    FOREIGN KEY (IdPedido) REFERENCES Pedido(Id),
    FOREIGN KEY (IdProducto) REFERENCES Producto(Id),
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS Carrito (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    IdUsuario INT,
    IdProducto INT,
    FOREIGN KEY (IdUsuario) REFERENCES Usuario(Id),
    FOREIGN KEY (IdProducto) REFERENCES Producto(Id),
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS Favoritos (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    IdUsuario INT,
    IdProducto INT,
    FOREIGN KEY (IdUsuario) REFERENCES Usuario(Id),
    FOREIGN KEY (IdProducto) REFERENCES Producto(Id),
    Borrado BOOLEAN NOT NULL DEFAULT FALSE
);

INSERT INTO Rol (NombreRol) VALUES
    ('Administrador'),
    ('Moderador'),
    ('Usuario');

INSERT INTO Usuario (Nombre, Contraseña, Email, FechaNacimiento, IdRol) VALUES
    ('Admingeorgi', 'adminpass', 'admin@example.com', '1990-01-01', 1),
    ('Modgeorgi', 'modpass', 'moderator@example.com', '1995-05-05', 2),
    ('georgi', 'userpass', 'user@example.com', '2000-10-10', 3);








