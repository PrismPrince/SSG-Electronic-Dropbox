require('./mixins/_http-interceptor')
require('./mixins/_get-auth-user')
require('./mixins/_logout')
require('./mixins/_quick-search')

// validators
require('./mixins/_validators/_suggestion-validator')

// helpers
require('./mixins/_helpers/_focus')

Vue.mixin({

  data() {

    return {

      // init
      user:           null,
      action:         '',
      disabled:       true,

      // suggestion modification handler
      suggestion: {
        object:       null,
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
      .get(window.location.origin + '/api' + window.location.pathname)

      .then((response) => {

        this.suggestion.object = response.data

      })

      .catch((response) => {

        console.error(response.error)

      })

  }, // created

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

      if (selector == '#suggestion-modal') {
        vm.suggestion.id       =  id
        vm.suggestion.title    =  data.title    == undefined ? '' : data.title
        vm.suggestion.direct   =  data.direct   == undefined ? '' : data.direct
        vm.suggestion.message  =  data.message  == undefined ? '' : data.message

      } else if (selector == '#confirm-suggestion-modal') {
        vm.suggestion.id = id

      }

      $(selector).modal('show')

    }, // showModal

    hideModal(selector) {

      var vm = this

      $(selector).modal('hide')

      $(selector).on('hidden.bs.modal', function () {
        vm.clearSuggestion()
        vm.disableFieldset()
        vm.action = ''

      })

    }, // hideModal

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

    edit(id) {

      this.touch()

      this.$http
        .get(window.location.origin + '/api/suggestion/' + id + '/edit')

        .then((response) => {
          
          this.showModal('#suggestion-modal', 'Update', response.data.id,
            {
              title:    response.data.title,
              direct:   response.data.direct,
              message:  response.data.message
            }
          )

        })

        .catch((response) => {

          console.error(response.error)

        })

    }, // edit

    touch() {

      this.suggestion.errors.title.dirty      = true
      this.suggestion.errors.title.status     = true

      this.suggestion.errors.direct.dirty     = true
      this.suggestion.errors.direct.status    = true

      this.suggestion.errors.message.dirty    = true
      this.suggestion.errors.message.status   = true

    }, // touch

    updateAct(id, data) {

      this.$http
        .put(window.location.origin + '/api/suggestion/' + id, data)

        .then((response) => {

            this.hideModal('#suggestion-modal')

            this.suggestion.object = response.data

        })

        .catch((response) => {

          console.error(response.error)

        })

    }, // updateAct

    destroy() {

      var id = this.suggestion.id

      this.$http
        .delete(window.location.origin + '/api/suggestion/' + id)

        .then((response) => {

            window.location = window.location.origin + '/home'

        })

        .catch((response) => {

          console.error(response.error)

        })

    }, // destroy

    submitAct() {

      this.disableFieldset()

      var id = this.suggestion.id

      var data    = {
        title:    this.suggestion.title,
        direct:   this.suggestion.direct,
        message:  this.suggestion.message
      }

      this.updateAct(id, data)

    } // submitAct

  } //methods

})
