Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', 'Bearer ' + document.getElementById('Authorization').value)

    next()

})

Vue.mixin({

  data() {

    return {

      // init
      user:           null,
      action:         '',
      disabled:       true,

      // post modification handler
      post: {
        object:       null,
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

    this.$http
      .get(window.location.origin + '/api' + window.location.pathname)

      .then((response) => {

        this.post.object = response.data

      })

      .catch((response) => {

        console.error(response.error)

      })


  }, // created

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

    } // post.desc

  }, // watch

  computed: {

    btnPostDisabled() {

      return (
        this.post.errors.title.status &&
        this.post.errors.desc.status
      ) ? false : true;

    } // btnPostDisabled

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

      } else if (selector == '#confirm-post-modal') {
        vm.post.id = id

      }

      $(selector).modal('show')

    }, // showModal

    hideModal(selector) {

      var vm = this

      $(selector).modal('hide')

      $(selector).on('hidden.bs.modal', function () {

        vm.clearPost()
        vm.disableFieldset()
        vm.action = ''

      })

    }, // hideModal

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

    edit(id) {

      this.touch()

      this.$http
        .get(window.location.origin + '/api/post/' + id + '/edit')

        .then((response) => {

          this.showModal('#post-modal', 'Update', response.data.id,
            {
              title:    response.data.title,
              desc:     response.data.desc
            }
          )

        })

        .catch((response) => {
          console.error(response.error)

        })

    }, // edit

    touch() {

        this.post.errors.title.dirty            = true
        this.post.errors.title.status           = true

        this.post.errors.desc.dirty             = true
        this.post.errors.desc.status            = true

    }, // touch

    updateAct(id, data) {

      this.$http
        .put(window.location.origin + '/api/post/' + id, data)

        .then((response) => {

            this.hideModal('#post-modal')

            this.post.object = response.data

        })

        .catch((response) => {

          console.error(response.error)

        })

    }, // updateAct

    destroy() {

      var id = this.post.id

      this.$http
        .delete(window.location.origin + '/api/post/' + id)

        .then((response) => {

            window.location = window.location.origin + '/home'

        })

        .catch((response) => {

          console.error(response.error)

        })

    }, // destroy

    submitAct() {

      this.disableFieldset()

      var id = this.post.id

      var data    = {
        title:    this.post.title,
        desc:     this.post.desc
      }

      this.updateAct(id, data)

    }

  } //methods

})

require('./quick-search')
require('./logout')