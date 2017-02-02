Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', 'Bearer ' + document.getElementById('Authorization').value)

    next()

})

Vue.mixin({

  data() {

    return {

      // init
      user: null,
      users: [],
      skip: 0,
      take: 10,
      full: false,

    }

  }, // data

  created() {

    this.$http
      .get(window.location.origin + '/api/user')

      .then((response) => {

        this.user = response.data

      })

      .catch((response) => {

        console.error(response)

      })

  }, // created

  mounted() {

    this.getUsers()

  }, // mounted

  methods: {

    getUsers() {

      this.full = 'loading'

      this.$http
        .get(window.location.origin + '/api/admin/user' + '?skip=' + this.skip + '&take=' + this.take)

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

require('./quick-search')
require('./logout')