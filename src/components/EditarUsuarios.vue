<template>
    <div>
      Hola editar 
    </div>
    <div align="center">
      <form v-on:submit.prevent="actualizarRegistro">
        <div>
          <label for="usuario">Usuario: </label><br>
          <input type="text" name="usuario" v-model="usuario.usuario" id="usuario"><br>
        </div>
        <div>
          <label for="contrasena">Contraseña: </label><br>
          <input type="password" name="contrasena" v-model="usuario.contrasena" id="contrasena"><br>
        </div>
        <div>
          <button type="submit">Editar</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        usuario: {}
      }
    },
    created() {
      this.obtenerDatos();
    },
    methods: {
      obtenerDatos() {
        fetch('http://localhost/atras/?consultar=1' + this.$route.params.id)
          .then(respuesta => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
            this.usuario = datosRespuesta[0];
          })
          .catch(error => console.error('Error al obtener datos:', error));
      },
      actualizarRegistro() {
        var datosEnviar = {
          id: this.usuario.id,
          usuario: this.usuario.usuario,
          contrasena: this.usuario.contrasena
        };
        console.log(datosEnviar);
  
        fetch('http://localhost/atras/actualizar.php/' + this.$route.params.id, {
            method: "POST",
            body: JSON.stringify(datosEnviar)
          })
          .then(respuesta => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
            //window.location.href = 'listar'; // Reemplazar '/' por la ruta correcta si es diferente
          })
          .catch(error => console.error('Error al actualizar registro:', error));
          console.log("si");
      }
    }
  }
  </script>
  