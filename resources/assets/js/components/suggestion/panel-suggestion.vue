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
          <h4 class="media-heading"><a :href="userUrl">{{fullname}}</a> suggest to <b>{{suggestionAct.direct}}</b></h4>
          {{date}}
        </div>

        <slot name="dropdown-menu"></slot>

        <h3>{{suggestionAct.title}}</h3>
        <p :class="enlarge ? 'enlarge' : ''" v-html="message"></p>

      </div> <!-- .media -->
    </div> <!-- .panel-body -->

    <ul class="list-group comments">
      <li class="list-group-item-info list-group-item">Comments</li>
      <div v-if="!fullC" class="full-option text-center"><a href="#" @click.prevent="getComments">Older...</a></div>
      <div v-else-if="fullC == 'loading'" class="full-option"><div class="loading-circle"></div><span class="sr-only">loading...</span></div>
      <div v-else-if="fullC"></div>

      <li class="list-group-item" v-if="!comments">
        <div class="loading-circle"><span class="sr-only">Loading...</span></div>
      </li>
      <suggestion-comment v-else v-for="comment in comments" :s-comment="comment"></suggestion-comment>
    </ul> <!-- .list-group -->

    <div class="panel-footer comments">
      <div class="media">
        <div class="media-left">
          <a href="#">
            <img class="media-object" :src="imageAuth" :alt="fullname">
          </a>
        </div>
        <div class="media-body">
          <div class="input-group">
            <textarea type="text" class="form-control" placeholder="Write a comment..." @keydown.shift.enter.prevent="sendComment" v-model.trim="comment"></textarea>
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" @click="sendComment" :disabled="comment == ''"><span class="glyphicon glyphicon-send"></span></button>
            </span>
          </div>
        </div>
      </div>
    </div> <!-- .panel-footer -->
  </div> <!-- .panel -->
</template>

<script>
  export default {

    props: {

      authUser: {
        type:       Object,
        required:   true
      },

      suggestionAct: {
        type:       Object,
        required:   true
      }

    },

    data() {

      return {

        comment: '',
        comments: [],
        skipC: 0,
        takeC: 5,
        fullC: false

      }

    },

    mounted() {

      this.getComments()

    },

    computed: {

      enlarge() {

        if (this.suggestionAct.message.length <= 85)  return true
        else                                          return false

      },

      image() {

        return window.location.origin + '/image/user/' + this.suggestionAct.user.id + '?wh=64'

      },

      imageAuth() {

        return window.location.origin + '/image/user/' + this.authUser.id + '?wh=34'

      },

      userUrl() {

        return window.location.origin + '/profile/' + this.suggestionAct.user.id

      },

      fullname() {

        return this.suggestionAct.user.fname + ' ' + this.suggestionAct.user.lname

      },

      date() {

        var date = this.suggestionAct.created_at

        if      (moment().diff(moment(date), 'second') <= 5)  return 'just now'
        else if (moment().diff(moment(date), 'day') == 0)     return moment(date).fromNow()
        else if (moment().diff(moment(date), 'day') == 1)     return 'yesterday at ' + moment(date).format('h:mm a')
        else if (moment().diff(moment(date), 'day') < 7)      return moment(date).format('ddd [at] h:mm a')
        else if (moment().diff(moment(date), 'year') == 0)    return moment(date).format('MMM D [at] h:mm a')
        else                                                  return moment(date).format('MMM D, YYYY [at] h:mm a')

      },

      message() {

        var text = this.suggestionAct.message

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
          else                      text = text.replace(word, '<a href="' + window.location.origin + '/search?key=' + word + '">' + word + '</a>')

        })

        text = text.replace(/[\n\r\f]/g, '<br>')

        return text

      }

    },

    methods: {

      getComments() {

        this.fullC = 'loading'

        this.$http
          .get(window.location.origin + '/api/suggestion/' + this.suggestionAct.id + '/comment?skip=' + this.skipC + '&take=' + this.takeC)

          .then((response) => {

            this.skipC += 5

            for (var i = 0; i <= response.data.length - 1; i++)
              this.comments.unshift(response.data[i])

            if (response.data.length == 0 || response.data.length < 5)
              this.fullC = true
            else
              this.fullC = false

          })

          .catch((response) => {

            console.error(response.status, response.statusText)

          })

      },

      sendComment() {

        if (this.comment == '') return

        this.$http
          .post(window.location.origin + '/api/suggestion/' + this.suggestionAct.id + '/comment', {
            comment: this.comment
          })

          .then((response) => {

            this.skipC++

            this.comments.push(response.data)

            this.comment = ''

          })

          .catch((response) => {

            console.error(response.error)

          })

      }

    }

  }
</script>