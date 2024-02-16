<template>
    <div>
        Hola editar 
    </div>
    <div aling="center">
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
    export default{
        data(){
            return{
                usuario:{}
            }
            },
            created:function(){

                
            },
            methods:{
                obtenerifois(){
                    
                fetch('http://localhost/atras/?consultar=').then(respuesta=>respuesta.json()).then((datosRespuesta)=>{
                    console.log(datosRespuesta)
                    this.usuarios=[]
                    if(typeof datosRespuesta[0].success==='undefined'){
                        this.usuarios = datosRespuesta[0];
                    }
                })
                .catch(console.log)
            }
        }
                }
            

        
        
    
</script>