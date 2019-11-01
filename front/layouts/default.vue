<template>
  <v-app dark>

    <v-navigation-drawer v-model="drawer" :mini-variant="miniVariant" :clipped="clipped" fixed app>
      <v-list>
        <v-list-item v-for="(item, i) in items" :key="i" :to="item.to" router exact>
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="item.title" />
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <template v-slot:append>
        <div class="pa-2">
          <v-btn block @click.stop="open = true">
            <v-icon>mdi-logout</v-icon> SALIR
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar :clipped-left="clipped" fixed app>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
<!--      <v-btn-->
<!--        icon-->
<!--        @click.stop="miniVariant = !miniVariant"-->
<!--      >-->
<!--        <v-icon>mdi-{{ `chevron-${miniVariant ? 'right' : 'left'}` }}</v-icon>-->
<!--      </v-btn>-->
<!--      <v-btn-->
<!--        icon-->
<!--        @click.stop="clipped = !clipped"-->
<!--      >-->
<!--        <v-icon>mdi-application</v-icon>-->
<!--      </v-btn>-->
<!--      <v-btn-->
<!--        icon-->
<!--        @click.stop="fixed = !fixed"-->
<!--      >-->
<!--        <v-icon>mdi-minus</v-icon>-->
<!--      </v-btn>-->
      <v-toolbar-title v-text="title" />
      <v-spacer />

<!--      <v-btn icon @click.stop="rightDrawer = !rightDrawer">-->
<!--        <v-icon>mdi-menu</v-icon>-->
<!--      </v-btn>-->

      <v-btn icon @click.stop="open = true">
        <v-icon>mdi-logout</v-icon>
      </v-btn>

    </v-app-bar>

    <v-content>
      <v-container>
        <nuxt />

      </v-container>
    </v-content>


<!--    <v-navigation-drawer v-model="rightDrawer" :right="right" temporary fixed>-->
<!--      <v-list>-->
<!--        <v-list-item @click.native="right = !right">-->
<!--          <v-list-item-action>-->
<!--            <v-icon light>-->
<!--              mdi-repeat-->
<!--            </v-icon>-->
<!--          </v-list-item-action>-->
<!--          <v-list-item-title>Switch drawer (click me)</v-list-item-title>-->
<!--        </v-list-item>-->
<!--      </v-list>-->
<!--    </v-navigation-drawer>-->


    <v-footer :fixed="fixed" app>
      <span>&copy; 2019 SkyNet. Todos los derechos reservados</span>
    </v-footer>


    <v-dialog v-model="open" max-width="350" light>
      <v-card>
        <v-card-title class="headline warning" >
          <v-icon>mdi-warning</v-icon> Salir del Sistema!
        </v-card-title>

        <v-card-text>

          <div class="my-4 subtitle-1 black--text">
            Si esta seguro de salir del sistema presione el botón sí
          </div>

        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn outlined  color="gray" text @click="open = false">
            NO
          </v-btn>

          <v-btn outlined  color="error"  text @click="logout">
            SÍ
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-app>
</template>

<script>

  import pkg from '../package'

export default {
    middleware: 'auth',
    data () {
      return {
        open: false,
        clipped: true,
        drawer: true,
        fixed: true,
        items: [
          {
                icon: 'mdi-apps',
                title: 'Inicio',
                to: '/'
          },
          {
                icon: 'mdi-account',
                title: 'Usuarios',
                to: '/users'
          },
          {
                icon: 'mdi-domain',
                title: 'Empresas',
                to: '/empresas'
          },
            {
                icon: 'mdi-office',
                title: 'Oficinas',
                to: '/oficinas'
            },
            {
                icon: 'mdi-folder-edit-outline',
                title: 'Casos',
                to: '/casos'
            },
            {
                icon: 'mdi-folder-edit-outline',
                title: 'Estados Casos',
                to: '/estados'
            },
            {
                icon: 'mdi-file-chart',
                title: 'Reportes',
                to: '/reportes'
            }
        ],
        miniVariant: false,
        right: true,
        rightDrawer: false,
        title: pkg.name.toUpperCase()
      }
    },
    methods:{
        async logout(){
            try{
                await this.$auth.logout();

                this.$router.replace("/auth/login");

                this.notifySuccess('Listo','Salio del sistema');
                this.open=false;

            }catch (e) {
                console.log(e)
            }
        }
    }
}
</script>
