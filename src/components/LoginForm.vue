<template>
    <div class="cen">
        <div class="carta">

<h1>LOGIN</h1>
        <div class="cen">
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
<!--<button type="submit" class="btn" to="/listar">Entrar</button>-->
<br>
<router-link to="/listar" class="btn">Lista</router-link>

</form>
</div>
</div>
    </div>
</template>
<script>

    import '../css/login.css';

    export default{
        
    }
</script>