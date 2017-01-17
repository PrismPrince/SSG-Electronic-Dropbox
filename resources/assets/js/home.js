Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', 'Bearer ' + document.getElementById('Authorization').value)

    next()

})

Vue.mixin({

  data() {

    return {

      // init
      user:         null,
      active:       'post',
      action:       '',
      skip:         0,
      take:         5,
      full:         false,
      disabled:     true,
      loadmore:     false,

      // view data handlers
      posts:        [],
      polls:        [],
      suggestions:  [],

      // post modification handler
      post: {
        id:         null,
        title:      '',
        desc:       ''
        // error: {}
      },

      // poll modification handler
      poll: {
        id:         null,
        title:      '',
        desc:       '',
        start:      '',
        end:        '',
        type:       '',
        status:     '',
        answer:     '',
        answers:    []
        // error: {}
      },

      // suggestion modification handler
      suggestion: {
        id:         null,
        title:      '',
        direct:     '',
        message:    ''
        // error: {}
      }

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

    $('[data-toggle="tooltip"]').tooltip()

  }, // created

  mounted() {

    this.getAct()

  }, // mounted

  methods: {

    enableFieldset() {

      this.disabled = false

    }, // enableFieldset

    disableFieldset() {

      this.disabled = true

    }, // disableFieldset

    focus(target) {

      $(target).focus()

    }, // focus

    showModal(selector, action = '', id = null, data = {}) {

      var vm = this

      vm.action = action
      vm.enableFieldset()

      if (selector == '#post-modal') {
        vm.post.id       =  id
        vm.post.title    =  data.title    == undefined ? '' : data.title
        vm.post.desc     =  data.desc     == undefined ? '' : data.desc

      } else if (selector == '#poll-modal') {
        vm.poll.id       =  id
        vm.poll.title    =  data.title    == undefined ? '' : data.title
        vm.poll.desc     =  data.desc     == undefined ? '' : data.desc
        vm.poll.type     =  data.type     == undefined ? '' : data.type
        vm.poll.status   =  data.status   == undefined ? '' : data.status
        vm.poll.answer   =  data.answer   == undefined ? '' : data.answer
        vm.poll.answers  =  data.answers  == undefined ? [] : data.answers

        // init datetime picker
        if (data.start == undefined && data.end == undefined) {
          $('#poll-start').datetimepicker({
            format: 'MMM D, YYYY h:mm a'
          })

          $('#poll-end').datetimepicker({
            format: 'MMM D, YYYY h:mm a'
          })

          vm.poll.start  = ''
          vm.poll.end    = ''

        } else {
          $('#poll-start').datetimepicker({
            format:       'MMM D, YYYY h:mm a',
            defaultDate:  moment(data.start, 'YYYY-MM-DD HH:mm:ss')
          })

          $('#poll-end').datetimepicker({
            format:       'MMM D, YYYY h:mm a',
            defaultDate:  moment(data.end, 'YYYY-MM-DD HH:mm:ss')
          })

          vm.poll.start  = moment(data.start, 'YYYY-MM-DD HH:mm:ss').format('MMM D, YYYY h:mm a')
          vm.poll.end    = moment(data.end, 'YYYY-MM-DD HH:mm:ss').format('MMM D, YYYY h:mm a')
        }

        // change event on datetime picker
        $("#poll-start").on("dp.change", function (e) {
          vm.poll.start  = e.date.format('MMM D, YYYY h:mm a')
        })

        $("#poll-end").on("dp.change", function (e) {
          vm.poll.end    = e.date.format('MMM D, YYYY h:mm a')
        })

      } else if (selector == '#suggestion-modal') {
        vm.suggestion.id       =  id
        vm.suggestion.title    =  data.title    == undefined ? '' : data.title
        vm.suggestion.direct   =  data.direct   == undefined ? '' : data.direct
        vm.suggestion.message  =  data.message  == undefined ? '' : data.message

      } else if (selector == '#confirm-post-modal') {
        vm.post.id = id

      } else if (selector == '#confirm-poll-modal') {
        vm.poll.id = id

      } else if (selector == '#confirm-suggestion-modal') {
        vm.suggestion.id = id

      }

      $(selector).modal('show')

    }, // showModal

    hideModal(selector) {

      var vm = this

      $(selector).modal('hide')

      $(selector).on('hidden.bs.modal', function () {
        vm.clearPost()
        vm.clearPoll()
        vm.clearSuggestion()
        vm.disableFieldset()
        vm.action = ''

      })

    }, // hideModal

    switchActivity(activity) {
      this.active = activity

      this.clearPost()
      this.clearPosts()
      this.clearPoll()
      this.clearPolls()
      this.clearSuggestion()
      this.clearSuggestions()

      if (this.active == 'post') {
        this.getAct()

      } else if (this.active == 'poll') {
        this.getAct()

      } else if (this.active == 'suggestion') {
        this.getAct()

      }

    }, // switchActivity

    clearPost() {

      this.post.id              = null
      this.post.title           = ''
      this.post.desc            = ''

    }, // clearPost

    clearPosts() {

      this.skip                 = 0
      this.take                 = 5
      this.full                 = false
      this.posts                = []

    }, // clearPosts

    clearPoll() {

      this.poll.id              = null
      this.poll.title           = ''
      this.poll.desc            = ''
      this.poll.start           = ''
      this.poll.end             = ''
      this.poll.type            = ''
      this.poll.status          = ''
      this.poll.answer          = ''
      this.poll.answers         = []

    }, // clearPoll

    clearPolls() {

      this.skip                 = 0
      this.take                 = 5
      this.full                 = false
      this.polls                = []

    }, // clearPolls

    clearSuggestion() {

      this.suggestion.id        = null
      this.suggestion.title     = ''
      this.suggestion.direct    = ''
      this.suggestion.message   = ''

    }, // clearSuggestion

    clearSuggestions() {

      this.skip                 = 0
      this.take                 = 5
      this.full                 = false
      this.suggestions          = []

    }, // clearSuggestions

    getAct() {

      this.loadmore = true

      this.$http
        .get(window.location.origin + '/api/' + this.active + '?skip=' + this.skip + '&take=' + this.take)

        .then((response) => {
          if (response.data.length == 0 || response.data.length < 5) this.full = true

          this.skip += 5

          if      (this.active == 'post')         for (var i = 0; i <= response.data.length - 1; i++)     this.posts.push(response.data[i])
          else if (this.active == 'poll')         for (var i = 0; i <= response.data.length - 1; i++)     this.polls.push(response.data[i])
          else if (this.active == 'suggestion')   for (var i = 0; i <= response.data.length - 1; i++)     this.suggestions.push(response.data[i])

          this.loadmore = false

        })

        .catch((response) => {
          console.error(response.error)

          this.loadmore = false

        })

    }, // getAct

    storeAct(data) {

      this.$http
        .post(window.location.origin + '/api/' + this.active, data)

        .then((response) => {

          this.skip++

          if (this.active == 'post') {
            this.hideModal('#post-modal')
            this.posts.splice(0, 0, response.data)

          } else if (this.active == 'poll') {
            this.hideModal('#poll-modal')
            this.polls.splice(0, 0, response.data)

          } else if (this.active == 'suggestion') {
            this.hideModal('#suggestion-modal')
            this.suggestions.splice(0, 0, response.data)

          }

        })

        .catch((response) => {
          console.error(response.error)

        })

    }, // storeAct

    edit(id) {

      this.$http
        .get(window.location.origin + '/api/' + this.active + '/' + id + '/edit')

        .then((response) => {

          if (this.active == 'post') {
            this.showModal('#post-modal', 'Update', response.data.id,
              {
                title:    response.data.title,
                desc:     response.data.desc
              }
            )

          } else if (this.active == 'poll') {
            this.showModal('#poll-modal', 'Update', response.data.id,
              {
                title:    response.data.title,
                desc:     response.data.desc,
                start:    response.data.start,
                end:      response.data.end,
                status:   response.data.status,
                type:     response.data.type,
                answers:  response.data.answers
              }
            )

          } else if (this.active == 'suggestion') {
            this.showModal('#suggestion-modal', 'Update', response.data.id,
              {
                title:    response.data.title,
                direct:   response.data.direct,
                message:  response.data.message
              }
            )

          }

        })

        .catch((response) => {
          console.error(response.error)

        })

    }, // edit

    updateAct(id, data) {

      this.$http
        .put(window.location.origin + '/api/' + this.active + '/' + id, data)

        .then((response) => {
          if (this.active == 'post') {
            this.hideModal('#post-modal')

            var i = _.indexOf(this.posts, _.find(this.posts, {id: response.data.id}))

            this.posts.splice(i, 1, response.data)

          } else if (this.active == 'poll') {
            this.hideModal('#poll-modal')

            var i = _.indexOf(this.polls, _.find(this.polls, {id: response.data.id}))

            this.polls.splice(i, 1, response.data)

          } else if (this.active == 'suggestion') {
            this.hideModal('#suggestion-modal')

            var i = _.indexOf(this.suggestions, _.find(this.suggestions, {id: response.data.id}))

            this.suggestions.splice(i, 1, response.data)

          }

        })

        .catch((response) => {
          console.error(response.error)
        })

    }, // updateAct

    destroy() {

      if      (this.active == 'post')         var id = this.post.id
      else if (this.active == 'poll')         var id = this.poll.id
      else if (this.active == 'suggestion')   var id = this.suggestion.id

      this.$http
        .delete(window.location.origin + '/api/' + this.active + '/' + id)

        .then((response) => {
          this.skip--

          if (this.active == 'post') {
            var i = _.indexOf(this.posts, _.find(this.posts, {id: response.data.id}))

            this.posts.splice(i, 1)

          } else if (this.active == 'poll') {
            var i = _.indexOf(this.polls, _.find(this.polls, {id: response.data.id}))

            this.polls.splice(i, 1)

          } else if (this.active == 'suggestion') {
            var i = _.indexOf(this.suggestions, _.find(this.suggestions, {id: response.data.id}))

            this.suggestions.splice(i, 1)

          }

          this.hideModal('#confirm-' + this.active + '-modal')

        })
        .catch((response) => {
          console.error(response.error)

        })

    }, // destroy

    submitAct() {

      this.disableFieldset()

      if (this.active == 'post') {
        var id = this.post.id

        var data    = {
          title:    this.post.title,
          desc:     this.post.desc
        }

      } else if (this.active == 'poll') {
        var id = this.poll.id

        var data    = {
          title:    this.poll.title,
          desc:     this.poll.desc,
          start:    this.poll.start,
          end:      this.poll.end,
          status:   this.poll.status,
          type:     this.poll.type,
          answers:  this.poll.answers
        }

      } else if (this.active == 'suggestion') {
        var id = this.suggestion.id

        var data    = {
          title:    this.suggestion.title,
          direct:   this.suggestion.direct,
          message:  this.suggestion.message
        }

      }

      if (this.action == 'Update')  this.updateAct(id, data)
      else                          this.storeAct(data)

    },

    addAnswer(answer) {

      if (answer == '') return

      if (typeof(answer) == 'object') {
        this.poll.answers.push(answer)
        this.poll.answer = ''

      } else {
        this.poll.answers.push({id: null, answer: answer})
        this.poll.answer = ''

      }

    }, // addAnswer

    removeAnswer(key) {

      this.poll.answers.splice(key, 1)

    } // removeAnswer

  } //methods

})

require('./logout')