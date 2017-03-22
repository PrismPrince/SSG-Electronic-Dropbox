/*!!
 * ===================================================================================================
 * SSG Electronic Dropbox (https://www.github.com/PrismPrince/SSG-Electronic-Dropbox)
 * Copyright 2017 Dave Dane Pacilan
 * Licensed under MIT (https://github.com/PrismPrince/SSG-Electronic-Dropbox/blob/master/LICENSE)
 * ===================================================================================================
 */

require('./../bootstrap.js')

require('./../mixins/_http-interceptor')
require('./../mixins/_get-auth-user')
require('./../mixins/_logout')
require('./../mixins/_quick-search')

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

require('./../app.js')
