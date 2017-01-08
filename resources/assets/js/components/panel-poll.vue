<template>
  <div class="panel list-item post panel-default">
    <div class="panel-head">
      <div v-if="opt" class="dropdown pull-right">
        <a class="option dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <span></span>
        </a>
        <slot name="dropdown-menu"></slot>
      </div>
      <a class="profile-img" :href="profile">
        <img :src="image" :alt="fullname">
      </a>
      <h4><a :href="profile">{{fullname}}</a><br><small class="text-capitalize">{{date | formatDate}}</small></h4>
    </div>
    <div class="panel-body">
      <h3>
        <span>{{title}}</span>
        <span v-if="status == 'active'" class="label label-success">Active</span>
        <span v-if="status == 'pending'" class="label label-default">Pending</span>
        <span v-if="status == 'expired'" class="label label-danger">Expired</span>
        <br>
        <small><b>Start:</b> {{start | formatDateTimeNormal}}</small>
        <br>
        <small><b>End:</b> {{end | formatDateTimeNormal}}</small>
      </h3><hr>
      <p :class="enlarge ? 'enlarge' : ''" v-html="htmlEntities(desc)"></p>
      <hr>
      <h4>Answers</h4>
      <fieldset :disabled="disabled">
        <div class="answer" v-for="answer in answers">
          <button
            class="bar-wrapper btn-default"
            :class="{
              selected: hasValue(answer.id) ? true : false,
              disabled: disabled
            }"
            :data-title="tooltip(answer.users.length)"
            @click="vote(answer.id)"
          >
            <div class="bar" :style="'width: ' + bar(answer.users.length) + '%;'"></div>
            <div class="bar-label">
              <span class="glyphicon" :class="hasValue(answer.id) ? 'glyphicon-ok-sign' : 'glyphicon-ok-circle'"></span>
              <span>{{answer.answer}}</span>
            </div>
          </button>
          <input v-if="type == 'once'" v-show="false" type="radio" name="answer" :value="answer.id" v-model="selected">
          <input v-if="type == 'multi'" v-show="false" type="checkbox" name="answer" :value="answer.id" v-model="selected">
        </div>
      </fieldset>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      authUser: {
        type: Object,
        required: true
      },
      profile: {
        type: String,
        required: true
      },
      image: {
        type: String,
        required: true
      },
      fullname: {
        type: String,
        required: true
      },
      date: {
        type: String,
        required: true
      },
      title: {
        type: String,
        required: true
      },
      desc: {
        type: String,
        required: true
      },
      start: {
        type: String,
        required: true
      },
      end: {
        type: String,
        required: true
      },
      status: {
        type: String,
        required: true
      },
      type: {
        type: String,
        required: true
      },
      answers: {
        type: Array,
        required: true
      },
      opt: {
        type: Boolean,
        required: true
      }
    },
    data() {
      return {
        enlarge: false,
        disabled: false,
        selected: [],
        voters: []
      }
    },
    mounted() {

      for (var i = 0; i < this.answers.length; i++) {
        var answer = this.answers[i] //obj

        for (var j = 0; j < answer.users.length; j++) {
          var user = answer.users[j] //obj

          this.voters.push(user)

          if (user.id == this.authUser.id) {
            this.selected.push(answer.id)
          }
        }
      }

    },
    methods: {
      bar(i) {
        if (this.voters.length == 0) return 0
        return ((i / this.voters.length) * 100)
      },
      tooltip(users) {
        _.delay(function () {
          $('.bar-wrapper').tooltip({
            placement: 'left'
          })
        }, 1000)

        return (Math.round(this.bar(users) * 100) / 100) + '% ' + users + ' vote' + (users == 1 ? '' : 's')
      },
      hasValue(id) {
        return _.indexOf(this.selected, id) != -1
      },
      selectAnswer(id) {

      // this.disabled = true

      this.$http
        .post(window.location.origin + '/api/vote', {
          answer: id
        })

        .then((response) => {

          var i = _.indexOf(this.polls, _.find(this.polls, {id: response.data.id}))

          this.polls.splice(i, 1, response.data)
          
          // if (this. type == 'once') {
          //   this.selected.splice(0, 1, id)
          // }
          // if (this.type == 'multi') {
          //   var i = _.indexOf(this.selected, id)
          //   if (i == -1) {
          //     this.selected.push(id)
          //   } else {
          //     this.selected.splice(i, 1)
          //   }
          // }

          // this.disabled = false

        })

        .catch((response) => {
          console.error(response.error)

          // this.disabled = false

        })

    },
      // selectAnswer(id) {

      //   this.disabled = true

      //   this.$http
      //     .post(window.location.origin + '/api/vote', {
      //       answer: id
      //     })

      //     .then((response) => {
            
      //       if (this. type == 'once') {
      //         this.selected.splice(0, 1, id)
      //       }
      //       if (this.type == 'multi') {
      //         var i = _.indexOf(this.selected, id)
      //         if (i == -1) {
      //           this.selected.push(id)
      //         } else {
      //           this.selected.splice(i, 1)
      //         }
      //       }

      //       this.disabled = false

      //     })

      //     .catch((response) => {
      //       console.error(response.error)

      //       this.disabled = false

      //     })

      // },
      htmlEntities(text) {
        if (text.length <= 85) this.enlarge = true

        text = text.replace(/[(<>"'&]/g, function (x) {
          if (x == "<") return "&lt;"
          else if (x == ">") return "&gt;"
          else if (x == "\"") return "&quot;"
          else if (x == "'") return "&apos;"
          else if (x == "&") return "&amp;"
        })

        var hashed = text.match(/\s?#\w+\s?/g)
        hashed = _.map(hashed, function (x) {return _.trim(x)})

        _.forEach(hashed, function (x) {
          if (/^#\d+$/.test(x)) return
          else {
            text = text.replace(x, '<a href="' + window.location.origin + '/search/' + x + '">' + x + '</a>')
          }
        })

        text = text.replace(/[\n\r\f]/g, '<br>')

        return text
      }
    },
    filters: {
      formatDateTimeNormal(date) {
        return moment(date).format('MMM D, YYYY [at] h:mm a')
      },
      formatDate(date) {
        if (moment().diff(moment(date), 'second') <= 5) {
          return 'just now'
        } else if (moment().diff(moment(date), 'day') == 0) {
          return moment().fromNow()
        } else if (moment().diff(moment(date), 'day') == 1) {
          return 'yesterday at ' + moment(date).format('h:mm a')
        } else if (moment().diff(moment(date), 'day') < 7) {
          return moment(date).format('ddd [at] h:mm a')
        } else if (moment().diff(moment(date), 'year') == 0) {
          return moment(date).format('MMM D [at] h:mm a')
        } else {
          return moment(date).format('MMM D, YYYY [at] h:mm a')
        }
      }
    }
  }
</script>