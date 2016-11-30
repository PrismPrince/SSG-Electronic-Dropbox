
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('alert-danger', require('./components/alert-danger.vue'));
Vue.component('navbar-hamburger', require('./components/navbar/hamburger.vue'));

if ($('#login-form').length) {
  var email = document.getElementById('email').value

  Vue.mixin({
    data() {
      return {
        email: email,
        password: '',
        errors: {
          email: {
            changed: false,
            status: false,
            text: ''
          },
          password: {
            changed: false,
            status: false,
            text: ''
          }
        },
        btnDisabled: true
      }
    },
    watch: {
      email() {
        this.errors.email.changed = true

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
        this.errors.password.changed = true

        if (this.password == '') {
          this.errors.password.status = false
          this.errors.password.text = 'Password cannot be empty.'
        }
        else {
          this.errors.password.status = true
          this.errors.password.text = ''
        }
      }
    },
    computed: {
      btnDisabled() {
        return (
          this.errors.email.status &&
          this.errors.password.status
        ) ? false : true
      }
    },
    methods: {
      focusPassword() {
        document.getElementById('password').focus()
      }
    }
  });
} else if ($('#registration-form').length) {
  var first_name = document.getElementById('first-name').value
  var middle_name = document.getElementById('middle-name').value
  var last_name = document.getElementById('last-name').value
  var email = document.getElementById('email').value

  Vue.mixin({
    data() {
      return {
        first_name: first_name,
        middle_name: middle_name,
        last_name: last_name,
        email: email,
        password: '',
        password_confirm: '',
        errors: {
          first_name: {
            changed: false,
            status: false,
            text: ''
          },
          middle_name: {
            changed: true,
            status: true,
            text: ''
          },
          last_name: {
            changed: false,
            status: false,
            text: ''
          },
          email: {
            changed: false,
            status: false,
            text: ''
          },
          password: {
            changed: false,
            status: false,
            text: ''
          },
          password_confirm: {
            changed: false,
            status: false,
            text: ''
          }
        },
        btnDisabled: true
      }
    },
    watch: {
      first_name() {
        this.errors.first_name.changed = true

        var f = this.first_name

        if (f == '') {
          this.errors.first_name.status = false
          this.errors.first_name.text = 'First name cannot be empty.'
        } else if (!/^\b[a-z\s-]+\b$/i.test(f)) {
          this.errors.first_name.status = false
          this.errors.first_name.text = 'Enter a valid name.'
        } else {
          this.errors.first_name.status = true
          this.errors.first_name.text = ''
        }
      },
      middle_name() {
        this.errors.middle_name.changed = true

        var m = this.middle_name

        if (!/^\b[a-z\s-]+\b$|^$/i.test(m)) {
          this.errors.middle_name.status = false
          this.errors.middle_name.text = 'Enter a valid name.'
        } else {
          this.errors.middle_name.status = true
          this.errors.middle_name.text = ''
        }
      },
      last_name() {
        this.errors.last_name.changed = true

        var l = this.last_name

        if (l == '') {
          this.errors.last_name.status = false
          this.errors.last_name.text = 'First name cannot be empty.'
        } else if (!/^\b[a-z\s-]+\b$/i.test(l)) {
          this.errors.last_name.status = false
          this.errors.last_name.text = 'Enter a valid name.'
        } else {
          this.errors.last_name.status = true
          this.errors.last_name.text = ''
        }
      },
      email() {
        this.errors.email.changed = true

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
        this.errors.password.changed = true

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
        this.errors.password_confirm.changed = true

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
        return (
          this.errors.first_name.status &&
          this.errors.middle_name.status &&
          this.errors.last_name.status &&
          this.errors.email.status &&
          this.errors.password.status &&
          this.errors.password_confirm.status
        ) ? false : true
      }
    },
    methods: {
      focusMiddleName() {
        document.getElementById('middle-name').focus()
      },

      focusLastName() {
        document.getElementById('last-name').focus()
      },

      focusEmail() {
        document.getElementById('email').focus()
      },

      focusPassword() {
        document.getElementById('password').focus()
      },

      focusPasswordConfirm() {
        document.getElementById('password-confirm').focus()
      }
    }
  });
} // else var mixin = {};

const app = new Vue({
  el: '#app',
  methods: {
    logout() {
      document.getElementById('logout-form').submit();
    }
  }
});
