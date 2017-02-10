// helpers
require('./mixins/helpers/_focus')

Vue.mixin({
  data() {
    return {
      user: null,
      email: '',
      password: '',
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
});