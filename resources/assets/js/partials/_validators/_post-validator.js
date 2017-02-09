Vue.mixin({

  watch: {

    'post.title': function () {

      this.post.errors.title.dirty      = true

      if (this.post.title == '') {
        this.post.errors.title.status   = false
        this.post.errors.title.text     = 'Title cannot be empty.'

      } else {
        this.post.errors.title.status   = true
        this.post.errors.title.text     = ''

      }

    }, // post.title

    'post.desc': function () {

      this.post.errors.desc.dirty       = true

      if (this.post.desc == '') {
        this.post.errors.desc.status    = false
        this.post.errors.desc.text      = 'Description cannot be empty.'

      } else {
        this.post.errors.desc.status    = true
        this.post.errors.desc.text      = ''

      }

    } // post.desc

  }, // watch

  computed: {

    btnPostDisabled() {

      return !(this.post.errors.title.status && this.post.errors.desc.status)

    } // btnPostDisabled

  } // computed

})
