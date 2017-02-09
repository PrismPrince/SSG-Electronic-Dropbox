Vue.mixin({

  watch: {

    'suggestion.title': function () {

      this.suggestion.errors.title.dirty        = true

      if (this.suggestion.title == '') {
        this.suggestion.errors.title.status     = false
        this.suggestion.errors.title.text       = 'Title cannot be empty.'

      } else {
        this.suggestion.errors.title.status     = true
        this.suggestion.errors.title.text       = ''

      }

    }, // suggestion.title

    'suggestion.direct': function () {

      this.suggestion.errors.direct.dirty       = true

      if (this.suggestion.direct == '') {
        this.suggestion.errors.direct.status    = false
        this.suggestion.errors.direct.text      = 'Direct cannot be empty.'

      } else {
        this.suggestion.errors.direct.status    = true
        this.suggestion.errors.direct.text      = ''

      }

    }, // suggestion.direct

    'suggestion.message': function () {

      this.suggestion.errors.message.dirty      = true

      if (this.suggestion.message == '') {
        this.suggestion.errors.message.status   = false
        this.suggestion.errors.message.text     = 'Message cannot be empty.'

      } else {
        this.suggestion.errors.message.status   = true
        this.suggestion.errors.message.text     = ''

      }

    } // suggestion.message

  }, // watch

  computed: {

    btnSuggestionDisabled() {

      return !(this.suggestion.errors.title.status &&
        this.suggestion.errors.direct.status &&
        this.suggestion.errors.message.status)

    } // btnSuggestionDisabled

  } // computed

})
