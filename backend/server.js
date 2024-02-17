const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const mysql = require('mysql');

const app = express();
const PORT = 3000; 


const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'app-mult'
});

db.connect(err => {
  if (err) {
    throw err;
  }
  console.log('Conectado a la base de datos MySQL');
});


app.use(bodyParser.json());
app.use(cors());

//Obtener
app.get('/usuarios', (req, res) => {
  const sql = 'SELECT * FROM usuario';
  db.query(sql, (err, result) => {
    if (err) {
      res.status(500).json({ error: 'Error al obtener usuarios de la base de datos' });
    } else {
      res.json(result);
    }
  });
});

//Insertar
app.post('/usuarios', (req, res) => {
  const { usuario, contrasena, rango, status } = req.body;
  const sql = `INSERT INTO usuario (usuario, contrasena, rango, status) VALUES (?, ?, ?, ?)`;
  db.query(sql, [usuario, contrasena, rango, status], (err, result) => {
    if (err) {
      res.status(500).json({ error: 'Error al insertar usuario en la base de datos' });
    } else {
      res.json({ message: 'Usuario insertado correctamente' });
    }
  });
});

//Actualizar
app.put('/usuarios/:id_usuario', (req, res) => {
  const id_usuario = req.params.id_usuario;
  const { usuario, contrasena, rango, status } = req.body;
  const sql = `UPDATE usuario SET usuario=?, contrasena=?, rango=?, status=? WHERE id_usuario=?`;
  db.query(sql, [usuario, contrasena, rango, status, id_usuario], (err, result) => {
    if (err) {
      res.status(500).json({ error: 'Error al actualizar usuario en la base de datos' });
    } else {
      res.json({ message: 'Usuario actualizado correctamente' });
    }
  });
});

//Eliminar
app.delete('/usuarios/:id_usuario', (req, res) => {
  const id_usuario = req.params.id_usuario;
  const sql = `DELETE FROM usuario WHERE id_usuario=?`;
  db.query(sql, [id_usuario], (err, result) => {
    if (err) {
      res.status(500).json({ error: 'Error al eliminar usuario de la base de datos' });
    } else {
      res.json({ message: 'Usuario eliminado correctamente' });
    }
  });
});


app.listen(PORT, () => {
  console.log(`Servidor iniciado en el puerto ${PORT}`);
});
