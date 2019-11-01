

import Vue from 'vue'

Vue.mixin({
  methods:{

    consolaJs(data,...otherData) {
      if (process.env.DEBUG || true){
        console.log(data,otherData);
      }
    },
    errorToList(errors){
      var res ="<ul style='list-style-type: none; padding:0px;'>";


      const entries = Object.entries(errors);

      for (const [field, fieldErrors] of entries) {

        fieldErrors.forEach(function (value) {
          res = res+'<li style="margin-bottom: .5rem">'+value+'</li>';

        })
      }

      res= res+'<ul/>';

      return res;
    },

    notifySuccess(title,message){
      this.$notify.success({
        title: title,
        message: message
      })
    },
    notifyError(error){
      this.$notify.error({
        title: error,
        message: '',
        titleSize: 16
      })
    },
    notifyErrorList(errors){

      this.$notify.error({
        title: this.errorToList(errors),
        message: '',
        titleSize: 16
      })
    },
  }
})


export default ({ app }, inject) => {


  inject('myInjectedFunction', string => console.log('That was easy!', string));

}
