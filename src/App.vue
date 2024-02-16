<template>
  <header>
    <label></label>
  </header>
  <nav class="navbar" style="font-family: Abadi, Arial, sans-serif;">
    <router-link to="/">Inicio</router-link> 
    <router-link to="/about">About</router-link> 
    <router-link to="/registro">Registro</router-link> 
    <router-link to="/login">Login</router-link> 
    <router-link to="/Listar">Listar</router-link> 
    <router-link to="/editar">Editar</router-link> 
  </nav>
  <router-view />
</template>

<style>
/* Estilos para el encabezado y la barra de navegación */
header {
  background-color: #305472;
  color: white;
  padding: 10px;
}

.navbar {
  background-color: #f2f2f2;
  overflow: hidden;
}

.navbar a {
  float: left;
  display: block;
  color: #333;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.navbar a:hover {
  background-color: #ddd;
  color: black;
}

.router-link-exact-active {
  background-color: #4c82af;
  color: white;
}
</style>
