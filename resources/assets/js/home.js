Vue.mixin({
  data() {
    return {
      active: 'post',
      user: null
    }
  },
  created() {
    this.$http.get(document.getElementById('get-user').value + '?id=' + document.getElementById('code').value)
      .then((response) => {
        this.user = response.data
      }).catch((response) => {
        console.error(response.error)
      })

    if (this.active == 'post') {
      this.getPosts()
    } else if (this.active == 'poll') {
    } else if (this.active == 'suggestion') {
    } else {
      this.active = 'post'
    }

  },
  methods: {
    switchActivity(activity) {
      this.active = activity

      if (this.active == 'post') {
        this.getPosts()
      } else if (this.active == 'poll') {
      } else if (this.active == 'suggestion') {
      } else {
        this.active = 'post'
      }
    },
    clearPosts() {
      this.post.id = null
      this.post.title = ''
      this.post.description = ''
      this.post.disabled = true
      this.posts.skip = 0
      this.posts.take = 5
      this.posts.full = false
      this.posts.data = []
    },
    clearPolls() {},
    clearSuggestions() {}
  }
})

require('./post')
require('./logout')