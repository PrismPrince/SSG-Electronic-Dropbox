Vue.mixin({

  created() {

    this.$http
      .get(window.location.origin + '/api/auth/user')

      .then(response => {

        this.user = response.data

      })

      .catch(response => {

        console.error(response.status, response.statusText)

      })

  } // created

})