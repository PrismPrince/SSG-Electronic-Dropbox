Vue.mixin({

  methods: {

    clearPost() {

      this.post.id      = null
      this.post.title   = ''
      this.post.desc    = ''

      this.post.errors.title.dirty    = false
      this.post.errors.title.status   = false
      this.post.errors.title.text     = ''

      this.post.errors.desc.dirty     = false
      this.post.errors.desc.status    = false
      this.post.errors.desc.text      = ''

    } // clearPost

  } // methods

})