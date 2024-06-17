
INSERT INTO `usuarios` (`NombreUsuario`, `Contrasena`) VALUES
('alberto', '123456789'),
('rigo', '123456789');


INSERT INTO `notas` (`IDNota`, `NombreUsuario`, `ContenidoNota`, `Leida`, `FechaCreacion`) VALUES
(12, 'alberto', 'parcela 1 necesito nitrogeno', 1, '2024-06-11 13:24:32'),
(13, 'rigo', 'parcela 1 necesito nitrogeno', 1, '2024-06-11 13:24:32'),
(14, 'alberto', 'el campo 3 necesita calcio', 1, '2024-06-11 13:24:57'),
(15, 'rigo', 'el campo 3 necesita calcio', 1, '2024-06-11 13:24:57'),
(16, 'rigo', 'campo 1 necesita  fosforo', 1, '2024-06-11 13:28:22'),
(17, 'alberto', 'campo 1 necesita  fosforo', 1, '2024-06-11 13:28:22'),
(18, 'rigo', 'campo 4 necesita poda', 1, '2024-06-12 09:22:50'),
(19, 'alberto', 'campo 4 necesita poda', 0, '2024-06-12 09:22:50'),
(20, 'rigo', 'invernadero necesita quitar hierba', 1, '2024-06-12 09:23:22'),
(21, 'alberto', 'invernadero necesita quitar hierba', 0, '2024-06-12 09:23:22'),
(22, 'rigo', 'pepito tiene que regar campo 7', 1, '2024-06-12 09:24:48'),
(23, 'alberto', 'pepito tiene que regar campo 7', 0, '2024-06-12 09:24:48');

INSERT INTO `cultivos` (`Genero`, `Parcela`, `Temporada`, `CantidadPlanta`, `Nombre`) VALUES
('pimiento lamuyo', 'campo 2', '2024', 5000, 'pimiento lamuyo, pimiento lamuto 2'),
('calabacines', 'campo 3', '2024', 6000, 'calabacines, calabacines gordo'),
('brocoli', 'campo 7', '2024', 9000, 'brocoli'),
('tomate', 'invernadero 1', '2024', 1200, 'Tomate 1, TT bola ,Tomate 2');


