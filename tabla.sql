CREATE DATABASE IF NOT EXISTS alozloz;

use alozloz;
DROP TABLE IF EXISTS Receta;
DROP TABLE IF EXISTS Cura;
DROP TABLE IF EXISTS Abonado;  
DROP TABLE IF EXISTS Cultivos;

CREATE TABLE Cultivos (
    Genero VARCHAR(50),
    Parcela VARCHAR(50),
    Temporada VARCHAR(50),
    CantidadPlanta INT,
    Nombre VARCHAR (200),
    PRIMARY KEY ( Parcela, Temporada)
);

CREATE TABLE Abonado (
    Genero VARCHAR(50),
    Parcela VARCHAR(50),
    Fecha DATE,
    Abono VARCHAR(50),
    Cantidad DECIMAL(10, 3),
    Riego DECIMAL(10, 3),
    Hecho BOOLEAN,
    PRIMARY KEY (Parcela, Fecha),
    FOREIGN KEY (Parcela) REFERENCES Cultivos(Parcela)
);
CREATE TABLE Cura (
    Genero VARCHAR(50),
    Parcela VARCHAR(50),
    Fecha DATE,
    Insecticida VARCHAR(50),
    PRIMARY KEY (Parcela, Fecha, Insecticida),
    FOREIGN KEY (Parcela) REFERENCES Cultivos(Parcela)
);
CREATE TABLE Receta (
    Genero VARCHAR(50),
    Dia VARCHAR(50),
    Abono VARCHAR(50),
    PRIMARY KEY (Genero, Dia)
    
);
DROP TABLE IF EXISTS Notas;
DROP TABLE IF EXISTS Usuarios;
CREATE TABLE Usuarios (
    
    NombreUsuario VARCHAR(50) NOT NULL PRIMARY KEY,
    Contrasena VARCHAR(50)NOT NULL
);

CREATE TABLE Notas (
    IDNota INT PRIMARY KEY AUTO_INCREMENT,
    NombreUsuario VARCHAR(50) ,
    ContenidoNota TEXT NOT NULL,
    Leida BOOLEAN DEFAULT FALSE,
    FechaCreacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (NombreUsuario) REFERENCES Usuarios(NombreUsuario)
);



DROP TABLE IF EXISTS Producto;
CREATE TABLE Producto (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Empresa VARCHAR(50),
    Genero VARCHAR(50),
    Fecha DATE,
    Variedad VARCHAR(50),
    Kilos DECIMAL(10, 3), 
    Precios DECIMAL(10, 3),
    Total DECIMAL(10, 3) GENERATED ALWAYS AS (Kilos * Precios) STORED
    
);




