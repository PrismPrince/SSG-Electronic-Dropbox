Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', 'Bearer ' + document.getElementById('Authorization').value)

    next()

})

Vue.mixin({
  data() {
    return {
      user: null,
      email: '',
      newEmail: '',
      errors: {
        newEmail: {
          dirty: false,
          status: false,
          text: ''
        }
      }
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

  }, // created

  mounted() {

    this.$http
      .get(window.location.origin + '/api/account/email')

      .then((response) => {

        this.email = response.data

      })

      .catch((response) => {

        console.error(response.error)

      })

  },

  watch: {
    newEmail() {
      this.errors.newEmail.dirty = true

      var e = this.newEmail
      var at = e.indexOf('@')
      var dot = e.lastIndexOf('.')

      if (e == '') {
        this.errors.newEmail.status = false
        this.errors.newEmail.text = 'E-mail address cannot be empty.'
      }
      else if (at < 1 || dot < at + 2 || dot + 2 >= e.length) {
        this.errors.newEmail.status = false
        this.errors.newEmail.text = 'Not a valid e-mail address.'
      }
      else {
        this.errors.newEmail.status = true
        this.errors.newEmail.text = ''
      }
    }
  },
  computed: {
    btnDisabled() {
      return !this.errors.newEmail.status
    }
  }
})

require('./../quick-search')
require('./../logout')