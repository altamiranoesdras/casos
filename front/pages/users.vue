<template>

  <!--            Tabla de datos
  ------------------------------------------------------------------------>
  <v-data-table :headers="headers" :items="users" sort-by="calories" class="elevation-1" :loading="loadingDatos" loading-text="Cargando datos, por favor espere...">

    <template v-slot:top>

      <v-toolbar flat color="dark">

        <v-toolbar-title>Usuarios</v-toolbar-title>

        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>


        <!--            Ventana modal del formulario
        ------------------------------------------------------------------------>
        <v-dialog v-model="dialog" max-width="800px">

          <template v-slot:activator="{ on }">
            <v-btn color="primary" light class="mb-2" v-on="on">Nuevo Usuario</v-btn>
          </template>

          <v-form @submit.prevent="save" onautocomplete="off">

            <v-card class="pb-2">
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field v-model="editedItem.name" label="Nombre"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="6">
                      <v-text-field v-model="editedItem.username" label="Username"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="6">
                      <v-text-field  v-model="editedItem.email" label="Correo"></v-text-field>
                    </v-col>


                    <v-col cols="12" sm="6" md="6" >
                      <v-text-field type="password" v-model="editedItem.password" label="Contraseña"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="6" >

                      <v-text-field type="password" v-model="editedItem.password_confirmation" label="Confirmar Contraseña"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions class="mr-4" >
                <v-spacer></v-spacer>
                <v-btn outlined color="blue" text @click="close">Cancelar</v-btn>
                <v-btn outlined type="submit" color="green" text >
                  <span v-text="loading ? 'GUARDANDO...' : 'GUARDAR'"></span>   <v-icon v-show="loading">mdi-loading mdi-spin</v-icon>
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
      <v-btn color="primary" @click="getDatos">Recargar</v-btn>
    </template>

  </v-data-table>
</template>

<script>

    export default {
        middleware: 'auth',
        data: () => ({
            dialog: false,
            loadingDatos: true,
            loading: false,
            headers: [
                { text: 'Username', value: 'username',},
                { text: 'Nombre', value: 'name' },
                { text: 'Correo', value: 'email' },
                { text: 'Actions', value: 'action' },
            ],
            users: [],
            editedItem: {
                id : 0,
                name: '',
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            defaultItem: {
                id : 0,
                name: '',
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
        }),

        computed: {
            formTitle () {
                return this.editedItem.id === 0 ? 'Nuevo Usuario' : 'Editar Usuario'
            },
            editando(){
                return this.editedItem.id !== 0;
            }
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

                    const res = await this.$axios.$get('api/users');

                    this.users = res.data;
                    this.loadingDatos = false;

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

                const res = confirm('Esta seguro de eliminar el Usuario '+this.editedItem.name+' ?');


                //si da click en aceptar
                if (res){
                    try {
                        const url = 'api/users/'+this.editedItem.id;

                        const res = await this.$axios.$delete(url);

                        this.getDatos();


                        this.notifySuccess('Listo!',res.message);

                    }catch (e) {
                        console.log(e.response)
                    }
                }

                this.close();

            },

            close () {
                this.dialog = false;
                this.loading = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                }, 300)
            },

            async save () {

                this.loading = true;

                try {

                    const data = this.editedItem;

                    if(this.editedItem.id === 0){

                        const url = 'api/users';

                        var res = await this.$axios.$post(url,data);

                    }else {

                        const url = 'api/users/'+this.editedItem.id;

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

                    this.loading = false;
                }

            }
        }
    }
</script>
