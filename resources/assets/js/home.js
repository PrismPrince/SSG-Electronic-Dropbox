Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', 'Bearer ' + document.getElementById('Authorization').value)

    next()

})

Vue.mixin({

  data() {

    return {

      // init
      user:           null,
      active:         'post',
      action:         '',
      skip:           0,
      take:           5,
      full:           false,
      disabled:       true,

      // view data handlers
      posts:          [],
      polls:          [],
      suggestions:    [],

      // post modification handler
      post: {
        id:           null,
        title:        '',
        desc:         '',
        errors: {

          title: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          desc: {

            dirty:    false,
            status:   false,
            text:     ''

          }

        }

      },

      // poll modification handler
      poll: {
        id:           null,
        title:        '',
        desc:         '',
        start:        '',
        end:          '',
        type:         '',
        answer:       '',
        answers:      [],
        errors: {

          title: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          desc: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          start: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          end: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          type: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          answer: {

            dirty:    false,
            status:   false,
            text:     ''

          },

        }

      },

      // suggestion modification handler
      suggestion: {
        id:           null,
        title:        '',
        direct:       '',
        message:      '',
        errors: {

          title: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          direct: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          message: {

            dirty:    false,
            status:   false,
            text:     ''

          }

        }

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

  }, // created

  mounted() {

    this.getAct()

  }, // mounted

  watch: {

    'post.title': function () {

      this.post.errors.title.dirty              = true

      if (this.post.title == '') {
        this.post.errors.title.status           = false
        this.post.errors.title.text             = 'Title cannot be empty.'
      } else {
        this.post.errors.title.status           = true
        this.post.errors.title.text             = ''
      }

    }, // post.title

    'post.desc': function () {

      this.post.errors.desc.dirty               = true

      if (this.post.desc == '') {
        this.post.errors.desc.status            = false
        this.post.errors.desc.text              = 'Description cannot be empty.'
      } else {
        this.post.errors.desc.status            = true
        this.post.errors.desc.text              = ''
      }

    }, // post.desc

    'poll.title': function () {

      this.poll.errors.title.dirty              = true

      if (this.poll.title == '') {
        this.poll.errors.title.status           = false
        this.poll.errors.title.text             = 'Title cannot be empty.'

      } else {
        this.poll.errors.title.status           = true
        this.poll.errors.title.text             = ''

      }

    }, // poll.title

    'poll.desc': function () {

      this.poll.errors.desc.dirty               = true

      if (this.poll.desc == '') {
        this.poll.errors.desc.status            = false
        this.poll.errors.desc.text              = 'Description cannot be empty.'

      } else {
        this.poll.errors.desc.status            = true
        this.poll.errors.desc.text              = ''

      }

    }, // poll.desc

    'poll.start': function () {

      this.poll.errors.start.dirty              = true

      var start                                 = moment(this.poll.start, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.end == '') var end          = ''
      else                     var end          = moment(this.poll.end, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.start == '') {
        this.poll.errors.start.status           = false
        this.poll.errors.start.text             = 'Start date cannot be empty.'
      } else if (moment().isAfter(start)) {
        this.poll.errors.start.status           = false
        this.poll.errors.start.text             = 'Start date must set after current date.'
      } else if (moment(start).isAfter(end)) {
        this.poll.errors.start.status           = false
        this.poll.errors.start.text             = 'Start date must set before end date.'
      } else {
        this.poll.errors.start.status           = true
        this.poll.errors.start.text             = ''
      }

    }, // poll.start

    'poll.end': function () {

      this.poll.errors.end.dirty                = true

      if (this.poll.start == '')  var start     = ''
      else                        var start     = moment(this.poll.start, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      var end                                   = moment(this.poll.end, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.end == '') {
        this.poll.errors.end.status             = false
        this.poll.errors.end.text               = 'End date cannot be empty.'
      } else if (moment().isAfter(end)) {
        this.poll.errors.end.status             = false
        this.poll.errors.end.text               = 'End date must set after start date.'
      } else if (moment(end).isBefore(start)) {
        this.poll.errors.end.status             = false
        this.poll.errors.end.text               = 'End date must set after start date.'
      } else {
        this.poll.errors.end.status             = true
        this.poll.errors.end.text               = ''
      }

    }, // poll.end

    'poll.type': function () {

      this.poll.errors.type.dirty               = true

      if (this.poll.type == '') {
        this.poll.errors.type.status            = false
        this.poll.errors.type.text              = 'Select a type.'

      } else {
        this.poll.errors.type.status            = true
        this.poll.errors.type.text              = ''

      }

    }, // poll.type

    'poll.answer': function () {

      this.poll.errors.answer.dirty             = true

      if (this.poll.answers.length == 0) {
        this.poll.errors.answer.status          = false
        this.poll.errors.answer.text            = 'Add answers.'

      } else if (this.poll.answers.length < 2) {
        this.poll.errors.answer.status          = false
        this.poll.errors.answer.text            = 'Must have atleast two answers.'

      } else {
        this.poll.errors.answer.status          = true
        this.poll.errors.answer.text            = ''

      }

    }, // poll.answer

    'suggestion.title': function () {

      this.suggestion.errors.title.dirty        = true

      if (this.suggestion.title == '') {
        this.suggestion.errors.title.status     = false
        this.suggestion.errors.title.text       = 'Title cannot be empty.'

      } else {
        this.suggestion.errors.title.status     = true
        this.suggestion.errors.title.text       = ''

      }

    }, // suggestion.title

    'suggestion.direct': function () {

      this.suggestion.errors.direct.dirty       = true

      if (this.suggestion.direct == '') {
        this.suggestion.errors.direct.status    = false
        this.suggestion.errors.direct.text      = 'Direct cannot be empty.'

      } else {
        this.suggestion.errors.direct.status    = true
        this.suggestion.errors.direct.text      = ''

      }

    }, // suggestion.direct

    'suggestion.message': function () {

      this.suggestion.errors.message.dirty      = true

      if (this.suggestion.message == '') {
        this.suggestion.errors.message.status   = false
        this.suggestion.errors.message.text     = 'Message cannot be empty.'

      } else {
        this.suggestion.errors.message.status   = true
        this.suggestion.errors.message.text     = ''

      }

    } // suggestion.message

  }, // watch

  computed: {

    'pollstatus': function () {

      if (this.poll.start == '')  var start   = ''
      else                        var start   = moment(this.poll.start, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')
      if (this.poll.end == '')    var end     = ''
      else                        var end     = moment(this.poll.end, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if      (moment().isAfter(start)  && moment().isBefore(end))        return 'active'
      else if (moment().isBefore(start) && moment(start).isBefore(end))   return 'pending'
      else if (moment().isAfter(end)    && moment(end).isAfter(start))    return 'expired'
      else                                                                return 'invalid date range'

    }, // pollstatus

    btnPostDisabled() {

      return (
        this.post.errors.title.status &&
        this.post.errors.desc.status
      ) ? false : true;

    }, // btnPostDisabled

    btnPollDisabled() {

      return (
        this.poll.errors.title.status &&
        this.poll.errors.desc.status &&
        this.poll.errors.start.status &&
        this.poll.errors.end.status &&
        this.poll.errors.type.status &&
        this.poll.errors.answer.status
      ) ? false : true;

    }, // btnPollDisabled

    btnSuggestionDisabled() {

      return (
        this.suggestion.errors.title.status &&
        this.suggestion.errors.direct.status &&
        this.suggestion.errors.message.status
      ) ? false : true;

    } // btnSuggestionDisabled

  }, // computed

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

      this.post.id                            = null
      this.post.title                         = ''
      this.post.desc                          = ''
      
      this.post.errors.title.dirty            = false
      this.post.errors.title.status           = false
      this.post.errors.title.text             = ''

      this.post.errors.desc.dirty             = false
      this.post.errors.desc.status            = false
      this.post.errors.desc.text              = ''

    }, // clearPost

    clearPosts() {

      this.skip                               = 0
      this.take                               = 5
      this.full                               = false
      this.posts                              = []

    }, // clearPosts

    clearPoll() {

      this.poll.id                            = null
      this.poll.title                         = ''
      this.poll.desc                          = ''
      this.poll.start                         = ''
      this.poll.end                           = ''
      this.poll.type                          = ''
      this.poll.status                        = ''
      this.poll.answer                        = ''
      this.poll.answers                       = []

      this.poll.errors.title.dirty            = false
      this.poll.errors.title.status           = false
      this.poll.errors.title.text             = ''

      this.poll.errors.desc.dirty             = false
      this.poll.errors.desc.status            = false
      this.poll.errors.desc.text              = ''

      this.poll.errors.start.dirty            = false
      this.poll.errors.start.status           = false
      this.poll.errors.start.text             = ''

      this.poll.errors.end.dirty              = false
      this.poll.errors.end.status             = false
      this.poll.errors.end.text               = ''

      this.poll.errors.type.dirty             = false
      this.poll.errors.type.status            = false
      this.poll.errors.type.text              = ''

      this.poll.errors.answer.dirty           = false
      this.poll.errors.answer.status          = false
      this.poll.errors.answer.text            = ''

    }, // clearPoll

    clearPolls() {

      this.skip                               = 0
      this.take                               = 5
      this.full                               = false
      this.polls                              = []

    }, // clearPolls

    clearSuggestion() {

      this.suggestion.id                      = null
      this.suggestion.title                   = ''
      this.suggestion.direct                  = ''
      this.suggestion.message                 = ''

      this.suggestion.errors.title.dirty      = false
      this.suggestion.errors.title.status     = false
      this.suggestion.errors.title.text       = ''

      this.suggestion.errors.direct.dirty     = false
      this.suggestion.errors.direct.status    = false
      this.suggestion.errors.direct.text      = ''

      this.suggestion.errors.message.dirty    = false
      this.suggestion.errors.message.status   = false
      this.suggestion.errors.message.text     = ''

    }, // clearSuggestion

    clearSuggestions() {

      this.skip                               = 0
      this.take                               = 5
      this.full                               = false
      this.suggestions                        = []

    }, // clearSuggestions

    getAct() {

      this.full = 'loading'

      this.$http
        .get(window.location.origin + '/api/' + this.active + '?skip=' + this.skip + '&take=' + this.take)

        .then((response) => {

          this.skip += 5

          if      (this.active == 'post')         for (var i = 0; i <= response.data.length - 1; i++)     this.posts.push(response.data[i])
          else if (this.active == 'poll')         for (var i = 0; i <= response.data.length - 1; i++)     this.polls.push(response.data[i])
          else if (this.active == 'suggestion')   for (var i = 0; i <= response.data.length - 1; i++)     this.suggestions.push(response.data[i])

          if (response.data.length == 0 || response.data.length < 5)  this.full = true
          else                                                        this.full = false

        })

        .catch((response) => {
          console.error(response.error)

          this.full = false

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

      this.touch()

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

    touch() {

      if (this.active == 'post') {
        this.post.errors.title.dirty            = true
        this.post.errors.title.status           = true

        this.post.errors.desc.dirty             = true
        this.post.errors.desc.status            = true

      } else if (this.active == 'poll') {
        this.poll.errors.title.dirty            = true
        this.poll.errors.title.status           = true

        this.poll.errors.desc.dirty             = true
        this.poll.errors.desc.status            = true

        this.poll.errors.start.dirty            = true
        this.poll.errors.start.status           = true

        this.poll.errors.end.dirty              = true
        this.poll.errors.end.status             = true

        this.poll.errors.type.dirty             = true
        this.poll.errors.type.status            = true

        this.poll.errors.answer.dirty           = true
        this.poll.errors.answer.status          = true

      } else if (this.active == 'suggestion') {
        this.suggestion.errors.title.dirty      = true
        this.suggestion.errors.title.status     = true

        this.suggestion.errors.direct.dirty     = true
        this.suggestion.errors.direct.status    = true

        this.suggestion.errors.message.dirty    = true
        this.suggestion.errors.message.status   = true

      }

    }, // touch

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

    }, // submitAct

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

require('./quick-search')
require('./logout')