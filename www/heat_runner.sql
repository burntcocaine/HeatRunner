ALTER DATABASE HeatRunner CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;


CREATE TABLE Viviendas (
  IdVivienda INT PRIMARY KEY,
  Nomvivienda VARCHAR(255) NOT NULL,
  Direccion VARCHAR(255),
  Tipo VARCHAR(255) 
);


-- Crear tabla Zonas
CREATE TABLE Zonas (
  Idzona INT PRIMARY KEY,
  Nomzona VARCHAR(255) NOT NULL,
  IdVivienda INT,
  FOREIGN KEY (IdVivienda) REFERENCES Viviendas(IdVivienda)
);

-- Crear tabla Sensores
CREATE TABLE Sensores (
  Sensor INT PRIMARY KEY,
  Idzona INT NOT NULL,
  NombreSensor VARCHAR(255) NOT NULL,
  FOREIGN KEY (Idzona) REFERENCES Zonas(Idzona)
);

-- Crear tabla Lecturas
CREATE TABLE Lecturas (
  Idlectura INT AUTO_INCREMENT PRIMARY KEY,
  IdSensor INT NOT NULL,
  FechaLectura DATETIME NOT NULL,
  ValorLectura FLOAT NOT NULL,
  UnidadMedida VARCHAR(50) NOT NULL,
  FOREIGN KEY (IdSensor) REFERENCES Sensores(Sensor)
);





