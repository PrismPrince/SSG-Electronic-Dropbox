require('./mixins/_http-interceptor')
require('./mixins/_get-auth-user')
require('./mixins/_logout')
require('./mixins/_quick-search')

Vue.mixin({

  data() {

    return {

      // init
      user: null,
      users: [],
      skip: 0,
      take: 10,
      full: false,
      new_student_id: '',
      error: null,
      errors: {
        new_student_id: {
          dirty: true,
          status: true,
          text: ''
        }
      },

      // search
      student_id: null,
      name: null,
      email: null,
      role: null,
      status: null

    }

  }, // data

  mounted() {

    this.getUsers()

  }, // mounted

  watch: {

    new_student_id() {
      this.errors.new_student_id.dirty = true

      var id = this.new_student_id

      if (id == '') {
        this.errors.new_student_id.status = true
        this.errors.new_student_id.text = ''
      } else if (!/^[0-9]{7,7}$/i.test(id)) {
        this.errors.new_student_id.status = false
        this.errors.new_student_id.text = 'Enter a valid Student ID.'
      } else {
        this.errors.new_student_id.status = true
        this.errors.new_student_id.text = ''
      }
    }

  },

  computed: {

    btnDisabled() {

      if (this.new_student_id == '') return true

      return !this.errors.new_student_id.status

    }

  },

  methods: {

    getUsers() {

      this.full = 'loading'

      this.$http
        .get(window.location.origin + '/api/admin/user/code' + '?skip=' + this.skip + '&take=' + this.take + '&key=' + this.student_id)

        .then(response => {

          this.skip += 10

          for (var i = 0; i <= response.data.length - 1; i++) this.users.push(response.data[i])

          if (response.data.length == 0 || response.data.length < 10) this.full = true
          else this.full = false

        })

        .catch(response => {
          console.error(response)
          this.full = false
        })

    },

    createCode() {

      if (!this.btnDisabled)
        this.$http
          .post(window.location.origin + '/api/admin/user/code', {
            new_student_id: this.new_student_id
          })

          .then(response => {

            this.skip++
            this.new_student_id = ''
            this.users.splice(0, 0, response.data)

          })

          .catch(response => {

            if (response.status == 422)
              this.error = response.data.new_student_id[0]

          })

    },

    resetUsers() {

      this.clearUserSearch()
      this.users = []
      this.skip = 0
      this.take = 10
      this.full = false

      this.getUsers()

    },

    clearUserSearch() {

      this.student_id = null
      this.name = null
      this.email = null
      this.role = null
      this.status = null

    },

    searchUsers() {

      this.users = []
      this.skip = 0
      this.take = 10
      this.full = false

      this.getUsers()

    },

    toggleStatus(id, status) {

      this.$http
        .post(window.location.origin + '/api/admin/user/status', {id: id, status: status})

        .then(response => {

          var i = _.indexOf(this.users, _.find(this.users, {id: response.data.id}))

          this.users.splice(i, 1, response.data)

        })
        .catch(response => {
          console.error(response)
        })

    }

  },

  filters: {

    formatDateTimeNormal(date) {

      return moment(date).format('MMM D, YYYY [at] h:mm a')

    }

  }

})
