<template>
    <div>
        

        <div v-for="usuario in usuarios" :key="usuario.id_usuario">



            <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Contrasena</th>
                    <th>rango</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ usuario.id_usuario }}</td>
                    <td>{{ usuario.usuario }}</td>
                    <td>{{ usuario.contrasena }}</td>
                    <td>{{ usuario.rango }}</td>
                    <td>{{ usuario.status }}</td>
                </tr>
            </tbody>
        </table>
    </div>


        </div>


    </div>
</template>
<script>
    export default{
        data(){
            return{
                usuarios:[]
            }
        },

        created:function(){

            this.consultarUsuarios();



        },
        methods:{

            consultarUsuarios(){
                fetch('http://localhost/atras/index.php').then(respuesta=>respuesta.json()).then((datosRespuesta)=>{
                    console.log(datosRespuesta)
                    this.usuarios=[]
                    if(typeof datosRespuesta[0].success==='undefined'){
                        this.usuarios = datosRespuesta;
                    }
                })
                .catch(console.log)
            }
        }

    }
</script>