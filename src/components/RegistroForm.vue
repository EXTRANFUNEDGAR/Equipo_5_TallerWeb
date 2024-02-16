<template>
    <div>
        Hola registro
    </div>
    <div aling="center">
    <form v-on:submit.prevent="agregarRegistro" >
        <div>
            <label for="usuario">Usuario: </label><br>
            <input type="text" name="usuario" v-model="usuario.usuario" id="usuario"><br>
            
        </div>
        <div>
            <label for="contrasena">Contraseña: </label><br>
            <input type="password" name="contrasena" v-model="usuario.contrasena" id="contrasena"><br>
            
        </div>
        <div>
            <button type="submit">Registar</button>
        </div>
    </form>
    </div>   


</template>
<script>
    export default{
        
        data(){
            return{
                usuario:{}
            }
        },
        methods:{
            agregarRegistro(){
                console.log(this.usuario);

                var datosEnviar={usuario:this.usuario.usuario,contrasena:this.usuario.contrasena}
                fetch('http://localhost/atras/registro.php',{
                    method:"POST",
                    body:JSON.stringify(datosEnviar)
                })
                
                .then(respuesta=>respuesta.json())
                .then((datosRespuesta=>{
                    console.log(datosRespuesta);
                    window.location.href='listar'
                }))

            }
        }

    }
</script>