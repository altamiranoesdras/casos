<template>
  <div>

    <h1 v-text="caso.titulo"></h1>
    <p v-text="caso.cuerpo"></p>
  </div>
</template>

<script>
    export default {
        name: "_id",
        data(){
            return{
                caso: {}
            }
        },
        created(){
          this.getDatos();
        },
        methods:{
            async getDatos(){
                try{
                    var res = await this.$axios.$get('api/casos/'+this.$route.params.id);

                    this.caso = res.data;
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
