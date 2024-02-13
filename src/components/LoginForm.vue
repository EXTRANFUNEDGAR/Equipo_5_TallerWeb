<template>
    <div>
        <div class="carta">

<h1>LOGIN</h1>
<form  >
  <label>Usuario</label>
  <br>
<input class="input-style" type="text" id="usuario" name="usuario">
<br>

<br>
<label>Contraseña</label>
<br>
<input class="input-style" type="text" id="contrasena" name="contrasena">
<br>
<hr>
<button type="submit" class="btn" onclick="redireccionar()">Entrar</button>

</form>

</div>
    </div>
</template>
<script>

    import '../css/login.css';

    export default{
        
    }
</script>