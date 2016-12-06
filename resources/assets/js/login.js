Vue.mixin({
  data() {
    return {
      email: document.getElementById('email').value,
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