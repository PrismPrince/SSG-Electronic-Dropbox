require('./partials/_http-interceptor')
require('./partials/_get-auth-user')
require('./partials/_logout')
require('./partials/_quick-search')

Vue.mixin({

  data() {

    return {

      // init
      user:           null,
      key:            '',
      year:           null,
      month:          null,
      active:         'post',
      skip:           0,
      take:           10,
      full:           false,

      // view data handlers
      dates:          [],
      users:          [],
      posts:          [],
      polls:          [],
      suggestions:    [],

    }

  }, // data

  created() {

    this.key = this.getKey()

  }, // created

  mounted() {

    this.getAct()
    this.getDates()

  }, // mounted

  methods: {

    getKey() {

      var urlVar = {};

      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {

        urlVar[key] = value;

      });

      if (urlVar.key == undefined)  return ''
      else                          return urlVar.key

    },

    switchActivity(activity) {

      this.active = activity

      this.clearUsers()
      this.clearPosts()
      this.clearPolls()
      this.clearSuggestions()

      this.getAct()

      if (this.active != 'user') this.getDates()

    }, // switchActivity

    clearUsers() {

      this.skip         = 0
      this.take         = 10
      this.full         = false
      this.year         = null
      this.month        = null
      this.dates        = []
      this.users        = []

    }, // clearUsers

    clearPosts() {

      this.skip         = 0
      this.take         = 10
      this.full         = false
      this.year         = null
      this.month        = null
      this.dates        = []
      this.posts        = []

    }, // clearPosts

    clearPolls() {

      this.skip         = 0
      this.take         = 10
      this.full         = false
      this.year         = null
      this.month        = null
      this.dates        = []
      this.polls        = []

    }, // clearPolls

    clearSuggestions() {

      this.skip         = 0
      this.take         = 10
      this.full         = false
      this.year         = null
      this.month        = null
      this.dates        = []
      this.suggestions  = []

    }, // clearSuggestions

    getActFromDate(year = null, month = null) {

      this.clearUsers()
      this.clearPosts()
      this.clearPolls()
      this.clearSuggestions()

      this.year = year
      this.month = month

      this.getAct()
      this.getDates()

    }, //getActFromDate

    getAct() {

      this.full = 'loading'

      this.$http
        .post(window.location.origin + '/api/search/' + this.active + '?skip=' + this.skip + '&take=' + this.take,
        {
          key: this.key,
          year: this.year,
          month: this.month
        })

        .then((response) => {

          this.skip += 10

          if      (this.active == 'user')         for (var i = 0; i <= response.data.length - 1; i++)     this.users.push(response.data[i])
          else if (this.active == 'post')         for (var i = 0; i <= response.data.length - 1; i++)     this.posts.push(response.data[i])
          else if (this.active == 'poll')         for (var i = 0; i <= response.data.length - 1; i++)     this.polls.push(response.data[i])
          else if (this.active == 'suggestion')   for (var i = 0; i <= response.data.length - 1; i++)     this.suggestions.push(response.data[i])

          if (response.data.length == 0 || response.data.length < 10)   this.full = true
          else                                                          this.full = false

        })

        .catch((response) => {

          console.error(response.error)

          this.full = false

        })

    }, // getAct

    getDates() {

      this.$http
        .get(window.location.origin + '/api/search/' + this.active + '/dates')

        .then((response) => {

          for (var i = 0; i <= response.data.length - 1; i++) this.dates.push(response.data[i])

        })

        .catch((response) => {

          console.error(response.error)

        })

    }, // getDates

    hl(text) {

      var match = text.match(new RegExp(this.key, 'i'))

      if (!match) return text
      else var index = match.index

      if (index >= 0) text = text.substring(0, index) + "<span class='bg-primary'>" + text.substring(index, index + this.key.length) + "</span>" + text.substring(index + this.key.length)

      return text

    }, // hl

    intToDate(year, int) {

      return moment([year, int - 1, 1]).format('MMMM')

    } // intToDate

  } //methods

})
