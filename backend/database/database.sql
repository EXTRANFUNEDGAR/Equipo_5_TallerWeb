CREATE TABLE `usuario` (
  id_usuario int(11) PRIMARY KEY AUTO_INCREMENT,
  usuario varchar(50),
  contrasena varchar(250),
  rango varchar(20),
  status int,
  UNIQUE (usuario)
)

CREATE TABLE multimedia (
    id_mul INT AUTO_INCREMENT NOT NULL,
    tipo VARCHAR(50),
    nombre VARCHAR(50),
    duracion VARCHAR(10),
    clasificacion VARCHAR(50),
    genero VARCHAR(20),
    calificacion INT(10),
    id_usuario INT,
    PRIMARY KEY (id_mul),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

insert into usuario(usuario,contrasena,rango,status)value("Edgar","1234","Admin","1");
insert into usuario(usuario,contrasena,rango,status)value("Sergio","4321","Admin","1");
insert into usuario(usuario,contrasena,rango,status)value("Emmanuel","1212","Admin","1");