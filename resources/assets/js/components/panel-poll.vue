<template>
  <div class="panel list-item post panel-default">

    <div class="panel-head">
      <slot name="dropdown-menu"></slot>
      <a class="profile-img" :href="profile">
        <img :src="image" :alt="fullname">
      </a>
      <h4><a :href="profile">{{fullname}}</a><br><small class="text-capitalize">{{date}}</small></h4>
    </div> <!-- .panel-head -->

    <div class="panel-body">

      <h3>
        <span>{{pollAct.title}}</span>
        <span v-if="pollAct.status == 'active'" class="label label-success">Active</span>
        <span v-else-if="pollAct.status == 'pending'" class="label label-default">Pending</span>
        <span v-else-if="pollAct.status == 'expired'" class="label label-danger">Expired</span>
        <br>
        <small><b>Start:</b> {{pollAct.start | formatDateTimeNormal}}</small>
        <br>
        <small><b>End:</b> {{pollAct.end | formatDateTimeNormal}}</small>
      </h3><hr>

      <p :class="enlarge ? 'enlarge' : ''" v-html="desc"></p>
      <hr>

      <h4>Answers</h4>

      <fieldset :disabled="ansDisabled">
        <div class="loading-circle" v-if="!answers"><span class="sr-only">Loading...</span></div>
        <bar-answer
          v-else
          v-for="answer in answers"
          :auth-user="authUser"
          :answer="answer"
          :all-voters="allVoters"
          :poll-type="pollAct.type"
          :btn-disabled="ansDisabled"
          @updateanswers="getAnswers"
        >
        </bar-answer>
      </fieldset>

    </div> <!-- .panel-body -->

  </div>
</template>

<script>
  export default {

    props: {

      authUser: {
        type:       Object,
        required:   true
      },

      pollAct: {
        type:       Object,
        required:   true
      }

    },

    data() {

      return {

        ansDisabled:  false,
        answers:      null,
        allVoters:    []

      }

    },
    mounted() {

      this.getAnswers()

    },

    computed: {

      enlarge() {

        if (this.pollAct.desc.length <= 85)   return true
        else                                  return false

      },

      image() {

        return window.location.origin + '/images/user.jpg'

      },

      profile() {

        return window.location.origin + '/profile/' + this.pollAct.user.id

      },

      fullname() {

        return this.pollAct.user.fname + ' ' + this.pollAct.user.lname

      },

      date() {

        var date = this.pollAct.created_at

        if      (moment().diff(moment(date), 'second') <= 5)  return 'just now'
        else if (moment().diff(moment(date), 'day') == 0)     return moment().fromNow()
        else if (moment().diff(moment(date), 'day') == 1)     return 'yesterday at ' + moment(date).format('h:mm a')
        else if (moment().diff(moment(date), 'day') < 7)      return moment(date).format('ddd [at] h:mm a')
        else if (moment().diff(moment(date), 'year') == 0)    return moment(date).format('MMM D [at] h:mm a')
        else                                                  return moment(date).format('MMM D, YYYY [at] h:mm a')

      },

      desc() {

        var text = this.pollAct.desc

        text = text.replace(/[(<>"'&]/g, function (char) {

          if      (char == "<")   return "&lt;"
          else if (char == ">")   return "&gt;"
          else if (char == "\"")  return "&quot;"
          else if (char == "'")   return "&apos;"
          else if (char == "&")   return "&amp;"

        })

        var hashed = text.match(/\s?#\w+\s?/g)
        
        hashed = _.map(hashed, function (word) {

          return _.trim(word)

        })

        _.forEach(hashed, function (word) {

          if (/^#\d+$/.test(word))  return
          else                      text = text.replace(word, '<a href="' + window.location.origin + '/search/' + word + '">' + word + '</a>')

        })

        text = text.replace(/[\n\r\f]/g, '<br>')

        return text

      }

    },

    methods: {

      getAllVotes() {

        this.allVoters = []

        this.$http
          .get(window.location.origin + '/api/poll/' + this.pollAct.id + '/voters')

          .then((response) => {

            for (var i = 0; i <= response.data.length - 1; i++) this.allVoters.push(response.data[i])

            this.enableAnswers()

          })

          .catch((response) => {

            console.error('error')

          })

      },

      getAnswers() {

        this.disableAnswers()

        this.answers = null

        this.$http
          .get(window.location.origin + '/api/poll/' + this.pollAct.id + '/answers')

          .then((response) => {

            this.answers = response.data

            this.$nextTick(function () {

              this.getAllVotes()

            })

          })

          .catch((response) => {

            console.error('error')

          })

      },

      disableAnswers() {

        this.ansDisabled = true

      },

      enableAnswers() {

        this.ansDisabled = false

      }

    },

    filters: {

      formatDateTimeNormal(date) {

        return moment(date).format('MMM D, YYYY [at] h:mm a')

      }

    }

  }
</script>