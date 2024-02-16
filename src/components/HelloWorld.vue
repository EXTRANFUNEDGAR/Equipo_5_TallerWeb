<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vue Page</title>
  <!-- Agrega aquí los enlaces a tus archivos CSS -->
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div id="app">
      <!-- Aquí se renderizará tu aplicación Vue -->
  </div>

  <!-- Agrega aquí los enlaces a tus archivos JS y la biblioteca Vue -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
  <script src="app.js"></script>
</body>

</html>


<script>
export default {
  name: 'HelloWorld',
  props: {
    msg: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.hello {
  font-family: Arial, sans-serif;
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

h1 {
  color: #333;
  text-align: center;
}

p {
  font-size: 16px;
  line-height: 1.6;
}

h3 {
  margin-top: 30px;
  color: #42b983;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  margin-bottom: 10px;
}

a {
  color: #42b983;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
</style>
