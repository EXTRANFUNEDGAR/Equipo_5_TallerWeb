<template>
  <div>
    <h2>Lista de Usuarios</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Contraseña</th>
          <th>Rango</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="usuario in usuarios" :key="usuario.id_usuario">
          <td>{{ usuario.id_usuario }}</td>
          <td>{{ usuario.usuario }}</td>
          <td>{{ usuario.contrasena }}</td>
          <td>{{ usuario.rango }}</td>
          <td>{{ usuario.status }}</td>
          <td>
            <button @click="editarUsuario(usuario)">Editar</button>
            <button @click="eliminarUsuario(usuario.id_usuario)">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>

    <h2>{{ modoEdicion ? 'Editar Usuario' : 'Insertar Usuario' }}</h2>
    <div>
      <label for="usuario">Usuario:</label>
      <input type="text" id="usuario" v-model="usuarioActual.usuario">
    </div>
    <div>
      <label for="contrasena">Contraseña:</label>
      <input type="password" id="contrasena" v-model="usuarioActual.contrasena">
    </div>
    <div>
      <label for="rango">Rango:</label>
      <input type="text" id="rango" v-model="usuarioActual.rango">
    </div>
    <div>
      <label for="status">Estado:</label>
      <input type="text" id="status" v-model="usuarioActual.status">
    </div>
    <button v-if="modoEdicion" @click="actualizarUsuario()">
      Guardar Cambios
    </button>
    <button v-else @click="insertarUsuario()">
      Insertar Usuario
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      usuarios: [],
      usuarioActual: { id_usuario: null, usuario: '', contrasena: '', rango: '', status: '' },
      modoEdicion: false
    };
  },
  created() {
    this.obtenerUsuarios();
  },
  methods: {
    obtenerUsuarios() {
      fetch('http://localhost:3000/usuarios') // Cambiar la URL para que coincida con el backend Node.js
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
        rango: this.usuarioActual.rango || 'user',
        status: this.usuarioActual.status || 1
      };
      if (nuevoUsuario.usuario && nuevoUsuario.contrasena) {
        fetch('http://localhost:3000/usuarios', { // Cambiar la URL para que coincida con el backend Node.js
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
        rango: this.usuarioActual.rango || 'user',
        status: this.usuarioActual.status || 1
      };

      if (usuarioActualizado.id_usuario && usuarioActualizado.usuario && usuarioActualizado.contrasena) {
        fetch(`http://localhost:3000/usuarios/${usuarioActualizado.id_usuario}`, { // Cambiar la URL para que coincida con el backend Node.js
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
        fetch(`http://localhost:3000/usuarios/${id_usuario}`, { // Cambiar la URL para que coincida con el backend Node.js
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
      this.usuarioActual = { id_usuario: null, usuario: '', contrasena: '', rango: '', status: '' };
    }
  }
};
</script>

  