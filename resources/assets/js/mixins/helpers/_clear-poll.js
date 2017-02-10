Vue.mixin({

  methods: {

    clearPoll() {

      this.poll.id        = null
      this.poll.title     = ''
      this.poll.desc      = ''
      this.poll.start     = ''
      this.poll.end       = ''
      this.poll.type      = ''
      this.poll.status    = ''
      this.poll.answer    = ''
      this.poll.answers   = []

      this.poll.errors.title.dirty    = false
      this.poll.errors.title.status   = false
      this.poll.errors.title.text     = ''

      this.poll.errors.desc.dirty     = false
      this.poll.errors.desc.status    = false
      this.poll.errors.desc.text      = ''

      this.poll.errors.start.dirty    = false
      this.poll.errors.start.status   = false
      this.poll.errors.start.text     = ''

      this.poll.errors.end.dirty      = false
      this.poll.errors.end.status     = false
      this.poll.errors.end.text       = ''

      this.poll.errors.type.dirty     = false
      this.poll.errors.type.status    = false
      this.poll.errors.type.text      = ''

      this.poll.errors.answer.dirty   = false
      this.poll.errors.answer.status  = false
      this.poll.errors.answer.text    = ''

    } // clearPoll

  } // methods

})