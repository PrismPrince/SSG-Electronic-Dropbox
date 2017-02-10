Vue.mixin({

  methods: {

    clearSuggestion() {

      this.suggestion.id      	= null
      this.suggestion.title   	= ''
      this.suggestion.direct  	= ''
      this.suggestion.message 	= ''

      this.suggestion.errors.title.dirty      = false
      this.suggestion.errors.title.status     = false
      this.suggestion.errors.title.text       = ''

      this.suggestion.errors.direct.dirty     = false
      this.suggestion.errors.direct.status    = false
      this.suggestion.errors.direct.text      = ''

      this.suggestion.errors.message.dirty    = false
      this.suggestion.errors.message.status   = false
      this.suggestion.errors.message.text     = ''

    } // clearSuggestion

  } // methods

})