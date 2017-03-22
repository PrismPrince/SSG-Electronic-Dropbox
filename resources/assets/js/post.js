/*!!
 * ===================================================================================================
 * SSG Electronic Dropbox (https://www.github.com/PrismPrince/SSG-Electronic-Dropbox)
 * Copyright 2017 Dave Dane Pacilan
 * Licensed under MIT (https://github.com/PrismPrince/SSG-Electronic-Dropbox/blob/master/LICENSE)
 * ===================================================================================================
 */

require('./bootstrap.js')

require('./mixins/_http-interceptor')
require('./mixins/_get-auth-user')
require('./mixins/_logout')
require('./mixins/_quick-search')

// validators
require('./mixins/validators/_post-validator')

//helpers
require('./mixins/helpers/_focus')
require('./mixins/helpers/_clear-post')

require('./mixins/helpers/_post-photos')

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

      }

    }

  }, // data

  created() {

    this.$http
      .get(window.location.origin + '/api' + window.location.pathname)

      .then((response) => {

        this.post.object = response.data

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

    }, // submitAct

    onFileChange(e) {

      // this.post.errors.photos.dirty = true
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
            console.log(files[i])

          } else {
            vm.post.errors.photos.status = false

            var reader = new FileReader()

            reader.onload = e => {

              if (vm.post.photos.length < 15)
                vm.post.photos.push(e.target.result)
              else {
                vm.post.errors.photos.status = true
                vm.post.errors.photos.text = 'Maximum of 15 photos only'
              }

            }

            reader.readAsDataURL(files[i])

          }

        }

      }

    }, // onFileChange

    removePhoto(key) {

      this.post.photos.splice(key, 1)

    } // removePhoto

  } //methods

})

require('./app.js')
