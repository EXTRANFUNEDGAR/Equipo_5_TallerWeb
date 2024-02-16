<template>
  <div class="main-container">
    <div class="sidebar">
      <h3>FILTROS</h3>
      <ul>
        <li><p2>Género</p2></li>
        <li><p2>Fecha de Estreno</p2></li>
        <li><p2>Artista</p2></li>
        <li><p2>Director</p2></li>
        <li><p2>Escritor</p2></li>
        <li><p2>Productor</p2></li>
      </ul>
    </div>
    
    <div class="content">
      <div class="image-container">
        <!-- Aquí van las imágenes de las películas -->
        <!-- Ejemplo de una imagen de película -->
        <div class="image-item">
          <img src="../css/img/127Horas.jpg" alt="127 Horas">
          <p>127 Horas</p>
        </div>
        <div class="image-item">
          <img src="../css/img/AliceinWoederland.jpg" alt="Alice in Woederland">
          <p>Alice in Woederland</p>
        </div>
        <div class="image-item">
          <img src="../css/img/Dracula.jpg" alt="Dracula">
          <p>Dracula</p>
        </div>
        <div class="image-item">
          <img src="../css/img/Asesinos.jpg" alt="Asesinos">
          <p>Asesinos</p>
        </div>
        <div class="image-item">
          <img src="../css/img/Fausto.jpg" alt="Fausto">
          <p>Fausto</p>
        </div>
        <div class="image-item">
          <img src="../css/img/Hellboy.jpg" alt="Hellboy">
          <p>Hellboy</p>
        </div>
        <div class="image-item">
          <img src="../css/img/Lola.jpg" alt="Lola">
          <p>Lola</p>
        </div>
        <div class="image-item">
          <img src="../css/img/Mividaalos17.jpg" alt="Mivida a los 17">
          <p>Mivida a los 17</p>
        </div>
        <div class="image-item">
          <img src="../css/img/SupermanVsBatman.jpg" alt="Superman VS Batman">
          <p>Superman VS Batman</p>
        </div>
        <div class="image-item">
          <img src="../css/img/AliceinWonderland.jpg" alt="Alice in Wonderland">
          <p>Alice in Wonderland</p>
        </div>
        <!-- Agrega más elementos image-item según sea necesario -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    filterByGenre(genre) {
      // Lógica para filtrar por género de película
      console.log("Filtrar por género:", genre);
    }
    // Agrega métodos para otros filtros como fecha de estreno, artista director, productor, etc.
  }
}
</script>

<style>
.main-container {
  display: flex;
}

.sidebar {
  width: 200px;
  padding: 20px;
  background-color: #f0f0f0;
  font-family: Abadi, Arial, sans-serif; /* Cambio de fuente */
}

.content {
  flex-grow: 1;
  padding: 20px;
}

.image-container {
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-wrap: wrap;
}

.image-item {
  text-align: center;
  margin: 14px;
  width: 140px;
  height: 200px;
}

img {
  width: 90%;
  height: 90%;
  border: 1px solid #ddd;
  border-radius: 8px;
}

p {
  margin: 6px 0;
  color: #c4dafc;
  font-family: Abadi, Arial, sans-serif; /* Cambio de fuente */
}

.sidebar h3 {
  margin-bottom: 10px;
  font-family: Abadi, Arial, sans-serif; /* Cambio de fuente */
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar ul li {
  cursor: pointer;
  padding: 5px 0;
  font-family: Abadi, Arial, sans-serif; /* Cambio de fuente */
}

.sidebar ul li:hover {
  background-color: #ccc;
}
</style>

