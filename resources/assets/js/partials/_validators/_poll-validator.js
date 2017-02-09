Vue.mixin({

  watch: {

    'poll.title': function () {

      this.poll.errors.title.dirty      = true

      if (this.poll.title == '') {
        this.poll.errors.title.status   = false
        this.poll.errors.title.text     = 'Title cannot be empty.'

      } else {
        this.poll.errors.title.status   = true
        this.poll.errors.title.text     = ''

      }

    }, // poll.title

    'poll.desc': function () {

      this.poll.errors.desc.dirty       = true

      if (this.poll.desc == '') {
        this.poll.errors.desc.status    = false
        this.poll.errors.desc.text      = 'Description cannot be empty.'

      } else {
        this.poll.errors.desc.status    = true
        this.poll.errors.desc.text      = ''

      }

    }, // poll.desc

    'poll.start': function () {

      this.poll.errors.start.dirty      = true
      var start = moment(this.poll.start, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.end == '')
        var end = ''
      else
        var end = moment(this.poll.end, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.start == '') {
        this.poll.errors.start.status   = false
        this.poll.errors.start.text     = 'Start date cannot be empty.'

      } else if (moment().isAfter(start)) {
        this.poll.errors.start.status   = false
        this.poll.errors.start.text     = 'Start date must set after current date.'

      } else if (moment(start).isAfter(end)) {
        this.poll.errors.start.status   = false
        this.poll.errors.start.text     = 'Start date must set before end date.'

      } else {
        this.poll.errors.start.status   = true
        this.poll.errors.start.text     = ''

      }

    }, // poll.start

    'poll.end': function () {

      this.poll.errors.end.dirty        = true

      if (this.poll.start == '')
        var start = ''
      else
        var start = moment(this.poll.start, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      var end = moment(this.poll.end, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.end == '') {
        this.poll.errors.end.status     = false
        this.poll.errors.end.text       = 'End date cannot be empty.'

      } else if (moment().isAfter(end)) {
        this.poll.errors.end.status     = false
        this.poll.errors.end.text       = 'End date must set after start date.'

      } else if (moment(end).isBefore(start)) {
        this.poll.errors.end.status     = false
        this.poll.errors.end.text       = 'End date must set after start date.'

      } else {
        this.poll.errors.end.status     = true
        this.poll.errors.end.text       = ''

      }

    }, // poll.end

    'poll.type': function () {

      this.poll.errors.type.dirty       = true

      if (this.poll.type == '') {
        this.poll.errors.type.status    = false
        this.poll.errors.type.text      = 'Select a type.'

      } else {
        this.poll.errors.type.status    = true
        this.poll.errors.type.text      = ''

      }

    }, // poll.type

    'poll.answer': function () {

      this.poll.errors.answer.dirty     = true

      if (this.poll.answers.length == 0) {
        this.poll.errors.answer.status  = false
        this.poll.errors.answer.text    = 'Add answers.'

      } else if (this.poll.answers.length < 2) {
        this.poll.errors.answer.status  = false
        this.poll.errors.answer.text    = 'Must have atleast two answers.'

      } else {
        this.poll.errors.answer.status  = true
        this.poll.errors.answer.text    = ''

      }

    } // poll.answer

  }, // watch

  computed: {

    pollstatus() {

      if (this.poll.start == '')
        var start = ''
      else
        var start = moment(this.poll.start, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (this.poll.end == '')
        var end = ''
      else
        var end = moment(this.poll.end, 'MMM D, YYYY h:mm a').format('YYYY-MM-DD HH:mm:ss')

      if (moment().isAfter(start)  && moment().isBefore(end))
        return 'active'
      else if (moment().isBefore(start) && moment(start).isBefore(end))
        return 'pending'
      else if (moment().isAfter(end)    && moment(end).isAfter(start))
        return 'expired'
      else
        return 'invalid date range'

    }, // pollstatus

    btnPollDisabled() {

      return !(this.poll.errors.title.status &&
        this.poll.errors.desc.status &&
        this.poll.errors.start.status &&
        this.poll.errors.end.status &&
        this.poll.errors.type.status &&
        this.poll.errors.answer.status)

    } // btnPollDisabled

  } // computed

})
