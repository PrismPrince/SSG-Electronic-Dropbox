Vue.mixin({

  data() {

    return {
      search: {
        key: '',
        focus: false,
        searching: false,
        results: {
          users: [],
          posts: [],
          polls: [],
          suggestions: [],
        }
      }
    }

  }, // data

  watch: {

    'search.key': function () {
      
      this.search.searching   = true
      this.search.focus       = true

      if (this.search.key != '') this.searching()

    }

  }, // watch

  methods: {

    searching: _.debounce(function () {
    
      this.$http
        .post(window.location.origin + '/api/search',
        {
          key: this.search.key
        })

        .then((response) => {

          this.search.results.users = response.data.users
          this.search.results.posts = response.data.posts
          this.search.results.polls = response.data.polls
          this.search.results.suggestions = response.data.suggestions

          this.$nextTick(function () {

            this.search.searching = false

          })

        })

        .catch((response) => {
          console.error(response.error)
        })
    
    }, 500), // searching

    clearSearch: _.debounce(function () {

      this.search.focus = false
      this.search.results.users = []
      this.search.results.posts = []
      this.search.results.polls = []
      this.search.results.suggestions = []

    }, 500), // clearSearch

    highlight(text) {

      var match = text.match(new RegExp(this.key, 'i'))

      if (!match) return text
      else var index = match.index

      if ( index >= 0 )text = text.substring(0, index) + "<span class='bg-primary'>" + text.substring(index, index + this.search.key.length) + "</span>" + text.substring(index + this.search.key.length)

      return text

    },

    searchKey() {

      window.location = window.location.origin + '/search?key=' + this.search.key

    }

  } // methods

})