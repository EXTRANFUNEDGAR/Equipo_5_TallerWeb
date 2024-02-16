<template>
    <div class="login-container">
      
      <form @submit.prevent="agregarRegistro">
        <img src="../css/imgregistro/IconoUsuario.jpg" alt="Imagen de usuario" class="user-image">
        <div class="form-group">
          <label for="usuario">Usuario: </label><br>
          <input type="text" name="usuario" v-model="usuario.usuario" id="usuario" required>
        </div>
        <div class="form-group">
          <label for="contrasena">Contraseña: </label><br>
          <input type="password" name="contrasena" v-model="usuario.contrasena" id="contrasena" required>
        </div>
        <div class="form-group">
          <button type="submit">Iniciar Sesión</button>
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
  methods: {
    agregarRegistro() {
      var datosEnviar = {
        usuario: this.usuario.usuario,
        contrasena: this.usuario.contrasena
      };
      fetch('http://localhost/atras/registro.php', {
          method: "POST",
          body: JSON.stringify(datosEnviar)
        })
        .then(respuesta => respuesta.json())
        .then((datosRespuesta => {
          console.log(datosRespuesta);
          window.location.href = 'listar'
        }))
    }
  }
}
</script>

<style scoped>
.login-container {
  font-family: 'Abadi', sans-serif;
  text-align: center;
  margin-top: 50px;
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
input[type="password"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #0056b3;
}

button:focus {
  outline: none;
}

.user-image {
  width: 200px; /* Define el ancho deseado para la imagen */
  height: auto; /* La altura se ajustará automáticamente */
}
</style>
