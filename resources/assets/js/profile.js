require('./partials/_http-interceptor')
require('./partials/_logout')
require('./partials/_quick-search')
require('./partials/_validators/_post-validator')
require('./partials/_validators/_poll-validator')
require('./partials/_validators/_suggestion-validator')

Vue.mixin({

  data() {

    return {

      // init
      user:           null,
      active:         '',
      action:         '',
      skip:           0,
      take:           10,
      full:           false,
      disabled:       true,

      imageUp: {
        data:         '',
        error:        null,
        uploading:    false,
        loaded:       null,
        xpos:         0,
        ypos:         0,
        width:        0,
        height:       0,
      },

      // view data handlers
      profile:        null,
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

        console.error(response.status, response.statusText)

      })

  }, // created

  mounted() {

    this.full = 'loading'

    this.$http
      .get(window.location.origin + '/api' + window.location.pathname)

      .then((response) => {

        this.profile = response.data

        if (this.profile.role == 'student')   this.active = 'suggestion'
        else                                  this.active = 'post'

        this.getAct()

      })

      .catch((response) => {

        console.error(response.status, response.statusText)

      })

  }, // mounted

  computed: {

    btnImageUpDisabled() {

      return this.imageUp.data == '';

    } // btnImageUpDisabled

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

      } else if (selector == '#upload-profile-modal') {
        //

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
        vm.clearImageUp()
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
      this.take                               = 10
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
      this.take                               = 10
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
      this.take                               = 10
      this.full                               = false
      this.suggestions                        = []

    }, // clearSuggestions

    clearImageUp() {

      $('.image-up').cropper('destroy')

      this.imageUp.data       = ''
      this.imageUp.error      = null
      this.imageUp.uploading  = false
      this.imageUp.loaded     = null
      this.imageUp.xpos       = 0
      this.imageUp.ypos       = 0
      this.imageUp.width      = 0
      this.imageUp.height     = 0

    }, // clearImageUp

    getAct() {

      this.full = 'loading'

      this.$nextTick(function () {

      this.$http
        .get(window.location.origin + '/api/user/' + this.profile.id + '/' + this.active + '?skip=' + this.skip + '&take=' + this.take)

        .then((response) => {

          this.skip += 10

          if      (this.active == 'post')         for (var i = 0; i <= response.data.length - 1; i++)     this.posts.push(response.data[i])
          else if (this.active == 'poll')         for (var i = 0; i <= response.data.length - 1; i++)     this.polls.push(response.data[i])
          else if (this.active == 'suggestion')   for (var i = 0; i <= response.data.length - 1; i++)     this.suggestions.push(response.data[i])

          if (response.data.length == 0 || response.data.length < 5)  this.full = true
          else                                                        this.full = false

        })

        .catch((response) => {

          console.error(response.status, response.statusText)

          this.full = false

        })

      })

    }, // getAct

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

          console.error(response.status, response.statusText)

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

          console.error(response.status, response.statusText)

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

          console.error(response.status, response.statusText)

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

      this.updateAct(id, data)

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

    changeUserRole(id, role) {

      this.$http
        .post(window.location.origin + '/api/user/' + id + '/role',
        {
          role: role
        })

        .then((response) => {

          window.location = window.location.origin + '/profile/' + id

        })

        .catch((response) => {

          console.error(response.status, response.statusText)

        })

    }, // changeUserRole

    uploadProfile() {

      vm = this

      vm.disableFieldset()
      $('.image-up').cropper('destroy')
      vm.imageUp.uploading = true

      vm.$http
        .post(window.location.origin + '/api/image/user/upload',
        {

          image:    vm.imageUp.data,
          xpos:     vm.imageUp.xpos,
          ypos:     vm.imageUp.ypos,
          width:    vm.imageUp.width,
          height:   vm.imageUp.height

        },
        {

          progress(e) {

            if (e.lengthComputable)
              vm.imageUp.loaded = (e.loaded / e.total) * 100

          }

        })

        .then((response) => {

          vm.hideModal('#upload-profile-modal')
          window.location = window.location.origin + '/profile/' + vm.profile.id

        })

        .catch((response) => {

          console.error(response.status, response.statusText)

          vm.clearImageUp()
          vm.imageUp.error = response.statusText
          vm.enableFieldset()

        })

    }, //uploadProfile

    onFileChange(e) {

      var files = e.target.files || e.dataTransfer.files

      if (!files.length)
        this.imageUp.error = 'No image selected'
      else if (['image/gif', 'image/jpeg', 'image/png'].indexOf(files[0]['type']) == -1)
        this.imageUp.error = 'File is not an image'
      else
        this.createImage(files[0])

    }, // onFileChange

    createImage(file) {

      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {

        vm.imageUp.data = e.target.result;

        vm.$nextTick(function () {

          $('.image-up').cropper({

            autoCropArea:         1,
            aspectRatio:          1,
            cropBoxMovable:       true,
            cropBoxResizable:     true,
            dragMode:             'move',
            guides:               false,
            restore:              false,
            viewMode:             2,

            crop(e) {
              vm.imageUp.xpos     = e.x
              vm.imageUp.ypos     = e.y
              vm.imageUp.width    = e.width
              vm.imageUp.height   = e.height
            }

          })

        })

      }

      reader.readAsDataURL(file);

    } // createImage

  } //methods

})
