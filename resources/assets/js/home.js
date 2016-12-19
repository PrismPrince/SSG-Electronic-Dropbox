Vue.mixin({
  data() {
    return {
      action: '',
      user: null,
      poll: {
        //
      },
      suggestion: {
        //
      },
      polls: [],
      suggestions: []
    }
  },
  created() {
    this.$http.get(document.getElementById('get-user').value + '?id=' + document.getElementById('code').value)
      .then((response) => {
        this.user = response.data
      }).catch((response) => {
        console.error(response.error)
      })
    this.getPosts()
  }
})

require('./post')
require('./logout')