INSERT INTO `abonado` (`Genero`, `Parcela`, `Fecha`, `Abono`, `Cantidad`, `Riego`, `Hecho`) VALUES
('pimiento lamuyo', 'campo 2', '2023-10-30', 'N potasico', 5.000, 5.000, 0),
('pimiento lamuyo', 'campo 2', '2023-11-06', 'N potasico', 5.000, 5.000, 1),
('pimiento lamuyo', 'campo 2', '2024-06-13', 'N calcio, N magnesio', 22.000, 22.000, 1),
('pimiento lamuyo', 'campo 2', '2024-06-24', 'N potasico', 55.000, 55.000, 0),
('pimiento lamuyo', 'campo 2', '2024-06-27', 'N calcio, N magnesio', 55.000, 55.000, 0),
('pimiento lamuyo', 'campo 2', '2024-06-28', 'N calcio, N magnesio', 55.000, 55.000, 0),
('calabacines', 'campo 3', '2024-06-10', 'N calcio, N magnesio', 55.000, 55.000, 0),
('calabacines', 'campo 3', '2024-06-11', 'mono amonico', 22.000, 22.000, 0),
('calabacines', 'campo 3', '2024-06-14', 'N calcio, N magnesio', 55.000, 55.000, 0),
('calabacines', 'campo 3', '2024-09-30', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-01', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-02', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-03', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-04', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-07', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-08', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-09', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-10', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-11', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-14', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-15', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-16', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-17', 'N calcio, N magnesio', 600.000, 61.000, 0),
('calabacines', 'campo 3', '2024-10-18', 'N calcio, N magnesio', 600.000, 61.000, 0),
('brocoli', 'campo 7', '2024-06-10', 'N calcio, N magnesio', 50.000, 22.000, 0),
('brocoli', 'campo 7', '2024-06-11', 'N amonico', 20.000, 22.000, 0),
('brocoli', 'campo 7', '2025-05-12', 'N calcio, N magnesio', 50.000, 22.000, 0),
('brocoli', 'campo 7', '2025-05-13', 'N calcio, N magnesio', 0.000, 22.000, 0),
('brocoli', 'campo 7', '2025-05-15', 'N calcio, N magnesio', 22.000, 22.000, 0),
('brocoli', 'campo 7', '2025-05-19', 'N calcio, N magnesio', 50.000, 22.000, 0),
('brocoli', 'campo 7', '2025-05-20', 'N calcio, N magnesio', 0.000, 22.000, 0),
('brocoli', 'campo 7', '2025-05-22', 'N calcio, N magnesio', 22.000, 22.000, 0),
('brocoli', 'campo 7', '2025-05-26', 'N calcio, N magnesio', 50.000, 22.000, 0),
('brocoli', 'campo 7', '2025-05-27', 'N calcio, N magnesio', 0.000, 22.000, 0),
('brocoli', 'campo 7', '2025-05-29', 'N calcio, N magnesio', 22.000, 22.000, 0),
('tomate', 'invernadero 1', '2024-02-12', 'S potasico', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-10', 'mono amonico', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-11', 'N potasico', 55.000, 55.000, 1),
('tomate', 'invernadero 1', '2024-06-12', 'N calcio, N magnesio', 55.000, 55.000, 1),
('tomate', 'invernadero 1', '2024-06-13', 'Nada', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-14', 'N potasico', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-17', 'mono amonico', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-18', 'N potasico', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-19', 'N calcio, N magnesio', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-20', 'Nada', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-21', 'N potasico', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-24', 'mono amonico', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-25', 'N potasico', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-26', 'N calcio, N magnesio', 55.000, 55.000, 0),
('tomate', 'invernadero 1', '2024-06-28', 'N potasico', 55.000, 22255.000, 1);







INSERT INTO `cura` (`Genero`, `Parcela`, `Fecha`, `Insecticida`) VALUES
('pimiento lamuyo', 'campo 2', '2024-06-12', 'isabion'),
('pimiento lamuyo', 'campo 2', '2024-06-27', 'isabion'),
('pimiento lamuyo', 'campo 2', '2024-06-29', 'agrimec'),
('calabacines', 'campo 3', '2024-06-07', 'isabion'),
('brocoli', 'campo 7', '2024-06-12', 'isabion'),
('tomate', 'invernadero 1', '2024-06-06', 'isabion');






INSERT INTO `producto` (`Id`, `Empresa`, `Genero`, `Fecha`, `Variedad`, `Kilos`, `Precios`) VALUES
(20, 'caicedo', 'pimiento lamuyo', '2024-06-12', 'pimiento lamuyo', 150.000, 1.000),
(21, 'caicedo', 'pimiento lamuyo', '2024-06-13', 'pimiento lamuyo', 150.000, 1.000),
(26, 'caicedo', 'calabacines', '2024-06-21', 'calabacines', 100.000, 1.000),
(27, 'caicedo', 'tomate', '2024-06-21', 'Tomate 1', 100.000, 1.333),
(28, 'lopez', 'brocoli', '2024-06-13', 'brocoli', 100.000, 1.000),
(29, 'lopez', 'tomate', '2024-06-14', 'TT bola', 100.000, 1.000),
(30, 'caicedo', 'tomate', '2024-06-13', 'Tomate 2', 100.000, 1.000),
(31, 'caicedo', 'pimiento lamuyo', '2024-06-13', 'pimiento lamuto 2', 100.000, 1.550),
(32, 'caicedo', 'pimiento lamuyo', '2024-06-13', 'pimiento lamuto 2', 100.000, 2.550),
(33, 'caicedo', 'calabacines', '2024-06-13', 'calabacines', 101.000, 2.000),
(34, 'caicedo', 'pimiento lamuyo', '2024-06-13', 'pimiento lamuyo', 44.000, 1.000);




INSERT INTO `receta` (`Genero`, `Dia`, `Abono`) VALUES
('brocoli', 'Lunes', 'N calcio, N magnesio'),
('brocoli', 'Martes', 'N potasico'),
('brocoli', 'Sabado', 'mono amonico'),
('brocoli', 'Viernes', 'S potasico'),
('calabacines', 'Domingo', 'N potasico'),
('calabacines', 'Jueves', 'N calcio, N magnesio'),
('calabacines', 'Lunes', 'mono amonico'),
('calabacines', 'Martes', 'N amonico'),
('calabacines', 'Miercoles', 'N potasico'),
('calabacines', 'Sabado', 'N amonico'),
('calabacines', 'Viernes', 'S potasico'),
('pimiento lamuyo', 'Domingo', 'N potasico'),
('pimiento lamuyo', 'Jueves', 'N calcio, N magnesio'),
('pimiento lamuyo', 'Lunes', 'mono amonico'),
('pimiento lamuyo', 'Martes', 'N amonico'),
('pimiento lamuyo', 'Miercoles', 'N potasico'),
('pimiento lamuyo', 'Sabado', 'N amonico'),
('pimiento lamuyo', 'Viernes', 'S potasico'),
('tomate', 'Domingo', 'N potasico'),
('tomate', 'Jueves', 'N calcio, N magnesio'),
('tomate', 'Lunes', 'mono amonico'),
('tomate', 'Martes', 'N amonico'),
('tomate', 'Miercoles', 'N potasico'),
('tomate', 'Sabado', 'N amonico'),
('tomate', 'Viernes', 'S potasico');





