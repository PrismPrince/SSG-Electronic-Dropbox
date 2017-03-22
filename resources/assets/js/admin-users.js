/*!!
 * ===================================================================================================
 * SSG Electronic Dropbox (https://www.github.com/PrismPrince/SSG-Electronic-Dropbox)
 * Copyright 2017 Dave Dane Pacilan
 * Licensed under MIT (https://github.com/PrismPrince/SSG-Electronic-Dropbox/blob/master/LICENSE)
 * ===================================================================================================
 */

require('./bootstrap.js')

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

  methods: {

    getUsers() {

      this.full = 'loading'

      this.$http
        .post(window.location.origin + '/api/admin/user' + '?skip=' + this.skip + '&take=' + this.take, {
          student_id: this.student_id,
          name: this.name,
          email: this.email,
          role: this.role,
          status: this.status
        })

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

require('./app.js')
