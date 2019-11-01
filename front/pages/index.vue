<template>
  <v-layout
    column
    justify-center
    align-center
  >
    <v-flex
      xs12
      sm8
      md6
    >
      <div class="text-center">
        <logo />
        <vuetify-logo />
      </div>
      <v-card>
        <v-card-title class="headline">
          BIENVENIDOS A SKYNET
        </v-card-title>
        <v-card-text>
          <v-card-title class="headline">
            MISION
          </v-card-title>
          <p>
            SkyNet es una empresa especializada en el diseño, desarrollo e implementación de gestion de casos y
            documentos. Nuestra misión es ofrecer soluciones avanzadas que permitan mejorar la competitividad y
            productividad, logrando el crecimiento organizacional de nuestros clientes.
          </p>
          <p>
            Nuestros servicios profesionales se distinguen por la atención personalizada a nuestros clientes,
            aplicando las mejores prácticas, procesos y tecnologías disponibles en el mercado.
          </p>
          <v-card-title class="headline">
            VISION
          </v-card-title>
          <p>
            Ser reconocidos como la mejor empresa de gestion de casos y documentos de Guatemala. Ser reconocida
            en el pais como una de las empresas líderes en automatizacion de procesos. Ser la empresa Guatemalteca
            con el mejor clima laboral y al mismo tiempo, un alto nivel de productividad.
          </p>
          <hr class="my-3">
          <p>
            Siguenos en:  &nbsp;&nbsp;&nbsp;<v-icon>mdi-instagram </v-icon> &nbsp;<v-icon>mdi-facebook-box</v-icon>&nbsp;&nbsp;@SkyNet
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Escribenos al:<v-icon>mdi-whatsapp</v-icon>5566-4232
          </p>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import Logo from '~/components/Logo.vue'
import VuetifyLogo from '~/components/VuetifyLogo.vue'

export default {
    middleware: 'auth',
    components: {
      Logo,
      VuetifyLogo
    }
}
</script>
