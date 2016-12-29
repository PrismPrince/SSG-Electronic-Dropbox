Vue.mixin({
  data() {
    return {
      poll: {
        id: null,
        title: '',
        desc: '',
        start: '',
        end: '',
        type: '',
        answer: '',
        answers: [],
        action: '',
        disabled: true
        // error: {}
      },
      polls: {
        skip: 0,
        take: 5,
        full: false,
        data: []
      }
    }
  },
  methods: {
    addAnswer(answer) {
      if (answer == '') return
      this.poll.answers.push(answer)
      this.poll.answer = ''
    },
    removeAnswer(key) {
      this.poll.answers.splice(key, 1)
    },
    showPollModal(selector, action = '', id = null, title = '', desc = '', start = '', end = '', type = '', answer = '', answers = []) {
      this.poll.action = action
      this.poll.id = id
      this.poll.title = title
      this.poll.desc = desc
      this.poll.start = start
      this.poll.end = end
      this.poll.type = type
      this.poll.answer = answer
      this.poll.answers = answers

      this.enablePollInput()

      $(selector).modal('show')
    },
    hidePollModal(selector, action = '', id = null, title = '', desc = '', start = '', end = '', type = '', answer = '', answers = []) {
      var vm = this

      $(selector).modal('hide')

      $(selector).on('hidden.bs.modal', function () {
        vm.poll.action = action
        vm.poll.id = id
        vm.poll.title = title
        vm.poll.desc = desc
        vm.poll.start = start
        vm.poll.end = end
        vm.poll.type = type
        vm.poll.answer = answer
        vm.poll.answers = answers
      })
    },
    disablePollInput() {
      this.poll.disabled = true
    },
    enablePollInput() {
      this.poll.disabled = false
    },
    submitPoll() {
      var vm = this

      if (vm.poll.action != 'Update') {
        // disable input fields and button
        vm.disablePollInput()

        // poll request with the input data
        vm.$http.post(window.location.origin + '/api/poll', {
          title: vm.poll.title,
          desc: vm.poll.desc,
          start: vm.poll.start,
          end: vm.poll.end,
          type: vm.poll.type,
          answers: vm.poll.answers
        }).then((response) => {

          vm.polls.skip++

          vm.hidePollModal('#poll-modal')
          vm.enablePollInput()

          vm.polls.data.splice(0, 0, response.data)

        }).catch((response) => {
          console.error(response.error)
        })
      } else {
        // disable input fields and button
        vm.disablePollInput()

        // put request with the updated data
        vm.$http.put(window.location.origin + '/api/poll/' + vm.poll.id, {
          title: vm.poll.title,
          desc: vm.poll.desc,
          start: vm.poll.start,
          end: vm.poll.end,
          type: vm.poll.type,
          answers: vm.poll.answers
        }).then((response) => {

          vm.hidePollModal('#poll-modal')
          vm.enablePollInput()

          var i = _.indexOf(vm.polls.data, _.find(vm.polls.data, {id: response.data.id}))
          vm.polls.data.splice(i, 1, response.data)

        }).catch((response) => {
          console.error(response.error)
        })
      }
    },
    getPolls() {
      this.$http.get(window.location.origin + '/api/poll?skip=' + this.polls.skip + '&take=' + this.polls.take)
        .then((response) => {
          if (response.data.length == 0 || response.data.length < 5) {
            this.polls.full = true
          }

          this.polls.skip += 5

          for (var i = 0; i <= response.data.length - 1; i++) {
            this.polls.data.push(response.data[i])
          }

        }).catch((response) => {
          console.error(response.error)
        })
    },
    editPoll(id) {
      this.$http.get(window.location.origin + '/api/poll/' + id + '/edit')
        .then((response) => {
          this.showPollModal('#poll-modal', 'Update', response.data.id, response.data.title, response.data.desc, response.data.start,  response.data.end, response.data.type)
        }).catch((response) => {
          console.error(response.error)
        })
    },
    confirmDeletePoll(id) {
      this.showPollModal('#confirm-poll-modal', 'Delete', id)
    },
    deletePoll() {
      this.$http.delete(window.location.origin + '/api/poll/' + this.poll.id)
        .then((response) => {
          this.polls.skip--

          var i = _.indexOf(this.polls.data, _.find(this.polls.data, {id: response.data.id}))
          this.polls.data.splice(i, 1)

          this.hidePollModal('#confirm-poll-modal')
        }).catch((response) => {
          console.error(response.error)
        })
    }
  },
  mounted() {
    var vm = this

    $('#poll-start').datetimepicker({
      format: 'MMM D, YYYY h:mm a'
    })
    $('#poll-end').datetimepicker({
      useCurrent: false, //Important! See issue #1075
      format: 'MMM D, YYYY h:mm a'
    })
    $("#poll-start").on("dp.change", function (e) {
      $('#poll-end').data("DateTimePicker").minDate(e.date)
      vm.poll.start = e.date.format('MMM D, YYYY h:mm a')
    })
    $("#poll-end").on("dp.change", function (e) {
      $('#poll-start').data("DateTimePicker").maxDate(e.date)
      vm.poll.end = e.date.format('MMM D, YYYY h:mm a')
    })
  }
})