<template>
  <div class="image-container">
    <div class="image-item">
      <img src="ruta/a/tu/imagen.jpg" alt="Descripción de la imagen 1">
      <p>Definición de la imagen 1</p>
    </div>

    <div class="image-item">
      <img src="ruta/a/otra-imagen.jpg" alt="Descripción de la imagen 2">
      <p>Definición de la imagen 2</p>
    </div>

    <!-- Agrega más elementos image-item según sea necesario -->
  </div>
</template>

<style>
.image-container {
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-wrap: wrap;
}

.image-item {
  text-align: center;
  margin: 10px;
}

img {
  max-width: 100%;
  height: auto;
  border: 1px solid #ddd; /* Borde para las imágenes */
  border-radius: 8px; /* Bordes redondeados para las imágenes */
}

p {
  margin: 10px 0;
  color: #333;
}
</style>
