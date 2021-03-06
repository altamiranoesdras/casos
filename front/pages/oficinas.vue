<template>

  <!--            Tabla de datos
  ------------------------------------------------------------------------>
  <v-data-table :headers="headers" :items="oficinas" sort-by="calories" class="elevation-1" :loading="loading" loading-text="Cargando datos, por favor espere...">

    <template v-slot:top>

      <v-toolbar flat color="dark">

        <v-toolbar-title>Oficinas</v-toolbar-title>

        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>


        <!--            Ventana modal del formulario
        ------------------------------------------------------------------------>
        <v-dialog v-model="dialog" max-width="800px">

          <template v-slot:activator="{ on }">
            <v-btn color="primary" light class="mb-2" v-on="on">Nueva Oficina</v-btn>
          </template>

          <v-form @submit.prevent="save">
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>

                    <v-col class="d-flex" cols="12" sm="6">
                      <v-select
                        :items="empresas"
                        label="Empresa"
                        v-model="editedItem.empresa_id"
                        item-value="id"
                        item-text="nombre"
                      ></v-select>
                    </v-col>
                    <v-col class="d-flex" cols="12" sm="6">
                      <v-select
                        :items="users"
                        label="Responsable"
                        v-model="editedItem.responsable"
                        item-value="id"
                      ></v-select>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field v-model="editedItem.nombre" label="Nombre"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field v-model="editedItem.telefono" label="Telefono"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field v-model="editedItem.correo" label="Correo"></v-text-field>
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
                { text: 'Empresa', value: 'empresa.nombre' },
                { text: 'Nombre', value: 'nombre',},
                { text: 'Responsable', value: 'responsable.name' },
                { text: 'Telefono', value: 'telefono' },
                { text: 'Correo', value: 'correo' },
                { text: 'Actions', value: 'action', width: '10%' },
            ],
            oficinas: [],
            empresas: [],
            users: [],
            editedItem: {
                id : 0,
                empresa_id: '',
                nombre: '',
                responsable: '',
                telefono: '',
                correo: '',
            },
            defaultItem: {
                id : 0,
                empresa_id: '',
                nombre: '',
                responsable: '',
                telefono: '',
                correo: '',
            },
        }),

        computed: {
            formTitle () {
                return this.editedItem.id === 0 ? 'Nueva Oficina' : 'Editar Oficina'
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

                    const res = await this.$axios.$get('api/oficinas');
                    const resUs = await this.$axios.$get('api/users');
                    const resEm = await this.$axios.$get('api/empresas');

                    this.oficinas = res.data;
                    this.users = resUs.data;
                    this.empresas = resEm.data;
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

                const res = confirm('Esta seguro de eliminar la oficina '+this.editedItem.nombre+' ?');


                //si da click en aceptar
                if (res){
                    try {
                        const url = 'api/oficinas/'+this.editedItem.id;

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

                        const url = 'api/oficinas';

                        var res = await this.$axios.$post(url,data);

                    }else {

                        var url = 'api/oficinas/'+this.editedItem.id;

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
