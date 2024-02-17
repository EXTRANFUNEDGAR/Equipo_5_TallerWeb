<template>
  <div>
    <div align="center">
      <form @submit.prevent="actualizarRegistro">
        <div>
          <label for="usuario">Usuario: </label><br>
          <input type="text" v-model="usuario.usuario" id="usuario"><br>
        </div>
        <div>
          <label for="contrasena">Contraseña: </label><br>
          <input type="password" v-model="usuario.contrasena" id="contrasena"><br>
        </div>
        <div>
          <button type="submit">Editar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      usuario: {
        id: null,
        usuario: '',
        contrasena: ''
      }
    }
  },
  created() {
    this.obtenerDatos();
  },
  methods: {
    obtenerDatos() {
      fetch('http://localhost/atras/?consultar=1&id=' + this.$route.params.id)
        .then(respuesta => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          if (datosRespuesta.length > 0) {
            this.usuario = datosRespuesta[0];
          } else {
            console.error('El usuario no se encontró');
          }
        })
        .catch(error => console.error('Error al obtener datos:', error));
    },
    actualizarRegistro() {
      fetch('http://localhost/atras/actualizar.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(this.usuario)
      })
      .then(respuesta => respuesta.json())
      .then((datosRespuesta) => {
        console.log(datosRespuesta);
        if (datosRespuesta.success) {
          console.log('Usuario actualizado exitosamente');
        } else {
          console.error('Error al actualizar usuario:', datosRespuesta.error);
        }
      })
      .catch(error => console.error('Error al actualizar registro:', error));
    }
  }
}
</script>
