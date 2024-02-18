<template>
  <div class="login-container">
    <h2>Lista de Usuarios</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Contraseña</th>
          <th>Rango</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="usuario in usuarios" :key="usuario.id_usuario">
          <td>{{ usuario.id_usuario }}</td>
          <td>{{ usuario.usuario }}</td>
          <td>{{ usuario.contrasena }}</td>
          <td>{{ usuario.rango }}</td>
          <td>
            <button @click="editarUsuario(usuario)" class="custom-button">Editar</button>
            <br>
            <button @click="eliminarUsuario(usuario.id_usuario)" class="custom-button">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>

    <h2>{{ modoEdicion ? 'Editar Usuario' : 'Insertar Usuario' }}</h2>

    <table>
      <tr>
        <td>
          <label for="usuario">Usuario:</label>
        </td>
        <td>
          <input type="text" id="usuario" v-model="usuarioActual.usuario">
        </td>
      </tr>
      <tr>
        <td>
          <label for="contrasena">Contraseña:</label>
        </td>
        <td>
          <input type="password" id="contrasena" v-model="usuarioActual.contrasena">
        </td>
      </tr>
      <tr>
        <td>
          <label for="rango">Rango:</label>
        </td>
        <td>
          <select id="rango" v-model="usuarioActual.rango">
            <option value="user">Usuario</option>
            <option value="admin">Administrador</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label for="status">Estado:</label>
        </td>
        <td>
          <select id="status" v-model="usuarioActual.status">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <button v-if="modoEdicion" @click="actualizarUsuario()" class="custom-button">Guardar Cambios</button>
          <button v-else @click="insertarUsuario()" class="custom-button">Insertar Usuario</button>
        </td>
      </tr>
    </table>
  </div>
</template>


<script>
export default {
  data() {
    return {
      usuarios: [],
      usuarioActual: { id_usuario: null, usuario: '', contrasena: '', rango: 'user', status: '1' }, // Establecer valores por defecto
      modoEdicion: false
    };
  },
  created() {
    this.obtenerUsuarios();
  },
  methods: {
    obtenerUsuarios() {
      fetch('http://localhost:3000/usuarios')
        .then(response => response.json())
        .then(data => {
          this.usuarios = data;
        })
        .catch(error => console.error('Error al obtener usuarios:', error));
    },
    insertarUsuario() {
      const nuevoUsuario = {
        usuario: this.usuarioActual.usuario,
        contrasena: this.usuarioActual.contrasena,
        rango: this.usuarioActual.rango,
        status: this.usuarioActual.status
      };
      if (nuevoUsuario.usuario && nuevoUsuario.contrasena) {
        fetch('http://localhost:3000/usuarios', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(nuevoUsuario)
        })
        .then(response => response.json())
        .then(data => {
          console.log('Usuario insertado correctamente:', data);
          this.obtenerUsuarios();
          this.limpiarFormulario();
        })
        .catch(error => console.error('Error al insertar usuario:', error));
      } else {
        console.error('Por favor, proporcione usuario y contraseña');
      }
    },
    editarUsuario(usuario) {
      this.usuarioActual = { ...usuario };
      this.modoEdicion = true;
    },
    actualizarUsuario() {
      const usuarioActualizado = {
        id_usuario: this.usuarioActual.id_usuario,
        usuario: this.usuarioActual.usuario,
        contrasena: this.usuarioActual.contrasena,
        rango: this.usuarioActual.rango,
        status: this.usuarioActual.status
      };

      if (usuarioActualizado.id_usuario && usuarioActualizado.usuario && usuarioActualizado.contrasena) {
        fetch(`http://localhost:3000/usuarios/${usuarioActualizado.id_usuario}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            usuario: usuarioActualizado.usuario,
            contrasena: usuarioActualizado.contrasena,
            rango: usuarioActualizado.rango,
            status: usuarioActualizado.status
          })
        })
        .then(response => response.json())
        .then(data => {
          console.log('Usuario actualizado correctamente:', data);
          this.obtenerUsuarios();
          this.limpiarFormulario();
          this.modoEdicion = false;
        })
        .catch(error => console.error('Error al actualizar usuario:', error));
      } else {
        console.error('Por favor, proporcione todos los campos necesarios para actualizar el usuario');
      }
    },
    eliminarUsuario(id_usuario) {
      if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        fetch(`http://localhost:3000/usuarios/${id_usuario}`, {
          method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
          console.log('Usuario eliminado correctamente:', data);
          this.obtenerUsuarios();
        })
        .catch(error => console.error('Error al eliminar usuario:', error));
      }
    },
    limpiarFormulario() {
      this.usuarioActual = { id_usuario: null, usuario: '', contrasena: '', rango: 'user', status: '1' }; 
    }
  }
};
</script>

<style scoped>
.login-container {
  font-family: 'Abadi', sans-serif;
  text-align: center;
  margin-top: 50px;
}

.custom-button {
  padding: 10px 20px;
  background-color: #4c82af;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-bottom: 10px; /* Añadido para dar espacio entre los botones */
}

.custom-button:hover {
  background-color: #4c82af;
}

form {
  display: inline-block;
  padding: 20px;
  background-color: #f4f4f4;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 15px;
}

label {
  font-weight: bold;
}

input[type="text"],
input[type="password"],
select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Estilo para los selectores */
select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background: #fff url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%234c82af" width="18px" height="18px"><path d="M7 10l5 5 5-5z" /></svg>') no-repeat right 8px center;
}

select:hover {
  border-color: #4c82af;
}

select:focus {
  outline: none;
  border-color: #4c82af;
  box-shadow: 0 0 5px rgba(76, 130, 175, 0.7);
}

/* Estilo para las tablas */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #4c82af;
  color: white;
}
</style>
