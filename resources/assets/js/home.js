require('./mixins/_http-interceptor')
require('./mixins/_get-auth-user')
require('./mixins/_logout')
require('./mixins/_quick-search')

// validators
require('./mixins/validators/_post-validator')
require('./mixins/validators/_poll-validator')
require('./mixins/validators/_suggestion-validator')

// helpers
require('./mixins/helpers/_focus')
require('./mixins/helpers/_clear-post')
require('./mixins/helpers/_clear-posts')
require('./mixins/helpers/_clear-poll')
require('./mixins/helpers/_clear-polls')
require('./mixins/helpers/_clear-suggestion')
require('./mixins/helpers/_clear-suggestions')

Vue.mixin({

  data() {

    return {

      // init
      user:           null,
      active:         'post',
      action:         '',
      skip:           0,
      take:           10,
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

        photos: {

          data:       [],
          uploading:  false,
          loaded:     null

        },

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

          photos: {

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
        vm.clearPostPhotos()
        vm.clearPoll()
        vm.clearSuggestion()
        vm.disableFieldset()
        vm.action = ''

      })

    }, // hideModal

    clearPostPhotos() {

      this.post.photos.data = []
      this.post.errors.photos.status = false
      this.post.errors.photos.text = ''

    }, // clearPostPhotos

    switchActivity(activity) {

      this.active = activity

      this.clearPost()
      this.clearPostPhotos()
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

    getAct() {

      this.full = 'loading'

      this.$http
        .get(window.location.origin + '/api/' + this.active + '?skip=' + this.skip + '&take=' + this.take)

        .then((response) => {

          this.skip += 10

          if      (this.active == 'post')         for (var i = 0; i <= response.data.length - 1; i++)     this.posts.push(response.data[i])
          else if (this.active == 'poll')         for (var i = 0; i <= response.data.length - 1; i++)     this.polls.push(response.data[i])
          else if (this.active == 'suggestion')   for (var i = 0; i <= response.data.length - 1; i++)     this.suggestions.push(response.data[i])

          if (response.data.length == 0 || response.data.length < 10)  this.full = true
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

      var vm = this

      vm.disableFieldset()

      if (vm.active == 'post') {

        if (vm.post.photos.data.length > 0) {

          vm.post.photos.uploading = true

          vm.$http
            .post(window.location.origin + '/api/image/post/upload',
            {
              photos: vm.post.photos.data
            },
            {

              progress(e) {

                if (e.lengthComputable)
                  vm.post.photos.loaded = (e.loaded / e.total) * 100

              }

            })

            .then(response => {

              vm.post.photos.uploading = false

              var id = vm.post.id

              var data    = {
                title:    vm.post.title,
                desc:     vm.post.desc,
                photos:   response.data
              }

              vm.$nextTick(function () {
                if (vm.action == 'Update')
                  vm.updateAct(id, data)
                else
                  vm.storeAct(data)
              })

            })

            .catch(response => {

              vm.post.photos.uploading = false
              vm.post.photos.loaded = null
              vm.post.errors.photos.status = true
              vm.post.errors.photos.text = response.statusText
              vm.enableFieldset()

              return false;

            })

        } else {

          var id = vm.post.id

          var data    = {
            title:    vm.post.title,
            desc:     vm.post.desc,
            photos:   []
          }

          if (vm.action == 'Update')
            vm.updateAct(id, data)
          else
            vm.storeAct(data)

        }

      } else if (vm.active == 'poll') {
        var id = vm.poll.id

        var data    = {
          title:    vm.poll.title,
          desc:     vm.poll.desc,
          start:    vm.poll.start,
          end:      vm.poll.end,
          type:     vm.poll.type,
          answers:  vm.poll.answers
        }

        if (vm.action == 'Update')
          vm.updateAct(id, data)
        else
          vm.storeAct(data)

      } else if (vm.active == 'suggestion') {
        var id = vm.suggestion.id

        var data    = {
          title:    vm.suggestion.title,
          direct:   vm.suggestion.direct,
          message:  vm.suggestion.message
        }

        if (vm.action == 'Update')
          vm.updateAct(id, data)
        else
          vm.storeAct(data)

      }

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

    }, // removeAnswer

    onFileChange(e) {

      var files = e.target.files || e.dataTransfer.files

      if (files.length == 0) {
        this.post.errors.photos.status = true
        this.post.errors.photos.text = 'No image selected'

      } else {
        var vm = this

        for (var i = 0; i < files.length; i++) {
          if (['image/gif', 'image/jpeg', 'image/png'].indexOf(files[i]['type']) == -1) {
            vm.post.errors.photos.status = true
            vm.post.errors.photos.text = 'File is not an image'

          } else {
            vm.post.errors.photos.status = false

            var reader = new FileReader()

            reader.onload = e => {

              if (vm.post.photos.data.length < 15)
                vm.post.photos.data.push(e.target.result)
              else {
                vm.post.errors.photos.status = true
                vm.post.errors.photos.text = 'Maximum of 15 photos only'
              }

            } // e

            reader.readAsDataURL(files[i])

          } // else

        } // for

      } // else

    }, // onFileChange

    removePhoto(key) {

      this.post.photos.data.splice(key, 1)

    } // removePhoto

  } //methods

})
