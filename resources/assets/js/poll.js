Vue.mixin({

  data() {

    return {

      // init
      user:           null,
      action:         '',
      disabled:       true,

      // poll modification handler
      poll: {
        object:       null,
        id:           null,
        title:        '',
        desc:         '',
        start:        '',
        end:          '',
        type:         '',
        answer:       '',
        answers:      [],
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

          start: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          end: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          type: {

            dirty:    false,
            status:   false,
            text:     ''

          },

          answer: {

            dirty:    false,
            status:   false,
            text:     ''

          },

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

        this.poll.object = response.data

      })

      .catch((response) => {

        console.error(response.error)

      })

  }, // created

  watch: {

    'poll.title': function () {

      this.poll.errors.title.dirty              = true

      if (this.poll.title == '') {
        this.poll.errors.title.status           = false
        this.poll.errors.title.text             = 'Title cannot be empty.'

      } else {
        this.poll.errors.title.status           = true
        this.poll.errors.title.text             = ''

      }

    }, // poll.title

    'poll.desc': function () {

      this.poll.errors.desc.dirty               = true

      if (this.poll.desc == '') {
        this.poll.errors.desc.status            = false
        this.poll.errors.desc.text              = 'Description cannot be empty.'

      } else {
        this.poll.errors.desc.status            = true
        this.poll.errors.desc.text              = ''

      }

    }, // poll.desc

    'poll.start': function () {

      this.poll.errors.start.dirty              = true

      var start                                 = moment(this.poll.start, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.end == '') var end          = ''
      else                     var end          = moment(this.poll.end, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.start == '') {
        this.poll.errors.start.status           = false
        this.poll.errors.start.text             = 'Start date cannot be empty.'
      } else if (moment().isAfter(start)) {
        this.poll.errors.start.status           = false
        this.poll.errors.start.text             = 'Start date must set after current date.'
      } else if (moment(start).isAfter(end)) {
        this.poll.errors.start.status           = false
        this.poll.errors.start.text             = 'Start date must set before end date.'
      } else {
        this.poll.errors.start.status           = true
        this.poll.errors.start.text             = ''
      }

    }, // poll.start

    'poll.end': function () {

      this.poll.errors.end.dirty                = true

      if (this.poll.start == '')  var start     = ''
      else                        var start     = moment(this.poll.start, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      var end                                   = moment(this.poll.end, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.end == '') {
        this.poll.errors.end.status             = false
        this.poll.errors.end.text               = 'End date cannot be empty.'
      } else if (moment().isAfter(end)) {
        this.poll.errors.end.status             = false
        this.poll.errors.end.text               = 'End date must set after start date.'
      } else if (moment(end).isBefore(start)) {
        this.poll.errors.end.status             = false
        this.poll.errors.end.text               = 'End date must set after start date.'
      } else {
        this.poll.errors.end.status             = true
        this.poll.errors.end.text               = ''
      }

    }, // poll.end

    'poll.type': function () {

      this.poll.errors.type.dirty               = true

      if (this.poll.type == '') {
        this.poll.errors.type.status            = false
        this.poll.errors.type.text              = 'Select a type.'

      } else {
        this.poll.errors.type.status            = true
        this.poll.errors.type.text              = ''

      }

    }, // poll.type

    'poll.answer': function () {

      this.poll.errors.answer.dirty             = true

      if (this.poll.answers.length == 0) {
        this.poll.errors.answer.status          = false
        this.poll.errors.answer.text            = 'Add answers.'

      } else if (this.poll.answers.length < 2) {
        this.poll.errors.answer.status          = false
        this.poll.errors.answer.text            = 'Must have atleast two answers.'

      } else {
        this.poll.errors.answer.status          = true
        this.poll.errors.answer.text            = ''

      }

    } // poll.answer

  }, // watch

  computed: {

    'pollstatus': function () {

      if (this.poll.start == '')  var start   = ''
      else                        var start   = moment(this.poll.start, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')
      if (this.poll.end == '')    var end     = ''
      else                        var end     = moment(this.poll.end, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if      (moment().isAfter(start)  && moment().isBefore(end))        return 'active'
      else if (moment().isBefore(start) && moment(start).isBefore(end))   return 'pending'
      else if (moment().isAfter(end)    && moment(end).isAfter(start))    return 'expired'
      else                                                                return 'invalid date range'

    }, // pollstatus

    btnPollDisabled() {

      return (
        this.poll.errors.title.status &&
        this.poll.errors.desc.status &&
        this.poll.errors.start.status &&
        this.poll.errors.end.status &&
        this.poll.errors.type.status &&
        this.poll.errors.answer.status
      ) ? false : true;

    } // btnPollDisabled

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

      if (selector == '#poll-modal') {
        vm.poll.id       =  id
        vm.poll.title    =  data.title    == undefined ? '' : data.title
        vm.poll.desc     =  data.desc     == undefined ? '' : data.desc
        vm.poll.type     =  data.type     == undefined ? '' : data.type
        vm.poll.answer   =  data.answer   == undefined ? '' : data.answer
        vm.poll.answers  =  data.answers  == undefined ? [] : data.answers

        // init datetime picker
        if (data.start == undefined && data.end == undefined) {
          $('#poll-start').datetimepicker({
            format: 'MMM D, YYYY h:mm a'
          })

          $('#poll-end').datetimepicker({
            format: 'MMM D, YYYY h:mm a'
          })

          vm.poll.start  = ''
          vm.poll.end    = ''

        } else {
          $('#poll-start').datetimepicker({
            format:       'MMM D, YYYY h:mm a',
            defaultDate:  moment(data.start, 'YYYY-MM-DD HH:mm:ss')
          })

          $('#poll-end').datetimepicker({
            format:       'MMM D, YYYY h:mm a',
            defaultDate:  moment(data.end, 'YYYY-MM-DD HH:mm:ss')
          })

          vm.poll.start  = moment(data.start, 'YYYY-MM-DD HH:mm:ss').format('MMM D, YYYY h:mm a')
          vm.poll.end    = moment(data.end, 'YYYY-MM-DD HH:mm:ss').format('MMM D, YYYY h:mm a')
        }

        // change event on datetime picker
        $("#poll-start").on("dp.change", function (e) {
          vm.poll.start  = e.date.format('MMM D, YYYY h:mm a')
        })

        $("#poll-end").on("dp.change", function (e) {
          vm.poll.end    = e.date.format('MMM D, YYYY h:mm a')
        })

      } else if (selector == '#confirm-poll-modal') {
        vm.poll.id = id

      }

      $(selector).modal('show')

    }, // showModal

    hideModal(selector) {

      var vm = this

      $(selector).modal('hide')

      $(selector).on('hidden.bs.modal', function () {
        vm.clearPoll()
        vm.disableFieldset()
        vm.action = ''

      })

    }, // hideModal

    clearPoll() {

      this.poll.id                            = null
      this.poll.title                         = ''
      this.poll.desc                          = ''
      this.poll.start                         = ''
      this.poll.end                           = ''
      this.poll.type                          = ''
      this.poll.status                        = ''
      this.poll.answer                        = ''
      this.poll.answers                       = []

      this.poll.errors.title.dirty            = false
      this.poll.errors.title.status           = false
      this.poll.errors.title.text             = ''

      this.poll.errors.desc.dirty             = false
      this.poll.errors.desc.status            = false
      this.poll.errors.desc.text              = ''

      this.poll.errors.start.dirty            = false
      this.poll.errors.start.status           = false
      this.poll.errors.start.text             = ''

      this.poll.errors.end.dirty              = false
      this.poll.errors.end.status             = false
      this.poll.errors.end.text               = ''

      this.poll.errors.type.dirty             = false
      this.poll.errors.type.status            = false
      this.poll.errors.type.text              = ''

      this.poll.errors.answer.dirty           = false
      this.poll.errors.answer.status          = false
      this.poll.errors.answer.text            = ''

    }, // clearPoll

    edit(id) {

      this.touch()

      this.$http
        .get(window.location.origin + '/api/poll/' + id + '/edit')

        .then((response) => {

          this.showModal('#poll-modal', 'Update', response.data.id,
            {
              title:    response.data.title,
              desc:     response.data.desc,
              start:    response.data.start,
              end:      response.data.end,
              status:   response.data.status,
              type:     response.data.type,
              answers:  response.data.answers
            }
          )

        })

        .catch((response) => {

          console.error(response)

        })

    }, // edit

    touch() {

      this.poll.errors.title.dirty            = true
      this.poll.errors.title.status           = true

      this.poll.errors.desc.dirty             = true
      this.poll.errors.desc.status            = true

      this.poll.errors.start.dirty            = true
      this.poll.errors.start.status           = true

      this.poll.errors.end.dirty              = true
      this.poll.errors.end.status             = true

      this.poll.errors.type.dirty             = true
      this.poll.errors.type.status            = true

      this.poll.errors.answer.dirty           = true
      this.poll.errors.answer.status          = true

    }, // touch

    updateAct(id, data) {

      this.$http
        .put(window.location.origin + '/api/poll/' + id, data)

        .then((response) => {

            this.hideModal('#poll-modal')

            this.poll.object = response.data

        })

        .catch((response) => {

          console.error(response.error)

        })

    }, // updateAct

    destroy() {

      var id = this.poll.id

      this.$http
        .delete(window.location.origin + '/api/poll/' + id)

        .then((response) => {

            window.location = window.location.origin + '/home'

        })

        .catch((response) => {

          console.error(response.error)

        })

    }, // destroy

    submitAct() {

      this.disableFieldset()

      var id = this.poll.id

      var data    = {
        title:    this.poll.title,
        desc:     this.poll.desc,
        start:    this.poll.start,
        end:      this.poll.end,
        type:     this.poll.type,
        answers:  this.poll.answers
      }
      
      this.updateAct(id, data)

    }, // submitAct

    addAnswer(answer) {

      if (answer == '') return

      if (typeof(answer) == 'object') {
        this.poll.answers.push(answer)
        this.poll.answer = ''

      } else {
        this.poll.answers.push({id: null, answer: answer})
        this.poll.answer = ''

      }

    }, // addAnswer

    removeAnswer(key) {

      this.poll.answers.splice(key, 1)

    } // removeAnswer

  } //methods

})

require('./partials/_http-interceptor')
require('./partials/_quick-search')
require('./partials/_logout')