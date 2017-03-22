/*!!
 * ===================================================================================================
 * SSG Electronic Dropbox (https://www.github.com/PrismPrince/SSG-Electronic-Dropbox)
 * Copyright 2017 Dave Dane Pacilan
 * Licensed under MIT (https://github.com/PrismPrince/SSG-Electronic-Dropbox/blob/master/LICENSE)
 * ===================================================================================================
 */

require('./bootstrap.js')

Vue.mixin({
  data() {
    return {
      user: null,
      email: '',
      errors: {
        email: {
          dirty: false,
          status: false,
          text: ''
        }
      }
    }
  },
  watch: {
    email() {
      this.errors.email.dirty = true

      var e = this.email
      var at = e.indexOf('@')
      var dot = e.lastIndexOf('.')

      if (e == '') {
        this.errors.email.status = false
        this.errors.email.text = 'E-mail address cannot be empty.'
      }
      else if (at < 1 || dot < at + 2 || dot + 2 >= e.length) {
        this.errors.email.status = false
        this.errors.email.text = 'Not a valid e-mail address.'
      }
      else {
        this.errors.email.status = true
        this.errors.email.text = ''
      }
    }
  },
  computed: {
    btnDisabled() {
      return !this.errors.email.status
    }
  },
  methods: {
    touch() {
      if (document.getElementById('errEmail').value != '') {
        this.errors.email.dirty = true
        this.errors.email.status = true
        this.email = document.getElementById('errEmail').value
      }
    }
  },
  mounted() {
    this.touch()
  }
})

require('./app.js')
