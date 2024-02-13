CREATE TABLE `usuario` (
  id_usuario int(11) PRIMARY KEY AUTO_INCREMENT,
  usuario varchar(50),
  contrasena varchar(250),
  rango varchar(20),
  status int,
  UNIQUE (usuario)
)

insert into usuario(usuario,contrasena,rango,status)value("Edgar","1234","Admin","1");