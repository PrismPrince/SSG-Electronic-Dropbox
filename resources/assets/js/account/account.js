Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', 'Bearer ' + document.getElementById('Authorization').value)

    next()

})

Vue.mixin({
  data() {
    return {
      user: null
    }
  },

  created() {

    this.$http
      .get(window.location.origin + '/api/user')

      .then((response) => {

        this.user = response.data

      })

      .catch((response) => {

        console.error(response.error)

      })

  } // created

})

require('./../quick-search')
require('./../logout')