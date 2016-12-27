Vue.mixin({
  data() {
    return {
      suggestion: {
        id: null,
        title: '',
        direct: '',
        message: '',
        action: '',
        disabled: true
        // error: {}
      },
      suggestions: {
        skip: 0,
        take: 5,
        full: false,
        data: []
      }
    }
  },
  methods: {
    showSuggestionModal(selector, action = '', id = null, title = '', direct = '', message = '') {
      this.suggestion.action = action
      this.suggestion.id = id
      this.suggestion.title = title
      this.suggestion.direct = direct
      this.suggestion.message = message

      this.enableSuggestionInput()

      $(selector).modal('show')
    },
    hideSuggestionModal(selector, action = '', id = null, title = '', direct = '', message = '') {
      var vm = this

      $(selector).modal('hide')

      $(selector).on('hidden.bs.modal', function () {
        vm.suggestion.action = action
        vm.suggestion.id = id
        vm.suggestion.title = title
        vm.suggestion.direct = direct
        vm.suggestion.message = message
      })
    },
    disableSuggestionInput() {
      this.suggestion.disabled = true
    },
    enableSuggestionInput() {
      this.suggestion.disabled = false
    },
    submitSuggestion() {
      var vm = this

      if (vm.suggestion.action != 'Update') {
        // disable input fields and button
        vm.disableSuggestionInput()

        // post request with the input data
        vm.$http.post(window.location.origin + '/api/suggestion', {
          title: vm.suggestion.title,
          direct: vm.suggestion.direct,
          message: vm.suggestion.message
        }).then((response) => {

          vm.suggestions.skip++

          vm.hideSuggestionModal('#suggestion-modal')
          vm.enableSuggestionInput()

          vm.suggestions.data.splice(0, 0, response.data)

        }).catch((response) => {
          console.error(response.error)
        })
      } else {
        // disable input fields and button
        vm.disableSuggestionInput()

        // put request with the updated data
        vm.$http.put(window.location.origin + '/api/suggestion/' + vm.suggestion.id, {
          title: vm.suggestion.title,
          direct: vm.suggestion.direct,
          message: vm.suggestion.message
        }).then((response) => {

          vm.hideSuggestionModal('#suggestion-modal')
          vm.enableSuggestionInput()

          var i = _.indexOf(vm.suggestions.data, _.find(vm.suggestions.data, {id: response.data.id}))
          vm.suggestions.data.splice(i, 1, response.data)

        }).catch((response) => {
          console.error(response.error)
        })
      }
    },
    getSuggestions() {
      this.$http.get(window.location.origin + '/api/suggestion?skip=' + this.suggestions.skip + '&take=' + this.suggestions.take)
        .then((response) => {
          if (response.data.length == 0 || response.data.length < 5) {
            this.suggestions.full = true
          }

          this.suggestions.skip += 5

          for (var i = 0; i <= response.data.length - 1; i++) {
            this.suggestions.data.push(response.data[i])
          }

        }).catch((response) => {
          console.error(response.error)
        })
    },
    editSuggestion(id) {
      this.$http.get(window.location.origin + '/api/suggestion/' + id + '/edit')
        .then((response) => {
          this.showSuggestionModal('#suggestion-modal', 'Update', response.data.id, response.data.title, response.data.direct, response.data.message)
        }).catch((response) => {
          console.error(response.error)
        })
    },
    confirmDeleteSuggestion(id) {
      this.showSuggestionModal('#confirm-suggestion-modal', 'Delete', id)
    },
    deleteSuggestion() {
      this.$http.delete(window.location.origin + '/api/suggestion/' + this.suggestion.id)
        .then((response) => {
          this.suggestions.skip--

          var i = _.indexOf(this.suggestions.data, _.find(this.suggestions.data, {id: response.data.id}))
          this.suggestions.data.splice(i, 1)

          this.hideSuggestionModal('#confirm-suggestion-modal')
        }).catch((response) => {
          console.error(response.error)
        })
    }
  }
})