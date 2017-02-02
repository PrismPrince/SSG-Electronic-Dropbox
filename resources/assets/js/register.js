Vue.mixin({
  data() {
    return {
      user: null,
      student_id: '',
      code: '',
      first_name: '',
      middle_name: '',
      last_name: '',
      email: '',
      password: '',
      password_confirm: '',
      errors: {
        student_id: {
          dirty: false,
          status: false,
          text: ''
        },
        code: {
          dirty: false,
          status: false,
          text: ''
        },
        first_name: {
          dirty: false,
          status: false,
          text: ''
        },
        middle_name: {
          dirty: true,
          status: true,
          text: ''
        },
        last_name: {
          dirty: false,
          status: false,
          text: ''
        },
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
    student_id() {
      this.errors.student_id.dirty = true

      var id = this.student_id

      if (id == '') {
        this.errors.student_id.status = false
        this.errors.student_id.text = 'Student ID cannot be empty.'
      } else if (!/^[0-9]{7,7}$/i.test(id)) {
        this.errors.student_id.status = false
        this.errors.student_id.text = 'Enter a valid Student ID.'
      } else {
        this.errors.student_id.status = true
        this.errors.student_id.text = ''
      }
    },
    code() {
      this.errors.code.dirty = true

      var code = this.code

      if (code == '') {
        this.errors.code.status = false
        this.errors.code.text = 'Code cannot be empty.'
      } else if (!/^[0-9A-Z]{5,5}-[0-9A-Z]{5,5}$/.test(code)) {
        this.errors.code.status = false
        this.errors.code.text = 'Enter a valid code.'
      } else {
        this.errors.code.status = true
        this.errors.code.text = ''
      }
    },
    first_name() {
      this.errors.first_name.dirty = true

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
      this.errors.middle_name.dirty = true

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
      this.errors.last_name.dirty = true

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
      return (
        this.errors.student_id.status &&
        this.errors.code.status &&
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
    touch() {
      if (document.getElementById('errStudentId').value != '') {
        this.errors.student_id.dirty = true
        this.errors.student_id.status = true
        this.student_id = document.getElementById('errStudentId').value
      }
      if (document.getElementById('errCode').value != '') {
        this.errors.code.dirty = true
        this.errors.code.status = true
        this.code = document.getElementById('errCode').value
      }
      if (document.getElementById('errFname').value != '') {
        this.errors.first_name.dirty = true
        this.errors.first_name.status = true
        this.first_name = document.getElementById('errFname').value
      }
      if (document.getElementById('errMname').value != '') {
        this.middle_name = document.getElementById('errMname').value
      }
      if (document.getElementById('errLname').value != '') {
        this.errors.last_name.dirty = true
        this.errors.last_name.status = true
        this.last_name = document.getElementById('errLname').value
      }
      if (document.getElementById('errEmail').value != '') {
        this.errors.email.dirty = true
        this.errors.email.status = true
        this.email = document.getElementById('errEmail').value
      }
    },
    focusNext(selector) {
      document.getElementById(selector).focus()
    }
  },
  mounted() {
    this.touch()
  }
});