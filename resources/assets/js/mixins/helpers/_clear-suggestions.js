Vue.mixin({

  methods: {

    clearSuggestions() {

      this.skip         = 0
      this.take         = 10
      this.full         = false
      this.suggestions  = []

    } // clearSuggestions

  } // methods

})