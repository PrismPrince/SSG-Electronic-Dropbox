<template>
  <div class="panel list-item panel-default">
    <div class="panel-body">
      <div class="media">

        <div class="media-left">
          <a :href="userUrl">
            <img class="media-object" :src="image" :alt="fullname">
          </a>
        </div>

        <div class="media-body">
          <h4 class="media-heading"><a :href="userUrl">{{fullname}}</a></h4>
          {{date}}
          {{pollAct.start | formatDateTimeNormal}}
          {{pollAct.end | formatDateTimeNormal}}
          <span
            class="label"
            :class="{
              'label-default': status == 'Pending' ? true : false,
              'label-success': status == 'Active' ? true : false,
              'label-danger': status == 'Expired' ? true : false
            }"
          >{{status}}</span>
        </div>

        <slot name="dropdown-menu"></slot>

        <h3>{{pollAct.title}}</h3>
        <p :class="enlarge ? 'enlarge' : ''" v-html="desc"></p>

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

      </div> <!-- .media -->
    </div> <!-- .panel-body -->
  </div> <!-- .panel -->
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

      userUrl() {

        return window.location.origin + '/profile/' + this.pollAct.user.id

      },

      fullname() {

        return this.pollAct.user.fname + ' ' + this.pollAct.user.lname

      },

      date() {

        var date = this.pollAct.created_at

        if      (moment().diff(moment(date), 'second') <= 5)  return 'just now'
        else if (moment().diff(moment(date), 'day') == 0)     return moment(date).fromNow()
        else if (moment().diff(moment(date), 'day') == 1)     return 'yesterday at ' + moment(date).format('h:mm a')
        else if (moment().diff(moment(date), 'day') < 7)      return moment(date).format('ddd [at] h:mm a')
        else if (moment().diff(moment(date), 'year') == 0)    return moment(date).format('MMM D [at] h:mm a')
        else                                                  return moment(date).format('MMM D, YYYY [at] h:mm a')

      },

      status() {

        var start = this.pollAct.start
        var end   = this.pollAct.end

        if      (moment().isAfter(start)  && moment().isBefore(end))        return 'Active'
        else if (moment().isBefore(start) && moment(start).isBefore(end))   return 'Pending'
        else if (moment().isAfter(end)    && moment(end).isAfter(start))    return 'Expired'
        // else                                                                return 'Invalid date range'

      },

      desc() {

        var text  = this.pollAct.desc
            text  = text.replace(/[(<>"'&]/g, function (char) {

          if      (char == "<")   return "&lt;"
          else if (char == ">")   return "&gt;"
          else if (char == "\"")  return "&quot;"
          else if (char == "'")   return "&apos;"
          else if (char == "&")   return "&amp;"

        })

        var hashed  = text.match(/\s?#\w+\s?/g)
            hashed  = _.map(hashed, function (word) {

              return _.trim(word)

            })

        _.forEach(hashed, function (word) {

          if (/^#\d+$/.test(word))  return
          else                      text = text.replace(word, '<a href="' + window.location.origin + '/search?key=' + word + '">' + word + '</a>')

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

            this.$nextTick(function () {

              if (this.status == 'Active')  this.ansDisabled = false
              else                          this.ansDisabled = true

            })

          })

          .catch((response) => {

            console.error('error')

          })

      },

      getAnswers() {

        this.ansDisabled = true

        this.answers = null

        this.$http
          .get(window.location.origin + '/api/poll/' + this.pollAct.id + '/answers')

          .then((response) => {

            this.answers = response.data

            this.getAllVotes()

          })

          .catch((response) => {

            console.error('error')

          })

      }

    },

    filters: {

      formatDateTimeNormal(date) {

        return moment(date).format('MMM D, YYYY [at] h:mm a')

      }

    }

  }
</script>