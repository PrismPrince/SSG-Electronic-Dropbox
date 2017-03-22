/*!!
 * ===================================================================================================
 * SSG Electronic Dropbox (https://www.github.com/PrismPrince/SSG-Electronic-Dropbox)
 * Copyright 2017 Dave Dane Pacilan
 * Licensed under MIT (https://github.com/PrismPrince/SSG-Electronic-Dropbox/blob/master/LICENSE)
 * ===================================================================================================
 */

require('./bootstrap.js')

// helpers
require('./mixins/helpers/_focus')

Vue.mixin({
  data() {
    return {
      user: null,
      email: '',
      password: '',
      password_confirm: '',
      errors: {
        email: {
          dirty: false,
          status: false,
          text: ''
        },
        password: {
          dirty: false,
          status: false,
          text: ''
        },
        password_confirm: {
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
    },
    password() {
      this.errors.password.dirty = true

      var p = this.password

      if (p == '') {
        this.errors.password.status = false
        this.errors.password.text = 'Password cannot be empty.'
      } else if (p.length < 6) {
        this.errors.password.status = false
        this.errors.password.text = 'Password must be atleast 6 characters.'
      } else {
        this.errors.password.status = true
        this.errors.password.text = ''
      }
    },
    password_confirm() {
      this.errors.password_confirm.dirty = true

      var p = this.password
      var c = this.password_confirm

      if (c == '') {
        this.errors.password_confirm.status = false
        this.errors.password_confirm.text = 'Confirm your password.'
      } else if (p != c) {
        this.errors.password_confirm.status = false
        this.errors.password_confirm.text = 'Password does not match.'
      } else {
        this.errors.password_confirm.status = true
        this.errors.password_confirm.text = ''
      }
    }
  },
  computed: {
    btnDisabled() {
      return !(
        this.errors.email.status &&
        this.errors.password.status &&
        this.errors.password_confirm.status
      )
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
