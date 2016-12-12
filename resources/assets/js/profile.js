Vue.mixin({
  data() {
    return {
      user: {
        first_name: '',
        middle_name: '',
        last_name: '',
        role: ''
      }
    }
  },
  created() {
    this.$http.post(document.getElementById('url').value,
      {
        id: document.getElementById('code').value
      }).then((response) => {
        this.user.first_name = response.data.fname
        this.user.middle_name = response.data.mname
        this.user.last_name = response.data.lname
        this.user.role = response.data.role

        // this.user.id = response.data.id
        console.log(response.data)
        console.log(true)
      }).catch((response) => {
        console.error(response.error)
      })
  }
})

require('./logout')