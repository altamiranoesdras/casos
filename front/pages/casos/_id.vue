<template>
  <div>

    <h1 v-text="caso.titulo"></h1>

    <p>DESCRIPCION DEL CASO</p>
    <p v-text="caso.cuerpo"></p>

    <p>OFICINA</p>
    <p v-text="oficinas.nombre"></p>


  </div>
</template>

<script>
    export default {
        name: "_id",
        data(){
            return{
                caso: {},
                oficinas: {}
            }
        },
        created(){
          this.getDatos();
        },
        methods:{
            async getDatos(){
                try{
                    var res = await this.$axios.$get('api/casos/'+this.$route.params.id);
                    var resOf = await this.$axios.$get('api/oficinas/'+this.$route.params.id);


                    this.caso = res.data;
                    this.oficinas = resOf.data;
                    this.consolaJs(res);
                }catch (e) {
                    this.consolaJs(e);
                }
            }
        }

    }
</script>

<style scoped>

</style>
