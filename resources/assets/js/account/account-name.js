require('./../mixins/_http-interceptor')
require('./../mixins/_logout')
require('./../mixins/_quick-search')

// helpers
require('./../mixins/helpers/_focus')

Vue.mixin({
  data() {
    return {
      user: null,
      first_name: '',
      middle_name: '',
      last_name: '',
      errors: {
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
        }
      }
    }
  },

  created() {

    this.$http
      .get(window.location.origin + '/api/auth/user')

      .then((response) => {

        this.user = response.data

        this.first_name = this.user.fname
        this.middle_name = this.user.mname
        this.last_name = this.user.lname

      })

      .catch((response) => {

        console.error(response.error)

      })

  }, // created

  watch: {
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
    }
  },
  computed: {
    btnDisabled() {
      return (
        this.errors.first_name.status &&
        this.errors.middle_name.status &&
        this.errors.last_name.status
      ) ? false : true
    }
  }
})
