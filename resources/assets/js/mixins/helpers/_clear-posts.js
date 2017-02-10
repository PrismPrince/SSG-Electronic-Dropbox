Vue.mixin({

  methods: {

    clearPosts() {

      this.skip   = 0
      this.take   = 10
      this.full   = false
      this.posts  = []

    } // clearPosts

  } // methods

})