CREATE TABLE `usuario` (
  `id` int PRIMARY KEY,
  `usuario` varchar(50) NOT NULL,
  `contra` varchar(50) NOT NULL,
  `estado` int NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `pais` varchar(50) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `biografia` text,
  `avatar` BLOB
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;






CREATE TABLE telegramas_knx (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timestamp DATETIME, -- 'Tiempo'
    source_name VARCHAR(255), -- 'Nombre de origen' (o una tabla relacionada)
    destination_name VARCHAR(255), -- 'Nombre de destino' (o una tabla relacionada)
    information VARCHAR(255), -- 'Informacion' (con posible normalizacion)
    data_type VARCHAR(50), -- 'Tipo' (por ejemplo, GroupValueWrite)
    dpt VARCHAR(50), -- 'DPT' (por ejemplo, 1.1.3)
    value VARCHAR(50), -- Valor extraido de 'Informacion'
    additional_data JSON -- Otros campos relevantes en formato JSON
);
ALTER TABLE telegramas_knx CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


INSERT INTO telegramas_knx (timestamp, source_name, destination_name, information, data_type, dpt, value, additional_data)
VALUES ('2024-01-05 19:38:26', 'Bajo', 'Z41 Pro', 'S=0 Bajo 1.1.3 Z41 Pro ZONA 1 ZONA 2 0/0/2 HORA 73 26 1C | Wednesday, 19:38:28 6 GroupValueWrite LL_ACK', 'GroupValueWrite', '1.1.3', '0/0/2', '{"hora": "73 26 1C", "dia": "Wednesday", "sub_mensaje": "19:38:28 6 GroupValueWrite LL_ACK"}');



INSERT INTO Viviendas (IdVivienda, Nomvivienda, Direccion, Tipo) VALUES
(1, 'Sainvi', 'Partida Paraiso 44', 'Apartamento'),
(2, 'Paradise Property', 'Villajoyosa', 'Local');


INSERT INTO Zonas (Idzona, Nomzona, IdVivienda) VALUES
(1, 'Cocina', 1),
(2, 'Habitacion 1', 1),
(3, 'Habitacion 2', 1),
(4, 'Banyo', 1),
(5, 'Hall', 1),
(6, 'Dormitorio', 1),
(7, 'Balcon', 1),
(8, 'Salon', 1);

INSERT INTO Sensores (Sensor, Idzona, NombreSensor) VALUES
(1, 2, 'Habitacion1'),
(2, 3, 'Habitacion2'),
(3, 4, 'Banyo'),
(4, 6, 'Dormitorio'),
(5, 8, 'Salon1'),
(6, 8, 'Salon2');

INSERT INTO Lecturas (IdSensor, FechaLectura, ValorLectura, UnidadMedida) VALUES
(1, '2024-05-21 10:00:00', 22.5, 'Celsius'),
(1, '2024-05-21 11:00:00', 22.7, 'Celsius'),


INSERT INTO Lecturas (IdSensor, FechaLectura, ValorLectura, UnidadMedida) VALUES
-- Sensor en Habitación 1
(1, '2024-05-21 10:00:00', 22.5, 'Celsius'),
(1, '2024-05-21 11:00:00', 22.7, 'Celsius'),
(1, '2024-05-21 12:00:00', 22.9, 'Celsius'),
(1, '2024-05-21 13:00:00', 23.1, 'Celsius'),
(1, '2024-05-21 14:00:00', 23.3, 'Celsius'),
(1, '2024-05-21 15:00:00', 23.5, 'Celsius'),
(1, '2024-05-21 16:00:00', 23.7, 'Celsius'),

-- Sensor en Habitación 2
(2, '2024-05-21 10:00:00', 21.0, 'Celsius'),
(2, '2024-05-21 11:00:00', 21.2, 'Celsius'),
(2, '2024-05-21 12:00:00', 21.3, 'Celsius'),
(2, '2024-05-21 13:00:00', 21.5, 'Celsius'),
(2, '2024-05-21 14:00:00', 21.7, 'Celsius'),
(2, '2024-05-21 15:00:00', 21.9, 'Celsius'),
(2, '2024-05-21 16:00:00', 22.1, 'Celsius'),

-- Sensor en Baño

(3, '2024-05-21 10:00:00', 20.5, 'Celsius'),
(3, '2024-05-21 11:00:00', 20.8, 'Celsius'),
(3, '2024-05-21 12:00:00', 20.9, 'Celsius'),
(3, '2024-05-21 13:00:00', 21.1, 'Celsius'),
(3, '2024-05-21 14:00:00', 21.3, 'Celsius'),
(3, '2024-05-21 15:00:00', 21.5, 'Celsius'),
(3, '2024-05-21 16:00:00', 21.7, 'Celsius'),

-- Sensor en Dormitorio
(4, '2024-05-21 10:00:00', 23.0, 'Celsius'),
(4, '2024-05-21 11:00:00', 23.3, 'Celsius'),
(4, '2024-05-21 12:00:00', 23.5, 'Celsius'),
(4, '2024-05-21 13:00:00', 23.7, 'Celsius'),
(4, '2024-05-21 14:00:00', 23.9, 'Celsius'),
(4, '2024-05-21 15:00:00', 24.1, 'Celsius'),
(4, '2024-05-21 16:00:00', 24.3, 'Celsius'),

-- Sensor en Salón 1
(5, '2024-05-21 10:00:00', 24.5, 'Celsius'),
(5, '2024-05-21 11:00:00', 24.7, 'Celsius'),
(5, '2024-05-21 12:00:00', 24.9, 'Celsius'),
(5, '2024-05-21 13:00:00', 25.1, 'Celsius'),
(5, '2024-05-21 14:00:00', 25.3, 'Celsius'),
(5, '2024-05-21 15:00:00', 25.5, 'Celsius'),
(5, '2024-05-21 16:00:00', 25.7, 'Celsius'),

-- Sensor en Salón 2
(6, '2024-05-21 10:00:00', 24.6, 'Celsius'),
(6, '2024-05-21 11:00:00', 24.8, 'Celsius'),
(6, '2024-05-21 12:00:00', 25.0, 'Celsius'),
(6, '2024-05-21 13:00:00', 25.2, 'Celsius'),
(6, '2024-05-21 14:00:00', 25.4, 'Celsius'),
(6, '2024-05-21 15:00:00', 25.6, 'Celsius'),
(6, '2024-05-21 16:00:00', 25.8, 'Celsius');
