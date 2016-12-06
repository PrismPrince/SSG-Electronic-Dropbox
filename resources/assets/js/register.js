Vue.mixin({
  data() {
    return {
      first_name: document.getElementById('first-name').value,
      middle_name: document.getElementById('middle-name').value,
      last_name: document.getElementById('last-name').value,
      email: document.getElementById('email').value,
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