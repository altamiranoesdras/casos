<template>

  <!--            Tabla de datos
  ------------------------------------------------------------------------>
  <v-data-table :headers="headers" :items="casos" sort-by="calories" class="elevation-1" :loading="loading" loading-text="Cargando datos, por favor espere...">

    <template v-slot:top>

      <v-toolbar flat color="dark">

        <v-toolbar-title>Casos</v-toolbar-title>

        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>


        <!--            Ventana modal del formulario
        ------------------------------------------------------------------------>
        <v-dialog v-model="dialog" max-width="600px">

          <template v-slot:activator="{ on }">
            <v-btn color="primary" light class="mb-2" v-on="on">Nuevo Caso</v-btn>
          </template>

          <v-form @submit.prevent="save">
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" md="12">
                      <v-text-field v-model="editedItem.titulo" label="Titulo"></v-text-field>
                    </v-col>
                    <v-col cols="12" md="12">
                      <v-textarea rows="8" v-model="editedItem.cuerpo" label="Descripcion" outlined></v-textarea>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions class="mr-4" >
                <v-spacer></v-spacer>
                <v-btn outlined color="blue" text @click="close">Cancelar</v-btn>
                <v-btn outlined type="submit" color="green" text >
                  <span v-text="loadingForm ? 'GUARDANDO...' : 'GUARDAR'"></span>   <v-icon v-show="loadingForm">mdi-loading mdi-spin</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-form>
        </v-dialog>

      </v-toolbar>
    </template>

    <!--            botones de acciones
    ------------------------------------------------------------------------>
    <template v-slot:item.action="{ item }">
      <v-btn @click="editItem(item)" color="mr-2 primary" fab x-small dark>
        <v-icon > mdi-pencil </v-icon>
      </v-btn>
      <v-btn @click="deleteItem(item)" color="mr-2 error" fab x-small dark>
      <v-icon> mdi-delete </v-icon>
      </v-btn>
    </template>


    <!-- Boton para cuando no hay datos en la tabla -->
    <template v-slot:no-data>
      <v-btn color="primary" @click="getDatos">Reset</v-btn>
    </template>

  </v-data-table>
</template>

<script>

    export default {
        middleware: 'auth',
        data: () => ({
            dialog: false,
            loading: true,
            loadingForm: false,
            headers: [
                { text: 'Caso', value: 'titulo',},
                { text: 'Descripcion', value: 'cuerpo' },
                { text: 'Actions', value: 'action', width: '10%' },
            ],
            casos: [],
            editedItem: {
                id : 0,
                Caso: '',
                Descripcion: '',
            },
            defaultItem: {
                id : 0,
                Caso: '',
                Descripcion: '',
            },
        }),

        computed: {
            formTitle () {
                return this.editedItem.id === 0 ? 'Nuevo Caso' : 'Editar Caso'
            },
        },

        watch: {
            dialog (val) {
                val || this.close()
            },
        },

        created () {
            this.getDatos();

        },

        methods: {
            async getDatos () {

                try{

                    const res = await this.$axios.$get('api/casos');

                    this.casos = res.data;
                    this.loading = false;

                }catch (error) {

                    console.log(error)
                }


            },

            editItem (item) {

                this.editedItem = Object.assign({}, item);
                this.dialog = true
            },

            async deleteItem (item) {

                this.editedItem = Object.assign({}, item);

                const res = confirm('Esta seguro de eliminar el caso '+this.editedItem.titulo+' ?');


                //si da click en aceptar
                if (res){
                    try {
                        const url = 'api/casos/'+this.editedItem.id;

                        const res = await this.$axios.$delete(url);

                        this.getDatos();


                        this.notifySuccess('Listo!',res.data.message);

                    }catch (e) {
                        console.log(e.response)
                    }
                }

                this.close();

            },

            close () {
                this.dialog = false;
                this.loadingForm = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                }, 300)
            },

            async save () {

                this.loadingForm = true;

                try {

                    const data = this.editedItem;

                    if(this.editedItem.id === 0){

                        const url = 'api/casos';

                        var res = await this.$axios.$post(url,data);

                    }else {

                        var url = 'api/casos/'+this.editedItem.id;

                        var res = await this.$axios.$patch(url,data);
                    }

                    this.notifySuccess('Listo!',res.message);
                    this.getDatos();
                    this.close();

                }catch (e) {
                    console.log(e.response);

                    var errors = e.response.data.errors;

                    if(typeof errors !== 'undefined'){

                        this.notifyErrorList(errors);
                    }

                    this.loadingForm = false;
                }

            }
        }
    }
</script>
