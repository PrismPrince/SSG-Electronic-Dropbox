Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', 'Bearer ' + document.getElementById('Authorization').value)

    next()

})

Vue.mixin({

  data() {

    return {

      // init
      user:           null,
      key:            '',
      active:         'post',
      skip:           0,
      take:           3,
      full:           false,

      // view data handlers
      users:          [],
      posts:          [],
      polls:          [],
      suggestions:    [],

    }

  }, // data

  created() {

    this.$http
      .get(window.location.origin + '/api/user')

      .then((response) => {
        this.user = response.data

      })

      .catch((response) => {
        console.error(response.error)

      })

    this.key = this.getKey()

  }, // created

  mounted() {

    this.getAct()

  }, // mounted

  watch: {

  }, // watch

  computed: {

  }, // computed

  methods: {

    getKey() {

      var urlVar = {};

      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {

        urlVar[key] = value;

      });

      if (urlVar.key == undefined)  return this.search.key
      else                          return urlVar.key;

    },

    switchActivity(activity) {

      this.active = activity

      this.clearUsers()
      this.clearPosts()
      this.clearPolls()
      this.clearSuggestions()

      if (this.active == 'user') {
        this.getAct()

      } else if (this.active == 'post') {
        this.getAct()

      } else if (this.active == 'poll') {
        this.getAct()

      } else if (this.active == 'suggestion') {
        this.getAct()

      }

    }, // switchActivity

    clearUsers() {

      this.skip                               = 0
      this.take                               = 5
      this.full                               = false
      this.users                              = []

    }, // clearUsers

    clearPosts() {

      this.skip                               = 0
      this.take                               = 5
      this.full                               = false
      this.posts                              = []

    }, // clearPosts

    clearPolls() {

      this.skip                               = 0
      this.take                               = 5
      this.full                               = false
      this.polls                              = []

    }, // clearPolls

    clearSuggestions() {

      this.skip                               = 0
      this.take                               = 5
      this.full                               = false
      this.suggestions                        = []

    }, // clearSuggestions

    getAct() {

      this.full = 'loading'

      this.$http
        .post(window.location.origin + '/api/search/' + this.active + '?skip=' + this.skip + '&take=' + this.take,
        {
          key: this.key
        })

        .then((response) => {

          this.skip += 3

          if      (this.active == 'user')         for (var i = 0; i <= response.data.length - 1; i++)     this.users.push(response.data[i])
          else if (this.active == 'post')         for (var i = 0; i <= response.data.length - 1; i++)     this.posts.push(response.data[i])
          else if (this.active == 'poll')         for (var i = 0; i <= response.data.length - 1; i++)     this.polls.push(response.data[i])
          else if (this.active == 'suggestion')   for (var i = 0; i <= response.data.length - 1; i++)     this.suggestions.push(response.data[i])

          // this.$nextTick(function () {
          if (response.data.length == 0 || response.data.length < 5)  this.full = true
          else                                                        this.full = false
          // })

        })

        .catch((response) => {
          console.error(response.error)

          this.full = false

        })

    }, // getAct

    hl(text) {

      var match = text.match(new RegExp(this.key, 'i'))

      if (!match) return text
      else var index = match.index

      if (index >= 0) text = text.substring(0, index) + "<span class='bg-primary'>" + text.substring(index, index + this.key.length) + "</span>" + text.substring(index + this.key.length)

      return text

    }

  } //methods

})

require('./quick-search')
require('./logout')