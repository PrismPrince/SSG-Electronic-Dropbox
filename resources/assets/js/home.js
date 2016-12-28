Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', 'Bearer ' + document.getElementById('Authorization').value);

    next();
});

Vue.mixin({
  data() {
    return {
      active: 'post',
      user: null
    }
  },
  created() {
    this.$http.get(window.location.origin + '/api/user')
      .then((response) => {
        this.user = response.data
      }).catch((response) => {
        console.error(response.error)
      })

      if (this.active == 'post') {
        this.getPosts()
      } else if (this.active == 'poll') {
      } else if (this.active == 'suggestion') {
        this.getSuggestions()
      } else {
        this.active = 'post'
      }

  },
  methods: {
    focusNext(target) {
      $(target).focus()
    },
    switchActivity(activity) {
      this.active = activity

      if (this.active == 'post') {
        this.clearPolls()
        this.clearSuggestions()
        this.getPosts()
      } else if (this.active == 'poll') {
        this.clearSuggestions()
        this.clearPosts()
        this.getPolls()
      } else if (this.active == 'suggestion') {
        this.clearPosts()
        this.clearPolls()
        this.getSuggestions()
      } else {
        this.active = 'post'
        this.clearPolls()
        this.clearSuggestions()
        this.getPosts()
      }
    },
    clearPosts() {
      this.post.id = null
      this.post.title = ''
      this.post.desc = ''
      this.post.disabled = true
      this.posts.skip = 0
      this.posts.take = 5
      this.posts.full = false
      this.posts.data = []
    },
    clearPolls() {
      this.poll.id = null
      this.poll.title = ''
      this.poll.desc = ''
      this.poll.start = ''
      this.poll.end = ''
      this.poll.type = ''
      this.poll.disabled = true
      this.polls.skip = 0
      this.polls.take = 5
      this.polls.full = false
      this.polls.data = []
    },
    clearSuggestions() {
      this.suggestion.id = null
      this.suggestion.title = ''
      this.suggestion.direct = ''
      this.suggestion.message = ''
      this.suggestion.disabled = true
      this.suggestions.skip = 0
      this.suggestions.take = 5
      this.suggestions.full = false
      this.suggestions.data = []
    }
  }
})

require('./post')
require('./poll')
require('./suggestion')
require('./logout')