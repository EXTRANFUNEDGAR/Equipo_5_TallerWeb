const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const mysql = require('mysql');

const app = express();
const PORT = 3000; // Puerto en el que se ejecutará el servidor

// Configuración de MySQL
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

// Middleware
app.use(bodyParser.json());
app.use(cors());

// Ruta GET: Obtener todos los usuarios
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

// Ruta POST: Insertar un nuevo usuario
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

// Ruta PUT: Actualizar un usuario existente
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

// Ruta DELETE: Eliminar un usuario
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

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor iniciado en el puerto ${PORT}`);
});
